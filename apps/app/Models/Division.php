<?php

namespace App\Models;

use App\Models\Scopes\SameTenantScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'short_name',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new SameTenantScope);
    }

    /**
     * Interact with the division's short_name.
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
     * @return BelongsTo tenant
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * @return HasMany services
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
