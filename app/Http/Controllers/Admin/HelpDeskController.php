<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\HelpDesk;
use App\Models\HelpDeskDetails;
use Carbon\Carbon;
use Auth;
use DB;

class HelpDeskController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=HelpDesk::whereNull('deleted_at')->where('userType','!=',1)
                                        ->with('lastMessage','buyerInfo','sellerInfo','agentInfo','adminInfo');

        if(request()->filled('name')){
            $query->where(function($q){
                $q->whereHas('buyerInfo',function($buyerInfo){
                    $buyerInfo->where('firstName','like',request()->name.'%')
                                ->orWhere('lastName','like',request()->name.'%');
                });
                $q->orWhereHas('sellerInfo',function($buyerInfo){
                    $buyerInfo->where('firstName','like',request()->name.'%')
                                ->orWhere('lastName','like',request()->name.'%');
                }); 
                $q->orWhereHas('agentInfo',function($buyerInfo){
                    $buyerInfo->where('firstName','like',request()->name.'%')
                                ->orWhere('lastName','like',request()->name.'%');
                });
                $q->orWhere('subject','like',request()->name.'%');
            });
        }
        else{
            $query->whereYear('updated_at',date('Y'))->whereMonth('updated_at',date('m'));
        }

        $helpQueries=$query->orderBy('updated_at','DESC')->get();

        if(request()->filled('search'))
            return view('helpdesk.help_queries',compact('helpQueries'));

        return view('helpdesk.help_desk',compact('helpQueries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function messages()
    {
        $chats=HelpDeskDetails::with('adminInfo','agentInfo','buyerInfo','sellerInfo')
                        ->where('helpDeskId',request()->dataId)
                        ->whereNull('deleted_at')
                        ->orderBy('id','asc')
                        ->get();

        return view('helpdesk.chats',compact('chats'));
    }
    public function searchHelpQueryList()
    {
        $query=HelpDesk::whereNull('deleted_at')->where('userType','!=',1)
                                        ->with('lastMessage','buyerInfo','sellerInfo','agentInfo','adminInfo');

        if(request()->filled('name')){
            $query->where(function($q){
                $q->whereHas('buyerInfo',function($buyerInfo){
                    $buyerInfo->where('firstName','like',request()->name.'%')
                                ->orWhere('lastName','like',request()->name.'%');
                });
                $q->orWhereHas('sellerInfo',function($buyerInfo){
                    $buyerInfo->where('firstName','like',request()->name.'%')
                                ->orWhere('lastName','like',request()->name.'%');
                }); 
                $q->orWhereHas('agentInfo',function($buyerInfo){
                    $buyerInfo->where('firstName','like',request()->name.'%')
                                ->orWhere('lastName','like',request()->name.'%');
                });
            });
        }
        else{
            $query->whereYear('updated_at',date('Y'))->whereMonth('updated_at',date('m'));
        }

        $queryList=$query->get();

        return response()->json($queryList);
    }

    public function sendMessage(Request $request)
    {
        DB::beginTransaction();
       try{
            $request->validate([
                'message' => 'required',
                'dataId' => 'required',
            ],
            [
                'dataId.required' => "No query selected",
                'message.required' => "Please Write Message First",
            ]);

            $dataInfo=HelpDesk::find($request->dataId);

            if(empty($dataInfo))
                return response()->json([],403);

            $dataInfo->updated_at=Carbon::now();

            $helpDeskDetails=new HelpDeskDetails();

            $helpDeskDetails->userId=Auth::guard('admin')->user()->id;

            $helpDeskDetails->userType=1;

            $helpDeskDetails->helpDeskId=$request->dataId;

            $helpDeskDetails->message=$request->message;

            $helpDeskDetails->created_at=Carbon::now();

            if($dataInfo->save() && $helpDeskDetails->save()){

                DB::commit();

                return response()->json(["msg"=>'message has been sent successfully'],200);
            }
            else{

                 DB::rollBack();

                 return response()->json(["msg"=>'Failed to send message'],403);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('HelpDeskController','store',$err);

            DB::commit();

            return response()->json(["msg"=>'Something Went Wrong.'],500);
       }
    }
}
