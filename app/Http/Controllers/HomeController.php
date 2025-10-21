<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['courses.sections.lessons'])->get();
        return view('welcome', compact('categories'));
    }
    public function search(Request $request)
    {
        $query = $request->get('query');

        $courses = Course::where('title', 'like', "%{$query}%")
            ->orWhere('level', 'like', "%{$query}%")
            ->get();

        return response()->json($courses);
    }
    public function courseView($id)
    {
        $course = Course::with([
            'category',
            'quizzes',
            'teacher' => function ($query) {
                $query->with('experiences')->withCount('courses');
            },
            'sections.lessons'
        ])->find($id);



        return view('dashboard.student.course_view.index', get_defined_vars());
    }
}
