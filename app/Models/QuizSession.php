<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    /** @use HasFactory<\Database\Factories\QuizSessionFactory> */
    use HasFactory;
    protected $fillable = ['quiz_id', 'token', 'completed'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function quizAnswers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
