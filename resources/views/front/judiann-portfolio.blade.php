@extends('front.layouts.app')

@section('title', !empty($portfolio) ? (!empty($data->meta_title) ? $data->meta_title : 'Judiann’s Portfolio') : 'Judiann’s Portfolio')
@section('description', !empty($portfolio) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->


    <div class="main-slider">
        <img class="img-fluid w-100"
             src="{{!empty($portfolio) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg')}}"
             alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">{{!empty($portfolio) ? (!empty($data->banner_title) ? $data->banner_title : 'Judiann’s Portfolio') : 'Judiann’s Portfolio'}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->

    <section class="portfolioSec inner">
        <div class="container-fluid">
            <h2 class="headOne">{{!empty($portfolio) ? (!empty($data->section_title) ? $data->section_title : 'Judiann’s Portfolio') : 'Judiann’s Portfolio'}}</h2>
            <div class="row">
                @foreach($sort_portfolio as $port)
                    <div class="col-md-3">
                        <div class="portfolioBox">
                            <a data-fancybox href="{{$port->get_portfolio_image()}}">
                                <img class="img-fluid" src="{{$port->get_portfolio_image()}}" alt="img">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
