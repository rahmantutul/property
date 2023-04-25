
@extends('layouts.frontend.app')
@push('css')

@endpush

@section('content')
<section class="contact_us">
    <h2>Get in Touch!</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5 mb-4">
            <form method="POST" action="{{ route('admin.message.store') }}"> @csrf
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="p-5" style="color: #4a4a4a; font-weight: 300; font-size: 25px; margin: 0 0 5px;">Send Us what you want to know!</h3>
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        @if(session()->has('errMessage'))
                            <div class="alert alert-danger">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" name="name" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input placeholder="Email" type="email" class="form-control" name="email" required="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control" id="user-type" name="subject">
                                <option value="" selected="" disabled="">How can we help?</option>
                                <option value="Buying and Selling Inquiries">Buying and Selling Inquiries</option>
                                <option value="Become a CORE Agent">Become a CORE Agent</option>
                                <option value="Join the CORE Team">Join the CORE Team</option>
                                <option value="New Development Inquiries">New Development Inquiries</option>
                                <option value="Commercial Inquiries">Commercial Inquiries</option>
                                <option value="Others">Others</option>
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
            </form>
            </div>
        </div>
    </div>
</section>
@include('layouts.frontend.footer')
@endsection

@push('js')

@endpush
