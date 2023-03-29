@extends('layouts.backends.master')
@section('title','Designation List')
@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Designation List</h2>
                
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm btn_modal" href="{{route('admin.role.create')}}">Add New</a>
        </div>
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
                    <div class="col-md-2 col-sm-12 form-group">
                        <strong>Name:</strong>
                        <input class="form-control" name="name" placeholder="Name" id="name">
                    </div>
                    <div class="col-md-2 col-sm-12 form-group">
                        <strong>Status:</strong>
                        <select class="form-control" name="status" id="status">
                            <option value="">Choose Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-12 form-group">
                        <strong></strong><br>
                         <button type="submit" class="btn-icon btn btn-primary btn-round btn-sm ">
                            <i data-feather='search'></i> 
                        </button>
                    </div>
                   </form>
                </div>
                <div class="table-responsive">
                @if(Browser::isDesktop())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl/No</th>
                                <th>Name (English)</th>
                                <th>Name (Bangla)</th>
                                
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{++$key}}</th>
                                <td>{{$dataInfo->name}}</td>
                                <td>{{$dataInfo->bnName}}</td>
                                
                                <td>
                                    <span class="badge badge-pill {{getStatusBadge($dataInfo->status)}}">{{getActiveInActiveStatus($dataInfo->status)}}</span>
                                </td>
                                <td>
                                    <a href="{{route('admin.role.status.change',['dataId'=>$dataInfo->id,'status'=>($dataInfo->status==1)?2:1])}}" class="btn btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} btn_status_change">
                                        {!!getStatusChangeIcon($dataInfo->status)!!}
                                    </a>
                                    <a href="{{route('admin.role.edit',[$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon btn_modal">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <a href="{{route('admin.role.delete',[$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete">
                                        <i data-feather='trash-2'></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <table class="table">
                        <tbody>
                            @foreach($dataList as $key=>$dataInfo)
                            <tr>
                                <th>Sl/No</th>
                                <th class="text-center">{{++$key}}</th>
                            </tr>
                            <tr>
                                <th>Name (English)</th>
                                <td>{{$dataInfo->name}}</td>
                            </tr>
                            <tr>
                                <th>Name (Bangla)</th>
                                <td>{{$dataInfo->bnName}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge badge-pill {{getStatusBadge($dataInfo->status)}}">{{getActiveInActiveStatus($dataInfo->status)}}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Actions</th>
                                <td>
                                    <a href="{{route('admin.role.status.change',['dataId'=>$dataInfo->id,'status'=>($dataInfo->status==1)?2:1])}}" class="btn btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} btn_status_change">
                                        {!!getStatusChangeIcon($dataInfo->status)!!}
                                    </a>
                                    <a href="{{route('admin.role.edit',[$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon btn_modal">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <a href="{{route('admin.role.delete',[$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete">
                                        <i data-feather='trash-2'></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        {!! $dataList->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
</div>
@endsection