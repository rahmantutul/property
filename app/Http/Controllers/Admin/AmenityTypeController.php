<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\AmenityType;
use Carbon\Carbon;
use Auth;
use DB;

class AmenityTypeController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=AmenityType::whereNull('deleted_at');
    
        if(request()->filled('amenity'))

            $query->where('amenity','like',request()->amenity.'%');

        if(request()->filled('amenityType'))
            $query->where('amenityType',request()->amenityType);

        $dataList=$query->paginate(100)->withQueryString();
        
        return view('admin.amenity_type_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenity_type_create');
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
                'amenity' => 'required',
                'amenityType' => 'required',
            ],
            [
                'aminety.required' => "Please Write Amenity ",

                'aminety.required' => "Please Select Amenity Type",
            ]);

            $dataInfo=new AmenityType();

            $dataInfo->amenity=$request->amenity;

            $dataInfo->amenityType=$request->amenityType;

            $dataInfo->status=1;

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> Aminety Type created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'admins',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Aminety Type Added Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Aminety Type.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('AmenityTypeController','store',$err);

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

    public function edit($dataId){

        $dataInfo=AmenityType::find($dataId);

        return view('admin.amenity_type_edit',compact('dataInfo'));
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
                'dataId' => 'required',
                'amenity' => 'required',
                'amenityType' => 'required',
            ],
            [
                'dataId.required' => "Request Has No Valid Amenity Id",
                'amenity.required' => "Please Write Amenity ",
                'amenityType.required' => "Please Select Amenity Type",

            ]);

            $dataInfo=AmenityType::find($request->dataId);

            if(empty($dataInfo))
                return response()->json(['status'=>false ,'msg'=>'Requested Aminety Type Not Found!']);

            $dataInfo->amenity=$request->amenity;

            $dataInfo->amenityType=$request->amenityType;

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> Aminety Type Updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'amenity_types',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'Aminety Type Updated Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Aminety Type.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('AmenityTypeController','update',$err);

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
        
        $dataInfo=AmenityType::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Amenity Type  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'amenity_types',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Amenity Type Info deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Delete Amenity Type Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        
        $dataInfo=AmenityType::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->status=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Amenity Types status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'amenity_types',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Amenity Types Status Changed Successfully.!','url'=>url()->previous()]);
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

}
