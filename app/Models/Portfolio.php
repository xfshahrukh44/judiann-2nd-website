<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Portfolio extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['image_order'];

    public function get_portfolio_image()
    {
        $image_check =  $this->getMedia('portfolio_images')->first();
        return $image_check ? $image_check->getUrl() : asset("front/images/portfolio1.jpg");
    }
}
