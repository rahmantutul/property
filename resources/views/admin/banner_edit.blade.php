@extends('layouts.backends.master')
@section('title','Banner Update')
@section('content')

<div class="row mb-1">
    <div class="col-8">
        <h2 class="content-header-title float-left mb-0">Banner Update</h2>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-4">
            <div class="card">
                <form action="{{ route('admin.banner.update') }}"  id="ajax_form"  method="POST" enctype="multipart/form-data"> @csrf
                    <div class="card-body">
                        <img class="img-fluid my-2" src="{{getUserImage($dataInfo->play_film_banner)}}" style="height:260px;"  alt="Card image cap">
                            <h4 class="text-center bg-light-info text-uppercase" style="padding:8px">Play Film Banner</h4>
                            <input type="file" name="play_film_banner" id="play_film" class="form-control">
                            <button type="submit" class="btn btn-info form-control" style="margin-top:12px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <form action="{{ route('admin.banner.update') }}"  id="ajax_form"  method="POST" enctype="multipart/form-data"> @csrf
                    <div class="card-body">
                        <img class="img-fluid my-2" src="{{getUserImage($dataInfo->search_banner)}}" style="height:260px;"  alt="Card image cap">
                        <h4 class="text-center bg-light-info text-uppercase" style="padding:8px">Search Banner</h4>
                        <input type="file" name="search_banner" id="search_banner" class="form-control">
                        <button type="submit" class="btn btn-info form-control" style="margin-top:12px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <form action="{{ route('admin.banner.update') }}"  id="ajax_form"  method="POST" enctype="multipart/form-data"> @csrf
                    <div class="card-body">
                        <img class="img-fluid my-2" src="{{getUserImage($dataInfo->featured_banner)}}" style="height:260px;"  alt="Card image cap">
                        <h4 class="text-center bg-light-info text-uppercase" style="padding:8px">Featured Banner</h4>
                        <input type="file" name="featured_banner" id="featured_banner" class="form-control">
                        <button type="submit" class="btn btn-info form-control" style="margin-top:12px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="col-4">
            <div class="card">
                <form action="{{ route('admin.banner.update') }}"  id="ajax_form"  method="POST" enctype="multipart/form-data"> @csrf
                    <div class="card-body">
                        <img class="img-fluid my-2" src="{{getUserImage($dataInfo->map_banner)}}" style="height:260px;"  alt="Card image cap">
                        <h4 class="text-center bg-light-info text-uppercase" style="padding:8px">Map Banner</h4>
                        <input type="file" name="map_banner" id="map_banner" class="form-control">
                        <button type="submit" class="btn btn-info form-control" style="margin-top:12px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <form action="{{ route('admin.banner.update') }}"  id="ajax_form"  method="POST" enctype="multipart/form-data"> @csrf
                    <div class="card-body">
                        <img class="img-fluid my-2" src="{{getUserImage($dataInfo->neighbour_banner)}}"  style="height:260px;" alt="Card image cap">
                        <h4 class="text-center bg-light-info text-uppercase" style="padding:8px">Neighbour Banner</h4>
                        <input type="file" name="neighbour_banner" id="neighbour_banner" class="form-control">
                        <button type="submit" class="btn btn-info form-control" style="margin-top:12px;">Update</button>
                    </div>
                </form>
            </div>
        </div> --}}

    </div>
</div>
@endsection
       