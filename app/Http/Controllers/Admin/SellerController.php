<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\Seller;
use Carbon\Carbon;
use Hash;
use Auth;
use DB;
use Session;
class SellerController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function editProfile()
    {
        $dataId= Auth::guard('seller')->user()->id;
        $dataInfo=Seller::find($dataId);
        return view('seller.seller_edit',compact('dataInfo'));
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
            $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'sellers');

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->firstName." Seller updated by ".Auth::guard('seller')->user()->firstName;

                $this->storeSystemLog($dataInfo->id, 'sellers',$note);

                DB::commit();
                return response()->json(['status'=>true ,'msg'=>'Seller Info Updated Successfully.!']);
                return redirect()->back();
            }
            else{

                 DB::rollBack();
                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Seller.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('SellerController','update',$err);

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
}