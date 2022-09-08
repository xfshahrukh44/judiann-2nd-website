<?php

namespace App\Http\Controllers\Customer;

use App\Events\UserJoined;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
{
    public function stream(Request $request, $course_id)
    {
        event(new UserJoined(Auth::user(), $course_id));
        return view('customer.stream.index');
    }
}
