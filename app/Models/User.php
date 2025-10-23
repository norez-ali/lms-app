<?php

namespace App\Models;

use App\Models\Admin\Course;
use App\Models\Education;
use App\Models\Experience;
use App\Models\CourseTeacherRequest;
use App\Models\Profile;
use App\Models\Student\Cart;
use App\Models\Student\Enrollment;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function educations()
    {
        return $this->hasMany(Education::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
    public function courseRequests()
    {
        return $this->hasMany(CourseTeacherRequest::class, 'teacher_id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrolledCourses()
    {
        return $this->hasManyThrough(
            Course::class,
            Enrollment::class,
            'user_id',   // Foreign key on enrollments table
            'id',        // Local key on courses table
            'id',        // Local key on users table
            'course_id'  // Foreign key on enrollments table
        );
    }
}
