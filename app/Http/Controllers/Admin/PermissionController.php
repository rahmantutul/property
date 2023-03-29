<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
// use App\Models\Role;
use App\Models\Permission;
// use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Auth;
use DB;

class PermissionController extends Controller
{
     use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=Permission::whereNull('deleted_at');

        if(request()->filled('name')){
            $query->where(function($q){
                $q->where('name','like',request()->name.'%')
                ->orWhere('guard_name','like',request()->name.'%');
            });
        }

        if(request()->status)
            $query->where('status',request()->status);

        $dataList=$query->orderBy('name','asc')->paginate(100)->withQueryString();
        
        return view('admin.permission_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission_create');
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
                'name.required' => "Please Enter Permission Name.",
            ]);

            $dataInfo=new Permission();

            $dataInfo->name=$request->name;

            $dataInfo->guard_name='admin'; //$request->guard_name;
            
            $dataInfo->status=1;

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=>Permission created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'Permissions',$note);

                // $dataInfo->syncPermissions($request->input('permission'));

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Permission Added Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add permission.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('PermissionController','store',$err);

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
        $dataInfo=Permission::find($dataId);

        return view('admin.permission_edit',compact('dataInfo'));

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
                'name' => 'required',
            ],
            [
                'name.required' => "Please Enter Permission Name.",
            ]);

            $dataInfo=Permission::find($request->dataId);

            $dataInfo->name=$request->name;

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=>  Permissions updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'permissions',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Permission Updated Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update permission.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('PermissionController','update',$err);

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
        
        $dataInfo=Permission::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=>  Permission deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'Permissions',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Permission deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To delete Permission!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        $dataInfo=Permission::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->status=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Permission status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'Permissions',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Permission Status Changed Successfully.!']);
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
    public function property(){
        return view('property.create');
    }
}