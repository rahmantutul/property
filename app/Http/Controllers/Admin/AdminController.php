<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Carbon\Carbon;
use Hash;
use Auth;
use DB;

class AdminController extends Controller
{
     use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $roles=Role::whereNull('deleted_at')->where('status',1)->get();
        
        $query=Admin::with('user')->whereNull('deleted_at')
        // dd($query);
        ->with('roleInfo')
        ->with('user',function($q){
            $q->where('status','==',0);
        });

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
        
        if(request()->roleId)
            $query->where('roleId',request()->roleId);

        if(request()->status)
            $query->where('status',request()->status);

        $dataList=$query->paginate(100)->withQueryString();
        
        return view('admin.admin_list',compact('dataList','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::whereNull('deleted_at')->where('status',1)->get();
        return view('admin.admin_create',compact('roles'));
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
                'roleId' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'bnName' => 'required',
            ],
            [
                'firstName.required' => "Please Enter First Name.",
                'lastName.required' => "Please Enter Last Name.",
                'roleId.required' => "Please Select User Designation.",
                'email.required' => "Please Enter User Email Address.",
                'phone.required' => "Please Enter User Phone No.",
                // 'bnName.required' => "Please Enter Staff Bengali Name.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);

            $dataInfo=new Admin();

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->roleId=$request->roleId;

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

                if($request->filled('roleId'))
                    $dataInfo->assignRole($request->roleId);

                $note=$dataInfo->id."=> ".$dataInfo->full_name." Admin created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'admins',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Admin Added Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Admin.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('AdminController','store',$err);

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
        $dataInfo=Admin::find($dataId);

        $roles=Role::whereNull('deleted_at')->where('status',1)->get();

        return view('admin.admin_edit',compact('dataInfo','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       DB::beginTransaction();
       try{
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'roleId' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'bnName' => 'required',
            ],
            [
                'firstName.required' => "Please Enter First Name.",
                'lastName.required' => "Please Enter Last Name.",
                'roleId.required' => "Please Select User Role.",
                'email.required' => "Please Enter User Email Address.",
                'phone.required' => "Please Enter User Phone No.",
                // 'bnName.required' => "Please Enter Staff Bengali Name.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);


            $dataInfo=Admin::find($request->dataId);

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->email=strtolower(trim($request->email));

            $dataInfo->phone=$request->phone;
            
            $dataInfo->roleId=$request->roleId;
                
            if($request->password)
                $dataInfo->password=Hash::make($request->password);

          if($request->hasFile('photo'))
            $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'admins');

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

            if($request->filled('roleId'))
                $dataInfo->syncRoles($request->roleId);

                $note=$dataInfo->id."=> ".$dataInfo->full_name." Admin updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'admins',$note);

                DB::commit();

                // return view('welcome');

                return response()->json(['status'=>true ,'msg'=>' Admin Info Updated Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Staff.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('AdminController','update',$err);

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
        
        $dataInfo=Admin::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Admin  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'admins',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Admin Info deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To delete Admin Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        $dataInfo=Admin::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->status=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Admin status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'admins',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Admin Status Changed Successfully.!','url'=>url()->previous()]);
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

                 $dataInfo=Admin::find($id);

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
     
                     $this->storeSystemLog($dataInfo->id, 'staff',$note);
     
                     // $dataInfo->syncPermissions($request->input('permission'));
     
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
     
                 $this->storeSystemError('AdminController','changepassword',$err);
     
                 DB::commit();
     
                 return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
            }
        }

       return view('admin.admin_password_change');

    }
}