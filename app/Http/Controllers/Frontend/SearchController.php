<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * 
     */
    public function searchProperty(Request $request)
    {
        $query = Property::whereNull('deleted_at')->where('status', 1)
            ->with(['details' => function ($q) {
                if (request()->filled('bed')) {
                    $q->where('bed', request()->bed);
                }
                if (request()->filled('bath')) {
                    $q->where('bath', request()->bath);
                }
                if (request()->filled('garage')) {
                    $q->where('garage', request()->garage);
                }
                if (request()->filled('min_price')) {
                    $q->where('price', '>=', request()->min_price);
                }
                if (request()->filled('max_price')) {
                    $q->where('price', '<=', request()->max_price);
                }
                if (request()->filled('min_area')) {
                    $q->where('area', '>=', request()->min_area);
                }
                if (request()->filled('max_area')) {
                    $q->where('area', '<=', request()->max_area);
                }
            }])
            ->with(['agent' => function ($q) {
                if (request()->filled('agent')) {
                    $q->where('name', 'like', '%' . request()->agent . '%');
                }
            }])
            ->with(['category' => function ($q) {
                if (request()->filled('category')) {
                    $q->where('name', 'like', '%' . request()->category . '%');
                }
            }])
            ->with(['location' => function ($q) {
                if (request()->filled('location')) {
                    $q->where('name', 'like', '%' . request()->location . '%');
                }
            }])
            ->with(['type' => function ($q) {
                if (request()->filled('type')) {
                    $q->where('name', 'like', '%' . request()->type . '%');
                }
            }])
            ->with(['status' => function ($q) {
                if (request()->filled('status')) {
                    $q->where('name', 'like', '%' . request()->status . '%');
                }
            }])
            ->with(['city' => function ($q) {
                if (request()->filled('city')) {
                    $q->where('name', 'like', '%' . request()->city . '%');
                }
            }])
            ->with(['state' => function ($q) {
                if (request()->filled('state')) {
                    $q->where('name', 'like', '%' . request()->state . '%');
                }
            }])
            ->with(['country' => function ($q) {
                if (request()->filled('country')) {
                    $q->where('name', 'like', '%' . request()->country . '%');
                }
            }])
            ->with(['zip' => function ($q) {
                if (request()->filled('zip')) {
                    $q->where('name', 'like', '%' . request()->zip . '%');
                }
            }])
            ->with(['street' => function ($q) {
                if (request()->filled('street')) {
                    $q->where('name', 'like', '%' . request()->street . '%');
                }
            }])
            ->with(['address' => function ($q) {
                if (request()->filled('address')) {
                    $q->where('name', 'like', '%' . request()->address . '%');
                }
            }])
            ->with(['area' => function ($q) {
                if (request()->filled('area')) {
                    $q->where('name', 'like', '%' . request()->area . '%');
                }
            }])
            ->with(['city' => function ($q) {
                if (request()->filled('city')) {
                    $q->where('name', 'like', '%' . request()->city . '%');
                }
            }])
            ->with(['state' => function ($q) {
                if (request()->filled('state')) {
                    $q->where('name', 'like', '%' . request()->state . '%');
                }
            }])
            ->with(['country' => function ($q) {
                if (request()->filled('country')) {
                    $q->where('name', 'like', '%' . request()->country . '%');
                }
            }])
            ->with(['zip' => function ($q) {
                if (request()->filled('zip')) {
                    $q->where('name', 'like', '%' . request()->zip . '%');
                }
            }])
            ->with(['street' => function ($q) {
                if (request()->filled('street')) {
                    $q->where('name', 'like', '%' . request()->street . '%');
                }
            }])
            ->with(['address' => function ($q) {
                if (request()->filled('address')) {
                    $q->where('name', 'like', '%' . request()->address . '%');
                }
            }])
            ->with(['area' => function ($q) {
                if (request()->filled('area')) {
                    $q->where('name', 'like', '%' . request()->area . '%');
                }
            }])
            ->with(['city' => function ($q) {
                if (request()->filled('city')) {
                    $q->where('name', 'like', '%' . request()->city . '%');
                }
            }])
            ->with(['state' => function ($q) {
                if (request()->filled('state')) {
                    $q->where('name', 'like', '%' . request()->state . '%');
                }
            }])
            ->with(['country' => function ($q) {
                if (request()->filled('country')) {
                    $q->where('name', 'like', '%' . request()->country . '%');
                }
            }])
            ->with(['zip' => function ($q) {
                if (request()->filled('zip')) {
                    $q->where('name', 'like', '%' . request()->zip . '%');
                }
            }])
            ->with(['street' => function ($q) {
                if (request()->filled('street')) {
                    $q->where('name', 'like', '%' . request()->street . '%');
                }
            }])
            ->with(['address' => function ($q) {
                if (request()->filled('address')) {
                    $q->where('name', 'like', '%' . request()->address . '%');
                }
            }])
            ->with(['area' => function ($q) {
                if (request()->filled('area')) {
                    $q->where('name', 'like', '%' . request()->area . '%');
                }
            }])
            ->with(['city' => function ($q) {
                if (request()->filled('city')) {
                    $q->where('name', 'like', '%' . request()->city . '%');
                }
            }])
            ->with(['state' => function ($q) {
                if (request()->filled('state')) {
                    $q->where('name', 'like', '%' . request()->state . '%');
                }
            }])
            ->with(['country' => function ($q) {
                if (request()->filled('country')) {
                    $q->where('name', 'like', '%' . request()->country . '%');
                }
            }])
            ->with(['zip' => function ($q) {
                if (request()->filled('zip')) {
                    $q->where('name', 'like', '%' . request()->zip . '%');
                }
            }]);

        
        
        $properties = $query->paginate(10);
        return view('frontend.search', compact('properties'));

    }

}
