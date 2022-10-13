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
                                        <a href="{{route('front.schedule')}}" class="themeBtn">Schedule A Class</a>
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
                        <a href="{{route('front.about-us')}}" class="themeBtn">Learn More</a>
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
                    <a href="{{route('front.judiann-portfolio')}}" class="themeBtn">View All</a>
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
                    <a href="{{route('front.students-work')}}" class="themeBtn">View All</a>
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
            <section class="srvcSec">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="headOne">MASTER CLASS</h2>
                            <h3 class="headTwo">Portfolio Development for College Applications</h3>
                            <p>Are you looking to apply to a Fashion or Art school and need help in preparing a
                                professional portfolio to include with your applications? Most Art schools will require
                                some type of portfolio to be included when you apply.</p>
                            <p>We offer private sessions where we work with you individually on the development of your
                                portfolio. </p>
                            <h3 class="headTwo">What is a Portfolio?</h3>
                            <p>Think of the portfolio as a visual resume which is used to express the best of your work
                                that is well edited and curated. Your portfolio is a very important tool that you will
                                use to sell yourself to a prospective school.</p>
                            <p>Your portfolio should be able to express to the viewer your ideas, aesthetics, vision and
                                who you are as a designer. It should communicate your quality, values and skills.</p>
                            <p>Individual Classes dates and times will be determined after a consultation. We can
                                schedule these based on your needs and my availability. </p>
                            <p>12 classes over a 3 month period. (1 class per week x 3 months) This can be adjusted if
                                needed. Each class is one hour. The student will be expected to do the work discussed in
                                the session and have it ready for the next session.<br>Cost $2500</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="headOne">Services</h2>
                            <p>5-15 day intensive training courses are devoted to creating a garment. These intensives
                                offer classes for specific garments such as couture garments (such as evening wear or a
                                wedding dress). Learn to tailor a coat, jacket or pair of trousers.</p>
                            <h3 class="headTwo">What we Offer</h3>
                            <ul>
                                <li>Sewing classes from beginner to advanced. Classes will be offered as private classes
                                    and group classes. Please see the schedule for class times or contact us for a one
                                    on one class.
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
                                         src="{{asset("front/images/srv1.jpg")}}"
                                         alt="img">
                                </figure>
                                <div class="overlaySewng">
                                    <h3 class="headTwo">Sewing Classes Offered</h3>
                                    <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row telrng">
                                <div class="col-md-6">
                                    <div class="sewngContent">
                                        <figure>
                                            <img class="img-fluid"
                                                 src="{{asset("front/images/srv2.jpg")}}"
                                                 alt="img">
                                        </figure>
                                        <div class="overlaySewng">
                                            <h3 class="headTwo">Tailoring: “Masterclass</h3>
                                            <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sewngContent">
                                        <figure>
                                            <img class="img-fluid"
                                                 src="{{asset("front/images/srv3.jpg")}}"
                                                 alt="img">
                                        </figure>
                                        <div class="overlaySewng">
                                            <h3 class="headTwo">Pattern making courses</h3>
                                            <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sewngContent">
                                        <figure>
                                            <img class="img-fluid"
                                                 src="{{asset("front/images/srv4.jpg")}}"
                                                 alt="img">
                                        </figure>
                                        <div class="overlaySewng">
                                            <h3 class="headTwo">Draping Making Courses</h3>
                                            <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sewngContent">
                                        <figure>
                                            <img class="img-fluid"
                                                 src="{{asset("front/images/srv5.jpg")}}"
                                                 alt="img">
                                        </figure>
                                        <div class="overlaySewng">
                                            <h3 class="headTwo">Intro To Draping</h3>
                                            <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row telrng">
                                <div class="col-md-6">
                                    <div class="sewngContent">
                                        <figure>
                                            <img class="img-fluid"
                                                 src="{{asset("front/images/srv6.jpg")}}"
                                                 alt="img">
                                        </figure>
                                        <div class="overlaySewng">
                                            <h3 class="headTwo">How to sew a circle skirt</h3>
                                            <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sewngContent">
                                        <figure>
                                            <img class="img-fluid"
                                                 src="{{asset("front/images/srv7.jpg")}}"
                                                 alt="img">
                                        </figure>
                                        <div class="overlaySewng">
                                            <h3 class="headTwo">Gathered skirt with ruffles</h3>
                                            <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sewngContent">
                                        <figure>
                                            <img class="img-fluid"
                                                 src="{{asset("front/images/srv8.jpg")}}"
                                                 alt="img">
                                        </figure>
                                        <div class="overlaySewng">
                                            <h3 class="headTwo">Master class jacket</h3>
                                            <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sewngContent">
                                        <figure>
                                            <img class="img-fluid"
                                                 src="{{asset("front/images/srv9.jpg")}}"
                                                 alt="img">
                                        </figure>
                                        <div class="overlaySewng">
                                            <h3 class="headTwo">Online courses</h3>
                                            <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sewngContent">
                                <figure>
                                    <img class="img-fluid"
                                         src="{{asset("front/images/srv10.jpg")}}"
                                         alt="img">
                                </figure>
                                <div class="overlaySewng">
                                    <h3 class="headTwo">Tailored knotch jacket</h3>
                                    <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
