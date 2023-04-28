<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" style="overflow-y:auto; position:fixed;">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('agent.dashboard')}}">
                        <img src="{{asset('')}}app-assets/images/minilogo.png" alt="" srcset="" style="height:40px; width:40px;">
                        <h2 class="brand-text">{{env("APP_NAME")}}</h2>
                    </a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


                <li class="nav-item {{getActiveMenuClass('agent.dashboard')}}">
                    <a class="d-flex align-items-center" href="{{route('agent.dashboard')}}">
                        <i data-feather="grid"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.agent.editProfile')}}">
                    <a class="d-flex align-items-center" href="{{route('agent.agent.editProfile')}}">
                        <i data-feather="user"></i>
                        <span class="menu-title text-truncate" data-i18n="Profile">Update Profile</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.property.index')}}">
                    <a class="d-flex align-items-center" href="{{route('agent.property.index')}}">
                        <i data-feather='home'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Property</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.property.saved')}}">
                    <a class="d-flex align-items-center" href="{{ route('agent.property.saved') }}">
                        <i data-feather='save'></i>
                        <span class="menu-item text-truncate" data-i18n="Neighbors">Saved Property</span>
                    </a>
                 </li>
                <li class="nav-item {{getActiveMenuClass('agent.property.index')}}?is_featured=1">
                    <a class="d-flex align-items-center" href="{{route('agent.property.index')}}?is_featured=1">
                        <i data-feather='bookmark'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Featured Requests</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.property.message')}}">
                    <a class="d-flex align-items-center" href="{{route('agent.property.message')}}">
                        <i data-feather='bookmark'></i>
                        <span class="menu-title text-truncate" data-i18n="Message">Property Message</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.transection.index')}}">
                    <a class="d-flex align-items-center" href="{{route('agent.transection.index')}}">
                        <i data-feather='dollar-sign'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Transection</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.message.index')}}">
                    <a class="d-flex align-items-center" href="{{route('agent.message.index')}}">
                        <i data-feather='message-square'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">User Message</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.marketActivity.index')}}?user=1">
                    <a class="d-flex align-items-center" href="{{route('agent.marketActivity.index')}}?user=1">
                        <i data-feather='bar-chart'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Market Activity</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.helpDesk.index')}}">
                    <a class="d-flex align-items-center" href="{{route('agent.helpDesk.index')}}">
                        <i data-feather='message-square'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Help Desk</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('agent.downloads.index')}}?user=1">
                    <a class="d-flex align-items-center" href="{{route('agent.downloads.index')}}?user=1">
                        <i data-feather='download'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Downloads</span>
                    </a>
                </li>
            </ul>
    </div>
</div>

