<?php

namespace App\Models\Admin;

use App\Models\Admin\CourseSection;

use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    protected $fillable = [
        'section_id',
        'title',
        'type',
        'content',
        'video_url',
        'file_path',

    ];
    public function section()
    {
        return $this->belongsTo(CourseSection::class);
    }
}
