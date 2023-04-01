@extends('layouts.backends.master')
@section('title','Info Update')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Info Update</h2>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">           
                <div class="card-body">
                    <div class="col-4 m-auto">
                        <img src="{{getUserImage($dataInfo->logo)}}" alt="{{$dataInfo->websitename}}" style="width: 100%; margin:30px auto;">
                    </div>
                    <form class="row" id="ajax_form" action="{{route('admin.info.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-6 form-group">
                            <strong>Logo:</strong>
                            <input type="file" name="logo"class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                         <div class="col-6 form-group">
                            <strong>Website Name:</strong>
                            <input type="text" name="websitename" placeholder="Website Title" class="form-control" required value="{{$dataInfo->websitename}}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Facebook:</strong>
                            <input type="text" name="facebook" placeholder="Facebook" class="form-control" value="{{$dataInfo->facebook}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Linkedin:</strong>
                            <input type="text" name="linkedin" placeholder="Linkedin Link" class="form-control" value="{{$dataInfo->linkedin}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Twitter:</strong>
                            <input type="text" name="twitter" placeholder="Twitter Link" class="form-control" value="{{$dataInfo->twitter}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Instagram:</strong>
                            <input type="text" name="instagram" placeholder="Instagram Link" class="form-control" value="{{$dataInfo->instagram}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Copyright Text:</strong>
                            <input type="text" name="copyright" placeholder="Copyright Text" class="form-control" value="{{$dataInfo->copyright}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Disclaimer Text:</strong>
                            <input type="text" name="disclaimer" placeholder="Disclaimer Text" class="form-control" value="{{$dataInfo->disclaimer}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Office Location:</strong>
                            <input type="text" name="location" placeholder="Office Location" class="form-control" value="{{$dataInfo->location}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" placeholder="Office Email" class="form-control" value="{{$dataInfo->email}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Phone:</strong>
                            <input type="text" name="phone" placeholder="Office Phone" class="form-control" value="{{$dataInfo->phone}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Fax:</strong>
                            <input type="text" name="fax" placeholder="Office Fax" class="form-control" value="{{$dataInfo->fax}}" required>
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
       