<?php

namespace App\Models;

use App\Models\Scopes\SameTenantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionSet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'reference',
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
     * @return BelongsTo tenant
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * @return HasMany questions
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
