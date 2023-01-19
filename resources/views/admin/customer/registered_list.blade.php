@extends('admin.layouts.app')
{{--@section('title', 'Customers')--}}
@section('title', 'Registered Students')
@section('page_css')
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
                        <h1>Customers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Category</li>
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
{{--                            <div class="card-header">--}}
{{--                                <a class="btn btn-primary pull-right addBtn" href="{{route('admin.add-course')}}">Add Customer</a>--}}
{{--                            </div>--}}
                            <div class="col-md-12">

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
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
                    url: `{{route('admin.registeredStudents')}}`,
                },
                columns: [


                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false}
                ],

                "order": [[ 4, "desc" ]]

            });
            var block_id;
            var delete_id;
            var action = '';
            var verb = '';
            var color = '';
            //on block/unblock click
            $(document,this).on('click','.block',function(){
                block_id = $(this).attr('id');

                //block button text compute
                var block_bool = $(this).data('block');
                action = block_bool == 0 ? 'Unblock' : 'Block';
                verb = block_bool == 0 ? 'Unblocking' : 'Blocking';
                color = block_bool == 0 ? 'limegreen' : 'red';
                $('#ok_block').text(action);
                $('#ok_block').css('background-color', color);
                $('#ok_block').css('border', color);

                $('#confirmModal').modal('show');
            });
            //on delete click
            $(document,this).on('click','.delete',function(){
                delete_id = $(this).attr('id');
                $('#deleteModal').modal('show');
            });
            //on block/unblock confirmation
            $(document).on('click','#ok_block',function(){
                $.ajax({
                    type:"post",
                    url:`{{url('admin/'.request()->segment(2).'/block/')}}/${block_id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){
                        $('#ok_block').text(verb + '...');
                        $('#ok_block').attr("disabled",true);
                    },
                    success: function (data) {
                        DataTable.ajax.reload();
                        $('#ok_block').text(action);
                        $('#ok_block').attr("disabled",false);
                        $('#confirmModal').modal('hide');
                     //   js_success(data);
                        if(data==0) {
                            toastr.error('Exception Here ! Block');
                        }else{
                            toastr.success('Record '+action+'ed Successfully');
                        }
                    }
                })
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
