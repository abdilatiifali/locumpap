<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasBilling;

class Organization extends Model
{    
    use HasFactory, HasBilling;
    
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'subscribed_at' => 'datetime',
        'subscription_ends_at' => 'datetime',
    ];

    public static function createNewOrganization($attributes)
    {
        $organization = static::create([
            'name' =>  $attributes['organization_name'],
            'email' => $attributes['email'],
            'county' => $attributes['county'],
            'phone_number' => $attributes['phone_number'],
            'organization_type' => $attributes['organization_type'],
            'address' => $attributes['address'],
            'city' => $attributes['city'],
            'post_code' => $attributes['post_code'],
            'registration_number' => $attributes['registration_number'],
        ]);

       $organization->charge();

        return $organization;
    }
}
