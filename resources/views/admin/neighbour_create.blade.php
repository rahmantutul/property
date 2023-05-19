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
                            <strong>Category:</strong>
                            <select name="categoryId"  class="form-control" id="">
                                <option value="">Select Category</option>
                                @foreach ($neighbours as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                             <span style="color:red" ></span>
                        </div>
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
                            <strong>Title One Details:</strong>
                            <textarea name="titleOneDetails" id="" cols="30" rows="10" class="ckeditor form-control"></textarea>
                        
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Title Two Details:</strong>
                             <textarea name="titleTwoDetails" id="" cols="30" rows="10" class="ckeditor form-control"></textarea>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group"   style="margin-top:60px;">
                            <strong>Title Three Details:</strong>
                            <textarea name="titleThreeDetails" id="" cols="30" rows="10" class="ckeditor form-control"></textarea>
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
    <!-- Include the CkEditor library -->
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('.ckeditor').ckeditor();
        });
    </script>
@endpush
       