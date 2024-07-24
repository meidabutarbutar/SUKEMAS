<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class AnswerType extends Model
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
     * @return HasMany answerOptions
     */
    public function answerOptions(): HasMany
    {
        return $this->hasMany(AnswerOption::class);
    }

    /**
     * @return HasMany questions
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
