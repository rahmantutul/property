@extends('layouts.backends.master')
@push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('title','Admin Create')
@section('content')
<div class="row mb-1">
    <div class="col-8">
        <h2 class="content-header-title float-left mb-0">Market Activity Edit</h2>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm" href="{{route('admin.marketActivity.index')}}">View List</a>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">   
                <div class="card-header">
                    <h4>Edit Market Report</h4>
                </div>        
                <div class="card-body">
                    <form class="row" id="ajax_form" action="{{ route('admin.marketActivity.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                         <div class="col-6 form-group">
                            <strong>Report Name:</strong>
                            <input type="text" name="reportName" placeholder="Report Name" class="form-control" required  value="{{ $dataInfo->reportName }}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Report Subject:</strong>
                            <input type="text" name="reportSubject" placeholder="Report Subject" class="form-control"  required value="{{ $dataInfo->reportName }}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Banner Image:</strong>
                            <input type="file" name="bannerImage"class="form-control" value="{{ $dataInfo->bannerImage }}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Image:</strong>
                            <input type="file" name="image" class="form-control" value="{{ $dataInfo->image }}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>PDF/FILE:</strong>
                            <input type="file" name="attachmentThree" class="form-control" value="{{ $dataInfo->attachmentThree }}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Report Details:</strong>
                                <textarea class="ckeditor form-control" name="reportDetails" id="editor">
                                    {{ $dataInfo->reportDetails }}
                                </textarea>
                               
                                <span style="color:red" ></span>
                             <span style="color:red" ></span>
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
@push('js')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('.ckeditor').ckeditor();
        });
    </script>
@endpush
       