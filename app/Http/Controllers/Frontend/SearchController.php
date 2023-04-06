<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PropertyAddress;
use App\Models\PropertyCategory;
use App\Models\PropertyDetails;

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

        $properties = Property::with('propertyCategory', 'details', 'address')
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

        return view('frontend.search', compact('properties'));

    }

}
