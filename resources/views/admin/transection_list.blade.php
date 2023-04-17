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
                                        <td>{{$item?->property?->agentInfo?->firstName}}</td>
                                        <td>{{$item?->property?->title}}</td>
                                        <td>
                                            @if ($item->is_approved)
                                                <span class="badge badge-pill badge-success">Approve</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Unapproved</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->property->agentInfo)
                                                <a href="{{route('admin.transection.agent.mail', $item->transaction_id)}}" class="btn_status_change"><span class="badge badge-pill badge-success">Send</span></a>
                                            @endif
                                            {{-- <span class="badge badge-pill badge-warning">View</span> --}}
                                        </td>
                                        {{-- <td>
                                            <a href="" class="btn btn-sm btn-icon btn_status_change"
                                                title="Change Status">

                                            </a>
                                            <a href="javascript:void();" class="btn btn-warning btn-sm btn-icon"
                                                title="Edit">
                                                <i data-feather='edit'></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm btn-icon delete" title="Delete">
                                                <i data-feather='trash-2'></i>
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
