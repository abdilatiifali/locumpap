<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locum extends Model
{
    use HasFactory;

    public $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    public function job()
    {
        return $this->morphOne(JobListing::class, 'typable');
    }

}
