@extends('layouts.backends.master')
@section('title','Dashboard')
@section('content')
<div class="content-body">
    <!-- ChartJS section start -->
    <section id="chartjs-chart">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card" style="background:#D2B4DE" >
                    <div class="card-header flex-column align-items-center  p-2 text-center">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather='home'></i>
                            </div>
                        </div>

                        <h1 class="font-weight-bolder mt-1">TOTAL PROPERTY</h1>
                        <h1 class="font-weight-bolder mt-1">{{ $property }}</h1>
                        <p>Total Properties</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card" style="background:#6495ED" >
                    <div class="card-header flex-column align-items-center  p-2 text-center">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather='home'></i>
                            </div>
                        </div>

                        <h1 class="font-weight-bolder mt-1">FEATURED PROPERTY</h1>
                        <h1 class="font-weight-bolder mt-1">{{ $featured_property }}</h1>
                        <p>Total Featured Properties</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card" style="background:#9FE2BF" >
                    <div class="card-header flex-column align-items-center  p-2 text-center">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather='home'></i>
                            </div>
                        </div>

                        <h1 class="font-weight-bolder mt-1">FEATURED REQUEST</h1>
                        <h1 class="font-weight-bolder mt-1">{{ $featured_request }}</h1>
                        <p>Total Properties Featured Requests </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card" style="background:#FFBF00" >
                    <div class="card-header flex-column align-items-center  p-2 text-center">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather='home'></i>
                            </div>
                        </div>

                        <h1 class="font-weight-bolder mt-1">SAVED PROPERTY</h1>
                        <h1 class="font-weight-bolder mt-1">{{ $saved_propery}}</h1>
                        <p>Total Saved Properties </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card" style="background:#E6B0AA " >
                    <div class="card-header flex-column align-items-center  p-2 text-center">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather='dollar-sign'></i>
                            </div>
                        </div>

                        <h1 class="font-weight-bolder mt-1">TOTAL TRANSECTION</h1>
                        <h1 class="font-weight-bolder mt-1">{{ $transection }}</h1>
                        <p>Total Transections</p>
                    </div>
                </div>
            </div>
    </section>
    <!-- ChartJS section end -->
</div>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
 <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css/pages/dashboard-ecommerce.css">
@endpush
@push('js')
<script src="{{asset('')}}app-assets/js/scripts/charts/chart-chartjs.js"></script>
<script src="{{asset('')}}app-assets/vendors/js/charts/chart.min.js"></script>
 <script src="{{asset('')}}app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endpush
