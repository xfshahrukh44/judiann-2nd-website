<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'date',
        'time_from',
        'time_to',
    ];

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }
}
