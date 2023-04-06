<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('seller.dashboard')}}">
                    <img src="{{asset('')}}app-assets/images/minilogo.png" alt="" srcset="" style="height:40px; width:40px;">
                    <h2 class="brand-text">{{env("APP_NAME")}}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class="nav-item {{getActiveMenuClass('seller.dashboard')}}">
                <a class="d-flex align-items-center" href="{{route('seller.dashboard')}}">
                    <i data-feather="grid"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{getActiveMenuClass('seller.seller.editProfile')}}">
                <a class="d-flex align-items-center" href="{{route('seller.seller.editProfile')}}">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate" data-i18n="Profile">Update Profile</span>
                </a>
            </li>
            <li class="nav-item {{getActiveMenuClass('seller.property.index')}}">
                <a class="d-flex align-items-center" href="{{route('seller.property.index')}}">
                    <i data-feather='home'></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Property</span>
                </a>
            </li>
            <li class="nav-item {{getActiveMenuClass('seller.property.index')}}?is_featured=1">
                <a class="d-flex align-items-center" href="{{route('seller.property.index')}}?is_featured=1">
                    <i data-feather='bookmark'></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Featured Requests</span>
                </a>
            </li>
        </ul>
</div>
</div>

