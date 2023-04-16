<?php

namespace App\Http\Controllers\Seller;

use App\Models\Property;
use App\Models\Transection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransectionController extends Controller
{
    public function index()
    {
        $properties = Property::with([
            'sellerInfo' => function ($q) {
                $q->select('id', 'user_id', 'firstName', 'lastName');
            },
        ])
            ->whereNotNull('sellerId')
            ->whereHas('sellerInfo', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->where('is_sold', 0)
            ->get();
        $transactions = Transection::with([
            'property' => function ($q) {
                $q->with([
                    'sellerInfo' => function ($q) {
                        $q->select('id', 'user_id', 'firstName', 'lastName');
                    },
                ])->whereNotNull('sellerId');
            },
        ])
            ->whereHas('property', function ($q) {
                $q->whereNotNull('sellerId');
            })
            ->whereHas('property.sellerInfo', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })
            ->whereNull('deleted_at')
            ->latest()
            ->paginate(10);


        return view('seller.transection_list', compact('transactions', 'properties'));
    }

    public function create()
    {
        return view('');
    }

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
            return redirect()->route('seller.transection.index')->with('success', 'Transaction created successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('seller.transection.index')->with('error', 'Transaction create failed.'.$th);
        }
    }

    public function show($id)
    {
        return view('');
    }

    public function edit($id)
    {
        return view('');
    }

    public function update(Request $request, $id)
    {
        return view('');
    }

    public function destroy($id)
    {
        return view('');
    }
}
