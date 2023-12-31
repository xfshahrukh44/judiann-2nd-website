@extends('front.layouts.app')

@section('title', 'Payment')
@section('description', '')
@section('keywords', '')

@section('content')
    <section class="menuSec cartSec" style="margin-top: 10%;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cofeHeading text-center">
                        <h2 class="headOne text-white">Billing Info</h2>
                        <h4 class="headTwo">Amount: ${{session()->get('course_fees')}}</h4>
                    </div>
                    <div class="cofeList">
                        <div class="codeBox p-4">
                            <form id="paidTournamentForm" class="row" action="" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="card_no" id="voucher_code" class="form-control" placeholder="Enter voucher code">
                                        <button type="button" id="btn_apply_voucher" class="themeBtnSm">Apply Voucher</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Card Number</label>
                                        <input type="number" name="card_no" class="form-control" placeholder="123 456 7890 789 1234">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Expiry Month</label>
                                        <input type="number" name="exp_mon" class="form-control" placeholder="12">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Expiry Year</label>
                                        <input type="number" name="exp_year" class="form-control" placeholder="2023">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">CCV Code</label>
                                        <input type="password" name="cvv" class="form-control" placeholder="***">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="pay_paidTournamentForm" class="themeBtn">Pay Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="paymentSuccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Payment Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You Have Successfully registered the course. Click <a href="{{route('customer.dashboard')}}">here</a> to go to Customer Portal
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            //on payment click
            $('#paidTournamentForm').on('submit', function (e) {
                e.preventDefault();
                let themeButton = $(this).find('#pay_paidTournamentForm');
                let home_link = `<?php route('front.home') ?>`;

                themeButton.text('PAYING...')
                themeButton.attr('disabled', true)


                let errors = ''
                $.ajax({
                    type: 'post',
                    url: "{{route('front.process.payment')}}",
                    data: $('#paidTournamentForm').serialize(),
                    success: function (result) {
                        if (result?.status) {
                            themeButton.text('PAID!')
                            $('#paymentSuccessModal').modal('show');
                            // window.location.href = home_link;
                            // modal band karke main form submit karna hai
                            // $('#paymentModal').modal('toggle');
                            // $('#mainForm').submit();

                        } else {
                            //    alert payment failed error
                            themeButton.text('Pay Now')
                            themeButton.attr('disabled', false)
                            alert(result.message);
                        }
                    },
                    error: function (err) {
                    }
                });
            });

            //voucher_code
            //btn_apply_voucher
            $('#btn_apply_voucher').on('click', function () {
                let voucher_code = $('#voucher_code');

                if(!voucher_code.val()) {
                    voucher_code.focus();
                    return toastr.error('Please Enter Voucher Code First');
                }

                $.ajax({
                    type: 'post',
                    url: "{{route('front.applyVoucher')}}",
                    data: {
                        '_token': '{{csrf_token()}}',
                        'code': voucher_code.val()
                    },
                    success: function (response) {
                        console.log('response', response)
                        if(!response.success) {
                            voucher_code.val('');
                            voucher_code.focus();
                            return toastr.error(response.message);
                        }

                        toastr.success(response.message);
                        $('.headTwo').html('Amount: $' + response.new_total);
                    },
                    error: function (err) {
                    }
                });

                // $('#voucher_code')
            });
        });
    </script>
@endsection
