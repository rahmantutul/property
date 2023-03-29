<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\State;
use Carbon\Carbon;
use Auth;
use DB;

class StateController extends Controller
{
      use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=State::whereNull('deleted_at');
    
        if(request()->filled('name'))
            $query->where('name','like',request()->name.'%');

        $dataList=$query->paginate(100)->withQueryString();
        
        return view('admin.state_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.state_create');
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
            ],
            [
                'name.required' => "Please Write State Name",
            ]);

            $dataInfo=new State();

            $dataInfo->name=$request->name;

            $dataInfo->status=1;

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> State created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'states',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New State Added Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add State.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('StateController','store',$err);

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
        $dataInfo=State::find($dataId);

        return view('admin.state_edit',compact('dataInfo'));
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
                'name' => 'required',
            ],
            [
                'dataId.required' => "Request Has No Valid State Id",
                'name.required' => "Please Write State Name",
            ]);

            $dataInfo=State::find($request->dataId);

            if(empty($dataInfo))
                return response()->json(['status'=>false ,'msg'=>'Requested State Info Not Found!']);

            $dataInfo->name=$request->name;

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> State Info Updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'states',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'State Information Updated Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update State Information!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('StateController','update',$err);

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
        
        $dataInfo=State::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> State  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'states',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' State Info deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Delete State Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        
        $dataInfo=State::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->status=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." State status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'states',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' State Status Changed Successfully.!','url'=>url()->previous()]);
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