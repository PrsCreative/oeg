<?php

namespace App\Http\Controllers\Frontend;

use App\Models\HighSchoolExchangeApplication;
use App\Models\ContactInfo;
use App\Models\EducationInfo;
use App\Models\HighSchoolExchangePromotionCode;
use App\Models\PersonalInfo;
use App\Models\OtherInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function postApplyApplication(Request $request)
    {
        //auth session
        $user_id            = Auth::user()->getAuthIdentifier();
        $national_id        = Auth::user()->username;
        $hasHspApp          = UserController::hasHspApplication($user_id);

        if($hasHspApp){
            return redirect()->route('frontend.dashboard.info');
        }

        // Validation
        $rules = [
            'country'           => 'required',
            'title'             => 'required',
            'first-name'        => 'required|regex:/^[ก-เ]+$/',
            'last-name'         => 'required|regex:/^[ก-เ]+$/',
            'nickname'          => 'required|regex:/^[ก-เ]+$/',
            'birthdate'         => 'required',
            'nationality'       => 'required',
            'email'             => 'required|email',
            'medical-problem'   => 'required',
            'have-visa'         => 'required',
            'school-level'      => 'required',
            'school-name'       => 'required',
            'province'          => 'required',
            'gpa'               => 'required|numeric|between:0.00,4.00',
            'relationship'      => 'required',
            'emergency-contact-name'    => 'required',
            'emergency-contact-surname' => 'required',
            'emergency-email'   => 'nullable|email'
        ];

        //validate for specify text in radio input
        $rules['title_specify']         = $request->input('title') == 'other'           ? 'required' : '';
        $rules['specify']               = $request->input('medical-problem') == 'yes'   ? 'required' : '';
        $rules['relationship_specify']  = $request->input('relationship') == 'other'    ? 'required' : '';

        //define length phone
        $lengthPhone            =   strlen($request->input('phone'));
        $lengthEmergencyPhone   =   strlen($request->input('emergency-phone'));

        //validate phone number
        $rules['phone']             =   $lengthPhone            == 10 ? 'required|min:9|max:10|regex:/^(0[0-9\s\-\(\)]*)$/' : 'required|min:9|max:9|regex:/^([0-9\s\-\(\)]*)$/';
        $rules['emergency-phone']   =   $lengthEmergencyPhone   == 10 ? 'required|min:9|max:10|regex:/^(0[0-9\s\-\(\)]*)$/' : 'required|min:9|max:9|regex:/^([0-9\s\-\(\)]*)$/';

        $message = [
            'emergency-phone.regex'         => $lengthEmergencyPhone    == 10 ? 'Please input start with 0.' : 'Please input 0-9 letter.',
            'phone.regex'                   => $lengthPhone             == 10 ? 'Please input start with 0.' : 'Please input 0-9 letter.',
            'regex'                         => 'Please input thai letter only.',
            'title_specify.required'        => 'Please fill input at specify field.',
            'specify.required'              => 'Please fill input at specify field.',
            'relationship_specify.required' => 'Please fill input at specify field.',
        ];

        $this->validate($request, $rules, $message);

        //status apply application success or unsuccessfully
        $birthDate = Carbon::createFromFormat('d/m/Y', $request->input('birthdate'));
        $birthDate->year += (-543);

        $birthDateIsValid = $birthDate->between(Carbon::createFromFormat('d/m/Y', env('START_BIRTHDATE')), Carbon::createFromFormat('d/m/Y', env('END_BIRTHDATE')));
        $gpaIsValid = $request->input('gpa') > 2;
        $success = $birthDateIsValid && $gpaIsValid;

        //status payment
        $promoCodeDateIsValid = HighSchoolExchangePromotionCode::where('code', $request->input('promo-code'))
            ->where('start_date', '<=', Carbon::today()->toDateString())
            ->where('end_date', '>=', Carbon::today()->toDateString())
            ->whereRaw(' amount > used ')
            ->exists();
        //used promocode
        if ($promoCodeDateIsValid) {
            HighSchoolExchangePromotionCode::where('code', $request->input('promo-code'))->update([
                'used' => DB::raw('used + 1'),
            ]);
        }

        //high school exchange application
        $countries_to_apply = explode(',', $request->input('orderCountryStr'));
        $high_school_exchange_app = new HighSchoolExchangeApplication();
        $high_school_exchange_app->user_id = $user_id;
        $high_school_exchange_app->country_to_apply_1 = $countries_to_apply[0];
        $high_school_exchange_app->country_to_apply_2 = !empty($countries_to_apply[1]) ? $countries_to_apply[1] : null;
        $high_school_exchange_app->status_application = $success ? 'approved' : 'pending';
        $high_school_exchange_app->status_payment = $promoCodeDateIsValid ? 'approved' : 'pending';
        $high_school_exchange_app->state = $success && $promoCodeDateIsValid ? 2 : 1;
        $high_school_exchange_app->save();

        //personal info
        $personal_info = new PersonalInfo();
        $personal_info->user_id = $user_id;
        $personal_info->title = $request->input('title') == 'other' ? $request->input('title_specify') : $request->input('title');
        $personal_info->firstname = $request->input('first-name');
        $personal_info->lastname = $request->input('last-name');
        $personal_info->nickname = $request->input('nickname');
        $personal_info->date_of_birth = $birthDate;
        $personal_info->nationality = $request->input('nationality');
        $personal_info->national_id = $national_id;
        $personal_info->phone = $lengthPhone == 10 ? $request->input('phone') : "0" . $request->input('phone');
        $personal_info->email = $request->input('email');
        $personal_info->line_id = $request->input('lineid');
        $personal_info->personal_sickness = $request->input('medical-problem') == 'yes' ? $request->input('specify') : '';
        $personal_info->has_american_visa = $request->input('have-visa') == 'yes' ? true : false;
        $personal_info->save();

        //education info
        $education_info = new EducationInfo();
        $education_info->user_id = $user_id;
        $education_info->high_school_level = $request->input('school-level');
        $education_info->study_program = $request->input('study-program');
        $education_info->school_name = $request->input('school-name');
        $education_info->province = $request->input('province');
        $education_info->gpa = $request->input('gpa');
        $education_info->save();

        //contact info
        $contact_info = new ContactInfo();
        $contact_info->user_id = $user_id;
        $contact_info->emergency_contact_relationship = $request->input('relationship') == 'other' ? $request->input('relationship_specify') : $request->input('relationship');
        $contact_info->emergency_contact_name = $request->input('emergency-contact-name');
        $contact_info->emergency_contact_surname = $request->input('emergency-contact-surname');
        $contact_info->emergency_email = $request->input('emergency-email');
        $contact_info->emergency_phone = $lengthEmergencyPhone == 10 ? $request->input('emergency-phone') : "0" . $request->input('emergency-phone');
        $contact_info->save();

        //other info
        $other_info = new OtherInfo();
        $other_info->user_id = $user_id;
        $other_info->teacher_name = $request->input('teacher-name');
        $other_info->promotion_code = $request->input('promo-code');
        $other_info->source_of_apply = $this->splitArraySourceOfApply($request->input('source_apply'), $request);
        $other_info->save();

        $data['success'] = $success;
        $view = view('frontend.users.dashboard.thankyou_application_form', $data);

        $request->session()->put('hasHspApp', UserController::hasHspApplication(Auth::user()->getAuthIdentifier()));

        return $view;
    }

    private function splitArraySourceOfApply($source_of_applies = [],Request $request)
    {
        $res = '';
        if(is_array($source_of_applies)){
            foreach($source_of_applies as $key =>  $source_of_apply){
                if($key != 0){
                    $res .= ', ';
                }
                $res .= $source_of_apply != 'other' ? $source_of_apply : $request->input('sourceOther');
            }
        }
        return $res;
    }
}
