@extends('layouts.backends.master')
@section('title','Agent Create')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Agent Create</h2>
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
                    <form class="row" id="ajax_form" action="{{route('admin.agent.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="col-6 form-group">
                            <strong>Photo:</strong>
                            <input type="file" name="photo"class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Username: <span style="color:red" >*</span></strong>
                            <input type="text" name="username" placeholder="Username" class="form-control" required >
                        </div>
                         <div class="col-6 form-group">
                            <strong>First Name: <span style="color:red" >*</span></strong>
                            <input type="text" name="firstName" placeholder="First Name" class="form-control" required >
                        </div>
                        <div class="col-6 form-group">
                            <strong>Last Name: <span style="color:red" >*</span></strong>
                            <input type="text" name="lastName" placeholder="Last Name" class="form-control"  required>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Email: <span style="color:red" >*</span></strong>
                            <input type="email" name="email" placeholder="Email" class="form-control"  required>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Phone: <span style="color:red" >*</span></strong>
                            <input type="text" name="phone" placeholder="Phone" class="form-control"  required>
                             
                        </div>
                        <div class="col-6 form-group">
                            <strong>Password: </strong>
                            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off" >
                        </div>
                        <div class="col-12 d-flex flex-row-reverse">
                            <button class="btn btn-primary btn-icon" type="submit">
                               <i data-feather='save'></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
       