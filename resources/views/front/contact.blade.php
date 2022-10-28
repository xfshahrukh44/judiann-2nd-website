@extends('front.layouts.app')

@section('title', !empty($contact) ? (!empty($data->meta_title) ? $data->meta_title : 'Contact') : 'Contact')
@section('description', !empty($contact) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('content')
    <!-- Begin: Main Slider -->


    <div class="main-slider">
        <img class="img-fluid w-100"
             src="{{!empty($contact) ? (!empty($data->banner_image) ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg')) : asset('front/images/BannerImg.jpg')}}"
             alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">{{!empty($contact) ? (!empty($data->banner_title) ? $data->banner_title : 'Contact Us') : 'Contact Us'}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Main Slider -->


    <section class="contactInnr">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <ul class="contactList">
                        <li><a href="tel:{{$setting->phone_no_1}}">{{$setting->phone_no_1}}</a></li>
                        <li>
                            <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                        </li>
                        <li><a href="#">{{$setting->address}}</a></li>
                    </ul>
                </div>

                <div class="col-md-9">
                    <h2 class="headOne text-center mb-5">{{!empty($contact) ? (!empty($data->form_title) ? $data->form_title : 'Contact form') : 'Contact form'}}</h2>

                    <form action="{{route('front.send_front_mail')}}" method="POST" class="hf-form hf-form-59 "
                          data-id="59" data-title="Contact Form"
                          data-slug="contact-form" data-message-success="Thank you! We will be in touch soon."
                          data-message-invalid-email="Sorry, that email address looks invalid."
                          data-message-required-field-missing="Please fill in the required fields."
                          data-message-error="Oops. An error occurred.">
                        @csrf
                        <input type="hidden" name="_hf_form_id"
                               value="59"/>
                        <div style="display: none;"><input type="text" name="_hf_h59" value=""/></div>
                        <div class="hf-fields-wrap">
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Type your message *"
                                                      name="msg"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit">Send Now</button>
                                    </div>
                                </div>
                            </div>
                            <noscript>Please enable JavaScript for this form to work.</noscript>
                        </div>
                    </form><!-- / HTML Forms -->                <!--<form action="">-->
                    <!--    <div class="row">-->
                    <!--        <div class="col-md-12">-->
                    <!--            <div class="form-group">-->
                    <!--                <input type="text" class="form-control" placeholder="Name" name="name">-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-md-12">-->
                    <!--            <div class="form-group">-->
                    <!--                <input type="email" class="form-control" placeholder="Email" name="email">-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-md-12">-->
                    <!--            <div class="form-group">-->
                    <!--                <input type="text" class="form-control" placeholder="phone" name="phone">-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-md-12">-->
                    <!--            <div class="form-group">-->
                    <!--                <textarea class="form-control" placeholder="Type your message *" name="msg"></textarea>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-md-12">-->
                    <!--            <button type="submit">Send Now</button>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</form>-->
                </div>
            </div>
        </div>
    </section>
@endsection
