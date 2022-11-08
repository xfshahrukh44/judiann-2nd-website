@extends('front.layouts.app')

@section('title', 'Terms and Conditions')
@section('description', '')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->

    <div class="main-slider">
        <img class="img-fluid w-100" src="{{asset('front/images/BannerImg.jpg')}}" alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">Terms and Conditions</h2>
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
                    <h3>Terms and Conditions</h3>
                    {!! get_readable_description($setting->terms) !!}
                </div>
            </div>
        </div>
    </section>
@endsection
