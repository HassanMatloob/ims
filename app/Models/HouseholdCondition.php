<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdCondition extends Model
{
    use HasFactory;

    public function indigency(){
    	return $this->belongsTo('App\Indigency');
    }
}
