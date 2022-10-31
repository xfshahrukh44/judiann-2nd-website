@extends('front.layouts.app')

@section('title', 'Student`s Work')
@section('description', '')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->


    <div class="main-slider">
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
            <h2 class="headOne">Student’s Work</h2>
{{--            <div class="row">--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student1.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student1.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student2.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student2.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student3.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student3.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student4.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student4.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student5.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student5.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student6.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student6.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student7.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student7.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student8.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student8.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student9.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student9.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student10.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student10.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student11.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student11.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student12.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student12.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student13.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student13.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student14.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student14.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student15.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student15.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student16.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student16.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student17.jpg')}}">--}}
{{--                        <img class="img-fluid"--}}
{{--                             src="{{asset('front/images/student17.jpg')}}"--}}
{{--                             alt="img">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <a data-fancybox--}}
{{--                       href="{{asset('front/images/student18.jpg')}}">--}}
{{--                        <img  class="img-fluid" src="{{asset('front/images/student18.jpg')}}" alt="img"</a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row">
                @foreach($portfolio_images as $portfolio_image)
                    <div class="col-md-4">
                        <a data-fancybox="" href="">
                            <img class="img-fluid" src="{{$portfolio_image->get_portfolio_image()}}" alt="img">
                        </a>
                        <h6 style="">{{$portfolio_image->student->name}}</h6>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
