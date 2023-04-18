@extends('layouts.frontend.app')
@push('css')
    <style>
        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Hide the images by default */
        .PropertySlides {
            display: none;
        }

        .PropertySlides img {
            height: 500px;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }


        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        /********** listing Details Css ***************/

        .list-details {
            background-color: #e2e0e0;
            border: 1px solid #383838;
        }

        .l-detail {
            padding: 15px;
            display: -webkit-flex;
            display: flex;
            -webkit-align-items: center;
            align-items: center;
            -webkit-justify-content: space-around;
            justify-content: space-around;
        }

        .caps {
            text-transform: uppercase;
        }


        .l-inner h4 {
            font-size: 16px;
        }

        .l-detail h4 {
            margin: 0;
            font-size: 14px;
        }

        .red-text {
            color: #ee404a;
        }

        .list-details .row:not(:last-child) .l-detail {
            border-bottom: 1px solid #383838;
        }

        .list-details .row .l-detail:not(:last-child),
        .list- details .row .l-detail:first-child:last-child,
        .list-details .row .l-detail:nth-child(2):last-child {
            border-right: 1px solid #383838;
        }

        .list-details .row {
            margin: 0;
            display: -webkit-flex;
            display: flex;
        }

        .redmeta-wrap {
            display: -webkit-flex;
            display: flex;
            -webkit-justify-content: space-between;
            justify-content: space-between;
            background-color: #ee404a;
            color: #fff;
            margin-bottom: 5px;
            padding: 15px;
        }

        .redmeta {
            -webkit-flex-grow: 1;
            flex-grow: 1;
            padding: 25px 10px;
            max-width: 230px;
        }

        .centertext {
            text-align: center;
        }

        .redmeta .h1 {
            font-size: 32px;
        }

        .redmeta h3 {
            font-size: 18px;
        }

        /******* Map Section *******/
        .list-location {
            margin-top: 25px;
        }

        .list-location h4 {
            color: #fff;
            background-color: #ee404a;
            padding: 25px 15px;
            margin: 0;
            font-size: 20px;
        }

        .title {
            font-family: oswald;
        }

        .property_status {
            font-size: 25px;
            font-weight: 600;
            color: red;
        }

        .list-amenities ul {
            padding-left: 0;
            list-style-position: inside;
            -webkit-column-count: 2;
            -moz-column-count: 2;
            -ms-column-count: 2;
            column-count: 2;
        }

        .list-amenities ul li {
            font-weight: 500;
        }
    </style>
@endpush

