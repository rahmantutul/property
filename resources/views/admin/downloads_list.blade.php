@extends('layouts.backends.master')
@section('title','Transection List')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Downloads File</h2>
    </div>
    @if(!isset(request()->user))
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm btn_modal" href="{{ route('admin.downloads.create') }}">Add New</a>
        </div>
    </div>
    @endif
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
                        <strong>File NAME:</strong>
                        <input class="form-control" name="name" placeholder="REPORT NAME" value="{{request()->name}}">
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <strong>SHOW STATUS:</strong>
                        <select name="status" id="status" class="form-control">
                            <option for="status" value="1">Showed</option>
                            <option value="0">Not Showed</option>
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
                                <th>Report Name</th>
                                <th>File</th>
                                @if(!isset(request()->user))
                                <th>Available Status</th>
                                @endif
                                @if(!isset(request()->user))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{ $key+1 }}</th>
                                <td>{{ $dataInfo->name }}</td>
                                <td class="text-center">
                                    @if (!is_null($dataInfo->file))
                                    <a class="btn btn-sm btn-info" href="{{ $dataInfo->file }}" download target="__blank">Download</a>
                                    @else
                                     N/A
                                    @endif
                                </td>
                                @if(!isset(request()->user))
                                <td>
                                    <span class="badge badge-pill {{getShareStatusBadge($dataInfo->shareStatus)}}">{{getShowStatus($dataInfo->shareStatus)}}</span>
                                </td>
                                @endif
                                @if(!isset(request()->user))
                                <td class="text-center">
                                    
                                    <a href="{{route('admin.downloads.status.change',['dataId'=>$dataInfo->id,'status'=>($dataInfo->shareStatus==0)?1:0])}}" class="btn btn-sm btn-icon {{getShowStatusChangeBtn($dataInfo->shareStatus)}} btn_status_change" title="Change Status">
                                        {!!getShowStatusChangeIcon($dataInfo->shareStatus)!!}
                                    </a>

                                    <a href="{{route('admin.downloads.edit',['dataId'=>$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon  btn_modal" title="Edit">
                                        <i data-feather='edit'></i>
                                    </a>

                                    <a href="{{route('admin.downloads.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete" title="Delete">
                                        <i data-feather='trash-2'></i>
                                    </a>
                                    
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            
                        </tbody>
                       
                    </table>
                
                </div>
                
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
</div>
@endsection

