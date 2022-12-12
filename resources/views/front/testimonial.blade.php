@extends('front.layouts.app')

@section('title', 'Testimonials')
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
                            <h2 class="headOne">Testimonials</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->

    <section class="formSec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('front.testimonial')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Your Overall Rating</label>
                            <ul class="rating-stars">
                                <input type="radio" id="5-star" name="rating" value="5" required>
                                <label for="5-star" title="Amazing">5 stars</label>
                                <input type="radio" id="4-star" name="rating" value="4" required>
                                <label for="4-star" title="Good">4 stars</label>
                                <input type="radio" id="3-star" name="rating" value="3" required>
                                <label for="3-star" title="Average">3 stars</label>
                                <input type="radio" id="2-star" name="rating" value="2" required>
                                <label for="2-star" title="Not Good">2 stars</label>
                                <input type="radio" id="1-star" name="rating" value="1" required>
                                <label for="1-star" title="Bad">1 star</label>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="">Title of your review</label>
                            <input type="text" class="form-control" name="title" required
                                   placeholder="Summarize your review or highlight an interesting detail">
                        </div>
                        <div class="form-group">
                            <label for="">Your review</label>
                            <textarea id="" rows="10" placeholder="Tell people your review" name="review" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Your name</label>
                            <input type="text" class="form-control" placeholder="Tell us your name"
                                   name="name" required value="{{auth()->user() ? auth()->user()->name : ''}}" {!! auth()->user() ? 'readonly' : '' !!}>
                        </div>
                        <div class="form-group">
                            <label for="">Your email</label>
                            <input type="text" class="form-control" placeholder="Tell us your email"
                                   name="email" required value="{{auth()->user() ? auth()->user()->email : ''}}" {!! auth()->user() ? 'readonly' : '' !!}>
                        </div>
                        <div class="form-group">
                            <div class="switcher">
                                <label for="toggle-0">
                                    <input type="checkbox" id="toggle-0" name="is_genuine"/><span><small></small></span><small>This review
                                        is based on my own experience and is my genuine opinion.</small>
                                </label>
                            </div>
                        </div>
                        <div class="btnCont">
                            <button class="themeBtn">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <figure>
                        <img src="{{asset('front/images/portfolio1.jpg')}}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonialSec">
        <div class="container">
            <div class="row">
                @foreach($testimonials as $testimonial)
                    <div class="col-12">
                        <div class="testiBox">
                            <div class="head">
                                <h3>{{$testimonial->name}}</h3>
                                <div class="ratingBox">
                                    <ul>
                                        <li><i class="fas fa-star {!! $testimonial->rating >= 1 ? 'active' : '' !!}"></i></li>
                                        <li><i class="fas fa-star {!! $testimonial->rating >= 2 ? 'active' : '' !!}"></i></li>
                                        <li><i class="fas fa-star {!! $testimonial->rating >= 3 ? 'active' : '' !!}"></i></li>
                                        <li><i class="fas fa-star {!! $testimonial->rating >= 4 ? 'active' : '' !!}"></i></li>
                                        <li><i class="fas fa-star {!! $testimonial->rating >= 5 ? 'active' : '' !!}"></i></li>
                                    </ul>
                                    <span><strong>{{\Carbon\Carbon::parse($testimonial->created_at)->monthName}}</strong> {{\Carbon\Carbon::parse($testimonial->created_at)->day}}, {{\Carbon\Carbon::parse($testimonial->created_at)->year}}</span>
                                </div>
                            </div>
                            <div class="body">
                                <p>
                                    {!! $testimonial->review !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
