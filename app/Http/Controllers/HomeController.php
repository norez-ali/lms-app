<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['courses.sections.lessons'])->get();
        return view('welcome', compact('categories'));
    }
}
