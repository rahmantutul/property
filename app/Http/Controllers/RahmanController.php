<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RahmanController extends Controller
{
        
    public function property(){
        return view('property.property_create');
    }

}
