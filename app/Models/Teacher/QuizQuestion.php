<?php

namespace App\Models\Teacher;

use App\Models\Teacher\Quiz;
use App\Models\Teacher\QuizOption;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['quiz_id', 'question', 'marks'];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function options()
    {
        return $this->hasMany(QuizOption::class, 'question_id');
    }
}
