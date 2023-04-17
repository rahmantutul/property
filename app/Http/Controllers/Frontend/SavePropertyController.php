<?php

namespace App\Http\Controllers\Frontend;

use App\Models\SaveProperty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class SavePropertyController extends Controller
{
    //property save with ajax
    public function saveProperty(Request $request, $id)
    {
        if (Auth()->check()) {
            $user = auth()
                ->user()
                ->load([
                    'saveProperty' => function ($query) use ($id) {
                        $query->where('property_id', $id);
                    },
                ]);

            if ($user && $user->saveProperty) {
                $savelist = SaveProperty::where('property_id', $id)->where('user_id', auth()->id());
                $savelist->delete();
                $message = [
                    'message' => 'Property removed from save list',
                    'type' => 'success',
                    'delete' => true
                ];
                return response()->json($message);
            } else {
                if (Auth::user()->user_type == 1 || Auth::user()->user_type == 2 || Auth::user()->user_type == 3 || Auth::user()->user_type == 4) {
                    $savelist = new SaveProperty();
                    $savelist->user_id = auth()->id();
                    $savelist->property_id = $id;
                    $savelist->save();
                    $message = [
                        'message' => 'Property added to save list',
                        'type' => 'success',
                        'delete' => false
                    ];
                    return response()->json($message);
                } else {
                    $message = [
                        'message' => 'You are not eligible for save property',
                        'type' => 'error'
                    ];
                    return response()->json($message);
                }
            }
        } else {
            $message = [
                'message' => 'Please Login First!',
                'type' => 'error'
            ];
            return response()->json($message);
        }
    }
}
