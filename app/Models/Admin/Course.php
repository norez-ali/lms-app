<?php

namespace App\Models\Admin;

use App\Models\Admin\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'teacher_id',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
