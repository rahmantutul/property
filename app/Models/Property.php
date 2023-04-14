<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function agentInfo()
    {
        return $this->hasOne('App\Models\Agent', 'id', 'agentId')->whereNull('deleted_at');
    }
    public function buyerInfo()
    {
        return $this->hasOne('App\Models\Buyer', 'id', 'buyerId')->whereNull('deleted_at');
    }
    public function sellerInfo()
    {
        return $this->hasOne('App\Models\Buyer', 'id', 'sellerId')->whereNull('deleted_at');
    }
    public function typeInfo()
    {
        return $this->hasOne('App\Models\PropertyType', 'id', 'typeId')->whereNull('deleted_at');
    }
    public function gargaeInfo()
    {
        return $this->hasOne('App\Models\GarageType', 'id', 'garageTypeId')->whereNull('deleted_at');
    }
    public function categories()
    {
        return $this->hasMany('App\Models\PropertyCategory', 'propertyId', 'id')->whereNull('deleted_at');
    }
    public function amenities()
    {
        return $this->hasMany('App\Models\PropertyAmenity', 'propertyId', 'id')->whereNull('deleted_at');
    }
    public function address()
    {
        return $this->hasOne('App\Models\PropertyAddress', 'propertyId', 'id')->whereNull('deleted_at');
    }
    public function details()
    {
        return $this->hasOne('App\Models\PropertyDetails', 'propertyId', 'id')->whereNull('deleted_at');
    }
    public function propertyImages()
    {
        return $this->hasMany('App\Models\PropertyImages', 'propertyId', 'id')->whereNull('deleted_at');
    }
    public function propertyCategory()
    {
        return $this->hasOne('App\Models\PropertyCategory', 'propertyId', 'id')->whereNull('deleted_at');
    }

    public function saveProperty()
    {
        return $this->hasOne('App\Models\SaveProperty', 'property_id', 'id');
    }

    public function transections()
    {
        return $this->hasMany('App\Models\Transection', 'property_id', 'id');
    }
}