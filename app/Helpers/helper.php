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
