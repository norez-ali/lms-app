<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Fetch all categories from the database
        $categories = Category::latest()->get();
        return view('dashboard.admin.categories.index', get_defined_vars());
    }
    public function add()
    {
        // Fetch all categories from the database
        $categories = Category::latest()->get();
        return view('dashboard.admin.categories.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        // ✅ Store the uploaded image in storage/app/public/categories
        $path = $request->file('image')->store('categories', 'public');

        // ✅ Save category in the database
        $category = Category::create([
            'name' => $request->name,
            'image' => 'storage/' . $path, // store full path for easy asset() usage
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'Category created successfully!');
    }
    public function editCategory($categoryId)
    {
        // Find the category by ID
        $category = Category::findOrFail($categoryId);

        // Return the edit view with the category data
        return view('dashboard.admin.categories.edit', compact('category'));
    }
}
