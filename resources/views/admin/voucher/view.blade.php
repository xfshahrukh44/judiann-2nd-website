@extends('admin.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Voucher')

@section('css')
    <style>
        span.select2-selection--single {
            height: 40px !important;
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
                            <li class="breadcrumb-item active">Voucher Detail</li>
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
                                <h3 class="card-title">Voucher Detail</h3>
                                {{--                            @if(course_is_joinable($content->id))--}}
                                {{--                                <button class="btn btn-success" style="float: right;">Start streaming</button>--}}
                                {{--                            @endif--}}
                                {{--                            <a target="_blank" href="{{route('admin.stream', $content->id)}}" class="btn btn-success" style="float: right;">Start streaming</a>--}}
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
                                        <th>Course</th>
                                        <td>{{$content->course->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Voucher Code</th>
                                        <td>{{$content->code??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Discount Rate</th>
                                        <td>{{($content->discount_rate . '% Off')??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Valid Until</th>
                                        <td>{{$content->valid_until??''}}</td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-body">
                                <form action="{{route('admin.voucher.sendByEmail')}}" method="POST">
                                    @csrf
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="text-center">
                                        <tr>
                                            <th colspan="2">
                                                Send Coupon by Email
                                                <i class="fa-solid fa-circle-info text-blue"
                                                   title="Select from list or write any valid email"></i>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="hidden" name="voucher_id" value="{{$content->id}}">
                                                <select class="form-control" id="btn_emails" name="emails[]" placeholder="Emails" multiple>
                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->email}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-block btn-primary">Send Email</button>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                </form>
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

@section('script')
    <script>
        $(document).ready(function () {
            $('#btn_emails').select2({
                tags: true
            });
        });
    </script>
@endsection
