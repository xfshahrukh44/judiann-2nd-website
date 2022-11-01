<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
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

}
