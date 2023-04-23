@extends('layouts.backends.master')
@section('title','Agent Info Update')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Update Profile</h2>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-9 m-auto" >
            <div class="card  p-5">
                <div class="card-header">
                    <div class="media mb-2">
                        <img src="{{getUserImage(Auth::user()->avatar)}}" alt="{{$dataInfo->name}}" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90">
                        <div class="media-body mt-50">
                            <h4>{{ getFullName($dataInfo) }}</h4>
                            <h6 class="text-danger">Agent</h6>
                            <h5>{{$dataInfo->phone}}</h5>
                            <div class="col-12 d-flex mt-1 px-0">
                            </div>
                        </div>
                    </div>
                </div>      
                <div class="card-body">
                    <form class="row" action="{{route('agent.agent.updateProfile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                        
                        <div class="col-6 form-group">
                            <strong>Email:</strong>
                            <input type="email" name="email" readonly class="form-control" value="{{$dataInfo->user?->email}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>User Name:</strong>
                            <input type="email" name="username" readonly class="form-control" value="{{$dataInfo->username}}" required>
                             <span style="color:red" ></span>
                        </div>
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
                            <strong>Phone:</strong>
                            <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{$dataInfo->user?->phone}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>License:</strong>
                            <input type="text" name="license" placeholder="License" class="form-control" value="{{$dataInfo->license}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Facebook:</strong>
                            <input type="text" name="facebook" placeholder="Facebook" class="form-control" value="{{$dataInfo->facebook}}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>LinkedIn:</strong>
                            <input type="text" name="linkedin" placeholder="LinkedIn" class="form-control" value="{{$dataInfo->linkedin}}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Skype:</strong>
                            <input type="text" name="skype" placeholder="LinkedIn" class="form-control" value="{{$dataInfo->skype}}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Fax:</strong>
                            <input type="text" name="fax" placeholder="Fax" class="form-control" value="{{$dataInfo->fax}}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Address:</strong>
                            <input type="text" name="address" placeholder="Address" class="form-control" autocomplete="off" value="{{$dataInfo->address}}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Old Password:</strong>
                            <input type="password" name="old_password" placeholder="Old Password" class="form-control" autocomplete="off" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Confirm Password:</strong>
                            <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" autocomplete="off" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 form-group">
                            <strong>About:</strong>
                            <textarea name="about" id="" cols="30" rows="10" class="ckeditor form-control">{{$dataInfo->about}}</textarea>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 d-flex flex-row-reverse">
                            <button  class="btn btn-primary btn-icon" type="submit">
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
@push('js')
    <!-- Include the CkEditor library -->
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('.ckeditor').ckeditor();
        });
    </script>
@endpush
       