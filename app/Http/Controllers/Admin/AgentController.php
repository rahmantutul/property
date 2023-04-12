<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\Agent;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $query=Agent::whereNull('deleted_at');
        // dd($query);
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
            $dataList=$query->with('user',function($q){
                $q->where('is_approved',0);
            })
            ->paginate(100)->withQueryString();
        }else{
            $dataList=$query->with('user',function($q){
                $q->where('is_approved',1);
            })
            ->paginate(100)->withQueryString();
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
                 'password' => 'required',
                 // 'bnName' => 'required',
             ],
             [
                 'firstName.required' => "Please Enter First Name.",
                 'lastName.required' => "Please Enter Last Name.",
                 'email.required' => "Please Enter User Email Address.",
                 'phone.required' => "Please Enter User Phone No.",
                 // 'bnName.required' => "Please Enter Staff Bengali Name.",
                 'photo.image' => "uploaded file must be a valid image format.",
                 'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                 'photo.max' => "Image file can't be more than 2 MB.",
                 'password.required' => "Please Enter Password.",
             ]);
             //Admin create with user table
             $user = User::create([
                 'email' => strtolower(trim($request->email)),
                 'password' => Hash::make($request->password),
                 'phone' => $request->phone,
                 'user_type' => 2,
                 'status' => 1,
                 'avatar' => ($request->hasFile('photo'))?$this->uploadPhoto($request->file('photo'), 'User'):config('app.url').'/images/defaultUser.png',
                 'is_approved' => 1
             ]);
 
             $agent = Agent::create([
                 'firstName' => $request->firstName,
                 'lastName' => $request->lastName,
                 'roleId' => $request->roleId,
                 'user_id' => $user->id
             ]);
             //store system log
             $note = $agent->id . "=> " . $agent->full_name . " Admin created by " . Auth::guard('admin')->user()->name;
             $this->storeSystemLog($agent->id, 'admins', $note);
 
             DB::commit();
             return response()->json(['status' => true, 'msg' => 'A New Admin Added Successfully.!','url'=>url()->previous()]);
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
    // public function edit($dataId)
    // {
    //     $dataInfo=Agent::find($dataId);
    //     return view('admin.agent_edit',compact('dataInfo'));
    // }

    public function edit($dataId)
    {
        $dataInfo=Agent::with('user')->find($dataId);
        return view('admin.agent_edit',compact('dataInfo'));
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
                
            if(isset($request->old_password) && isset($dataInfo->password)){
                if (Hash::check($request->old_password, $dataInfo->password)) { 
                    $dataInfo->password=Hash::make($request->confirm_password);
                 } else {
                    return response()->json(['status'=>false ,'msg'=>'Password not matched!']);
                 }
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
                 'photo.image' => "uploaded file must be a valid image format.",
                 'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                 'photo.max' => "Image file can't be more than 2 MB.",
             ]);
 
             $agent = Agent::find($request->dataId);
             $agent->update([
                 'firstName' => $request->firstName,
                 'lastName' => $request->lastName,
             ]);
 
             $user = User::find($agent->user_id);
             $user->email = $request->email;
             $user->phone = $request->phone;
             if ($request->hasFile('photo')) {
                 $user->avatar = $this->uploadPhoto($request->file('photo'), 'User');
             }
             if ($request->filled('password')) {
                 $user->password = Hash::make($request->password);
             }
             $user->save();

             //store system log
             $note = $agent->id . "=> " . $agent->full_name . " Agent updated by " . Auth::guard('admin')->user()->name;
             $this->storeSystemLog($agent->id, 'admins', $note);
 
             return response()->json(['status' => true, 'msg' => 'Agent Updated Successfully.!','url'=>url()->previous()]);
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
            $user=User::find($dataInfo->user_id);
            $user->status=0;
          
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
            $user=User::find($dataInfo->user_id)->update(['status'=>$request->status,'updated_at'=>Carbon::now()]);

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
            dd($request->approved);
          User::find($dataInfo->user_id)->update(['is_approved'=>$request->status,'updated_at'=>Carbon::now()]);
          
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