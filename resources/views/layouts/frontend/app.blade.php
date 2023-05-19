<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>US Metro Reality</title>

        <link rel="stylesheet" href="{{asset('')}}assets/frontend/main.css" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset('')}}assets/frontend/style.min.css" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset('')}}assets/frontend/style-min.css" type="text/css" media="all">
        <link href="{{asset('')}}assets/frontend/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('')}}assets/frontend/bootstrap/css/bootstrap.min.css" type="text/css" media="all">
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

        <script type="text/javascript" src="{{asset('')}}assets/frontend/jquery.min.js"></script>
        <script type="text/javascript" src="{{asset('')}}assets/frontend/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{asset('')}}assets/frontend/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="{{asset('')}}assets/frontend/production-min.js"></script>

        @stack('css')

    </head>

    <body class="home page-template-default page page-id-2 drawer drawer--right page-home post-type-page" data-animation="scaleDown" data-hijacking="off" data-new-gr-c-s-check-loaded="14.1097.0" data-gr-ext-installed="">
        <div class="faux-body">


           @include('layouts.frontend.navbar')

           @yield('content')

        </div>
        <script>
            const expandBtn = document.querySelector('.expand-btn');
            const section2 = document.querySelector('.search-form-section-2');

            expandBtn.addEventListener('click', function() {
                section2.classList.toggle('show');
            });
        </script>
        <script>
            $(document).ready(function() {
                var sliderWidth = $(".carousel-card").outerWidth() * 3;
                var sliderPosition = 0;

                $(".next-btn").click(function() {
                    sliderPosition -= sliderWidth;
                    if (sliderPosition < -sliderWidth * 2) {
                        sliderPosition = 0;
                    }
                    $(".carousel-slider").css("transform", "translateX(" + sliderPosition + "px)");
                });

                $(".prev-btn").click(function() {
                    sliderPosition += sliderWidth;
                    if (sliderPosition > 0) {
                        sliderPosition = -sliderWidth * 2;
                    }
                    $(".carousel-slider").css("transform", "translateX(" + sliderPosition + "px)");
                });

                setInterval(function() {
                    sliderPosition -= sliderWidth;
                    if (sliderPosition < -sliderWidth * 2) {
                        sliderPosition = 0;
                    }
                    $(".carousel-slider").css("transform", "translateX(" + sliderPosition + "px)");
                }, 5000);
            });

        </script>
        <script>
            function openNav() {
                document.getElementById("mySidepanel").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidepanel").style.width = "0";
            }
        </script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/645ddb84ad80445890ec84ce/1h07a2vjm';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
    <!--End of Tawk.to Script-->
        {!! Toastr::message() !!}
        @stack('js')
    </body>
</html>
