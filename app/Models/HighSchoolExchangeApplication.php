<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighSchoolExchangeApplication extends Model
{
    protected $table    = 'users_high_school_exchange_application';

    protected $guarded  = [];

    public function getUserPersonalInfo()
    {
        return $this->belongsTo('App\Models\PersonalInfo', 'user_id', 'user_id');
    }

    public function getUserEducationInfo()
    {
        return $this->belongsTo('App\Models\EducationInfo', 'user_id', 'user_id');
    }

    public function getUserContactInfo()
    {
        return $this->belongsTo('App\Models\ContactInfo', 'user_id', 'user_id');
    }

    public function getUserOtherInfo()
    {
        return $this->belongsTo('App\Models\OtherInfo', 'user_id', 'user_id');
    }

    public function getApplicationTestLocationInfo()
    {
        return $this->belongsTo('App\Models\HighSchoolExchangeAdmissionTestLocation', 'admission_test_location_id');
    }

    public function getPIMLocationInfo()
    {
        return $this->belongsTo('App\Models\HighSchoolExchangeParentInformationMeetingLocation', 'parent_location_id');
    }

    public function getExCITECampLocationInfo()
    {
        return $this->belongsTo('App\Models\HighSchoolExchangeExciteCampLocation', 'excite_camp_id');
    }
}
