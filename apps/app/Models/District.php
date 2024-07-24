<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'regency_id',
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
     * @return BelongsTo regency
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    /**
     * @return HasMany villages
     */
    public function villages(): HasMany
    {
        return $this->hasMany(Village::class);
    }
}
