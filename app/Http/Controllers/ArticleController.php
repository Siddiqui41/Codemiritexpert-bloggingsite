<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::with(['category', 'author', 'comments' => function ($q) {
            $q->where('status', 'approved')->latest();
        }])->where('slug', $slug)->firstOrFail();

        // Increment view count
        $article->increment('views_count');

        // Related articles from same category
        $relatedArticles = Article::with(['category', 'author'])
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        $categories = Category::orderBy('order')->get();

        return view('articles.show', compact('article', 'relatedArticles', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $categorySlug = $request->input('category', '');

        $articles = Article::with(['category', 'author', 'comments'])
            ->where('status', 'published');

        if ($query) {
            $articles->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            });
        }

        if ($categorySlug && $categorySlug !== 'all') {
            $articles->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $articles = $articles->latest()->paginate(9)->withQueryString();
        $categories = Category::orderBy('order')->get();

        return view('articles.search', compact('articles', 'query', 'categorySlug', 'categories'));
    }

    public function clap($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('claps_count');

        return response()->json([
            'success' => true,
            'claps_count' => $article->claps_count,
        ]);
    }

    public function comment(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'author_name' => 'required|string|max:100',
            'author_email' => 'required|email|max:150',
            'content' => 'required|string|min:5|max:2000',
        ]);

        $comment = Comment::create([
            'article_id' => $article->id,
            'author_name' => $validated['author_name'],
            'author_email' => $validated['author_email'],
            'author_avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80',
            'content' => $validated['content'],
            'status' => 'approved',
            'likes_count' => 0,
        ]);

        return back()->with('comment_success', 'Thank you! Your commentary has been published on the discussion thread.');
    }
}
