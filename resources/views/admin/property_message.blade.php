@extends('layouts.backends.master')
@section('title','Agent List')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Message List</h2>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                
                <div class="card-body">
                   <form action=""  method="get" class="row">
                    @csrf
                    <div class="col-md-2 col-sm-6 form-group">
                        <strong>Name:</strong>
                        <input class="form-control" name="name" placeholder="Name" value="{{request()->name}}">
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <strong>Phone:</strong>
                        <input class="form-control" name="phone" placeholder="phone" value="{{request()->phone}}">
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <strong>Email:</strong>
                        <input class="form-control" name="email" placeholder="email" value="{{request()->email}}">
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{++$key}}</th>
                                <td>{{$dataInfo->firstName}}</td>
                                <td>{{$dataInfo->email}}</td>
                                <td>{{$dataInfo->phone}}</td>
                                <td>{{Str::limit($dataInfo->message,70)}}</td>
                                <td>
                                    <a href="{{route('property.message.view',['dataId'=>$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon " title="View Details">
                                        <i data-feather='eye'></i>
                                    </a>
                                    <a href="{{route('property.message.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete" title="Delete">
                                        <i data-feather='trash-2'></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                       
                    </table>
                
                </div>
                <div class="row mt-1">
                    <div class="col-12 d-flex flex-row-reverse">
                         {!! $dataList->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
</div>
@endsection