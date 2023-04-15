<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use App\Models\Transection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transection::with(['property'=> function($q){
            return $q->with('agentInfo:id,user_id,firstName,lastName');
        }])->whereNull('deleted_at')->latest()->paginate(10);
        $properties = Property::whereNull('deleted_at')->where('status', 1)->where('is_sold', 0)->get();
        return view('admin.transection_list', compact('transactions', 'properties'));
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
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|numeric',
            'amount' => 'required',
            'transaction_date' => 'required|date',
            'transaction_location' => 'required',
        ]);

        try {
            Transection::create([
                // random transaction id create
                'transaction_id' => $request->transaction_location."-".uniqid()."-".time(),
                'property_id' => $request->property_id,
                'amount' => $request->amount,
                'date' => $request->transaction_date,
            ]);
            return redirect()->route('admin.transection.index')->with('success', 'Transaction created successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.transection.index')->with('error', 'Transaction create failed.'.$th);
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
        
    }
}
