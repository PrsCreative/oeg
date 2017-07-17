<?php

namespace App\Providers;

use App\Models\HighSchoolExchangeParentInformationMeetingLocation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider {

    public function boot()
    {
        Validator::extend('compare_column', function ( $attribute, $value, $parameters, $validator)
        {
            if (count($parameters) < 5)
            {
                throw new \InvalidArgumentException("Validation rule compare_column requires 5 parameters.");
            }

            $query = DB::table($parameters[0])->find($parameters[1]);

            if (empty($query)) {
                throw new \InvalidArgumentException('Not found data in table '.$parameters[0].' record id '.$parameters[1]);
            }

            // Convert Object to Array
            $query = (array)$query;

            switch ($parameters[3]) {
                case '==' : return $query[$parameters[2]] == $query[$parameters[4]];
                case '!=': return $query[$parameters[2]] != $query[$parameters[4]];
                case '>=': return $query[$parameters[2]] >= $query[$parameters[4]];
                case '<=': return $query[$parameters[2]] <= $query[$parameters[4]];
                case '>':  return $query[$parameters[2]] > $query[$parameters[4]];
                case '<':  return $query[$parameters[2]] < $query[$parameters[4]];
                default : throw new \InvalidArgumentException("Validation rule compare_column Comparison Operators incorrect");
            }
        });

        Validator::extend('max_compare_column_hsp_parent', function ($attribute, $value, $parameters, $validator) {
            $parent_locate_id = $parameters[0];

            return HighSchoolExchangeParentInformationMeetingLocation::where('id',$parent_locate_id)
                ->where('date','>=',Carbon::now()->toDateString())
                ->where('status','open')
                ->where('year','>=',Carbon::now()->year)
                ->where('province','!=',NULL)
                ->where('province','!=','')
                ->whereRaw(' amount - used  >= '.$value)
                ->exists();

        });
    }
}