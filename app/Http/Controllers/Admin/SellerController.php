<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataList=Seller::with('user')->whereNull('deleted_at')->paginate(10);
        // dd($query->get());
        return view('admin.seller_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seller_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try{
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|unique:users',
                'phone' => 'required|unique:users',
                'password' => 'required|min:6',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'firstName.required' => "Please Enter First Name.",
                'lastName.required' => "Please Enter Last Name.",
                'email.required' => "Please Enter User Email Address.",
                'email.unique' => "This Email Address is already taken.",
                'phone.required' => "Please Enter User Phone No.",
                'phone.unique' => "This Phone No is already taken.",
                'password.required' => "Please Enter User Password.",
                'password.min' => "Password must be at least 6 characters.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);

            $user = new User();
            $user->email = strtolower(trim($request->email));
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->avatar = ($request->hasFile('photo'))?$this->uploadPhoto($request->file('photo'), 'User'):config('app.url').'/images/defaultUser.png';
            $user->user_type = 3;
            $user->status = 1;
            $user->is_approved = 1;
            $user->save();

            $seller = new Seller();
            $seller->user_id = $user->id;
            $seller->firstName = $request->firstName;
            $seller->lastName = $request->lastName;
            $seller->save();
            
           //store system log
           $note = $seller->id . "=> " . $seller->full_name . " Admin created by " . Auth::guard('admin')->user()->name;
           $this->storeSystemLog($seller->id, 'admins', $note);
            DB::commit();
            return response()->json(['status' => true, 'msg' => 'A New Seller Added Successfully.!','url'=>url()->previous()]);
        }catch(\Exception $err){
            DB::rollback();

            $this->storeSystemError('AgentController','store',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!'.$err]);
        }
    }

    public function editProfile(){
        $id= Auth::user()->id;
        $dataInfo= Seller::with('user')->where('user_id',$id)->first();
        // dd($dataInfo);
        return view('seller.seller_edit',compact('dataInfo'));
    }
    

    /**
     * 
     * edit page for admin seller edit
     */
    public function edit($id)
    {
        $dataInfo=Seller::find($id);
        return view('admin.seller_edit',compact('dataInfo'));
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
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'confirm_password' => 'confirmed|max:8|different:old_password',
            ],
            [
                'firstName.required' => "Please Enter First Name.",
                'lastName.required' => "Please Enter Last Name.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);


            $dataInfo=Seller::find($request->dataId);

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->fax=$request->fax;

            $dataInfo->facebook=$request->facebook;

            $dataInfo->linkedin=$request->linkedin;

            $dataInfo->skype=$request->skype;

            $dataInfo->about=$request->linkedin;

            $dataInfo->license=$request->license;

            $dataInfo->address=$request->address;

            if($dataInfo->save()){
            $user= User::find(Auth::user()->id);

            $user->phone = $request->phone;

            if(isset($request->old_password) && isset($dataInfo->password)){
                if (Hash::check($request->old_password, $user->password)) { 
                    $user->password=Hash::make($request->confirm_password);
                } else {
                    return response()->json(['status'=>false ,'msg'=>'Password not matched!']);
                }
            }
            if($request->hasFile('photo')){
                $user->avatar=$this->uploadPhoto($request->file('photo'),'buyers');
            }
            $dataInfo->updated_at=Carbon::now();
            $user->save();
            
            Session::flash('msg','Profile Updated Successfully.!');
            return redirect()->back();

            }
            
    }

    //update seller
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

            $dataInfo=Seller::find($request->dataId);

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->save();

            $user = User::find($dataInfo->id);
            $user->email = strtolower(trim($request->email));
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            
            //store system log
            $note = $dataInfo->id . "=> " . $dataInfo->full_name . " Admin created by " . Auth::guard('admin')->user()->name;
            $this->storeSystemLog($dataInfo->id, 'admins', $note);
            DB::commit();
            
            return response()->json(['status'=>true ,'msg'=>'Seller Info Updated Successfully.!']);
            return redirect()->back();



        }catch(Exception $err){
            DB::rollBack();

            $this->storeSystemError('SellerController','update',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!'.$err]);
        }
    }

            




    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    
    
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

                 $id= Auth::guard('seller')->user()->id;

                 $dataInfo=Seller::find($id);

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
     
                     $note=$dataInfo->id."=> Password changed by ".Auth::guard('seller')->user()->name;
     
                     $this->storeSystemLog($dataInfo->id, 'seller',$note);
     
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
     
                 $this->storeSystemError('SellerController','changepassword',$err);
     
                 DB::commit();
     
                 return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
            }
        }

       return view('seller.seller_password_change');

    }

    //destroy seller
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $dataInfo=Seller::find($id);
            //delete also user table data
            $user=User::where('id',$dataInfo->user_id)->first();
            $user->delete();
            $dataInfo->delete();
            $note=$dataInfo->id."=> ".$dataInfo->firstName." Seller deleted by ".Auth::guard('admin')->user()->firstName;
            $this->storeSystemLog($dataInfo->id, 'sellers',$note);
            DB::commit();
            return response()->json(['status'=>true ,'msg'=>'Seller Deleted Successfully.!']);
        }
        catch(Exception $err){
            DB::rollBack();
            $this->storeSystemError('SellerController','destroy',$err);
            DB::commit();
            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
        }
    }
}