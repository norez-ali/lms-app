<?php

namespace App\Models\Teacher;

use App\Models\Admin\Course;
use App\Models\Teacher\QuizQuestion;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
    protected static function booted()
    {
        static::deleting(function ($quiz) {
            // Delete related questions and options
            foreach ($quiz->questions as $question) {
                $question->options()->delete();
            }
            $quiz->questions()->delete();
        });
    }
}
