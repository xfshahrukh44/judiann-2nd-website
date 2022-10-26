@extends('customer.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Course')
@section('page_css')
<!-- Datatables -->
<link href="{{ asset('admin/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/datatables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/datatables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
    rel="stylesheet">
<link href="{{ asset('admin/datatables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
    rel="stylesheet">
<link href="{{ asset('admin/datatables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
<style>
    th {
        background-color: #f7f7f7;
    }
</style>
@endsection
@section('section')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6 offset-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Registered Course Detail</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Registered Course Detail</h3>
{{--                            @if(course_is_joinable($content->course->id))--}}
{{--                                <button class="btn btn-success" style="float: right;">Join</button>--}}
{{--                            @endif--}}
                            @if($content->class_type == 'online' && $content->batch->is_streaming)
                                <a target="_blank" href="{{route('customer.stream', [$content->batch->course_id, $content->batch_id])}}" class="btn btn-success" style="float: right;">Join</a>
                            @endif
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <td>{{$content->id??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Course Name</th>
                                        <td>{{$content->batch->course->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Course Fees</th>
                                        <td>{{$content->batch->course->fees??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Class Type</th>
                                        <td>{{$content->class_type??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Physical Class Type</th>
                                        <td>{{$content->physical_class_type??''}}</td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Course Schedule -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Course Schedule</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    @if(!is_null($content->batch->date_range))
                                        <tr>
                                            <th>Date</th>
                                            <td>{{$content->batch->date_range??''}}</td>
                                        </tr>
                                        <tr>
                                            <th>From</th>
                                            <td>{{Carbon\Carbon::parse($content->batch->time_from)->format('g:i A')??''}}</td>
                                        </tr>
                                        <tr>
                                            <th>To</th>
                                            <td>{{Carbon\Carbon::parse($content->batch->time_to)->format('g:i A')??''}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                        </tr>
                                        @foreach($content->batch->batch_dates as $batch_date)
                                            <tr>
                                                <td>{{$batch_date->date}}</td>
                                                <td>{{Carbon\Carbon::parse($batch_date->time_from)->format('g:i A')}}</td>
                                                <td>{{Carbon\Carbon::parse($batch_date->time_to)->format('g:i A')}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

</div>
@endsection
