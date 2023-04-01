<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentContact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AgentContactController extends Controller
{
    public function index(){
        $id= Auth::guard('agent')->user()->id;
        $query= AgentContact::where('agentId',$id);

        if(request()->filled('name')){
            $query->where('name','like',strtolower(trim(request()->name)).'%');
        }

        if(request()->filled('email'))
            $query->where('email','like',strtolower(trim(request()->email)).'%');

        if(request()->filled('phone'))
            $query->where('phone','like',strtolower(trim(request()->phone)).'%');
        
        if(request()->status)
            $query->where('status',request()->status);

        $dataList=$query->paginate(100)->withQueryString();

        
        return view('agent.message_list',compact('dataList'));
    }
    public function view($dataId){
        $dataInfo=AgentContact::find($dataId);
        return view('agent.message_details',compact('dataInfo'));
    }
    public function store(Request $request){
        DB::beginTransaction();
        try{
            $request->validate([
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'message'=>'required',
            ]);
            $dataInfo= New AgentContact();
            $dataInfo->name= $request->name;
            $dataInfo->email= $request->email;
            $dataInfo->phone= $request->phone;
            $dataInfo->message= $request->message;
            $dataInfo->agentId= $request->agentId;
            $dataInfo->save();
            DB::commit();
            return redirect()->back()->with('message','Message send successfully!');
        }catch(Exception $err){
            return redirect()->back()->with('message','Something Whent wrong!');
        }
    }
    public function destroy($id)
    {
        $dataInfo=AgentContact::find($id);
        $dataInfo->delete();
        return response()->json(['status'=>true ,'msg'=>'Message Deleted.!']); 
    }
}
