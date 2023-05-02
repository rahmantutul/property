@extends('layouts.frontend.app')
@push('css')

@endpush

@section('content')
<section class="featured_list br_common overlay" style="background-image: url('{{asset('')}}assets/frontend/images/neighbourhood-single_bg.jpg');">
    <h1>{{ $dataInfo->name }}</h1>
    <ul>
        <li><a href="">Share This</a></li>
        <li><a href="https://www.facebook.com/" target="__blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="https://twitter.com/"  target="__blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href="https://www.google.com/intl/en-GB/gmail/about/" target="__blank"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
    </ul>
    <p>
        <i>
            A trendy, stylish, and urban neighbourhood.
        </i>
    </p>
</section>
<div class="container-fluid">
    <section class="featured_list_box col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="hood-section">
                    <div class="fancy-wrap ">
                        <div class="fancy-icon">
                            <img src="{{asset('')}}assets/frontend/images/neighborhood_icon/love-it-icon.svg" width="40">
                        </div>
                        <div class="fancy-title">
                            <h3 class="title caps">{{ $dataInfo->titleOne }}</h3>
                        </div>
                    </div>
                    {!! $dataInfo->titleOneDetails !!}
                </div>

                <div class="hood-section">
                    <div class="fancy-wrap ">
                        <div class="fancy-icon">
                            <img src="{{asset('')}}assets/frontend/images/neighborhood_icon/cant-miss-icon.svg" width="40">
                        </div>
                        <div class="fancy-title">
                            <h3 class="title caps">{{ $dataInfo->titleTwo }}</h3>
                        </div>
                    </div>
                    {!! $dataInfo->titleTwoDetails !!}
                </div>

                <div class="hood-section">
                    <div class="fancy-wrap ">
                        <div class="fancy-icon">
                            <img src="{{asset('')}}assets/frontend/images/neighborhood_icon/who-lives-here-icon.svg" width="40">
                        </div>
                        <div class="fancy-title">
                            <h3 class="title caps">{{ $dataInfo->titleThree }}</h3>
                        </div>
                    </div>
                    {!! $dataInfo->titleThreeDetails !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="neighbour_form">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if(session()->has('errMessage'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <h2>Want To See The Area For Yourself?</h2>
                    <h6>We'd love to show you. Just fill out the form below, and we'll get right back to you.</h6>
                    <form method="post" action="{{ route('neighbour.message.store') }}"> @csrf
                        <div class="form-group">
                            <input type="text" id="firstName" name="name" required placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" required placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" required placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="message" required="" placeholder="Your Queries"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit">Send Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h5 class="agent_all_title"><b class="agent_all_title_box">Neighbour Properties</b></h5>
                <div class="row">
                    @foreach ($dataList as $dataInfo)
                    <div class="carousel-card col-md-4 mb-4">
                        <div class="image-box">
                            <img src="{{getImage($dataInfo->thumbnail)}}" alt="{{$dataInfo->title}}">
                            <div class="hover-content">
                                <h5>FOR SALE | ${{$dataInfo->price}}</h5>
                                <h2>FOR SALE: {{(!is_null($dataInfo->details)) ? $dataInfo->details->totalUnit.','.$dataInfo->details->squareFeet:''}}</h2>
                                <h5><span><i class="fa fa-bed"></i>{{(!is_null($dataInfo->details)) ? $dataInfo->details->numOfBedroom:''}} BEDS</span> <span style="margin-left: 10px;"><i class="fa fa-tint"></i> {{(!is_null($dataInfo->details)) ? $dataInfo->details->numOfBathroom:''}} Baths</span></h5>
        
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
            </div>
        </div>
    </section>
</div>
<footer class="home">

    <div class="topsection">
        <h2>Where you can find us</h2>
        <div class="dek"></div>
    </div>

    <div class="map-wrapper">

        <!-- Map Locations -->
        <div class="locmaps">

            <div class="locmap">
                <img src="./CORE Real Estate_files/flatiron_map.png" alt="">
                <p></p><p><strong>HEADQUARTERS</strong><br>
                149 FIFTH AVE, 11TH FL<br>
                NEW YORK, NY 10010<br>
                <a href="tel:212-419-8580" target="_blank" rel="noopener noreferrer">212-419-8580</a></p>
                <p></p>
            </div>


        </div>

        <div class="footer-extras">

            <!-- Back to Top -->
            <div class="btt">
                <a href="https://corenyc.com/#" target="_self">
                    <svg width="19px" height="10px" viewBox="0 0 19 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs></defs>
                        <g id="APPROVED-PAGES" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="19-Homepage---7-(option2)-Locations" transform="translate(-791.000000, -977.000000)" fill="#D8D8D8">
                                <polygon id="Rectangle-23" transform="translate(800.428932, 986.428932) rotate(-135.000000) translate(-800.428932, -986.428932) " points="807.096194 979.76167 807.096194 993.096194 793.76167 993.096194"></polygon>
                            </g>
                        </g>
                    </svg><br>
                    Back To Top </a>
            </div>

            <!-- Disclaimer -->
            <div class="disclaimer">
                <p><a href="https://corenyc.com/1228857-2/" target="_self">STANDARDIZED OPERATING PROCEDURE FOR PURCHASERS OF REAL ESTATE </a><br>
                    Disclaimer: All data and information set forth on this website regarding real property, for sale, purchase, rental and/or financing, are from sources regarded as reliable. No warranties are made as to the accuracy of any descriptions and/or other details and such information is subject to errors, omissions, changes of price, tenancies, commissions, prior sales, leases or financing, or withdrawal without notice. Square footages are approximate and may be verified by consulting a professional architect or engineer.</p>
            </div>

        </div><!-- ./footer-extras -->

    </div><!-- ./map-wrapper -->
@endsection

@push('js')

@endpush
