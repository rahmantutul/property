@extends('layouts.backends.master')
@section('title','Property List')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Property List</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{route('agent.property.create')}}">Add New Property</a>
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
                        <input class="form-control" name="titile" placeholder="titile" value="{{request()->title}}">
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
                                <th class="text-center">MLS ID</th>
                                <th class="text-center">Available<br>Date</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Agent/<br>Seller</th>
                                <th class="text-center">Featured</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{++$key}}</th>
                                <td>
                                    <img src="{{getImage($dataInfo->thumbail)}}" alt="{{$dataInfo->title}}" height="50" width="50" style="border-radius: 50%;border: 1px solid green;">
                                </td>
                                <td>{{$dataInfo->title}}</td>
                                <td>{{$dataInfo->mlsId}}</td>
                                <td>{{(!is_null($dataInfo->expireDate)) ?formatDate($dataInfo->expireDate):''}}</td>
                                <td>
                                	Price: <strong>{{$dataInfo->price}}</strong><br>
                                	Orginal Price: <strong>{{$dataInfo->orginalPrice}}</strong>
                                </td>
                                <td>
                                @php 
                                	if(!is_null($dataInfo->agentInfo))
                                		echo $dataInfo->agentInfo->full_name;

                                	if(!is_null($dataInfo->sellerInfo))
                                		echo $dataInfo->sellerInfo->full_name;

                                	if(!is_null($dataInfo->buyerInfo))
                                		echo $dataInfo->buyerInfo->full_name;
                                @endphp
                                </td>
                                <td>
                                    @if ($dataInfo->is_featured==0 || $dataInfo->is_featured==1)
                                    <a href="{{route('agent.property.feature.change',['dataId'=>$dataInfo->id,'is_featured'=>($dataInfo->is_featured==0)?1:0])}}" class="btn {{getFeatureClass($dataInfo->is_featured)}} btn-sm btn-icon btn_status_change" title="Change Feature Status">
                                            @if ($dataInfo->is_featured==0)
                                            <i data-feather='check'></i>
                                            @else
                                            <i data-feather='x'></i>
                                            @endif
                                    </a>
                                    @endif
                                    <span class="badge badge-pill {{getFeatureBadge($dataInfo->is_featured)}}">{{getActiveInFeatureStatus($dataInfo->is_featured)}}</span><br>
                                    
                                </td>
                                <td>
                                    
                                    @if (isset(request()->is_featured))
                                        <a href="{{route('agent.property.feature.change',['dataId'=>$dataInfo->id,'is_featured'=>($dataInfo->is_featured==0)?1:0])}}" class="btn btn-danger btn-sm btn-icon btn_status_change" title="Remove">
                                            @if ($dataInfo->is_featured==0)
                                             <i data-feather='check'></i>
                                            @else
                                             <i data-feather='x'></i>
                                            @endif
                                        </a>
                                    @else
                                    <a href="{{route('agent.property.status.change',['dataId'=>$dataInfo->id,'status'=>($dataInfo->status==1)?2:1])}}" class="btn btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} btn_status_change" title="Change Status">
                                        {!!getStatusChangeIcon($dataInfo->status)!!}
                                    </a>
                                    <a href="{{route('agent.property.edit',['dataId'=>$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon " title="Edit">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <a href="{{route('agent.property.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete" title="Delete">
                                        <i data-feather='trash-2'></i>
                                    </a>
                                    @endif
                                    
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
</div>
@endsection