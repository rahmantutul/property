@extends('layouts.backends.master')
@section('title','Admin Create')
@section('content')
<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Transection Edit</h2>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm" href="{{ route('admin.marketActivity.index') }}">View List</a>
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
                            <strong>Share with All:</strong>
                            <select class="form-control" name="shareStatus" required>
                                <option value="">Select an option</option>
                                <option {{ $dataInfo->shareStatus==1 ? 'selected' : '' }} value="1" >Share now</option>
                                <option {{ $dataInfo->shareStatus==0 ? 'selected' : '' }} value="0" >Not shared</option>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Attatchment One:</strong>
                            <input type="file" name="attachmentOne"class="form-control" value="{{ $dataInfo->attachmentOne }}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Attatchment Two:</strong>
                            <input type="file" name="attachmentTwo" class="form-control" value="{{ $dataInfo->attachmentTwo }}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Attatchment Three:</strong>
                            <input type="file" name="attachmentThree" class="form-control" value="{{ $dataInfo->attachmentThree }}">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Report details:</strong>
                                <textarea name="reportDetails" id="editor">
                                    {{ $dataInfo->reportDetails }}
                                </textarea>
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
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
@endpush
       