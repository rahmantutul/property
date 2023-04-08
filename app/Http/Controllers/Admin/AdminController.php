<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        ->with('roleInfo');

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
                'password' => 'required',
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
                'password.required' => "Please Enter Password.",
            ]);
            //Admin create with user table
            $user = User::create([
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'user_type' => 1,
                'status' => 1,
                'avatar' => ($request->hasFile('photo'))?$this->uploadPhoto($request->file('photo'), 'User'):config('app.url').'/images/defaultUser.png',
                'is_approved' => 1
            ]);

            $admin = Admin::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'roleId' => $request->roleId,
                'user_id' => $user->id
            ]);
            if ($request->filled('roleId')) {
                $admin->assignRole($request->roleId);
            }
            //store system log
            $note = $admin->id . "=> " . $admin->full_name . " Admin created by " . Auth::guard('admin')->user()->name;
            $this->storeSystemLog($admin->id, 'admins', $note);

            DB::commit();
            return response()->json(['status' => true, 'msg' => 'A New Admin Added Successfully.!','url'=>url()->previous()]);
        } catch (Exception $err) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => 'Failed To Add Admin.!'.$err]);
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

            $admin = Admin::find($request->dataId);
            $admin->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'roleId' => $request->roleId,
            ]);

            $user = User::find($admin->user_id);
            $user->email = $request->email;
            $user->phone = $request->phone;
            if ($request->hasFile('photo')) {
                $user->avatar = $this->uploadPhoto($request->file('photo'), 'User');
            }
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            
            if ($request->filled('roleId')) {
                $admin->assignRole($request->roleId);
            }
            //store system log
            $note = $admin->id . "=> " . $admin->full_name . " Admin updated by " . Auth::guard('admin')->user()->name;
            $this->storeSystemLog($admin->id, 'admins', $note);

            DB::commit();
            return response()->json(['status' => true, 'msg' => 'Admin Updated Successfully.!','url'=>url()->previous()]);
        } catch (Exception $err) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => 'Failed To Update Admin.!'.$err]);
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