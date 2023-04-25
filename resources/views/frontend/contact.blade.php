
@extends('layouts.frontend.app')
@push('css')

@endpush

@section('content')
<section class="contact_us">
    <h2>Get in Touch!</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5 mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" name="first-name" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input placeholder="Email" type="email" class="form-control" name="confirm-email" required="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control" id="user-type" name="user-type">
                                <option value="" selected="" disabled="">How can we help?</option>
                                <option value="buyer">Buying and Selling Inquiries</option>
                                <option value="agent">Become a CORE Agent</option>
                                <option value="agent">Join the CORE Team</option>
                                <option value="agent">New Development Inquiries</option>
                                <option value="agent">Commercial Inquiries</option>
                                <option value="agent">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea style="width:100%; min-height:250px;" type="text" id="message" name="message" required="" placeholder="Your Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 contact_form">
                        <div class="form-group">
                            <button type="submit">Send Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.frontend.footer')
@endsection

@push('js')

@endpush
