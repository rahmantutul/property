<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected array $guard_name = ['api', 'web','staff','staff-api'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'phone',
        'avatar',
        'userType',
        'status',
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


    public function admin(){
        return $this->hasOne('App\Models\Admin', 'user_id','id');
    }

    public function agent(){
        return $this->hasOne('App\Models\Agent', 'user_id','id');
    }

    public function biyer(){
        return $this->hasOne('App\Models\Buyer', 'user_id','id');
    }

    public function seller(){
        return $this->hasOne('App\Models\Seller', 'user_id','id');
    }
}
