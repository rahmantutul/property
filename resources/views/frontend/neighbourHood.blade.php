@extends('layouts.frontend.app')
@push('css')

@endpush

@section('content')
<section class="featured_list br_common" style="background-image: url('{{asset('')}}assets/frontend/images/neighbourhood-header.jpg');">
    <div class="overla"></div>
    <h1>Neighbourhood Profiles</h1>
    <ul>
        <li><a href="">Share This</a></li>
        <li><a href=""><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
    </ul>
    <p>
        <i>
            Want to find properties for sale in Toronto that suit your needs, budget, and lifestyle? Start your real estate search here with our house and condo listings. When you see a property for sale that interests you, let us know and we can provide you with more information or schedule a time to view it together.
        </i>
    </p>
</section>

<section class="featured_list_box col-md-12">
    <div class="row">
        @foreach ($dataList as $dataInfo)
        <div class="carousel-card col-md-4 mb-4">
            <div class="image-box">
                <img src="{{ $dataInfo->photo }}" alt="Your Image">
                <div class="hover-content">
                    <h2>{{ $dataInfo->name }}</h2>
                    <a href="{{ route('front.neighbourDetails',['dataId'=>$dataInfo->id]) }}" class="learn_more_btn">
                        <div class="button_lm">
                            <div class="f-left left_btn">Learn More</div>
                            <div class="f-left right_btn"><i class="fa fa fa-arrow-right btn_icon"></i></div>
                        </div>
                    </a>
                    {{-- <a href="" class="save_properties"><i class="fa fa-star"></i> Save</a> --}}
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</section>
@include('layouts.frontend.footer')
@endsection

@push('js')

@endpush