@section('content')
    <div class="mt-5 ml-4 mr-4">
        <section class="featured_list_box col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="fancy-wrap mt-1">
                        <div class="fancy-icon">
                            <span class="property_status">For Sale</span>
                        </div>
                        <div class="fancy-title">
                            <h3 class="title caps">{{ $dataInfo->title }}</h3>
                        </div>
                    </div>
                    <!--- Features ---->
                    <div class="redmeta-wrap">
                        <div class="redmeta centertext">
                            <h1><i class="fa fa-flag"></i></h1>
                            <h3 class="caps"><strong>TYPE: {{ $dataInfo->typeInfo?->type }}</strong></h3>
                        </div>
                        <div class="redmeta centertext">
                            <h1><i class="fa fa-dollar"></i></h1>
                            <h3 class="caps"><strong>PRICE: {{ $dataInfo->price }}</strong></h3>
                        </div>
                        <div class="redmeta centertext">
                            <h1><i class="fa fa-bed"></i></h1>
                            <h3 class="caps"><strong>BEDS: {{ $dataInfo->details?->numOfBedroom }}</strong></h3>
                        </div>
                        <div class="redmeta centertext">
                            <h1><i class="fa fa-tint"></i></h1>
                            <h3 class="caps"><strong>BATHS: {{ $dataInfo->details?->numOfBedroom }}</strong></h3>
                        </div>
                        <div class="redmeta centertext">
                            <h1><i class="fa fa-calculator"></i></h1>
                            <h3 class="caps"><strong>ACRES: {{ $dataInfo->details?->lotAcre}}</strong></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">

                    <!-- Slideshow container -->
                    <div class="slideshow-container" style="margin-top: 10px">

                        <!-- Full-width images with number and caption text -->
                        @foreach ($dataInfo->propertyImages as $item)
                        <div class="PropertySlides">
                            <div class="numbertext">{{$loop->iteration}} / {{$loop->count}}</div>
                            <img style="width:100%;" src="{{$item->imageUrl}}" style="width:100%">
                        </div>
                        @endforeach

                        <!-- Next and previous buttons -->
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>
                    <br>

                    <!-- The dots/circles -->
                    <div style="text-align:center">
                        @foreach ($dataInfo->propertyImages as $item)
                            <span class="dot" onclick="currentSlide($loop->iteration)"></span>
                        @endforeach
                    </div>


                    <!----- Property Summery ------------>
                    <div class="list-details mt-3">
                        <div class="row">
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">PARKING:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->gargaeInfo?->type}}</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">LOCKER:</h4>
                                    <h4 class="red-text"><strong>1 Locker Included</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">NEIGHBOURHOOD:</h4>
                                    <h4 class="red-text"><strong>Yonge &amp; Dundas Square</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">SQUARE FOOTAGE:</h4>
                                    <h4 class="red-text"><strong>1,658 square feet</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">MAINTENANCE FEES:</h4>
                                    <h4 class="red-text"><strong>Approximately $0.57/sqft + utilities metered
                                            separately</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">EXPOSURE:</h4>
                                    <h4 class="red-text"><strong>North-East</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">BALCONY:</h4>
                                    <h4 class="red-text"><strong>122-square-foot terrace</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">KITCHEN:</h4>
                                    <h4 class="red-text"><strong>Open Concept Kitchen</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">GARAGE:</h4>
                                    <h4 class="red-text"><strong>Underground Parking</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">HEAT SOURCE:</h4>
                                    <h4 class="red-text"><strong>Forced Air / Gas</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">AIR CONDITIONING:</h4>
                                    <h4 class="red-text"><strong>Central Air</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">STYLE:</h4>
                                    <h4 class="red-text"><strong>Condominium </strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row"> </div>
                    </div>

                    <div class="hood-section">
                        <div class="fancy-wrap ">
                            <div class="fancy-icon">
                                <img src="{{asset('')}}assets/frontend/images/property_details/description.svg" width="40">
                            </div>
                            <div class="fancy-title">
                                <h3 class="title caps">Description</h3>
                            </div>
                        </div>
                        <h2><strong>Just Listed: Penthouse 1 At Panda Condos</strong></h2>
                        <p>Penthouse 1 at Panda Condos – Introducing Penthouse 1, your final opportunity to own a brand new
                            suite at Panda Condos. If you’ve always dreamed about living sky-high above the entire city,
                            with
                            everything you need at your doorstep, this Penthouse suite is just for you.</p>
                        <p>This brand-new, never-lived-in suite is now available from Lifetime Developments and the benefits
                            of
                            purchasing are incredible.</p>
                        <ul>
                            <li>Purchase directly from the developer with no wait times typical of pre-construction projects
                            </li>
                            <li>Development charges and levies are capped at $0</li>
                            <li>Purchaser receives a brand new Tarion Warranty</li>
                            <li>Full PDI prior to closing</li>
                            <li>Premium underground parking spot included</li>
                            <li>Premium located locker</li>
                            <li>Upgraded appliance package</li>
                            <li>Upgraded flooring package</li>
                            <li>Custom lighting included</li>
                        </ul>
                        <h2><strong>20 Edward Street, Penthouse 1 – Panda Condos</strong></h2>
                        <p>Welcome to your dream home in the sky located in the heart of downtown Toronto! Boasting 1,658
                            square
                            feet of luxurious interior living space, this stunning suite offers everything you could want in
                            a
                            home.</p>
                        <p>Step out onto your 122-square-foot terrace, creating the ideal spot for entertaining guests,
                            enjoying
                            summer BBQs with the gas hook-up, or simply relaxing with a cup of coffee while admiring the
                            views
                            from 30 floors above the city.</p>
                        <p><img decoding="async" loading="lazy" class="aligncenter size-full wp-image-6731"
                                src="assets/images/property_details/details_image01.jpg" alt=""
                                sizes="(max-width: 1920px) 100vw, 1920px" width="1920" height="1281"></p>
                        <p>Enjoy the added convenience of your dedicated laundry room, complete with an upgraded
                            front-loading
                            washer and dryer and plenty of extra storage to keep your life organized and clutter-free.</p>
                    </div>

                    <div class="hood-section">
                        <div class="fancy-wrap ">
                            <div class="fancy-icon">
                                <img src="{{asset('')}}assets/frontend/images/property_details/amenities.svg" width="40">
                            </div>
                            <div class="fancy-title">
                                <h3 class="title caps">Amenities</h3>
                            </div>
                        </div>
                        <div class="list-amenities">
                            <ul>
                                @foreach ($dataInfo->amenities as $item)
                                    <li><b>{{ $item->amenity }}</b></li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>

                    @if ($dataInfo->videoUrl)
                        <div class="hood-section">
                            <div class="fancy-wrap ">
                                <div class="fancy-icon">
                                    <img src="{{asset('')}}assets/frontend/images/property_details/virtual-tour.svg" width="40">
                                </div>
                                <div class="fancy-title">
                                    <h3 class="title caps">Video</h3>
                                </div>
                            </div>
                            <div>
                                <iframe width="100%" height="400px" src="{{$dataInfo->videoUrl}}">
                                </iframe>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="neighbour_form">
                        <h2>Want To Discuss This Property With Us?</h2>
                        <h6>We'd love to show you. Just fill out the form below, and we'll get right back to you.</h6>
                        <form method="post" action="#">
                            <div class="form-group">
                                <input type="text" id="firstName" name="firstName" required placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input type="text" id="lastName" name="lastName" required placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" required placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <input type="tel" id="phone" name="phone" required placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <textarea style="width:100%" type="text" id="message" name="message" required placeholder="Your Message"></textarea>
                            </div>
                            <input style="display:none" value="property name id and link" type="text" id="message"
                                name="message" required placeholder="Your Message">
                            <div class="form-group">
                                <button type="submit">Send Now</button>
                            </div>
                        </form>
                    </div>

                    @if ($dataInfo->address->longitude && $dataInfo->address->latitude)
                    <div class="list-location">
                        <h4 class="title centertext">PROPERTY LOCATION</h4>
                    </div>
                    <div style="width: 100%">
                        <iframe scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            width="100%" height="600" frameborder="0"><a
                                href="https://www.maps.ie/distance-area-calculator.html">measure area map</a>
                        </iframe>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
    @include('layouts.frontend.footer')
@endsection


@push('js')
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("PropertySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
@endpush
