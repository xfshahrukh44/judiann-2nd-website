@extends('customer.layouts.app')
@section('title','Change Password')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('customer/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Change Password Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success text-center"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em></div>
                @endif
                <form action="{{route('customer.updateProfile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow ">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Profile Picture</label>
                                        <input type="file" name="profile_picture" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Customer Name"
                                               required value="{{$user->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Customer Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Customer Email"
                                               required value="{{$user->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Customer Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Customer Phone"
                                               required value="{{$user->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="Confirm Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-md btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
