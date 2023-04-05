
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>{{env('APP_NAME')}} | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('')}}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('')}}app-assets/images/ico/favicon.ico">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/pages/app-chat.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/pages/app-chat-list.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
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
@php
if(auth()->guard('admin')->check()){
    $currentUserPhoto=auth()->guard('admin')->user()->avatar;
    $currentUserName=auth()->guard('admin')->user()->avatar;
}
if(auth()->guard('agent')->check()){
    $currentUserPhoto=auth()->guard('agent')->user()->avatar;
    $currentUserName=auth()->guard('agent')->user()->avatar;
}
if(auth()->guard('buyer')->check()){
    $currentUserPhoto=auth()->guard('buyer')->user()->avatar;
    $currentUserName=auth()->guard('buyer')->user()->avatar;
}
if(auth()->guard('seller')->check()){
    $currentUserPhoto=auth()->guard('seller')->user()->avatar;
    $currentUserName=auth()->guard('seller')->user()->avatar;
}
@endphp
    <!-- BEGIN: Content-->
    <div class="app-content content chat-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">


                    <!-- Chat Sidebar area -->
                    <div class="sidebar-content">
                        <span class="sidebar-close-icon">
                            <i data-feather="x"></i>
                        </span>
                        <!-- Sidebar header start -->
                        <div class="chat-fixed-search">
                            <div class="d-flex align-items-center w-100">
                                <div class="sidebar-profile-toggles">
                                    <div class="avatar avatar-border">
                                        <img src="{{getUserImage($currentUserPhoto)}}" alt="user_avatar" height="42" width="42" />
                                        <span class="avatar-status-online"></span>
                                    </div>
                                </div>
                                <div class="input-group input-group-merge ml-1 w-100">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text round"><i data-feather="search" class="text-muted"></i></span>
                                    </div>
                                    <input type="text" class="form-control round" id="query" placeholder="Search or start a new chat" aria-label="Search..." aria-describedby="chat-search"  oninput="searchQueryList(this.value)" />
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar header end -->

                        <!-- Sidebar Users start -->
                        <div id="users-list" class="chat-user-list-wrapper list-group">
                            <h4 class="chat-list-title">Support</h4>
                            <ul class="chat-users-list chat-list media-list" id="query-list">
                            @foreach($helpQueries as $key=>$helpQuery)
                            @php
                                if($helpQuery->userType==1){
                                    $userType='admin';
                                    $userImage=(!is_null($helpQuery->adminInfo))?$helpQuery->adminInfo->avatar:'';
                                    $userName=(!is_null($helpQuery->adminInfo))?$helpQuery->adminInfo->full_name:'';
                                    $userColor="#28c76f";
                                }
                                if($helpQuery->userType==2){
                                    $userType='agent';
                                     $userImage=(!is_null($helpQuery->agentInfo))?$helpQuery->agentInfo->avatar:'';
                                     $userName=(!is_null($helpQuery->agentInfo))?$helpQuery->agentInfo->full_name:'';
                                     $userColor="#3518ef";
                                }
                                if($helpQuery->userType==3){
                                    $userType='buyer';
                                     $userImage=(!is_null($helpQuery->buyerInfo))?$helpQuery->buyerInfo->avatar:'';
                                     $userName=(!is_null($helpQuery->buyerInfo))?$helpQuery->buyerInfo->full_name:'';
                                     $userColor="#c41bd3";
                                }
                                if($helpQuery->userType==4){
                                    $userType='seller';
                                     $userImage=(!is_null($helpQuery->sellerInfo))? $helpQuery->sellerInfo->avatar:'';
                                     $userName=(!is_null($helpQuery->sellerInfo))?$helpQuery->sellerInfo->full_name:'';
                                     $userColor="#1bbfd3";
                                }
                                if($helpQuery->userType==5){
                                    $userType='guest';
                                    $userImage=getDefaultUserImage();
                                    $userName="Guest User";
                                    $userColor="#dd4511";
                                }

                            @endphp
                                <li onclick="loadCoversation('{{$helpQuery->id}}','{{$userType}}','{{$userImage}}','{{$userName}}','{{$userColor}}')">
                                    <span class="avatar">
                                        <img src="{{getUserImage($userImage)}}" height="42" width="42" alt="" />
                                        <span class="avatar-status-offline" style="background-color: {{$userColor}}!important;"></span>
                                    </span>
                                    <div class="chat-info flex-grow-1">
                                        <h5 class="mb-0">{{$userName}}</h5>
                                        <p class="card-text text-truncate">
                                            {{$helpQuery->subject}}
                                        </p>
                                    </div>
                                    <div class="chat-meta text-nowrap">
                                        <small class="float-right mb-25 chat-time">{{$helpQuery->updated_at->diffForHumans()}}</small>
                                        <!-- <span class="badge badge-danger badge-pill float-right">3</span> -->
                                    </div>
                                </li>
                            @endforeach
                            </ul>

                        </div>
                        <!-- Sidebar Users end -->
                    </div>
                    <!--/ Chat Sidebar area -->

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <!-- Main chat area -->
                        <section class="chat-app-window">
                            <!-- To load Conversation -->
                            <div class="start-chat-area">
                                <div class="mb-1 start-chat-icon">
                                    <i data-feather="message-square"></i>
                                </div>
                                <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
                            </div>
                            <!--/ To load Conversation -->

                            <!-- Active Chat -->
                            <div class="active-chat d-none">
                                <!-- Chat Header -->
                                <div class="chat-navbar">
                                    <header class="chat-header">
                                        <div class="d-flex align-items-center">
                                            <div class="sidebar-toggle d-block d-lg-none mr-1">
                                                <i data-feather="menu" class="font-medium-5"></i>
                                            </div>
                                            <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
                                                <img src="{{getDefaultUserImage()}}" alt="avatar" height="36" width="36"  id="activeUserImage" />
                                                <span class="avatar-status-busy" id="avtiveUserStatus"></span>
                                            </div>
                                            <h6 class="mb-0" id="activeUserName">Guest User</h6>
                                        </div>

                                    </header>
                                </div>
                                <!--/ Chat Header -->

                                <!-- User Chat messages -->
                                <div class="user-chats">
                                    <div class="chats" id="chats">

                                    </div>
                                </div>
                                <!-- User Chat messages -->

                                <!-- Submit Chat form -->
                                <form class="chat-app-form" action="javascript:void(0);" onsubmit="sendMessage()">
                                    <div class="input-group input-group-merge mr-1 form-send-message">
                                        <!-- <div class="input-group-prepend">
                                            <span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
                                        </div> -->
                                        <input type="text" class="form-control message" placeholder="Type your message or use speech to text" id="message" />

                                    </div>
                                    <button type="button" class="btn btn-primary send" onclick="sendMessage()">
                                        <i data-feather="send" class="d-lg-none"></i>
                                        <span class="d-none d-lg-block">Send</span>
                                    </button>
                                </form>
                                <!--/ Submit Chat form -->
                            </div>
                            <!--/ Active Chat -->
                        </section>
                        <!--/ Main chat area -->

                        <!-- User Chat profile right area -->

                        <!--/ User Chat profile right area -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{date('Y')}}<a class="ml-25" href="#" target="_blank"></a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Design & Developed with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('')}}app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('')}}app-assets/js/core/app-menu.js"></script>
    <script src="{{asset('')}}app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('')}}app-assets/js/scripts/pages/app-chat.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
