<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Slider;

class FrontendController extends Controller
{
    public function home(){
        return view('frontend.home');
    }

    public function login(){
        return view('frontend.login');
    }

    public function neighbourHood(){
        return view('frontend.neighbourHood');
    }

    public function property(){
        return view('frontend.property');
    }
    
    public function signUp(){
        return view('frontend.signup');
    }

    public function sliders()
    {
        $sliders=Slider::whereNull('deleted_at')->where('status',1)->get();

        return response()->json($sliders);
    }

    public function agents()
    {
        $dataList= Agent::whereNull('deleted_at')->where(['status'=>1])->get();
        return view('frontend.agent-list',compact('dataList'));
    }

    public function agentDetails($dataId)
    {
        $dataInfo= Agent::findOrfail($dataId);
        // dd($dataInfo);
        $dataList= Property::whereNull('deleted_at')->where('agentId',$dataId)->inRandomOrder()->get();
        // dd($dataList);
        return view('frontend.agent-details',compact('dataInfo','dataList'));
    }


    public function searchProperty()
    {
        $query=Property::whereNull('deleted_at')->where('status',1)
            ->with(['details'=>function($q){
                    if(request()->filled('bed'))
                    $q->where('numOfBedroom',request()->bed);

                if(request()->filled('numOfBathroom'))
                    $q->where('numOfBathroom',request()->bathroom);
            }]);

        if(request()->filled('searchKey'))
            $query->where('title','like',request()->searchKey.'%');

        if(request()->filled('typeId'))
            $query->where('typeId',request()->typeId);

        if(request()->filled('price'))
            $query->where('price','<=',request()->price);

        $query->whereHas('details',function($q){
            if(request()->filled('bed'))
                $q->where('numOfBedroom',request()->bed);

            if(request()->filled('numOfBathroom'))
                $q->where('numOfBathroom',request()->bathroom);
        });

        $dataList=$query->orderBy('price','asc')->get();

        return view('frontend.propery_search_result',compact('dataList'));
    }
    
}
