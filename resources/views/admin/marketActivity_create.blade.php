@extends('layouts.backends.master')
@section('title','Admin Create')
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
                            <strong>Share with All:</strong>
                            <select class="form-control" name="shareStatus" required>
                                <option value="">Select an option</option>
                                <option value="1" >Share now</option>
                                <option value="0" >Not shared</option>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Attatchment One:</strong>
                            <input type="file" name="attachmentOne"class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Attatchment Two:</strong>
                            <input type="file" name="attachmentTwo" class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Attatchment Three:</strong>
                            <input type="file" name="attachmentThree" class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Report details:</strong>
                                <textarea name="reportDetails" id="editor">

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
       