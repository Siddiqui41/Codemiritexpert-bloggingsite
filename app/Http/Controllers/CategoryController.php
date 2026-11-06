<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::with(['author', 'category', 'comments'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        $allCategories = Category::withCount('articles')->orderBy('order')->get();

        return view('category.show', compact('category', 'articles', 'allCategories'));
    }
}
