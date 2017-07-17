<?php
/**
 * Created by PhpStorm.
 * User: 8888
 * Date: 19-Apr-17
 * Time: 7:42 PM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolExchangeApplication;
use App\Models\PasswordReset;
use App\Repositories\Storage\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function getLoginPage() {

        // Store Pre login URL for Redirect
        Session::put('pre_login_url', URL::previous());

        // Check has auth
        if (Auth::viaRemember() || Auth::check()) {
            return redirect()->route('frontend.dashboard');
        }

        return view("frontend.users.login");
    }

    public function postLogin(Request $request)
    {
        // Validation
        $rules = [
            'national_id'   => 'required',
            'password'      => 'required'
        ];

        $this->validate($request, $rules);

        // Auth
        if (Auth::attempt(['username' => $request->get('national_id'), 'password' => $request->get('password')], $request->get('remember'))) {

            // set property has application
            $request->session()->put('hasHspApp' , self::hasHspApplication(Auth::user()->getAuthIdentifier()));

            if (Session::has('pre_login_url')) {
                $url = Session::get('pre_login_url');
                Session::forget('pre_login_url');

                return redirect()->to($url);
            }

            return redirect()->route('frontend.dashboard.info');

        }

        return redirect()->back()->withErrors(['globalError' => 'These credentials do not match our records.']);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('frontend.user.login.get');
    }

    public function getSignUpPage() {
        return view("frontend.users.signup");
    }

    public function postSignUp(Request $request, User $user)
    {
        // Validation
        $rules = [
            'national_id'           => 'required|numeric|digits:13|unique:users,username',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'role'                  => '',
            'username'              => ''
        ];

        $this->validate($request, $rules);

        $request['password'] = bcrypt($request->get('password'));
        $request['username'] = $request->get('national_id');
        $request['role'] = 'Student';

        unset($request['national_id']);
        unset($request['password_confirmation']);

        $user = $user->create(array_only($request->all(), array_keys($rules)));

        Auth::login($user);
        
        return redirect()->route('frontend.user.signup-thakyou.get');
    }

    public function getThankyou() {
        return view("frontend.users.thankyou");
    }

    public function getForgetPasswordPage()
    {
        return view('frontend.users.forget-password.forget-password');
    }

    public function postForgetPassword(Request $request)
    {
        //validate citizen id
        $validatorCitizen = Validator::make($request->all(),
            [
                'citizen_id'           => 'required|numeric|digits:13|exists:users,username',
            ],[
                'citizen_id.exists'    => 'This citizen ID is invalid.'
            ]);

        if ($validatorCitizen->fails()) {
            return redirect()->route('frontend.user.forget-password.get')->withErrors($validatorCitizen)->withInput($request->all());
        }

        //validate email
        $user           = User::where('username',$request->get('citizen_id'))->first();
        $userEmail      = $user->getUserPersonalInfo['email'];
        if(empty($userEmail)){
            return view('frontend.users.forget-password.thank-you-email',['status' =>  'email_invalid']);
        }

        //validate old token is not expire
        $isNotExpire    = $this->userRepository->checkForgetPasswordTokenExpire($userEmail);
        if($isNotExpire){
            return view('frontend.users.forget-password.thank-you-email',['status' =>  'token_not_expire']);
        }

        //start keep token
        DB::beginTransaction();

        //delete and get token
        $token = $this->userRepository->generateForgetPasswordToken($userEmail);

        //data for template email
        $data   =   [
            'link_login'    => route('frontend.user.reset-password.get',['tc' => $token]),
            'user'          => $user
        ];

        try{
            Mail::send('frontend.emails.forget-password', $data, function ($m) use ($userEmail) {
                $m->from(env('MAIL_STAFF', env('MAIL_USERNAME' ) ), 'Request to reset password');
                $m->to($userEmail)->subject('Request to reset password');
            });
        }catch (\Exception $e){
            DB::rollBack();
            return view('frontend.users.forget-password.thank-you-email',['status' =>  'error_send_email']);
        }

        DB::commit();
        return view('frontend.users.forget-password.thank-you-email',['status' =>  'success']);
    }

    public function getResetPasswordPage(Request $request)
    {
        $token          = $request->get('tc');
        $user           = $this->userRepository->getUserByForgetPasswordToken($token);

        if(empty($token) || empty($user) ){
            return redirect()->route('frontend.user.login.get');
        }

        return view('frontend.users.forget-password.reset-password',[
            'email'    =>  $user->getUserPersonalInfo['email']
        ]);
    }

    public function postResetPassword(Request $request)
    {
        $rules = [
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
        $this->validate($request, $rules);

        $user   =   $this->userRepository->getUserByEmail($request->get('email'));

        if(empty($user)){
            return redirect()->route('frontend.user.forget-password.get');
        }

        DB::beginTransaction();

        try{
            $user->password =   bcrypt($request->get('password'));
            if($user->save()){
                PasswordReset::where('email',$request->get('email'))->delete();
                DB::commit();
            }
            return view('frontend.users.forget-password.thank-you-email',['status' =>  'reset_password_success']);
        }catch (\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('frontend.user.forget-password.get');

    }

    public static function hasHspApplication($user_id)
    {
        $hspApp = HighSchoolExchangeApplication::where('user_id', $user_id)->first();
        return !empty($hspApp) && $hspApp->status_application == 'approved';
    }

}