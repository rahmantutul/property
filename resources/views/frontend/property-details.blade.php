@extends('layouts.frontend.app')
@push('css')
    <style>
        /* Slideshow container */

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
                            <h3 class="caps"><strong>Type: {{ $dataInfo->typeInfo?->type }}</strong></h3>
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
                            <h3 class="caps"><strong>BATHS: {{ $dataInfo->details?->numOfBathroom }}</strong></h3>
                        </div>
                        <div class="redmeta centertext">
                            <h1><i class="fa fa-calculator"></i></h1>
                            <h3 class="caps"><strong>ACRES: {{ $dataInfo->details?->lotAcre}}</strong></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">

                    <!-- Slideshow container -->
                    <div class="slideshow-container" style="margin-top: 10px; max-width: 1200px">

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
                            <span class="dot" onclick="currentSlide({{$loop->iteration}})"></span>
                        @endforeach
                    </div>


                    <!----- Property Summery ------------>
                    <div class="list-details mt-3">
                        <div class="row">
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">PARKING:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->details?->parking }}</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">LOCKER:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->details?->locker }}</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">NEIGHBOURHOOD:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->neighbour?->name }}</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">SQUARE FOOTAGE:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->details?->squareFeet }} square feet</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">MAINTENANCE FEES:</h4>
                                    <h4 class="red-text"><strong>Approximately {{ $dataInfo->details?->fees }}
                                            separately</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">EXPOSURE:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->details?->exposure }}</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">BALCONY:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->details?->balcony }}</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">KITCHEN:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->details?->kitchen }}</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">GARAGE:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->gargaeInfo?->type }}</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">HEAT SOURCE:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->details?->heat }}</strong></h4>
                                </div>
                            </div>
                            <div class="l-detail col-sm-4 centertext">
                                <div class="l-inner">
                                    <h4 class="caps light">AIR CONDITIONING:</h4>
                                    <h4 class="red-text"><strong>{{ $dataInfo->details?->cooling }}</strong></h4>
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
                         {!! $dataInfo->previewText !!}
                        <img decoding="async" style="height:500px;" loading="lazy" class="aligncenter size-full wp-image-6731"
                            src="{{ $dataInfo->thumbnail }}" alt=""
                            sizes="(max-width: 1920px) 100vw, 1920px" width="1920" height="1281">
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
                                    <li><b>{{ $item->amenityType?->amenity }}</b></li>
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
                                {!! $dataInfo->videoUrl !!}
                                {{-- <iframe width="100%" height="400px" src="{{}}"> --}}
                                {{-- </iframe> --}}
                            </div>
                        </div>
                    @endif
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
                        <h2 class="text-uppercase">Want To Discuss This Property With Us?</h2>
                        <h6>We'd love to show you. Just fill out the form below, and we'll get right back to you.</h6>
                        <form method="post" action="{{ route('property.message.store') }}"> 
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $dataInfo->id }}">
                            @if (!is_null($dataInfo->user_id))
                             <input type="hidden" name="user_id" value="{{ $dataInfo->user_id }}">
                            @else
                              <input type="hidden" name="user_id" value="1">
                            @endif
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
                                <textarea style="width: 100%; padding:15px;" name="message" id="" cols="30" rows="7" required placeholder="Your Message"></textarea>
                            </div>
                            {{-- <input style="display:none" value="property name id and link" type="text" id="message"
                                name="message" required placeholder="Your Message"> --}}
                            <div class="form-group">
                                <button type="submit">Send Now</button>
                            </div>
                        </form>
                    </div>

                    @if ($dataInfo->address?->longitude && $dataInfo->address?->latitude)
                    <div class="list-location">
                        <h4 class="title centertext">PROPERTY LOCATION</h4>
                    </div>
                    <div style="width: 100%">
                        <iframe scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{$dataInfo->address?->latitude}},{{$dataInfo->address?->longitude}}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
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
