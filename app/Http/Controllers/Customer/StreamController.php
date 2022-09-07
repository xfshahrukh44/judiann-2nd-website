<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function stream(Request $request, $course_id)
    {
        return view('customer.stream.index');
    }
}
