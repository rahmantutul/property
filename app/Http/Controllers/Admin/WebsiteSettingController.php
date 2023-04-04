<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Footer;
use App\Models\WebsiteInfo;
use App\Traits\SystemLogTrait;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Carbon;

class WebsiteSettingController extends Controller
{
    use SystemLogTrait;

    public function banner(){
        $dataInfo= Banner::first();
        return view('admin.banner_edit',compact('dataInfo'));
    }
    public function bannerupdate(Request $request){
        $dataInfo= Banner::first();

        if($request->hasFile('play_film_banner'))
                $dataInfo->play_film_banner=$this->uploadPhoto($request->file('play_film_banner'),'Banner');

        
        if($request->hasFile('search_banner'))
                $dataInfo->search_banner=$this->uploadPhoto($request->file('search_banner'),'Banner');

        
        if($request->hasFile('featured_banner'))
                $dataInfo->featured_banner=$this->uploadPhoto($request->file('featured_banner'),'Banner');

        
        if($request->hasFile('map_banner'))
                $dataInfo->map_banner=$this->uploadPhoto($request->file('map_banner'),'Banner');

        
        if($request->hasFile('neighbour_banner'))
                $dataInfo->neighbour_banner=$this->uploadPhoto($request->file('neighbour_banner'),'Banner');

        
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

    public function info(){
        $dataInfo= WebsiteInfo::first();
        return view('admin.info_edit',compact('dataInfo'));
    }
    public function infoupdate(Request $request){
        DB::beginTransaction();
       try{
        $request->validate([
            'facebook'=>'required',
            'websitename'=>'required',
            'linkedin'=>'required',
            'instagram'=>'required',
            'twitter'=>'required',
            'logo'=>'required|image|mimes:jpg,png,jpeg,svg',
            'email'=>'required',
            'phone'=>'required',
            'fax'=>'required',
            'location'=>'required',
            'copyright'=>'required',
            'disclaimer'=>'required',
        ]);
         $dataInfo= WebsiteInfo::first();
         $dataInfo->facebook=$request->facebook;
         $dataInfo->websitename=$request->websitename;
         $dataInfo->linkedin=$request->linkedin;
         $dataInfo->instagram=$request->instagram;
         $dataInfo->twitter=$request->twitter;
         $dataInfo->email=$request->email;
         $dataInfo->phone=$request->phone;
         $dataInfo->fax=$request->fax;
         $dataInfo->location=$request->location;
         $dataInfo->copyright=$request->copyright;
         $dataInfo->disclaimer=$request->disclaimer;
        if($request->hasFile('logo'))
            $dataInfo->logo=$this->uploadPhoto($request->file('logo'),'logo');
        else
            $dataInfo->avatar=env('APP_URL').'/images/logo.png';

        $dataInfo->created_at=Carbon::now();

        if($dataInfo->save()){
            $note= "Website info updated by".Auth::guard('admin')->user()->name;

            $this->storeSystemLog($dataInfo->id, 'websites_infos',$note);

            DB::commit();

            return response()->json(['status'=>true ,'msg'=>'Website Info udated Successfully.!','url'=>url()->previous()]);
        }else{
            DB::rollBack();

            return response()->json(['status'=>false ,'msg'=>'Failed To Add City.!']);
        }
         

       } catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('WebsiteInfoController','infoupdate',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
        }
    }
}
