<style>
    .extra-width {
        min-width:220px !important;
    }
</style>
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block">
                        <h4 class="badge badge-pill badge-primary p-1"><a href="{{ route('front.home') }}">Visit Website</a></h4>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
               
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link nav-link-style" id="theme_btn"><i class="ficon" data-feather="moon" ></i></a>
                </li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex "><span class="user-name font-weight-bolder">{{Auth::guard('agent')->user()->full_name}}</span><span class="user-status  badge badge-success">Agent</span></div><span class="avatar"><img class="round" src="{{getUserImage(Auth::user()->avatar)}}" alt="{{Auth::guard('agent')->user()->firstName}}" height="50" width="50"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right extra-width" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{route('agent.agent.editProfile')}}">
                            <i class="mr-50" data-feather='lock'></i>Update Profile
                        </a>
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="mr-50" data-feather="power"></i> Logout</a> 
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    