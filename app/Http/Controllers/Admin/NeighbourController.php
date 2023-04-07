<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Neighbor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\SystemLogTrait;

class NeighbourController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query= Neighbor::whereNull('deleted_at')->where('status','!=',0);
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
        
        $dataList=$query->latest()->paginate(50)->withQueryString();

        return view('admin.neighbour_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.neighbour_create');
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

            $dataInfo=new Neighbor();

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->email=strtolower(trim($request->email));

            $dataInfo->phone=$request->phone;
            
            if($request->hasFile('photo'))
                $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'Neighbour');
            else
                $dataInfo->avatar=config('app.url').'/images/defaultUser.png';
            
            $dataInfo->status=1;

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->fistName." Neighbour created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'neighbours',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Neighbour Added Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Neighbour.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('NeighbourController','store',$err);

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
        $dataInfo=Neighbor::find($dataId);
        // dd($dataId);
        return view('neighbour.neighbour_edit',compact('dataInfo'));
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


            $dataInfo=Neighbor::find($request->dataId);

            $dataInfo->firstName=$request->firstName;

            $dataInfo->lastName=$request->lastName;

            $dataInfo->email=strtolower(trim($request->email));

            $dataInfo->phone=$request->phone;
           if($request->hasFile('photo'))
            $dataInfo->avatar=$this->uploadPhoto($request->file('photo'),'admins');

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->full_name." Neighbour updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'neighbours',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Neighbour Info Updated Successfully.!','url'=>url()->previous()]);

            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Staff.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('NeighbourController','update',$err);

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
        
        $dataInfo=Neighbor::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Neighbour  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'neighbours',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Neighbour Info deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To delete Neighbour Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeStatus(Request $request){
        DB::beginTransaction();
        $dataInfo= Neighbor::find($request->dataId);
        if(!empty($dataInfo)){
            $dataInfo->status=$request->status;

            $dataInfo->updated_at=Carbon::now();
            if($dataInfo->save()){
                $note = $dataInfo->id. "=>" .$dataInfo->name . "Neighbour status changed by" . Auth::guard('admin')->user()->name;
                $this->storeSystemLog($dataInfo->id, 'neighbours' ,$note);
                DB::commit();
                return response()->json(['status'=>true, 'msg'=>"Neighbour status changed successfully!",'url'=>url()->previous()]);
            }else {
                DB::rollBack();
                return response()->json(['status'=>false ,'msg'=>'Failed To Change Status!']);
            }
        }else{
            return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }
}
