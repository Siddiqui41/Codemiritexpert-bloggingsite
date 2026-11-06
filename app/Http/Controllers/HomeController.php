<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Book;
use App\Models\Workshop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroArticle = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_hero', true)
            ->first() ?? Article::with(['category', 'author'])->where('status', 'published')->latest()->first();

        $featuredArticles = Article::with(['category', 'author', 'comments'])
            ->where('status', 'published')
            ->where('id', '!=', $heroArticle?->id)
            ->where('is_featured', true)
            ->take(3)
            ->get();

        $guides = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_guide', true)
            ->take(4)
            ->get();

        $latestArticles = Article::with(['category', 'author', 'comments'])
            ->where('status', 'published')
            ->where('id', '!=', $heroArticle?->id)
            ->latest()
            ->paginate(6);

        $categories = Category::withCount('articles')->orderBy('order')->get();
        $books = Book::take(3)->get();
        $workshops = Workshop::take(2)->get();

        return view('home', compact(
            'heroArticle',
            'featuredArticles',
            'guides',
            'latestArticles',
            'categories',
            'books',
            'workshops'
        ));
    }
}
