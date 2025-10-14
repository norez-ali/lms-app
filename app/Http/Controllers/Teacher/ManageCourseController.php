<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Admin\CourseLesson;
use App\Models\Admin\CourseSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageCourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('teacher_id', auth()->id())
            ->with('category')
            ->get();

        return view('dashboard.teacher.manage_courses.index', get_defined_vars());
    }
    public function edit($id)
    {
        $course = Course::where('id', $id)->with('category', 'sections.lessons')->first();

        return view('dashboard.teacher.manage_courses.edit', get_defined_vars());
    }
    public function addSection(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $section = CourseSection::create([
            'course_id' => $id,
            'title' => $validated['title'],

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Section added successfully!',
            'section' => $section,
        ]);
    }
    public function deleteSection($id)
    {
        $section = CourseSection::find($id);

        if (!$section) {
            return response()->json(['success' => false, 'message' => 'Section not found.'], 404);
        }

        $section->delete();

        return response()->json(['success' => true, 'message' => 'Section deleted successfully!']);
    }
    public function addLesson(Request $request, $courseId)
    {
        $request->validate([
            'section_id' => 'required|exists:course_sections,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'lesson_file' => 'nullable|file|mimes:pdf,mp4,mov,mkv|max:51200', // optional file
        ]);

        $type = 'article'; // default type
        $fileColumn = null;
        $path = null;

        if ($request->hasFile('lesson_file')) {
            $file = $request->file('lesson_file');
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, ['mp4', 'mov', 'mkv'])) {
                $type = 'video';
                $path = $file->store('courses/lessons/videos', 'public');
                $fileColumn = 'video_url';
            } elseif ($extension === 'pdf') {
                $type = 'file';
                $path = $file->store('courses/lessons/files', 'public');
                $fileColumn = 'file_path';
            } else {
                return response()->json(['error' => 'Invalid file type. Only videos or PDFs are allowed.'], 400);
            }
        }

        // Prepare data
        $lessonData = [
            'course_id'  => $courseId,
            'section_id' => $request->section_id,
            'title'      => $request->title,
            'content'    => $request->content,
            'type'       => $type,
        ];

        // Add file column dynamically
        if ($fileColumn && $path) {
            $lessonData[$fileColumn] = $path;
        }

        // Create the lesson record
        $lesson = CourseLesson::create($lessonData);

        return response()->json([
            'success' => true,
            'message' => 'Lesson added successfully!',
            'lesson'  => $lesson,
        ]);
    }


    public function deleteLesson($lessonId)
    {
        // 🔹 Find lesson
        $lesson = CourseLesson::find($lessonId);

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found.',
            ]);
        }

        // 🔹 Delete associated file/video if it exists
        if ($lesson->video_url) {
            $oldPath = str_replace('storage/', '', $lesson->video_url);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        if ($lesson->file_path) {
            $oldPath = str_replace('storage/', '', $lesson->file_path);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // 🔹 Delete the lesson record
        $lesson->delete();

        // 🔹 Return success response
        return response()->json([
            'success' => true,
            'message' => 'Lesson deleted successfully!',
        ]);
    }
}
