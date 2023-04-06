@extends('layouts.frontend.app')
@push('css')
    
@endpush

@section('content')
<section class="login_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="signup_title">REGISTRATION FORM</div>
                    </div>
                    <form action="{{ route('user.register') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <h4 style="text-align: center">Account Details</h4>
                            <div class="form-group">
                                <label for="userType">User Type *</label>
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="seller">Seller</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="agent">Agent</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name">First Name *</label>
                                        <input type="text" class="form-control" id="first-name" name="firstName" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="last-name">Last Name *</label>
                                        <input type="text" class="form-control" id="last-name" name="lastName" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password *</label>
                                <input type="password" class="form-control" id="confirm-password" name="password_confirmation" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <button type="submit" class="button">REGISTER</button>
                            <h5 style="text-align: center" class="mt-3">ALREADY REGISTERED?</h5>
                            <div class="mt-2 signup_link">Please <a class="signup" href="{{ route('front.login') }}">LOG IN</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('js')
    
@endpush