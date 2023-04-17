@extends('layouts.backends.master')
@section('title', 'Transaction List')
@section('content')

    <div class="row mb-1">
        <div class="col-8">
            <h2 class="content-header-title float-left mb-0">Transaction List</h2>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <a class="btn-icon btn btn-primary btn-round btn-sm" href="{{route('agent.transection.create')}}">Add New</a>
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
                                    <th>Status</th>    
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $item)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ $item->transaction_id }}</td>
                                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y-m-d') }}
                                    </td>
                                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $item->sold_date)->format('Y-m-d') }}</td>
                                    <td>
                                        @if ($item->is_approved==1)
                                            <span class="badge badge-pill badge-success">Approve</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Unapproved</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_approved==1)
                                            <a href="#" class="badge badge-pill badge-success">Send Email</a>
                                        @else
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_approved==1)
                                        <a href="{{route('admin.transection.approve.change',['dataId'=>$item->id,'status'=>0])}}" class="btn btn-sm btn-icon btn-danger btn_status_change" title="Approve Transection">
                                            Block It
                                        </a>
                                        @else
                                        <a href="{{route('admin.transection.approve.change',['dataId'=>$item->id,'status'=>1])}}" class="btn btn-sm btn-icon btn-success btn_status_change" title="Approve Transection">
                                            Approve
                                        </a>
                                        @endif
                                        <a href="{{route('admin.transection.edit',['dataId'=>$item->id])}}" class="btn btn-warning btn-sm btn-icon " title="Edit">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <a href="{{route('admin.seller.delete',['dataId'=>$item->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($item->status)}} delete" title="Delete">
                                            <i data-feather='trash-2'></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
