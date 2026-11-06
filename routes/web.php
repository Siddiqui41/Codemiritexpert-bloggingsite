<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminSubscriberController;

/*
|--------------------------------------------------------------------------
| Web Routes - Smashing Magazine Clone (Nexus Dev Magazine)
|--------------------------------------------------------------------------
*/

// Front-End Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

// Interactive Front-End Actions
Route::post('/articles/{slug}/clap', [ArticleController::class, 'clap'])->name('articles.clap');
Route::post('/articles/{slug}/comment', [ArticleController::class, 'comment'])->name('articles.comment');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Standalone Editorial Pages (Smashing style)
Route::get('/guides', [PageController::class, 'guides'])->name('pages.guides');
Route::get('/books', [PageController::class, 'books'])->name('pages.books');
Route::get('/workshops', [PageController::class, 'workshops'])->name('pages.workshops');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('pages.contact.submit');

// Admin Authentication Routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Protected Admin Panel Routes (Redirects to /admin/login if logged out or unauthenticated)
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    // Articles CRUD
    Route::resource('articles', AdminArticleController::class);

    // Categories CRUD
    Route::resource('categories', AdminCategoryController::class)->except(['create', 'show', 'edit']);

    // Comments Moderation
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::post('/comments/{id}/toggle', [AdminCommentController::class, 'toggleStatus'])->name('comments.toggle');
    Route::delete('/comments/{id}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');

    // Subscribers
    Route::get('/subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('/subscribers/{id}', [AdminSubscriberController::class, 'destroy'])->name('subscribers.destroy');
});
