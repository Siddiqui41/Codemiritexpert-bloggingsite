<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'author']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('title', 'like', "%{$s}%")
                  ->orWhere('excerpt', 'like', "%{$s}%");
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $authors = User::orderBy('name')->get();
        return view('admin.articles.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        // 1. Check for any PHP upload-level failure on cover_image_file before validation
        if ($file = $request->file('cover_image_file')) {
            if (!$file->isValid()) {
                $errCode = $file->getError();
                $maxSize = ini_get('upload_max_filesize') ?: '20M';
                $errorMessage = match ($errCode) {
                    UPLOAD_ERR_INI_SIZE => "The uploaded image exceeds the server's upload_max_filesize ({$maxSize}). Please upload an image under {$maxSize}.",
                    UPLOAD_ERR_FORM_SIZE => "The uploaded image exceeds the form's maximum allowable file size.",
                    UPLOAD_ERR_PARTIAL => "The image was only partially uploaded. Please try again.",
                    UPLOAD_ERR_NO_TMP_DIR => "Server temporary directory is missing. Please contact administrator.",
                    UPLOAD_ERR_CANT_WRITE => "Failed to write image to disk. Please check directory permissions.",
                    UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",
                    default => "File upload error ({$errCode}): " . ($file->getErrorMessage() ?: 'Unknown error')
                };

                return back()->withInput()->withErrors([
                    'cover_image_file' => $errorMessage
                ]);
            }
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'kicker' => 'nullable|string|max:100',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'cover_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:20480',
            'cover_image' => 'nullable|string|max:1000',
            'cover_image_url' => 'nullable|string|max:1000',
            'cover_caption' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'reading_time' => 'required|string|max:50',
            'status' => 'required|in:published,draft',
            'is_hero' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'is_guide' => 'sometimes|boolean',
        ], [
            'cover_image_file.uploaded' => 'The selected image could not be uploaded. Please verify the file is a valid image (JPG, PNG, WebP) under 20MB.',
            'cover_image_file.file' => 'The cover file must be a valid uploaded file.',
            'cover_image_file.mimes' => 'The image must be a file of type: JPG, PNG, WebP, GIF, SVG.',
            'cover_image_file.max' => 'The image size may not exceed 20MB.',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['is_hero'] = $request->boolean('is_hero');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_guide'] = $request->boolean('is_guide');
        $validated['published_at'] = $validated['status'] === 'published' ? now() : null;

        // Handle Image Upload into public/assets/uploads/articles
        if ($file = $request->file('cover_image_file')) {
            $uploadDir = public_path('assets/uploads/articles');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            $rawOriginalName = $file->getClientOriginalName();
            $baseName = pathinfo($rawOriginalName, PATHINFO_FILENAME);
            $slugBase = Str::slug($baseName) ?: 'article-cover';
            $ext = strtolower($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'png');
            $filename = time() . '_' . $slugBase . '.' . $ext;

            $file->move($uploadDir, $filename);
            $validated['cover_image'] = '/assets/uploads/articles/' . $filename;
        } elseif (!empty($request->input('cover_image_url'))) {
            $validated['cover_image'] = $request->input('cover_image_url');
        } elseif (!empty($request->input('cover_image'))) {
            $validated['cover_image'] = $request->input('cover_image');
        } else {
            $validated['cover_image'] = 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80';
        }

        // Process Tags (comma separated)
        if ($request->filled('tags')) {
            $tagsList = array_map('trim', explode(',', $request->tags));
            $validated['tags'] = array_values(array_filter($tagsList));
        }

        if ($validated['is_hero']) {
            Article::where('is_hero', true)->update(['is_hero' => false]);
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article created and published successfully!');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $authors = User::orderBy('name')->get();
        return view('admin.articles.edit', compact('article', 'categories', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        // 1. Check for any PHP upload-level failure on cover_image_file before validation
        if ($file = $request->file('cover_image_file')) {
            if (!$file->isValid()) {
                $errCode = $file->getError();
                $maxSize = ini_get('upload_max_filesize') ?: '20M';
                $errorMessage = match ($errCode) {
                    UPLOAD_ERR_INI_SIZE => "The uploaded image exceeds the server's upload_max_filesize ({$maxSize}). Please upload an image under {$maxSize}.",
                    UPLOAD_ERR_FORM_SIZE => "The uploaded image exceeds the form's maximum allowable file size.",
                    UPLOAD_ERR_PARTIAL => "The image was only partially uploaded. Please try again.",
                    UPLOAD_ERR_NO_TMP_DIR => "Server temporary directory is missing. Please contact administrator.",
                    UPLOAD_ERR_CANT_WRITE => "Failed to write image to disk. Please check directory permissions.",
                    UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",
                    default => "File upload error ({$errCode}): " . ($file->getErrorMessage() ?: 'Unknown error')
                };

                return back()->withInput()->withErrors([
                    'cover_image_file' => $errorMessage
                ]);
            }
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'kicker' => 'nullable|string|max:100',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'cover_image_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:20480',
            'cover_image' => 'nullable|string|max:1000',
            'cover_image_url' => 'nullable|string|max:1000',
            'cover_caption' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'reading_time' => 'required|string|max:50',
            'status' => 'required|in:published,draft',
            'is_hero' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'is_guide' => 'sometimes|boolean',
        ], [
            'cover_image_file.uploaded' => 'The selected image could not be uploaded. Please verify the file is a valid image (JPG, PNG, WebP) under 20MB.',
            'cover_image_file.file' => 'The cover file must be a valid uploaded file.',
            'cover_image_file.mimes' => 'The image must be a file of type: JPG, PNG, WebP, GIF, SVG.',
            'cover_image_file.max' => 'The image size may not exceed 20MB.',
        ]);

        $validated['is_hero'] = $request->boolean('is_hero');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_guide'] = $request->boolean('is_guide');

        // Handle Image Upload into public/assets/uploads/articles
        if ($file = $request->file('cover_image_file')) {
            $uploadDir = public_path('assets/uploads/articles');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            // Remove old local image if exists
            if (!empty($article->cover_image) && str_starts_with($article->cover_image, '/assets/uploads/')) {
                $oldPath = public_path(ltrim($article->cover_image, '/'));
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $rawOriginalName = $file->getClientOriginalName();
            $baseName = pathinfo($rawOriginalName, PATHINFO_FILENAME);
            $slugBase = Str::slug($baseName) ?: 'article-cover';
            $ext = strtolower($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'png');
            $filename = time() . '_' . $slugBase . '.' . $ext;

            $file->move($uploadDir, $filename);
            $validated['cover_image'] = '/assets/uploads/articles/' . $filename;
        } elseif (!empty($request->input('cover_image_url'))) {
            $validated['cover_image'] = $request->input('cover_image_url');
        } elseif (!empty($request->input('cover_image'))) {
            $validated['cover_image'] = $request->input('cover_image');
        }

        // Process Tags
        if ($request->has('tags')) {
            $tagsList = array_map('trim', explode(',', (string)$request->tags));
            $validated['tags'] = array_values(array_filter($tagsList));
        }

        if ($validated['is_hero'] && !$article->is_hero) {
            Article::where('is_hero', true)->update(['is_hero' => false]);
        }

        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Delete local image if uploaded
        if (!empty($article->cover_image) && str_starts_with($article->cover_image, '/assets/uploads/')) {
            $imagePath = public_path(ltrim($article->cover_image, '/'));
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted from publication.');
    }
}
