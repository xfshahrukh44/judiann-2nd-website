@extends('front.layouts.app')

@section('title', !empty($student_work) ? (!empty($data->meta_title) ? $data->meta_title : 'Student’s Work') : 'Student’s Work')
@section('description', !empty($student_work) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->


    <div class="main-slider inner">
        <img class="img-fluid w-100"
             src="{{!empty($student_work) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg')}}"
             alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">{{!empty($student_work) ? (!empty($data->banner_title) ? $data->banner_title : 'Student’s Work') : 'Student’s Work'}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->


    <section class="wrkSec">
        <div class="container-fluid">
{{--            <div class="row">--}}
            <h2 class="headOne">{{!empty($student_work) ? (!empty($data->section_title) ? $data->section_title : 'Student’s Work') : 'Student’s Work'}}</h2>
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

                @foreach($students as $student)
                    <div class="col-md-4">
                        <a target="_blank" href="{{route('front.individual-students-work', $student->id)}}">
                            <img class="img-fluid" src="{{$student->get_student_image()}}" alt="img">
                        </a>
                        <h6>{{$student->name}}</h6>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
