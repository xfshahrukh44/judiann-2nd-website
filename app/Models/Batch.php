<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'is_online',
        'is_physical',
        'physical_class_type',
        'is_streaming',
        'number_of_seats',
        'date_range',
        'date_range_from',
        'date_range_to',
        'time_from',
        'time_to',
        'has_ended',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function batch_dates()
    {
        return $this->hasMany('App\Models\BatchDate');
    }

    public function batch_sessions()
    {
        return $this->hasMany('App\Models\BatchSession');
    }
}
