
<!DOCTYPE html>
<html class="loading " lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
   @include('layouts.backends.header')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="pace-done vertical-layout vertical-menu-modern navbar-floating footer-static menu-expanded" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <div id="app">
    @if(auth()->guard('admin')->check())
        @include('layouts.backends.admin_navbar')
        @include('layouts.backends.admin_sidemenu')
    @elseif(auth()->guard('agent')->check())
        @include('layouts.backends.agent_navbar')
        @include('layouts.backends.agent_sidemenu')
    @elseif(auth()->guard('buyer')->check())
        @include('layouts.backends.buyer_navbar')
        @include('layouts.backends.buyer_sidemenu')
    @elseif(auth()->guard('seller')->check())
        @include('layouts.backends.seller_navbar')
        @include('layouts.backends.seller_sidemenu')
    @endif
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content chat-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-fluid p-0">
        	@yield('content')
         </div>
     </div>
    @include('layouts.backends.footer')

   <div class="modal fade" id="common_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
    </div>
</body>
<!-- END: Body-->

</html>
