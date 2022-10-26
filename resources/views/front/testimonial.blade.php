@extends('front.layouts.app')

@section('title', 'Testimonials')
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
                    <form action="">
                        <div class="form-group">
                            <label for="">Your Overall Rating</label>
                            <ul class="rating-stars">
                                <input type="radio" id="5-star" name="rating" value="5" required="">
                                <label for="5-star" title="Amazing">5 stars</label>
                                <input type="radio" id="4-star" name="rating" value="4" required="">
                                <label for="4-star" title="Good">4 stars</label>
                                <input type="radio" id="3-star" name="rating" value="3" required="">
                                <label for="3-star" title="Average">3 stars</label>
                                <input type="radio" id="2-star" name="rating" value="2" required="">
                                <label for="2-star" title="Not Good">2 stars</label>
                                <input type="radio" id="1-star" name="rating" value="1" required="">
                                <label for="1-star" title="Bad">1 star</label>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="">Title of your review</label>
                            <input type="text" class="form-control"
                                   placeholder="Summarize your review or highlight an interesting detail">
                        </div>
                        <div class="form-group">
                            <label for="">Your review</label>
                            <textarea name="" id="" rows="10" placeholder="Tell people your review"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Your name</label>
                            <input type="text" class="form-control" placeholder="Tell us your name">
                        </div>
                        <div class="form-group">
                            <label for="">Your email</label>
                            <input type="text" class="form-control" placeholder="Tell us your email">
                        </div>
                        <div class="form-group">
                            <div class="switcher">
                                <label for="toggle-0">
                                    <input type="checkbox" id="toggle-0"/><span><small></small></span><small>This review
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
                <div class="col-12">
                    <div class="testiBox">
                        <div class="head">
                            <h3>Camey L.</h3>
                            <div class="ratingBox">
                                <ul>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <span><strong>September</strong> 7, 2022</span>
                            </div>
                        </div>
                        <div class="body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam commodi, consectetur
                                expedita facere fuga ipsum maxime, minima nesciunt nulla provident quia, saepe sit vel?
                                Cupiditate exercitationem itaque praesentium quas unde!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="testiBox">
                        <div class="head">
                            <h3>Camey L.</h3>
                            <div class="ratingBox">
                                <ul>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                </ul>
                                <span><strong>September</strong> 7, 2022</span>
                            </div>
                        </div>
                        <div class="body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam commodi, consectetur
                                expedita facere fuga ipsum maxime, minima nesciunt nulla provident quia, saepe sit vel?
                                Cupiditate exercitationem itaque praesentium quas unde!
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam commodi, consectetur
                                expedita facere fuga ipsum maxime, minima nesciunt nulla provident quia, saepe sit vel?
                                Cupiditate exercitationem itaque praesentium quas unde!
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam commodi, consectetur
                                expedita facere fuga ipsum maxime, minima nesciunt nulla provident quia, saepe sit vel?
                                Cupiditate exercitationem itaque praesentium quas unde!
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam commodi, consectetur
                                expedita facere fuga ipsum maxime, minima nesciunt nulla provident quia, saepe sit vel?
                                Cupiditate exercitationem itaque praesentium quas unde!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="testiBox">
                        <div class="head">
                            <h3>Camey L.</h3>
                            <div class="ratingBox">
                                <ul>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star active"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <span><strong>September</strong> 7, 2022</span>
                            </div>
                        </div>
                        <div class="body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam commodi, consectetur
                                expedita facere fuga ipsum maxime, minima nesciunt nulla provident quia, saepe sit vel?
                                Cupiditate exercitationem itaque praesentium quas unde!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
