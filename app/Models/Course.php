<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'fees',
        'is_online',
        'is_physical',
        'date_range',
        'date_range_from',
        'date_range_to',
        'time_from',
        'time_to',
        'opentok_session_id'
    ];

    public function course_dates()
    {
        return $this->hasMany('App\Models\CourseDate');
    }

    public function course_sessions()
    {
        return $this->hasMany('App\Models\CourseSession');
    }
}
