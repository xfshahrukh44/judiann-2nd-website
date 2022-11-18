<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        return view('customer.auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $content = User::find($id);

        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required',
        ]);

        if ($request->input('password')) {

            $this->validate($request, [
                'current_password' => 'required',
                'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            ]);

            if (Hash::check($request->current_password, Auth::User()->password)) {
                $content->password = Hash::make($request->password);
            } else {
                return back()->withErrors(['Sorry, your current Password not recognized. Please try again.']);
            }
        }

        $content->name = $request->name;
        $content->email = $request->email;
        $content->phone = $request->phone;

        if ($content->save()) {
            return redirect('/customer/dashboard')->with('success', 'Profile Updated Successfully.');
        }

        return redirect('/customer/dashboard')->with('error', 'Could`nt update profile');

    }

}
