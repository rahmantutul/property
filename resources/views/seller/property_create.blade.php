@extends('layouts.backends.master')
@section('title','Admin Create')
@push('css')
<style>
    .form-devider{
        padding: 12px ;
        background: #E8DAEF;
        border-radius: 4px;
    }
</style>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Peoperty Entry</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{route('seller.property.index')}}">Property List</a>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">           
                <div class="card-body">
                    <form class="row" id="ajax_form" action="{{route('seller.property.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sellerId" value="{{ Auth::guard('seller')->user()->id }}">

                        <div class="col-4 form-group">
                            <strong>Title:</strong>
                            <input type="text" name="title" placeholder="Property Titile" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Property Type:</strong>
                            <select class="form-control select2" name="typeId">
                                <option value="">Choose A Property Type</option>
                                @foreach ($properTypeList as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                            <span style="color:red"></span>
                        </div>
                        {{-- <div class="col-4 form-group">
                            <strong>MLS ID:</strong>
                            <input type="text" name="mlsId" placeholder="MLS Id" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div> --}}
                        <div class="col-4 form-group">
                            <strong>Available Date:</strong>
                            <input type="date" name="availableDate" placeholder="Available Date" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Expired Date:</strong>
                            <input type="date" name="expireDate" placeholder="Expired Date" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        
                        <div class="col-4 form-group">
                            <strong>Price:</strong>
                            <input type="number" name="price" placeholder="Price" class="form-control" step="0.01"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Original Price:</strong>
                            <input type="number" step="0.01" name="originalPrice" placeholder="Original Price" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Virtual Tour (URL):</strong>
                            <input type="text" name="virtualTour" placeholder="URL" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Categories:</strong>
	                        <select class="form-control select2" name="category[]">
	                                <option value="">Choose An Category</option>
	                            @foreach($categoryList as $category)
                             	<option value="{{$category->id}}">{{$category->name}}</option>
                             @endforeach  
	                        </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                      	<strong>Call For Price:</strong>
	                        <select class="form-control " name="callForPrice"  required>
	                                <option value="1">Yes</option>
	                                <option value="0">No</option>
	                        </select>
                             <span style="color:red" ></span>
                        </div>

                        <div class="col-4 form-group">
                      	<strong>Hide Address:</strong>
	                        <select class="form-control " name="isHideAddress"  required>
	                                <option value="1">Yes</option>
	                                <option value="0">No</option>
	                        </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 form-group">
                            <strong>Preview Text:</strong>
                            <textarea name="previewText" id="" class="ckeditor form-control" placeholder="Write Preview Text"></textarea>
                            <span style="color:red" ></span>
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Location</h4>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Street Number:</strong>
                            <input type="text" name="streetNumber" placeholder="Property Titile" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Street Address 1:</strong>
                            <input type="text" name="streetAddressOne" placeholder="Stress Address One" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Street Address 2:</strong>
                            <input type="text" name="streetAddressTwo" placeholder="Stress Address Two" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Map Latitude:</strong>
                            <input type="text" name="latitude" placeholder="Map latiude"
                                class="form-control" required>
                            <span style="color:red"></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Map Longitude:</strong>
                            <input type="text" name="longitude" placeholder="Map Longitude"
                                class="form-control" required>
                            <span style="color:red"></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Suit/Apertment:</strong>
                            <input type="text" name="shuitAppertment" placeholder="Suit apertment" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Subdivision:</strong>
                            <input type="text" name="subDivision" placeholder="Subdivition" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Country:</strong>
                            <select class="form-control select2" name="countryId" required>
                                <option value="">Choose A Country</option>
                             @foreach($countryList as $country)
                             	<option value="{{$country->id}}">{{$country->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>State:</strong>
                            <select class="form-control select2" name="stateId" required>
                                <option value="">Choose State</option>
                                @foreach($stateList as $state)
                             		<option value="{{$state->id}}">{{$state->name}}</option>
                             	@endforeach
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>City:</strong>
                            <select class="form-control" name="cityId" required>
                                <option value="">Choose City</option>
                               @foreach($cityList as $city)
                             		<option value="{{$city->id}}">{{$city->name}}</option>
                             	@endforeach
                            </select>
                        </div>
                       
                        <div class="col-12">
                            <h4 class="form-devider">Details</h4>
                        </div>
                        <div class="col-4 form-group">
                            <strong># Of Bedroom:</strong>
                            <input type="number" name="numOfBedroom" placeholder="Number Of Bedroom" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong># Of Bathroom:</strong>
                            <input type="number" name="numOfBathroom" placeholder="Number Of Bathroom" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Total Units:</strong>
                            <input type="number" name="totalUnit" value="" class="form-control" required>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Locker:</strong>
                            <input type="text" name="locker" class="form-control"  required>
                        </div>
                        <div class="col-4 form-group">
                            <strong>MAINTENANCE FEES:</strong>
                            <input type="text" name="fees" class="form-control" placeholder="Maintinance Fee" required>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Exposure:</strong>
                            <input type="text" name="exposure" class="form-control" placeholder="Exposure" required>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Balcony:</strong>
                            <input type="text" name="balcony" class="form-control" placeholder="Exposure" required>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Kitchen:</strong>
                            <input type="text" name="kitchen" class="form-control" placeholder="Kitchen" required>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Parking:</strong>
                            <input type="text" name="parking" class="form-control" placeholder="Parking" required >
                        </div>
                        <div class="col-4 form-group">
                            <strong>Style:</strong>
                            <input type="text" name="style" class="form-control" placeholder="Style" required>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Garage Type:</strong>
                            <select class="form-control select2" name="garageTypeId" required>
                                <option value="">Choose State</option>
                                @foreach ($garageList as $item)
                                    <option value="{{ $item->id }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>SQ Ft.:</strong>
                            <input type="number" name="squareFeet" placeholder="Square Fit" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Lot Size:</strong>
                            <input type="text" name="lotSize" placeholder="Lot Size" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Lot Acres:</strong>
                            <input type="number" name="lotAcre" placeholder="Lot Acres" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Lot Type:</strong>
                            <input type="text" name="lotType" placeholder="Lot Type" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Heat:</strong>
                            <input type="text" name="heat" placeholder="Heat" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Cooling:</strong>
                            <input type="text" name="cooling" placeholder="Cooling" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Fuel:</strong>
                            <input type="text" name="fuel" placeholder="Fuel" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Amenities</h4>
                        </div>
                        <div class="col-4 form-group">
                            <h3>General Amenities:</h3>
                            @foreach($aminetyList as $aminety)
                           	@if($aminety->amenityType=='General Amenities')
	                            <div class="custom-control custom-control-success custom-checkbox mt-1">
	                                <input type="checkbox" name="amineties[]" id="amineties_{{$aminety->id}}" class="custom-control-input" value="{{$aminety->id}}">
	                                <label class="custom-control-label" for="amineties_{{$aminety->id}}">{{$aminety->amenity}}</label>
	                            </div>
	                          @endif
                            @endforeach
                        </div>
                        <div class="col-4 form-group">
                            <h3>Interior Amenities:</h3>
                            @foreach($aminetyList as $aminety)
                           	@if($aminety->amenityType=='Interior Amenities')
	                            <div class="custom-control custom-control-success custom-checkbox mt-1">
	                                <input type="checkbox" name="amineties[]" id="amineties_{{$aminety->id}}" class="custom-control-input" value="{{$aminety->id}}">
	                                <label class="custom-control-label" for="amineties_{{$aminety->id}}">{{$aminety->amenity}}</label>
	                            </div>
	                          @endif
                            @endforeach
                        </div>
                        <div class="col-4 form-group">
                            <h3>Exterior Amenities:</h3>
                           @foreach($aminetyList as $aminety)
                           	@if($aminety->amenityType=='Exterior Amenities')
	                            <div class="custom-control custom-control-success custom-checkbox mt-1">
	                                <input type="checkbox" name="amineties[]" id="amineties_{{$aminety->id}}" class="custom-control-input" value="{{$aminety->id}}">
	                                <label class="custom-control-label" for="amineties_{{$aminety->id}}">{{$aminety->amenity}}</label>
	                            </div>
	                          @endif
                            @endforeach
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Images/Video</h4>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Banner Image (Single):</strong>
                            <input type="file" name="thumbnail" placeholder="Select documnet" class="form-control"   required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Embeded Video:</strong>
                            <input type="text" name="videoUrl" placeholder="Past URL" class="form-control"  >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 form-group">
                            <strong>Select Slder Images (Multiple):</strong>
                            <input type="file" name="images[]" multiple class="form-control">
                            <span style="color:red"></span>
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
       