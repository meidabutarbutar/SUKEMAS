<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'province_id',
        'name',
    ];

    /**
     * @return HasMany tenants
     */
    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class)
            ->orderBy('name');
    }

    /**
     * @return BelongsTo province
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * @return HasMany districts
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
