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
                        <h1>Home Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Home</li>
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
                                <h3 class="card-title">Home Form</h3>
                            </div>
                            <form class="category-form" method="post" action="{{route('admin.cms.home')}}"
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
                                                       value="{{!empty($home) ? ($data->meta_title ?? '') : ''}}"
                                                       placeholder="Meta Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Meta Description</label>
                                                <input type="text" class="form-control" name="meta_description"
                                                       value="{{!empty($home) ? ($data->meta_description ?? '') : ''}}"
                                                       placeholder="Meta Description">
                                            </div>
                                            <div class="form-group">
                                                <h3>Banner Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Banner Title</label>
                                                <input type="text" class="form-control" name="banner_title"
                                                       value="{{!empty($home) ? ($data->banner_title ?? '') : ''}}"
                                                       placeholder="Banner Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Banner Content</label>
                                                <textarea class="form-control"
                                                          name="banner_content">{{!empty($home) ? ($data->banner_content ?? '') : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label>Banner Image</label>
                                                    <div class="img-upload">
                                                        <div id="image-preview" class="img-preview"
                                                             style="background: url({{ !empty($home) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg') }});">
                                                            <label for="image-upload" class="img-label"
                                                                   id="image-label">{{ __('Upload Image') }}</label>
                                                            <input type="file" name="banner_image" class="img-upload"
                                                                   id="image-upload">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h3>About Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="abt_title"
                                                       value="{{!empty($home) ? ($data->abt_title ?? '') : ''}}"
                                                       placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Content</label>
                                                <textarea class="form-control"
                                                          name="abt_content">{{!empty($home) ? ($data->abt_content ?? '') : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <h3>Portfolio Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="portfolio_title"
                                                       value="{{!empty($home) ? ($data->portfolio_title ?? '') : ''}}"
                                                       placeholder="Title">
                                            </div>

                                            <div class="form-group">
                                                <h3>Student's Work Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="stdnt_title"
                                                       value="{{!empty($home) ? ($data->stdnt_title ?? '') : ''}}"
                                                       placeholder="Title">
                                            </div>

                                            <div class="form-group">
                                                <h3>Vogue Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Content</label>
                                                <input type="text" class="form-control" name="vogue_content"
                                                       value="{{!empty($home) ? ($data->vogue_content ?? '') : ''}}"
                                                       placeholder="Content">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Link</label>
                                                <input type="url" class="form-control" name="vogue_url"
                                                       value="{{!empty($home) ? ($data->vogue_url ?? '') : ''}}"
                                                       placeholder="URL">
                                            </div>

                                            <div class="form-group">
                                                <h3>Master Class Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="master_title"
                                                       value="{{!empty($home) ? ($data->master_title ?? '') : ''}}"
                                                       placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Content</label>
                                                <textarea class="form-control" id="description"
                                                          name="master_content">{{!empty($home) ? ($data->master_content ?? '') : ''}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <h3>Service Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="service_title"
                                                       value="{{!empty($home) ? ($data->service_title ?? '') : ''}}"
                                                       placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Content</label>
                                                <textarea class="form-control" name="service_content"
                                                          placeholder="Content"
                                                          rows="4">{{!empty($home) ? ($data->service_content ?? '') : ''}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <h3>Offer Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="offer_title"
                                                       value="{{!empty($home) ? ($data->offer_title ?? '') : ''}}"
                                                       placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Content # 1</label>
                                                <textarea class="form-control" name="offer_content1"
                                                          placeholder="Content"
                                                          rows="4">{{!empty($home) ? ($data->offer_content1 ?? '') : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Content # 2</label>
                                                <textarea class="form-control" name="offer_content2"
                                                          placeholder="Content"
                                                          rows="4">{{!empty($home) ? ($data->offer_content2 ?? '') : ''}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <h3>Video Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label>Image # 1</label>
                                                    <div class="img-upload">
                                                        <div id="image-preview" class="img-preview"
                                                             style="background: url({{ !empty($home) ? (!empty($data->vid_img1) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/video1.jpg')) : asset('front/images/video1.jpg') }});">
                                                            <label for="image-upload" class="img-label"
                                                                   id="image-label">{{ __('Upload Image') }}</label>
                                                            <input type="file" name="vid_img1" class="img-upload"
                                                                   id="image-upload">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Link # 1</label>
                                                <input type="url" class="form-control" name="vid_url1"
                                                       value="{{!empty($home) ? ($data->vid_url1 ?? '') : ''}}"
                                                       placeholder="Youtube URL">
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label>Image # 2</label>
                                                    <div class="img-upload">
                                                        <div id="image-preview" class="img-preview"
                                                             style="background: url({{ !empty($home) ? (!empty($data->vid_img2) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/video2.jpg')) : asset('front/images/video2.jpg') }});">
                                                            <label for="image-upload" class="img-label"
                                                                   id="image-label">{{ __('Upload Image') }}</label>
                                                            <input type="file" name="vid_img2" class="img-upload"
                                                                   id="image-upload">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Link # 2</label>
                                                <input type="url" class="form-control" name="vid_url2"
                                                       value="{{!empty($home) ? ($data->vid_url2 ?? '') : ''}}"
                                                       placeholder="Youtube URL">
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label>Image # 3</label>
                                                    <div class="img-upload">
                                                        <div id="image-preview" class="img-preview"
                                                             style="background: url({{ !empty($home) ? (!empty($data->vid_img3) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/video3.jpg')) : asset('front/images/video3.jpg') }});">
                                                            <label for="image-upload" class="img-label"
                                                                   id="image-label">{{ __('Upload Image') }}</label>
                                                            <input type="file" name="vid_img3" class="img-upload"
                                                                   id="image-upload">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Link # 3</label>
                                                <input type="url" class="form-control" name="vid_url3"
                                                       value="{{!empty($home) ? ($data->vid_url3 ?? '') : ''}}"
                                                       placeholder="Youtube URL">
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label>Image # 4</label>
                                                    <div class="img-upload">
                                                        <div id="image-preview" class="img-preview"
                                                             style="background: url({{ !empty($home) ? (!empty($data->vid_img4) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/video2.jpg')) : asset('front/images/video2.jpg') }});">
                                                            <label for="image-upload" class="img-label"
                                                                   id="image-label">{{ __('Upload Image') }}</label>
                                                            <input type="file" name="vid_img4" class="img-upload"
                                                                   id="image-upload">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Link # 4</label>
                                                <input type="url" class="form-control" name="vid_url4"
                                                       value="{{!empty($home) ? ($data->vid_url4 ?? '') : ''}}"
                                                       placeholder="Youtube URL">
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
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="{{URL::asset('admin/custom_js/custom.js')}}"></script>
    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        window.onload = function () {
            CKEDITOR.replace('description', {
                {{--filebrowserUploadUrl: '{{ route('project.document-image-upload',['_token' => csrf_token() ]) }}',--}}
                {{--filebrowserUploadMethod: 'form'--}}
            });
        }
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

