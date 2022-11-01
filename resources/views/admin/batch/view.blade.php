@extends('admin.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Batch')
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
                        <li class="breadcrumb-item active">Batch Detail</li>
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
                            <h3 class="card-title">Batch Detail</h3>
{{--                            @if(course_is_joinable($content->id))--}}
{{--                                <button class="btn btn-success" style="float: right;">Start streaming</button>--}}
{{--                            @endif--}}
                            <a target="_blank" href="{{route('admin.stream', $content->id)}}" class="btn btn-success" style="float: right;">Start streaming</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Batch Name</th>
                                        <td>{{$content->name??''}}</td>
                                    </tr>
                                    <tr>
                                        <th>Course</th>
                                        <td>{{$content->course->name??''}}</td>
                                    </tr>
                                    @if(!is_null($content->date_range))
                                        <tr>
                                            <th>Date</th>
                                            <td>{{$content->date_range??''}}</td>
                                        </tr>
                                        <tr>
                                            <th>From</th>
                                            <td>{{Carbon\Carbon::parse($content->time_from)->format('g:i A')??''}}</td>
                                        </tr>
                                        <tr>
                                            <th>To</th>
                                            <td>{{Carbon\Carbon::parse($content->time_to)->format('g:i A')??''}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                        </tr>
                                        @foreach($content->batch_dates as $batch_date)
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
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

</div>
@endsection
