<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CourseSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseSessionController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(CourseSession::with('course')
                    ->where('user_id', Auth::id())
                    ->whereHas('course')
                    ->orderBy('created_at', 'DESC')
                    ->get())
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="course-session-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('customer.course_session.list');
    }

    public function show(Request $request, $id)
    {
        $content= CourseSession::with('course.course_dates')->find($id);
        return view('customer.course_session.view',compact('content'));
    }
}
