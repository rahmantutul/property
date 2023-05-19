<!DOCTYPE html>
<html class="loading " lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
   @include('layouts.backends.header')
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
        /* width */
        ::-webkit-scrollbar {
        width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
          background: #77aae5;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #3275fd;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #6d97eb;
        }
    </style>
   @livewireStyles

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="pace-done vertical-layout vertical-menu-modern navbar-floating footer-static menu-expanded" data-open="click" data-menu="vertical-menu-modern" data-col="">


    
  
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
</body>
@livewireScripts
<!-- END: Body-->

</html>