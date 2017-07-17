<?php
/**
 * Created by PhpStorm.
 * User: 8888
 * Date: 13-Oct-16
 * Time: 1:46 PM
 */

namespace App\Repositories\Storage;
use App\Models\PasswordReset;
use App\Models\PersonalInfo;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    public function __construct()
    {

    }

    public function generateForgetPasswordToken($user_email)
    {
        //delete token expire
        PasswordReset::where('expire_at', '<=', Carbon::now())->delete();

        //generate token
        do {
            $token          = str_random(60);
            $resetPassword  = PasswordReset::where('email',$user_email)->where('token',$token)->first();
        }
        while(!empty($resetPassword));

        //save fresh token
        $resetPassword  = new PasswordReset();
        $resetPassword->email   =   $user_email;
        $resetPassword->token   =   $token;
        $resetPassword->expire_at   =   Carbon::now()->addMinutes(30);
        $resetPassword->created_at  =   Carbon::now();
        $resetPassword->save();

        return $token;
    }

    public function checkForgetPasswordTokenExpire($email)
    {
        return PasswordReset::where('email', $email)->where('token', '!=', '')->where('expire_at', '>=', Carbon::now())->exists();
    }

    public function getUserByForgetPasswordToken($token)
    {
        //remove when token is expire
        PasswordReset::where('token', $token)->where('expire_at', '<', Carbon::now())->delete();

        $passwordResetObj   =   PasswordReset::where('token', $token)->where('expire_at', '>=', Carbon::now())->first();
        if(empty($passwordResetObj)){
            return null;
        }

        return $this->getUserByEmail($passwordResetObj->email);
    }

    public function getUserByEmail($email)
    {
        $hsp_app = PersonalInfo::where('email',$email)->first();
        if($hsp_app === null){
            return null;
        }

        return User::find($hsp_app->user_id);
    }

}