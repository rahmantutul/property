<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\Agent;
use Carbon\Carbon;
use Hash;
use Auth;
use DB;
use Session;

class AgentController extends Controller
{
     use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $query=Agent::whereNull('deleted_at')->where('status',1);

        if(request()->filled('name')){
            $query->where(function($q){
                $q->where('firstName','like',request()->name.'%')
                ->orWhere('lastName','like',request()->name.'%');
            });
        }

        if(request()->filled('email'))
            $query->where('email','like',strtolower(trim(request()->email)).'%');

        if(request()->filled('phone'))
            $query->where('phone','like',strtolower(trim(request()->phone)).'%');
        
        if(request()->status)
            $query->where('status',request()->status);

        if(request()->filled('pending_status')){
            $dataList=$query->where('is_approved',0)->paginate(100)->withQueryString();
        }else{
            $dataList=$query->where('is_approved',1)->paginate(100)->withQueryString();
        }
        
        
        return view('admin.agent_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agent_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      DB::beginTransaction();
       try{
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'bnName' => 'required',
            ],
            [
                'firstName.required' => "Please Enter First Name.",
                'lastName.required' => "Please Enter Last Name.",
                'email.required' => "Please Enter User Email Address.",
                'phone.required' => "Please Enter User Phone No.",
                // 'bnName.required' => "Please Enter agent Bengali Name.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);

            $dataInfo=new Agent();

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->email=strtolower(trim($request->email));

            $dataInfo->phone=$request->phone;

            $dataInfo->password=($request->filled('password'))?Hash::make($request->password):Hash::make('123Abc@');
            
            if($request->hasFile('photo'))
                $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'Users');
            else
                $dataInfo->avatar=env('APP_URL').'/images/defaultUser.png';
            
            $dataInfo->status=1;

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->full_name." Agent created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'agents',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Agent Added Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Agent.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('AgentController','store',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($dataId)
    {
        $dataInfo=Agent::find($dataId);
        return view('admin.agent_edit',compact('dataInfo'));
    }

    public function editProfile()
    {
        $dataId= Auth::guard('agent')->user()->id;
        $dataInfo=Agent::find($dataId);
        return view('agent.agent_edit',compact('dataInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        // dd($request->all());
       DB::beginTransaction();
       try{
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'confirm_password' => 'confirmed|max:8|different:old_password',
                // 'bnName' => 'required',
            ],
            [
                'firstName.required' => "Please Enter First Name.",
                'lastName.required' => "Please Enter Last Name.",
                'email.required' => "Please Enter User Email Address.",
                'phone.required' => "Please Enter User Phone No.",
                // 'bnName.required' => "Please Enter agent Bengali Name.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);


            $dataInfo=Agent::find($request->dataId);

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->email=strtolower(trim($request->email));

            $dataInfo->phone=$request->phone;
            $dataInfo->fax=$request->fax;
            $dataInfo->facebook=$request->facebook;
            $dataInfo->linkedin=$request->linkedin;
            $dataInfo->skype=$request->skype;
            $dataInfo->about=$request->linkedin;
            $dataInfo->phone=$request->phone;
            $dataInfo->license=$request->license;
            $dataInfo->address=$request->address;
                
            if (Hash::check($request->old_password, $dataInfo->password)) { 
                $dataInfo->password=Hash::make($request->confirm_password);
             } else {
                 Session::flash('errMsg','Password not matched!');
             }
          if($request->hasFile('photo'))
            $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'agents');

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->firstName." Agent updated by ".Auth::guard('agent')->user()->firstName;

                $this->storeSystemLog($dataInfo->id, 'agents',$note);

                DB::commit();

                // return view('welcome');
                Session::flash('msg','Agent Info Updated Successfully.!');
                return redirect()->back();
                // return response()->json(['status'=>true ,'msg'=>' Agent Info Updated Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();
                 Session::flash('errMsg','Failed To Update Agent.!');
                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Agent.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('AgentController','update',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
       }
    }




    public function update(Request $request)
    {
       DB::beginTransaction();
       try{
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'bnName' => 'required',
            ],
            [
                'firstName.required' => "Please Enter First Name.",
                'lastName.required' => "Please Enter Last Name.",
                'email.required' => "Please Enter User Email Address.",
                'phone.required' => "Please Enter User Phone No.",
                // 'bnName.required' => "Please Enter agent Bengali Name.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);


            $dataInfo=Agent::find($request->dataId);

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->email=strtolower(trim($request->email));

            $dataInfo->phone=$request->phone;
                
            if($request->password)
                $dataInfo->password=Hash::make($request->password);

          if($request->hasFile('photo'))
            $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'agents');

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->full_name." Agent updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'agents',$note);

                DB::commit();

                // return view('welcome');

                return response()->json(['status'=>true ,'msg'=>' Agent Info Updated Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Agent.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('AgentController','update',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        
        $dataInfo=Agent::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Agent  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'agents',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Agent Info deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To delete Agent Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        $dataInfo=Agent::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->status=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Agent status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'agents',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Agent Status Changed Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Change Status!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeApprove(Request $request)
    {
        DB::beginTransaction();
        $dataInfo=Agent::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->is_approved=1;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Agent approved changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'agents',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Agent approved Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To approved!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }
    
    public function changePassword(Request $request){
        if($request->isMethod('post')){
            DB::beginTransaction();
            try{
                 $request->validate([
                     'old_pass' => 'required',
                     'new_pass' => 'required',
                     // 'guard_name' => 'required',
                 ],
                 [
                     'old_pass.required' => "Please Enter Old Password.",
                     'new_pass.required' => "Please Enter New Password.",
     
                 ]);

                 $id= Auth::guard('admin')->user()->id;

                 $dataInfo=Agent::find($id);

                // The passwords matches
                if (!Hash::check($request->get('old_pass'), $dataInfo->password)) 
                {
                    return response()->json(['status'=>false ,'msg'=>'Current Password is Invalid!']);
                }
        
                // Current password and new password same
                if (strcmp($request->get('old_pass'), $request->new_pass) == 0) 
                {
                    return response()->json(['status'=>false ,'msg'=>'New Password cannot be same as your current password.!']);
                }
     
                $dataInfo->password =  Hash::make($request->new_pass);
                 
                 $dataInfo->updated_at=Carbon::now();

                 $dataInfo->save();

                 if($dataInfo->save()){
     
                     $note=$dataInfo->id."=> Password changed by ".Auth::guard('admin')->user()->name;
     
                     $this->storeSystemLog($dataInfo->id, 'agent',$note);
     
                     DB::commit();
     
                     return response()->json(['status'=>true ,'msg'=>'Password changed Successfully.!']);
                 }
                 else{
     
                      DB::rollBack();
     
                      return response()->json(['status'=>false ,'msg'=>'Failed To Change Password!']);
                 }
            }
             catch(Exception $err){
     
                 DB::rollBack();
     
                 $this->storeSystemError('AgentController','changepassword',$err);
     
                 DB::commit();
     
                 return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
            }
        }

       return view('admin.agent_password_change');

    }
}