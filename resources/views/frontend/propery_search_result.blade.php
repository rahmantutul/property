@extends('layouts.frontend.app')
@push('css')
    
@endpush

@section('content')
<section class="search_box_filter">
    <form id="listing-search-form" action="{{route('front.propertyPageSearch')}}" method="POST">
        @csrf
        <div class="adv_search-form">
            {{-- <select name="neighborhood-type">
                <option value="1">Neighborhood</option>
                <option value="0">Address</option>
            </select> --}}
            <input type="text" name="keyword" placeholder="Enter Neighborhood or Address">
            <select name="category">
                @foreach ($categories as $item)
                    <option value="">Select Category</option>
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <select name="min_price">
                <option value="">Min. Price</option>
                <option value="50000">$50,000</option>
                <option value="100000">$100,000</option>
                <option value="150000">$150,000</option>
                <option value="200000">$200,000</option>
            </select>
            <select name="max_price">
                <option value="">Max. Price</option>
                <option value="500000">$500,000</option>
                <option value="1000000">$1,000,000</option>
                <option value="1500000">$1,500,000</option>
                <option value="2000000">$2,000,000</option>
            </select>
            <select name="beds">
                <option value="">Beds</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <select name="baths">
                <option value="">Baths</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div>
            <div class="button-group">
                <div class="toggle-button">
                    <span>HK LISTING ONLY</span>
                    <label class="switch">
                        <input type="checkbox" name="featured_property">
                        <span class="slider"></span>
                    </label>
                    <span>ALL MLS LISTING</span>
                </div>
                <div class="toggle-button">
                    <span>Average</span>
                    <label class="switch">
                        <input type="checkbox" name="sale_property">
                        <span class="slider"></span>
                    </label>
                    <span>FOR SALE</span>
                </div>
                <div class="search-button">
                    <button type="submit">SEARCH</button>
                </div>
            </div>
        </div>
    </form>
</section>


<section class="featured_list_box col-md-12">
    <div class="row" id="search-result">
    @foreach($dataList as $key=>$dataInfo)
        <div class="carousel-card col-md-4 mb-4">
            <div class="image-box">
                <img src="{{getImage($dataInfo->thumbnail)}}" alt="{{$dataInfo->title}}">
                <div class="hover-content">
                    <h5>FOR SALE | ${{$dataInfo->price}}</h5>
                    <h2>FOR SALE: {{(!is_null($dataInfo->details)) ? $dataInfo->details->totalUnit.','.$dataInfo->details->squareFeet:''}}</h2>
                    <h5><span><i class="fa fa-bed"></i>{{(!is_null($dataInfo->details)) ? $dataInfo->details->numOfBedroom:''}} BEDS</span> <span style="margin-left: 10px;"><i class="fa fa-tint"></i> {{(!is_null($dataInfo->details)) ? $dataInfo->details->numOfBathroom:''}} Baths</span></h5>

                    <a href="" class="learn_more_btn">
                        <div class="button_lm">
                            <div class="f-left left_btn">Learn More</div>
                            <div class="f-left right_btn"><i class="fa fa fa-arrow-right btn_icon"></i></div>
                        </div>
                    </a>
                    <a href="" class="save_properties"><i class="fa fa-star"></i> Save</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
</section>
       
@endsection

@push('js')
    
@endpush