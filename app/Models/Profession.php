<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    public static function getAll()
    {
        return \Cache::rememberForever('professions', fn() => static::all());
    }
}
