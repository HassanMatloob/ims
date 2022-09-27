<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indigency extends Model
{
    //
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function personaldetail(){
    	return $this->hasOne('App\PersonalDetail');
    }

    public function householdincome(){
    	return $this->hasMany('App\HouseholdIncome');
    }

    public function householdCondition(){
        return $this->hasOne('App\Models\HouseholdCondition');
    }

    public function document(){
        return $this->hasOne('App\Models\Document');
    }

    public function approval(){
        return $this->hasMany('App\Models\Approval');
    }

    public function verification(){
        return $this->hasOne('App\Models\Verification');
    }
}
