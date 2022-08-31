@extends('front.layouts.app')

@section('title', 'About Judiann')
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
                            <h2 class="headOne">About Judiann</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->


    <section class="aboutInnr">
        <div class="container">
            <div class="row  align-items-center">
                <div class="col-md-5 mt-5 pt-5">
                    <figure><img src="{{asset('front/images/aboutImg.jpg')}}" alt="" class="w-100"></figure>
                </div>
                <div class="col-md-7">
                    <h2 class="headOne">About Judiann</h2>
                    <p>Judiann Echezabal is a Fashion Design Professor with over a decade of experience teaching college
                        level courses. She teaches at Parsons and Pratt Institute.She has taught at various other
                        institutions such as Columbia University, Westchester Community College and Long Island
                        University. She has taught master Classes for an institution in China, and continues to teach
                        with them online. Judiann has been a Fashion Designer for over 3 decades. She holds a BFA in
                        Fashion design with a minor in manufacturing and an MBA in business management.</p>
                    <p>Judiann has served as Curriculum Integration Coordinator, created one-of-a-kind classes, and
                        aided in the fruition of the Master’s of Fine Arts Fashion Degree. </p>
                    <p>She has developed a fashion design and marketing program for Long Island University for at risk
                        middle school students empowering students who were economically and mentally burdened, living
                        in homeless shelters or foster care. She was awarded Instructor of the year for her development
                        and involvement. </p>
                    <p> Judiann holds many outlets in her creative practice outside of teaching including, academic
                        research and professional work that ranges from published works, one of a kind academic
                        curriculum, international public speaking events, and an established design company.</p>
                </div>
                <div class="col-12">
                    <div class="mt-5">
                        <h2 class="headOne">About The Studio: </h2>
                        <h3>What does our studio offer: </h3>
                        <p><strong>Sewing Classes Offered: Beginning, Advanced, Couture, Tailoring Pattern Making and
                                Draping Classes: </strong></p>
                        <p class="mt-4"><strong>(Note:</strong> For Pattern Making and Draping Classes we recommend that
                            you to take at least a beginner sewing class first) </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
