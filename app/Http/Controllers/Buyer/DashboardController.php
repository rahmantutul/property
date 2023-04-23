<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Property;
use App\Models\SaveProperty;
use App\Models\Transection;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $saved_propery= SaveProperty::with('user', 'property')->where('user_id',Auth::user()->id)->count();

        $transection= Transection::whereNull('deleted_at')->count();
        return view('buyer.buyer_dashboard',compact('saved_propery'));
    }
}
