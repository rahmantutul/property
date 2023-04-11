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
                                        <img src="{{ asset('images/defaultUser.png') }}" alt="Avatar" width="24" height="24">
                                    </div>
                                    <div class="media-body">
                                        <small class="text-muted mr-25">by</small>
                                        <small><a href="javascript:void(0);" class="text-body">{{ $dataInfo->created_by }}</a></small>
                                        <span class="text-muted ml-50 mr-25">|</span>
                                        <small class="text-muted">{{ date('d-m-Y', strtotime($dataInfo->created_at)) }}</small>
                                    </div>
                                </div>
                                    {!! $dataInfo->reportDetails !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Blog -->


                <!-- Leave a Blog Comment -->
                <div class="col-12 mt-1">
                    <h6 class="section-label mt-25">Leave a Comment</h6>
                    @comments(['model' => $dataInfo])
                </div>
                <!--/ Leave a Blog Comment -->
            </div>
        </div>
        <!--/ Blog Detail -->

    </div>
</div>
<div class="sidebar-detached sidebar-right">
    <div class="sidebar">
        <div class="blog-sidebar my-2 my-lg-0">
            <!-- Search bar -->
            <div class="blog-search">
                <div class="input-group input-group-merge">
                    <input type="text" class="form-control" placeholder="Search here">
                    <div class="input-group-append">
                        <span class="input-group-text cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                    </div>
                </div>
            </div>
            <!--/ Search bar -->

            <!-- Recent Posts -->
            <div class="blog-recent-posts mt-3">
                <h6 class="section-label">Recent Posts</h6>
                <div class="mt-75">
                    @foreach ($dataList as $dataInfo)
                        <div class="media mb-2">
                            <a href="page-blog-detail.html" class="mr-2">
                                <img class="rounded" src="{{ $dataInfo->image }}" width="100" height="70" alt="Recent Post Pic">
                            </a>
                            <div class="media-body">
                                <h6 class="blog-recent-post-title">
                                    <a href="page-blog-detail.html" class="text-body-heading">{{ Str::limit($dataInfo->reportName, 50,) }}</a>
                                </h6>
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
                                <img src="{{ $dataInfo->image }}" alt="No Image" srcset="">
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