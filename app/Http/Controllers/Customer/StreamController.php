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
    public function stream(Request $request, $course_id, $batch_id)
    {
        $course = Course::find($course_id);

        if($course->active_batch()->id != $batch_id) {
            return redirect()->back()->with('error', 'You are not part of the active batch.');
        }

        //fire user has joined event
        event(new UserJoined(Auth::user(), $course_id));

        return view('customer.stream.peer', compact('course'));
    }

    public function raiseHand(Request $request, $course_id)
    {
        return event(new ViewerRaisedHand(Auth::user(), $course_id));
    }
}
