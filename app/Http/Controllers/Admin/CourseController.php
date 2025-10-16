<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'teacher'])->get();

        return view('dashboard.admin.courses.index', get_defined_vars());
    }
    public function create()
    {

        $categories = Category::all();
        return view('dashboard.admin.courses.create', get_defined_vars());
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'              => 'required|string|max:255',
            'short_description'  => 'required|string',
            'description'        => 'nullable|string',
            'learning_outcomes'  => 'nullable|string',
            'requirements'       => 'nullable|string',
            'level'              => 'nullable|string',
            'price'              => 'required|integer|min:0',
            'audio_language'     => 'nullable|string',
            'category_id'        => 'required|exists:categories,id',
            'thumbnail'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload (optional)
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        // Create course (without teacher_id)
        $course = Course::create([
            'category_id'        => $request->category_id,
            'title'              => $request->title,
            'price' => $request->price,
            'slug'               => Str::slug($request->title) . '-' . uniqid(),
            'short_description'  => $request->short_description,
            'description'        => $request->description,
            'learning_outcomes'  => $request->learning_outcomes,
            'requirements'       => $request->requirements,
            'level'              => $request->level,
            'audio_language'     => $request->audio_language,
            'thumbnail'          => $thumbnailPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Course created successfully!',
            'data'    => $course,
        ]);
    }
    public function edit($courseId)
    {
        // Try to find the course by ID
        $course = Course::find($courseId);
        $categories = Category::all();

        // If not found, redirect back with an error message
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        // Return the edit view with the course data
        return view('dashboard.admin.courses.edit', get_defined_vars());
    }
    public function update(Request $request, $courseId)
    {
        $course = Course::find($courseId);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found.',
            ]);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'nullable|string',
            'learning_outcomes' => 'nullable|string',
            'requirements' => 'nullable|string',
            'level' => 'nullable|string',
            'audio_language' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // ✅ Handle thumbnail update
        if ($request->hasFile('thumbnail')) {

            // Delete old thumbnail if exists
            if ($course->thumbnail) {
                $oldPath = str_replace('storage/', '', $course->thumbnail);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new thumbnail
            $path = $request->file('thumbnail')->store('courses/thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        // ✅ Update course record
        $course->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Course updated successfully!',
        ]);
    }
    public function destroy($courseId)
    {
        $course = Course::find($courseId);

        if (!$course) {
            return response()->json(['success' => false, 'message' => 'Course not found.'], 404);
        }

        // Delete old thumbnail if exists
        if ($course->thumbnail) {
            $oldPath = str_replace('storage/', '', $course->thumbnail);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Delete course record
        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course deleted successfully.'
        ]);
    }
}
