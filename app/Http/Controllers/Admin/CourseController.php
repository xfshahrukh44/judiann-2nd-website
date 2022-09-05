<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class CourseController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Course::get())
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="course-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="course-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.course.list');
    }

    public function addCourse(Request $request)
    {
        if ($request->method() == 'POST') {
//            dd($request->all());
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'description' => 'required|string|max:500',
                'fees' => 'required',
            ));

            //date range work
            $date_range_from = Null;
            $date_range_to = Null;
            if(!empty($request->date_range)) {
                $dates = explode(' - ', $request->get('date_range'));
                $date_range_from = Carbon::parse($dates[0]);
                $date_range_to = Carbon::parse($dates[1]);
            }

            $course = Course::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'fees' => $request->input('fees'),
                'is_online' => key_exists('is_online', $request->all()) ? 1 : 0,
                'is_physical' => key_exists('is_physical', $request->all()) ? 1 : 0,
                'date_range' => $request->input('date_range'),
                'date_range_from' => $date_range_from,
                'date_range_to' => $date_range_to,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
            ]);

            //custom dates work
            if(!empty($request->custom_dates)) {
                foreach ($request->custom_dates as $key => $custom_date) {
                    CourseDate::create([
                        'course_id' => $course->id,
                        'date' => $custom_date,
                        'time_from' => $request->time_froms[$key],
                        'time_to' => $request->time_tos[$key]
                    ]);
                }
            }

            if ($course) {
                return redirect()->route('course')->with(['success' => 'Course Added Successfully']);
            }
        }

        return view('admin.course.add-course');
    }

    final public function show(int $id){
        $content= Course::find($id);
        return view('admin.course.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'description' => 'required|string|max:500',
                'fees' => 'required',
            ));

            $course = Course::find($id);

            //date range work
            $date_range_from = Null;
            $date_range_to = Null;
            if(!empty($request->date_range)) {
                $dates = explode(' - ', $request->get('date_range'));
                $date_range_from = Carbon::parse($dates[0]);
                $date_range_to = Carbon::parse($dates[1]);

                //delete old ones
                foreach ($course->course_dates as $course_date) {
                    $course_date->delete();
                }
            }

            //custom dates work
            if(!empty($request->custom_dates)) {
                //delete old ones
                foreach ($course->course_dates as $course_date) {
                    $course_date->delete();
                }
                foreach ($request->custom_dates as $key => $custom_date) {
                    CourseDate::create([
                        'course_id' => $course->id,
                        'date' => $custom_date,
                        'time_from' => $request->time_froms[$key],
                        'time_to' => $request->time_tos[$key]
                    ]);
                }
            }

            $course->name = $request->input('name');
            $course->description = $request->input('description');
            $course->fees = $request->input('fees');
            $course->is_online = key_exists('is_online', $request->all()) ? 1 : 0;
            $course->is_physical = key_exists('is_physical', $request->all()) ? 1 : 0;
            $course->date_range = $request->input('date_range');
            $course->date_range_from = $date_range_from;
            $course->date_range_to = $date_range_to;
            $course->time_from = $request->time_from;
            $course->time_to = $request->time_to;

            if ($course->save()) {
                return redirect()->route('course')->with(['success' => 'Course Edit Successfully']);
            }
        }else {
            $content=Course::findOrFail($id);
            return view('admin.course.add-course', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=Course::find($id);
        $content->delete();
        echo 1;
    }
}
