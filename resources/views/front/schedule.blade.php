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
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="lastBox">
                        <h3>
                            Masterclasses
                        </h3>
                        <p>
                            October, 23, October 30, Nov 5,6, & 12 from 1:00-4:00
                        </p>
                        <p>
                            How to make a Jacket- Menswear or women’s wear
                        </p>
                        <p>
                            This course is open to all skill levels as a review and introduction to machines and sewing
                            techniques will be reviewed at the beginning of the course.
                        </p>
                        <p>
                            This is a 5 week course where the students will learn how to make a notched collar, lined
                            jacket.
                        </p>
                        <p>
                            Students will walk away with an in-depth knowledge of the making of a jacket as well as a
                            completed jacket. Pattern’s will be provided. Students will need to bring their own fabric.
                            Once you are registered and provide me with your size I will give you a detailed list of the
                            materials required for the jacket.
                        </p>
                        <p>Cost:<span> $750.00<span></span></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure>
                        <img class="img-fluid" src="{{asset("front/images/class1.jpg")}}" alt="img">
                    </figure>
                </div>
                {{--                @foreach($latest_updates as $latest_update)--}}
                {{--                    <div class="col-12">--}}
                {{--                        <div class="lastBox">--}}
                {{--                            <h3>{{$latest_update->title}}</h3>--}}
                {{--                            {!! get_readable_description($latest_update->description) !!}--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                @endforeach--}}
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <figure>
                        <img class="img-fluid" src="{{asset("front/images/class2.jpg")}}" alt="img">
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="lastBox">
                        <h3>Sewing Classes age 12+ Beginners</h3>
                        <p>Will be Updated soon.</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="lastBox">
                        <h3>Adult Beginner Sewing Class – Circle Skirt</h3>
                        <p></p>
                        <p>You do not need any previous experience. I will teach you how to sew by hand and on the
                            sewing machine. You will learn how to read a pattern, layout the pattern and sew your skirt.
                            You will leave with your own skirt!</p>
                        <p>You provide the fabric and I will provide the pattern and supplies. Once you register I will
                            need your size and I will let you know how much fabric to buy.</p>
                        <p><strong>Dates and Times:</strong></p>
                        <p><strong>October 22nd and October 29th from 12:00-3:00 and the price is $150</strong></p>
                        <p>Cost:<span> $150<span></span></span></p>
                        <p>Please call , text, or email to sign up. </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure>
                        <img class="img-fluid" src="{{asset("front/images/class3.jpg")}}" alt="img">
                    </figure>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <figure>
                        <img class="img-fluid" src="{{asset("front/images/class4.jpg")}}" alt="img">
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="lastBox">
                        <h3>Adult Sewing Class- How to make a Bomber Jacket</h3>
                        <p>Some experience is helpful but not necessary.</p>
                        <p>In this class you will learn how to sew a Bomber Jacket. </p>
                        <p>You provide the fabric and notions such as zippers. Once you register and give me your size
                            you will receive a complete list of the supplies required. </p>
                        <p>This is a 5 week class</p>
                        <p><strong>Dates and Times:</strong></p>
                        <p><strong>October 1 10:00-12:00 <span
                                    style="color:red;">(Cancelled due to hurricane)</span></strong></p>
                        <p><strong>October 8th 10:00-12:00</strong></p>
                        <p><strong>October 15th 10:00-12:00</strong></p>
                        <p><strong>October 22 12:00-3:000</strong></p>
                        <p><strong>October 29th 12:00-3:00</strong></p>
                        <p>Cost:<span>$450.00<span></span></span></p>
                        <p>Please call , text, or email to sign up. </p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="lastBox">
                        <h3>Online courses</h3>
                        <p>One on one lessons online:</p>
                        <p>These are private lessons that are offered online. The student can make any garment they want
                            to or just need help with. Time slots will be determined based on the need of the
                            student.</p>
                        <p>Cost: To be determined based on the project. </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure>
                        <img class="img-fluid" src="{{asset("front/images/class5.jpg")}}" alt="img">
                    </figure>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <figure>
                        <img class="img-fluid" src="{{asset("front/images/class6.jpg")}}" alt="img">
                    </figure>
                </div>
                <div class="col-md-6">
                    <div class="lastBox">
                        <h3>How to make a Notched Collar Jacket with Lining</h3>
                        <p>Dates to be determined, <a class="sec1"
                                                      href="https://judiannsfashiondesignstudios.com/contact/">please
                                inquire</a></p>
                        <p>This will be a 4 week course online. It is fully interactive as if you were in my
                            classroom.</p>
                        <p>Students will walk away with an in-depth knowledge of the making of a jacket as well as a
                            completed jacket. Pattern’s will be provided to students via mail If in the United States.
                            Out of the United States a download link will be provided. Students will need to provide
                            their own fabric, interfacing, threads and buttons. Once you are registered and provide me
                            with your size, I will give you a detailed list of the materials required for the
                            jacket. </p>
                        <p>Materials and tools required: Sewing machine, iron, scissors, pins, rulers/tape measures/
                            fabrics. </p>
                        <p>Cost <span> $600</span></p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="lastBox">
                        <h3>Portfolio Development Course</h3>
                        <p>This is a course for students looking to prepare a portfolio for college applications. In
                            this course you will learn everything you need to prepare your portfolio. </p>
                        <p>We will edit and curate the portfolio to meet the requirements of the College you are
                            applying to.
                            These are private classes held online and developed to meet your individual needs.
                        </p>
                        <p>There are 10 one hour sessions. Times and days will be determined individually. </p>
                        <p>If you are from a country outside of the US, we can work on a time together that works for
                            both of us.</p>
                        <p>Cost <span>$2500</span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure>
                        <img class="img-fluid" src="{{asset("front/images/class7.jpg")}}" alt="img">
                    </figure>
                </div>
            </div>
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
