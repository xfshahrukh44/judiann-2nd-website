<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchDate;
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
                    ->addColumn('image', function($data) {
                        return $data->get_course_image();
                    })
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
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
            $this->validate($request, array(
                'name' => 'required|string',
                'description' => 'nullable|string',
                'fees' => 'required'
            ));

            //create course
            $course = Course::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'fees' => $request->input('fees'),
            ]);

            //course image
            if($request->has('image')) {
                $course->addMediaFromRequest('image')->toMediaCollection('course_images');
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
                'name' => 'required|string',
                'description' => 'required|string',
                'fees' => 'required',
            ));

            $course = Course::find($id);

            //course image
            if($request->has('image')) {
                $course->clearMediaCollection('course_images');
                $course->addMediaFromRequest('image')->toMediaCollection('course_images');
            }

            $course->name = $request->input('name');
            $course->description = $request->input('description');
            $course->fees = $request->input('fees');

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
