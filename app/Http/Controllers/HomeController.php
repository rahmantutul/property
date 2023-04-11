<?php

namespace App\Http\Controllers;

use App\Models\MarketActivity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function blogDetails($dataId){
        $dataInfo= MarketActivity::where('id',$dataId)->first();
        $dataList= MarketActivity::where('shareStatus',1)->inRandomOrder()
        ->limit(4)
        ->get();
        return view('admin.blog-details',compact('dataInfo','dataList'));
    }


}
