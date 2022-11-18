<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Services extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'services';
    protected $fillable = ['title', 'service'];

    public function get_service_image()
    {
        $image_check =  $this->getMedia('service_images')->first();
        return $image_check ? $image_check->getUrl() : asset("front/images/srv1.jpg");
    }

}
