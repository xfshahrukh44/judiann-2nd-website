<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'description',
        'code',
        'discount_rate',
        'valid_until',
    ];

    public function course ()
    {
        return $this->belongsTo(Course::class);
    }
}
