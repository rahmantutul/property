
@extends('layouts.frontend.app')
@push('css')
    
@endpush

@section('content')
<section class="agent_list overlay" style="background-image: url('{{asset('')}}/assets/frontend/images/neighbourhood-header.jpg');">
    <h1>Our Agent List</h1>
    <p>
        Some details about Agent's services or benifits
    </p>
</section>

<section class="featured_list_box col-md-12">
    <div class="row justify-content-center align-items-center">
        @foreach ($dataList as $dataInfo)
            <div class="col-md-4 col-sm-12 col-lg-3 mb-5">
                <div class="agent_card">
                    <div class="agent_card_banner overlay" style="background-image: url('{{asset('')}}/assets/frontend/images/neighbourhood-header.jpg');">

                        <div class="agent_image">
                            <div class="agent_list_profile">
                                <img src="{{getUserImage($dataInfo->avatar)}}" alt="{{$dataInfo->name}}">
                            </div>
                        </div>
                        <div class="agent_name_title">
                            <h4>{{ getFullName($dataInfo) }}</h4>
                            <h6>Premium Agent</h6>
                            <ul>
                                <li><a href="{{route('front.agentDetails',['dataId'=>$dataInfo->id])}}"><i class="fa fa-user"></i></a></li>
                                <li><a href=""><i class="fa fa-globe"></i></a></li>
                                <li><a href="{{route('front.agentDetails',['dataId'=>$dataInfo->id])}}"><i class="fa fa-envelope"></i></a></li>
                                <li><a href=""><i class="fa fa-search"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="account_details">
                        <h5><b>Account Details</b></h5>
                        <h6><b>Phone:</b> {{ $dataInfo->phone }}</h6>
                        <h6><b>Fax:</b> {{ ($dataInfo->fax)?$dataInfo->fax:'N/A' }}</h6>
                        <h6><b>License:</b> {{ ($dataInfo->license)?$dataInfo->license:"N/A" }}</h6>
                        <h6><b>Email:</b>{{ $dataInfo->email }}</h6>
                        <h6><b>Facebook:</b> <a href="{{ ($dataInfo->facebook)?$dataInfo->facebook:'N/A' }}"> Visit Now</a></h6>
                        <h6><b>Skype: </b>{{ ($dataInfo->stype)?$dataInfo->stype:'N/A' }}</h6>
                        <h6><b>Linkedin:</b> <a href="{{ $dataInfo->linkedin }}"> Visit Now</a></h6>
                        <h6><b>Address:</b>{{ Str::limit($dataInfo->address,40) }}</h6>
                    </div>
                    <h6 class="view_agent_profile"><a href="{{route('front.agentDetails',['dataId'=>$dataInfo->id])}}">View Profile</a></h6>
                </div>
            </div>
        @endforeach
        
    </div>
</section>
@include('layouts.frontend.footer')
@endsection

@push('js')
    
@endpush