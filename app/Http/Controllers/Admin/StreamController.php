<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function stream(Request $request, $course_id)
    {
        return view('admin.stream.index');
    }
}
