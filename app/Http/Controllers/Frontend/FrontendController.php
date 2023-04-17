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
        return view('frontend.home', compact('bannerInfo', 'websiteInfo', 'sliderProperties'));
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
            ->whereNotNull('mlsId')
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
            $query->where('title', 'like', request()->searchKey . '%');
        }

        if (request()->filled('typeId')) {
            $query->where('typeId', request()->typeId);
        }

        if (request()->filled('price')) {
            $query->where('price', '<=', request()->price);
        }

        $query
            ->whereHas('details', function ($q) {
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

        return view('frontend.propery_search_result', compact(['dataList', 'categories']));
    }
}
