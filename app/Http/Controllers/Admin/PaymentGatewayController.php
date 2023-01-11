<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\ShippingRate;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function index(Request $request)
    {

        try {
            if ($request->method() == 'POST') {
                $content = Settings::find(1);

                // stripe
                $content->stripe_env = $request->stripe_env;
                $content->stripe_publishable_key = $request->stripe_publishable_key;
                $content->stripe_secret_key = $request->stripe_secret_key;
                $content->stripe_testing_publishable_key = $request->stripe_testing_publishable_key;
                $content->stripe_testing_secret_key = $request->stripe_testing_secret_key;
                $content->stripe_check = $request->stripe_check;

                if ($content->save()) {
                    return redirect('/admin/paymentgatway')->with('success', 'paymentGateway Update Successfully');
                }
            } else {
                $content = Settings::findOrfail(1);
                return view('admin.paymentGateway.edit', compact('content'));
            }
        } catch (\Exception $ex) {
            return redirect('admin/dashboard')->with('error', $ex->getMessage());
        }
    }
}
