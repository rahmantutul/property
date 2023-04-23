<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Property;
use App\Models\SaveProperty;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $agents= Agent::whereNull('deleted_at')->whereHas('user',function($q){
            $q->where('status',1);
        })->count();
        $buyers= Buyer::whereNull('deleted_at')->whereHas('user',function($q){
            $q->where('status',1);
        })->count();
        $sellers= Buyer::whereNull('deleted_at')->whereHas('user',function($q){
            $q->where('status',1);
        })->count();

        $property= Property::whereNull('deleted_at')->where('status',1)->count();

        $featured_property= Property::whereNull('deleted_at')->where('status',1)->where('is_featured',2)->count();

        $saved_propery= SaveProperty::with('user', 'property')->where('user_id',Auth::user()->id)->count();

        $featured_request= Property::whereNull('deleted_at')->where('status',1)->where('is_featured',1)->count();

        $transection= Transection::whereNull('deleted_at')->count();
        return view('admin.admin_dashboard',compact('agents','buyers','sellers','property','featured_property','featured_request','saved_propery','transection'));
    }
}
