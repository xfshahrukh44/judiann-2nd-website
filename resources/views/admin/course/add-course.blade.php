@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Course')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Course Form</li>
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
                                <h3 class="card-title">Course</h3>
                            </div>
                            <form class="course-form" method="post" action="{{!empty($content->id)?url('admin/course-edit/'.$content->id):route('admin.add-course')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">Course Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image"placeholder="Course">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Course Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$content->name?? old('name')}}" placeholder="Course" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Course Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Course Description">{{$content->description?? old('description')}}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fees">Course Fees</label>
                                        <input type="number" step="0.01" class="form-control @error('fees') is-invalid @enderror" name="fees" id="fees" value="{{$content->fees?? old('fees')}}" placeholder="0.00" {!! isset($content) && $content->is_free == 1 ? 'readonly   ' : '' !!} required>
                                        @error('fees')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_free">Is Free?</label>
                                        <input type="checkbox" class="@error('is_free') is-invalid @enderror" name="is_free" id="is_free" {!! isset($content) && $content->is_free == 1 ? 'checked' : '' !!}>
                                        @error('is_free')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="{{route('course')}}" class="btn btn-warning btn-md">Cancel</a>
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
            $('#is_free').on('click', function () {
                if ($(this).prop('checked')) {
                    $('#fees').prop('readonly', true);
                    $('#fees').val(0.00);
                } else {
                    $('#fees').prop('readonly', false);
                }
            });
        });
    </script>
@endsection
