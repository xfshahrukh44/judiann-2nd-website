@extends('front.layouts.app')

@section('title', 'Classroom')
@section('description', '')
@section('keywords', '')

@section('content')

    <style>
        header, footer {
            display: none;
        }
    </style>

    <section class="chattingSec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="videoBox">
                        <div class="headingCont">
{{--                            <div class="timer">--}}
{{--                                <div class="count"></div>--}}
{{--                                <span>03:15</span>--}}
{{--                            </div>--}}
                            <h3>John Smith</h3>
                        </div>
                        <div class="videoControllers">
{{--                            <a href=""><i class="fas fa-microphone"></i></a>--}}
{{--                            <a href=""><i class="fas fa-headphones-alt"></i></a>--}}
                            <a href=""><i class="fas fa-phone"></i></a>
{{--                            <a href=""><i class="fas fa-camera"></i></a>--}}
{{--                            <a href=""><i class="fas fa-cog"></i></a>--}}
                        </div>
                        <figure class="videoThumbMain">
                            <img src="{{asset('front/images/mainVideo.jpg')}}" alt="">
                        </figure>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="video-thumbs">
                        <div>
                            <div class="thumbBox">
                                <img src="{{asset('front/images/thumb1.jpg')}}" alt="">
                                <i class="fa fa-hand-paper-o"></i>
                                <div class="content">
                                    <h3>Name</h3>
                                    <button class="themeBtn py-1">Allow Screen Share</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="thumbBox">
                                <img src="{{asset('front/images/thumb2.jpg')}}" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="thumbBox">
                                <img src="{{asset('front/images/thumb3.jpg')}}" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="thumbBox">
                                <img src="{{asset('front/images/thumb4.jpg')}}" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="thumbBox">
                                <img src="{{asset('front/images/thumb1.jpg')}}" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="thumbBox">
                                <img src="{{asset('front/images/thumb2.jpg')}}" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="thumbBox">
                                <img src="{{asset('front/images/thumb3.jpg')}}" alt="">
                            </div>
                        </div>
                        <div>
                            <div class="thumbBox">
                                <img src="{{asset('front/images/thumb4.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //on class type change
            $('.radio_class_type').on('change', function () {
                let val = $(this).val();
                if (val === 'online') {
                    $('.course_type').val('');
                    $('.option_course_type').each(function () {
                        if ($(this).data('online') != 1) {
                            $(this).prop('hidden', true);
                        } else {
                            $(this).prop('hidden', false);
                        }
                    });
                    $('.physical_class_type').prop('required', false);
                    $('.physical_class_type').val('');
                    $('.physical_class_type_wrapper').prop('hidden', true);
                }
                if (val === 'physical') {
                    $('.course_type').val('');
                    $('.option_course_type').each(function () {
                        if ($(this).data('physical') != 1) {
                            $(this).prop('hidden', true);
                        } else {
                            $(this).prop('hidden', false);
                        }
                    });
                    $('.physical_class_type').prop('required', true);
                    $('.physical_class_type').val('');
                    $('.physical_class_type_wrapper').prop('hidden', false);
                }
            });
        });
    </script>
@endsection
