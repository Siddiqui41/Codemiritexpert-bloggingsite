<?php $__env->startSection('title', 'Manage Articles'); ?>
<?php $__env->startSection('page_title', 'All Articles & Blog Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    
    <!-- Filter and Search Header -->
    <div class="theme-surface border rounded-3xl p-6 shadow-sm">
        <form action="<?php echo e(route('admin.articles.index')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-6 relative">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by title, headline or keywords..." 
                       class="theme-input w-full pl-10 pr-4 py-2.5 rounded-xl text-xs border">
                <svg class="w-4 h-4 opacity-50 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <div class="md:col-span-4">
                <select name="category" class="theme-input w-full px-4 py-2.5 rounded-xl text-xs border">
                    <option value="">All Topics (Categories)</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
                            <?php echo e($cat->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="theme-primary-btn flex-1 rounded-xl font-mono font-bold text-xs uppercase tracking-wider py-2.5 shadow-sm">
                    Filter
                </button>
                <?php if(request('search') || request('category')): ?>
                    <a href="<?php echo e(route('admin.articles.index')); ?>" class="px-3 py-2.5 border rounded-xl text-xs font-mono flex items-center justify-center hover:opacity-80" style="border-color: var(--border-color); color: var(--text-muted);">
                        Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Articles Table Card -->
    <div class="theme-surface border rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b text-[11px] font-mono uppercase tracking-wider theme-surface-soft" style="border-color: var(--border-color); color: var(--text-muted);">
                        <th class="py-4 px-6">Article Headline & Slug</th>
                        <th class="py-4 px-4">Topic</th>
                        <th class="py-4 px-4">Author</th>
                        <th class="py-4 px-4">Reads / Claps</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-xs" style="border-color: var(--border-color);">
                    <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:opacity-90 transition-opacity">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3.5">
                                <img src="<?php echo e($article->cover_image_url); ?>" alt="<?php echo e($article->title); ?>" class="w-16 h-12 rounded-xl object-cover border shrink-0 shadow-sm" style="border-color: var(--border-color);">
                                <div class="min-w-0">
                                    <div class="font-serif font-bold text-sm hover:underline line-clamp-1" style="color: var(--text-main);">
                                        <a href="<?php echo e(route('articles.show', $article->slug)); ?>" target="_blank">
                                            <?php echo e($article->title); ?>

                                        </a>
                                    </div>
                                    <div class="text-[11px] font-mono mt-0.5 flex items-center gap-2" style="color: var(--text-muted);">
                                        <span>/articles/<?php echo e($article->slug); ?></span>
                                        <span>•</span>
                                        <span><?php echo e($article->reading_time); ?></span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase" style="background-color: <?php echo e($article->category->accent_color); ?>20; color: <?php echo e($article->category->accent_color); ?>;">
                                <span class="w-1.5 h-1.5 rounded-full" style="background-color: <?php echo e($article->category->accent_color); ?>;"></span>
                                <?php echo e($article->category->name); ?>

                            </span>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap" style="color: var(--text-main);">
                            <?php echo e($article->author->name); ?>

                        </td>

                        <td class="py-4 px-4 whitespace-nowrap font-mono text-[11px]" style="color: var(--text-muted);">
                            <span>👁️ <?php echo e(number_format($article->views_count)); ?></span>
                            <span class="mx-1">•</span>
                            <span>👏 <?php echo e(number_format($article->claps_count)); ?></span>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-mono uppercase font-bold" style="<?php echo e($article->status === 'published' ? 'background-color: rgba(91, 158, 120, 0.15); color: var(--brand-emerald);' : 'background-color: rgba(242, 204, 143, 0.15); color: var(--brand-amber);'); ?>">
                                <?php echo e($article->status); ?>

                            </span>
                        </td>

                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="<?php echo e(route('articles.show', $article->slug)); ?>" target="_blank" title="View live" class="p-2 border rounded-xl hover:opacity-80 transition-opacity" style="border-color: var(--border-color); color: var(--text-muted);">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>

                                <a href="<?php echo e(route('admin.articles.edit', $article->id)); ?>" class="theme-primary-btn px-3 py-1.5 rounded-xl font-mono text-xs font-bold shadow-sm">
                                    Edit ✏️
                                </a>

                                <form action="<?php echo e(route('admin.articles.destroy', $article->id)); ?>" method="POST" onsubmit="return confirm('Kya aap waqai yeh article delete karna chahte hain?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-2 rounded-xl text-rose-500 hover:bg-rose-500/10 transition-colors" title="Delete Article">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="py-12 text-center text-xs" style="color: var(--text-muted);">
                            Koi article match nahi hua. <a href="<?php echo e(route('admin.articles.create')); ?>" class="underline font-bold" style="color: var(--brand-primary);">Naya blog post banayein</a>.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($articles->hasPages()): ?>
        <div class="p-4 border-t theme-surface-soft" style="border-color: var(--border-color);">
            <?php echo e($articles->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/admin/articles/index.blade.php ENDPATH**/ ?>