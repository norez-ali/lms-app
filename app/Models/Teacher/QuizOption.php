<?php

namespace App\Models\Teacher;

use App\Models\Teacher\QuizQuestion;

use Illuminate\Database\Eloquent\Model;

class QuizOption extends Model
{
    protected $fillable = ['question_id', 'option_text', 'is_correct'];
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
