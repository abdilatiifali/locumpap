<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class JobListing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'candidates' => 'array'
    ];

    public function typable()
    {
        return $this->morphTo();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'applicants');
    }

    public function type()
    {
        [, , $class] = explode('\\', $this->typable_type);

        return $class;
    }

    public function totalApplicants(): Attribute
    {
        return new Attribute(
            get: fn() => $this->users->count()
        );
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['type'] ?? 'all', function ($query, $type) {
            $this->filterByTypes($query, $type);
        })
        ->when($filters['city'] ?? 'all', function ($query, $city) {
            if ($city == 'all') return;
            $query->whereHas('county', fn ($query) => $query->whereSlug($city));
        })
        ->when($filters['department'] ?? 'all', function ($query, $department) {
            if ($department == 'all') return;
            $query->whereHas('department', fn ($query) => $query->whereSlug($department));
        })
        ->when($filters['profession'] ?? 'all', function ($query, $profession) {
            if ($profession == 'all') return;
            $query->whereHas('profession', fn ($query) => $query->whereSlug($profession));
        });
    }

    public function filterByTypes($query, $type)
    {
        return match($type) {
            'locums' => $query->whereHasMorph('typable', Locum::class),
            'permanent' => $query->whereHasMorph('typable', Permanent::class),
            default => $query,
        };
    }

}
