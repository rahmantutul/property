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
        $property_category = PropertyCategory::with('property')->where('categoryId', $request->category)->get();
        $propertyCategoryData = $property_category->map(function($propertyCategory) {
            return $propertyCategory->property;
        });
        $property_details = PropertyDetails::with('property')->where(function($q){
            if (request()->filled('beds')) {
                return $q->where('numOfBedroom', request()->beds);
            }
            if (request()->filled('baths')) {
                return $q->where('numOfBathroom', request()->baths);
            }
        })->get();
        $propertyDetailsData = $property_details->map(function($propertyDetails) {
            return $propertyDetails->property;
        });
        $property_address = PropertyAddress::with('property')->where(function($q){
            if (request()->filled('keyword')) {
                $q->where('streetAddressOne', 'like', '%' . request()->keyword . '%')
                     ->orWhere('streetAddressTwo', 'like', '%' . request()->keyword . '%');
            }
        })->get();
        $propertyAddressData = $property_address->map(function($propertyAddress) {
            return $propertyAddress->property;
        });
        // dd($propertyAddressData);
        $query = Property::whereNull('deleted_at')->where('status', 1)
            ->where(function($q){
                    if (request()->filled('min_price')) {
                        $q->where('price', '>=', request()->min_price);
                    }
                    if (request()->filled('max_price')) {
                        $q->where('price', '<=', request()->max_price);
                    }
                })->get();

        $query = $query->merge($propertyCategoryData, $propertyDetailsData, $propertyAddressData);

        dd($query);

        
        
        $properties = $query->paginate(10);
        return view('frontend.search', compact('properties'));

    }

}
