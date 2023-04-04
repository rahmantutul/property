<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Auth;
use DB;

class RoleController extends Controller
{
     use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=Role::whereNull('deleted_at');
        if(request()->filled('name')){
            $query->where(function($q){
                $q->where('name','like',request()->name.'%')
                ->orWhere('bnName','like',request()->name.'%');
            });
        }

        if(request()->status)
            $query->where('status',request()->status);

        $dataList=$query->paginate(100)->withQueryString();
    
        return view('admin.role_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        
        return view('admin.role_reate',compact('permission'));
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
                'name.required' => "Please Enter Role Name.",
            ]);

            $dataInfo=new Role();

            $dataInfo->name=$request->name;

            $dataInfo->guard_name='admin';
            
            $dataInfo->status=1;

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=> Role created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'roles',$note);

                $dataInfo->syncPermissions($request->input('permission'));

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Role Added Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Role.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('RoleController','store',$err);

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
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('admin.roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($dataId)
    {
        $dataInfo = Role::find($dataId);

        $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$dataId)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
            
          return view('admin.role_edit',compact('dataInfo','permission','rolePermissions'));
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
                'name.required' => "Please Enter Division Name.",
            ]);

            $dataInfo=Role::find($request->id);

            $dataInfo->name=$request->name;

            $dataInfo->bnName=$request->bnName;
            
            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=>  Roles updated by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'roles',$note);

                $dataInfo->syncPermissions($request->input('permission'));

                $users=Admin::whereNull('deleted_at')->where('roleId',$request->id)->get();
                foreach($users as $key=>$user)
                    $user->syncRoles($dataInfo->id);


                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A New Role Updated Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Role.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('RoleController','update',$err);

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
        
        $dataInfo=Role::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Role deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'roles',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Role deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To delete Role!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        $dataInfo=Role::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->status=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Role status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'roles',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Role Status Changed Successfully.!']);
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