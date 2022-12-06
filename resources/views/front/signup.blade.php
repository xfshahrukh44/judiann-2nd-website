@extends('front.layouts.app')

@section('title', !empty($home) ? (!empty($data->meta_title) ? $data->meta_title : 'Home') : 'Home')
@section('description', !empty($home) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('content')
    <section class="signupSec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="headOne text-white text-center mb-5">Sign Up</h2>
                    <form class="container-fluid" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 text-center d-flex align-items-center justify-content-between w-100">
                                <button class="themeBtn py-2">Sign Up</button>
                                <a href="javascript:;" type="button" data-toggle="modal" data-target="#loginModal" class="text-white">already a member? signin</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
