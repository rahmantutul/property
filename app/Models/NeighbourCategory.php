<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeighbourCategory extends Model
{
    use HasFactory;

    public function naighbours(){
        return $this->hasMany('App\Models\Neighbor','categoryId','id');
    }
}
