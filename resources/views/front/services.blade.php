@extends('front.layouts.app')

@section('title', 'Services')
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
                            <h2 class="headOne">Services</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->


    <section class="srvcSec serviceInner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headOne">Services</h2>
                    <p>5-15 day intensive training courses are devoted to creating a garment. These intensives offer classes for specific garments such as couture garments (such as evening wear or a wedding dress). Learn to tailor a coat, jacket or pair of trousers.</p>
                    <h3 class="headTwo">What we Offer</h3>
                    <ul>
                        <li>Sewing classes from beginner to advanced. Classes will be offered as private classes and group classes. Please see the schedule for class times or contact us for a one on one class.
                            Classes are hold online and in person</li>
                        <li>College prep and College students specialized portfolio courses: </li>
                    </ul>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-6">
                    <figure><img src="{{asset('front/images/service1.jpg')}}" class="w-100" alt=""></figure>
                </div>
                <div class="col-md-6">
                    <h3>Sewing Classes Offered</h3>
                    <p><strong>Beginner-</strong> For those who have never sewn before you will learn both hand sewing and machine sewing on either industrial machines or home machines. You are welcome to bring your own home machine if you would like to learn how to sew on your own machine. You will learn all the basic sewing techniques and skills necessary to create a garment such as a skirt, or dress. </p>

                    <p><strong>Advanced-</strong> For those students who have basic to moderate skill levels and are ready to take on more challenges to learn how to make garments such as pants, jackets or coats. Students have the option to learn on the industrial or the home sewing machines and are welcome to bring their own home machines to the classes. </p>
                </div>
                <div class="col-md-12 mt-5">
                    <p><strong>Couture -</strong>Couture means the creation of exclusive high end fashion exclusive custom fitted clothing. This is achieved through a variety of hand sewing techniques along with the sewing machine. This course focuses on the importance of custom fit and design in merging style, elegance and teaches the traditional methods of couture at the highest level of excellence. Students will choose a garment they want to make to fit themselves, a friend or on the dress form. During the class they will learn the following: How to construct your garment using couture techniques that used in the industry The process of fine-tuning a fit Learn about appropriate fabrics underlining, and interfacings. Learn how to create an inner structure for your garment. Make a garment that is unique to you!</p>
                </div>
            </div>

            <div class="row align-items-center my-5">
                <div class="col-md-6">
                    <figure><img src="{{asset('front/images/service2.jpg')}}" class="w-100" alt=""></figure>
                </div>
                <div class="col-md-6">
                    <h3>Tailoring: “Masterclass</h3>
                    <p><strong>Tailoring: “Masterclass -</strong> Professional Development Course that combines the masterful techniques that are relevant to tailoring. Students will learn what it takes to make a bespoke custom tailored jacket, coat, trousers or any other garment of their choice. Due to the intensive hand work in this class most courses will run for 10-15 days. The class dates can be customized so they do not need to run continuously, students can take breaks to do the home work. Students should have some prior sewing knowledge or take a beginner course or 2 before taking this course.
                        <br> Students will learn the following:
                    </p>
                </div>
                <div class="col-md-12 mt-5">
                    <ul>
                        <li>The structure of the inside of the garment, the interior materials and how they are engineered to control shape.</li>
                        <li>Fabrics: how to choose the exterior and interior fabrics to create the end result desired Hand sewing techniques and skills</li>
                        <li>Machine sewing</li>
                        <li>Bespoke methods</li>
                        <li>Fitting methods</li>
                        <li>Complete a finished garment</li>
                    </ul>
                    <p><strong>Intro to Tailoring workshops -</strong> will be help for Students looking to learn techniques and not a complete garment. Students will learn the following: Make samples of hand stitching methods in tailoring
                        How to tailor a jacket collar What fabrics are used in creating shapes – both exterior and interior? How to mark fabrics </p>
                </div>
            </div>

            <div class="row align-items-center my-5">
                <div class="col-md-6">
                    <figure><img src="{{asset('front/images/service3.jpg')}}" class="w-100" alt=""></figure>
                </div>
                <div class="col-md-6">
                    <h3>Pattern making courses</h3>
                    <p>Students will learn the following in these courses: <br>
                        Intro to Pattern Making: <br>
                        How to draft a pant pattern, skirt, dress or top to fit you or a friend.</p>

                    <p>Cut and sew a sample pattern and perfect the fit of the pattern.
                        Special topic classes will be offered as well.</p>

                </div>
            </div>

            <div class="row align-items-center my-5">
                <div class="col-md-6">
                    <figure><img src="{{asset('front/images/service4.jpg')}}" class="w-100" alt=""></figure>
                </div>
                <div class="col-md-6">
                    <h3>Draping Classes</h3>
                    <p>Students will learn the following in these courses </p>
                </div>
            </div>

            <div class="row align-items-center my-5">
                <div class="col-md-6">
                    <figure><img src="{{asset('front/images/service5.jpg')}}" class="w-100" alt=""></figure>
                </div>
                <div class="col-md-6">
                    <h3>Intro to Draping How</h3>
                    <p>to drape a skirt and bodice <br>
                        Transfer the drape to a pattern <br>
                        Cut and sew the pattern and perfect the fit. <br>
                        Special topic classes will be offered as well.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
