<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'division_id',
        'name',
        'short_name',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('ServiceWithSameTenant', function (Builder $builder) {
            if (auth()->hasUser()) {
                $loggedInOperator = auth()->user();

                $divisionIds = $loggedInOperator->tenant->divisions->pluck('id');

                $builder->whereIn('division_id', $divisionIds);
            }
        });
    }

    /**
     * Scope a query to only include services under a specific tenant.
     */
    public function scopeForTenant(Builder $query, Tenant|int $tenant): void
    {
        $query->whereHas('division', function ($query) use ($tenant) {
            $query->where('tenant_id', is_object($tenant) ? $tenant->id : $tenant);
        });
    }

    /**
     * Interact with the service's short_name.
     */
    protected function shortName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $value ?? $attributes['name'],
        );
    }

    /**
     * @return HasMany respondents
     */
    public function respondents(): HasMany
    {
        return $this->hasMany(Respondent::class);
    }

    /**
     * @return BelongsTo divisions
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
