<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['speciality', 'profession'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    public function scopeFilter($query, $table, $filter)
    {
        return $query->whereHas($table, fn ($query) => $query->whereSlug($filter));
    }
}
