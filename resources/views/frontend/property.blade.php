@extends('layouts.frontend.app')
@push('css')

@endpush

@section('content')
<section class="featured_list br_common" style="background-image: url('{{asset('')}}assets/frontend/images/Featured-Properties-list-bg.jpg');">
    <div class="overla"></div>
    <h1>Our Featured Properties</h1>
    <ul>
        <li><a href="">Share This</a></li>
        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
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
        @foreach ($featuredProperties as $dataInfo)
            <div class="carousel-card col-md-4 mb-4">
                <div class="image-box">
                    <img src="{{$dataInfo->thumbnail}}" alt="Your Image">
                    <div class="hover-content">
                        <h5>FOR SALE | ${{ $dataInfo->price }}</h5>
                        <h2>FOR SALE: PANDA CONDOS LOWER PENTHOUSE 1 | {{Str::limit($dataInfo?->address?->streetAddressOne, 10)}}</h2>
                        <h5><span><i class="fa fa-bed"></i> {{$dataInfo->details->numOfBedroom}}+ BEDS</span> <span style="margin-left: 10px;"><i class="fa fa-tint"></i> {{$dataInfo->details->numOfBathroom}}+ Baths</span></h5>

                        <a href="{{ route('front.propertyDetails', $id=$dataInfo->id) }}" class="learn_more_btn">
                            <div class="button_lm">
                                <div class="f-left left_btn">Learn More</div>
                                <div class="f-left right_btn"><i class="fa fa fa-arrow-right btn_icon"></i></div>
                            </div>
                        </a>
                        @if ($dataInfo->saveProperty)
                            <a data-savelist-url="{{route('front.saveProperty', [$id=$dataInfo->id])}}" class="save_properties"><i class="fa fa-star"> Save</i></a>
                        @else
                            <a data-savelist-url="{{route('front.saveProperty', [$id=$dataInfo->id])}}" class="save_properties"><i class="fa fa-star-o"> Save</i></a>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $featuredProperties->links() }}
</section>
@include('layouts.frontend.footer')
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('.save_properties').click(function(obj) {
            var obj = $(this);
            var url = obj.data('savelist-url');
            console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    if (data.delete == false) {
                        //empty heart
                        obj[0].innerHTML = '';
                        obj[0].innerHTML = '<i class="fa fa-star"> Save</i>';
                    }
                    if (data.delete == true) {
                        //empty heart
                        obj[0].innerHTML = '';
                        obj[0].innerHTML = '<i class="fa fa-star-o"> Save</i>';
                    }
                    //toastr message from response
                    toastr[data.type](data.message);
                }
            });
            //page reload
            // location.reload();
        });
    });
</script>
@endpush
