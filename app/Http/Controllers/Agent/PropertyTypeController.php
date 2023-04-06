<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\PropertyType;
use Carbon\Carbon;
use Auth;
use DB;

class PropertyTypeController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=PropertyType::whereNull('deleted_at');
    
        if(request()->filled('type'))
            $query->where('type','like',request()->type.'%');

        $dataList=$query->paginate(100)->withQueryString();
        
        return view('admin.property_type_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.property_type_create');
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
                'type' => 'required',
            ],
            [
                'type.required' => "Please Write Property Type",
            ]);

            $dataInfo=new PropertyType();

            $dataInfo->type=$request->type;

            $dataInfo->status=1;

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> Property Type created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'property_types',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Property Type Added Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Property Type.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('PropertyTypeController','store',$err);

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
    public function edit($id)
    {
        $dataInfo=PropertyType::find($request->dataId);

        return view('admin.property_type_edit',compact('dataInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
       try{
            $request->validate([
                'dataId' => 'required',
                'type' => 'required',
            ],
            [
                'dataId.required' => "Request Has No Valid Property Type Id",
                'type.required' => "Please Write Property Type Name",
            ]);

            $dataInfo=GarageType::find($request->dataId);

            if(empty($dataInfo))
                return response()->json(['status'=>false ,'msg'=>'Requested Property Type Info Not Found!']);

            $dataInfo->type=$request->type;

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> Property Type Info Updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'property_types',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'Property Type Information Updated Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Property Type Information!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('PropertyTypeController','update',$err);

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
        
        $dataInfo=PropertyType::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=>Property Type info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'property_types',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'Property Type Info deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Delete  Property Type Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }
}