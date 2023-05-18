@extends('layouts.backends.master')
@section('title','Garage Type List')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Property Type List</h2>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm btn_modal" href="{{route('admin.type.create')}}">Add New</a>
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
                    <div class="col-md-2 col-sm-6 form-group">
                        <strong>Property Type:</strong>
                        <input class="form-control" name="name" placeholder="Amenity" value="{{request()->type}}">
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
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{++$key}}</th>
                                <td>{{$dataInfo->type}}</td>
                                <td>
                                    <span class="badge badge-pill {{getStatusBadge($dataInfo->status)}}">{{getActiveInActiveStatus($dataInfo->status)}}</span>
                                </td>
                                <td>
                                    <a href="{{route('admin.type.status.change',['dataId'=>$dataInfo->id,'status'=>($dataInfo->status==1)?2:1])}}" class="btn btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} btn_status_change" title="Change Status">
                                        {!!getStatusChangeIcon($dataInfo->status)!!}
                                    </a>
                                    <a href="{{route('admin.type.edit',['dataId'=>$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon btn_modal" title="Edit">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <a href="{{route('admin.type.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete" title="Delete">
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
