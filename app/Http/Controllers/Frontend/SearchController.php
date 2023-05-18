<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyAddress;
use App\Models\PropertyDetails;
use App\Models\PropertyCategory;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     *
     */
    public function searchProperty(Request $request)
    {
        $request->validate([
            'category' => 'nullable|integer',
            'beds' => 'nullable|integer',
            'baths' => 'nullable|integer',
            'min_price' => 'nullable|integer',
            'max_price' => 'nullable|integer',
            'keyword' => 'nullable|string',
        ]);

        $dataList = Property::with('propertyCategory', 'details', 'address')
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
                if (request()->filled('keyword')) {
                    $q->where('streetAddressOne', 'like', '%' . request()->keyword . '%')
                        ->orWhere('streetAddressTwo', 'like', '%' . request()->keyword . '%');
                }
            })
            ->where(function ($q) {
                if (request()->filled('min_price')) {
                    $q->where('price', '>=', request()->min_price);
                }
                if (request()->filled('max_price')) {
                    $q->where('price', '<=', request()->max_price);
                }
            })
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->paginate(10);

        //categories data
        $categories=Category::whereNull('deleted_at')->where('status',1)->get();

        // dd($dataList);
        return view('frontend.propery_search_result', compact(['dataList', 'categories']));

    }

}
