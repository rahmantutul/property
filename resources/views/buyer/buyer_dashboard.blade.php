@extends('layouts.backends.master')
@section('title','Dashboard')
@section('content')
<div class="content-body">
    <!-- ChartJS section start -->
    <section id="chartjs-chart">
        <div class="row">
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
