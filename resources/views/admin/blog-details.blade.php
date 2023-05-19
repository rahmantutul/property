@extends('layouts.backends.master')
@section('title','Agent List')
@push('css')
    <style>
        .table th, .table td{
            padding: 0px !important;
        }
    </style>
@endpush
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Market Activity</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Market Activity</a>
                        </li>
                        <li class="breadcrumb-item active">Detail
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-detached content-left">
    <div class="content-body">
        <!-- Blog Detail -->
        <div class="blog-detail-wrapper">
            <div class="row">
                <!-- Blog -->
                <div class="col-12">
                    <div class="card">
                        <img style="max-height:450px; " src="{{ $dataInfo->bannerImage }}" class="img-fluid card-img-top" alt="Blog Detail Pic">
                        <div class="card-body">
                            <h4 class="card-title">{{ $dataInfo->reportName }}</h4>
                                <div class="media">
                                    <div class="avatar mr-50">
                                        <img src="{{getUserImage(Auth::guard('admin')->user()->avatar)}}" alt="Avatar" width="24" height="24">
                                    </div>
                                    <div class="media-body mb-2">
                                        <small class="text-muted mr-25">by</small>
                                        <small><a href="javascript:void(0);" class="text-body">{{ $dataInfo->created_by }}</a></small>
                                        <span class="text-muted ml-50 mr-25">|</span>
                                        <small class="text-muted">Posted: {{ date('d-m-Y', strtotime($dataInfo->created_at)) }}</small>
                                    </div>
                                </div>
                                    {!! $dataInfo->reportDetails !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <h6 class="section-label mt-25">Leave a Comment</h6>
                            @comments(['model' => $dataInfo])
                        </div>
                    </div>
        </div>
                <!--/ Blog -->
    </div>
</div>
<div class="sidebar-detached sidebar-right">
    <div class="sidebar">
        <div class="blog-sidebar">
            <!--/ Search bar -->

            <!-- Recent Posts -->
            <div class="blog-recent-posts mt-3" >
                <h6 class="section-label">Recent Posts</h6>
                <div class="mt-75" >
                    @foreach ($dataList as $dataInfo)
                        <div class="media mb-2"  style="background: #ececec; padding: 8px;">
                            <a href="{{route('marketActivity.details',['dataId'=>$dataInfo->id])}}" class="mr-2">
                                <img class="rounded" src="{{ $dataInfo->image }}" width="100" height="70" alt="Recent Post Pic">
                            </a>
                            <div class="media-body">
                                <h6 class="blog-recent-post-title">
                                    <a href="{{route('marketActivity.details',['dataId'=>$dataInfo->id])}}" class="text-body-heading" style="color:#000; font-weight:600;">{{ Str::limit($dataInfo->reportName, 50,) }}</a>
                                </h6>
                                <a href="{{route('marketActivity.details',['dataId'=>$dataInfo->id])}}">Read More ...</a>
                                <div class="text-muted mb-0">{{ date('d-m-Y', strtotime($dataInfo->created_at)) }}</div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
            <!--/ Recent Posts -->

            <!-- Categories -->
            <div class="blog-categories mt-3">
                <h6 class="section-label">Documnets</h6>
                <div class="mt-1">
                    <div class="d-flex justify-content-start align-items-center mb-75">
                        <a href="javascript:void(0);" class="mr-75">
                            <div class="avatar bg-light-primary rounded">
                                <div class="avatar-content">
                                    <i data-feather='file'></i>
                                </div>
                            </div>
                        </a>
                        <a href="{{ $dataInfo->attachmentThree }}" class=" btn btn-sm btn-info" download="" target="__blank"> 
                            Download
                        </a>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mb-75">
                        <a href="javascript:void(0);" class="mr-75">
                            <div class="bg-light-primary">
                                <img width="220px;" src="{{ $dataInfo->image }}" alt="No Image" srcset="">
                            </div>
                        </a>
                        
                    </div>
                </div>
            </div>
            <!--/ Categories -->
        </div>

    </div>
</div>
@endsection