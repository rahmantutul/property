<?php

namespace App\Http\Controllers\Agent;

use App\Models\Property;
use App\Models\Transection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Traits\SystemLogTrait;
use Illuminate\Support\Facades\Auth;
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

        $transactions = Transection::where('agent_id',Auth::guard('agent')->user()->id)->get();
        
        return view('agent.transection_list', compact('transactions'));
    }

    public function mailview($id)
    {
        $transaction = Transection::with('property')->findOrFail($id);
        return view('admin.email',compact('transaction'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('agent.transection_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'property_id' => 'required|numeric',
        //     'amount' => 'required',
        //     'transaction_date' => 'required|date',
        //     'transaction_location' => 'required',
        // ]);

            $dataInfo= new Transection();
            $dataInfo->agent_id= $request->agentId;
            $dataInfo->property_id= 1;

            if($request->state==1){
            $dataInfo->transaction_id= 'AR-'.Carbon::now()->toDateString().uniqid();
            }elseif($request->state==2){
                $dataInfo->transaction_id= 'OR-'.Carbon::now()->toDateString().uniqid();
            }elseif($request->state==3){
                $dataInfo->transaction_id= 'WA-'.Carbon::now()->toDateString().uniqid();
            }else{
                $dataInfo->transaction_id= 'OT-'.Carbon::now()->toDateString().uniqid();
            }
            $dataInfo->transection_type=$request->transection_type;
            $dataInfo->send_mail=$request->send_mail;
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
            else
                $dataInfo->image=config('app.url').'/images/no_found.png';

            $dataInfo->save();
            return response()->json(['status'=>true ,'msg'=>'Transection Created Successfully.!','url'=>url()->previous()]);
            // return redirect()->route('agent.transection.index')->with('success', 'Transaction created successfully.');
       
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
}
