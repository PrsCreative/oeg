<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighSchoolExchangeAdmissionTestLocation extends Model
{
    protected $table    = 'high_school_exchange_admission_test_location';

    protected $guarded  = [];

    public function HSPStudentList()
    {
        return $this->hasMany('App\Models\HighSchoolExchangeApplication', 'admission_test_location_id', 'id');
    }
}