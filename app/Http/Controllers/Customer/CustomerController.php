<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\BatchSession;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $batch_sessions = BatchSession::with('batch.course')->where('user_id', Auth::id())->get();

        $events = [];
        $colors = [
            'black',
            'red',
            'purple',
            'purple',
            'fuchsia',
            'green',
            'lime',
            'yellow',
            'teal',
            'aqua',
            'blueviolet',
            'coral',
            'cornflowerblue',
            'cyan',
            'crimson',
            'darkorange',
            'gold',
            'goldenrod',
            'greenyellow',
            'indianred',
            'mediumvioletred',
            'orangered',
        ];

        foreach ($batch_sessions as $batch_session) {
            $random_index = array_rand($colors);
            $batch = $batch_session->batch;

            if(is_null($batch->date_range)) {
                foreach ($batch->batch_dates as $batch_date) {
                    $events[] = [
                        'title' => $batch->course->name . ' ('.$batch->name.')',
                        'date' => $batch_date->date,
                        'time' => $batch_date->time_from . ' to ' . $batch_date->time_to,
                        'color' => $colors[$random_index],
                        'description' => $batch->course->description,
                        'img_src' => $batch->course->get_course_image(),
                        'batch_id' => $batch->id,
                        'class_type' => 'online',
                        'physical_class_type' => $batch->physical_class_type,
                        'batch_is_full' => batch_is_full($batch),
                        'already_bought' => is_in_batch($batch->id),
                        'fees' => $batch->course->fees ?? 0.0
                    ];
                }
            } else {
                $current_date = Carbon::parse($batch->date_range_from);
                while ($current_date <= Carbon::parse($batch->date_range_to)) {
                    $events[] = [
                        'title' => $batch->course->name . ' ('.$batch->name.')',
                        'date' => $current_date,
                        'time' => $batch->time_from . ' to ' . $batch->time_to,
                        'color' => $colors[$random_index],
                        'description' => $batch->course->description,
                        'img_src' => $batch->course->get_course_image(),
                        'batch_id' => $batch->id,
                        'class_type' => 'online',
                        'physical_class_type' => $batch->physical_class_type,
                        'batch_is_full' => batch_is_full($batch),
                        'already_bought' => is_in_batch($batch->id),
                        'fees' => $batch->course->fees ?? 0.0
                    ];
                    $current_date = Carbon::parse($current_date)->addDay();
                }
            }

            unset($colors[$random_index]);
        }

        return view('customer.dashboard', compact('events'));
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
            return redirect('/customer/profile')->with('success', 'Profile Updated Successfully.');
        }

        return redirect('/customer/dashboard')->with('error', 'Could`nt update profile');

    }

}
