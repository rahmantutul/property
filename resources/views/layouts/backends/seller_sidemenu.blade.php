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
                        <h4 class="badge badge-pill badge-primary p-1">{{env('APP_NAME')}}</h4>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
               
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link nav-link-style" id="theme_btn"><i class="ficon" data-feather="moon" ></i></a>
                </li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex "><span class="user-name font-weight-bolder">{{Auth::guard('seller')->user()->name}}</span><span class="user-status">{{Auth::guard('seller')->user()->role}}</span></div><span class="avatar"><img class="round" src="{{getUserImage(Auth::guard('seller')->user()->avatar)}}" alt="{{Auth::guard('seller')->user()->name}}" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right extra-width" aria-labelledby="dropdown-user">
                    @if(auth()->guard('seller')->user()->can('change-password'))
                        <a class="dropdown-item btn_modal" href="{{route('seller.password.change')}}">
                            <i class="mr-50" data-feather='lock'></i>Change Password
                        </a>
                    @endif
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="mr-50" data-feather="power"></i> Logout</a> 
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    