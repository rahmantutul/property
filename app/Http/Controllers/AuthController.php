<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
   public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'userName' => 'required',
            'password' => 'required|min:6'
        ],
        [
            'userName.required' => "Username can't be empty.Please Enter Your Username.",
            'password.required' => "Password can't be empty.Please Enter Your Password.",
            'password.min' => "Password must be at least 6 characters.",
        ]);
        // userName is email or phone & password is user password now check auth attempt
        $fieldType = filter_var($request->userName, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $auth = Auth::attempt([$fieldType => $request->userName, 'password' => $request->password]);

        if ($auth) {
            $user = Auth::user();
            if ($user->status == 1) {
                if ($user->is_approved == 1) {
                    if ($user->user_type == 1) {
                        $admin = Admin::where('user_id', $user->id)->first();
                        Auth::guard('admin')->login($admin);
                        return redirect()->route('admin.dashboard');
                    } elseif ($user->user_type == 2) {
                        $agent = Agent::where('user_id', $user->id)->first();
                        Auth::guard('agent')->login($agent);
                        return redirect()->route('agent.dashboard');
                    } elseif ($user->user_type == 3) {
                        $seller = Seller::where('user_id', $user->id)->first();
                        Auth::guard('seller')->login($seller);
                        return redirect()->route('seller.dashboard');
                    } elseif ($user->user_type == 4) {
                        $buyer = Buyer::where('user_id', $user->id)->first();
                        Auth::guard('buyer')->login($buyer);
                        return redirect()->route('buyer.dashboard');
                    }
                } else {
                    Session::flash('errMsg', "Account is waiting to be approved.");
                    return redirect()->back();
                }
            } else {
                Session::flash('errMsg', "Your ID Temporary Blocked.Please Try Again.");
                return redirect()->back();
            }
        } else {
            Session::flash('errMsg', "Wrong Password.Please Enter Valid Password.");
            return redirect()->back()->withInput();
        }
        
        
    }
    public function loginPage()
    {
        if(auth()->guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        elseif(auth()->guard('agent')->check()){
            return redirect()->route('agent.dashboard');
        }
        elseif(auth()->guard('buyer')->check()){
            return redirect()->route('buyer.dashboard');
        }
        elseif(auth()->guard('seller')->check()){
            return redirect()->route('seller.dashboard');
        }
        else{
            return view('frontend.login');
        }
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
        
            $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',
            ],
            [
            'firstName.required' => "Please Enter First Name.",
            'lastName.required' => "Please Enter Last Name.",
            'email.required' => "Please Enter User Email Address.",
            'phone.required' => "Please Enter User Phone No.",
            'photo.image' => "uploaded file must be a valid image format.",
            'password.required' => "Please Enter User Password.",
            'password.confirmed' => "Password and Confirm Password does not match.",
            ]);

            $user = new User();
            $user->email = strtolower(trim($request->email));
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            if($request->user_type === 'seller'){
                $dataInfo = new Seller();
                $user->user_type = 3;
                $user->is_approved = 1;
            }elseif($request->user_type === 'buyer'){
                $dataInfo = new Buyer();
                $user->user_type = 4;
                $user->is_approved = 1;
            }elseif($request->user_type === 'agent'){
                $dataInfo = new Agent();
                $user->user_type = 2;
                $user->is_approved = 0;
            }

            $user->save();
             
            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->user_id = $user->id;

            $dataInfo->save();
            DB::commit();
            Session::flash('msg',"Registration success!");
            return redirect()->route('front.login');
    }
}
