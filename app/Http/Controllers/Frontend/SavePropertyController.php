<?php

namespace App\Http\Controllers\Frontend;

use App\Models\SaveProperty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SavePropertyController extends Controller
{
    //construct
    public function __construct()
    {
        $this->middleware('auth');
    }

    //property save with ajax
    public function saveProperty(Request $request, $id)
    {
        $user = auth()->user()->load(['saveProperty' => function ($query) use ($id) {
                $query->where('property_id', $id);
            },
        ]);

        if ($user && $user->saveProperty) {
            $savelist = SaveProperty::where('property_id', $id)->where('user_id', auth()->id());
            $savelist->delete();
            return response()->json(['success' => 'Property removed from save list','delete'=> true]);
        } else {

            if (Auth::user()->user_type == 1 || Auth::user()->user_type == 2 || Auth::user()->user_type == 3 || Auth::user()->user_type == 4) {
                $savelist              = new SaveProperty();
                $savelist->user_id     = auth()->id();
                $savelist->property_id = $id;
                $savelist->save();
                return response()->json(['success' => 'Property added to save list', 'delete'=> false]);
            } else {
                return response()->json(['error' => 'You are not eligible for save property']);
            }
        }
    }
}
