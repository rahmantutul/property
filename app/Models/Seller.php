<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Seller extends Authenticatable
{
     use  Notifiable,HasFactory,HasRoles;

     Protected $guard_name ='seller';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'firstName',
        'lastName',
        'address',
        'is_approved',
    ];



    public function getFullNameAttribute()
    {
        return ucwords($this->firstName. ' '.$this->lastName);
    }
}