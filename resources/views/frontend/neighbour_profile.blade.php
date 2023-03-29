@extends('layouts.frontend.app')
@push('css')
    
@endpush

@section('content')
<section class="featured_list br_common overlay" style="background-image: url('{{asset('')}}/assets/frontend/images/neighbourhood-single_bg.jpg');">
    <h1>King West</h1>
    <ul>
        <li><a href="">Share This</a></li>
        <li><a href=""><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
    </ul>
    <p>
        <i>
            A trendy, stylish, and urban neighbourhood.
        </i>
    </p>
</section>
<div class="container">
    <section class="featured_list_box col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="hood-section">
                    <div class="fancy-wrap ">
                        <div class="fancy-icon">
                            <img src="{{asset('')}}/assets/frontend/images/neighborhood_icon/love-it-icon.svg" width="40">
                        </div>
                        <div class="fancy-title">
                            <h3 class="title caps">Why We Love It</h3>
                        </div>
                    </div>
                    <p>With strong similarities to NYC’s Soho Village, the King West neighbourhood has a young and stylish community that’s fully immersed in a city lifestyle. Here, you’re far enough away from the downtown hustle and bustle without sacrificing great entertainment options. This neighbourhood is full of Toronto’s best nightlife and is home to some of Canada’s top restaurants.</p>
                    <p>There are many benefits of living in King West, but our top reason for loving this neighbourhood so much is that everything you could want is within walking distance to your doorstep. All of the services one could need, including doctors, dentists and dry cleaners are all in your area, as are grocery, cafes and even specialty condo-size furniture stores to help decorate your space.</p>
                </div>

                <div class="hood-section">
                    <div class="fancy-wrap ">
                        <div class="fancy-icon">
                            <img src="{{asset('')}}/assets/frontend/images/neighborhood_icon/cant-miss-icon.svg" width="40">
                        </div>
                        <div class="fancy-title">
                            <h3 class="title caps">Can't Miss</h3>
                        </div>
                    </div>
                    <p>Book a dinner at Jacob &amp; Co. for a special night out, or head to Parlour for some of the best pizza on the west side.</p>
                    <p>Anejo has a killer happy hour with incredible tacos and some of the best tequila to be found in Toronto. Pop into Ruby Soho, a new comer to the corner of King and Portland.</p>
                    <p>Brunch options are endless in this neighbourhood - Green Wood, Cibo, Belfast Love - the list goes on and on.</p>
                    <p>King West Village now has the added cache of being the host neighbourhood for the Toronto International Film Festival, which takes place annually. Visit the neighbourhood in September and you’re sure to see some famous stars strolling the streets.</p>
                </div>

                <div class="hood-section">
                    <div class="fancy-wrap ">
                        <div class="fancy-icon">
                            <img src="{{asset('')}}/assets/frontend/images/neighborhood_icon/who-lives-here-icon.svg" width="40">
                        </div>
                        <div class="fancy-title">
                            <h3 class="title caps">Who Lives Here</h3>
                        </div>
                    </div>
                    <p>You'll find all kinds of people living in King West - from young professionals to newly married couples, to retirees living their best downtown life and families enjoying all the city has to offer.</p>
                    <p>Condos&nbsp;have been popping up for a number of years in the King West neighbourhood, and there aren’t many signs showing it’s going to slow down. What we love about condos in King West are they aren’t all the same – there is a bit of character to each building, and you’re able to find a nice selection of floor plans, depending on your size and budget.</p>
                    <p>As for homes, some of the most beautiful streets in Toronto are located just off of King Street West. Walking down Crawford and Massey streets you'll see some incredible semis and detached homes that make city-living with a family seem possible.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="neighbour_form">
                    <h2>Want To See The Area For Yourself?</h2>
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
                            <button type="submit">Send Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="carousel-card col-md-4 mb-4">
                <div class="image-box">
                    <img src="{{asset('')}}/assets/frontend/images/neighbourhood02.jpg" alt="Your Image">
                    <div class="hover-content">
                        <h2>KING WEST</h2>
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
            <div class="carousel-card col-md-4 mb-4">
                <div class="image-box">
                    <img src="{{asset('')}}/assets/frontend/images/neighbourhood03.jpg" alt="Your Image">
                    <div class="hover-content">
                        <h2>KING WEST</h2>
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
            <div class="carousel-card col-md-4 mb-4">
                <div class="image-box">
                    <img src="{{asset('')}}/assets/frontend/images/neighbourhood04.jpg" alt="Your Image">
                    <div class="hover-content">
                        <h2>KING WEST</h2>
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
            <div class="carousel-card col-md-4 mb-4">
                <div class="image-box">
                    <img src="{{asset('')}}/assets/frontend/images/neighbourhood01.jpg" alt="Your Image">
                    <div class="hover-content">
                        <h2>KING WEST</h2>
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
            <div class="carousel-card col-md-4 mb-4">
                <div class="image-box">
                    <img src="{{asset('')}}/assets/frontend/images/neighbourhood02.jpg" alt="Your Image">
                    <div class="hover-content">
                        <h2>KING WEST</h2>
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
            <div class="carousel-card col-md-4 mb-4">
                <div class="image-box">
                    <img src="{{asset('')}}/assets/frontend/images/neighbourhood03.jpg" alt="Your Image">
                    <div class="hover-content">
                        <h2>KING WEST</h2>
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