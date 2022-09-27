<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    protected $fillable = ['initials'];

    public function indigency(){
    	return $this->belongsTo('App\Indigency');
    }
}
