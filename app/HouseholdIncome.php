<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdIncome extends Model
{
    use HasFactory;

    public function indigency(){
    	return $this->belongsTo('App\Indigency');
    }
}
