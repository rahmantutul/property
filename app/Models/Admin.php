<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use  Notifiable,HasFactory,HasRoles;

    Protected $guard_name ='admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'firstName',
        'lastName',
        'facebook',
        'fax',
        'linkedin',
        'license',
        'about',
        'address',
        'is_approved',
    ];

    public function roleInfo()
    {
        return $this->hasOne('App\Models\Role','id','roleId')->whereNull('deleted_at');
    }
    public function getRoleAttribute()
    {
        return $this->hasOne('App\Models\Role','id','roleId')->whereNull('deleted_at')->first()->name;
    }
    public function getFullNameAttribute()
    {
        return ucwords($this->firstName. ' '.$this->lastName);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}