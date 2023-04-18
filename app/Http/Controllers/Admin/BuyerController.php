<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BuyerController extends Controller
{
     use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $query=Buyer::with('user')->whereNull('deleted_at');
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
        
        
        $dataList=$query->with('user')->paginate(100)->withQueryString();
        return view('admin.buyer_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.buyer_create');
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
             ],
             [
                 'firstName.required' => "Please Enter First Name.",
                 'lastName.required' => "Please Enter Last Name.",
                 'email.required' => "Please Enter User Email Address.",
                 'phone.required' => "Please Enter User Phone No.",
                 'photo.image' => "uploaded file must be a valid image format.",
                 'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                 'photo.max' => "Image file can't be more than 2 MB.",
                 'password.required' => "Please Enter Password.",
             ]);
             $user = User::create([
                 'email' => strtolower(trim($request->email)),
                 'password' => Hash::make($request->password),
                 'phone' => $request->phone,
                 'user_type' => 4,
                 'status' => 1,
                 'avatar' => ($request->hasFile('photo'))?$this->uploadPhoto($request->file('photo'), 'User'):config('app.url').'/images/defaultUser.png',
                 'is_approved' => 1
             ]);
 
             $buyer = Buyer::create([
                 'firstName' => $request->firstName,
                 'lastName' => $request->lastName,
                 'user_id' => $user->id
             ]);

             //store system log
             $note = $buyer->id . "=> " . $buyer->full_name . " Admin created by " . Auth::guard('admin')->user()->name;
             $this->storeSystemLog($buyer->id, 'admins', $note);
 
             DB::commit();
             return response()->json(['status' => true, 'msg' => 'A New Buyer Added Successfully.!','url'=>url()->previous()]);
         } 
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('AgentController','store',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
       }
        
    }

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
        $dataInfo=Buyer::find($dataId);
        return view('admin.buyer_edit',compact('dataInfo'));
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


            $dataInfo=Buyer::find($request->dataId);

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->email=strtolower(trim($request->email));

            $dataInfo->phone=$request->phone;
                
            if($request->password)
                $dataInfo->password=Hash::make($request->password);

          if($request->hasFile('photo'))
            $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'Buyers');

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->full_name." Buyer updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'Buyers',$note);

                DB::commit();

                // return view('welcome');

                return response()->json(['status'=>true ,'msg'=>' Buyer Info Updated Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Buyer.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('BuyerController','update',$err);

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
        
        $dataInfo=Buyer::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Buyer  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'Buyers',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Buyer Info deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To delete Buyer Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        $dataInfo=Buyer::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->status=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Buyer status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'Buyers',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Buyer Status Changed Successfully.!','url'=>url()->previous()]);
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
        $dataInfo=Buyer::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->is_approved=1;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Buyer approved changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'agents',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Buyer approved Successfully.!','url'=>url()->previous()]);
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

                 $dataInfo=Buyer::find($id);

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
     
                     $this->storeSystemLog($dataInfo->id, 'buyer',$note);
     
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
     
                 $this->storeSystemError('BuyerController','changepassword',$err);
     
                 DB::commit();
     
                 return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
            }
        }

       return view('admin.buyer_password_change');

    }

   public function editProfile(){
    $id= Auth::user()->id;
    $dataInfo= Buyer::with('user')->where('user_id',$id)->first();
    // dd($dataInfo);
    return view('buyer.buyer_edit',compact('dataInfo'));
   }



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


            $dataInfo=Buyer::find($request->dataId);

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

            if($request->filled('old_password') && $request->filled('confirm_password') ){
                if (Hash::check($request->old_password, $user->password)) { 
                    $user->password=Hash::make($request->confirm_password);
                } else {
                    Session::flash('errMsg','Password not matched!!');
                    return redirect()->back();
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



}