@extends('layouts.backends.master')
@section('title','Permission List')
@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Permission List</h2>
                
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm btn_modal" href="{{route('admin.permission.create')}}">Add New</a>
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
                    <div class="col-md-3 col-sm-6 form-group">
                        <strong>Name:</strong>
                        <input class="form-control" name="name" placeholder="Name" id="name">
                    </div>
                    <div class="col-md-3 col-sm-6 form-group">
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
                                <th class="text-center">Sl/No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Guard Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{++$key}}</th>
                                <td class="text-center">{{$dataInfo->name}}</td>
                                <td class="text-center">{{$dataInfo->guard_name}}</td>
                              

                                <td class="text-center">
                                   
                                    <a href="{{route('admin.permission.edit',[$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon btn_modal">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <a href="{{route('admin.permission.delete',[$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete">
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
                            <th class="text-center">Sl/No</th>
                            <th class="text-center">{{++$key}}</th>
                            </tr>
                            <tr>
                            <th class="text-center">Name</th>
                            <td class="text-center">{{$dataInfo->name}}</td>
                            </tr>
                            <tr>
                            <th class="text-center">Guard Name</th>
                            <td class="text-center">{{$dataInfo->guard_name}}</td>
                            </tr>
                            <tr>
                            <th class="text-center">Actions</th>
                            <td class="text-center">
                                
                                <a href="{{route('admin.permission.edit',[$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon btn_modal">
                                    <i data-feather='edit'></i>
                                </a>
                                <a href="{{route('admin.permission.delete',[$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete">
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