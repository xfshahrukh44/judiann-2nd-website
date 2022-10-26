<?php

namespace App\Http\Controllers\Admin;

use App\Events\AllowUserScreen;
use App\Events\RevertStream;
use App\Events\StopStreaming;
use App\Events\ViewerToggleBack;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function stream(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        $active_batch = Batch::find($course->active_batch()->id);
        $active_batch->is_streaming = true;
        $active_batch->save();

        return view('admin.stream.peer', compact('course'));
    }

    public function allowUserScreen(Request $request, $course_id, $customer_id) {
        return event(new AllowUserScreen($course_id, $customer_id));
    }

    public function revertStream(Request $request, $course_id, $customer_id) {
        return event(new RevertStream($course_id, $customer_id));
    }

    public function viewerToggleBack(Request $request, $course_id, $customer_id) {
        return event(new ViewerToggleBack($course_id, $customer_id));
    }

    public function stop(Request $request, Course $course) {
        $active_batch = Batch::find($course->active_batch()->id);
        $active_batch->is_streaming = false;
        $active_batch->save();
        event(new StopStreaming($course->id));
        return view('blank');
    }
}
