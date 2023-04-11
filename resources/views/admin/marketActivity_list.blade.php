@extends('layouts.backends.master')
@section('title','Transection List')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Market Activity</h2>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm" href="{{ route('admin.marketActivity.create') }}">Add New</a>
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
                        <strong>REPORT NAME:</strong>
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
                                <th>Report Subject</th>
                                <th>reportDetails</th>
                                @if(!isset(request()->user))
                                <th>Attachment One</th>
                                <th>Attachment Two</th>
                                <th>Attachment Three</th>
                                @endif
                                @if(!isset(request()->user))
                                <th>Available Status</th>
                                @endif
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataList as $key=>$dataInfo)
                            <tr>
                                <th class="text-center">{{ $key+1 }}</th>
                                <td>{{ $dataInfo->reportName }}</td>
                                <td>{{ $dataInfo->reportSubject }}</td>
                                <td>{!! Str::limit($dataInfo->reportDetails,150) !!}</td>
                                @if(!isset(request()->user))
                                <td class="text-center">
                                    @if (!is_null($dataInfo->bannerImage))
                                    <img src="{{getUserImage($dataInfo->bannerImage)}}" alt="Image" height="50" width="50" style="border-radius: 50%;border: 1px solid green;">
                                    @else
                                     N/A
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if (!is_null($dataInfo->image))
                                    <img src="{{getUserImage($dataInfo->image)}}" alt="Image" height="50" width="50" style="border-radius: 50%;border: 1px solid green;">
                                    @else
                                     N/A
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if (!is_null($dataInfo->attachmentThree))
                                    <a class="btn btn-sm btn-info" href="{{ $dataInfo->attachmentThree }}" download target="__blank">Download</a>
                                    @else
                                     N/A
                                    @endif
                                </td>
                                @endif
                                @if(!isset(request()->user))
                                <td>
                                    <span class="badge badge-pill {{getShareStatusBadge($dataInfo->shareStatus)}}">{{getShowStatus($dataInfo->shareStatus)}}</span>
                                </td>
                                @endif
                                <td class="text-center">
                                    @if(!isset(request()->user))
                                    <a href="{{route('admin.marketActivity.status.change',['dataId'=>$dataInfo->id,'status'=>($dataInfo->shareStatus==0)?1:0])}}" class="btn btn-sm btn-icon {{getShowStatusChangeBtn($dataInfo->shareStatus)}} btn_status_change" title="Change Status">
                                        {!!getShowStatusChangeIcon($dataInfo->shareStatus)!!}
                                    </a>

                                    <a href="{{route('admin.marketActivity.edit',['dataId'=>$dataInfo->id])}}" class="btn btn-warning btn-sm btn-icon" title="Edit">
                                        <i data-feather='edit'></i>
                                    </a>

                                    <a href="{{route('admin.marketActivity.delete',['dataId'=>$dataInfo->id])}}" class="btn btn-danger btn-sm btn-icon {{getStatusChangeBtn($dataInfo->status)}} delete" title="Delete">
                                        <i data-feather='trash-2'></i>
                                    </a>
                                    <a href="{{route('marketActivity.details',['dataId'=>$dataInfo->id])}}" class="btn btn-success btn-sm btn-icon" title="Show Details">
                                        <i data-feather='eye'></i>
                                    </a> <br>
                                    <span class="badge" style="background: #140c38;">See Details</span>
                                    @else
                                    <a href="{{route('marketActivity.details',['dataId'=>$dataInfo->id])}}" class="btn btn-success btn-sm btn-icon" title="Show Details">
                                        <i data-feather='eye'></i>
                                    </a> <br>
                                    <span class="badge" style="background: #140c38;">See Details</span>
                                    @endif
                                </td>
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

