@extends('layouts.backends.master')
@section('title','Agent Create')
@push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Neighbour Create</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{route('admin.neighbour.index')}}">Neighbour List</a>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">           
                <div class="card-body">
                    <form class="row" id="ajax_form" action="{{route('admin.neighbour.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="col-6 form-group">
                            <strong>Photo:</strong>
                            <input type="file" name="photo" class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                         <div class="col-6 form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" placeholder="Name" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Title One:</strong>
                            <input type="text" name="titleOne" placeholder="Title One" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Title Two:</strong>
                            <input type="text" name="titleTwo" placeholder="TitleTwo" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Title Three:</strong>
                            <input type="text" name="titleThree" placeholder="Last Name" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            {{-- <strong>Title Three:</strong>
                            <input type="text" name="titleThree" placeholder="Last Name" class="form-control"  required>
                             <span style="color:red" ></span> --}}
                        </div>
                        <div class="col-6 form-group">
                            <strong>Title One Details:</strong>
                            {{-- <textarea name="titleOneDetails" id="" cols="30" rows="10" class="form-control"></textarea> --}}
                            <div id="editorOne" contenteditable="true">
                            </div>
                            <input type="hidden" name="titleOneDetails" id="titleOneDetails">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Title Two Details:</strong>
                            {{-- <textarea name="titleTwoDetails" id="" cols="30" rows="10" class="form-control"></textarea> --}}
                            <div id="editorTwo" contenteditable="true">
                            </div>
                            <input type="hidden" name="titleTwoDetails" id="titleTwoDetails">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group"   style="margin-top:60px;">
                            <strong>Title Three Details:</strong>
                            {{-- <textarea name="titleThreeDetails" id="" cols="30" rows="10" class="form-control"></textarea> --}}
                            <div id="editorThree" contenteditable="true">
                            </div>
                            <input type="hidden" name="titleThreeDetails" id="titleThreeDetails">
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
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editorOne', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.getElementById("titleOneDetails").value = quill.root.innerHTML;
        });
    </script>
    <script>
        var quill = new Quill('#editorTwo', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            document.getElementById("titleTwoDetails").value = quill.root.innerHTML;
        });
    </script>
    <script>
        var quill = new Quill('#editorThree', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source, image) {
            document.getElementById("titleThreeDetails").value = quill.root.innerHTML;
        });
    </script>
@endpush
       