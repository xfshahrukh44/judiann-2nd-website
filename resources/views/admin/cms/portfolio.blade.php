@extends('admin.layouts.app')
@section('title', 'CMS')
@section('section')
    <style>
        .img-upload #image-preview {
            width: 240px;
            height: 240px;
            border: 1px dashed #000;
            color: #ecf0f1;
            position: relative;
            background-repeat: no-repeat !important;
            background-position: center !important;
        }

        .img-upload #image-preview input {
            width: 120px;
            height: 40px;
            z-index: 10;
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            margin-left: 0px;
            cursor: pointer;
            opacity: 0;
        }

        .img-upload #image-preview label {
            padding: 0px;
            z-index: 5;
            width: 130px;
            height: 40px;
            background-color: #ffffff;
            color: #143250;
            font-size: 14px;
            line-height: 40px;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            right: 0;
            margin-left: 0px;
            bottom: 0px;
            margin-bottom: 0px;
            text-align: center;
            position: absolute;
            cursor: pointer;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
            /* box-shadow: 0px 0px 15px #eaeaea; */
            box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Portfolio Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Portfolio Form</li>
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
                                <h3 class="card-title">Portfolio Form</h3>
                            </div>
                            <form class="category-form" method="post" action="{{route('admin.cms.portfolio')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h3>Meta Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title"
                                                       value="{{!empty($portfolio) ? ($data->meta_title ?? '') : ''}}"
                                                       placeholder="Meta Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Meta Description</label>
                                                <input type="text" class="form-control" name="meta_description"
                                                       value="{{!empty($portfolio) ? ($data->meta_description ?? '') : ''}}"
                                                       placeholder="Meta Description">
                                            </div>
                                            <div class="form-group">
                                                <h3>Banner Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Banner Title</label>
                                                <input type="text" class="form-control" name="banner_title"
                                                       value="{{!empty($portfolio) ? ($data->banner_title ?? '') : ''}}"
                                                       placeholder="Banner Title">
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label>Banner Image</label>
                                                    <div class="img-upload">
                                                        <div id="image-preview" class="img-preview"
                                                             style="background: url({{ !empty($portfolio) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg') }});">
                                                            <label for="image-upload" class="img-label"
                                                                   id="image-label">{{ __('Upload Image') }}</label>
                                                            <input type="file" name="banner_image" class="img-upload"
                                                                   id="image-upload">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h3>Portfolio Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="section_title"
                                                       value="{{!empty($portfolio) ? ($data->section_title ?? '') : ''}}"
                                                       placeholder="Title">
                                            </div>
                                            <div class="card-footer float-right">
                                                <button type="submit" onclick="validateinputs()"
                                                        class="btn btn-primary">Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Portfolio</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="{{route('admin.portfolio.index')}}" class="btn btn-primary mb-4">ADD
                                                Portfolio</a>
                                        </div>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Image Order</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($portfolios as $key => $port)
                                                    <tr>
                                                        <th scope="row">{{($key + 1)}}</th>
                                                        <td>
                                                            <div class="img-upload">
                                                                <div id="image-preview" class="img-preview"
                                                                     style="background: url({{ $port->get_portfolio_image() }});">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$port->image_order}}</td>
                                                        <td>
                                                            <a class="btn btn-primary"
                                                               href="{{route('admin.portfolio.edit',$port->id)}}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <form action="{{route('admin.portfolio.destroy', $port->id)}}" class="form-group d-inline-flex" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    <script>
        $(document).ready(function () {
            // IMAGE UPLOADING :)
            $(".img-upload").on("change", function () {
                var imgpath = $(this).parent();
                var file = $(this);
                readURL(this, imgpath);

            });

            function readURL(input, imgpath) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        imgpath.css('background', 'url(' + e.target.result + ')');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endsection

