<?php $__env->startSection('title', 'DEV Guides — Master Handbooks & Curated Tracks'); ?>
<?php $__env->startSection('meta_description', 'Exhaustive step-by-step guides and curated learning tracks for modern frontend architects and UI designers.'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-10">
    <div class="container">
        
        <!-- Header -->
        <div class="category-hero-card" style="margin-bottom: 3rem;">
            <div style="max-width: 760px;">
                <span class="label-mono" style="color: var(--on-hero); display: inline-block; background-color: rgba(255, 255, 255, 0.16); padding: 0.35rem 0.85rem; border-radius: 9999px; margin-bottom: 1.25rem;">
                    Editorial Special Track
                </span>
                <h1 class="category-hero-title">
                    Definitive Engineering Guides
                </h1>
                <p class="category-hero-subtitle">
                    Hand-picked, evergreen collections and in-depth reference manuals written by industry practitioners to guide your architectural decisions.
                </p>
                <div style="display: flex; align-items: center; gap: 1rem; font-size: 13.5px; color: var(--on-hero-muted);">
                    <span class="category-badge-chip">
                        <strong style="color: var(--on-hero);"><?php echo e($guides->total()); ?></strong> Curated Guides
                    </span>
                    <span>•</span>
                    <span>Free & Community-Reviewed</span>
                </div>
            </div>
        </div>

        <!-- Guides Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 3.5rem;">
            <?php $__empty_1 = true; $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="smash-card" style="border-top-color: <?php echo e($guide->category->accent_color); ?>; padding: 1.5rem;">
                <div style="display: flex; flex-direction: column; flex-grow: 1;">
                    <a href="<?php echo e(route('articles.show', $guide->slug)); ?>" style="display: block; overflow: hidden; border-radius: 8px; margin-bottom: 1.25rem; position: relative;">
                        <img src="<?php echo e($guide->cover_image_url); ?>" 
                             alt="<?php echo e($guide->title); ?>" 
                             style="width: 100%; height: 180px; object-fit: cover; transition: transform 250ms ease;"
                             onmouseover="this.style.transform='scale(1.03)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <span style="position: absolute; top: 10px; left: 10px; background-color: var(--surface); color: var(--heading); font-family: var(--font-mono); font-size: 11px; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 6px; border: 1px solid var(--border);">
                            ★ Comprehensive Guide
                        </span>
                    </a>

                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.65rem;">
                        <span class="label-mono" style="color: <?php echo e($guide->category->accent_color); ?>;">
                            <?php echo e($guide->category->name); ?>

                        </span>
                        <span style="display: flex; align-items: center; gap: 0.35rem; font-size: 13px; color: var(--muted);">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <?php echo e($guide->reading_time); ?>

                        </span>
                    </div>

                    <h2 style="font-size: 1.35rem; font-weight: 700; line-height: 1.3; margin-bottom: 0.75rem;">
                        <a href="<?php echo e(route('articles.show', $guide->slug)); ?>" style="color: var(--heading); text-decoration: none;">
                            <?php echo e($guide->title); ?>

                        </a>
                    </h2>

                    <p style="font-size: 15px; color: var(--text); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        <?php echo e($guide->excerpt); ?>

                    </p>
                </div>

                <div style="padding-top: 1rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; margin-top: auto;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <img src="<?php echo e($guide->author->avatar); ?>" alt="<?php echo e($guide->author->name); ?>" style="width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border);">
                        <div>
                            <p style="font-size: 13.5px; font-weight: 700; color: var(--heading); margin: 0;"><?php echo e($guide->author->name); ?></p>
                            <p class="label-mono" style="font-size: 12px; color: var(--muted); margin: 0;">Updated <?php echo e($guide->updated_at->format('M Y')); ?></p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('articles.show', $guide->slug)); ?>" style="font-size: 13.5px; font-weight: 700; color: var(--primary); text-decoration: none;">
                        Read Guide →
                    </a>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem 0;">
                <p style="color: var(--muted); font-size: 15px;">No guides found at this time.</p>
            </div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            <?php echo e($guides->links()); ?>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/pages/guides.blade.php ENDPATH**/ ?>