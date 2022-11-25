@extends('front.layouts.app')

@section('title', !empty($home) ? (!empty($data->meta_title) ? $data->meta_title : 'Home') : 'Home')
@section('description', !empty($home) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
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
                    <img class="img-fluid w-100"
                         src="{{!empty($home) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg')}}"
                         alt="First slide">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="slideContent">
                                        <h2 class="headOne">{{!empty($home) ? (!empty($data->banner_title) ? $data->banner_title : '') : ''}}</h2>
                                        <p>{!! nl2br(e(!empty($home) ? (!empty($data->banner_content) ? ($data->banner_content) : '') : '')) !!}</p>
                                        <a href="{{route('front.schedule')}}" class="themeBtn">Schedule A Class</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid w-100"
                         src="{{!empty($home) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg')}}"
                         alt="First slide">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="slideContent">
                                        <h2 class="headOne">{{!empty($home) ? (!empty($data->banner_title) ? $data->banner_title : '') : ''}}</h2>
                                        {{--                                        <h2 class="headOne">Judiann’s Fashion Design Studios</h2>--}}
                                        <p>{!! nl2br(e(!empty($home) ? (!empty($data->banner_content) ? ($data->banner_content) : '') : '')) !!}</p>
                                        <a href="{{route('front.schedule')}}" class="themeBtn">Class Schedules</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid w-100"
                         src="{{!empty($home) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg')}}"
                         alt="First slide">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="slideContent">
                                        <h2 class="headOne">{{!empty($home) ? (!empty($data->banner_title) ? $data->banner_title : '') : ''}}</h2>
                                        <p>{!! nl2br(e(!empty($home) ? (!empty($data->banner_content) ? ($data->banner_content) : '') : '')) !!}</p>
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
                        <h2 class="headOne">{{ !empty($home) ? (!empty($data->abt_title) ? ($data->abt_title) : '') : '' }}</h2>
                        <p>{!! nl2br(e(!empty($home) ? (!empty($data->abt_content) ? ($data->abt_content) : '') : '')) !!}</p>
                        <a href="{{route('front.about-us')}}" class="themeBtn">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($batches) > 0)
        <section class="lastestSec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h2 class="headOne">Latest Updates</h2>
                    </div>
                    <div class="col-12">
                        <div class="lastSlider">
                            @foreach($batches as $batch)
                                <div class="lastBox">
                                    <h3>{{$batch->course->name . ' (Batch: '.$batch->name.')'}}</h3>
                                    {!! get_readable_description($batch->course->description) !!}
                                    <h4 class="text-white">TIMINGS</h4>
                                    {!! get_batch_timings($batch) !!}
                                    <h4 class="text-white">Fees: ${{round($batch->course->fees, 2)}}</h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="portfolioSec">
        <div class="container-fluid">
            <h2 class="headOne">{{ !empty($home) ? (!empty($data->portfolio_title) ? ($data->portfolio_title) : '') : '' }}</h2>
            <div class="row">
                <div class="col">
                    <div class="portfolioBox">
                        @if($sort_portfolio[0])
                            <a data-fancybox="" href="{{$sort_portfolio[0]->get_portfolio_image()}}">
                                <img class="img-fluid" src="{{$sort_portfolio[0]->get_portfolio_image()}}" alt="img">
                            </a>
                        @endif
                        @if($sort_portfolio[1])
                            <a data-fancybox="" href="{{$sort_portfolio[1]->get_portfolio_image()}}">
                                <img class="img-fluid" src="{{$sort_portfolio[1]->get_portfolio_image()}}" alt="img">
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="portfolioBox">
                        @if($sort_portfolio[2])
                            <a data-fancybox="" href="{{$sort_portfolio[2]->get_portfolio_image()}}">
                                <img class="img-fluid" src="{{$sort_portfolio[2]->get_portfolio_image()}}" alt="img">
                            </a>
                        @endif
                        @if($sort_portfolio[3])
                            <a data-fancybox="" href="{{$sort_portfolio[3]->get_portfolio_image()}}">
                                <img class="img-fluid" src="{{$sort_portfolio[3]->get_portfolio_image()}}" alt="img">
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="portfolioBox">
                        @if($sort_portfolio[4])
                            <a data-fancybox="" href="{{$sort_portfolio[4]->get_portfolio_image()}}">
                                <img class="img-fluid" src="{{$sort_portfolio[4]->get_portfolio_image()}}" alt="img">
                            </a>
                        @endif
                        @if($sort_portfolio[5])
                            <a data-fancybox="" href="{{$sort_portfolio[5]->get_portfolio_image()}}">
                                <img class="img-fluid" src="{{$sort_portfolio[5]->get_portfolio_image()}}" alt="img">
                            </a>
                        @endif
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
            <h2 class="headOne">{{ !empty($home) ? (!empty($data->stdnt_title) ? ($data->stdnt_title) : '') : '' }}</h2>
            <div class="row">

                @foreach($students as $student)
                    <div class="col-md-4">
                        <a target="_blank" href="{{route('front.individual-students-work', $student->id)}}">
                            <img class="img-fluid" src="{{$student->get_student_image()}}" alt="img">
                        </a>
                        <h6>{{$student->name}}</h6>
                    </div>
                @endforeach

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
                    <h2 class="headOne">{{ !empty($home) ? (!empty($data->vogue_content) ? ($data->vogue_content) : '') : '' }}</h2>
                    <a href="{{ !empty($home) ? (!empty($data->vogue_url) ? ($data->vogue_url) : '') : '' }}"
                       target="_blank">{{ !empty($home) ? (!empty($data->vogue_url) ? ($data->vogue_url) : '') : '' }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="srvcSec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headOne">{{ !empty($home) ? (!empty($data->master_title) ? ($data->master_title) : '') : '' }}</h2>
                    {!! !empty($home) ? (!empty($data->master_content) ? ($data->master_content) : '') : '' !!}
                    {{--<h3 class="headTwo">Portfolio Development for College Applications</h3>
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
                        the session and have it ready for the next session.<br>Cost $2500</p>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headOne">{{ !empty($home) ? (!empty($data->service_title) ? ($data->service_title) : '') : '' }}</h2>
                    <p>{{ !empty($home) ? (!empty($data->service_content) ? ($data->service_content) : '') : '' }}</p>
                    <h3 class="headTwo">{{ !empty($home) ? (!empty($data->offer_title) ? ($data->offer_title) : '') : '' }}</h3>
                    <ul>
                        <li>{{ !empty($home) ? (!empty($data->offer_content1) ? ($data->offer_content1) : '') : '' }}
                        </li>
                        <li>{{ !empty($home) ? (!empty($data->offer_content2) ? ($data->offer_content2) : '') : '' }}</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                @if($services[0])
                    <div class="col-md-6">
                        <div class="sewngContent">
                            <figure>
                                <img class="img-fluid"
                                     src="{{$services[0]->get_service_image()}}"
                                     alt="img">
                            </figure>
                            <div class="overlaySewng">
                                <h3 class="headTwo">{{$services[0]->title}}</h3>
                                <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="row telrng">
                        @if($services[1])
                            <div class="col-md-6">
                                <div class="sewngContent">
                                    <figure>
                                        <img class="img-fluid"
                                             src="{{$services[1]->get_service_image()}}"
                                             alt="img">
                                    </figure>
                                    <div class="overlaySewng">
                                        <h3 class="headTwo">{{$services[1]->title}}</h3>
                                        <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($services[2])
                            <div class="col-md-6">
                                <div class="sewngContent">
                                    <figure>
                                        <img class="img-fluid"
                                             src="{{$services[2]->get_service_image()}}"
                                             alt="img">
                                    </figure>
                                    <div class="overlaySewng">
                                        <h3 class="headTwo">{{$services[2]->title}}</h3>
                                        <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($services[3])
                            <div class="col-md-6">
                                <div class="sewngContent">
                                    <figure>
                                        <img class="img-fluid"
                                             src="{{$services[3]->get_service_image()}}"
                                             alt="img">
                                    </figure>
                                    <div class="overlaySewng">
                                        <h3 class="headTwo">{{$services[3]->title}}</h3>
                                        <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($services[4])
                            <div class="col-md-6">
                                <div class="sewngContent">
                                    <figure>
                                        <img class="img-fluid"
                                             src="{{$services[4]->get_service_image()}}"
                                             alt="img">
                                    </figure>
                                    <div class="overlaySewng">
                                        <h3 class="headTwo">{{$services[4]->title}}</h3>
                                        <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row telrng">
                        @if($services[5])
                            <div class="col-md-6">
                                <div class="sewngContent">
                                    <figure>
                                        <img class="img-fluid"
                                             src="{{$services[5]->get_service_image()}}"
                                             alt="img">
                                    </figure>
                                    <div class="overlaySewng">
                                        <h3 class="headTwo">{{$services[5]->title}}</h3>
                                        <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($services[6])
                            <div class="col-md-6">
                                <div class="sewngContent">
                                    <figure>
                                        <img class="img-fluid"
                                             src="{{$services[6]->get_service_image()}}"
                                             alt="img">
                                    </figure>
                                    <div class="overlaySewng">
                                        <h3 class="headTwo">{{$services[6]->title}}</h3>
                                        <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($services[7])
                            <div class="col-md-6">
                                <div class="sewngContent">
                                    <figure>
                                        <img class="img-fluid"
                                             src="{{$services[7]->get_service_image()}}"
                                             alt="img">
                                    </figure>
                                    <div class="overlaySewng">
                                        <h3 class="headTwo">{{$services[7]->title}}</h3>
                                        <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($services[8])
                            <div class="col-md-6">
                                <div class="sewngContent">
                                    <figure>
                                        <img class="img-fluid"
                                             src="{{$services[8]->get_service_image()}}"
                                             alt="img">
                                    </figure>
                                    <div class="overlaySewng">
                                        <h3 class="headTwo">{{$services[8]->title}}</h3>
                                        <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if($services[9])
                    <div class="col-md-6">
                        <div class="sewngContent">
                            <figure>
                                <img class="img-fluid"
                                     src="{{$services[9]->get_service_image()}}"
                                     alt="img">
                            </figure>
                            <div class="overlaySewng">
                                <h3 class="headTwo">{{$services[9]->title}}</h3>
                                <a href="{{route('front.services')}}" class="themeBtn">View Details</a>
                            </div>
                        </div>
                    </div>
                @endif
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
                                <img class="img-fluid"
                                     src="{{!empty($home) ? (!empty($data->vid_img1) ? asset('front/images/cms/'.$data->vid_img1) : asset('front/images/video1.jpg')) : asset('front/images/video1.jpg')}}"
                                     alt="img">
                                <a data-fancybox=""
                                   href="{{ !empty($home) ? (!empty($data->vid_url1) ? ($data->vid_url1) : '') : '' }}">
                                    <div><i class="fas fa-play"></i></div>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vdeoImg">
                            <figure>
                                <img class="img-fluid"
                                     src="{{!empty($home) ? (!empty($data->vid_img2) ? asset('front/images/cms/'.$data->vid_img2) : asset('front/images/video2.jpg')) : asset('front/images/video2.jpg')}}"
                                     alt="img">
                                <a data-fancybox=""
                                   href="{{ !empty($home) ? (!empty($data->vid_url2) ? ($data->vid_url2) : '') : '' }}">
                                    <div><i class="fas fa-play"></i></div>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vdeoImg">
                            <figure>
                                <img class="img-fluid"
                                     src="{{!empty($home) ? (!empty($data->vid_img3) ? asset('front/images/cms/'.$data->vid_img3) : asset('front/images/video3.jpg')) : asset('front/images/video3.jpg')}}"
                                     alt="img">
                                <a data-fancybox=""
                                   href="{{ !empty($home) ? (!empty($data->vid_url3) ? ($data->vid_url3) : '') : '' }}">
                                    <div><i class="fas fa-play"></i></div>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vdeoImg">
                            <figure>
                                <img class="img-fluid"
                                     src="{{!empty($home) ? (!empty($data->vid_img4) ? asset('front/images/cms/'.$data->vid_img4) : asset('front/images/video2.jpg')) : asset('front/images/video2.jpg')}}"
                                     alt="img">
                                <a data-fancybox=""
                                   href="{{ !empty($home) ? (!empty($data->vid_url4) ? ($data->vid_url4) : '') : '' }}">
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
