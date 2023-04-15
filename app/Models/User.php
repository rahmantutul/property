<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Seller;
use Laravelista\Comments\Commenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable , Commenter;

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
        'user_type',
        'is_approved',
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

    /**
     * Wish List
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function saveProperty() {
        return $this->hasOne(SaveProperty::class, 'user_id');
    }

    public function message() {
        return $this->hasMany("App\Models\Message");
    }

    public function adminInfo() {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function agentInfo() {
        return $this->hasOne(Agent::class, 'user_id');
    }

    public function sellerInfo() {
        return $this->hasOne(Seller::class, 'user_id');
    }

    public function buyerInfo() {
        return $this->hasOne(Buyer::class, 'user_id');
    }


}
