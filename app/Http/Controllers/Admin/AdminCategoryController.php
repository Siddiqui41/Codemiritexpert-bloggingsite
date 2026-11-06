<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')->orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'accent_color' => 'required|string|max:20',
            'description' => 'nullable|string',
            'order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Topic category created successfully!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'accent_color' => 'required|string|max:20',
            'description' => 'nullable|string',
            'order' => 'integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
