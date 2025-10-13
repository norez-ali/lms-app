<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Admin\CourseSection;
use Illuminate\Http\Request;

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
        $course = Course::where('id', $id)->with('category', 'sections')->first();

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
}
