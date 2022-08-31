@extends('front.layouts.app')

@section('title', 'FAQ`s')
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
                            <h2 class="headOne">Faq&#8217;s</h2>
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
                    <h2 class="headOne mb-5">Faq's</h2>
                    <div id="accordion">
                        <div class="card">
                            <div id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span>01</span>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry ?
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="lisetd">
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout. The point of using
                                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                                            opposed to using Content here, content here making it look like readable
                                            English It is a long established fact that a reader will be distracted by
                                            the readable content of a page when looking at its layout. The point of
                                            using Lorem Ipsum is that it has a more-or-less normal distribution of
                                            letters, as opposed to using Content here, content here making it look like
                                            readable English.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                        <span>02</span>
                                        Why do we use it?
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="lisetd">
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout. The point of using
                                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                                            opposed to using Content here, content here making it look like readable
                                            English It is a long established fact that a reader will be distracted by
                                            the readable content of a page when looking at its layout. The point of
                                            using Lorem Ipsum is that it has a more-or-less normal distribution of
                                            letters, as opposed to using Content here, content here making it look like
                                            readable English.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                        <span>03</span>
                                        Where does it come from?
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="lisetd">
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout. The point of using
                                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                                            opposed to using Content here, content here making it look like readable
                                            English It is a long established fact that a reader will be distracted by
                                            the readable content of a page when looking at its layout. The point of
                                            using Lorem Ipsum is that it has a more-or-less normal distribution of
                                            letters, as opposed to using Content here, content here making it look like
                                            readable English.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
