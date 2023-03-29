<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpDesk extends Model
{
    use HasFactory;
    public function lastMessage()
    {
        return $this->hasOne('App\Models\HelpDeskDetails','helpDeskId','id')->orderBy('id','DESC');
    }
    public function buyerInfo()
    {
        return $this->hasOne('App\Models\Buyer','id','userId');
    } 
    public function agentInfo()
    {
        return $this->hasOne('App\Models\Agent','id','userId');
    }
     public function sellerInfo()
    {
        return $this->hasOne('App\Models\Seller','id','userId');
    } 
    public function adminInfo()
    {
        return $this->hasOne('App\Models\Admin','id','userId');
    }
}
