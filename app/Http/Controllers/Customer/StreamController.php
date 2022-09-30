<?php

namespace App\Http\Controllers\Customer;

use App\Events\UserJoined;
use App\Events\ViewerRaisedHand;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
{
    public function stream(Request $request, $course_id)
    {
        $course = Course::find($course_id);

        //fire user has joined event
        event(new UserJoined(Auth::user(), $course_id));

        //get token
//        $token = get_fresh_opentok_token($course->opentok_session_id);

        return view('customer.stream.peer', compact('course'));
    }

    public function raiseHand(Request $request, $course_id)
    {
        return event(new ViewerRaisedHand(Auth::user(), $course_id));
    }
}
