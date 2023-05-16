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
use App\Models\NeighbourCategory;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
use App\Models\ResoapiProperties;
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
        
        // dd($neighbours);
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
        return view('frontend.neighbourHood', compact('dataList'));
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
         //dd($dataInfo);
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
    public function resoPropertyDetails($id)
    {
        $dataInfo = ResoapiProperties::findOrFail( $id);
        // dd($dataInfo);
        return view('frontend.reso-property-details', compact('dataInfo'));
    }

    public function searchProperty()
    {
        // dd(request()->all());
        $dataList = Property::with('propertyCategory', 'details', 'address','neighbour','typeInfo')
        ->whereHas('propertyCategory', function ($q) {
            if (request()->filled('category')) {
                $q->where('categoryId', request()->category);
            }
        })
        ->whereHas('details', function ($q) {
            if (request()->filled('bed')) {
                $q->where('numOfBedroom', request()->bed);
            }
            if (request()->filled('bathroom')) {
                $q->where('numOfBathroom', request()->bathroom);
            }
        })
        ->whereHas('address', function ($q) {
            if (request()->filled('searchKey')) {
                $q->where('streetAddressOne', 'like', '%' . request()->searchKey . '%')
                    ->orWhere('streetAddressTwo', 'like', '%' . request()->searchKey . '%');
            }
        })
        ->orWhere(function ($q) {
            if (request()->filled('searchKey')) {
                $q->where('title', 'like', '%' . request()->searchKey . '%');
            }
        })
        ->where(function ($q) {
            if (request()->filled('typeId')) {
                $q->where('typeId', request()->typeId);
            }
        })
        ->whereHas('neighbour', function ($q) {
            if (request()->filled('neighbourhoodId')) {
                $q->where('neighbourhoodId',request()->neighbourhoodId);
                    // ->orWhere('streetAddressTwo', 'like', '%' . request()->keyword . '%');
            }
        })
        ->where(function ($q) {
            if (request()->filled('price')) {
                $q->where('price', '<=', request()->price);
            }
        })
        ->whereNull('deleted_at')
        ->orderBy('price', 'asc')
        ->paginate(10);
        


        
        $resoDataList = ResoapiProperties::query()
            ->where(function ($q) {
                if (request()->filled('bed')) {
                    $q->where('BedroomsTotal', request()->bed);
                }
                if (request()->filled('bathroom')) {
                    $q->where('BathroomsTotalInteger', request()->bathroom);
                }
                if (request()->filled('searchKey')) {
                    $q->where('BuyerOfficeName', 'like', '%' . request()->searchKey . '%')
                        ->orWhere('Directions', 'like', '%' . request()->searchKey . '%')
                        ->orWhere('PropertyType', 'like', '%' . request()->searchKey . '%')
                        ->orWhere('PropertySubType', 'like', '%' . request()->searchKey . '%')
                        ->orWhere('PublicRemarks', 'like', '%' . request()->searchKey . '%')
                        ->orWhere('StreetName', 'like', '%' . request()->searchKey . '%');
                }
                if (request()->filled('price')) {
                    $q->where('ListPrice', '>=', request()->price);
                }
            })
            ->orderBy('ListPrice', 'asc')
            ->get();
        // dd($dataList);
        //categories data
        $categories = Category::whereNull('deleted_at')
            ->where('status', 1)
            ->get();

        $types= PropertyType::whereNull('deleted_at')
            ->where('status', 1)
            ->get();
        $neighbours= Neighbor::whereNull('deleted_at')
            ->where('status', 1)
            ->get();

        return view('frontend.propery_search_result', compact(['dataList', 'categories','types','neighbours','resoDataList']));
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
