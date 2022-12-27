<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\BatchSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BatchSessionController extends Controller
{
    public function index(Request $request)
    {
//        dd(datatables()->of(BatchSession::with('batch.course')
//            ->where('user_id', Auth::id())
//            ->whereHas('batch')
//            ->orderBy('created_at', 'DESC')
//            ->get())
//            ->addIndexColumn()
//            ->addColumn('action', function ($data) {
//                return '<a title="View" href="batch-session-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>'
//                    . ($data->class_type == 'online' && $data->batch->is_streaming ? '<a title="View" href="'.route('customer.stream', [$data->batch_id]).'" class="btn btn-success btn-sm">Join</a>' : '');
//            })->make(true));
        try {
            if (request()->ajax()) {
                return datatables()->of(BatchSession::with('batch.course')
                    ->where('user_id', Auth::id())
                    ->whereHas('batch')
                    ->orderBy('created_at', 'DESC')
                    ->get())
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="batch-session-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>'
                            . ($data->class_type == 'online' && $data->batch->is_streaming ? '<a title="View" href="'.route('customer.stream', [$data->batch_id]).'" class="btn btn-success btn-sm">Join</a>' : '');
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('customer.batch_session.list');
    }

    public function show(Request $request, $id)
    {
        $content= BatchSession::with('batch.course', 'batch.batch_dates')->find($id);

        return view('customer.batch_session.view',compact('content'));
    }
}
