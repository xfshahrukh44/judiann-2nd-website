@extends('front.layouts.app')

@section('title', !empty($schedule) ? (!empty($data->meta_title) ? $data->meta_title : 'Schedule') : 'Schedule')
@section('description', !empty($schedule) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('content')
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">


    <style>
        /* Modal styles */

        .batch-item {
            text-align: center;
        }

        .batchModal {
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background-color: #e2571c;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .modal-title {
            font-size: 1.25rem;
        }

        .modal-body {
            padding: 20px;
        }

        .modal h3 {
            color: white;
        }

        .close {
            color: #fff;
            opacity: 1;
        }

        /* Button styles */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .modal-dialog {
                max-width: 90%;
                margin: 1.75rem auto;
            }

            .modal-content {
                padding: 10px;
            }
        }

    </style>

    <!-- Begin: Main Slider -->
    <div hidden id="online_events" data-events="{{json_encode($online_events)}}"></div>
    <div hidden id="physical_events" data-events="{{json_encode($physical_events)}}"></div>
    <div class="main-slider inner">
        <img class="img-fluid w-100"
             src="{{ !empty($schedule) ? (!empty($data->banner_image)
                    ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg'))
                    : asset('front/images/BannerImg.jpg') }}"
             alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">{{ !empty($schedule)
                                ? (!empty($data->banner_title) ? $data->banner_title : 'Schedule A Class')
                                : 'Schedule A Class' }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Main Slider -->

    <section class="contactInnr">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                {{--<button class="nav-link active btn_online_batches" id="home-tab" data-toggle="tab" data-target="#Online"
                        type="button"
                        role="tab" aria-controls="home" aria-selected="true">Online
                </button>--}}
                <button class="nav-link btn_physical_batches"
                        role="tab" aria-controls="home" aria-selected="true">All Courses
                </button>
            </li>
            {{--<li>
                <button class="nav-link btn_physical_batches" id="profile-tab" data-toggle="tab" data-target="#onsite"
                        type="button"
                        role="tab" aria-controls="profile" aria-selected="false">On-Site
                </button>
            </li>--}}
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="Online" role="tabpanel" aria-labelledby="home-tab">
                <div class="container">
                    @foreach($courses as $key => $course)
                        <div class="row">
                            @if($key % 2 == 0)
                                <div class="col-md-6">
                                    <div class="lastBox scheduleBox" style="height: 450px; overflow-y: scroll;">
                                        <h3>{{$course->name . ' (Batch: '.$course->name.')'}}</h3>
                                        <p>{!! $course->description !!}</p>
                                        <h4 class="text-white">TIMINGS</h4>
                                        {!! get_batch_timings_by_id($course->id) !!}
                                        <h4 class="text-white">Fees: ${{round($course->fees, 2)}}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <figure>
                                        <img class="img-fluid" src="{{ $course->get_course_image() }}"
                                             data-id="{{ $course->id }}" alt="img">
                                    </figure>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <figure>
                                        <img class="img-fluid" src="{{ $course->get_course_image() }}"
                                             data-id="{{ $course->id }}" alt="img">
                                    </figure>
                                </div>
                                <div class="col-md-6">
                                    <div class="lastBox scheduleBox" style="height: 450px; overflow-y: scroll;">
                                        <h3>{{$course->name . ' (Batch: '.$course->name.')'}}</h3>
                                        <p>{!! $course->description !!}</p>
                                        <h4 class="text-white">TIMINGS</h4>
                                        {!! get_batch_timings_by_id($course->id) !!}
                                        <h4 class="text-white">Fees: ${{round($course->fees, 2)}}</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Batch Modal Start --}}
    <div class="modal fade batchModal text-secondary" id="batchModal" tabindex="-1" role="dialog"
         aria-labelledby="batchModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batchModalLabel">Batches</h5>
                    <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="batch-list" id="batchList">
                        @include('front.batch-modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Batch Modal End --}}

    {{--Calendar & Form--}}
    <section class="contactInnr schedule-form">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <h2 class="headOne text-center mt-5">{{!empty($schedule)
                        ? (!empty($data->section_title)
                        ? $data->section_title : 'Schedule A Class') : 'Schedule A Class'}}</h2>
                    <h3 class="text-white text-center mt-3 mb-5">
                        Students may continually add multiple courses of both the online and onsite course
                        types.
                    </h3>
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <p class="blink">Please Sign-up and make an account first to register a course</p>
                        <a href="{{route('front.signup')}}" class="themeBtn">sign up</a>
                    @endif
                </div>
                <div class="col-md-6">
                    <form method="post" action="{{route('front.schedule.class')}}" class="hf-form hf-form-57 "
                          data-id="57" data-title="Schedule Class Form" data-slug="schedule-class-form"
                          data-message-success="Thank you! We will be in touch soon."
                          data-message-invalid-email="Sorry, that email address looks invalid."
                          data-message-required-field-missing="Please fill in the required fields."
                          data-message-error="Oops. An error occurred.">
                        @csrf
                        <div class="hf-fields-wrap">
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder=" First  Name"
                                                   name="first_name" readonly
                                                   value="{{Illuminate\Support\Facades\Auth::check() ? (explode(' ', Auth::user()->name)[0] ?? '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name"
                                                   name="last_name" readonly
                                                   value="{{Illuminate\Support\Facades\Auth::check() ? (explode(' ', Auth::user()->name)[1] ?? '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email"
                                                   name="email"
                                                   readonly
                                                   value="{{Illuminate\Support\Facades\Auth::check() ? (Auth::user()->email ?? '') : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Contact"
                                                   name="phone"
                                                   readonly {{Illuminate\Support\Facades\Auth::check() ? (Auth::user()->phone ?? '') : ''}}>
                                        </div>
                                    </div>
                                    {{--<div class="col-12">
                                        <div class="form-group">
                                            <label>Select Course Type:</label>
                                            <select class="form-control select_course_type"
                                                    name="batch_id" required>
                                                <option disabled selected value="">Select Course Type:</option>
                                                <option value="Online" selected>Online</option>
                                                <option value="On-site">On-site</option>
                                            </select>
                                        </div>
                                    </div>--}}

                                    <input type="hidden" name="class_type" class="class_type" value="online">
                                    <input type="hidden" id="form_batch_id">
                                    <input type="hidden" id="form_class_type">
                                    <input type="hidden" id="form_physical_class_type">

                                    <div class="col-12">
                                        <div class="table-responsive courseTable">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Select Courses</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="courses_wrapper">

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td><b>Total Price</b></td>
                                                    <td id="td_total_price"><b>$0.00</b></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <button type="submit" id="btn_submit" hidden>Send Now</button>
                                        @else
                                            <button type="submit" data-toggle="modal" data-target="#loginModal">
                                                Send Now
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <noscript>Please enable JavaScript for this form to work.</noscript>
                        </div>
                    </form>
                </div>
                {{--<div class="col-md-6">
                    <h2 class="headTwo">On-line</h2>
                    <div id="online_calendar"></div>
                    <div id="physical_calendar"></div>
                </div>--}}
            </div>
        </div>
    </section>

    {{--event detail modal--}}
    <div class="modal fade" id="event_detail_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" colspan="2">
                                <img id="event_img" class="w-100" src="" alt="">
                            </th>
                        </tr>
                        <tr>
                            <th>Course:</th>
                            <td id="event_course"></td>
                        </tr>
                        <tr>
                            <th>Time:</th>
                            <td id="event_time"></td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td id="event_description"></td>
                        </tr>
                        <tr>
                            <th>Class Type:</th>
                            <td id="event_class_type"></td>
                        </tr>
                        <tr class="event_physical_class_type">
                            <th>Physical Class Type:</th>
                            <td id="event_physical_class_type"></td>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_register_course" class="btn btn-primary btn_register_course"
                            data-event="">Register
                        Course
                    </button>
                    <button type="button" id="btn_seats_full" class="btn btn-danger" data-dismiss="modal">SEATS FULL
                    </button>
                    <button type="button" id="btn_already_bought" class="btn btn-success" data-dismiss="modal">ALREADY
                        BOUGHT
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--event detail modal--}}

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('.img-fluid').on('click', function () {
                let component = $(this);
                let imgSrc = component.attr('src');
                let courseId = component.data('id');

                $('.batchModal').show();
                $('#batchModalLabel').html('<img class="img-fluid" src="' + imgSrc + '" alt="img">');

                $.ajax({
                    url: `{{ route('get.batches') }}`,
                    method: 'GET',
                    // dataType: 'json',
                    data: {
                        courseId: courseId,
                    },
                    success: function (data) {
                        $('.batchModal').modal('show');
                        var modalBody = $('.modal-body');
                        var batchList = $('#batchList');
                        modalBody.html(data);
                    },
                    error: function (xhr, status, error) {
                        alert(error);
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.modal-close').on('click', function () {
                $('.batchModal').hide();
                $('.modal-backdrop').hide();
            });
            $('.modal-backdrop').hide();
        });

        $(document).ready(function () {
            $('body').on('click', '.btn_register_course', function () {
                let event = $(this).data('event');
                let batch_id = $(this).data('batch-id');
                let class_type = $(this).data('class-type');
                let physical_class_type = $(this).data('physical-class-type');
                let course_price = $(this).data('course-price');
                let batch_name = $(this).data('batch-name');
                let user_id = `{{ \Illuminate\Support\Facades\Auth::id() }}`;
                var section = $('.schedule-form');

                if ($('#tr_batch_' + batch_id).length > 0) {
                    $('.batchModal').modal('hide');
                    return toastr.error('Course Is Already Owned.');
                    alert('Item already selected.');
                }

                let login_check = '{{\Illuminate\Support\Facades\Auth::check()}}';
                if (!login_check) {
                    $('.batchModal').modal('hide');
                    return $('#loginModal').modal('show');
                } else {
                    console.log('class_type', physical_class_type)
                    $('#courses_wrapper').append(`<tr id="tr_batch_" class="batch-remove"` + batch_id + `">
                                                    <input type="hidden" name="user_id" value="` + user_id + `">
                                                    <input type="hidden" name="batch_id[]" value="` + batch_id + `">
                                                    <input type="hidden" name="class_type[]" value="` + class_type + `">
                                                    <input type="hidden" name="physical_class_type[]" value="` + physical_class_type + `">

                                                    <input type="hidden" name="fees[]" class="input_fees" value="` + course_price + `">
                                                    <td>
                                                        ` + batch_name + `
                                                    </td>
                                                    <td>
                                                        $` + course_price + `
                                                    </td>
                                                    <td>
                                                        <div class="btnCont">
                                                            <span>
                                                                <i class="fas fa-times"></i>
                                                                <input type="radio" class="btn_remove_course" name="batch_id" id="" data-batch-id="` + batch_id + `">
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>`);

                    if (section.length > 0) {
                        $('html, body').animate({
                            scrollTop: section.offset().top + section.outerHeight() - $(window).height()
                        }, "slow");
                    }
                    console.log('section', section);
                    calculate_total();
                    $('.modal-backdrop').hide();
                    $('.batchModal').hide();
                    return toastr.success('Course Successfully Added');
                }
            });
        });

        $(document).ready(function () {
            $('body').on('click', '.btn_remove_course', function (e) {
                e.preventDefault();
                if (confirm('Are you sure you want to Delete Batch?')) {
                    let batch_id = $(this).data('batch-id');
                    let parent = $(this).parent().parent().parent().parent();
                    $.ajax({
                        method: "POST",
                        url: `{{ route('remove.batch') }}`,
                        data: {
                            "_token": $('#csrf-token')[0].content,
                            batch_id: batch_id,
                        },
                        success: function (response) {
                            console.log('response.batch', response.batchId);

                            if (response.batchId.length > 0) {
                                toastr.success('Batch Successfully Deleted');
                                parent.remove();
                                calculate_total();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            toastr.error(error);
                        }
                    });
                } else {
                    return false;
                }
                // $('#tr_batch_' + batch_id).remove();
                // calculate_total();
            });
        });

        function calculate_total() {
            let total = 0.00;
            $('.input_fees').each(function () {
                total += parseFloat($(this).val()) ?? 0.00;
            });

            $('#td_total_price').html(`<b>$` + total + `</b>`);

            $('#btn_submit').prop('hidden', (total == 0.00));
        }
    </script>

    <script>
        $(document).ready(function () {
            init_calendars();

            $('.btn_online_batches').on('click', function () {
                $('.select_course_type').val('Online');
                $('.select_course_type').trigger('change');
            });

            $('.btn_physical_batches').on('click', function () {
                $('.select_course_type').val('On-site');
                $('.select_course_type').trigger('change');
            });

            $('.select_course_type').on('change', function () {
                if ($(this).val() == 'Online') {
                    /*   $('.online_course_type').prop('hidden', false);
                       $('.online_course_type').prop('required', true);
                       $('.physical_course_type').prop('hidden', true);
                       $('.physical_course_type').prop('required', false);
                       $('.class_type').val('online');
                       $('.physical_class_type').prop('required', false);
                       $('.physical_class_type').val('');
                       $('.physical_class_type_wrapper').prop('hidden', true);*/
                    $('.headTwo').html('On-line');

                    $('#online_calendar').prop('hidden', false);
                    $('#physical_calendar').prop('hidden', true);
                } else if ($(this).val() == 'On-site') {
                    /* $('.online_course_type').prop('hidden', true);
                     $('.online_course_type').prop('required', false);
                     $('.physical_course_type').prop('hidden', false);
                     $('.physical_course_type').prop('required', true);
                     $('.class_type').val('physical');
                     $('.physical_class_type').prop('required', true);
                     $('.physical_class_type').val('');
                     $('.physical_class_type_wrapper').prop('hidden', false);*/
                    $('.headTwo').html('On-site');

                    $('#online_calendar').prop('hidden', true);
                    $('#physical_calendar').prop('hidden', false);
                }
            });

            //on physical_class_type change
            $('.physical_class_type').on('change', function () {
                if ($(this).val() == 'group') {
                    $('.physical_option_batch').each(function () {
                        if ($(this).data('physical-class-type') == 'in_person') {
                            $(this).prop('hidden', true);
                            $(this).prop('selected', false);
                        } else {
                            $(this).prop('hidden', false);
                        }
                    });
                }
                if ($(this).val() == 'in_person') {
                    $('.physical_option_batch').each(function () {
                        if ($(this).data('physical-class-type') == 'group') {
                            $(this).prop('hidden', true);
                            $(this).prop('selected', false);
                        } else {
                            $(this).prop('hidden', false);
                        }
                    });
                }
            })

            /*$('body').on('click', '.btn_register_course', function () {
                let event = $(this).data('event');
                let batch_id = $(this).data('batch-id');
                let class_type = $(this).data('class-type');
                let course_price = $(this).data('course-price');
                let batch_name = $(this).data('batch-name');
                let user_id = `{{ \Illuminate\Support\Facades\Auth::id() }}`;

                if ($('#tr_batch_' + batch_id).length > 0) {
                    $('.batchModal').modal('hide');
                    return alert('Item already selected.');
                }

                let login_check = '{{\Illuminate\Support\Facades\Auth::check()}}';
                if (!login_check) {
                    $('.batchModal').modal('hide');
                    return $('#loginModal').modal('show');
                } else {
                    console.log('class_type', class_type)
                    $('#courses_wrapper').append(`<tr id="tr_batch_" class="batch-remove"` + batch_id + `">
                                                    <input type="hidden" name="user_id" value="` + user_id + `">
                                                    <input type="hidden" name="batch_id[]" value="` + batch_id + `">
                                                    <input type="hidden" name="class_type[]" value="` + class_type + `">

                                                    <input type="hidden" name="fees[]" class="input_fees" value="` + course_price + `">
                                                    <td>
                                                        ` + batch_name + `
                                                    </td>
                                                    <td>
                                                        $` + course_price + `
                                                    </td>
                                                    <td>
                                                        <div class="btnCont">
                                                            <span>
                                                                <i class="fas fa-times"></i>
                                                                <input type="radio" class="btn_remove_course" name="batch_id" id="" data-batch-id="` + batch_id + `">
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>`);


                    calculate_total();
                    $('.modal-backdrop').hide();
                    $('.batchModal').hide();
                    $('html,body').animate({scrollTop: document.body.scrollHeight},"slow");
                    return toastr.success('Course successfully added');
                }
            });*/
        });

        function init_calendars() {
            var online_calendar_events = [];
            var physical_calendar_events = [];
            var online_events = $('#online_events').data('events');
            var physical_events = $('#physical_events').data('events');

            if (online_events) {
                online_events.forEach(function (item) {
                    online_calendar_events.push({
                        title: item.title,
                        start: new Date(item.date),
                        time: item.time,
                        backgroundColor: item.color,
                        borderColor: item.color,
                        allDay: true,
                        description: item.description,
                        img_src: item.img_src,
                        batch_id: item.batch_id,
                        class_type: item.class_type,
                        physical_class_type: item.physical_class_type,
                        batch_is_full: item.batch_is_full,
                        already_bought: item.already_bought,
                        fees: item.fees,
                    });
                });
            }

            if (physical_events) {
                physical_events.forEach(function (item) {
                    physical_calendar_events.push({
                        title: item.title,
                        start: new Date(item.date),
                        time: item.time,
                        backgroundColor: item.color,
                        borderColor: item.color,
                        allDay: true,
                        description: item.description,
                        img_src: item.img_src,
                        batch_id: item.batch_id,
                        class_type: item.class_type,
                        physical_class_type: item.physical_class_type,
                        batch_is_full: item.batch_is_full,
                        already_bought: item.already_bought,
                        fees: item.fees,
                    });
                });
            }

            var online_calendarEl = document.getElementById('online_calendar');
            var physical_calendarEl = document.getElementById('physical_calendar');

            var online_calendar = new FullCalendar.Calendar(online_calendarEl, {
                timeZone: 'EST',
                initialView: 'dayGridMonth',
                events: online_calendar_events,
                eventClick: function (info) {
                    console.log('info', info);
                    console.log('info.event.extendedProps.batch_is_full:', info.event.extendedProps.batch_is_full);
                    console.log('info.event.extendedProps.already_bought:', info.event.extendedProps.already_bought);
                    $('#event_course').html(info.event.title);
                    $('#event_time').html(info.event.extendedProps.time);
                    $('#event_description').html(info.event.extendedProps.description);
                    $('#event_img').prop('src', info.event.extendedProps.img_src);
                    $('#event_class_type').html(info.event.extendedProps.class_type);
                    $('.event_physical_class_type').prop('hidden', true);
                    $('.btn_register_course').prop('hidden', info.event.extendedProps.already_bought);
                    $('.btn_register_course').data('event', info.event);
                    $('#btn_seats_full').prop('hidden', true);
                    $('#btn_already_bought').prop('hidden', !info.event.extendedProps.already_bought);
                    $('#event_detail_modal').modal('show');
                }
            });
            var physical_calendar = new FullCalendar.Calendar(physical_calendarEl, {
                timeZone: 'EST',
                initialView: 'dayGridMonth',
                events: physical_calendar_events,
                eventClick: function (info) {
                    console.log('info.event.extendedProps.batch_is_full:', info.event.extendedProps.batch_is_full);
                    console.log('info.event.extendedProps.already_bought:', info.event.extendedProps.already_bought);

                    $('#event_course').html(info.event.title);
                    $('#event_time').html(info.event.extendedProps.time);
                    $('#event_description').html(info.event.extendedProps.description);
                    $('#event_img').prop('src', info.event.extendedProps.img_src);
                    $('#event_class_type').html(info.event.extendedProps.class_type);
                    $('.event_physical_class_type').prop('hidden', !info.event.extendedProps.physical_class_type);
                    $('#event_physical_class_type').html(info.event.extendedProps.physical_class_type == 'group' ? 'Group' : 'In Person');
                    $('.btn_register_course').prop('hidden', info.event.extendedProps.batch_is_full || info.event.extendedProps.already_bought);
                    $('.btn_register_course').data('event', info.event);
                    $('#btn_seats_full').prop('hidden', !info.event.extendedProps.batch_is_full || info.event.extendedProps.already_bought);
                    $('#btn_already_bought').prop('hidden', !info.event.extendedProps.already_bought);
                    $('#event_detail_modal').modal('show');
                }
            });

            online_calendar.render();
            physical_calendar.render();

            $('#physical_calendar').prop('hidden', true);
        }

        function calculate_total() {
            let total = 0.00;
            $('.input_fees').each(function () {
                total += parseFloat($(this).val()) ?? 0.00;
            });

            $('#td_total_price').html(`<b>$` + total + `</b>`);

            $('#btn_submit').prop('hidden', (total == 0.00));
        }
    </script>
@endsection
