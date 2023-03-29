@extends('layouts.frontend.app')
@push('css')
    
@endpush

@section('content')
<section class="agent_single overlay" style="background-image: url('{{asset('')}}/assets/frontend/images/neighbourhood-header.jpg');">
    <div class="row">
        <div class="col-md-8">
            <div class="agent_single_bnr_image">
                <img src="{{getUserImage($dataInfo->avatar)}}" alt="{{$dataInfo->name}}">
            </div>
            <div class="agent_single_bnr_title">
                <h4>{{ getFullName($dataInfo) }}</h4>
                <h6>Premium Agent</h6>
            </div>
        </div>
        <div class="col-md-4 agent_single_bnr_icon">
            <div class="agent_name_title" style="margin-top:60px;float:right;">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i></a></li>
                    <li><a href=""><i class="fa fa-globe"></i></a></li>
                    <li><a href=""><i class="fa fa-envelope"></i></a></li>
                    <li><a href=""><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="agent_single_details mt-5">
    <div class="col-md-12">
        <div class="row justify-content-center ">
            <div class="col-md-4">
                <h5 class="agent_all_title"><b class="agent_all_title_box">Account Details</b></h5>
                <h6><b>Phone:</b> {{ $dataInfo->phone }}</h6>
                <h6><b>Fax:</b> {{ ($dataInfo->fax)?$dataInfo->fax:'N/A' }}</h6>
                <h6><b>License:</b> {{ ($dataInfo->license)?$dataInfo->license:"N/A" }}</h6>
                <h6><b>Email:</b>{{ $dataInfo->email }}</h6>
                <h6><b>Facebook:</b> <a href="{{ ($dataInfo->facebook)?$dataInfo->facebook:'N/A' }}"> Visit Now</a></h6>
                <h6><b>Skype: </b>{{ ($dataInfo->stype)?$dataInfo->stype:'N/A' }}</h6>
                <h6><b>Linkedin:</b> <a href="{{ $dataInfo->linkedin }}"> Visit Now</a></h6>
                <h6><b>Address:</b>{{ $dataInfo->address }}</h6>
            </div>
            <div class="col-md-4 agent_details_text">
                <h5 class="agent_all_title"><b class="agent_all_title_box">About Agent</b></h5>
                <p>
                   {!! $dataInfo->about !!}
                </p>
            </div>
            <div class="col-md-4">
                <h5 class="agent_all_title"><b class="agent_all_title_box">Contact</b></h5>
                <div class="neighbour_form">
                    <form method="post" action="#">
                        <div class="form-group">
                            <input type="text" id="Name" name="Name" required="" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <input type="email" id="email" name="email" required="" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" required="" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <input type="text" name="text" required="" placeholder="Your Queries">
                        </div>
                        <div class="form-group">
                            <button type="submit">Send Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <h5 class="agent_all_title"><b class="agent_all_title_box">Agent Properties</b></h5>
        <div class="row">
            @foreach ($dataList as $dataInfo)
            <div class="carousel-card col-md-4 mb-4">
                <div class="image-box">
                    <img src="{{getImage($dataInfo->thumbnail)}}" alt="{{$dataInfo->title}}">
                    <div class="hover-content">
                        <h5>FOR SALE | ${{$dataInfo->price}}</h5>
                        <h2>FOR SALE: {{(!is_null($dataInfo->details)) ? $dataInfo->details->totalUnit.','.$dataInfo->details->squareFeet:''}}</h2>
                        <h5><span><i class="fa fa-bed"></i>{{(!is_null($dataInfo->details)) ? $dataInfo->details->numOfBedroom:''}} BEDS</span> <span style="margin-left: 10px;"><i class="fa fa-tint"></i> {{(!is_null($dataInfo->details)) ? $dataInfo->details->numOfBathroom:''}} Baths</span></h5>
    
                        <a href="" class="learn_more_btn">
                            <div class="button_lm">
                                <div class="f-left left_btn">Learn More</div>
                                <div class="f-left right_btn"><i class="fa fa fa-arrow-right btn_icon"></i></div>
                            </div>
                        </a>
                        <a href="" class="save_properties"><i class="fa fa-star"></i> Save</a>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>

@include('layouts.frontend.footer')
@endsection

@push('js')
    
@endpush