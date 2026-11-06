<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Access restricted to editorial administrators.']);
        }

        return back()->withErrors(['email' => 'Invalid email or password credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('status', 'You have been safely signed out.');
    }

    public function dashboard()
    {
        $stats = [
            'total_articles' => Article::count(),
            'total_views' => Article::sum('views_count'),
            'total_claps' => Article::sum('claps_count'),
            'total_categories' => Category::count(),
            'total_comments' => Comment::count(),
            'pending_comments' => Comment::where('status', 'pending')->count(),
            'total_subscribers' => Newsletter::count(),
            'total_authors' => User::count(),
        ];

        $recentArticles = Article::with(['category', 'author'])->latest()->take(5)->get();
        $recentComments = Comment::with('article')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentComments'));
    }
}
