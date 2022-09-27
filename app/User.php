<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function indigency(){
        return $this->hasOne('App\Indigency');
    }

    public function approval(){
        return $this->hasMany("App\Models\Approval");
    }

    public function profile(){
        return $this->hasOne('App\Models\Profile');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public function task(){
        return $this->hasMany("App\Models\Task");
    }

    public function assignment(){
        return $this->hasMany('App\Models\Assignment');
    }

    public function verification(){
        return $this->hasMany('App\Models\Verification');
    }
}
