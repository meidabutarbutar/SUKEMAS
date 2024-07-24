<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\SameTenantScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Respondent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'division_id',
        'service_id',
        'age_option_id',
        'village_id',
        'occupation_option_id',
        'gender',
        'comment',
        'submitted_at',
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
     * Scope a query to only include answers posted by a respondent for a specific tenant.
     */
    public function scopeForTenant(Builder $query, Tenant|int $tenant): void
    {
        $query->where(
            'tenant_id',
            is_object($tenant) ? $tenant->id : $tenant
        );
    }

    /**
     * Scope a query to only include answers posted by a respondent for a specific tenant submitted at a particular period.
     */
    public function scopeForTenantBetween(Builder $query, Tenant|int $tenant, Carbon $startPeriod, Carbon $endPeriod): void
    {
        $query->where(
            'tenant_id',
            is_object($tenant) ? $tenant->id : $tenant
        )->whereBetween(
            'submitted_at',
            [$startPeriod, $endPeriod]
        );
    }

    /**
     * @return BelongsTo ageOption
     */
    public function ageOption(): BelongsTo
    {
        return $this->belongsTo(AgeOption::class);
    }

    /**
     * @return BelongsTo occupationOption
     */
    public function occupationOption(): BelongsTo
    {
        return $this->belongsTo(OccupationOption::class);
    }

    /**
     * @return BelongsTo village
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * @return BelongsTo tenant
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * @return BelongsTo division
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * @return BelongsTo service
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return HasMany answers
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
