<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyCategory extends Model
{
    use HasFactory;

    public function property() {
        return $this->belongsTo(Property::class, 'propertyId');
    }
    public function category() {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
