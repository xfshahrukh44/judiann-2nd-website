@extends('customer.layouts.app')
@section('section')
@section('title', 'Dashboard')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>

                        <div hidden id="events" data-events="{{json_encode($events)}}"></div>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="headTwo">Calendar</h2>
                    <div id="calendar"></div>
                </div>
{{--                <div class="col-lg-3 col-6">--}}
{{--                    <!-- small box -->--}}
{{--                    <div class="small-box bg-info">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>44</h3>--}}
{{--                            <p>New Orders</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-bag"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i--}}
{{--                                class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ./col -->--}}
{{--                <div class="col-lg-3 col-6">--}}
{{--                    <!-- small box -->--}}
{{--                    <div class="small-box bg-success">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>14</h3>--}}
{{--                            <p>Products</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-stats-bars"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i--}}
{{--                                class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ./col -->--}}
{{--                 <div class="col-lg-3 col-6">--}}
{{--                    <!-- small box -->--}}
{{--                    <div class="small-box bg-warning">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>24</h3>--}}
{{--                            <p>Customers</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-person-add"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i--}}
{{--                                class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ./col -->--}}
            </div>
            {{-- latest orders --}}
            <div class="row mt-4 mb-3">


            {{-- latest orders end --}}

            {{-- latest Reviews --}}


            </div>
            {{-- latest orders end --}}
            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            init_calendars();

            function init_calendars() {
                var calendar_events = [];
                var events = $('#events').data('events');

                events.forEach(function (item) {
                    calendar_events.push({
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

                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: calendar_events,
                    eventClick: function (info) {
                        console.log('info', info);
                        // $('#event_course').html(info.event.title);
                        // $('#event_time').html(info.event.extendedProps.time);
                        // $('#event_description').html(info.event.extendedProps.description);
                        // $('#event_img').prop('src', info.event.extendedProps.img_src);
                        // $('#event_class_type').html(info.event.extendedProps.class_type);
                        // $('.event_physical_class_type').prop('hidden', true);
                        // $('#btn_register_course').prop('hidden', info.event.extendedProps.already_bought);
                        // $('#btn_register_course').data('event', info.event);
                        // $('#btn_seats_full').prop('hidden', true);
                        // $('#btn_already_bought').prop('hidden', !info.event.extendedProps.already_bought);
                        // $('#event_detail_modal').modal('show');
                    }
                });

                calendar.render();
            }
        });
    </script>
@endsection
