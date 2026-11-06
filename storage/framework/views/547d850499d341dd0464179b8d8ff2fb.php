<?php $__env->startSection('title', $category->name . ' — DEV Editorial'); ?>
<?php $__env->startSection('meta_description', $category->description ?? 'Explore in-depth articles, tutorials, and practical guides on ' . $category->name . '.'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-10">
    <div class="container">
        
        <!-- 1. Category Hero Card (Solid var(--hero-bg) with perfect contrast) -->
        <div class="category-hero-card" style="border-top-color: <?php echo e($category->accent_color); ?>;">
            <div style="max-width: 760px;">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: rgba(255, 255, 255, 0.16); padding: 0.35rem 0.85rem; border-radius: 9999px; margin-bottom: 1.25rem;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background-color: <?php echo e($category->accent_color); ?>;"></span>
                    <span class="label-mono" style="color: var(--on-hero);">Curated Topic Track</span>
                </div>

                <h1 class="category-hero-title">
                    <?php echo e($category->name); ?>

                </h1>

                <p class="category-hero-subtitle">
                    <?php echo e($category->description ?? 'Carefully curated practical tutorials, deep architectural dives, and masterclasses dedicated to ' . $category->name . '.'); ?>

                </p>

                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; font-size: 13.5px; color: var(--on-hero-muted);">
                    <span class="category-badge-chip">
                        <strong style="color: var(--on-hero);"><?php echo e($articles->total()); ?></strong> Published Articles
                    </span>
                    <span>•</span>
                    <span>Updated regularly by industry practitioners</span>
                </div>
            </div>
        </div>

        <!-- 2. "SWITCH TOPIC" Row with High Contrast and Thin Scrollbar -->
        <div class="switch-topic-row">
            <span class="label-mono" style="margin-right: 0.5rem; flex-shrink: 0;">Switch Topic:</span>
            <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isActive = ($cat->id === $category->id);
                ?>
                <a href="<?php echo e(route('category.show', $cat->slug)); ?>" 
                   class="switch-topic-pill <?php echo e($isActive ? 'active' : ''); ?>">
                   <span style="width: 8px; height: 8px; border-radius: 50%; background-color: <?php echo e($cat->accent_color); ?>; display: inline-block;"></span>
                   <span><?php echo e($cat->name); ?></span>
                   <span class="topic-count">(<?php echo e($cat->articles_count); ?>)</span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- 3. Articles Grid -->
        <?php if($articles->count() > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 3.5rem;">
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="smash-card" style="border-top-color: <?php echo e($category->accent_color); ?>; padding: 1.5rem;">
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
                            <span style="display: inline-flex; align-items: center; gap: 0.35rem;">
                                <span style="width: 7px; height: 7px; border-radius: 50%; background-color: <?php echo e($category->accent_color); ?>; display: inline-block;"></span>
                                <span class="label-mono" style="color: var(--primary);"><?php echo e($article->kicker ?? $category->name); ?></span>
                            </span>
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

            <!-- Pagination -->
            <div style="margin-top: 2rem; display: flex; justify-content: center;">
                <?php echo e($articles->links()); ?>

            </div>
        <?php else: ?>
            <!-- Clean Empty State -->
            <div style="background-color: var(--surface); border-radius: 16px; padding: 3.5rem 2rem; text-align: center; border: 1px solid var(--border); max-width: 580px; margin: 3rem auto;">
                <div style="width: 56px; height: 56px; background-color: var(--chip-bg); color: var(--chip-text); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; font-size: 26px;">
                    ✍️
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 800; color: var(--heading); margin-bottom: 0.75rem;">Editorial Drafts in Progress</h3>
                <p style="color: var(--muted); font-size: 15px; margin-bottom: 1.75rem; line-height: 1.6;">Our editors are writing masterclasses for <?php echo e($category->name); ?>. In the meantime, explore our other engineering topics or subscribe to be notified when new articles drop.</p>
                <a href="<?php echo e(route('home')); ?>" class="btn-smash">
                    ← Back to All Topics
                </a>
            </div>
        <?php endif; ?>

        <!-- Newsletter Callout Box -->
        <div style="margin-top: 4rem; background-color: var(--surface-2); border-radius: 20px; padding: 3rem 2.5rem; border: 1px solid var(--border);">
            <div style="max-width: 640px;">
                <span class="label-mono" style="color: var(--primary); display: block; margin-bottom: 0.5rem;">Never miss a <?php echo e($category->name); ?> breakdown</span>
                <h3 style="font-size: 1.85rem; font-weight: 800; color: var(--heading); margin-bottom: 0.75rem;">Delivered straight to your inbox every Tuesday</h3>
                <p style="color: var(--text); font-size: 15px; margin-bottom: 1.75rem; line-height: 1.6;">No spam, no promotional filler. Just clean code snippets, design heuristics, and front-end architectural gems.</p>
                
                <form action="<?php echo e(route('newsletter.subscribe')); ?>" method="POST" style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" required placeholder="Enter your developer email..." 
                           style="flex: 1; min-width: 240px; padding: 0.75rem 1.15rem; border-radius: 8px; background-color: var(--surface); border: 1px solid var(--border); color: var(--text); font-size: 14.5px; outline: none;">
                    <button type="submit" class="btn-smash" style="padding: 0.75rem 1.5rem;">
                        Subscribe Free
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/category/show.blade.php ENDPATH**/ ?>