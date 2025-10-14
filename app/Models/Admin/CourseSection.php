<?php

namespace App\Models\Admin;

use App\Models\Admin\Course;
use App\Models\Admin\CourseLesson;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $fillable = ['course_id', 'title'];
    public function lessons()
    {
        return $this->hasMany(CourseLesson::class, 'section_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
