<nav class="home-nav">
    <div class="containerx">
        <div class="top-nav">
            <div class="logo">
                <a href="{{ route('front.home') }}" target="_self">
                    <img src="{{ getWebsiteInfo()?->logo }}" alt="US Metro Reilty">
                </a>
            </div>

            <div class="main_menu" id="desktop">
                <ul>
                    <li><a href="{{ route('front.property') }}" >Properties</a></li>
                    <li class="dropdown"><a href="{{ route('front.neighbourHood') }}">Neighborhoods</a>
						<div class="dropdown-content">
							  <div class="row">
                                @foreach (getWebNavInfo() as $neighbour)
                                <div class="column">
                                    <h5>{{ $neighbour->name }}</h5>
                                    @foreach ($neighbour->naighbours as $item)
                                        <a href="{{ route('front.neighbourDetails',['dataId'=>$item->id]) }}">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                                @endforeach
							  </div>
						</div>
					</li>
                    @guest
                    <li><a href="{{ route('front.login') }}">Market Activity</a></li>
                    @else
                        @if (Auth::user()->user_type==1)
                        <li><a href="{{ route('admin.marketActivity.index') }}">Market Activity</a></li>
                        @elseif(Auth::user()->user_type==2)
                        <li><a href="{{ route('agent.marketActivity.index') }}">Market Activity</a></li>
                        @elseif(Auth::user()->user_type==3)
                        <li><a href="{{ route('seller.marketActivity.index') }}">Market Activity</a></li>
                        @elseif(Auth::user()->user_type==4)
                        <li><a href="{{ route('buyer.marketActivity.index') }}">Market Activity</a></li>
                        @endif
                    @endguest

                    <li><a href="{{ route('front.agents') }}">Our Agents</a></li>

                    @guest
                    <li><a href="{{ route('front.login') }}">Downloads</a></li>
                    @else
                        @if (Auth::user()->user_type==1)
                        <li><a href="{{ route('admin.downloads.index') }}">Downloads</a></li>
                        @elseif(Auth::user()->user_type==2)
                        <li><a href="{{ route('agent.downloads.index') }}">Downloads</a></li>
                        @elseif(Auth::user()->user_type==3)
                        <li><a href="{{ route('seller.downloads.index') }}">Downloads</a></li>
                        @elseif(Auth::user()->user_type==4)
                        <li><a href="{{ route('buyer.downloads.index') }}">Downloads</a></li>
                        @endif
                    @endguest
                    {{-- <li><a href="{{ route('front.contact') }}">About Us</a></li> --}}
                    <li><a href="{{ route('front.contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('front.signup') }}">Join Us</a></li>
                </ul>
            </div>

            <div class="navicon-wrap login-signup-menu" id="desktop">
                <ul style="float: right">
                    @guest
                        <li><a href="{{ route('front.signup') }}">Sign Up</a></li>
                        <li><a href="{{ route('front.login') }}">Login</a></li>
                    @else
                        @if (Auth::user()->user_type==1)
                        <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        @elseif(Auth::user()->user_type==2)
                        <li><a href="{{ route('agent.index') }}">Dashboard</a></li>
                        @elseif(Auth::user()->user_type==3)
                        <li><a href="{{ route('seller.index') }}">Dashboard</a></li>
                        @elseif(Auth::user()->user_type==4)
                        <li><a href="{{ route('buyer.index') }}">Dashboard</a></li>
                        @endif
                    @endguest
                </ul>
            </div>

            <div class="mobile_menu">
                <button class="openbtn" onclick="openNav()">☰</button>
            </div>
        </div>
    </div>
</nav>
<div id="mySidepanel" class="sidepanel" style="width: 0px;">
    <img src="">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="{{ route('front.property') }}">Properties</a>

    <a href="{{ route('front.neighbourHood') }}">Neighborhoods</a>
    @guest
        <a href="{{ route('front.login') }}">Market Activity</a>
    @else
        @if (Auth::user()->user_type==1)
            <a href="{{ route('admin.marketActivity.index') }}">Market Activity</a>
        @elseif(Auth::user()->user_type==2)
            <a href="{{ route('agent.marketActivity.index') }}">Market Activity</a>
        @elseif(Auth::user()->user_type==3)
            <a href="{{ route('seller.marketActivity.index') }}">Market Activity</a>
        @elseif(Auth::user()->user_type==4)
            <a href="{{ route('buyer.marketActivity.index') }}">Market Activity</a>
        @endif
    @endguest
    <a href="{{ route('front.agents') }}">Our Agents</a>


    @guest
        <a href="{{ route('front.login') }}">Downloads</a>
    @else
        @if (Auth::user()->user_type==1)
            <a href="{{ route('admin.downloads.index') }}">Downloads</a>
        @elseif(Auth::user()->user_type==2)
            <a href="{{ route('agent.downloads.index') }}">Downloads</a>
        @elseif(Auth::user()->user_type==3)
            <a href="{{ route('seller.downloads.index') }}">Downloads</a>
        @elseif(Auth::user()->user_type==4)
            <a href="{{ route('buyer.downloads.index') }}">Downloads</a>
        @endif
    @endguest

    {{-- <a href="{{ route('front.contact') }}">About Us</a> --}}

    <a href="{{ route('front.contact') }}">Contact Us</a>

    <a href="{{ route('front.signup') }}">Join Us</a>
    @guest
    <a href="{{ route('front.signup') }}" class="sl_btn">Sign Up</a>
    <a href="{{ route('front.login') }}" class="sl_btn">Login</a>
    @endguest
    @auth
        @if (Auth::user()->user_type==1)
            <a href="{{ route('admin.index') }}" class="sl_btn">Dashboard</a>
        @elseif(Auth::user()->user_type==2)
            <a href="{{ route('agent.index') }}" class="sl_btn">Dashboard</a>
        @elseif(Auth::user()->user_type==3)
            <a href="{{ route('seller.index') }}" class="sl_btn">Dashboard</a>
        @elseif(Auth::user()->user_type==4)
            <a href="{{ route('buyer.index') }}" class="sl_btn">Dashboard</a>
        @endif
    @endauth
</div>
