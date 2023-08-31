@extends('front.layouts.app')

@section('title', !empty($schedule) ? (!empty($data->meta_title) ? $data->meta_title : 'Cart') : 'Cart')
@section('description', !empty($schedule) ? (!empty($data->meta_description) ? $data->meta_description : '') : '')
@section('keywords', '')

@section('css')
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">


    <style>
        body {
            background-color: #0d0c05;
        }

        .cart-page {
            margin: 4rem 0;
        }

        .cart-page .table tr {
            border: none;
            border-bottom: 1px solid #566153;
        }

        .cart-page .table td {
            border: none;
            vertical-align: middle;
        }

        .cart-page .table thead tr th {
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 28px;
            text-transform: uppercase;
            border: none;
            color: #fff;
        }

        .cart-page .table .cart-product-thumbnail {
            display: flex;
            align-items: center;
        }

        .cart-page .table .cart-product-thumbnail figure {
            width: 120px;
            height: 120px;
            overflow: hidden;
            margin-right: 20px;
            margin-bottom: 0px;
            background-color: #f5f5f5;
            border-radius: 12px;
            padding: 0.5rem;
        }

        .cart-page .table .cart-product-thumbnail figure img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .cart-page .table .cart-product-thumbnail h4 {
            font-size: 1rem;
            font-weight: 600;
            line-height: 26px;
            margin: 0;
            margin-bottom: 5px;
            color: #fff;
        }

        .cart-page .table .cart-product-thumbnail ul li {
            padding: 0;
            font-size: 15px;
            color: #fda504;
        }

        .cart-page .table tbody td {
            padding: 15px 10px;
            color: #fff;
        }

        .cart-page .table tbody h3 {
            font-size: 1rem;
            font-weight: 600;
            line-height: 26px;
            margin: 0;
            color: #fff;
        }

        .cart-delete a {
            font-size: 1rem !important;
            color: white !important;
            transition: all 500ms ease-in-out !important;
        }

        .cart-delete a:hover {
            color: var(--color-primary) !important;
            transform: rotate(360deg) !important;
        }

        .cart-btns {
            padding: 30px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4rem;
        }

        .discount-wrapper .form-group {
            display: flex;
            align-items: center;
            margin: 0;
        }

        .discount-wrapper .form-group label,
        .cart-total h3 {
            font-size: 18px;
            font-weight: 600;
            color: #222;
            line-height: 28px;
            text-transform: uppercase;
            margin: 0;
            margin-right: 20px;
        }

        .discount-wrapper .form-group input {
            border: 1px solid #d7d7d7;
            font-size: 1rem;
            color: #222;
            padding: 12px 20px;
            width: 50%;
            margin-right: 20px;
            height: unset;
        }

        .discount-wrapper h3 {
            margin-bottom: 20px;
            line-height: 28px;
            text-transform: uppercase;
        }

        .cart-total {
            padding: 4rem 2rem 2rem;
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #ebebeb;
        }

        .cart-total h3 {
            margin-bottom: 20px;
            text-transform: uppercase;
            color: rgb(235, 88, 40) !important;
        }

        .cart-total p {
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: 500;
            color: #444444;
            line-height: 26px;
        }

        .cart-total p span {
            float: right;
            font-weight: 600;
        }

        .num-block {
            width: 100%;
            padding: 0;
        }

        .skin-1 .num-in {
            width: 130px;
            background: #f5f5f5;
            padding: 5px;
            overflow: hidden;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .productDetails-num {
            border-radius: 12px;
            width: 223px !important;
            height: 40px;
        }

        .skin-1 .num-in span {
            display: block;
            width: 30px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            position: relative;
            cursor: pointer;
        }

        .skin-1 .num-in input {
            width: 32px;
            height: 32px;
            text-align: center;
            padding: 0;
            border: none;
            outline: none;
            background: transparent;
            font-size: 18px;
            font-weight: 600;
        }

        .skin-1 .num-in span.minus:before {
            content: "";
            position: absolute;
            width: 10px;
            height: 2px;
            background-color: #000;
            top: 50%;
            left: 10px;
        }

        .skin-1 .num-in span.plus:before,
        .skin-1 .num-in span.plus:after {
            content: "";
            position: absolute;
            right: 10px;
            width: 10px;
            height: 2px;
            background-color: #000;
            top: 50%;
        }

        .skin-1 .num-in span.plus:after {
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        .inputField {
            margin: 0.5rem;
        }

        .inputField input {
            width: 100%;
            padding: 0.75rem 1.25rem;
            border: 2px solid #fff;
            border-radius: 0.5rem;
            outline: none;
        }
        .inputField input:focus{
            border-color: #fda504;
        }
    </style>

    <!-- Begin: Main Slider -->
    <div class="main-slider inner">
        <img class="img-fluid w-100"
             src="{{ !empty($schedule) ? (!empty($data->banner_image)
                    ? asset('front/images/cms/'.$data->banner_image) : asset('front/images/BannerImg.jpg'))
                    : asset('front/images/BannerImg.jpg') }}"
             alt="First slide">
        <div class="carousel-caption">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="slideContent">
                            <h2 class="headOne">Cart</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Main Slider -->

    <!-- cart -->
    <section class="cart-page">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($cart_items as $cart_item)
                                    <tr>
                                        <td class="cart-product-thumbnail">
                                            <a href="javascript:void(0)">
                                                <figure>
                                                    <img src="{{$cart_item['image']}}" class="img-responsive"
                                                         alt="cart-1" />
                                                </figure>
                                            </a>
                                            <div class="cart-product-content">
                                                <a href="javascript:void(0)">
                                                    <h4>{{$cart_item['name']}}</h4>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <h3 class="color-green">{{$cart_item['fees']}}</h3>
                                        </td>
                                        <td>
                                            <div class="cart-delete">
                                                <a href="{{route('front.removeFromCart', $cart_item['rowId'])}}" class="color-green btn_remove_course">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="3">No items in cart.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="contact">
                        <form id="form_proceed_to_checkout" action="{{route('front.schedule.class')}}" class="contact__form">
                            @csrf
                            <div class="row no-gutters">
                                @foreach($cart_items as $cart_item)
                                    <input type="hidden" name="user_id" value="{{$cart_item['user_id']}}">
                                    <input type="hidden" name="batch_id[]" value="{{$cart_item['batch_id']}}">
                                    <input type="hidden" name="class_type[]" value="{{$cart_item['class_type']}}">
                                    <input type="hidden" name="physical_class_type[]" value="{{$cart_item['physical_class_type']}}">
                                    <input type="hidden" name="fees[]" class="input_fees" value="{{$cart_item['fees']}}">
                                @endforeach
                                <div class="col-12 col-lg-6">
                                    <div class="inputField">
                                        <input type="text" placeholder="First Name" value="{{Illuminate\Support\Facades\Auth::check() ? (explode(' ', Auth::user()->name)[0] ?? '') : ''}}" name="first_name"/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="inputField">
                                        <input type="text" placeholder="Last Name" value="{{Illuminate\Support\Facades\Auth::check() ? (explode(' ', Auth::user()->name)[1] ?? '') : ''}}" name="last_name"/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="inputField">
                                        <input type="email" placeholder="Email Address" value="{{Illuminate\Support\Facades\Auth::check() ? (Auth::user()->email ?? '') : ''}}" name="email"/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="inputField">
                                        <input type="text" readonly value="{{Illuminate\Support\Facades\Auth::check() ? (Auth::user()->phone ?? '') : ''}}" placeholder="Phone Number" name="phone"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-total">
                        <h3>Cart total</h3>
                        <p class="mc-b-2">
                            Total <span class="color-green">{{$total ?? 0.00}} $</span>
                        </p>

                        @if($total == 0)
                            <a href="javascript:void(0)" class="themeBtn px-0 w-100 text-center">
                                Proceed to checkout
                            </a>
                        @else
                            <a id="btn_proceed_to_checkout" href="javascript:void(0)" class="themeBtn px-0 w-100 text-center">
                                Proceed to checkout
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#btn_proceed_to_checkout').on('click', function () {
                $('#form_proceed_to_checkout').submit();
            });
            // function calculate_total() {
            //     let total = 0.00;
            //     $('.input_fees').each(function () {
            //         total += parseFloat($(this).val()) ?? 0.00;
            //     });
            //
            //     $('#td_total_price').html(`<b>$` + total + `</b>`);
            //
            //     $('#btn_submit').prop('hidden', (total == 0.00));
            // }
        });
    </script>
@endsection
