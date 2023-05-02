@extends('layouts.frontend.app')
@push('css')

@endpush

@section('content')
<div class="hero" style="opacity: 1;">
    <div class="dotmanager">
        <ul>
            <li class="dots"><a href="#" data-dotindex="1" class="active" target="_self"></a></li>
            <li class="dots"><a href="#" data-dotindex="2" target="_self"></a></li>
            <li class="dots"><a href="#" data-dotindex="3" target="_self"></a></li>
            <li class="dots"><a href="#" data-dotindex="4" target="_self"></a></li>
            <li class="dots"><a href="#" data-dotindex="5" target="_self"></a></li>
            <li class="dots"><a href="#" data-dotindex="6" target="_self"></a></li>
        </ul>
    </div>
   <div class="slider" style="height: 3552px;">
        <div class="slide-pic active" style="background-image: url({{getBannerImage( $bannerInfo?->play_film_banner)}}); background-size: cover !important; height: 592px; z-index: 6;" data-index="1">
            <div class="slatelink pageslate playbtn">
                <span class="homedown"></span>

                <a href="#" data-video="" target="_self">
                    <span class="link-cont">Play Film</span>
                </a>
            </div>
        </div>

        <div class="slide-pic" style="background-image: url({{getBannerImage( $bannerInfo?->search_banner)}}); height: 592px; z-index: 5;" data-index="2">
            <div target="_self" class="search_heading">
                <h2 style="color:#ffffff; font-weight:700;">Discover Your Place to Live</h2>
            </div>
            <!-------- Start Search -------------------------->
        <form action="{{route('front.propertySearch')}}" method="get">
            <div class="search-form">
                    <div class="search-form-section-1">
                        <i class="fa fa-search" id="ic_3"></i>
                        <input type="text" placeholder="Any Keywords...." class="form-control" name="searchKey">
                        <select class="custom-select" name="bed">
                            <option value="">Any Beds</option>
                            <option value="1">1+ Beds</option>
                            <option value="2">2+ Beds</option>
                            <option value="3">3+ Beds</option>
                            <option value="4">4+ Beds</option>
                            <option value="5">5+ Beds</option>
                            <option value="6">6+ Beds</option>
                            <option value="7">7+ Beds</option>
                            <option value="8">8+ Beds</option>
                        </select>
                        <select class="custom-select" name="bathroom">
                            <option value="">Bathrooms</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <div class="expand-btn">
                            <i class="fa fa-cog"></i>
                        </div>
                        <button type="submit">Go</button>
                    </div>
                    <div class="search-form-section-2">
                        <div class="for_sale  mt-3 f-left">
                            <select class="custom-select" id="spe_sel1" name="typeId">
                                <option value="">Type</option>
                                @foreach ($types as $item)
                                <option value="{{ $item->id }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="property_types mt-3 f-left">
                            <select class="custom-select" id="spe_sel2" name="neighbourhoodId">
                                <option value="">Neighbour</option>
                                @foreach ($neighbours as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="search-form-price-range  mt-3 f-left">
                            <label><b>Price:</b> from <b>$0</b> to <b>$3,000,000+</b></label>
                            <input type="range" min="0" max="3000000" value="" name="price">
                        </div>
                    </div>
            </div>
            <!-- --------/End Search-------------------------->

            <div class="slatelink pageslate">
                <a href="{{route('front.propertySearch')}}" target="_self">
                    <span class="link-cont">Search Properties</span>
                </a>
            </div>
        </form>
        </div>

        <div class="featured_properties slide-pic" style="background-image: url({{getBannerImage( $bannerInfo?->featured_banner)}}); height: 592px; z-index: 4;" data-index="3">
            <h2 class="featured_properties_heading">Featured Properties</h2>
            <div class="carousel-container">
                <div class="carousel-slider">
                    @foreach ($sliderProperties as $item)
                        <div class="carousel-card">
                            <div class="image-box">
                                <img src="{{$item->thumbnail}}" alt="Your Image">
                                <div class="hover-content">
                                    <h5>FOR SALE | ${{ $item->price }}</h5>
                                    <h2>FOR SALE: {{ $item->title }} | {{Str::limit($item?->address?->streetAddressOne, 10)}}</h2>
                                    <h5><span><i class="fa fa-bed"></i> {{$item->details?->numOfBedroom}}+ BEDS</span> <span style="margin-left: 10px;"><i class="fa fa-tint"></i> {{$item->details->numOfBathroom}}+ Baths</span></h5>

                                    <a href="{{ route('front.propertyDetails', $id=$item->id) }}" class="learn_more_btn">
                                        <div class="button_lm">
                                            <div class="f-left left_btn">Learn More</div>
                                            <div class="f-left right_btn"><i class="fa fa fa-arrow-right btn_icon"></i></div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="prev-btn">&lt;</button>
                <button class="next-btn">&gt;</button>
            </div>
            <div class="see_all_featured_list">
                <a href="{{ route('front.property') }}" class="learn_more_btn">
                    <div class="button_lm">
                        <div class="f-left left_btn">See All Listings</div>
                        <div class="f-left right_btn seealll"><i class="fa fa fa-arrow-right btn_icon"></i></div>
                    </div>
                </a>
            </div>



            <div class="slatelink pageslate">
                <a href="">
                    <span class="link-cont">Featured Properties</span>
                </a>
            </div>
        </div>

        <div class="slide-pic" style="background-image: url({{getBannerImage( $bannerInfo?->map_banner)}}); height: 592px; z-index: 3;" data-index="4">
            <div class="slatelink pageslate">
                <a href="{{ route('front.agents') }}" target="_self">
                    <span class="link-cont">Agents</span>
                </a>
            </div>
        </div>

        <div class="slide-pic" style="background-image: url({{getBannerImage( $bannerInfo?->neighbour_banner)}}); height: 592px; z-index: 2;" data-index="5">
            <div class="slatelink pageslate">
                <a href="{{ route('front.neighbourHood') }}" target="_self">
                    <span class="link-cont">Neighborhoods</span>
                </a>
            </div>
        </div>

        @include('layouts.frontend.footer')

    </div>
</div>
@endsection

@push('js')

@endpush
