<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyAddress;
use App\Models\PropertyDetails;
use App\Models\PropertyCategory;
use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use App\Models\ResoapiProperties;

class SearchController extends Controller
{
    /**
     *
     */
    public function searchProperty(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'category' => 'nullable|integer',
            'beds' => 'nullable|integer',
            'baths' => 'nullable|integer',
            'min_price' => 'nullable|integer',
            'max_price' => 'nullable|integer',
            'keyword' => 'nullable|string',
        ]);
        $dataList = Property::with('propertyCategory', 'details', 'address','neighbour','typeInfo')
        ->whereHas('propertyCategory', function ($q) {
            if (request()->filled('category')) {
                $q->where('categoryId', request()->category);
            }
        })
        ->whereHas('details', function ($q) {
            if (request()->filled('beds')) {
                $q->where('numOfBedroom', request()->beds);
            }
            if (request()->filled('baths')) {
                $q->where('numOfBathroom', request()->baths);
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
            }
        })
        ->orWhere(function ($q) {
            if (request()->filled('min_price')) {
                $q->where('price', '>=', request()->min_price);
            }
            if (request()->filled('max_price')) {
                $q->where('price', '<=', request()->max_price);
            }
        })
        ->orWhere(function ($q) {
            if (request()->filled('featured_property')) {
                $q->where('is_featured', 2);
            }
        })
        ->whereNull('deleted_at')
        ->orderBy('price', 'asc')
        ->paginate(10);



            // dd($request->all());


        $resoDataList = ResoapiProperties::query()
            ->where(function ($q) {
                if (request()->filled('bed')) {
                    $q->where('BedroomsTotal', request()->bed);
                }
                if (request()->filled('baths')) {
                    $q->where('BathroomsTotalInteger', request()->baths);
                }
                if (request()->filled('keyword')) {
                    $q->where('BuyerOfficeName', 'like', '%' . request()->keyword . '%')
                        ->orWhere('Directions', 'like', '%' . request()->keyword . '%')
                        ->orWhere('PropertyType', 'like', '%' . request()->keyword . '%')
                        ->orWhere('PropertySubType', 'like', '%' . request()->keyword . '%')
                        ->orWhere('PublicRemarks', 'like', '%' . request()->keyword . '%')
                        ->orWhere('StreetName', 'like', '%' . request()->keyword . '%');
                }
                if (request()->filled('min_price')) {
                    $q->where('ListPrice', '>=', request()->min_price);
                }
                if (request()->filled('max_price')) {
                    $q->where('ListPrice', '<=', request()->max_price);
                }
            })
            ->get();

        //categories data







        $categories=Category::whereNull('deleted_at')->where('status',1)->get();

        $types=PropertyType::whereNull('deleted_at')->where('status',1)->get();

        return view('frontend.propery_search_result', compact(['dataList', 'categories','types','resoDataList']));

    }

}
