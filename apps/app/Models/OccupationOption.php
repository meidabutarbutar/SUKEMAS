<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class OccupationOption extends Model
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
     * @return HasMany respondents
     */
    public function respondents(): HasMany
    {
        return $this->hasMany(Respondent::class);
    }
}
