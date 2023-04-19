@extends('layouts.backends.master')
@section('title','Admin Create')
@push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Market activity Create</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{ route('admin.marketActivity.index') }}">View List</a>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">   
                <div class="card-header">
                    <h4>Create Market Report</h4>
                </div>        
                <div class="card-body">
                    <form class="row" id="ajax_form" action="{{ route('admin.marketActivity.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="col-6 form-group">
                            <strong>Report Name:</strong>
                            <input type="text" name="reportName" placeholder="Report Name" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Report Subject:</strong>
                            <input type="text" name="reportSubject" placeholder="Report Subject" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Banner Image:</strong>
                            <input type="file" name="bannerImage"class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Image :</strong>
                            <input type="file" name="image" class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>PDF/FILE:</strong>
                            <input type="file" name="attachmentThree" class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 form-group">
                            <strong>Report details:</strong>
                            <textarea class="ckeditor form-control" name="reportDetails" id="editor"></textarea>
                            <span style="color:red" ></span>
                        </div>
                        <div class="col-12 d-flex flex-row-reverse mt-5">
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
@push('js')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('.ckeditor').ckeditor();
        });
    </script>
@endpush
       