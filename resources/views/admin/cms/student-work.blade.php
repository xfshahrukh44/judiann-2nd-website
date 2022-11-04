@extends('admin.layouts.app')
@section('title', 'Students')
@section('page_css')
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
    <style>
        .addBtn{
            float: right;
            /*margin-top: 10px;*/
        }
        td{
            text-align: center;
        }
    </style>

@endsection
@section('section')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Students Work</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Students Work</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Students</h3>
                            </div>
                            <form class="category-form" method="post" action="{{route('admin.cms.student-work')}}"
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
                                                       value="{{!empty($student_work) ? ($data->meta_title ?? '') : ''}}"
                                                       placeholder="Meta Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Meta Description</label>
                                                <input type="text" class="form-control" name="meta_description"
                                                       value="{{!empty($student_work) ? ($data->meta_description ?? '') : ''}}"
                                                       placeholder="Meta Description">
                                            </div>
                                            <div class="form-group">
                                                <h3>Banner Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Banner Title</label>
                                                <input type="text" class="form-control" name="banner_title"
                                                       value="{{!empty($student_work) ? ($data->banner_title ?? '') : ''}}"
                                                       placeholder="Banner Title">
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label>Banner Image</label>
                                                    <div class="img-upload">
                                                        <div id="image-preview" class="img-preview"
                                                             style="background: url({{ !empty($student_work) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg') }});">
                                                            <label for="image-upload" class="img-label"
                                                                   id="image-label">{{ __('Upload Image') }}</label>
                                                            <input type="file" name="banner_image" class="img-upload"
                                                                   id="image-upload">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h3>Students Section</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" name="section_title"
                                                       value="{{!empty($student_work) ? ($data->section_title ?? '') : ''}}"
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

                    <div class="col-md-12 mt-5">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary pull-right addBtn" href="{{route('admin.add-student')}}">Add Student</a>
                            </div>
                            <div class="col-md-12">

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Created At</th>

                                        <th>Action</th>
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
        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #343a40;
            color: #fff;">
                        <h2 class="modal-title">Confirmation</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin: 0;">Are you sure you want to block this ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="ok_block" name="ok_block" class="btn btn-danger">Block</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #343a40;
            color: #fff;">
                        <h2 class="modal-title">Confirmation</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin: 0;">Are you sure you want to delete this ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="ok_delete" name="ok_delete" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
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
    <script>
        $(document).ready(function () {
            var DataTable = $("#example1").DataTable({
                dom: "Blfrtip",
                buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                }, {
                    extend: "print",
                    className: "btn-sm"
                }],
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: {
                    url: `{{route(request()->segment(2))}}`,
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'image',
                        name: 'image',
                        render: function( data, type, full, meta ) {
                            return `<img src="`+data+`" height="80"/>`;
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false}
                ],

                "order": [[ 2, "desc" ]]

            });
            var delete_id;

            //on delete click
            $(document,this).on('click','.delete',function(){
                delete_id = $(this).attr('id');
                $('#deleteModal').modal('show');
            });

            //on delete confirmation
            $(document).on('click','#ok_delete',function(){
                $.ajax({
                    type:"delete",
                    url:`{{url('admin/'.request()->segment(2).'/delete/')}}/${delete_id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){
                        $('#ok_delete').text('Deleting...');
                        $('#ok_delete').attr("disabled",true);
                    },
                    success: function (data) {
                        DataTable.ajax.reload();
                        $('#ok_delete').text('Delete');
                        $('#ok_delete').attr("disabled",false);
                        $('#deleteModal').modal('hide');
                        //   js_success(data);
                        if(data==0) {
                            toastr.error('Exception Here ! Block');
                        }else{
                            toastr.success('Record Deleted Successfully');
                        }
                    }
                })
            });
        })
    </script>


@endsection
