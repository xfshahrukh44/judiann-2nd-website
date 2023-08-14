@extends('front.layouts.app')

@section('title', !empty($schedule) ? (!empty($data->meta_title) ? $data->meta_title : 'Schedule') : 'Schedule')
@section('description', !empty($schedule) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('content')

   <style>
       /* Modal styles */
       #batchModal {
           background: rgba(0, 0, 0, 0.5);
       }

       .modal-content {
           border-radius: 10px;
           box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
       }

       .modal-header {
           background-color: #007bff;
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

       .modal h3{
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
{{--                                    <figure>--}}
{{--                                        <img class="img-fluid" src="{{$batch->course->get_course_image()}}" alt="img">--}}
{{--                                    </figure>--}}
                                    <figure>
                                        <img class="img-fluid" src="{{ $batch->course->get_course_image() }}"
                                             data-batches-url="{{ route('get_batches') }}" alt="img">
                                    </figure>
                                </div>
                            @else
                                <div class="col-md-6">
{{--                                    <figure>--}}
{{--                                        <img class="img-fluid" src="{{$batch->course->get_course_image()}}" alt="img">--}}
{{--                                    </figure>--}}
                                    <figure>
                                        <img class="img-fluid" src="{{ $batch->course->get_course_image() }}"
                                             data-batches-url="{{ route('get_batches') }}" alt="img">
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
                        <div class="row">
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
{{--                                    <figure>--}}
{{--                                        <img class="img-fluid" src="{{$batch->course->get_course_image()}}" alt="img">--}}
{{--                                    </figure>--}}
                                    <figure>
                                        <img class="img-fluid" src="{{ $batch->course->get_course_image() }}"
                                             data-batches-url="{{ route('get_batches') }}" alt="img">
                                    </figure>
                                </div>
                            @else
                                <div class="col-md-6">
{{--                                    <figure>--}}
{{--                                        <img class="img-fluid" src="{{$batch->course->get_course_image()}}" alt="img">--}}
{{--                                    </figure>--}}
                                    <figure>
                                        <img class="img-fluid" src="{{ $batch->course->get_course_image() }}"
                                             data-batches-url="{{ route('get_batches') }}" alt="img">
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
    </section>


{{--    {{modal work for all batches}}--}}
{{--    <div class="modal fade" id="batchModal" tabindex="-1" role="dialog" aria-labelledby="batchModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="batchModalLabel">All Batches</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <!-- The content of all batches will be dynamically loaded here -->--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Modal -->
{{--    <div class="modal fade" id="batchModal" tabindex="-1" role="dialog" aria-labelledby="batchModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="batchModalLabel">Batches</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <button class="nav-link active btn_online_batches" id="online-tab" data-toggle="tab" data-target="#Online"--}}
{{--                            type="button"--}}
{{--                            role="tab" aria-controls="home" aria-selected="true">Online--}}
{{--                    </button>--}}


{{--                    <button class="nav-link btn_physical_batches" id="onsite-tab" data-toggle="tab" data-target="#OnSite"--}}
{{--                            type="button"--}}
{{--                            role="tab" aria-controls="profile" aria-selected="false">On-Site--}}
{{--                    </button>--}}
{{--                    <!-- Batch details will be populated here -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

   <div class="modal fade" id="batchModal" tabindex="-1" role="dialog" aria-labelledby="batchModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="batchModalLabel">Batches</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">


               </div>
           </div>
       </div>
   </div>


   {{--Calendar & Form--}}
    <section class="contactInnr">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <h2 class="headOne text-center mt-5">{{!empty($schedule) ? (!empty($data->section_title) ? $data->section_title : 'Schedule A Class') : 'Schedule A Class'}}</h2>
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Select Course Type:</label>
                                            <select class="form-control select_course_type"
                                                    name="batch_id" required>
                                                <option disabled selected value="">Select Course Type:</option>
                                                <option value="Online" selected>Online</option>
                                                <option value="On-site">On-site</option>
                                            </select>
                                        </div>
                                    </div>

                                 {{--                                   <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Select Course:</label>
                                                                            <select class="form-control course_type online_course_type"
                                                                                    name="batch_id" required hidden>
                                                                                <option disabled selected value="">Select Course:</option>
                                                                                @foreach($online_batches as $batch)
                                                                                    <option class="option_batch_type"
                                                                                            data-online="{{$batch->is_online}}"
                                                                                            data-physical="{{$batch->is_physical}}"
                                                                                            value="{{$batch->id}}">{{$batch->course->name . ' (Batch: '.$batch->name.')'}} </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <select class="form-control course_type physical_course_type"
                                                                                    name="batch_id" hidden>
                                                                                <option disabled selected value="">Select Course:</option>
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
                                                                    </div>--}}

                                    <input type="hidden" name="class_type" class="class_type" value="online">
                                    <input type="hidden" id="form_batch_id">
                                    <input type="hidden" id="form_class_type">
                                    <input type="hidden" id="form_physical_class_type">

                                    {{--                                <div class="col-12 physical_class_type_wrapper" hidden>--}}
                                    {{--                                    <div class="form-group">--}}
                                    {{--                                        <label>Select Physical Class Type:</label>--}}
                                    {{--                                        <select class="form-control physical_class_type"--}}
                                    {{--                                                placeholder="Select Class Type" name="physical_class_type">--}}
                                    {{--                                            <option disabled selected>Select Physical Class Type:</option>--}}
                                    {{--                                            <option value="group">Group classes</option>--}}
                                    {{--                                            <option value="in_person">In-person</option>--}}
                                    {{--                                        </select>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}

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
                                                    {{--                                                            <td></td>--}}
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
                <div class="col-md-6">
                    <h2 class="headTwo">On-line</h2>
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
                    <button type="button" id="btn_register_course" class="btn btn-primary" data-event="">Register
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
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //init online and physical calendars
            init_calendars();

            $('.btn_online_batches').on('click', function() {
               $('.select_course_type').val('Online');
               $('.select_course_type').trigger('change');
            });

            $('.btn_physical_batches').on('click', function() {
               $('.select_course_type').val('On-site');
               $('.select_course_type').trigger('change');
            });

            $('.select_course_type').on('change', function () {
                if ($(this).val() == 'Online') {
                    // $('.online_course_type').prop('hidden', false);
                    // $('.online_course_type').prop('required', true);
                    // $('.physical_course_type').prop('hidden', true);
                    // $('.physical_course_type').prop('required', false);
                    // $('.class_type').val('online');
                    // $('.physical_class_type').prop('required', false);
                    // $('.physical_class_type').val('');
                    // $('.physical_class_type_wrapper').prop('hidden', true);
                    $('.headTwo').html('On-line');

                    $('#online_calendar').prop('hidden', false);
                    $('#physical_calendar').prop('hidden', true);
                } else if ($(this).val() == 'On-site') {
                    // $('.online_course_type').prop('hidden', true);
                    // $('.online_course_type').prop('required', false);
                    // $('.physical_course_type').prop('hidden', false);
                    // $('.physical_course_type').prop('required', true);
                    // $('.class_type').val('physical');
                    // $('.physical_class_type').prop('required', true);
                    // $('.physical_class_type').val('');
                    // $('.physical_class_type_wrapper').prop('hidden', false);
                    $('.headTwo').html('On-site');

                    $('#online_calendar').prop('hidden', true);
                    $('#physical_calendar').prop('hidden', false);
                }
            });

            // //online section
            // $('.btn_online_batches').on('click', function () {
            // });
            //
            // //physical section
            // $('.btn_physical_batches').on('click', function () {
            // });

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

            $('#btn_register_course').on('click', function () {
                let event = $(this).data('event');
                // console.log('EVENT', event.extendedProps);

                //prevent redundant items selection
                if ($('#tr_batch_' + event.extendedProps.batchId).length > 0) {
                    $('#event_detail_modal').modal('hide');
                    return alert('Item already selected.');
                }

                let login_check = '{{\Illuminate\Support\Facades\Auth::check()}}';
                if (!login_check) {
                    console.log('notLogin');
                    $('#event_detail_modal').modal('hide');
                    return $('#loginModal').modal('show');
                } else {
                    console.log('event.extendedProps', event.extendedProps);
                    //courses_wrapper
                    $('#courses_wrapper').append(`<tr id="tr_batch_` + event.extendedProps.batchId + `">
                                                    <input type="hidden" name="batch_ids[]" value="` + event.extendedProps.batchId + `">
                                                    <input type="hidden" name="class_types[]" value="` + event.extendedProps.class_type + `">
                                                    <input type="hidden" name="physical_class_types[]" value="` + event.extendedProps.physical_class_type + `">
                                                    <input type="hidden" name="fees[]" class="input_fees" value="` + event.extendedProps.fees + `">
                                                    <td>
                                                        ` + event.title + `
                                                    </td>
                                                    <td>
                                                        $` + event.extendedProps.fees + `
                                                    </td>
                                                    <td>
                                                        <div class="btnCont">
                                                            <span>
                                                                <i class="fas fa-times"></i>
                                                                <input type="radio" class="btn_remove_course" name="" id="" data-batch="` + event.extendedProps.batchId + `">
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>`);


                    calculate_total();
                    return $('#event_detail_modal').modal('hide');
                }
            });

            $('body').on('click', '.btn_remove_course', function () {
                let batch_id = $(this).data('batch');
                console.log("$('#tr_batch_' + batch_id)", $('#tr_batch_' + batch_id));
                $('#tr_batch_' + batch_id).remove();
                calculate_total();
            });
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
                    batch_id: item.batch_id,
                    class_type: item.class_type,
                    physical_class_type: item.physical_class_type,
                    batch_is_full: item.batch_is_full,
                    already_bought: item.already_bought,
                    fees: item.fees,
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
                    batch_id: item.batch_id,
                    class_type: item.class_type,
                    physical_class_type: item.physical_class_type,
                    batch_is_full: item.batch_is_full,
                    already_bought: item.already_bought,
                    fees: item.fees,
                });
            });

            var online_calendarEl = document.getElementById('online_calendar');
            var physical_calendarEl = document.getElementById('physical_calendar');

            var online_calendar = new FullCalendar.Calendar(online_calendarEl, {
                timeZone: 'EST',
                initialView: 'dayGridMonth',
                events: online_calendar_events,
                eventClick: function (info) {
                    console.log('info', info);
                    $('#event_course').html(info.event.title);
                    $('#event_time').html(info.event.extendedProps.time);
                    $('#event_description').html(info.event.extendedProps.description);
                    $('#event_img').prop('src', info.event.extendedProps.img_src);
                    $('#event_class_type').html(info.event.extendedProps.class_type);
                    $('.event_physical_class_type').prop('hidden', true);
                    $('#btn_register_course').prop('hidden', info.event.extendedProps.already_bought);
                    $('#btn_register_course').data('event', info.event);
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
                    $('#event_course').html(info.event.title);
                    $('#event_time').html(info.event.extendedProps.time);
                    $('#event_description').html(info.event.extendedProps.description);
                    $('#event_img').prop('src', info.event.extendedProps.img_src);
                    $('#event_class_type').html(info.event.extendedProps.class_type);
                    $('.event_physical_class_type').prop('hidden', !info.event.extendedProps.physical_class_type);
                    $('#event_physical_class_type').html(info.event.extendedProps.physical_class_type == 'group' ? 'Group' : 'In Person');
                    $('#btn_register_course').prop('hidden', info.event.extendedProps.batch_is_full || info.event.extendedProps.already_bought);
                    $('#btn_register_course').data('event', info.event);
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


   {{-- <script>
        $(document).ready(function () {
            // Batch modal handler
            $('.img-fluid').on('click', function (event) {
                var imgSrc = $(this).attr('src');
                var batchesUrl = $(this).data('batches-url');

                // Set the image in the modal header
                // $('#batchModalLabel').html('<img class="img-fluid" src="' + imgSrc + '" alt="img">');

                // Fetch batches using AJAX
                $.ajax({
                    url: batchesUrl,
                    method: 'GET',
                    success: function (data) {
                        // Populate modal with batches
                        $('#batchModal .modal-body').html(data);
                        // Show the modal
                        $('#batchModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        // Handle error if needed
                        console.log(xhr.responseText);
                    }
                });
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            // Handle click event for "Online" button
            $('#online-tab').on('click', function () {
                $('#Online').show();    // Show online batches section
                $('#OnSite').hide();    // Hide physical batches section
            });

            // Handle click event for "On-Site" button
            $('#onsite-tab').on('click', function () {
                $('#Online').hide();    // Hide online batches section
                $('#OnSite').show();    // Show physical batches section
            });


            // Batch modal handler
            $('.img-fluid').on('click', function (event) {
                var imgSrc = $(this).attr('src');
                var batchesUrl = $(this).data('batches-url'); // Replace with the URL to fetch batches for the clicked image

                // Set the image in the modal header
                $('#batchModalLabel').html('<img class="img-fluid" src="' + imgSrc + '" alt="img">');

                // Fetch batches using AJAX
                $.ajax({
                    url: batchesUrl,
                    method: 'GET',
                    success: function (data) {
                        // Populate modal with batches
                        $('#batchModal .modal-body').html(data);
                        // Show the modal
                        $('#batchModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        // Handle error if needed
                        console.log(xhr.responseText);
                    }
                });
            });
        });

    </script>--}}

    <script>
        $(document).ready(function () {

            // Batch modal handler
            $('.img-fluid').on('click', function (event) {
                var imgSrc = $(this).attr('src');
                var batchesUrl = $(this).data('batches-url'); // Replace with the URL to fetch batches for the clicked image

                // Set the image in the modal header
                $('#batchModalLabel').html('<img class="img-fluid" src="' + imgSrc + '" alt="img">');

                // Fetch batches using AJAX
                $.ajax({
                    url: batchesUrl,
                    method: 'GET',
                    success: function (data) {
                        // Populate modal with batches
                        $('#batchModal .modal-body').html(data);
                        // Show the modal
                        $('#batchModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        // Handle error if needed
                        console.log(xhr.responseText);
                    }
                });
            });
        });


    </script>


@endsection
