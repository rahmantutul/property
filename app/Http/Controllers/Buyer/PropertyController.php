<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Traits\SystemLogTrait;
use App\Models\SaveProperty;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function saved()
    {
        $query= SaveProperty::with('user', 'property')->where('user_id',Auth::user()->id);
        // dd($query);
        
        // $query=Property::whereNull('deleted_at')->where('adminId',$savedId['user_id'])
        //         ->with('agentInfo','sellerInfo','buyerInfo','typeInfo','gargaeInfo','categories','amenities')->get();
        //         dd($query);
        // if(isset(request()->is_featured) && request()->is_featured==1)
        //     $query->where('is_featured',1);

        // if(isset(request()->featured) && request()->featured==1)
        //     $query->where('is_featured',2);
       
        $dataList=$query->paginate(100);

        return view('buyer.saved_property_list',compact('dataList'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
