@extends('front.layouts.app')

@section('title', 'Schedule')
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
                            <h2 class="headOne">Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->

    <section class="contactInnr">
        <div class="container">
            @foreach($latest_updates as $key => $latest_update)
                <div class="row align-items-center">
                    @if($key % 2 == 0)
                        <div class="col-md-6">
                            <div class="lastBox">
                                <h3>{{$latest_update->title}}</h3>
                                <p>{!! get_readable_description($latest_update->description) !!}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <figure>
                                <img class="img-fluid" src="{{asset("front/images/class3.jpg")}}" alt="img">
                            </figure>
                        </div>
                    @else
                        <div class="col-md-6">
                            <figure>
                                <img class="img-fluid" src="{{asset("front/images/class3.jpg")}}" alt="img">
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <div class="lastBox">
                                <h3>{{$latest_update->title}}</h3>
                                <p>{!! get_readable_description($latest_update->description) !!}</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            <div class="row align-items-center justify-content-center">
                <div class="col-md-9">
                    <h2 class="headOne text-center mb-5">Schedule A Class</h2>
                    <form method="post" action="{{route('front.schedule_class')}}" class="hf-form hf-form-57 "
                          data-id="57" data-title="Schedule Class Form" data-slug="schedule-class-form"
                          data-message-success="Thank you! We will be in touch soon."
                          data-message-invalid-email="Sorry, that email address looks invalid."
                          data-message-required-field-missing="Please fill in the required fields."
                          data-message-error="Oops. An error occurred.">
                        @csrf
                        <div class="hf-fields-wrap">
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder=" First  Name"
                                                   name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name"
                                                   name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email" name="email"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Contact" name="phone"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="">
                                        <label>Select Class Type</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="class_type" value="online"
                                                   class="custom-control-input radio_class_type" required>
                                            <label class="custom-control-label" for="customRadio1">Online Class</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="class_type" value="physical"
                                                   class="custom-control-input radio_class_type" required>
                                            <label class="custom-control-label" for="customRadio2">Physical
                                                Class</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="">
                                        &nbsp;
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Course Type:</label>
                                            <select class="form-control course_type" placeholder="Select Course Type"
                                                    name="course_id" required>
                                                <option disabled selected value="">Select Course Type:</option>
                                                @foreach($courses as $course)
                                                    <option class="option_course_type"
                                                            data-online="{{$course->is_online}}"
                                                            data-physical="{{$course->is_physical}}"
                                                            value="{{$course->id}}">{{$course->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 physical_class_type_wrapper" hidden>
                                        <div class="form-group">
                                            <label>Select Physical Class Type:</label>
                                            <select class="form-control physical_class_type"
                                                    placeholder="Select Class Type" name="physical_class_type">
                                                <option disabled selected>Select Physical Class Type:</option>
                                                <option value="group">Group classes</option>
                                                <option value="in_person">In-person</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <button type="submit">Send Now</button>
                                    </div>
                                </div>
                            </div>
                            <noscript>Please enable JavaScript for this form to work.</noscript>
                        </div>
                    </form>
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
