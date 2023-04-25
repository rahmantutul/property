<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('buyer.dashboard')}}">
                    <img src="{{asset('')}}app-assets/images/minilogo.png" style="height:40px; width:40px;">
                    <h2 class="brand-text text-uppercase">{{env("APP_NAME")}}</h2>
                    </a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item {{getActiveMenuClass('buyer.dashboard')}}">
                    <a class="d-flex align-items-center" href="{{route('buyer.dashboard')}}">
                        <i data-feather="grid"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>
            <li class="nav-item {{getActiveMenuClass('buyer.profile.edit')}}">
                <a class="d-flex align-items-center" href="{{route('buyer.profile.edit')}}">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Update Profile</span>
                </a>
            </li>
            <li class="nav-item {{getActiveMenuClass('buyer.property.saved')}}">
                <a class="d-flex align-items-center" href="{{ route('buyer.property.saved') }}">
                    <i data-feather='save'></i>
                    <span class="menu-item text-truncate" data-i18n="Neighbors">Saved Property</span>
                </a>
            </li>
            <li class="nav-item {{getActiveMenuClass('buyer.marketActivity.index')}}?user=1">
                <a class="d-flex align-items-center" href="{{route('buyer.marketActivity.index')}}?user=1">
                    <i data-feather='bar-chart'></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Market Activity</span>
                </a>
            </li>
            <li class="nav-item {{getActiveMenuClass('buyer.helpDesk.index')}}">
                <a class="d-flex align-items-center" href="{{route('buyer.helpDesk.index')}}">
                    <i data-feather='message-square'></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Help Desk</span>
                </a>
            </li>
            <li class="nav-item {{getActiveMenuClass('seller.downloads.index')}}?user=1">
                <a class="d-flex align-items-center" href="{{route('buyer.downloads.index')}}?user=1">
                    <i data-feather='download'></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Downloads</span>
                </a>
            </li>
        </ul>
    </div>
</div>

