<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Student extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name'
    ];

    public function get_student_image()
    {
        $image_check =  $this->getMedia('student_images')->first();
        return $image_check ? $image_check->getUrl() : asset("front/images/student1.jpg");
    }

    public function portfolio_images()
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
