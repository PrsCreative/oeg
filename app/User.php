<?php

namespace App;

use App\Models\PersonalInfo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getUserPersonalInfo()
    {
        return $this->belongsTo('App\Models\PersonalInfo', 'id', 'user_id');
    }

    public function getEducationInfo()
    {
        return $this->belongsTo('App\Models\EducationInfo', 'id', 'user_id');
    }

    public function getContactInfo()
    {
        return $this->belongsTo('App\Models\ContactInfo', 'id', 'user_id');
    }

    public function getHspAppInfo()
    {
        return $this->belongsTo('App\Models\HighSchoolExchangeApplication', 'id', 'user_id');
    }

    public function getOtherInfo()
    {
        return $this->belongsTo('App\Models\OtherInfo', 'id', 'user_id');
    }
}
