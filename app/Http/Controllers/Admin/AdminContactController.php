<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminContact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class AdminContactController extends Controller
{
    public function index(){

        $query= AdminContact::query();

        if(request()->filled('name')){
            $query->where('name','like',strtolower(trim(request()->name)).'%');
        }

        if(request()->filled('email'))
            $query->where('email','like',strtolower(trim(request()->email)).'%');

        if(request()->filled('phone'))
            $query->where('phone','like',strtolower(trim(request()->phone)).'%');
        
        if(request()->status)
            $query->where('status',request()->status);

        $dataList=$query->paginate(100);

        
        return view('admin.message_list',compact('dataList'));
    }
    public function view($dataId){
        $dataInfo=AdminContact::find($dataId);
        return view('admin.message_details',compact('dataInfo'));
    }
    public function store(Request $request){
        DB::beginTransaction();
        try{
            $request->validate([
                'name'=>'required',
                'email'=>'required',
                'subject'=>'required',
                'message'=>'required',
            ]);
            $dataInfo= New AdminContact();
            $dataInfo->name= $request->name;
            $dataInfo->email= $request->email;
            $dataInfo->subject= $request->subject;
            $dataInfo->message= $request->message;
            
            if($dataInfo->save()){
                Mail::to($request->email)->send(new ContactMail($dataInfo));
            }
            DB::commit();
            return redirect()->back()->with('message','Message send successfully!');
        }catch(Exception $err){
            return redirect()->back()->with('message','Something Whent wrong!');
        }
    }
    public function destroy($id)
    {
        $dataInfo=AdminContact::find($id);
        $dataInfo->delete();
        return response()->json(['status'=>true ,'msg'=>'Message Deleted.!']); 
    }
}
