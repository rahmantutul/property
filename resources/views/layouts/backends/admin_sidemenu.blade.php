<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('admin.dashboard')}}">
                    <img src="{{asset('')}}app-assets/images/minilogo.png" style="height:40px; width:40px;">
                    <h2 class="brand-text">{{env("APP_NAME")}}</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


                <li class="nav-item {{getActiveMenuClass('admin.dashboard')}}">
                    <a class="d-flex align-items-center" href="{{route('admin.dashboard')}}">
                        <i data-feather="grid"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>

                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="settings"></i>
                        <span class="menu-title text-truncate" data-i18n="System Info">System Info</span>
                    </a>
                    <ul class="menu-content">
                        <li class="">
                            <a class="d-flex align-items-center" href="">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="District">Email Setting</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="d-flex align-items-center" href="">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="System Setting">System Setting</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='globe'></i>
                        <span class="menu-title text-truncate" data-i18n="Website Setting">Website Setting</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{getActiveMenuClass('admin.banner.edit')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.banner.edit')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Admin">Banner</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.info.edit')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.info.edit')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Admin">Info</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='map'></i>
                        <span class="menu-title text-truncate" data-i18n="Website Setting">Location</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{getActiveMenuClass('admin.country.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.country.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Banners">Country</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.city.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.city.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Sliders">City</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.state.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.state.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Sliders">State</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='users'></i>
                        <span class="menu-title text-truncate" data-i18n="System Info">Users</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{getActiveMenuClass('admin.admin.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.admin.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Admin">Admin</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.agent.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.agent.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Agent">Agent</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.buyer.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.buyer.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Buyer">Buyer</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.seller.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.seller.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Sellers">Sellers</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.role.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.role.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Designation">Designation</span>
                            </a>
                        </li>

                        <li class="{{getActiveMenuClass('admin.permission.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.permission.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="permission">Permission</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='alert-octagon'></i>
                        <span class="menu-title text-truncate" data-i18n="System Info">Pending Users</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{getActiveMenuClass('admin.agent.index')}}?pending_status=0">
                            <a class="d-flex align-items-center" href="{{route('admin.agent.index')}}?pending_status=0">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Agent">Agent</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.buyer.index')}}?pending_status=0">
                            <a class="d-flex align-items-center" href="{{route('admin.buyer.index')}}?pending_status=0">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Buyer">Buyer</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.seller.index')}}?pending_status=0">
                            <a class="d-flex align-items-center" href="{{route('admin.seller.index')}}?pending_status=0">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Sellers">Sellers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='home'></i>
                        <span class="menu-title text-truncate" data-i18n="System Info">Property Manage</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{getActiveMenuClass('admin.property.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.property.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Admin">Property List</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.resoproperty.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.resoproperty.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Admin">Api Property List</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.aminetyType.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.aminetyType.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Agent">Amenity Type List</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.category.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.category.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Buyer">Category List</span>
                            </a>
                        </li>
                        <li class="{{getActiveMenuClass('admin.garageType.index')}}">
                            <a class="d-flex align-items-center" href="{{route('admin.garageType.index')}}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Sellers">Garage Type List</span>
                            </a>
                        </li>
                    </ul>
                 </li>
                 <li class="nav-item {{getActiveMenuClass('admin.neighbour.index')}}">
                    <a class="d-flex align-items-center" href="{{ route('admin.neighbour.index') }}">
                        <i data-feather='user-check'></i>
                        <span class="menu-item text-truncate" data-i18n="Neighbors">Neighbours</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('admin.transection.index')}}">
                    <a class="d-flex align-items-center" href="{{route('admin.transection.index')}}">
                        <i data-feather='dollar-sign'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Transection</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('admin.marketActivity.index')}}">
                    <a class="d-flex align-items-center" href="{{route('admin.marketActivity.index')}}">
                        <i data-feather='bar-chart'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Market Activity</span>
                    </a>
                </li>
                <li class="nav-item {{getActiveMenuClass('admin.property.index')}}?is_featured=1">
                    <a class="d-flex align-items-center" href="{{route('admin.property.index')}}?is_featured=1">
                        <i data-feather='bookmark'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboard">Featured Requests</span>
                    </a>
                </li>

            </ul>
    </div>
</div>

