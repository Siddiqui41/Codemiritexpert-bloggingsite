<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Book;
use App\Models\Workshop;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function guides()
    {
        $guides = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_guide', true)
            ->latest()
            ->paginate(12);

        $categories = Category::orderBy('order')->get();

        return view('pages.guides', compact('guides', 'categories'));
    }

    public function books()
    {
        $books = Book::all();
        $categories = Category::orderBy('order')->get();

        return view('pages.books', compact('books', 'categories'));
    }

    public function workshops()
    {
        $workshops = Workshop::all();
        $categories = Category::orderBy('order')->get();

        return view('pages.workshops', compact('workshops', 'categories'));
    }

    public function about()
    {
        $team = User::whereIn('role', ['admin', 'author'])->get();
        $categories = Category::orderBy('order')->get();

        return view('pages.about', compact('team', 'categories'));
    }

    public function contact()
    {
        $categories = Category::orderBy('order')->get();
        return view('pages.contact', compact('categories'));
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'department' => 'required|string',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10',
        ]);

        $trackingRef = 'SMASH-' . rand(100000, 999999);

        return back()->with('contact_success', "Thank you, {$validated['name']}! Your dispatch has been routed to the {$validated['department']} desk. Tracking Reference: {$trackingRef}");
    }
}
