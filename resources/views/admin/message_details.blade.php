@extends('layouts.backends.master')
@section('title','Message Details')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Message Details</h2>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <div class="text-center">
                        <img src="{{asset('')}}assets/frontend/images/logo.png" alt="US Metro Reilty" style="height:120px;">
                        <h4 class="bg-light-info text-uppercase text-dark mt-1" style="padding:12px">Message Details</h4>
                    </div>
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <p class="card-text mb-25"><strong>Sender Name:{{ $dataInfo->name }}</strong></p>
                            <p class="card-text mb-25"><strong>Sender Email: {{ $dataInfo->email }}</strong></p>
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="invoice-title">
                                Message No:
                                <span class="invoice-number">#000{{ $dataInfo->id }} </span>
                            </h4>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Date Issued:{{ date('d-m-Y',strtotime($dataInfo->created_at)) }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>

                <hr class="invoice-spacing">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <h4 class="text-dark text-center">SUBJECT: {{ $dataInfo->subject }}</h4>
                                <p class="card-text blog-content-truncate">
                                   {!! $dataInfo->property?->previewText !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Address and Contact starts -->
                <div class="card-body invoice-padding pt-0 bg-gradient-dark">
                    <div class="row invoice-spacing text-left">
                        <div class="col-xl-12 p-5">
                            <h2 class="text-info text-center">Message Details</h2>
                            <p class="text-left"><strong>Dear {{ Auth::user()->name }} <br>{{ $dataInfo->message }}</strong></p>
                            <a class="btn btn-outline-success" target="__balnk" href ="mailto:{{ $dataInfo->email }}">Send Reply</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
</div>
@endsection
