@extends('admin.layouts.app')
@section('title', 'CMS')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Setting Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Setting</li>
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
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Section</h3>
                            </div>
                            <form class="category-form" method="post"  action="{{route('admin.cms.aboutUs')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="title" id="title"
                                                       value="" placeholder="Title"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Content</label>
                                                <input type="text" class="form-control" name="content" id="content"
                                                       value="" placeholder="Content"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Button Text</label>
                                                <input type="text" class="form-control" name="button_text" id="button_text"
                                                       value="" placeholder="Button Text"
                                                       required>
                                            </div>
                                            <div class="card-footer float-right">
                                                <button type="submit" onclick="validateinputs()" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
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
    <script src="{{URL::asset('admin/custom_js/custom.js')}}"></script>
@endsection

