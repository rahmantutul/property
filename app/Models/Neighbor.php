<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighbor extends Model
{
    use HasFactory;
  public function getFullNameAttribute()
  {
      return ucwords($this->firstName. ' '.$this->lastName);
  }
}
