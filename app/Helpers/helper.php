<?php

use App\Models\Course;
use App\Models\Settings;
use Carbon\Carbon;
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
//    return str_replace(' ', '', $token);
//    return strval($token);
    return $token;
}

function get_fresh_subscriber_opentok_token($session_id) {
    $opentok = new OpenTok('47561291', '1c83ba134bb9cafeaf23c40133c4a7bd4e737174');
    $token = $opentok->generateToken($session_id, ['role' => \OpenTok\Role::MODERATOR]);
//    return str_replace(' ', '', $token);
//    return strval($token);
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
