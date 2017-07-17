<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighSchoolExchangeExciteCampLocation extends Model {

    protected  $table = 'high_school_exchange_excite_camp_location';

    protected $guarded  = [];

    public function HSPStudentList()
    {
        return $this->hasMany('App\Models\HighSchoolExchangeApplication', 'excite_camp_id', 'id');
    }
}