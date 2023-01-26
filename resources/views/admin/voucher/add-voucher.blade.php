@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Voucher')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Voucher Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Voucher Form</li>
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
                                <h3 class="card-title">Voucher</h3>
                            </div>
                            <form class="voucher-form" method="post" action="{{!empty($content->id)?url('admin/voucher-edit/'.$content->id):route('admin.add-voucher')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif
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
                                        <label for="code">Voucher Code</label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="name" value="{{$content->code?? old('code')}}" placeholder="Voucher Code" required>
                                        @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                        <div class="form-group">
                                            <label for="code">Discount Rate</label>
                                            <input type="number" step="1" class="form-control @error('discount_rate') is-invalid @enderror" name="discount_rate" id="name" value="{{$content->discount_rate?? old('discount_rate')}}" placeholder="Discount Rate" required>
                                            @error('discount_rate')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    <div class="form-group">
                                        <label for="code">Valid Until</label>
                                        <input type="date" class="form-control @error('valid_until') is-invalid @enderror" name="valid_until" id="name" value="{{$content->valid_until?? old('valid_until')}}" placeholder="Valid Until" required>
                                        @error('valid_until')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Voucher Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Voucher Description">{{$content->description?? old('description')}}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="{{route('voucher')}}" class="btn btn-warning btn-md">Cancel</a>
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

        });
    </script>
@endsection
