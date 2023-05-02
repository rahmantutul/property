<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketActivity;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class MarketActivityController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=MarketActivity::whereNull('deleted_at');
    
        if(request()->filled('name'))
            $query->where('reportName','like',request()->name.'%');

        if(request()->filled('status'))
            $query->where('shareStatus',request()->status);
        if(isset(request()->user) && request()->user==1)
          $query->where('shareStatus',request()->user);

        $dataList=$query->paginate(100)->withQueryString();
        
        return view('admin.marketActivity_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marketActivity_create');
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
            'reportName' => 'required',
            'reportSubject' => 'required',
            'reportDetails' => 'required',
            'bannerImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'attachmentThree' => 'mimes:pdf|max:2048',
        ],
        [
            'reportName.required' => "Please Enter Report Name.",
            'reportSubject.required' => "Please Enter Report Subject.",
            'reportDetails.required' => "No report Details Given.",
        ]);

            $dataInfo=new MarketActivity();

            $dataInfo->reportName=$request->reportName;
            $dataInfo->reportSubject=$request->reportSubject;
            $dataInfo->reportSubject=$request->reportSubject;
            $dataInfo->reportDetails=$request->reportDetails;

            if($request->hasFile('bannerImage')){
                $dataInfo->bannerImage=$this->uploadPhoto($request->file('bannerImage'),'marketactivity');
            }else{
                $dataInfo->bannerImage=config('app.url').'/images/no_found.png';
            } 
            if($request->hasFile('image')){
                $dataInfo->image=$this->uploadPhoto($request->file('image'),'marketactivity');
            }else{
                $dataInfo->image=config('app.url').'/images/no_found.png';
            }  
            if($request->hasFile('attachmentThree')){
                $dataInfo->attachmentThree=$this->fileUpload($request->file('attachmentThree'),'marketactivity');
            }else{
                $dataInfo->attachmentThree=config('app.url').'/images/no_found.png';
            }

            $dataInfo->shareStatus=1;
            $dataInfo->created_by=Auth::guard('admin')->user()->firstName. ' ' .Auth::guard('admin')->user()->lastName;
            $dataInfo->created_at= Carbon::now();

            if($dataInfo->save()){

                $note=$dataInfo->id."=>Market activity created by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'market_activities',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>'A Market activity Added Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Market activity.!']);
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
        
        $dataInfo=MarketActivity::find($dataId);
        return view('admin.marketActivity_edit',compact('dataInfo'));
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
              'reportName' => 'required',
              'reportSubject' => 'required',
              'reportDetails' => 'required',
              'attachmentOne' => 'mimes:pdf|max:2048',
              'attachmentTwo' => 'mimes:pdf|max:2048',
              'attachmentThree' => 'mimes:pdf|max:2048',
          ],
          [
              'reportName.required' => "Please Enter Report Name.",
              'reportSubject.required' => "Please Enter Report Subject.",
              'reportDetails.required' => "No report Details Given.",
          ]);
              $dataId= $request->dataId;
              $dataInfo=MarketActivity::find($dataId);
  
            $dataInfo->reportName=$request->reportName;
            $dataInfo->reportSubject=$request->reportSubject;
            $dataInfo->reportSubject=$request->reportSubject;
            $dataInfo->reportDetails=$request->reportDetails;
            if($request->hasFile('bannerImage'))
                $dataInfo->bannerImage=$this->uploadPhoto($request->file('bannerImage'),'marketactivity');
                
            if($request->hasFile('image'))
                $dataInfo->image=$this->uploadPhoto($request->file('image'),'marketactivity');
                
            if($request->hasFile('attachmentThree'))
                $dataInfo->attachmentThree=$this->fileUpload($request->file('attachmentThree'),'marketactivity');


            $dataInfo->shareStatus=1;
            $dataInfo->created_by=Auth::guard('admin')->user()->name;
            $dataInfo->created_at= Carbon::now();
              if($dataInfo->save()){

  
                  $note=$dataInfo->id."=>Market activity edited by ".Auth::guard('admin')->user()->name;
  
                  $this->storeSystemLog($dataInfo->id, 'market_activities',$note);
  
                  DB::commit();
  
                  return response()->json(['status'=>true ,'msg'=>'A Market activity edited Successfully.!','url'=>url()->previous()]);
              }
              else{
  
                   DB::rollBack();
  
                   return response()->json(['status'=>false ,'msg'=>'Failed To edit Market activity.!']);
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
        
        $dataInfo=MarketActivity::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->shareStatus=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> Market Activity  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'market_activities',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Market Activity deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Delete Market Activity Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }
    public function changeStatus(Request $request)
    {

        DB::beginTransaction();
        
        $dataInfo=MarketActivity::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->shareStatus=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Market Activity Show Status changed by ".Auth::guard('admin')->user()->name;

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
