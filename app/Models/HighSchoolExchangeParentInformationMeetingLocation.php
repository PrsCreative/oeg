<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighSchoolExchangeParentInformationMeetingLocation extends Model
{
    //

    protected $table    = 'high_school_exchange_parent_information_meeting_location';

    protected $guarded  = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function HSPStudentList()
    {
        return $this->hasMany('App\Models\HighSchoolExchangeApplication', 'parent_location_id', 'id');
    }
}
