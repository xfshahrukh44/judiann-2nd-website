@extends('front.layouts.app')

@section('title', !empty($faqPage) ? (!empty($data->meta_title) ? $data->meta_title : 'FAQ`s') : 'FAQ`s')
@section('description', !empty($faqPage) ? (!empty($data->meta_description) ? $data->meta_description : 'FAQ`s') : 'FAQ`s')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->


    <div class="main-slider">
        <img class="img-fluid w-100"
             src="{{!empty($faqPage) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg')}}"
             alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">{{!empty($faqPage) ? (!empty($data->banner_title) ? $data->banner_title : 'Faq`s') : 'Faq`s'}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->


    <section class="faqSec" id="faqs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headOne mb-5">{{!empty($faqPage) ? (!empty($data->faq_title) ? $data->faq_title : 'Faq`s') : 'Faq`s'}}</h2>
                    <div id="accordion">
                        @foreach($faqs as $key => $faq)
                            <div class="card">
                            <div id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse{{($key+1)}}" aria-expanded="true" aria-controls="collapse{{($key+1)}}">
                                        <span>{{($key + 1)}}</span>
                                        {{$faq->question}}
{{--                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry ?--}}
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{($key+1)}}" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="lisetd">
                                        {!! $faq->answer !!}
                                        {{--<p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout. The point of using
                                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                                            opposed to using Content here, content here making it look like readable
                                            English It is a long established fact that a reader will be distracted by
                                            the readable content of a page when looking at its layout. The point of
                                            using Lorem Ipsum is that it has a more-or-less normal distribution of
                                            letters, as opposed to using Content here, content here making it look like
                                            readable English.</p>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
