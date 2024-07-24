<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
     * @return HasMany regencies
     */
    public function regencies(): HasMany
    {
        return $this->hasMany(Regency::class);
    }
}
