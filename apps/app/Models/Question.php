<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'answer_type_id',
        'question_set_id',
        'order',
        'question',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        parent::boot();

        static::creating(function (Question $question) {
            $order = Question::where('question_set_id', $question->question_set_id)->max('order') + 1;
            $question->order = $order;
        });
    }

    /**
     * @return HasMany answers
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return BelongsTo answerType
     */
    public function answerType(): BelongsTo
    {
        return $this->belongsTo(AnswerType::class);
    }

    /**
     * @return BelongsTo questionSet
     */
    public function questionSet(): BelongsTo
    {
        return $this->belongsTo(QuestionSet::class);
    }
}
