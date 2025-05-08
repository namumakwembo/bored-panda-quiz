<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\QuizAnswerFactory> */
    use HasFactory;
    protected $fillable = ['quiz_session_id', 'question_id', 'option_id'];

    public function quizSession()
    {
        return $this->belongsTo(QuizSession::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
