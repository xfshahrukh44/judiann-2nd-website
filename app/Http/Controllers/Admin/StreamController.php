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
    public function stream(Request $request, $batch_id)
    {
        $batch = Batch::find($batch_id);
        $batch->is_streaming = true;
        $batch->save();

        return view('admin.stream.peer', compact('batch'));
    }

    public function allowUserScreen(Request $request, $batch_id, $customer_id) {
        return event(new AllowUserScreen($batch_id, $customer_id));
    }

    public function revertStream(Request $request, $batch_id, $customer_id) {
        return event(new RevertStream($batch_id, $customer_id));
    }

    public function viewerToggleBack(Request $request, $batch_id, $customer_id) {
        return event(new ViewerToggleBack($batch_id, $customer_id));
    }

    public function stop(Request $request, Batch $batch) {
        $batch->is_streaming = false;
        $batch->save();
        event(new StopStreaming($batch->id));
        return view('blank');
    }
}
