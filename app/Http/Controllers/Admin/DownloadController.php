<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Downloads;
use App\Traits\SystemLogTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
class DownloadController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=Downloads::whereNull('deleted_at');
    
        if(request()->filled('name'))
            $query->where('name','like',request()->name.'%');

        if(request()->filled('status'))
            $query->where('shareStatus',request()->status);
        if(isset(request()->user) && request()->user==1)
          $query->where('shareStatus',request()->user);

        $dataList=$query->paginate(100)->withQueryString();
        
        return view('admin.downloads_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.downloads_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        $request->validate([
            'name' => 'required',
            'file' => '|mimes:pdf|max:2048',         
        ],
        [
            'name.required' => "Please Enter Report Name.",
        ]);

            $dataInfo=new Downloads();

            $dataInfo->name=$request->name;

            if($request->hasFile('file')){
                $dataInfo->file=$this->fileUpload($request->file('file'),'Downloads');
            }else{
                $dataInfo->file=config('app.url').'/images/no_found.png';
            }

            $dataInfo->shareStatus=1;
            $dataInfo->created_by=Auth::guard('admin')->user()->firstName;
            $dataInfo->created_at= Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=>Downloads created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'market_activities',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A Downloads Added Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Downloads.!']);
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
        
        $dataInfo=Downloads::find($dataId);
        return view('admin.Downloads_edit',compact('dataInfo'));
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
            //   'file' => 'mimes|pdf',
          ],
          [
              'name.required' => "Please Enter Report Name.",
          ]);

            $dataId= $request->dataId;
            $dataInfo=Downloads::find($dataId);
  
            $dataInfo->name=$request->name;
                
            if($request->hasFile('file'))
                $dataInfo->file=$this->fileUpload($request->file('file'),'Downloads');


            $dataInfo->shareStatus=1;
            $dataInfo->created_by=Auth::guard('admin')->user()->name;
            $dataInfo->created_at= Carbon::now();

              if($dataInfo->save()){

  
                  $note=$dataInfo->id."=>Downloads edited by ".Auth::guard('admin')->user()->name;
  
                  $this->storeSystemLog($dataInfo->id, 'market_activities',$note);
  
                  DB::commit();
  
                  return response()->json(['status'=>true ,'msg'=>'A Downloads edited Successfully.!','url'=>url()->previous()]);
              }
              else{
  
                   DB::rollBack();
  
                   return response()->json(['status'=>false ,'msg'=>'Failed To edit Downloads.!']);
              }
         }
          catch(Exception $err){
  
              DB::rollBack();
  
              $this->storeSystemError('aarketActivity','update',$err);
  
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
        
        $dataInfo=Downloads::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->shareStatus=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Downloads  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'market_activities',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Downloads deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Delete Downloads Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }
    public function changeStatus(Request $request)
    {

        DB::beginTransaction();
        
        $dataInfo=Downloads::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->shareStatus=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Downloads Show Status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'market_activities',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' City Status Changed Successfully.!','url'=>url()->previous()]);
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
