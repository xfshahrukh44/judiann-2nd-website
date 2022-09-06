<?php

use App\Models\Course;
use Carbon\Carbon;

function course_is_joinable($course_id) {
    $course = Course::find($course_id);
    $now = Carbon::now();

    if(!is_null($course->date_range)) {
        return ($now->toDateString() >= $course->date_range_from && $now->toDateString() <= $course->date_range_to && $now->toTimeString() >= $course->time_from && $now->toTimeString() <= $course->time_to);
    } else if(count($course->course_dates) > 0) {
        foreach ($course->course_dates as $course_date) {
            if($now->toDateString() == $course_date->date && $now->toTimeString() >= $course_date->time_from && $now->toTimeString() <= $course_date->time_to) {
                return true;
            }
        }

        return false;
    }

    return false;
}

function get_readable_description($string) {
    $string_bits = (explode("\n", $string));
    $return_string = '';
    foreach($string_bits as $string_bit) {
        $return_string .= '<p class="text-center">'.$string_bit.'</p>';
    }
    return $return_string;
}
