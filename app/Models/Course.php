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
        'opentok_session_id',
        'is_streaming'
    ];

    public static function boot() {
        parent::boot();

        //while creating/inserting item into db
        static::created(function ($query) {
//            $query->opentok_session_id = get_fresh_opentok_session_id();
            LatestUpdate::create([
                'course_id' => $query->id,
                'title' => $query->name,
                'description' => $query->description,
            ]);
        });
    }

    public function course_dates()
    {
        return $this->hasMany('App\Models\CourseDate');
    }

    public function course_sessions()
    {
        return $this->hasMany('App\Models\CourseSession');
    }
}
