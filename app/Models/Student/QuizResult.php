<?php

namespace App\Models\Student;

use App\Models\Teacher\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = ['user_id', 'quiz_id', 'score', 'percentage'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
