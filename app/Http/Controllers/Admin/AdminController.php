<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $courses = Course::all();

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
        foreach ($courses as $course) {
            $random_index = array_rand($colors);

            if(is_null($course->active_batch()->date_range)) {
                foreach ($course->active_batch()->batch_dates as $batch_date) {
                    $events[] = [
                        'title' => $course->name,
                        'date' => $batch_date->date,
                        'time' => $batch_date->time_from . ' to ' . $batch_date->time_to,
                        'color' => $colors[$random_index],
                    ];
                }
            } else {
                $current_date = Carbon::parse($course->active_batch()->date_range_from);
                while ($current_date <= Carbon::parse($course->active_batch()->date_range_to)) {
                    $events[] = [
                        'title' => $course->name,
                        'date' => $current_date,
                        'time' => $course->active_batch()->time_from . ' to ' . $course->active_batch()->time_to,
                        'color' => $colors[$random_index],
                    ];
                    $current_date = Carbon::parse($current_date)->addDay();
                }
            }

            unset($colors[$random_index]);
        }
        return view('admin.dashboard', compact('events'));
    }

}
