<nav class="home-nav">
    <div class="containerx">
        <div class="top-nav">
            <div class="logo">
                <a href="{{ route('front.home') }}" target="_self">
                    <img src="{{asset('')}}assets/frontend/images/logo.png" alt="US Metro Reilty">
                </a>
            </div>

            <div class="main_menu" id="desktop">
                <ul>
                    <li><a href="{{ route('front.property') }}">Properties</a></li>
                    <li><a href="{{ route('front.neighbourHood') }}" >Neighborhoods</a></li>
                    <li><a href="">Market Activity</a></li>
                    <li><a href="{{ route('front.agents') }}">Our Agents</a></li>
                    <li><a href="">Downloads</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="https://corenyc.com">Contact Us</a></li>
                    <li><a href="https://foresthill.com/">Join Us</a></li>
                </ul>
            </div>

            <div class="navicon-wrap login-signup-menu" id="desktop">
                <ul style="float: right">
                    @guest
                    <li><a href="{{ route('front.signup') }}">Sign Up</a></li>
                    <li><a href="{{ route('front.login') }}">Login</a></li>
                    @endguest
                    @auth
                        @if (Auth::user()->user_type==1)
                            <li><a href="{{ route('admin.index') }}" class="sl_btn">Dashboard</a></li>
                        @elseif(Auth::user()->user_type==2)
                            <li><a href="{{ route('agent.index') }}" class="sl_btn">Dashboard</a></li>
                        @elseif(Auth::user()->user_type==3)
                            <li><a href="{{ route('seller.index') }}" class="sl_btn">Dashboard</a></li>
                        @elseif(Auth::user()->user_type==4)
                            <li><a href="{{ route('buyer.index') }}" class="sl_btn">Dashboard</a></li>
                        @endif
                    @endauth
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
    <a href="">Market Activity</a>
    <a href="our_agent_list.html">Our Agents</a>
    <a href="">Downloads</a>
    <a href="">About Us</a>
    <a href="">Contact Us</a>
    <a href="">Join Us</a>
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
            <a href="{{ route('buyer.index') }}" class="sl_btn">Dashboard</a></li>
        @endif
    @endauth
</div>
