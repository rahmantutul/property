@extends('layouts.frontend.app')
@push('css')
    
@endpush

@section('content')
<section class="search_box_filter">
    <form id="listing-search-form" action="{{route('front.propertyPageSearch')}}" method="POST">@csrf
        <div class="adv_search-form">
            {{-- <select name="neighbourhood-type">
                <option value="neighbourhood">Neighbourhood</option>
                <option value="address">Address</option>
            </select> --}}
            <input type="text" name="neighbourhood" placeholder="Enter Neighbourhood">
            <select name="type">
                <option value="">Select Peoperty Type</option>
                @foreach ($types as $item)
                    <option value="{{$item->id}}">{{$item->type}}</option>
                @endforeach
            </select>
            <select name="min_price">
                <option value="any">Min. Price</option>
                <option value="50000">$50,000</option>
                <option value="100000">$100,000</option>
                <option value="150000">$150,000</option>
                <option value="200000">$200,000</option>
            </select>
            <select name="max_price">
                <option value="any">Max. Price</option>
                <option value="500000">$500,000</option>
                <option value="1000000">$1,000,000</option>
                <option value="1500000">$1,500,000</option>
                <option value="2000000">$2,000,000</option>
            </select>
            <select name="beds">
                <option value="any">Beds</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <select name="baths">
                <option value="any">Baths</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div class="filter_adv_search">
            <div class="button-group">
                <div class="toggle-button">
                    <span>HK LISTING ONLY</span>
                    <label class="switch">
                        <input type="checkbox" name="featured_property">
                        <span class="slider round"></span>
                    </label>
                    <span>ALL MLS LISTING</span>
                </div>
                <div class="toggle-button">
                    <span>FOR SALE</span>
                    <label class="switch">
                        <input type="checkbox" name="sale_property">
                        <span class="slider round"></span>
                    </label>
                    <span>FOR RENT</span>
                </div>
                <div class="search-button">
                    <button type="submit">SEARCH</button>
                </div>
            </div>
        </div>

    </form>
</section>
{{-- <section class="search_box_filter">
    <form id="listing-search-form" action="{{route('front.propertyPageSearch')}}" method="POST">
        @csrf
        <div class="adv_search-form">

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
</section> --}}


<section class="featured_list_box col-md-12">
    <div class="row" id="search-result">
    @foreach($dataList as $key=>$dataInfo)
        <div class="carousel-card col-md-4 mb-4">
            <div class="image-box">
                <img src="{{getImage($dataInfo->thumbnail)}}" alt="{{$dataInfo->title}}">
                <div class="hover-content">
                    <h5>FOR SALE | ${{ $dataInfo->price }}</h5>
                    {{-- | {{Str::limit($dataInfo?->address?->streetAddressOne, 10)}} --}}
                        <h2>FOR SALE: {{$dataInfo?->title}}</h2>
                        <h5><span><i class="fa fa-bed"></i> {{$dataInfo->details->numOfBedroom}}+ BEDS</span> <span style="margin-left: 10px;"><i class="fa fa-tint"></i> {{$dataInfo->details->numOfBathroom}}+ Baths</span></h5>
                        <a href="{{ route('front.propertyDetails', $id=$dataInfo->id) }}" class="learn_more_btn">
                            <div class="button_lm">
                                <div class="f-left left_btn">Learn More</div>
                                <div class="f-left right_btn"><i class="fa fa fa-arrow-right btn_icon"></i></div>
                            </div>
                        </a>
                        @if ($dataInfo->saveProperty)
                            <a data-savelist-url="{{route('front.saveProperty', [$id=$dataInfo->id])}}" class="save_properties"><i class="fa fa-star"> Save</i></a>
                        @else
                            <a data-savelist-url="{{route('front.saveProperty', [$id=$dataInfo->id])}}" class="save_properties"><i class="fa fa-star-o"> Save</i></a>
                        @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
</section>
       
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('.save_properties').click(function(obj) {
            var obj = $(this);
            var url = obj.data('savelist-url');
            console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    if (data.delete == false) {
                        //empty heart
                        obj[0].innerHTML = '';
                        obj[0].innerHTML = '<i class="fa fa-star"> Save</i>';
                    }
                    if (data.delete == true) {
                        //empty heart
                        obj[0].innerHTML = '';
                        obj[0].innerHTML = '<i class="fa fa-star-o"> Save</i>';
                    }
                    //toastr message from response
                    toastr[data.type](data.message);
                }
            });
            //page reload
            // location.reload();
        });
    });
</script>
@endpush
