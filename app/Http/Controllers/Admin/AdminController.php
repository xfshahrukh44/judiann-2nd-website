<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $batches = Batch::all();

        $events = [];
        $colors = [
            'black',
            'red',
            'purple',
            'purple',
            'fuchsia',
            'green',
            'lime',
            'yellow',
            'teal',
            'aqua',
            'blueviolet',
            'coral',
            'cornflowerblue',
            'cyan',
            'crimson',
            'darkorange',
            'gold',
            'goldenrod',
            'greenyellow',
            'indianred',
            'mediumvioletred',
            'orangered',
        ];
        foreach ($batches as $batch) {
            $random_index = array_rand($colors);

            if(is_null($batch->date_range)) {
                foreach ($batch->batch_dates as $batch_date) {
                    $events[] = [
                        'title' => $batch->course->name . ' ('.$batch->name.')',
                        'date' => $batch_date->date,
                        'time' => $batch_date->time_from . ' to ' . $batch_date->time_to,
                        'color' => $colors[$random_index],
                    ];
                }
            } else {
                $current_date = Carbon::parse($batch->date_range_from);
                while ($current_date <= Carbon::parse($batch->date_range_to)) {
                    $events[] = [
                        'title' => $batch->course->name . ' ('.$batch->name.')',
                        'date' => $current_date,
                        'time' => $batch->time_from . ' to ' . $batch->time_to,
                        'color' => $colors[$random_index],
                    ];
                    $current_date = Carbon::parse($current_date)->addDay();
                }
            }

            unset($colors[$random_index]);
        }
        return view('admin.dashboard', compact('events'));
    }

    public function enrolledStudents()
    {
        try {
            $enrolled_students = User::where('role_id', 2)->whereHas('batch_sessions')->get();
            if (request()->ajax()) {
                return datatables()->of($enrolled_students)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return
                            $data->is_blocked == 1 ?
                                '<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a><button type="button" id="' . $data->id . '" title="Unblock" href="customer-block/' . $data->id . '" class="btn btn-success btn-sm block" data-block="0"><i class="fas fa-stop"></i></button>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'
                                : '<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a><button type="button" id="' . $data->id . '" title="Block" href="customer-block/' . $data->id . '" class="btn btn-danger btn-sm block" data-block="1"><i class="fas fa-stop"></i></button>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.customer.enrolled_list');
    }

    public function registeredStudents()
    {
        try {
            $enrolled_students = User::where('role_id', 2)->withCount('batch_sessions')->get();
            $enrolled_students = $enrolled_students->where('batch_sessions_count', 0)->all();
            if (request()->ajax()) {
                return datatables()->of($enrolled_students)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return
                            $data->is_blocked == 1 ?
                                '<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a><button type="button" id="' . $data->id . '" title="Unblock" href="customer-block/' . $data->id . '" class="btn btn-success btn-sm block" data-block="0"><i class="fas fa-stop"></i></button>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'
                                : '<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a><button type="button" id="' . $data->id . '" title="Block" href="customer-block/' . $data->id . '" class="btn btn-danger btn-sm block" data-block="1"><i class="fas fa-stop"></i></button>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.customer.registered_list');
    }
}
