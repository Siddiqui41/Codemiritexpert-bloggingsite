<?php $__env->startSection('title', ($query ? 'Search: "' . $query . '"' : 'Search Articles') . ' — DEV Editorial'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-10">
    <div class="container">
        
        <!-- Search Header & Filter Bar -->
        <div style="background-color: var(--surface); border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border); margin-bottom: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
            <span class="label-mono" style="color: var(--primary); display: block; margin-bottom: 0.5rem;">Editorial Search Engine</span>
            <h1 style="font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 800; color: var(--heading); margin-bottom: 1.5rem;">
                <?php if($query): ?>
                    Search results for <span style="color: var(--primary); font-style: italic;">"<?php echo e($query); ?>"</span>
                <?php else: ?>
                    Search Articles & Tutorials
                <?php endif; ?>
            </h1>

            <form action="<?php echo e(route('articles.search')); ?>" method="GET" style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 1rem;" class="search-form-grid">
                <div style="grid-column: span 8; position: relative;">
                    <input type="text" name="q" value="<?php echo e($query); ?>" placeholder="Search by topic, CSS trick, React pattern, or author..." 
                           style="width: 100%; padding: 0.85rem 1rem 0.85rem 2.75rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; outline: none;">
                    <svg style="width: 18px; height: 18px; color: var(--muted); position: absolute; left: 14px; top: 50%; transform: translateY(-50%); pointer-events: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
                
                <div style="grid-column: span 3;">
                    <select name="category" style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14px; outline: none; cursor: pointer;">
                        <option value="all">All Topics (Any)</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->slug); ?>" <?php echo e($categorySlug === $cat->slug ? 'selected' : ''); ?>>
                                <?php echo e($cat->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div style="grid-column: span 1;">
                    <button type="submit" class="btn-smash" style="width: 100%; height: 100%; border-radius: 8px; padding: 0.85rem 0;">
                        Go
                    </button>
                </div>
            </form>

            <div style="margin-top: 1.25rem; display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem;">
                <span class="label-mono" style="margin-right: 0.25rem;">Popular Queries:</span>
                <a href="<?php echo e(route('articles.search', ['q' => 'Container Queries'])); ?>" style="padding: 0.25rem 0.65rem; background-color: var(--chip-bg); color: var(--chip-text); border-radius: 9999px; font-size: 13px; font-weight: 600; text-decoration: none;">Container Queries</a>
                <a href="<?php echo e(route('articles.search', ['q' => 'Server Actions'])); ?>" style="padding: 0.25rem 0.65rem; background-color: var(--chip-bg); color: var(--chip-text); border-radius: 9999px; font-size: 13px; font-weight: 600; text-decoration: none;">React 19 Actions</a>
                <a href="<?php echo e(route('articles.search', ['q' => 'Design Tokens'])); ?>" style="padding: 0.25rem 0.65rem; background-color: var(--chip-bg); color: var(--chip-text); border-radius: 9999px; font-size: 13px; font-weight: 600; text-decoration: none;">Design Tokens</a>
                <a href="<?php echo e(route('articles.search', ['q' => 'Burnout'])); ?>" style="padding: 0.25rem 0.65rem; background-color: var(--chip-bg); color: var(--chip-text); border-radius: 9999px; font-size: 13px; font-weight: 600; text-decoration: none;">Remote Burnout</a>
                <a href="<?php echo e(route('articles.search', ['q' => 'Vue 3.5'])); ?>" style="padding: 0.25rem 0.65rem; background-color: var(--chip-bg); color: var(--chip-text); border-radius: 9999px; font-size: 13px; font-weight: 600; text-decoration: none;">Vue 3.5</a>
            </div>
        </div>

        <!-- Search Results Count -->
        <div style="margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
            <p style="font-size: 14.5px; color: var(--muted); margin: 0;">
                Found <strong style="color: var(--heading); font-weight: 700;"><?php echo e($articles->total()); ?></strong> matched published articles
            </p>
        </div>

        <!-- Results List -->
        <?php if($articles->count() > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="smash-card" style="border-top-color: <?php echo e($article->category->accent_color); ?>; padding: 1.5rem;">
                    <div style="display: flex; flex-direction: column; flex-grow: 1;">
                        <!-- Cover Image -->
                        <?php if($article->cover_image): ?>
                        <a href="<?php echo e(route('articles.show', $article->slug)); ?>" style="display: block; overflow: hidden; border-radius: 8px; margin-bottom: 1.25rem;">
                            <img src="<?php echo e($article->cover_image_url); ?>" 
                                 alt="<?php echo e($article->title); ?>" 
                                 style="width: 100%; height: 180px; object-fit: cover; transition: transform 250ms ease;" 
                                 onmouseover="this.style.transform='scale(1.03)'" 
                                 onmouseout="this.style.transform='scale(1)'"
                                 loading="lazy">
                        </a>
                        <?php endif; ?>

                        <!-- Meta header -->
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.65rem;">
                            <a href="<?php echo e(route('category.show', $article->category->slug)); ?>" style="display: inline-flex; align-items: center; gap: 0.35rem; text-decoration: none;">
                                <span style="width: 7px; height: 7px; border-radius: 50%; background-color: <?php echo e($article->category->accent_color); ?>; display: inline-block;"></span>
                                <span class="label-mono" style="color: var(--primary);"><?php echo e($article->category->name); ?></span>
                            </a>
                            <span style="display: flex; align-items: center; gap: 0.35rem; font-size: 13px; color: var(--muted);">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <?php echo e($article->reading_time); ?>

                            </span>
                        </div>

                        <!-- Title -->
                        <h2 style="font-size: 1.35rem; font-weight: 700; line-height: 1.3; margin-bottom: 0.75rem;">
                            <a href="<?php echo e(route('articles.show', $article->slug)); ?>" style="color: var(--heading); text-decoration: none;">
                                <?php echo e($article->title); ?>

                            </a>
                        </h2>

                        <!-- Excerpt -->
                        <p style="font-size: 15px; color: var(--text); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            <?php echo e($article->excerpt); ?>

                        </p>
                    </div>

                    <!-- Author Footer -->
                    <div style="padding-top: 1rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; margin-top: auto;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <img src="<?php echo e($article->author->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80'); ?>" 
                                 alt="<?php echo e($article->author->name); ?>" 
                                 style="width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border);">
                            <div>
                                <p style="font-size: 13.5px; font-weight: 700; color: var(--heading); margin: 0;"><?php echo e($article->author->name); ?></p>
                                <p class="label-mono" style="font-size: 12px; color: var(--muted); margin: 0;"><?php echo e($article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y')); ?></p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.85rem; font-size: 13px; color: var(--muted);">
                            <span style="display: flex; align-items: center; gap: 0.3rem;" title="Comments">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <?php echo e($article->comments->count()); ?>

                            </span>
                            <span style="display: flex; align-items: center; gap: 0.3rem; font-weight: 700; color: var(--primary);" title="Claps">
                                👏 <?php echo e($article->claps_count); ?>

                            </span>
                        </div>
                    </div>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div style="margin-top: 2rem; display: flex; justify-content: center;">
                <?php echo e($articles->links()); ?>

            </div>
        <?php else: ?>
            <div style="background-color: var(--surface); border-radius: 16px; padding: 3.5rem 2rem; text-align: center; border: 1px solid var(--border); max-width: 520px; margin: 3rem auto;">
                <div style="width: 56px; height: 56px; background-color: var(--surface-2); color: var(--muted); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; font-size: 26px;">
                    🔍
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 800; color: var(--heading); margin-bottom: 0.75rem;">No articles matched your query</h3>
                <p style="color: var(--muted); font-size: 14.5px; margin-bottom: 1.75rem; line-height: 1.6;">Try searching for broader keywords such as "CSS", "Performance", "React", or "Accessibility", or clear filters.</p>
                <a href="<?php echo e(route('articles.search')); ?>" class="btn-smash">
                    Clear Search Filters
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
  @media (max-width: 768px) {
    .search-form-grid {
      grid-template-columns: 1fr !important;
    }
    .search-form-grid > div {
      grid-column: span 1 !important;
    }
  }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/articles/search.blade.php ENDPATH**/ ?>