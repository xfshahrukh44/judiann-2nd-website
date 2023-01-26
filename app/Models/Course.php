<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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
        'is_streaming',
        'is_free'
    ];

    public static function boot() {
        parent::boot();

        //while creating/inserting item into db
        static::created(function ($query) {
            LatestUpdate::create([
                'course_id' => $query->id,
                'title' => $query->name,
                'description' => $query->description,
            ]);
        });

        static::deleting(function ($query) {
            LatestUpdate::where('course_id', $query->id)->delete();
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

    public function batches()
    {
        return $this->hasMany('App\Models\Batch');
    }

    public function active_batch()
    {
        return $this->hasMany('App\Models\Batch')->where('has_ended', false)->first();
    }

    public function get_course_image()
    {
        $image_check =  $this->getMedia('course_images')->first();
        return $image_check ? $image_check->getUrl() : asset("front/images/class1.jpg");
    }

    public function vouchers ()
    {
        return $this->hasMany(Voucher::class);
    }
}
