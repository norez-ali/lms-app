<?php

namespace App\Models\Student;

use App\Models\Admin\CourseLesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LessonProgress extends Model
{
    protected $fillable = ['user_id', 'lesson_id', 'completed'];

    public function lesson()
    {
        return $this->belongsTo(CourseLesson::class, 'lesson_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
