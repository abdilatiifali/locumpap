<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
 
    public static function getAll()
    {
       return \Cache::rememberForever('specialities', fn() => static::all());
    }
}
