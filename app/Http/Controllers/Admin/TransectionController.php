<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Property;
use App\Models\Transection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SystemLogTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\TransactionAgentMailJob;
use App\Mail\TransactionAgent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class TransectionController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transection::whereNull('deleted_at')->get();
        // dd($transactions);
        return view('admin.transection_list', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.transection_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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
        $dataInfo = Transection::find($dataId);
        return view('admin.transection_edit', compact('dataInfo'));
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
        $dataId= $request->dataId;
        $request->validate([
            'transection_id' => 'required|unique:transections,transaction_id,'.$dataId,
        ]);

        $dataInfo= Transection::find($dataId);
        $dataInfo->agent_id= $request->agentId;
        $dataInfo->property_id= 1;

        // if($request->state==1){
        // $dataInfo->transaction_id= 'AR-'.Carbon::now().'-'.uniqid();
        // }elseif($request->state==2){
        //     $dataInfo->transaction_id= 'OR-'.Carbon::now().'-'.uniqid();
        // }elseif($request->state==3){
        //     $dataInfo->transaction_id= 'WA-'.Carbon::now().'-'.uniqid();
        // }else{
        //     $dataInfo->transaction_id= 'OT-'.Carbon::now().'-'.uniqid();
        // }
        $dataInfo->transaction_id=$request->transection_id;
        $dataInfo->send_mail=$request->send_mail;
        $dataInfo->transection_type=$request->transection_type;
        $dataInfo->listing_price=$request->listing_price;
        $dataInfo->sold_price=$request->sold_price;
        $dataInfo->listing_date=$request->listing_date;
        $dataInfo->sold_date=$request->sold_date;
        $dataInfo->property_address=$request->property_address;
        $dataInfo->city=$request->city;
        $dataInfo->zip=$request->zip;
        $dataInfo->state=$request->state;
        $dataInfo->buyer_one_name=$request->buyer_one_name;
        $dataInfo->buyer_two_name=$request->buyer_two_name;
        $dataInfo->buyer_address=$request->buyer_address;
        $dataInfo->buyer_phone=$request->buyer_phone;
        $dataInfo->buyer_agent=$request->buyer_agent;
        $dataInfo->buyer_agent_email=$request->buyer_agent_email;
        $dataInfo->buyer_agent_phone=$request->buyer_agent_phone;
        $dataInfo->seller_one_name=$request->seller_one_name;
        $dataInfo->seller_two_name=$request->seller_two_name;
        $dataInfo->seller_address=$request->seller_address;
        $dataInfo->seller_phone=$request->seller_phone;
        $dataInfo->seller_agent=$request->seller_agent;
        $dataInfo->seller_agent_email=$request->seller_agent_email;
        $dataInfo->seller_agent_phone=$request->seller_agent_phone;
        $dataInfo->closing_title=$request->closing_title;
        $dataInfo->escrow_transection=$request->escrow_transection;
        $dataInfo->title_address=$request->title_address;
        $dataInfo->title_phone=$request->title_phone;
        $dataInfo->title_agent=$request->title_agent;
        $dataInfo->title_email=$request->title_email;
        $dataInfo->commission_amount=$request->commission_amount;
        $dataInfo->commission_type=$request->commission_type;
        $dataInfo->earnest_money=$request->earnest_money;
        $dataInfo->earnest_money_holder=$request->earnest_money_holder;
        $dataInfo->home_warrenty=$request->home_warrenty;
        $dataInfo->broker_note=$request->broker_note;
        $dataInfo->agent_note=$request->agent_note;
        $dataInfo->office_note=$request->office_note;
        $dataInfo->video_url=$request->video_url;
        $dataInfo->state=$request->state;
        if($request->hasFile('image'))
            $dataInfo->image=$this->uploadPhoto($request->file('image'),'transection');

        $dataInfo->save();
        return response()->json(['status'=>true ,'msg'=>'Transection Updated Successfully.!','url'=>url()->previous()]);
        // return redirect()->route('agent.transection.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transection::find($id)->delete();
        return response()->json(['status'=>true ,'msg'=>'Deleted Successfully!']);
    }

    

    public function mailSend($id)
    {
        $transaction = Transection::with('property')->find($id);

        // dd($transaction);

        Mail::to($transaction->title_email)->send(new TransactionAgent($transaction));
        Session::flash('msg','Mail Send Successfully.!');
        return redirect()->back();
        // return response()->json(['status'=>true ,'msg'=>' Mail Send Successfully.!','url'=>url()->previous()]);
    }

    public function mailview($id)
    {
        $transaction = Transection::with('property')->find($id);
        return view('admin.email',compact('transaction'));
    }

    public function changeApprove(Request $request)
    {
        DB::beginTransaction();

        $dataInfo=Transection::find($request->dataId);

        if(!empty($dataInfo)) {

            $dataInfo->update(['is_approved'=>$request->status,'updated_at'=>Carbon::now()]);
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Transection approved changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'transections',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Transection approved Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To approved!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }
}
