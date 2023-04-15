<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'property_id',
        'amount',
        'date',
        'is_approved',
        'is_paid',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
