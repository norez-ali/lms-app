<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function updateCategory(Request $request, $categoryId)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        // Fetch existing category
        $category = Category::findOrFail($categoryId);

        // ✅ Delete old image if new one is uploaded
        if ($request->hasFile('image') && $category->image) {
            $oldPath = str_replace('storage/', '', $category->image); // fix path format
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // ✅ Store new image if uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $category->image = 'storage/' . $path;
        }

        // ✅ Update name
        $category->name = $request->name;
        $category->save();

        // ✅ Return updated data and success message (no redirect)
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
            'category' => [
                'id'    => $category->id,
                'name'  => $category->name,
                'image' => asset($category->image),
            ],
        ]);
    }
    public function deleteCategory($categoryId)
    {
        // Find the category
        $category = Category::findOrFail($categoryId);

        // Delete the image from storage if exists
        if ($category->image) {
            $oldPath = str_replace('storage/', '', $category->image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Delete the category
        $category->delete();

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!',
            'category_id' => $categoryId,
        ]);
    }
}
