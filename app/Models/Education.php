<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $fillable = [
        'user_id',
        'degree',
        'institution',
        'start_year',
        'end_year',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
