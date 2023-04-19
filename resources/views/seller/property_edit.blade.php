@extends('layouts.backends.master')
@section('title','Property Update')
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
    <h2 class="content-header-title float-left mb-0">Peoperty Update</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm " href="{{route('agent.property.index')}}">Property List</a>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">           
                <div class="card-body">
                    <form class="row" id="ajax_form" action="{{route('agent.property.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                        <div class="col-4 form-group">
                            <strong>Title:</strong>
                            <input type="text" name="title" placeholder="Property Titile" class="form-control" required value="{{$dataInfo->title}}" 
                            >
                             <span style="color:red" ></span>
                        </div>
                        {{-- <div class="col-4 form-group">
                            <strong>MLS ID:</strong>
                            <input type="text" name="mlsId" placeholder="MLS Id" class="form-control"  value="{{$dataInfo->mlsId}}"  required>
                             <span style="color:red" ></span>
                        </div> --}}
                        <div class="col-4 form-group">
                            <strong>Available Date:</strong>
                            <input type="date" name="availableDate" placeholder="Available Date" class="form-control"  value="{{$dataInfo->availableDate}}"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Expired Date:</strong>
                            <input type="date" name="expireDate" placeholder="Expired Date" class="form-control"   value="{{$dataInfo->expireDate}}" required>
                             <span style="color:red" ></span>
                        </div>
                        
                        <div class="col-4 form-group">
                            <strong>Price:</strong>
                            <input type="number" name="price" placeholder="Price" class="form-control" step="0.01"  value="{{$dataInfo->price}}" required>
                             <span style="color:red" ></span>
                        </div>
                        
                        <div class="col-4 form-group">
                            <strong>Original Price:</strong>
                            <input type="number" step="0.01" name="originalPrice" placeholder="Original Price" class="form-control"  value="{{$dataInfo->originalPrice}}"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Virtual Tour:</strong>
                            <input type="text" name="virtualTour" placeholder="Virtual Tour" class="form-control" value="{{$dataInfo->virtualTour}}"   required>
                             <span style="color:red" ></span>
                        </div>
                    
                        <div class="col-4 form-group">
                            <strong>Categories:</strong>
                            <select class="form-control select2" name="category[]" multiple>
                                    <option value="">Choose An Category</option>
                                @foreach($categoryList as $category)
                                <option value="{{$category->id}}" {{(in_array($category->id,$dataInfo->categories()->pluck('categoryId')->toArray()))?'selected':''}}>{{$category->name}}</option>
                             @endforeach  
                            </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                        <strong>Call For Price:</strong>
                            <select class="form-control " name="callForPrice"  required>
                                    <option value="1" {{$dataInfo->callForPrice==1 ?'selected':''}}>Yes</option>
                                    <option value="0" {{$dataInfo->callForPrice==0 ?'selected':''}}>No</option>
                            </select>
                             <span style="color:red" ></span>
                        </div>

                        <div class="col-4 form-group">
                        <strong>Hide Address:</strong>
                            <select class="form-control " name="isHideAddress"  required>
                                    <option value="1" {{$dataInfo->isHideAddress==1 ?'selected':''}}>Yes</option>
                                    <option value="0" {{$dataInfo->isHideAddress==0?'selected':''}}>No</option>
                            </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 form-group">
                            <strong>Preview Text:</strong>
                            <textarea name="previewText" id="" class="ckeditor form-control" placeholder="Write Preview Text">{{ $dataInfo->previewText }}</textarea>
                            <span style="color:red" ></span>
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Location</h4>
                        </div>
                        
                        <div class="col-4 form-group">
                            <strong>Street Number:</strong>
                            <input type="text" name="streetNumber" placeholder="Street Number " class="form-control"  value="{{(!is_null($dataInfo->address)) ? $dataInfo->address->streetNumber:''}}" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Street Address 1:</strong>
                            <input type="text" name="streetAddressOne" placeholder="Stress Address One" class="form-control" value="{{(!is_null($dataInfo->address)) ? $dataInfo->address->streetAddressOne:''}}"   required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Street Address 2:</strong>
                            <input type="text" name="streetAddressTwo" placeholder="Stress Address Two" class="form-control" value="{{(!is_null($dataInfo->address)) ? $dataInfo->address->streetAddressTwo:''}}"   required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Suit/Apertment:</strong>
                            <input type="text" name="shuitAppertment" placeholder="Suit apertment" class="form-control" value="{{(!is_null($dataInfo->address)) ? $dataInfo->address->shuitAppertment:''}}"   required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Subdivision:</strong>
                            <input type="text" name="subDivision" placeholder="Subdivition" class="form-control" value="{{(!is_null($dataInfo->address)) ? $dataInfo->address->subDivision:''}}"   required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Country:</strong>
                            <select class="form-control select2" name="countryId" required>
                                <option value="">Choose A Country</option>
                             @foreach($countryList as $country)
                                <option value="{{$country->id}}" {{(!is_null($dataInfo->address) && $dataInfo->address->countryId==$country->id)?'selected':''}}>{{$country->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>State:</strong>
                            <select class="form-control select2" name="stateId" required>
                                <option value="">Choose State</option>
                                @foreach($stateList as $state)
                                    <option value="{{$state->id}}" {{(!is_null($dataInfo->address) && $dataInfo->address->stateId==$state->id)?'selected':''}}>{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>City:</strong>
                            <select class="form-control" name="cityId" required>
                                <option value="">Choose City</option>
                               @foreach($cityList as $city)
                                    <option value="{{$city->id}}" {{(!is_null($dataInfo->address) && $dataInfo->address->cityId==$city->id)?'selected':''}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="col-12">
                            <h4 class="form-devider">Details</h4>
                        </div>

                        <div class="col-4 form-group">
                            <strong># Of Bedroom:</strong>
                            <input type="number" name="numOfBedroom" placeholder="Number Of Bedroom" class="form-control" value="{{(!is_null($dataInfo->details))?$dataInfo->details->numOfBedroom:''}}"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong># Of Bathroom:</strong>
                            <input type="number" name="numOfBathroom" placeholder="Number Of Bathroom" class="form-control"  value="{{(!is_null($dataInfo->details))?$dataInfo->details->numOfBathroom:''}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Total Units:</strong>
                            <select class="form-control" name="totalUnit" required>
                                <option value="">Choose Type</option>
                                <option value="1" {{(!is_null($dataInfo->details) &&  $dataInfo->details->totalUnit==1)?'selected':''}}>1</option>
                                <option value="2" {{(!is_null($dataInfo->details) &&  $dataInfo->details->totalUnit==2)?'selected':''}}>2</option>
                                <option value="3" {{(!is_null($dataInfo->details) &&  $dataInfo->details->totalUnit==3)?'selected':''}}>3</option>
                                <option value="4" {{(!is_null($dataInfo->details) &&  $dataInfo->details->totalUnit==4)?'selected':''}}>4</option>
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <strong>SQ Ft.:</strong>
                            <input type="number" name="squareFeet" placeholder="Square Fit" class="form-control"  value="{{(!is_null($dataInfo->details))?$dataInfo->details->squareFeet:''}}"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Lot Size:</strong>
                            <input type="text" name="lotSize" placeholder="Lot Size" class="form-control"  value="{{(!is_null($dataInfo->details))?$dataInfo->details->lotSize:''}}"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Lot Acres:</strong>
                            <input type="number" name="lotAcre" placeholder="Lot Acres" class="form-control"  value="{{(!is_null($dataInfo->details))?$dataInfo->details->lotAcre:''}}"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Lot Type:</strong>
                            <input type="text" name="lotType" placeholder="Lot Type" class="form-control"  value="{{(!is_null($dataInfo->details))?$dataInfo->details->lotType:''}}"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Heat:</strong>
                            <input type="text" name="heat" placeholder="Heat" class="form-control"  value="{{(!is_null($dataInfo->details))?$dataInfo->details->heat:''}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Cooling:</strong>
                            <input type="text" name="cooling" placeholder="Cooling" class="form-control"   value="{{(!is_null($dataInfo->details))?$dataInfo->details->cooling:''}}" required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Fuel:</strong>
                            <input type="text" name="fuel" placeholder="Fuel" class="form-control"  value="{{(!is_null($dataInfo->details))?$dataInfo->details->fuel:''}}"  required>
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
                                    <input type="checkbox" name="amineties[]" id="amineties_{{$aminety->id}}" class="custom-control-input" value="{{$aminety->id}}" {{(in_array($aminety->id,$dataInfo->amenities()->pluck('amenityId')->toArray()))?'checked':''}}>
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
                                    <input type="checkbox" name="amineties[]" id="amineties_{{$aminety->id}}" class="custom-control-input" value="{{$aminety->id}}" {{(in_array($aminety->id,$dataInfo->amenities()->pluck('amenityId')->toArray()))?'checked':''}}>
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
                                    <input type="checkbox" name="amineties[]" id="amineties_{{$aminety->id}}" class="custom-control-input" value="{{$aminety->id}}" {{(in_array($aminety->id,$dataInfo->amenities()->pluck('amenityId')->toArray()))?'checked':''}}>
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
                            @if(!is_null($dataInfo->thumbnail))
                                {{-- <img src="{{getImage($dataInfo->thumbnail)}}" height="70" width="70"> <br> --}}
                                <input type="hidden" name="thumbailUrl" value="{{$dataInfo->thumbnail}}">
                            @endif
                            <input type="file" name="thumbnail" class="form-control"   >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Embeded Video:</strong>
                            <input type="text" name="videoUrl" placeholder="Past URL" class="form-control" value="{{$dataInfo->videoUrl}}" >
                             <span style="color:red" ></span>
                        </div>
                        
                        <div class="col-12 form-group">
                            <strong>Select Slder Images:</strong>
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
       