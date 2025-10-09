<?php

namespace App\Models;

use App\Models\Admin\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CourseTeacherRequest extends Model
{
    protected $fillable = [
        'course_id',
        'teacher_id',
        'status',
    ];

    // A request belongs to a course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // A request belongs to a teacher (user)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
