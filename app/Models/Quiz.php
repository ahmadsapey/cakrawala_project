<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    protected $fillable = ['teacher_id', 'classroom_id', 'title', 'duration_minutes', 'passing_score', 'question_count', 'due_at', 'status'];

    protected function casts(): array
    {
        return ['due_at' => 'datetime'];
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('sort_order');
    }

    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class);
    }
}
