@extends('layouts.backends.master')
@section('title','Agent Info Update')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Agent Update</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{route('admin.agent.index')}}">Agent List</a>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">           
                <div class="card-body">
                    <form class="row" id="ajax_form" action="{{route('admin.agent.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                        <div class="col-6 form-group">
                            <strong>Photo:</strong>
                            <input type="file" name="photo"class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                         <div class="col-6 form-group">
                            <strong>First Name:</strong>
                            <input type="text" name="firstName" placeholder="First Name" class="form-control" required value="{{$dataInfo->firstName}}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Last Name:</strong>
                            <input type="text" name="lastName" placeholder="Last Name" class="form-control" value="{{$dataInfo->lastName}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Email:</strong>
                            <input type="email" name="email" placeholder="Email" class="form-control" value="{{$dataInfo?->user?->email}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Phone:</strong>
                            <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{$dataInfo?->user?->email}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 d-flex flex-row-reverse">
                            <button class="btn btn-primary btn-icon" type="submit">
                               <i data-feather='save'></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
       