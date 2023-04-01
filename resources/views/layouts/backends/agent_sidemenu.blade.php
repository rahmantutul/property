<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('agent.dashboard')}}">
                        <img src="{{asset('')}}/app-assets/images/minilogo.png" alt="" srcset="" style="height:40px; width:40px;">
                        <h2 class="brand-text">{{env("APP_NAME")}}</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
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
            </ul>
    </div>
</div>

