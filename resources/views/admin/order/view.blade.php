@extends('admin.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Order')
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
                        <li class="breadcrumb-item active">Order Detail</li>
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
                            <h3 class="card-title">Order Detail</h3>
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
                                        <th>ID</th>

                                        <td>{{$content->id??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Customer</th>
                                        <td>{{$content->user->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Course</th>
                                        <td>{{$content->batch->course->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Batch</th>
                                        <td>{{$content->batch->name??''}}</td>
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
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

</div>
@endsection
