<?php

use App\Models\Course;
use Carbon\Carbon;

function course_is_joinable($course_id) {
    $course = Course::find($course_id);
    $now = Carbon::now();

//    if(!is_null($course->date_range)) {
//
//    } else {
//
//    }
}

function get_readable_description($string) {
    $string_bits = (explode("\n", $string));
    $return_string = '';
    foreach($string_bits as $string_bit) {
        $return_string .= '<p class="text-center">'.$string_bit.'</p>';
    }
    return $return_string;
}
