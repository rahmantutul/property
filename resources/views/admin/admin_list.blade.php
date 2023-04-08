@extends('layouts.backends.master')
@section('title','Admin List')
@push('css')
    <style>
        .table th, .table td{
            padding: 0px !important;
        }
    </style>
@endpush
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Admin List</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{route('admin.admin.create')}}">Add New</a>
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
                    <div class="col-md-2 col-sm-6 form-group">
                        <strong>Role:</strong>
                        <select class="form-control" name="roleId" >
                                <option value="">Choose A Role</option>
                            @foreach($roles as $key=>$roleInfo)
                                <option value="{{$roleInfo->id}}" {{(request()->roleId==$roleInfo->id)?'selected':''}}>{{$roleInfo->name}}</option>
                            @endforeach
                        </select>
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
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{++$key}}</th>
                                <td>
                                    <img src="{{getUserImage($dataInfo->user->avatar)}}" alt="{{$dataInfo->name}}" height="50" width="50" style="border-radius: 50%;border: 1px solid green;">
                                </td>
                                <td>{{$dataInfo->full_name}}</td>

                                <td>{{$dataInfo?->user?->email}}</td>
                                
                                <td>{{$dataInfo?->user?->phone}}</td>
                                <td>
                                     <span class="badge badge-pill badge-info text-dark">
                                        {{$dataInfo->roleInfo->name}}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-pill {{getStatusBadge($dataInfo?->user?->status)}}">{{getActiveInActiveStatus($dataInfo?->user?->status)}}</span>
                                </td>
                                <td>
                                    <a href="{{route('admin.admin.status.change',['dataId'=>$dataInfo->id,'status'=>($dataInfo?->user?->status==1)?2:1])}}" class="btn btn-sm btn-icon {{getStatusChangeBtn($dataInfo?->user?->status)}} btn_status_change" title="Change Status">
                                        {!!getStatusChangeIcon($dataInfo?->user?->status)!!}
                                    </a>
                                    <a href="{{route('admin.admin.edit',['dataId'=>$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon " title="Edit">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <a href="{{route('admin.admin.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo?->user?->status)}} delete" title="Delete">
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