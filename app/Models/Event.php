<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = ['published_at' => 'datetime'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
