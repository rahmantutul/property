<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('') }}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}app-assets/images/ico/favicon.ico">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/pages/app-chat.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/pages/app-chat-list.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/style.css">
    <style>
        .avatar {
            height: 50px;
            width: 50px;
        }

        .list-group-item:hover,
        .list-group-item:focus {
            background: rgba(24, 32, 23, 0.37);
            cursor: pointer;
        }

        .chatbox {
            height: 80vh !important;
            overflow-y: scroll;
        }

        .message-box {
            height: 70vh !important;
            overflow-y: scroll;
            display: flex;
            flex-direction: column-reverse;
        }

        .single-message {
            background: #f1f0f0;
            border-radius: 12px;
            padding: 10px;
            margin-bottom: 10px;
            width: fit-content;
        }

        .received {
            margin-right: auto !important;
        }

        .sent {
            margin-left: auto !important;
            background: #3490dc;
            color: white !important;
        }

        .sent small {
            color: white !important;
        }

        .link:hover {
            list-style: none !important;
            text-decoration: none;
        }

        .online-icon {
            font-size: 11px !important;
        }

        #file-area {
            cursor: pointer;
        }

        #file-area>label>input {
            display: none !important;
        }
    </style>
    <!-- END: Custom CSS-->
    @livewireStyles
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar navbar-floating footer-static   menu-collapsed"
    data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    @if (auth()->guard('admin')->check())
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
    @php
        if (
            auth()
                ->guard('admin')
                ->check()
        ) {
            $currentUserPhoto = auth()
                ->guard('admin')
                ->user()->avatar;
            $currentUserName = auth()
                ->guard('admin')
                ->user()->avatar;
        }
        if (
            auth()
                ->guard('agent')
                ->check()
        ) {
            $currentUserPhoto = auth()
                ->guard('agent')
                ->user()->avatar;
            $currentUserName = auth()
                ->guard('agent')
                ->user()->avatar;
        }
        if (
            auth()
                ->guard('buyer')
                ->check()
        ) {
            $currentUserPhoto = auth()
                ->guard('buyer')
                ->user()->avatar;
            $currentUserName = auth()
                ->guard('buyer')
                ->user()->avatar;
        }
        if (
            auth()
                ->guard('seller')
                ->check()
        ) {
            $currentUserPhoto = auth()
                ->guard('seller')
                ->user()->avatar;
            $currentUserName = auth()
                ->guard('seller')
                ->user()->avatar;
        }
    @endphp

    <div class="app-content content chat-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <!-- BEGIN: Content-->
            @yield('content')
            <!-- END: Content-->
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy;
                {{ date('Y') }}<a class="ml-25" href="#" target="_blank"></a><span
                    class="d-none d-sm-inline-block">, All rights Reserved</span></span><span
                class="float-md-right d-none d-md-block">Design & Developed with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('') }}app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('') }}app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('') }}app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('') }}app-assets/js/scripts/pages/app-chat.js"></script>
    <!-- END: Page JS-->
    @livewireScripts
</body>
<!-- END: Body-->

</html>
