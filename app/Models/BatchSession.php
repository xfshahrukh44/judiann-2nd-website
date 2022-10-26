<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'batch_id',
        'class_type',
        'physical_class_type',
    ];

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
