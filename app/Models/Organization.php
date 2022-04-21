<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{    
    use HasFactory;
    
    protected $guarded = [];

    public static function createNewOrganization($attributes)
    {
        return static::create([
            'name' =>  $attributes['organization_name'],
            'email' => $attributes['email'],
            'county' => $attributes['county'],
            'phone_number' => $attributes['phone_number'],
            'organization_type' => $attributes['organization_type'],
            'address' => $attributes['address'],
            'city' => $attributes['city'],
            'post_code' => $attributes['post_code'],
        ]);
    }
}
