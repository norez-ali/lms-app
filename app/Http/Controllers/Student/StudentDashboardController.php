<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Admin\CourseLesson;
use App\Models\Student\Enrollment;
use App\Models\Student\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $enrollments = Enrollment::where('user_id', $userId)
            ->with(['course.sections.lessons' => function ($query) {
                $query->select('id', 'section_id', 'title');
            }])
            ->paginate(15);

        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;

            // Get all lessons across all sections
            $allLessons = $course->sections->flatMap(function ($section) {
                return $section->lessons;
            });

            $totalLessons = $allLessons->count();

            $completedLessons = LessonProgress::where('user_id', $userId)
                ->whereIn('lesson_id', $allLessons->pluck('id'))
                ->where('completed', true)
                ->count();

            $enrollment->progress = $totalLessons > 0
                ? round(($completedLessons / $totalLessons) * 100)
                : 0;
        }
        return view('dashboard.student.index', get_defined_vars());
    }
    public function viewCourse($courseId)
    {
        $course = Course::where('id', $courseId)
            ->with([
                'category',
                'sections.lessons',
                'quizzes' // 👈 include quizzes
            ])
            ->first();

        return view('dashboard.student.lessons.index', get_defined_vars());
    }
    public function viewLesson($lessonId)
    {
        $lesson = CourseLesson::findOrFail($lessonId);
        $userId = Auth::id();

        // ✅ Mark as completed (or viewed)
        LessonProgress::updateOrCreate(
            ['user_id' => $userId, 'lesson_id' => $lessonId],
            ['completed' => true]
        );

        // ✅ Return lesson content
        return response()->json([
            'id' => $lesson->id,
            'title' => $lesson->title,
            'content' => $lesson->content,
            'type' => $lesson->type,
            'video_url' => $lesson->video_url ? asset('storage/' . $lesson->video_url) : null,
            'file_path' => $lesson->file_path ? asset('storage/' . $lesson->file_path) : null,
        ]);
    }
}
