<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
