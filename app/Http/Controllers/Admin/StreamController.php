<?php

namespace App\Http\Controllers\Admin;

use App\Events\AllowUserScreen;
use App\Events\RevertStream;
use App\Events\ViewerToggleBack;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function stream(Request $request, $course_id)
    {
        $course = Course::find($course_id);

        //update session id of course (fresh)
        if(is_null($course->opentok_session_id)) {
            $course->opentok_session_id = get_fresh_opentok_session_id();
            $course->save();
        }

        //get token
        $token = get_fresh_opentok_token($course->opentok_session_id);
        $t2 = get_fresh_publisher_opentok_token($course->opentok_session_id);

        return view('admin.stream.peer', compact('course', 'token'));
    }

    public function allowUserScreen(Request $request, $course_id, $customer_id) {
        return event(new AllowUserScreen($course_id, $customer_id));
//        return event(new ViewerToggleBack($course_id, $customer_id));
    }

    public function revertStream(Request $request, $course_id, $customer_id) {
        return event(new RevertStream($course_id, $customer_id));
//        return event(new ViewerToggleBack($course_id, $customer_id));
    }

    public function viewerToggleBack(Request $request, $course_id, $customer_id) {
        return event(new ViewerToggleBack($course_id, $customer_id));
    }
}
