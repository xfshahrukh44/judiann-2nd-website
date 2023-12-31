@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Batch')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Batch Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Batch Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Batch</h3>
                            </div>
                            <form class="batch-form" method="post" action="{{!empty($content->id)?url('admin/batch-edit/'.$content->id):route('admin.add-batch')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">Batch Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$content->name ?? old('name')}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Course</label>
                                        <select name="course_id" id="course_id" class="form-control @error('course_id') is-invalid @enderror" required>
                                            <option value="">Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" {!! isset($content) && $content->course_id == $course->id ? 'selected' : '' !!}>{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_online">Is Online?</label>
                                        <input type="checkbox" class="@error('is_online') is-invalid @enderror" name="is_online" id="is_online" {!! isset($content) && $content->is_online == 1 ? 'checked' : '' !!}>
                                        @error('is_online')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_physical">Is Physical?</label>
                                        <input type="checkbox" class="@error('is_physical') is-invalid @enderror" name="is_physical" id="is_physical" {!! isset($content) && $content->is_physical == 1 ? 'checked' : '' !!}>
                                        @error('is_physical')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group physical_class_type_wrapper" hidden>
                                        <label for="is_physical">Physical Class Type</label>
                                        <select class="form-control @error('physical_class_type') is-invalid @enderror physical_class_type" name="physical_class_type" id="physical_class_type">
                                            <option value="">Select Physical Class Type:</option>
                                            <option value="group" {!! isset($content) && $content->physical_class_type == 'group' ? 'selected' : '' !!}>Group classes</option>
                                            <option value="in_person" {!! isset($content) && $content->physical_class_type == 'in_person' ? 'selected' : '' !!}>In-person</option>
                                        </select>
                                        @error('physical_class_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_physical" class="number_of_seats" {!! !isset($content) || $content->physical_class_type != 'group' ? 'hidden' : '' !!}>Number of Seats</label>
                                        <input type="text" class="form-control @error('number_of_seats') is-invalid @enderror" name="number_of_seats" id="number_of_seats" placeholder="Number of Seats" value="{{isset($content) && $content->number_of_seats ? $content->number_of_seats : 0}}"
                                            {!! !isset($content) || $content->physical_class_type != 'group' ? 'hidden' : '' !!}>
                                        @error('number_of_seats')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label for="date_range">Schedule Type</label>
                                    <div class="form-group">
                                        <input type="radio" value="date_range" name="schedule_types" class="input_schedule_types" required {!! isset($content) && count($content->batch_dates) == 0 ? 'checked' : '' !!}>
                                        <label for="">Date Range</label>
                                        <input type="radio" value="custom_dates" name="schedule_types" class="input_schedule_types" required {!! isset($content) && count($content->batch_dates) > 0 ? 'checked' : '' !!}>
                                        <label for="">Custom Dates</label>
                                    </div>

                                    <div class="form-group date_range_wrapper" {!! !isset($content) ? 'hidden' : '' !!} {!! isset($content) && count($content->batch_dates) > 0 ? 'hidden' : '' !!}>
                                        <label for="date_range">Date Range</label>
                                        <input type="text" class="@error('date_range') is-invalid @enderror input_date_range" name="date_range" id="date_range" value="{{isset($content) && $content->date_range? $content->date_range : old('date_range')}}" {!! isset($content) && $content->date_range == 1 ? 'checked' : '' !!}>
                                        <input type="time" id="input_date_range_time_from" name="time_from" value="{{isset($content) && $content->time_from ? $content->time_from : old('time_from')}}">
                                        <input type="time" id="input_date_range_time_to" name="time_to" value="{{isset($content) && $content->time_to ? $content->time_to : old('time_to')}}">
                                        @error('date_range')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group custom_dates_wrapper" {!! !isset($content) ? 'hidden' : '' !!} {!! isset($content) && count($content->batch_dates) == 0 ? 'hidden' : '' !!}>
                                        <label for="date_range">Custom Dates</label>
                                        <input type="button" class="btn btn-primary btn-sm btn_add_custom_dates" value="+" style="margin-top: 10px;margin-bottom: 10px;">
                                        <div class="custom_dates_inner_wrapper">
                                            @if(isset($content) && count($content->batch_dates) > 0)
                                                @foreach($content->batch_dates as $batch_date)
                                                    <div>
                                                        <input type="date" class="input_custom_dates" name="custom_dates[]" value="{{$batch_date->date}}" required>
                                                        <input type="time" class="input_time_from" name="time_froms[]" value="{{$batch_date->time_from}}" required>
                                                        <input type="time" class="input_time_to" name="time_tos[]" value="{{$batch_date->time_to}}" required>
                                                        <input type="button" class="btn btn-danger btn-sm btn_remove_custom_dates" value="-" style="margin-top: 10px;margin-bottom: 10px;">
                                                    </div>
                                                @endforeach
                                            @endif
{{--                                            <div>--}}
{{--                                                <input type="date" class="input_custom_dates" name="custom_dates[]" required>--}}
{{--                                                <input type="time" class="input_time_from" name="time_froms[]" required>--}}
{{--                                                <input type="time" class="input_time_to" name="time_tos[]" required>--}}
{{--                                                <input type="button" class="btn btn-danger btn-sm btn_remove_custom_dates" value="-" style="margin-top: 10px;margin-bottom: 10px;">--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="{{route('batch')}}" class="btn btn-warning btn-md">Cancel</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            //init daterange
            var date_range_el = $('#date_range');
            var date_range_time_from_el = $('#input_date_range_time_from');
            var date_range_time_to_el = $('#input_date_range_time_to');
            date_range_el.daterangepicker();

            //populate date_range
            var edit_check = `<?php echo(empty($content->id) || empty($content->date_range)); ?>`;
            if(edit_check) {
                date_range_el.val('');
                date_range_time_from_el.val('');
                date_range_time_to_el.val('');
            }

            //populate schedule types

            //empty date_range value on cancel click
            date_range_el.on('cancel.daterangepicker', function(ev, picker) {
                date_range_el.val('');
            });

            //on add custom date
            $('.btn_add_custom_dates').on('click', function(){
                $('.custom_dates_inner_wrapper')
                .append(`<div>
                            <input type="date" class="input_custom_dates" name="custom_dates[]" required>
                            <input type="time" class="input_time_from" name="time_froms[]" required>
                            <input type="time" class="input_time_to" name="time_tos[]" required>
                            <input type="button" class="btn btn-danger btn-sm btn_remove_custom_dates" value="-" style="margin-top: 10px;margin-bottom: 10px;">
                        </div>`);
            });

            //on remove custom date
            $('body').on('click', '.btn_remove_custom_dates', function(){
                if($('.input_custom_dates').length > 1) {
                    $(this).parent().remove();
                }
            });

            //on schedule type select
            $('.input_schedule_types').on('change', function() {
                let val = $(this).val();
                let date_range_input = $('#date_range');
                let date_range_time_from_input = $('#input_date_range_time_from');
                let date_range_time_to_input = $('#input_date_range_time_to');
                let custom_date_inputs = $('.input_custom_dates');
                let date_range_wrapper = $('.date_range_wrapper');
                let custom_dates_wrapper = $('.custom_dates_wrapper');
                let custom_dates_inner_wrapper = $('.custom_dates_inner_wrapper');

                if(val === 'date_range') {
                    date_range_input.prop('required', true);
                    date_range_time_from_input.prop('required', true);
                    date_range_time_to_input.prop('required', true);
                    date_range_el.val('')
                    date_range_time_from_el.val('');
                    date_range_time_to_el.val('');
                    custom_dates_inner_wrapper.html('');
                    date_range_wrapper.prop('hidden', false);
                    custom_dates_wrapper.prop('hidden', true);
                }

                if(val === 'custom_dates') {
                    date_range_input.prop('required', false);
                    date_range_time_from_input.prop('required', false);
                    date_range_time_to_input.prop('required', false);
                    date_range_el.val('')
                    date_range_time_from_el.val('');
                    date_range_time_to_el.val('');
                    custom_dates_inner_wrapper
                    .html(`<div>
                                <input type="date" class="input_custom_dates" name="custom_dates[]" required>
                                <input type="time" class="input_time_from" name="time_froms[]" required>
                                <input type="time" class="input_time_to" name="time_tos[]" required>
                                <input type="button" class="btn btn-danger btn-sm btn_remove_custom_dates" value="-" style="margin-top: 10px;margin-bottom: 10px;">
                            </div>`);
                    date_range_wrapper.prop('hidden', true);
                    custom_dates_wrapper.prop('hidden', false);
                }
            });

            //on is_physical click
            $('#is_physical').on('change', function() {
                if ($(this).prop('checked')) {
                    $('.physical_class_type_wrapper').prop('hidden', false);
                    $('.physical_class_type').prop('required', true);
                } else {
                    $('.physical_class_type_wrapper').prop('hidden', true);
                    $('.physical_class_type').prop('required', false);

                    $('#physical_class_type').val('');
                    $('#number_of_seats').prop('hidden', true);
                    $('.number_of_seats').prop('hidden', true);
                    $('#number_of_seats').prop('required', false);
                    $('.number_of_seats').prop('required', false);
                }
            });

            //on physical_class_type change
            $('#physical_class_type').on('change', function() {
                //in_person
                if ($(this).val() == 'group') {
                    $('#number_of_seats').prop('hidden', false);
                    $('.number_of_seats').prop('hidden', false);
                    $('#number_of_seats').prop('required', true);
                    $('.number_of_seats').prop('required', true);
                } else {
                    $('#number_of_seats').prop('hidden', true);
                    $('.number_of_seats').prop('hidden', true);
                    $('#number_of_seats').prop('required', false);
                    $('.number_of_seats').prop('required', false);
                }
            });

            //trigger is_physical change
            $('#is_physical').trigger('change');
        });
    </script>
@endsection
