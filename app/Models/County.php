<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    public static function getAll()
    {
        return \Cache::rememberForever('counties', fn() => static::all());
    }
}
