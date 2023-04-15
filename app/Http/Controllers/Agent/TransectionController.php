<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Transection;
use Illuminate\Http\Request;

class TransectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transection::with(['property'
                                    => function($q) {
                                        $q->with(['agentInfo' => function($q){
                                            $q->select('id', 'user_id', 'firstName', 'lastName');
                                        }])
                                            ->whereNotNull('agentId');
                                    }    
                                ])
                                ->whereHas('property', function($q) {
                                    $q->whereNotNull('agentId');
                                })
                                ->whereHas('property.agentInfo', function($q) {
                                    $q->where('user_id', auth()->user()->id);
                                })
                                ->whereNull('deleted_at')
                                ->latest()
                                ->paginate(10);

        return view('agent.transection_list', compact('transaction'));
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
}
