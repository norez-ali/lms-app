<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'institution',
        'start_date',
        'end_date',
        'description',
    ];

    /**
     * Relationship: An experience belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