<script>
var queryId=null;
window.setInterval(function(){
if(queryId!=null){
    getMessages(queryId);
}
  searchQueryList($("#query").val());
}, 20000);
function searchQueryList(name) {

        @if(auth::guard('admin')->check())
            var url="{{route('admin.helpDesk.index')}}?search=aa&name="+name;
        @elseif(auth::guard('agent')->check())
            var url="{{route('agent.helpDesk.index')}}?search=aa&name="+name;
        @elseif(auth::guard('buyer')->check())
            var url="{{route('buyer.helpDesk.index')}}?search=aa&name="+name;
        @elseif(auth::guard('seller')->check())
            var url="{{route('seller.helpDesk.index')}}?search=aa&name="+name;
        @endif

            $.ajax({
            type: 'get',
            url:url,
            // data: {"_token": "{{ csrf_token() }}"},
            success: function(response) {
                $("#query-list").html(response);
            },
            error:function (response){
                 $("#query-list").html(response);
            }
        })

}
function loadCoversation(helpQueryId,userType,userImage,userName,userColor) {

    queryId=helpQueryId;
    $("#chats").html("");
    $("#activeUserImage").attr("src", userImage);
    $("#activeUserName").text(userName);
    $("#avtiveUserStatus"). css("background-color",userColor);
    getMessages(helpQueryId);
}
function getMessages(helpQueryId) {
    @if(auth::guard('admin')->check())
        var url="{{route('admin.helpDesk.messages')}}?dataId="+helpQueryId;
    @elseif(auth::guard('agent')->check())
       var url="{{route('agent.helpDesk.messages')}}?dataId="+helpQueryId;
    @elseif(auth::guard('buyer')->check())
      var url="{{route('buyer.helpDesk.messages')}}?dataId="+helpQueryId;
    @elseif(auth::guard('seller')->check())
       var url="{{route('seller.helpDesk.messages')}}?dataId="+helpQueryId;
    @endif

   $.ajax({
            type: 'get',
            url:url,
            // data: {"_token": "{{ csrf_token() }}"},
            success: function(response) {
                $("#chats").html(response);
            },
            error:function (response){
                 $("#chats").html(response);
            }
        })
}
function sendMessage(){
    @if(auth::guard('admin')->check())
        var url="{{route('admin.helpDesk.sendMessage')}}";
    @elseif(auth::guard('agent')->check())
       var url="{{route('agent.helpDesk.sendMessage')}}";
    @elseif(auth::guard('buyer')->check())
      var url="{{route('buyer.helpDesk.sendMessage')}}";
    @elseif(auth::guard('seller')->check())
       var url="{{route('seller.helpDesk.sendMessage')}}";
    @endif

    var formData=new FormData();
    formData.append("dataId",queryId);
    formData.append("message",$("#message").val());
    formData.append("_token","{{csrf_token()}}");
    $.ajax({
            type: 'post',
            url:url,
            data:{
                dataId:queryId,
                message:$("#message").val(),
                _token:"{{csrf_token()}}",
            },
            success: function(response) {
                    getMessages(queryId);
                    searchQueryList($("#query").val());
                    $("#message").val("");
            },
            error:function (response){
                getMessages(queryId);
                searchQueryList($("#query").val());
            }
        })
}
</script>
</body>
<!-- END: Body-->

</html>
