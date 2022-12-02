@extends('front.layouts.app')

@section('title', !empty($home) ? (!empty($data->meta_title) ? $data->meta_title : 'Home') : 'Home')
@section('description', !empty($home) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('content')
    <section class="signupSec">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="headOne text-white text-center mb-5">Forget Password</h2>
                    <form class="container-fluid" action="">
                        <div class="row flex-column justify-content-center align-items-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 text-center d-inline-flex flex-column">
                                <button class="themeBtn py-2 ">Confirm</button>
                                <a href="{{route('front.signup')}}" class="text-white mt-3">Not a member? Signup</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
