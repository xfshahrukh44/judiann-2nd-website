<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'date',
        'time_from',
        'time_to',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
