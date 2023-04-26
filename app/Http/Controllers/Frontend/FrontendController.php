<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Agent;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\WebsiteInfo;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Neighbor;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
use Exception;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function home()
    {
        $bannerInfo = Banner::first();
        $websiteInfo = WebsiteInfo::first();
        $sliderProperties = Property::with('details', 'address')
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->where('is_featured', 2)
            ->latest('mlsId')
            ->limit(10)
            ->get();
        $types=PropertyType::whereNull('deleted_at')->where('status',1)->get();
        return view('frontend.home', compact('bannerInfo', 'websiteInfo', 'sliderProperties','types'));
    }

    public function login()
    {
        $websiteInfo = WebsiteInfo::first();
        return view('frontend.login', compact(['websiteInfo']));
    }

    public function neighbourHood()
    {
        $dataList = Neighbor::whereNull('deleted_at')
            ->where('status', 1)
            ->inRandomOrder()
            ->get();
        return view('frontend.neighbourhood', compact('dataList'));
    }
    public function neighbourDetails($dataId)
    {
        $dataInfo = Neighbor::findOrfail($dataId);
        // dd($dataInfo);
        $dataList = Property::whereNull('deleted_at')
            ->where('neighbourhoodId', $dataId)
            ->inRandomOrder()
            ->get();
        // dd($dataList);
        return view('frontend.neighbour_profile', compact('dataInfo', 'dataList'));
    }
    public function property()
    {
        //featured property list
        $featuredProperties = Property::with([
            'details',
            'address',
            'saveProperty' => function ($query) {
                $query->where('user_id', auth()->id());
            },
        ])
        ->whereNull('deleted_at')
        // ->whereNotNull('mlsId')
        ->where('status', 1)
        ->where('is_featured', 2)
        ->orderBy('mlsId', 'DESC')
        ->paginate(12);
        return view('frontend.property', compact(['featuredProperties']));
    }

    public function signUp()
    {
        return view('frontend.signup');
    }

    public function sliders()
    {
        $sliders = Slider::whereNull('deleted_at')
            ->where('status', 1)
            ->get();

        return response()->json($sliders);
    }

    public function agents()
    {
        $dataList = Agent::with('user')
            ->whereNull('deleted_at')
            ->get();
        return view('frontend.agent-list', compact('dataList'));
    }

    public function agentDetails(Request $request, $username)
    {
        // dd($request->all());
        $dataInfo = Agent::where('username', $username)->first();
        // dd($dataInfo);
        $dataList = Property::whereNull('deleted_at')
            ->where('agentId', $dataInfo->id)
            ->inRandomOrder()
            ->get();
        // dd($dataList);
        return view('frontend.agent-details', compact('dataInfo', 'dataList'));
    }

    public function propertyDetails($id)
    {
        $dataInfo = Property::with([
            'details',
            'address',
            'propertyImages',
            'neighbour',
            'typeInfo',
            'gargaeInfo',
            'propertyCategory'=>function($q){
                return $q->with('category')->get();
            },
            'amenities' => function($q){
                return $q->with('amenityType')->get();
            },
            'typeInfo',
            'gargaeInfo',
        ])
            ->findOrFail( $id);
        // dd($dataInfo);
        return view('frontend.property-details', compact('dataInfo'));
    }

    public function searchProperty()
    {
        $query = Property::whereNull('deleted_at')
            ->where('status', 1)
            ->with([
                'details' => function ($q) {
                    if (request()->filled('bed')) {
                        $q->where('numOfBedroom', request()->bed);
                    }

                    if (request()->filled('numOfBathroom')) {
                        $q->where('numOfBathroom', request()->bathroom);
                    }
                },
            ]);
        if (request()->filled('searchKey')) {
            $query->where('title', 'like', request()->searchKey.'%');
        }

        if (request()->filled('typeId')) {
            $query->where('typeId', request()->typeId);
        }

        if (request()->filled('price')) {
            $query->where('price', '<=', request()->price);
        }
        $query->whereHas('details', function ($q) {
                if (request()->filled('bed')) {
                    $q->where('numOfBedroom', request()->bed);
                }

                if (request()->filled('numOfBathroom')) {
                    $q->where('numOfBathroom', request()->bathroom);
                }
            })
            ->orderBy('price', 'asc')
            ->get();

        $dataList = $query;

        //categories data
        $categories = Category::whereNull('deleted_at')
            ->where('status', 1)
            ->get();

        $types= PropertyType::whereNull('deleted_at')
            ->where('status', 1)
            ->get();

        return view('frontend.propery_search_result', compact(['dataList', 'categories','types']));
    }

    public function property_message(Request $request){
        // dd($request->all());
        DB::beginTransaction();
        try{
            $request->validate([
                'firstName'=>'required',
                'lastName'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'message'=>'required',
            ]);
            $dataInfo= New PropertyMessage();
            $dataInfo->firstName= $request->firstName;
            $dataInfo->lastName= $request->lastName;
            $dataInfo->email= $request->email;
            $dataInfo->phone= $request->phone;
            $dataInfo->message= $request->message;
            $dataInfo->user_id= $request->user_id;
            $dataInfo->property_id= $request->property_id;
            $dataInfo->save();
            DB::commit();
            return redirect()->back()->with('message','Message send successfully!');
        }catch(Exception $err){
            return redirect()->back()->with('errMessage','Something Whent wrong!');
        }
    }
    public function contact(){
        return view('frontend.contact');
    }
}
