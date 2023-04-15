@extends('layouts.backends.master')
@section('title', 'Transaction List')
@section('content')

    <div class="row mb-1">
        <div class="col-8">
            <h2 class="content-header-title float-left mb-0">Transaction List</h2>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <a class="btn-icon btn btn-primary btn-round btn-sm" href="#" data-toggle="modal" data-target="#exampleModal">Add New</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Tables start -->
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form action="" method="get" class="row">
                            @csrf
                            <div class="col-md-2 col-sm-6 form-group">
                                <strong>Transaction ID:</strong>
                                <input class="form-control" name="name" placeholder="Transaction ID" value="">
                            </div>
                            <div class="col-md-1  form-group">
                                <strong></strong><br>
                                <button type="submit" class="btn-icon btn btn-primary btn-round btn-sm " title="Search">
                                    <i data-feather='search'></i>
                                </button>
                            </div>
                            <div class="col-md-1 form-group">
                                <strong></strong><br>
                                <button type="submit" class="btn-icon btn btn-warning btn-round btn-sm " title="Reset">
                                    <i data-feather='refresh-ccw'></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sl/No</th>
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                    <th>Property Title</th>
                                    <th>Approve</th>    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $item)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ $item->transaction_id }}</td>
                                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y-m-d') }}
                                    </td>
                                    <td>{{$item?->property?->title}}</td>
                                    <td>
                                        @if ($item->is_approved)
                                            <span class="badge badge-pill badge-success">Approve</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Unapproved</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Tables end -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Transaction Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('agent.transection.store')}}" method="POST" id="transaction">
                            @csrf
                            <div class="form-group">
                                <label>Property select</label>
                                <select class="form-control" name="property_id" required>
                                    <option value="">Please Select Property</option>
                                    @foreach ($properties as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Location select</label>
                                <select class="form-control" name="transaction_location" required>
                                    <option value="">Please Select Transaction Location</option>
                                    <option value="AR">Arizona</option>
                                    <option value="OR">Oregon</option>
                                    <option value="OT">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Amount</label>
                              <input type="number" class="form-control" name="amount" step="0.01" placeholder="54768435.73">
                            </div>
                            <div class="form-group">
                              <label>Transaction Date</label>
                              <input type="date" class="form-control" name="transaction_date">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="transaction" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
