<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Neighbor;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NeighbourCategory;
use Illuminate\Support\Facades\Auth;

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
            $query->wherewhere('name','like',request()->name.'%');
        }

        if(request()->filled('email'))
            $query->where('email','like',strtolower(trim(request()->email)).'%');

        if(request()->filled('phone'))
            $query->where('phone','like',strtolower(trim(request()->phone)).'%');
        
        $dataList=$query->latest()->paginate(10)->withQueryString();
        // dd($dataList);

        return view('admin.neighbour_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $neighbours= NeighbourCategory::whereNull('deleted_at')->get();
        return view('admin.neighbour_create',compact('neighbours'));
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
                'name' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7000',
            ],
            [
                'name.required' => "Please Enter First Name.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);

            $dataInfo=new Neighbor();

            $dataInfo->name=$request->name;

            $dataInfo->titleOne=$request->titleOne;

            $dataInfo->categoryId=$request->categoryId;
            
            $dataInfo->titleOneDetails=$request->titleOneDetails;

            $dataInfo->titleTwo=$request->titleTwo;

            $dataInfo->titleTwoDetails=$request->titleTwoDetails;

            $dataInfo->titleThree=$request->titleThree;

            $dataInfo->titleThreeDetails=$request->titleThreeDetails;
            
            if($request->hasFile('photo'))
                $dataInfo->photo=$this->uploadPhoto($request->file('photo'),'Neighbour');
            else
                $dataInfo->photo=config('app.url').'/images/defaultneighbour.png';
            
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
        $neighbours= NeighbourCategory::whereNull('deleted_at')->get();
        $dataInfo=Neighbor::find($dataId);
        // dd($dataId);
        return view('admin.neighbour_edit',compact('dataInfo','neighbours'));
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
        // dd($request->all());
        DB::beginTransaction();
        try{
            $request->validate([
                'name' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => "Please Enter First Name.",
                'photo.image' => "uploaded file must be a valid image format.",
                'photo.mimes' => "Supported Image Format are jpeg,png,gif,svg",
                'photo.max' => "Image file can't be more than 2 MB.",
            ]);


            $dataInfo=Neighbor::find($request->dataId);
            // dd($dataInfo);
            $dataInfo->name=$request->name;

            $dataInfo->titleOne=$request->titleOne;

            $dataInfo->categoryId=$request->categoryId;

            $dataInfo->titleOneDetails=$request->titleOneDetails;

            $dataInfo->titleTwo=$request->titleTwo;

            $dataInfo->titleTwoDetails=$request->titleTwoDetails;

            $dataInfo->titleThree=$request->titleThree;

            $dataInfo->titleThreeDetails=$request->titleThreeDetails;
            
            if($request->hasFile('photo'))
                $dataInfo->photo=$this->uploadPhoto($request->file('photo'),'Neighbour');
            
            $dataInfo->status=1;

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
