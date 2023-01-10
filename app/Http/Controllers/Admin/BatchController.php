<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchDate;
use App\Models\Course;
use App\Traits\PHPCustomMail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    use PHPCustomMail;

    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Batch::get())
                    ->addIndexColumn()
                    ->addColumn('course', function ($data) {
                        return $data->course->name ?? '';
                    })
                    ->addColumn('is_online', function ($data) {
                        return $data->is_online ? 'yes' : 'no';
                    })
                    ->addColumn('is_physical', function ($data) {
                        return $data->is_physical ? 'yes' : 'no';
                    })
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="batch-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="batch-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.batch.list');
    }

    public function addBatch(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required',
                'course_id' => 'required',
                'number_of_seats' => 'sometimes',
            ));

            //date range work
            $date_range_from = Null;
            $date_range_to = Null;
            if(!empty($request->date_range)) {
                $dates = explode(' - ', $request->get('date_range'));
                $date_range_from = Carbon::parse($dates[0]);
                $date_range_to = Carbon::parse($dates[1]);
            }

            //create batch
            $batch = Batch::create([
                'course_id' => $request->input('course_id'),
                'name' => $request->input('name'),
                'is_online' => key_exists('is_online', $request->all()) ? 1 : 0,
                'is_physical' => key_exists('is_physical', $request->all()) ? 1 : 0,
                'physical_class_type' => $request->input('physical_class_type'),
                'number_of_seats' => $request->input('number_of_seats'),
                'date_range' => $request->input('date_range'),
                'date_range_from' => $date_range_from,
                'date_range_to' => $date_range_to,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
            ]);

            //custom dates work
            if(!empty($request->custom_dates)) {
                foreach ($request->custom_dates as $key => $custom_date) {
                    BatchDate::create([
                        'batch_id' => $batch->id,
                        'date' => $custom_date,
                        'time_from' => $request->time_froms[$key],
                        'time_to' => $request->time_tos[$key]
                    ]);
                }
            }

            if ($batch) {
                return redirect()->route('batch')->with(['success' => 'Batch Added Successfully']);
            }
        }

        $courses = Course::all();
        return view('admin.batch.add-batch', compact('courses'));
    }

    final public function show(int $id){
        $content= Batch::find($id);
        return view('admin.batch.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required',
                'course_id' => 'required',
                'number_of_seats' => 'sometimes',
            ));

            $batch = Batch::find($id);

            //date range work
            $date_range_from = Null;
            $date_range_to = Null;
            if(!empty($request->date_range)) {
                $dates = explode(' - ', $request->get('date_range'));
                $date_range_from = Carbon::parse($dates[0]);
                $date_range_to = Carbon::parse($dates[1]);

                //delete old ones
                foreach ($batch->batch_dates as $batch_date) {
                    $batch_date->delete();
                }
            }

            //custom dates work
            if(!empty($request->custom_dates)) {
                //delete old ones
                foreach ($batch->batch_dates as $batch_date) {
                    $batch_date->delete();
                }
                foreach ($request->custom_dates as $key => $custom_date) {
                    BatchDate::create([
                        'batch_id' => $batch->id,
                        'date' => $custom_date,
                        'time_from' => $request->time_froms[$key],
                        'time_to' => $request->time_tos[$key]
                    ]);
                }
            }

            $batch->name = $request->input('name');
            $batch->is_online = key_exists('is_online', $request->all()) ? 1 : 0;
            $batch->is_physical = key_exists('is_physical', $request->all()) ? 1 : 0;
            $batch->physical_class_type = $request->input('physical_class_type');
            $batch->number_of_seats = $request->input('number_of_seats');
            $batch->date_range = $request->input('date_range');
            $batch->date_range_from = $date_range_from;
            $batch->date_range_to = $date_range_to;
            $batch->time_from = $request->time_from;
            $batch->time_to = $request->time_to;

            if ($batch->save()) {
                return redirect()->route('batch')->with(['success' => 'Batch Edit Successfully']);
            }
        }else {
            $content=Batch::findOrFail($id);
            $courses = Course::all();

            return view('admin.batch.add-batch', compact('content', 'courses'));
        }
    }

    final public function destroy(int $id)
    {
        $content=Batch::find($id);
        $content->delete();
        echo 1;
    }

    public function notifyStudents (Request $request)
    {
        $batch = Batch::find($request->batch_id);

        foreach ($batch->batch_sessions as $batch_session) {
            $email = $batch_session->user->email ?? null;

            if ($email) {
                $batch_title = get_batch_title($batch);
                $this->customMail('info@judiannsfashiondesignstudios.com', $email, 'Class Notification | '.$batch_title, $request->content);
            }
        }

        return redirect()->back()->with('success', 'Students have been notified');
    }
}
