<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $with = ['profile'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'organization',
        'organization_id',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'organization' => 'boolean',
    ];

    public function jobListings()
    {
        return $this->belongsToMany(JobListing::class)
                ->as('applicants')
                ->using(Applicant::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function isAdmin()
    {
        return $this->email === 'abdilatiifali@gmail.com';
    }

    public function alreadyApplied(JobListing $job): bool
    {
        $users = User::findMany($job->candidates);

        return $users->contains(function ($user, $key) {
            return $user->id == $this->id;
        });
    }

    public function organize()
    {
        return $this->belongsTo(Organization::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public static function createNewUser($attributes)
    {
        return static::create([
            'name' => $attributes['first_name'] . ' ' . $attributes['last_name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'organization' => $attributes['organization'],
        ]);
    }

    public function profilePhotoUrl(): Attribute
    {
        $path = $this->profile_photo_path
                ? \Storage::url($this->profile_photo_path)
                : $this->defaultProfilePhotoUrl();

        return new Attribute(
            get: fn () => $path
        );
    }

    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
    }

    public static function scopefilter($query, $filters)
    {
        $query->when($filters['profession'] ?? 'all', function ($query, $profession) {
            if ($profession == 'all') return;
            $query->whereHas('profile', fn ($query) => $query->whereProfession($profession));
        });
    }

    public function isDoctor()
    {
        return $this->organization_id == null && ! $this->isAdmin();
    }

    public function scopeDoctors($query)
    {
        return $query->where('organization_id', null)
                ->where('email', '!=', 'abdilatiifali@gmail.com');
    }

    public function scopeFilters($query, array $filters)
    {        
        $query->when($filters['city'] ?? 'all', function ($query, $city) {
            if ($city == 'all') return;
            $query->whereHas('profile', function ($query) use ($city) {
                $query->filter('county', $city);
            });
        });

        $query->when($filters['specialist'] ?? 'all', function ($query, $specialist) {
            if ($specialist == 'all') return;
            $query->whereHas('profile', function ($query) use ($specialist) {
                $query->filter('speciality', $specialist);
            });
        });
    }
}
