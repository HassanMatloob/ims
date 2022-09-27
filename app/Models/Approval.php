<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    // public function approvable(){
    // 	return $this->morphTo();
    // }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function indigency(){
    	$this->belongsTo('App\Indigency');
    }
}
