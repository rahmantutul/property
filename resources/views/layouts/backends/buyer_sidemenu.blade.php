<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('buyer.dashboard')}}">
                    <img src="{{asset('')}}/app-assets/images/minilogo.png" style="height:40px; width:40px;">
                    <h2 class="brand-text">{{env("APP_NAME")}}</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
            @if(auth()->guard('buyer')->user()->can('dashboard-menu'))
                <li class="nav-item {{getActiveMenuClass('buyer.dashboard')}}">
                    <a class="d-flex align-items-center" href="{{route('buyer.dashboard')}}">
                        <i data-feather="grid"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

