<?php

use App\Models\BatchSession;
use App\Models\Course;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use OpenTok\OpenTok;
use OpenTok\Session;

function course_is_joinable($course_id) {
    $course = Course::find($course_id);
    $now = Carbon::now();

    if(!is_null($course->active_batch()->date_range)) {
        return ($now->toDateString() >= $course->active_batch()->date_range_from && $now->toDateString() <= $course->active_batch()->date_range_to && $now->toTimeString() >= $course->active_batch()->time_from && $now->toTimeString() <= $course->active_batch()->time_to);
    } else if(count($course->active_batch()->batch_dates) > 0) {
        foreach ($course->active_batch()->batch_dates as $batch_date) {
            if($now->toDateString() == $batch_date->date && $now->toTimeString() >= $batch_date->time_from && $now->toTimeString() <= $batch_date->time_to) {
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

function get_fresh_opentok_session_id() {
    $opentok = new OpenTok('47561291', '1c83ba134bb9cafeaf23c40133c4a7bd4e737174');
    $session = $opentok->createSession();
    return $session->getSessionId();
}

function get_fresh_opentok_token($session_id) {
    $opentok = new OpenTok('47561291', '1c83ba134bb9cafeaf23c40133c4a7bd4e737174');
    $token = $opentok->generateToken($session_id, ['role' => \OpenTok\Role::MODERATOR]);
    return $token;
}

function get_fresh_publisher_opentok_token($session_id) {
    $opentok = new OpenTok('47561291', '1c83ba134bb9cafeaf23c40133c4a7bd4e737174');
    $token = $opentok->generateToken($session_id, ['role' => \OpenTok\Role::MODERATOR]);
    return $token;
}

function get_fresh_subscriber_opentok_token($session_id) {
    $opentok = new OpenTok('47561291', '1c83ba134bb9cafeaf23c40133c4a7bd4e737174');
    $token = $opentok->generateToken($session_id, ['role' => \OpenTok\Role::MODERATOR]);
    return $token;
}

function get_payment_keys() {
    $setting = Settings::findOrFail(1);
    return [
        "secret_key" => $setting->stripe_env == 'Testing' ? $setting->stripe_testing_secret_key : $setting->stripe_secret_key,
        "publishable_key" => $setting->stripe_env == 'Testing' ? $setting->stripe_testing_publishable_key : $setting->stripe_publishable_key,
    ];
}

function get_course_timings($course) {
    //if course has multiple dates
    if(is_null($course->active_batch()->date_range)) {
        $string = "";
        foreach ($course->active_batch()->batch_dates as $batch_date)
        {
            $date = Carbon::parse($batch_date->date)->format('d M Y');
            $time_from = Carbon::parse($batch_date->time_from)->format('g:i A');
            $time_to = Carbon::parse($batch_date->time_to)->format('g:i A');
            $string .= "<h6 class='text-white'>".$date." [".$time_from." - ".$time_to."]"."</h6>";
        }
    } else {
        $date_from = Carbon::parse($course->active_batch()->date_range_from)->format('d M Y');
        $date_to = Carbon::parse($course->active_batch()->date_range_to)->format('d M Y');
        $time_from = Carbon::parse($course->active_batch()->time_from)->format('g:i A');
        $time_to = Carbon::parse($course->active_batch()->time_to)->format('g:i A');
        $string = "<h6 class='text-white'>".$date_from." to ".$date_to." [".$time_from." - ".$time_to."]"."</h6>";
    }

    return $string;
}

function get_batch_timings($batch) {
    //if batch has multiple dates
    if(is_null($batch->date_range)) {
        $string = "";
        foreach ($batch->batch_dates as $batch_date)
        {
            $date = Carbon::parse($batch_date->date)->format('d M Y');
            $time_from = Carbon::parse($batch_date->time_from)->format('g:i A');
            $time_to = Carbon::parse($batch_date->time_to)->format('g:i A');
            $string .= "<h6 class='text-white'>".$date." [".$time_from." - ".$time_to."]"."</h6>";
        }
    } else {
        $date_from = Carbon::parse($batch->date_range_from)->format('d M Y');
        $date_to = Carbon::parse($batch->date_range_to)->format('d M Y');
        $time_from = Carbon::parse($batch->time_from)->format('g:i A');
        $time_to = Carbon::parse($batch->time_to)->format('g:i A');
        $string = "<h6 class='text-white'>".$date_from." to ".$date_to." [".$time_from." - ".$time_to."]"."</h6>";
    }

    return $string;
}

function get_batch_title($batch) {
    $course_name = ('Course: '.$batch->course->name.', ') ?? '';
    $batch_name = ('Batch: '.$batch->name) ?? '';

    return ($course_name . $batch_name) ?? '';
}

function batch_is_full($batch) {
    if(!$batch->is_physical || $batch->physical_class_type == 'in_person') {
        return false;
    }

    $batch_sessions_count = BatchSession::where('batch_id', $batch->id)->where('class_type', 'physical')->where('physical_class_type', 'group')->count();

    return $batch_sessions_count >= $batch->number_of_seats;
}

function is_in_batch ($batch_id) {
    $batch_check = BatchSession::where('user_id', Auth::id())->where('batch_id', $batch_id)->first();

    return (bool)$batch_check;
}
