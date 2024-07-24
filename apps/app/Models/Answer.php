<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'respondent_id',
        'question_id',
        'answer_option_id',
        'value',
    ];

    /**
     * Scope a query to only include answers posted by a respondent for a specific tenant.
     *
     * @return void
     */
    public function scopeForTenant(Builder $query, Tenant|int $tenant): void
    {
        $query->whereHas('respondent', function ($query) use ($tenant) {
            $query->where('tenant_id', is_object($tenant) ? $tenant->id : $tenant);
        });
    }

    /**
     * Scope a query to only include answers posted by a respondent for a specific Tenant submitted at a particular period.
     *
     * @return void
     */
    public function scopeForTenantBetween(Builder $query, Tenant|int $tenant, Carbon $startPeriod, Carbon $endPeriod): void
    {
        $query->whereHas(
            'respondent',
            function ($query) use ($tenant, $startPeriod, $endPeriod) {
                $query->where(
                    'tenant_id',
                    is_object($tenant) ? $tenant->id : $tenant
                )->whereBetween(
                    'submitted_at',
                    [$startPeriod, $endPeriod]
                );
            }
        );
    }

    /**
     * Scope a query to only include answers posted by a respondent for a specific Division.
     *
     * @return void
     */
    public function scopeForDivision(Builder $query, Division|int $division): void
    {
        $query->whereHas(
            'respondent',
            function ($query) use ($division) {
                $query->where(
                    'division_id',
                    is_object($division) ? $division->id : $division
                );
            }
        );
    }

    /**
     * @return BelongsTo respondent
     */
    public function respondent(): BelongsTo
    {
        return $this->belongsTo(Respondent::class);
    }

    /**
     * @return BelongsTo question
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return BelongsTo answerOption
     */
    public function answerOption(): BelongsTo
    {
        return $this->belongsTo(AnswerOption::class);
    }
}
