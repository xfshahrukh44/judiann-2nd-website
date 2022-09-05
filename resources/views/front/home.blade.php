@extends('front.layouts.app')

@section('title', 'Home')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="anloader">
        <video muted autoplay loop preload src="{{asset('front/images/loader.mp4')}}">
        </video>
    </div>
    <!-- Begin: Main Slider -->

    <div class="main-slider">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active wow fadeInLeft" data-wow-delay="0.5s">
                    <img class="img-fluid w-100" src="{{asset('front/images/BannerImg.jpg')}}" alt="First slide">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="slideContent">
                                        <h2 class="headOne">Judiann’s Fashion Design Studios</h2>
                                        <p>Learn beginner, College level and industry professional<br>
                                            level skills through our Master Classes.</p>
                                        <a href="{{route('front.schedule')}}" class="themeBtn">Class Schedules</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid w-100" src="{{asset('front/images/BannerImg.jpg')}}" alt="First slide">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="slideContent">
                                        <h2 class="headOne">Judiann’s Fashion Design Studios</h2>
                                        <p>Learn beginner, College level and industry professional<br>
                                            level skills through our Master Classes.</p>
                                        <a href="{{route('front.schedule')}}" class="themeBtn">Class Schedules</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid w-100" src="{{asset('front/images/BannerImg.jpg')}}" alt="First slide">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="slideContent">
                                        <h2 class="headOne">Judiann’s Fashion Design Studios</h2>
                                        <p>Learn beginner, College level and industry professional<br>
                                            level skills through our Master Classes.</p>
                                        <a href="{{route('front.schedule')}}" class="themeBtn">Class Schedules</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <i class="fal fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <i class="fal fa-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <a href="#" class="bounce-element"><i class="fal fa-angle-down"></i></a>
    </div>

    <!-- END: Main Slider -->


    <section class="abtSec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="abtContent">
                        <h2 class="headOne">About Us</h2>
                        <p>Our in-house programs and remote learning classes create a hands-on,<br>collaborative
                            learning experience.</p>
                        <a href="#" class="themeBtn">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lastestSec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h2 class="headOne">Latest Updates</h2>
                </div>
                <div class="col-12">
                    <div class="lastSlider">
                        @foreach($latest_updates as $latest_update)
                            <div class="lastBox">
                                <h3>{{$latest_update->title}}</h3>
                                {!! get_readable_description($latest_update->description) !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="portfolioSec">
        <div class="container-fluid">
            <h2 class="headOne">Judiann’s Portfolio</h2>
            <div class="row">
                <div class="col">
                    <div class="portfolioBox">
                        <a data-fancybox href="{{asset('front/images/portfolio1.jpg')}}">
                            <img class="img-fluid" src="{{asset('front/images/portfolio1.jpg')}}" alt="img">
                        </a>
                        <a data-fancybox href="{{asset('front/images/portfolio2.jpg')}}">
                            <img class="img-fluid" src="{{asset('front/images/portfolio2.jpg')}}" alt="img">
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="portfolioBox">
                        <a data-fancybox href="{{asset('front/images/portfolio3.jpg')}}">
                            <img class="img-fluid" src="{{asset('front/images/portfolio3.jpg')}}" alt="img">
                        </a>
                        <a data-fancybox href="{{asset('front/images/portfolio4.jpg')}}">
                            <img class="img-fluid" src="{{asset('front/images/portfolio4.jpg')}}" alt="img">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="portfolioBox">
                        <a data-fancybox href="{{asset('front/images/portfolio5.jpg')}}">
                            <img class="img-fluid" src="{{asset('front/images/portfolio5.jpg')}}" alt="img">
                        </a>
                        <a data-fancybox href="{{asset('front/images/portfolio6.jpg')}}">
                            <img class="img-fluid" src="{{asset('front/images/portfolio6.jpg')}}" alt="img">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <a href="#" class="themeBtn">View All</a>
                </div>
            </div>
        </div>
    </section>

    <section class="wrkSec">
        <div class="container-fluid">
            <h2 class="headOne">Student’s Work</h2>
            <div class="row">
                <div class="col-md-4">
                    <a data-fancybox href="{{asset('front/images/student1.jpg')}}">
                        <img class="img-fluid" src="{{asset('front/images/student1.jpg')}}" alt="img">
                    </a>
                </div>
                <div class="col-md-4">
                    <a data-fancybox href="{{asset('front/images/student2.jpg')}}">
                        <img class="img-fluid" src="{{asset('front/images/student2.jpg')}}" alt="img">
                    </a>
                </div>
                <div class="col-md-4">
                    <a data-fancybox href="{{asset('front/images/student3.jpg')}}">
                        <img class="img-fluid" src="{{asset('front/images/student3.jpg')}}" alt="img">
                    </a>
                </div>
                <div class="col-md-4">
                    <a data-fancybox href="{{asset('front/images/student4.jpg')}}">
                        <img class="img-fluid" src="{{asset('front/images/student4.jpg')}}" alt="img">
                    </a>
                </div>
                <div class="col-md-4">
                    <a data-fancybox href="{{asset('front/images/student5.jpg')}}">
                        <img class="img-fluid" src="{{asset('front/images/student5.jpg')}}" alt="img">
                    </a>
                </div>
                <div class="col-md-4">
                    <a data-fancybox href="{{asset('front/images/student6.jpg')}}">
                        <img class="img-fluid" src="{{asset('front/images/student6.jpg')}}" alt="img">
                    </a>
                </div>
                <div class="col-md-12 mt-4 text-center">
                    <a href="#" class="themeBtn">View All</a>
                </div>
            </div>
        </div>
    </section>


    <section class="vogueSec">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h2 class="headOne">Students in the news showcased in Vogue Magazine</h2>
                    <a href="https://www.vogue.com/fashion-shows/fall-2022-ready-to-wear/pratt-institute#review"
                       target="_blank">https://www.vogue.com/fashion-shows/fall-2022-ready-to-wear/pratt-institute#review </a>
                </div>
            </div>
        </div>
    </section>


    <section class="srvcSec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headOne">Services</h2>
                    <p>5-15 day intensive training courses are devoted to creating a garment. These intensives offer
                        classes for specific garments such as couture garments (such as evening wear or a wedding
                        dress). Learn to tailor a coat, jacket or pair of trousers.</p>
                    <h3 class="headTwo">What we Offer</h3>
                    <ul>
                        <li>Sewing classes from beginner to advanced. Classes will be offered as private classes and
                            group classes. Please see the schedule for class times or contact us for a one on one class.
                            Classes are hold online and in person
                        </li>
                        <li>College prep and College students specialized portfolio courses:</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="sewngContent">
                        <figure>
                            <img class="img-fluid"
                                 src="{{asset('front/images/srvcimg1.jpg')}}" alt="img">
                        </figure>
                        <div class="overlaySewng">
                            <h3 class="headTwo">Sewing Classes Offered</h3>
                            <a href="#" class="themeBtn">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row telrng">
                        <div class="col-md-6">
                            <div class="sewngContent">
                                <figure>
                                    <img class="img-fluid" src="{{asset('front/images/srvcimg2.jpg')}}" alt="img">
                                </figure>
                                <div class="overlaySewng">
                                    <h3 class="headTwo">Tailoring: “Masterclass</h3>
                                    <a href="#" class="themeBtn">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sewngContent">
                                <figure>
                                    <img class="img-fluid" src="{{asset('front/images/srvcimg4.jpg')}}" alt="img">
                                </figure>
                                <div class="overlaySewng">
                                    <h3 class="headTwo">Pattern making courses</h3>
                                    <a href="#" class="themeBtn">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sewngContent">
                                <figure>
                                    <img class="img-fluid" src="{{asset('front/images/srvcimg3.jpg')}}" alt="img">
                                </figure>
                                <div class="overlaySewng">
                                    <h3 class="headTwo">Draping Classes</h3>
                                    <a href="#" class="themeBtn">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sewngContent">
                                <figure>
                                    <img class="img-fluid" src="{{asset('front/images/srvcimg5.jpg')}}" alt="img">
                                </figure>
                                <div class="overlaySewng">
                                    <h3 class="headTwo">Intro to Draping How</h3>
                                    <a href="#" class="themeBtn">View Details</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="videoSec">
        <div class="container">
            <h2 class="headOne">Video’s</h2>
            <div class="row d-block">
                <div class="videoSlider">
                    <div class="col-md-4">
                        <div class="vdeoImg">
                            <figure>
                                <img class="img-fluid" src="{{asset('front/images/video1.jpg')}}" alt="img">
                                <a data-fancybox=""
                                   href="https://www.youtube.com/watch?v=cKjdTA91xPQ&amp;feature=youtu.be">
                                    <div><i class="fas fa-play"></i></div>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vdeoImg">
                            <figure>
                                <img class="img-fluid" src="{{asset('front/images/video2.jpg')}}" alt="img">
                                <a data-fancybox=""
                                   href="https://www.youtube.com/watch?v=cKjdTA91xPQ&amp;feature=youtu.be">
                                    <div><i class="fas fa-play"></i></div>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vdeoImg">
                            <figure>
                                <img class="img-fluid" src="{{asset('front/images/video3.jpg')}}" alt="img">
                                <a data-fancybox=""
                                   href="https://www.youtube.com/watch?v=cKjdTA91xPQ&amp;feature=youtu.be">
                                    <div><i class="fas fa-play"></i></div>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vdeoImg">
                            <figure>
                                <img class="img-fluid" src="{{asset('front/images/video2.jpg')}}" alt="img">
                                <a data-fancybox=""
                                   href="https://www.youtube.com/watch?v=cKjdTA91xPQ&amp;feature=youtu.be">
                                    <div><i class="fas fa-play"></i></div>
                                </a>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
