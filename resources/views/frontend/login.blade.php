@extends('layouts.frontend.app')
@push('css')
    
@endpush

@section('content')

<section class="login_section">
    <div class="container_login">

        <div class="title">PLEASE LOG IN</div>

        @if(Session::has('errMsg')|| Session::has('msg'))
        <div class="alert {{(Session::has('msg'))?'alert-success':'alert-danger'}}">
        {{ (Session::has('msg'))?Session::get('msg'):Session::get('errMsg') }}
        </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label class="label" for="username">User Name *</label>
            <input type="text" id="userName" name="userName" required>
            <label class="label" for="password">Password *</label>
            <input type="password" id="password" name="password" required>
            <div class="forgot">
                <a href="#">FORGOT MY PASSWORD</a> / <a href="#">FORGOT MY USERNAME</a>
            </div>
            <button type="submit" class="button">LOGIN</button>
        </form>
        <div class="mt-2 signup_link">Don't have an account? <a class="signup" href="signup.html">SIGN UP</a></div>
    </div>
</section>

@include('layouts.frontend.footer')

@endsection

@push('js')
    
@endpush