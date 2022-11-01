<?php

namespace App\Http\Controllers\Customer;

use App\Events\UserJoined;
use App\Events\ViewerRaisedHand;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
{
    public function stream(Request $request, $batch_id)
    {
        $batch = Batch::find($batch_id);

        //fire user has joined event
        event(new UserJoined(Auth::user(), $batch_id));

        return view('customer.stream.peer', compact('batch'));
    }

    public function raiseHand(Request $request, $batch_id)
    {
        return event(new ViewerRaisedHand(Auth::user(), $batch_id));
    }
}
