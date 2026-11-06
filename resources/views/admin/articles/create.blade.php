@extends('admin.layouts.admin')

@section('title', 'Draft New Article')
@section('page_title', 'Create New Blog Post')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation Breadcrumb -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-mono flex items-center gap-1.5 transition-colors hover:underline" style="color: var(--brand-primary);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            ← Back to All Articles
        </a>
        <span class="text-xs font-mono px-3 py-1 rounded-full font-bold" style="background-color: var(--brand-light); color: var(--brand-primary);">
            Article Creation Studio
        </span>
    </div>

    @if($errors->any())
        <div class="p-5 rounded-2xl text-xs font-mono shadow-sm border" style="background-color: rgba(217, 93, 81, 0.15); border-color: var(--brand-rose); color: var(--text-main);">
            <div class="font-bold flex items-center gap-2 mb-2" style="color: var(--brand-rose);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Please resolve the following errors:
            </div>
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- STEP 1: Headline & Topic Category -->
        <div class="theme-surface border rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm">
            <div class="flex items-center gap-3 pb-4 border-b" style="border-color: var(--border-color);">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center font-mono font-bold text-xs" style="background-color: var(--brand-primary); color: var(--text-on-primary);">1</span>
                <div>
                    <h3 class="font-bold text-base" style="color: var(--text-main);">Headline & Category Details</h3>
                    <p class="text-xs" style="color: var(--text-muted);">Article ka main title aur categorization set karein</p>
                </div>
            </div>

            <!-- Headline / Title -->
            <div>
                <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                    Article Title / Headline <span style="color: var(--brand-rose);">*</span>
                </label>
                <input type="text" name="title" id="articleTitle" value="{{ old('title') }}" required 
                       placeholder="e.g. Modern CSS Architecture: Container Queries and Cascade Layers" 
                       class="theme-input w-full px-4 py-3.5 rounded-2xl font-serif text-xl font-bold placeholder-opacity-50 transition-all border">
            </div>

            <!-- Meta Controls: Category, Author, Kicker, Reading Time -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                        Topic Category <span style="color: var(--brand-rose);">*</span>
                    </label>
                    <select name="category_id" required class="theme-input w-full px-3.5 py-3 rounded-xl text-xs border">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                        Author Byline <span style="color: var(--brand-rose);">*</span>
                    </label>
                    <select name="user_id" required class="theme-input w-full px-3.5 py-3 rounded-xl text-xs border">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('user_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }} ({{ ucfirst($author->role) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                        Topic Kicker / Tag
                    </label>
                    <input type="text" name="kicker" value="{{ old('kicker', 'Engineering Masterclass') }}" placeholder="e.g. Modern CSS" 
                           class="theme-input w-full px-3.5 py-3 rounded-xl text-xs border">
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                        Reading Duration <span style="color: var(--brand-rose);">*</span>
                    </label>
                    <input type="text" name="reading_time" value="{{ old('reading_time', '7 min read') }}" required 
                           class="theme-input w-full px-3.5 py-3 rounded-xl text-xs border">
                </div>
            </div>
        </div>

        <!-- STEP 2: Cover Image Upload -->
        <div class="theme-surface border rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm">
            <div class="flex items-center gap-3 pb-4 border-b" style="border-color: var(--border-color);">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center font-mono font-bold text-xs" style="background-color: var(--brand-primary); color: var(--text-on-primary);">2</span>
                <div>
                    <h3 class="font-bold text-base" style="color: var(--text-main);">Cover Image Upload (Folder: public/assets/uploads/articles/)</h3>
                    <p class="text-xs" style="color: var(--text-muted);">Apne computer se file upload karein ya image URL paste karein</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Option A: File Upload -->
                <div class="p-5 rounded-2xl border theme-surface-soft space-y-3" style="border-color: var(--border-color);">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-mono uppercase tracking-wider font-bold" style="color: var(--brand-primary);">
                            Option A: Upload Image File
                        </label>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded" style="background-color: var(--brand-light); color: var(--brand-primary);">Max: 20MB</span>
                    </div>
                    <input type="file" name="cover_image_file" id="coverImageFileInput" accept="image/png,image/jpeg,image/jpg,image/webp,image/gif,image/svg+xml"
                           class="theme-input w-full text-xs file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-mono file:font-bold file:cursor-pointer transition-all border"
                           style="file:background-color: var(--brand-primary); file:color: var(--text-on-primary);">
                    <p class="text-[10px]" style="color: var(--text-muted);">
                        ✓ Supports JPG, PNG, WebP, GIF. Direct save into <code>public/assets/uploads/articles/</code>
                    </p>
                </div>

                <!-- Option B: Direct Image URL -->
                <div class="p-5 rounded-2xl border theme-surface-soft space-y-3" style="border-color: var(--border-color);">
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold" style="color: var(--text-main);">
                        Option B: Or External Image URL
                    </label>
                    <input type="url" name="cover_image_url" id="coverImageUrlInput" value="{{ old('cover_image_url', old('cover_image')) }}" 
                           placeholder="https://images.unsplash.com/photo-..." 
                           class="theme-input w-full px-3.5 py-2.5 rounded-xl text-xs border">
                    <p class="text-[10px]" style="color: var(--text-muted);">
                        Optional: Direct Unsplash or CDN URL agar upload nahi karni.
                    </p>
                </div>
            </div>

            <!-- Live Image Preview Box -->
            <div id="imagePreviewContainer" class="p-4 rounded-2xl border theme-surface-soft flex items-center gap-4 hidden" style="border-color: var(--border-color);">
                <img id="imagePreviewImg" src="" alt="Selected Preview" class="w-28 h-20 rounded-xl object-cover border" style="border-color: var(--border-color);">
                <div class="space-y-1 text-xs">
                    <div class="font-bold flex items-center gap-2" style="color: var(--brand-primary);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span id="imagePreviewTitle">Selected Cover Image</span>
                    </div>
                    <div id="imagePreviewMeta" class="text-[11px] font-mono" style="color: var(--text-muted);"></div>
                </div>
            </div>

            <!-- Image Caption -->
            <div>
                <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                    Image Caption / Credit Byline
                </label>
                <input type="text" name="cover_caption" value="{{ old('cover_caption') }}" 
                       placeholder="e.g. Photography via Unsplash / Illustration by Smashing Studio" 
                       class="theme-input w-full px-4 py-2.5 rounded-xl text-xs border">
            </div>
        </div>

        <!-- STEP 3: Summary Excerpt & Body Content -->
        <div class="theme-surface border rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm">
            <div class="flex items-center gap-3 pb-4 border-b" style="border-color: var(--border-color);">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center font-mono font-bold text-xs" style="background-color: var(--brand-primary); color: var(--text-on-primary);">3</span>
                <div>
                    <h3 class="font-bold text-base" style="color: var(--text-main);">Article Excerpt & Full Body Content</h3>
                    <p class="text-xs" style="color: var(--text-muted);">Post ka brief teaser aur detailed reading article likhein</p>
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                    Brief Excerpt / Lead Summary <span style="color: var(--brand-rose);">*</span>
                </label>
                <textarea name="excerpt" rows="2" required 
                          placeholder="Short 2-line overview shown on category feeds, search results, and cards..." 
                          class="theme-input w-full px-4 py-3 rounded-2xl text-xs leading-relaxed border">{{ old('excerpt') }}</textarea>
            </div>

            <!-- Content Body -->
            <div>
                <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                    Full Article Content Body <span style="color: var(--brand-rose);">*</span>
                </label>
                <textarea name="content" rows="12" required 
                          placeholder="Write your tutorial or article here. Supports HTML formatting like <h2>, <p>, <code>, <pre>..." 
                          class="theme-input w-full p-4 rounded-2xl font-mono text-xs leading-relaxed border">{{ old('content') }}</textarea>
            </div>
        </div>

        <!-- STEP 4: Publishing Settings & Flags -->
        <div class="theme-surface border rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm">
            <div class="flex items-center gap-3 pb-4 border-b" style="border-color: var(--border-color);">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center font-mono font-bold text-xs" style="background-color: var(--brand-primary); color: var(--text-on-primary);">4</span>
                <div>
                    <h3 class="font-bold text-base" style="color: var(--text-main);">Publishing Status & Editorial Badges</h3>
                    <p class="text-xs" style="color: var(--text-muted);">Post ko foran live karna hai ya draft rakhna hai</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Status -->
                <div class="p-4 rounded-2xl border theme-surface-soft" style="border-color: var(--border-color);">
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-2" style="color: var(--text-main);">
                        Status
                    </label>
                    <select name="status" class="theme-input w-full px-3 py-2 rounded-xl text-xs border">
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Live Site)</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Private)</option>
                    </select>
                </div>

                <!-- Hero Spotlight -->
                <div class="p-4 rounded-2xl border theme-surface-soft flex items-center gap-3" style="border-color: var(--border-color);">
                    <input type="checkbox" name="is_hero" value="1" id="is_hero" {{ old('is_hero') ? 'checked' : '' }} class="w-4 h-4 rounded text-orange-600">
                    <label for="is_hero" class="text-xs font-mono font-bold cursor-pointer" style="color: var(--text-main);">
                        Hero Spotlight (Homepage top)
                    </label>
                </div>

                <!-- Featured -->
                <div class="p-4 rounded-2xl border theme-surface-soft flex items-center gap-3" style="border-color: var(--border-color);">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 rounded text-orange-600">
                    <label for="is_featured" class="text-xs font-mono font-bold cursor-pointer" style="color: var(--text-main);">
                        Featured Dispatch
                    </label>
                </div>

                <!-- Guide -->
                <div class="p-4 rounded-2xl border theme-surface-soft flex items-center gap-3" style="border-color: var(--border-color);">
                    <input type="checkbox" name="is_guide" value="1" id="is_guide" {{ old('is_guide') ? 'checked' : '' }} class="w-4 h-4 rounded text-orange-600">
                    <label for="is_guide" class="text-xs font-mono font-bold cursor-pointer" style="color: var(--text-main);">
                        Guide Series
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex items-center justify-end gap-4 border-t" style="border-color: var(--border-color);">
                <a href="{{ route('admin.articles.index') }}" class="px-5 py-3 rounded-xl text-xs font-mono font-bold hover:underline" style="color: var(--text-muted);">
                    Cancel
                </a>
                <button type="submit" class="theme-primary-btn px-8 py-3.5 rounded-2xl font-mono font-bold text-xs uppercase tracking-wider shadow-lg">
                    ✓ Save & Publish Blog Post
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('coverImageFileInput');
    const urlInput = document.getElementById('coverImageUrlInput');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImg = document.getElementById('imagePreviewImg');
    const previewTitle = document.getElementById('imagePreviewTitle');
    const previewMeta = document.getElementById('imagePreviewMeta');

    if (fileInput) {
        fileInput.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (file) {
                if (file.size > 20 * 1024 * 1024) {
                    alert('Warning: File size is ' + (file.size / (1024 * 1024)).toFixed(2) + 'MB. Maximum allowed is 20MB.');
                }
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewTitle.textContent = file.name;
                    previewMeta.textContent = (file.size / 1024).toFixed(1) + ' KB • ' + file.type;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (urlInput) {
        urlInput.addEventListener('input', function () {
            if (this.value && this.value.startsWith('http') && (!fileInput.files || !fileInput.files.length)) {
                previewImg.src = this.value;
                previewTitle.textContent = 'Remote URL Image';
                previewMeta.textContent = this.value;
                previewContainer.classList.remove('hidden');
            }
        });
    }
});
</script>
@endsection
