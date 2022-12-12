@extends('front.layouts.app')

@section('title', !empty($schedule) ? (!empty($data->meta_title) ? $data->meta_title : 'Schedule') : 'Schedule')
@section('description', !empty($schedule) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->

    <div hidden id="online_events" data-events="{{json_encode($online_events)}}"></div>
    <div hidden id="physical_events" data-events="{{json_encode($physical_events)}}"></div>
    <div class="main-slider inner">
        <img class="img-fluid w-100"
             src="{{!empty($schedule) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg')}}"
             alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">{{!empty($schedule) ? (!empty($data->banner_title) ? $data->banner_title : 'Schedule A Class') : 'Schedule A Class'}}</h2>
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
                <button class="nav-link active btn_online_batches" id="home-tab" data-toggle="tab" data-target="#Online"
                        type="button"
                        role="tab" aria-controls="home" aria-selected="true">Online
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn_physical_batches" id="profile-tab" data-toggle="tab" data-target="#onsite"
                        type="button"
                        role="tab" aria-controls="profile" aria-selected="false">On-Site
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            {{--online--}}
            <div class="tab-pane fade show active" id="Online" role="tabpanel" aria-labelledby="home-tab">
                <div class="container">
                    @foreach($online_batches as $key => $batch)
                        <div class="row">
                            @if($key % 2 == 0)
                                <div class="col-md-6">
                                    <div class="lastBox scheduleBox" style="height: 450px; overflow-y: scroll;">
                                        <h3>{{$batch->course->name . ' (Batch: '.$batch->name.')'}}</h3>
                                        <p>{!! get_readable_description($batch->course->description) !!}</p>
                                        <h4 class="text-white">TIMINGS</h4>
                                        {!! get_batch_timings($batch) !!}
                                        <h4 class="text-white">Fees: ${{round($batch->course->fees, 2)}}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <figure>
                                        <img class="img-fluid" src="{{$batch->course->get_course_image()}}" alt="img">
                                    </figure>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <figure>
                                        <img class="img-fluid" src="{{$batch->course->get_course_image()}}" alt="img">
                                    </figure>
                                </div>
                                <div class="col-md-6">
                                    <div class="lastBox scheduleBox" style="height: 450px; overflow-y: scroll;">
                                        <h3>{{$batch->course->name . ' (Batch: '.$batch->name.')'}}</h3>
                                        <p>{!! get_readable_description($batch->course->description) !!}</p>
                                        <h4 class="text-white">TIMINGS</h4>
                                        {!! get_batch_timings($batch) !!}
                                        <h4 class="text-white">Fees: ${{round($batch->course->fees, 2)}}</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            {{--physical--}}
            <div class="tab-pane fade" id="onsite" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container">
                    @foreach($physical_batches as $key => $batch)
                        <div class="row fullBox">
                            @if($key % 2 == 0)
                                <div class="col-md-6">
                                    <div class="lastBox scheduleBox" style="height: 450px; overflow-y: scroll;">
                                        <h3>{{$batch->course->name . ' (Batch: '.$batch->name.')'}}</h3>
                                        <p>{!! get_readable_description($batch->course->description) !!}</p>
                                        <h4 class="text-white">TIMINGS</h4>
                                        {!! get_batch_timings($batch) !!}
                                        @if($batch->physical_class_type == 'group')
                                            <h4 class="text-white">Number of Seats: {{$batch->number_of_seats}}</h4>
                                        @endif
                                        @if(batch_is_full($batch))
                                            <h4 class="text-danger">SEATS FULL</h4>
                                        @endif
                                        <h4 class="text-white">Fees: ${{round($batch->course->fees, 2)}}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <figure>
                                        <img class="img-fluid" src="{{$batch->course->get_course_image()}}" alt="img">
                                    </figure>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <figure>
                                        <img class="img-fluid" src="{{$batch->course->get_course_image()}}" alt="img">
                                    </figure>
                                </div>
                                <div class="col-md-6">
                                    <div class="lastBox scheduleBox" style="height: 450px; overflow-y: scroll;">
                                        <h3>{{$batch->course->name . ' (Batch: '.$batch->name.')'}}</h3>
                                        <p>{!! get_readable_description($batch->course->description) !!}</p>
                                        <h4 class="text-white">TIMINGS</h4>
                                        {!! get_batch_timings($batch) !!}
                                        @if($batch->physical_class_type == 'group')
                                            <h4 class="text-white">Number of Seats: {{$batch->number_of_seats}}</h4>
                                        @endif
                                        @if(batch_is_full($batch))
                                            <h4 class="text-danger">SEATS FULL</h4>
                                        @endif
                                        <h4 class="text-white">Fees: ${{round($batch->course->fees, 2)}}</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <h2 class="headOne text-center my-5">{{!empty($schedule) ? (!empty($data->section_title) ? $data->section_title : 'Schedule A Class') : 'Schedule A Class'}}</h2>
                </div>
                <div class="col-md-6">
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder=" First  Name"
                                                   name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name"
                                                   name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email"
                                                   name="email"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Contact"
                                                   name="phone"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Select Course Type:</label>
                                            <select class="form-control course_type online_course_type"
                                                    placeholder="Select Course Type"
                                                    name="batch_id" required>
                                                <option disabled selected value="">Select Course Type:</option>
                                                @foreach($online_batches as $batch)
                                                    <option class="option_batch_type"
                                                            data-online="{{$batch->is_online}}"
                                                            data-physical="{{$batch->is_physical}}"
                                                            value="{{$batch->id}}">{{$batch->course->name . ' (Batch: '.$batch->name.')'}} </option>
                                                @endforeach
                                            </select>
                                            <select class="form-control course_type physical_course_type"
                                                    placeholder="Select Course Type"
                                                    name="batch_id" hidden>
                                                <option disabled selected value="">Select Course Type:</option>
                                                @foreach($physical_batches as $batch)
                                                    <option class="option_batch_type physical_option_batch"
                                                            {!! batch_is_full($batch) ? 'disabled style="color: red;"' : '' !!}
                                                            data-online="{{$batch->is_online}}"
                                                            data-physical="{{$batch->is_physical}}"
                                                            data-physical-class-type="{{$batch->physical_class_type}}"
                                                            value="{{$batch->id}}">{{$batch->course->name . ' (Batch: '.$batch->name.')' . (batch_is_full($batch) ? ' (SEATS FULL)' : '')}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="class_type" class="class_type" value="online">

                                    <div class="col-12 physical_class_type_wrapper" hidden>
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
                <div class="col-md-6">
                    <div id="online_calendar"></div>
                    <div id="physical_calendar"></div>
                </div>
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

                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //init online and physical calendars
            init_calendars();

            //online section
            $('.btn_online_batches').on('click', function () {
                $('.online_course_type').prop('hidden', false);
                $('.online_course_type').prop('required', true);
                $('.physical_course_type').prop('hidden', true);
                $('.physical_course_type').prop('required', false);
                $('.class_type').val('online');
                $('.physical_class_type').prop('required', false);
                $('.physical_class_type').val('');
                $('.physical_class_type_wrapper').prop('hidden', true);

                $('#online_calendar').prop('hidden', false);
                $('#physical_calendar').prop('hidden', true);
            });

            //physical section
            $('.btn_physical_batches').on('click', function () {
                $('.online_course_type').prop('hidden', true);
                $('.online_course_type').prop('required', false);
                $('.physical_course_type').prop('hidden', false);
                $('.physical_course_type').prop('required', true);
                $('.class_type').val('physical');
                $('.physical_class_type').prop('required', true);
                $('.physical_class_type').val('');
                $('.physical_class_type_wrapper').prop('hidden', false);

                $('#online_calendar').prop('hidden', true);
                $('#physical_calendar').prop('hidden', false);
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
        });

        function init_calendars() {
            var online_calendar_events = [];
            var physical_calendar_events = [];
            var online_events = $('#online_events').data('events');
            var physical_events = $('#physical_events').data('events');

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
                });
            });
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
                });
            });

            var online_calendarEl = document.getElementById('online_calendar');
            var physical_calendarEl = document.getElementById('physical_calendar');

            var online_calendar = new FullCalendar.Calendar(online_calendarEl, {
                initialView: 'dayGridMonth',
                events: online_calendar_events,
                eventClick: function (info) {
                    $('#event_course').html(info.event.title);
                    $('#event_time').html(info.event.extendedProps.time);
                    $('#event_description').html(info.event.extendedProps.description);
                    $('#event_img').prop('src', info.event.extendedProps.img_src);
                    $('#event_detail_modal').modal('show');
                }
            });
            var physical_calendar = new FullCalendar.Calendar(physical_calendarEl, {
                initialView: 'dayGridMonth',
                events: physical_calendar_events,
                eventClick: function (info) {
                    $('#event_course').html(info.event.title);
                    $('#event_time').html(info.event.extendedProps.time);
                    $('#event_description').html(info.event.extendedProps.description);
                    $('#event_img').prop('src', info.event.extendedProps.img_src);
                    $('#event_detail_modal').modal('show');
                }
            });

            online_calendar.render();
            physical_calendar.render();

            $('#physical_calendar').prop('hidden', true);
        }
    </script>
@endsection
