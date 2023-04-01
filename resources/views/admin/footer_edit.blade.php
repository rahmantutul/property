@extends('layouts.backends.master')
@section('title','Admin Info Update')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Admin Update</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{route('admin.admin.index')}}">Admin List</a>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid my-2" src="{{asset('')}}/assets/frontend/images/logo.png" alt="Card image cap">
                    <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
                    <a href="javascript:void(0);" class="card-link">Card link</a>
                    <a href="javascript:void(0);" class="card-link">Another link</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
       