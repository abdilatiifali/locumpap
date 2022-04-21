<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    use HasFactory;

    protected $casts = ['features' => 'array'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
