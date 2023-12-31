@extends('front.layouts.app')
@section('title', 'Privacy Policy')
@section('description', '')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->

    <div class="main-slider inner">
        <img class="img-fluid w-100" src="{{asset('front/images/BannerImg.jpg')}}" alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">Privacy Policy</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->

    <section class="policySec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Privacy Policy</h3>
                    {!! get_readable_description($setting->policy) !!}
                </div>
            </div>
        </div>
    </section>
@endsection
