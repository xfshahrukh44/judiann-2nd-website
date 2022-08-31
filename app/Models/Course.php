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
    ];

    public function course_dates()
    {
        return $this->hasMany('App\Models\CourseDate');
    }
}
