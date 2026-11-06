<?php $__env->startSection('title', 'Edit: ' . $article->title); ?>
<?php $__env->startSection('page_title', 'Update Article Dispatch'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation Breadcrumbs -->
    <div class="flex items-center justify-between">
        <a href="<?php echo e(route('admin.articles.index')); ?>" class="text-xs font-mono text-slate-400 hover:text-white flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Articles Roster
        </a>
        <a href="<?php echo e(route('articles.show', $article->slug)); ?>" target="_blank" class="text-xs font-mono bg-indigo-500/10 text-indigo-400 hover:text-indigo-300 px-3 py-1.5 rounded-full font-bold flex items-center gap-1.5 transition-colors">
            <span>View Live Article</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="p-5 bg-rose-950/80 border border-rose-500/50 text-rose-200 rounded-2xl text-xs font-mono shadow-lg">
            <div class="font-bold flex items-center gap-2 text-rose-400 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Please resolve the following errors:
            </div>
            <ul class="list-disc pl-5 space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.articles.update', $article->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 space-y-8 shadow-xl">
            
            <!-- Headline / Title -->
            <div>
                <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-2">
                    Article Title / Headline <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="title" id="articleTitle" value="<?php echo e(old('title', $article->title)); ?>" required 
                       class="w-full px-4 py-3.5 bg-slate-950 border border-slate-800 rounded-2xl text-white font-serif text-xl font-bold placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>

            <!-- Meta Controls: Category, Author, Kicker, Reading Time -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-2">
                        Topic Category <span class="text-rose-500">*</span>
                    </label>
                    <select name="category_id" required class="w-full px-3.5 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs focus:ring-2 focus:ring-indigo-500">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $article->category_id) == $cat->id ? 'selected' : ''); ?>>
                                <?php echo e($cat->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-2">
                        Author Byline <span class="text-rose-500">*</span>
                    </label>
                    <select name="user_id" required class="w-full px-3.5 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs focus:ring-2 focus:ring-indigo-500">
                        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($author->id); ?>" <?php echo e(old('user_id', $article->user_id) == $author->id ? 'selected' : ''); ?>>
                                <?php echo e($author->name); ?> (<?php echo e(ucfirst($author->role)); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-2">
                        Topic Kicker / Tag
                    </label>
                    <input type="text" name="kicker" value="<?php echo e(old('kicker', $article->kicker)); ?>" 
                           class="w-full px-3.5 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-2">
                        Reading Duration <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="reading_time" value="<?php echo e(old('reading_time', $article->reading_time)); ?>" required 
                           class="w-full px-3.5 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <!-- Image Upload Section (Saved into public/assets/uploads/articles) -->
            <div class="p-6 bg-slate-950/70 border border-slate-800 rounded-2xl space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider font-bold text-indigo-400">
                            Cover Image (File Upload to public/assets/uploads/articles)
                        </label>
                        <p class="text-[11px] text-slate-400 mt-0.5">Upload a new image file to replace the current cover, or update image URL</p>
                    </div>
                    <span class="text-[10px] font-mono bg-slate-800 text-slate-300 px-2.5 py-1 rounded-full">Max: 10MB</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-center">
                    <!-- File input -->
                    <div>
                        <label class="block text-xs font-mono text-slate-300 mb-1.5 font-semibold">Replace With Image File</label>
                        <input type="file" name="cover_image_file" id="coverImageFileInput" accept="image/*" 
                               onchange="previewUploadedImage(this)"
                               class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-mono file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 file:cursor-pointer cursor-pointer border border-slate-800 rounded-xl bg-slate-900 p-1">
                    </div>

                    <!-- URL input -->
                    <div>
                        <label class="block text-xs font-mono text-slate-300 mb-1.5 font-semibold">Or Image URL</label>
                        <input type="text" name="cover_image_url" id="coverImageUrlInput" value="<?php echo e(old('cover_image_url', $article->cover_image)); ?>" 
                               oninput="previewUrlImage(this.value)"
                               class="w-full px-3.5 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-white text-xs font-mono focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <!-- Current Image Preview -->
                <div id="imagePreviewContainer" class="mt-3 pt-3 border-t border-slate-800/80 flex items-center gap-4">
                    <img id="imagePreview" src="<?php echo e($article->cover_image_url); ?>" alt="<?php echo e($article->title); ?>" class="w-36 h-24 object-cover rounded-xl border border-slate-700 shadow-md">
                    <div>
                        <p class="text-xs font-bold text-white" id="imagePreviewName">Current Cover Image</p>
                        <p class="text-[11px] font-mono text-slate-400 truncate max-w-sm"><?php echo e($article->cover_image); ?></p>
                    </div>
                </div>

                <!-- Caption -->
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-slate-400 mb-1">
                        Image Caption & Attribution
                    </label>
                    <input type="text" name="cover_caption" value="<?php echo e(old('cover_caption', $article->cover_caption)); ?>" placeholder="e.g. Visualizing component fluid constraints across parent breakpoints." 
                           class="w-full px-3.5 py-2 bg-slate-900 border border-slate-800 rounded-xl text-white text-xs focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <!-- Excerpt / Summary -->
            <div>
                <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-2">
                    Executive Summary / Excerpt <span class="text-rose-500">*</span>
                </label>
                <textarea name="excerpt" rows="2" required 
                          class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-sm focus:ring-2 focus:ring-indigo-500"><?php echo e(old('excerpt', $article->excerpt)); ?></textarea>
            </div>

            <!-- Tags -->
            <div>
                <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-2">
                    Topic Tags (Comma Separated)
                </label>
                <?php
                    $tagsString = is_array($article->tags) ? implode(', ', $article->tags) : (string)$article->tags;
                ?>
                <input type="text" name="tags" value="<?php echo e(old('tags', $tagsString)); ?>" placeholder="CSS, React, Accessibility, Design Tokens" 
                       class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-mono focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Article Body Content with Formatting Toolbar -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300">
                        Article Body HTML / Content <span class="text-rose-500">*</span>
                    </label>
                    <span class="text-[11px] font-mono text-indigo-400">Use &lt;h2&gt; for automatic Table of Contents</span>
                </div>

                <!-- Quick Formatting Toolbar -->
                <div class="bg-slate-950 border border-slate-800 border-b-0 rounded-t-2xl p-2 flex flex-wrap items-center gap-1.5 text-xs font-mono">
                    <button type="button" onclick="insertTag('<h2>', '</h2>')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg font-bold">H2 Heading</button>
                    <button type="button" onclick="insertTag('<h3>', '</h3>')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg font-bold">H3 Heading</button>
                    <button type="button" onclick="insertTag('<p>', '</p>')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg">Paragraph</button>
                    <button type="button" onclick="insertTag('<strong>', '</strong>')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg font-bold">Bold</button>
                    <button type="button" onclick="insertTag('<em>', '</em>')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg italic">Italic</button>
                    <button type="button" onclick="insertTag('<pre><code>', '</code></pre>')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-amber-300 rounded-lg font-bold">Code Block</button>
                    <button type="button" onclick="insertTag('<blockquote class=\"smashing-quote\">', '</blockquote>')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-indigo-300 rounded-lg">Quote</button>
                    <button type="button" onclick="insertTag('<ul>\n  <li>', '</li>\n</ul>')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg">List</button>
                </div>

                <textarea name="content" id="articleContent" rows="18" required 
                          class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-b-2xl text-white font-mono text-xs focus:ring-2 focus:ring-indigo-500 leading-relaxed"><?php echo e(old('content', $article->content)); ?></textarea>
            </div>

            <!-- Featured Toggles & Publishing Controls -->
            <div class="pt-6 border-t border-slate-800 flex flex-wrap items-center justify-between gap-6">
                <div class="flex flex-wrap items-center gap-6">
                    <label class="flex items-center gap-2.5 cursor-pointer text-xs font-mono text-slate-300 bg-slate-950 px-3.5 py-2 rounded-xl border border-slate-800 hover:border-amber-500/50 transition-colors">
                        <input type="checkbox" name="is_hero" value="1" <?php echo e(old('is_hero', $article->is_hero) ? 'checked' : ''); ?> class="rounded bg-slate-900 border-slate-700 text-amber-500 focus:ring-amber-500">
                        <span class="font-bold text-amber-400">★ Lead Hero Story</span>
                    </label>

                    <label class="flex items-center gap-2.5 cursor-pointer text-xs font-mono text-slate-300 bg-slate-950 px-3.5 py-2 rounded-xl border border-slate-800 hover:border-indigo-500/50 transition-colors">
                        <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured', $article->is_featured) ? 'checked' : ''); ?> class="rounded bg-slate-900 border-slate-700 text-indigo-500 focus:ring-indigo-500">
                        <span class="font-bold text-indigo-300">Pinned Top 3 Feature</span>
                    </label>

                    <label class="flex items-center gap-2.5 cursor-pointer text-xs font-mono text-slate-300 bg-slate-950 px-3.5 py-2 rounded-xl border border-slate-800 hover:border-emerald-500/50 transition-colors">
                        <input type="checkbox" name="is_guide" value="1" <?php echo e(old('is_guide', $article->is_guide) ? 'checked' : ''); ?> class="rounded bg-slate-900 border-slate-700 text-emerald-500 focus:ring-emerald-500">
                        <span class="font-bold text-emerald-300">Definitive Guide Track</span>
                    </label>
                </div>

                <div class="flex items-center gap-3">
                    <select name="status" class="px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-mono focus:ring-2 focus:ring-indigo-500">
                        <option value="published" <?php echo e(old('status', $article->status) == 'published' ? 'selected' : ''); ?>>Published</option>
                        <option value="draft" <?php echo e(old('status', $article->status) == 'draft' ? 'selected' : ''); ?>>Draft</option>
                    </select>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-7 py-3 rounded-xl font-mono font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-indigo-600/30 cursor-pointer border-0">
                        Update Article →
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>

<script>
    function previewUploadedImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreviewName').textContent = 'New Upload Selected: ' + input.files[0].name;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewUrlImage(url) {
        if (url && url.length > 5) {
            document.getElementById('imagePreview').src = url;
            document.getElementById('imagePreviewName').textContent = 'Remote URL Image';
        }
    }

    function insertTag(openTag, closeTag) {
        const textarea = document.getElementById('articleContent');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);
        const replacement = openTag + (selectedText || 'Content') + closeTag;
        textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
        textarea.focus();
        textarea.selectionStart = start + openTag.length;
        textarea.selectionEnd = start + replacement.length - closeTag.length;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/admin/articles/edit.blade.php ENDPATH**/ ?>