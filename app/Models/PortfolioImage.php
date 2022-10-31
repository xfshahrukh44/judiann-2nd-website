<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PortfolioImage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function get_portfolio_image()
    {
        $image_check =  $this->getMedia('portfolio_images')->first();
        return $image_check ? $image_check->getUrl() : asset("front/images/student1.jpg");
    }
}
