<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PropertyMessageController extends Controller
{
    public function index(){
        $query= PropertyMessage::with('property');
        // dd($query);
        $dataList= $query->where('user_id',Auth::user()->id)->latest()->paginate('40');
        return view('admin.property_message',compact('dataList'));
    }
    public function message_view($dataId){
        $dataInfo= PropertyMessage::find($dataId)->with('property')->first();
        // dd($dataInfo);
        return view('admin.message_details',compact('dataInfo'));
    }
    public function message_delete($id){
        PropertyMessage::find($id)->delete();
        Session::flash('msg','Message Deleted Successfully');
        return redirect()->back();
    }
}
