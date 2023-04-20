<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\SaveProperty;
use App\Models\Transection;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $property= Property::whereNull('deleted_at')->where('status',1)->where('agentId',Auth::guard('agent')->user()->id)->count();

        $featured_property= Property::whereNull('deleted_at')->where('agentId',Auth::guard('agent')->user()->id)->where('status',1)->where('is_featured',2)->count();

        $saved_propery= SaveProperty::with('user', 'property')->where('user_id',Auth::user()->id)->count();

        $featured_request= Property::whereNull('deleted_at')->where('status',1)->where('agentId',Auth::guard('agent')->user()->id)->where('is_featured',1)->count();

        $transection= Transection::whereNull('deleted_at')->count();

        return view('agent.agent_dashboard',compact('property','featured_property','featured_request','saved_propery','transection'));
    }
}
