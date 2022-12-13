@extends('front.layouts.app')

@section('title', 'Student`s Work')
@section('description', '')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->


    <div class="main-slider inner">
        <img class="img-fluid w-100"
             src="{{asset('front/images/BannerImg.jpg')}}"
             alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">Student&#8217;s Work</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->


    <section class="wrkSec">
        <div class="container-fluid">
            <h2 class="headOne">{{$student->name}}'s Work</h2>
            <div class="row">
                @foreach($student->portfolio_images as $portfolio_image)
                    <div class="col-md-4">
                        <a data-fancybox="" href="{{$portfolio_image->get_portfolio_image()}}">
                            <img class="img-fluid" src="{{$portfolio_image->get_portfolio_image()}}" alt="img">
                        </a>
                        <h6 style="">{{$portfolio_image->student->name}}</h6>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
