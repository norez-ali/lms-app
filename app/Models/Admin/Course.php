<?php

namespace App\Models\Admin;

use App\Models\Admin\Category;
use App\Models\Admin\CourseSection;

use App\Models\User;
use App\Models\CourseTeacherRequest;
use App\Models\Teacher\Quiz;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'category_id',
        'teacher_id',
        'title',
        'slug',
        'short_description',
        'description',
        'learning_outcomes',
        'requirements',
        'level',
        'audio_language',
        'thumbnail',


    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function sections()
    {
        return $this->hasMany(CourseSection::class);
    }
    public function teacherRequests()
    {
        return $this->hasMany(CourseTeacherRequest::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
