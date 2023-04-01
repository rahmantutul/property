<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Seller;
use Carbon\Carbon;
use Auth;
use Hash;
use Session;
use DB;

class AuthController extends Controller
{
   public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'userName' => 'required',
            'password' => 'required'
        ],
        [
            'userName.required' => "Username can't be empty.Please Enter Your Username.",
            'password.required' => "Password can't be empty.Please Enter Your Password."
        ]);

        $adminInfo=Admin::whereNull('deleted_at')
        ->where(function($q) use($request){
            $q->where('email',strtolower(trim($request->userName)))
                ->orWhere('phone',$request->userName);
            })->first();

        $agentInfo=Agent::whereNull('deleted_at')
        ->where(function($q) use($request){
            $q->where('email',strtolower(trim($request->userName)))
                ->orWhere('phone',$request->userName);
            })->first();

        $buyerInfo=Buyer::whereNull('deleted_at')
        ->where(function($q) use($request){
            $q->where('email',strtolower(trim($request->userName)))
                ->orWhere('phone',$request->userName);
            })->first();

        $sellerInfo=Seller::whereNull('deleted_at')
        ->where(function($q) use($request){
            $q->where('email',strtolower(trim($request->userName)))
                ->orWhere('phone',$request->userName);
            })->first();

            if(!empty($sellerInfo)){

                if($sellerInfo->status!=1){
                    Session::flash('errMsg',"Your Id Temporary Blocked.Please Try Again.");
                    return redirect()->back();
                }
                if($sellerInfo->is_approved!=1){
                    Session::flash('errMsg',"Account is waiting to be approved.");
                    return redirect()->back();
                }
                if (Hash::check(request()->password, $sellerInfo->password)) {

                        Auth::guard('seller')->login($sellerInfo);

                        Session::flash('msg',"Logged In Successfully");
                        
                        return redirect()->route('seller.dashboard');
                    }
                    else{
                        
                        Session::flash('errMsg',"Wrong Password.Please Enter Valid Password.");
                        return redirect()->back()->withInput();
                    }
            }
            elseif(!empty($buyerInfo)){

                if($buyerInfo->status!=1){
                    Session::flash('errMsg',"Your Id Temporary Blocked.Please Try Again.");
                    return redirect()->back();
                }

                if (Hash::check(request()->password, $buyerInfo->password)) {

                        Auth::guard('buyer')->login($buyerInfo);

                        Session::flash('msg',"Logged In Successfully");
                        
                        return redirect()->route('buyer.dashboard');
                    }
                    else{
                        
                        Session::flash('errMsg',"Wrong Password.Please Enter Valid Password.");
                        return redirect()->back()->withInput();
                    }
            }
            elseif(!empty($agentInfo)){

                if($agentInfo->status!=1){
                    Session::flash('errMsg',"Your Id Temporary Blocked.Please Try Again.");
                    return redirect()->back();
                }

                if($agentInfo->is_approved != 1){
                    Session::flash('errMsg',"Account is waiting to be approved.");
                    return redirect()->back();
                }
                if (Hash::check(request()->password, $agentInfo->password)) {

                        Auth::guard('agent')->login($agentInfo);

                        Session::flash('msg',"Logged In Successfully");
                        
                        return redirect()->route('agent.dashboard');
                    }
                    else{
                        
                        Session::flash('errMsg',"Wrong Password.Please Enter Valid Password.");
                        return redirect()->back()->withInput();
                    }
            }
            elseif(!empty($buyerInfo)){

                if($buyerInfo->status!=1){
                    Session::flash('errMsg',"Your Id Temporary Blocked.Please Try Again.");
                    return redirect()->back();
                }
                if($buyerInfo->is_approved!=1){
                    Session::flash('errMsg',"Account is waiting to be approved.");
                    return redirect()->back();
                }

                if (Hash::check(request()->password, $buyerInfo->password)) {

                        Auth::guard('buyer')->login($buyerInfo);

                        Session::flash('msg',"Logged In Successfully");
                        
                        return redirect()->route('buyer.dashboard');
                    }
                    else{
                        
                        Session::flash('errMsg',"Wrong Password.Please Enter Valid Password.");
                        return redirect()->back()->withInput();
                    }
            }
            elseif(!empty($adminInfo)){

                if($adminInfo->status!=1){
                    Session::flash('errMsg',"Your Id Temporary Blocked.Please Try Again.");
                    return redirect()->back();
                }

                if (Hash::check(request()->password, $adminInfo->password)) {

                        Auth::guard('admin')->login($adminInfo);

                        Session::flash('msg',"Logged In Successfully");
                        
                        return redirect()->route('admin.dashboard');
                    }
                    else{
                        
                        Session::flash('errMsg',"Wrong Password.Please Enter Valid Password.");
                        return redirect()->back()->withInput();
                    }
            }
            else{
                
                Session::flash('errMsg',"Invalid Username.Please Enter Valid Username.");
                return redirect()->back()->withInput();
            }
        

    }
    public function loginPage()
    {
       if(auth()->guard('admin')->check())
            return redirect()->route('admin.dashboard');
        elseif(auth()->guard('agent')->check())
            return redirect()->route('agent.dashboard');
        elseif(auth()->guard('buyer')->check())
            return redirect()->route('buyer.dashboard');
        elseif(auth()->guard('seller')->check())
            return redirect()->route('seller.dashboard');
        else
            return view('frontend.login');
        
        // return view('login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('agent')->logout();
        Auth::guard('buyer')->logout();
        Auth::guard('seller')->logout();
        Session::flash('infoMsg',"Logged Out Successfully.");
        return redirect()->route('login');
    }


    public function registerUser(Request $request)
    {
        DB::beginTransaction();
        try{
             $request->validate([
                 'firstName' => 'required',
                 'lastName' => 'required',
                 'email' => 'required',
                 'phone' => 'required',
                 'password' => 'required',
             ],
             [
                 'firstName.required' => "Please Enter First Name.",
                 'lastName.required' => "Please Enter Last Name.",
                 'email.required' => "Please Enter User Email Address.",
                 'phone.required' => "Please Enter User Phone No.",
                 'photo.image' => "uploaded file must be a valid image format."
             ]);
             if($request->userType=='seller'){
                $dataInfo=new Seller();
             }elseif($request->userType=='buyer'){
                $dataInfo=new Buyer();
             }else{
                $dataInfo=new Agent();
             }
             
             $dataInfo->firstName=$request->firstName;
 
             $dataInfo->lastName=$request->lastName;
 
            
            $dataInfo->email=strtolower(trim($request->email));

              if($request->password == $request->confirmPassword){
                    $dataInfo->password=Hash::make($request->confirmPassword);
                }else{
                  Session::flash('errMsg',"Password did not match.");
              }

             $dataInfo->phone=$request->phone;
             
             if($request->hasFile('photo'))
                 $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'Users');
             else
                 $dataInfo->avatar=env('APP_URL').'/images/defaultUser.png';
             
             $dataInfo->status=2;
 
             $dataInfo->created_at=Carbon::now();
 
             if($dataInfo->save()){
                // dd($dataInfo);
                DB::commit();
                Session::flash('msg',"Registration success!");

                return redirect()->route('front.login');
                 
             }
             else{
                DB::rollBack();
                Session::flash('errMsg',"Failed To Registration.Please Try Again!");
                return redirect()->back();
             }
        }
         catch(Exception $err){
 
             DB::rollBack();
 
             $this->storeSystemError('AuthController','store',$err);
 
             DB::commit();


             Session::flash('errMsg',"Somethig went wrong!");
 
             return redirect()->back();
        }
    }
}
