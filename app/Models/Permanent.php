<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permanent extends Model
{
    use HasFactory;

    public function job()
    {
        return $this->morphOne(JobListing::class, 'typable');
    }

}
