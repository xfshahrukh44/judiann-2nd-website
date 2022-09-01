@extends('front.layouts.app')

@section('title', 'Payment')
@section('description', '')
@section('keywords', '')

@section('content')
    <section class="menuSec cartSec" style="margin-top: 10%;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="cofeHeading">
                        <h2>Billing Info</h2>
                    </div>
                    <div class="cofeList">
                        <div class="codeBox p-4">
                            <form id="paidTournamentForm" class="w-100" action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Card Number</label>
                                    <input type="number" name="card_no" class="form-control" placeholder="123 456 7890 789 1234">
                                </div>
                                <div class="form-group">
                                    <label for="">Expiry Month</label>
                                    <input type="number" name="exp_mon" class="form-control" placeholder="12">
                                </div>
                                <div class="form-group">
                                    <label for="">Expiry Year</label>
                                    <input type="number" name="exp_year" class="form-control" placeholder="2023">
                                </div>
                                <div class="form-group">
                                    <label for="">CCV Code</label>
                                    <input type="password" name="cvv" class="form-control" placeholder="***">
                                </div>
                                <button type="submit" id="pay_paidTournamentForm" class="themeBtn">Pay Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    url: "{{route('front.process_payment')}}",
                    data: $('#paidTournamentForm').serialize(),
                    success: function (result) {
                        if (result?.status) {
                            themeButton.text('PAID!')
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
        });
    </script>
@endsection
