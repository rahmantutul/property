@extends('layouts.backends.master')
@section('title','Property List')
@push('css')
    <style>
        .table th, .table td{
            padding: 7px !important;
        }
    </style>
@endpush
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0 ">Saved Property List</h2>
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
                        <strong>Title:</strong>
                        <input class="form-control" name="titile" placeholder="titile" value="{{request()->titile}}">
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
                                <th class="text-center">Sl/No</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Available<br>Date</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Agent/<br>Seller</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{++$key}}</th>
                                <td>
                                    <img src="{{getImage($dataInfo->property?->thumbnail)}}" alt="{{$dataInfo->property?->title}}" height="50" width="50" style="border-radius: 50%;border: 1px solid green;">
                                </td>
                                <td>{{$dataInfo->property?->title}}</td>
                                <td>{{(!is_null($dataInfo->property?->expireDate)) ?formatDate($dataInfo->property?->expireDate):''}}</td>
                                <td>
                                	Price: <strong>{{$dataInfo->property?->price}}</strong><br>
                                	Orginal Price: <strong>{{$dataInfo->property?->orginalPrice}}</strong>
                                </td>
                                <td class="text-center">
                                    @if($dataInfo->user?->user_type==1)
                                        <span class="badge badge-info">Admin</span>
                                    @elseif($dataInfo->user?->user_type==2)
                                        <span class="badge badge-info">Agent</span>
                                    @elseif($dataInfo->user?->user_type==3)
                                        <span class="badge badge-info">Seller</span>
                                    @else
                                        <span class="badge badge-info">Buyer</span>
                                    @endif
                                	
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill {{getStatusBadge($dataInfo->property?->status)}}">{{getActiveInActiveStatus($dataInfo->property?->status)}}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('marketActivity.details',['dataId'=>$dataInfo->property?->id])}}" class="btn btn-info btn-sm btn-icon" title="Show Details">
                                        <i data-feather='eye'></i>
                                    </a> <br>
                                    <span class="badge" style="background: #140c38;">See Details</span>
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