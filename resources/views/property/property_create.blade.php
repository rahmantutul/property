@extends('layouts.backends.master')
@section('title','Property Create')
@push('css')
<style>
    .form-devider{
        padding: 12px ;
        background: #E8DAEF;
        border-radius: 4px;
    }
</style>
@endpush
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Peoperty Entry</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{route('admin.property.index')}}">Property List</a>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">           
                <div class="card-body">
                    <form class="row" id="ajax_form" action="{{route('admin.property.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="col-4 form-group">
                            <strong>Title:</strong>
                            <input type="text" name="title" placeholder="Property Titile" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>MLS ID:</strong>
                            <input type="text" name="mlsId" placeholder="MLS Id" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Available Date:</strong>
                            <input type="date" name="availableDate" placeholder="Available Date" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Expired Date:</strong>
                            <input type="date" name="expiredDate" placeholder="Expired Date" class="form-control"  required>
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
                            <strong>Virtual Tour:</strong>
                            <input type="text" name="virtualTour" placeholder="Virtual Tour" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Categories:</strong>
                            <select class="form-control select2" name="category[]" multiple>
                                    <option value="">Choose An Category</option>
                                @foreach($categoryList as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                             @endforeach  
                            </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Preview Text:</strong>
                            <textarea name="previewText" id="" class="form-control" placeholder="Write Preview Text"></textarea>
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
                            <input type="text" name="streetAdressOne" placeholder="Stress Address One" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Street Address 2:</strong>
                            <input type="text" name="streetAdressTwo" placeholder="Stress Address Two" class="form-control"  required>
                             <span style="color:red" ></span>
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
                            <select class="form-control select2" name="country" required>
                                <option value="">Choose A Country</option>
                             @foreach($countryList as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>State:</strong>
                            <select class="form-control select2" name="state" required>
                                <option value="">Choose State</option>
                                @foreach($stateList as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>City:</strong>
                            <select class="form-control" name="city" required>
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
                            <input type="number" name="bedroom" placeholder="Number Of Bedroom" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong># Of Bathroom:</strong>
                            <input type="number" name="bathroom" placeholder="Number Of Bathroom" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Total Units:</strong>
                            <select class="form-control" name="units" required>
                                <option value="">Choose Type</option>
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>SQ Ft.:</strong>
                            <input type="number" name="sqFit" placeholder="Square Fit" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Lot Size:</strong>
                            <input type="text" name="lotSize" placeholder="Lot Size" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Lot Acres:</strong>
                            <input type="number" name="lotAcres" placeholder="Lot Acres" class="form-control"  required>
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
                            <strong>Images/Docs/Videos:</strong>
                            <input type="file" name="thumbail" placeholder="Select documnet" class="form-control"   required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Embeded Video:</strong>
                            <input type="text" name="videoUrl" placeholder="Past URL" class="form-control"  >
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
@endpush
       