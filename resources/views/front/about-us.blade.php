@extends('front.layouts.app')

@section('title', 'About Us')
@section('description', '')
@section('keywords', '')

@section('content')
    <div class="main-slider">
        <img class="img-fluid w-100" src="{{asset('front/images/BannerImg.jpg')}}" alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">About Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->

    <section class="aboutInnr">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="headOne">About Us</h2>
                    <h3>Our in-house programs and remote learning classes create a hands-on, collaborative learning experience.</h3>
                    <p>Judiann’s Fashion Design Studios aims at providing a higher education level for students looking to enhance their skill sets and learn professional methods of constructing a garment. Additionally we aim to teach students just starting out who want to gain a professional level of learning. Our programs are designed to help the individual reach their goals. These goals could be just personal learning to make things for themselves., for students applying to college and need to prepare a professional portfolio, or for students who just need extra help while in college. </p>
                </div>
                <div class="col-md-6">
                    <figure><img src="{{asset('front/images/aboutImg.jpg')}}" alt=""></figure>
                </div>

            </div>
        </div>
    </section>
@endsection
