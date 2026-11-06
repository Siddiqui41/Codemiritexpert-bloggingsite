<?php $__env->startSection('title', 'DEV Books — Printed & Digital Editions'); ?>
<?php $__env->startSection('meta_description', 'Explore practical, hands-on design and engineering books by renowned practitioners. Available in hardcover and DRM-free formats.'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-10">
    <div class="container">
        
        <!-- Hero Header -->
        <div class="category-hero-card" style="margin-bottom: 3rem;">
            <div style="max-width: 760px;">
                <span class="label-mono" style="color: var(--on-hero); display: inline-block; background-color: rgba(255, 255, 255, 0.16); padding: 0.35rem 0.85rem; border-radius: 9999px; margin-bottom: 1.25rem;">
                    Printed & Digital Publications
                </span>
                <h1 class="category-hero-title">
                    Practical Books for Serious Craftspeople
                </h1>
                <p class="category-hero-subtitle">
                    Hardcover printed volumes and DRM-free eBooks covering design systems, accessibility, CSS layout architectures, and performance engineering.
                </p>
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1.5rem; font-size: 13.5px; color: var(--on-hero-muted);">
                    <span style="display: flex; align-items: center; gap: 0.4rem;"><strong style="color: var(--on-hero);">✓</strong> Free Worldwide Shipping</span>
                    <span style="display: flex; align-items: center; gap: 0.4rem;"><strong style="color: var(--on-hero);">✓</strong> Instant PDF, ePUB & Kindle</span>
                    <span style="display: flex; align-items: center; gap: 0.4rem;"><strong style="color: var(--on-hero);">✓</strong> Member Discount 20%</span>
                </div>
            </div>
        </div>

        <!-- Books Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background-color: var(--surface); border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border); display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                <div>
                    <!-- Book Cover Mockup -->
                    <div style="position: relative; background-color: var(--surface-2); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border);">
                        <img src="<?php echo e($book->cover_image); ?>" 
                             alt="<?php echo e($book->title); ?>" 
                             style="height: 240px; object-fit: cover; border-radius: 6px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
                        <span style="position: absolute; top: 12px; right: 12px; background-color: var(--primary); color: var(--on-primary); font-family: var(--font-mono); font-size: 12px; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 9999px;">
                            <?php echo e($book->price); ?>

                        </span>
                    </div>

                    <!-- Book Details -->
                    <p class="label-mono" style="color: var(--primary); margin-bottom: 0.5rem;">
                        Written by <?php echo e($book->author); ?>

                    </p>
                    <h2 style="font-size: 1.45rem; font-weight: 800; color: var(--heading); line-height: 1.3; margin-bottom: 0.5rem;">
                        <?php echo e($book->title); ?>

                    </h2>
                    <?php if($book->subtitle): ?>
                        <p style="font-size: 13.5px; font-weight: 600; color: var(--muted); margin-bottom: 0.5rem;"><?php echo e($book->subtitle); ?></p>
                    <?php endif; ?>
                    <p style="color: var(--text); font-size: 14.5px; line-height: 1.6; margin-bottom: 1.5rem;">
                        <?php echo e($book->description); ?>

                    </p>
                </div>

                <div style="padding-top: 1rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; margin-top: auto;">
                    <div>
                        <span class="label-mono" style="display: block; font-size: 11px;">Format:</span>
                        <span style="font-size: 13px; font-weight: 600; color: var(--heading);">Hardcover + eBook</span>
                    </div>
                    <a href="<?php echo e($book->link ?? '#'); ?>" class="btn-smash" style="font-size: 13px; padding: 0.55rem 1.15rem;">
                        Buy Copy (<?php echo e($book->price); ?>)
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Guarantee Card -->
        <div style="background-color: var(--surface); border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border); text-align: center; max-width: 680px; margin: 0 auto; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
            <h3 style="font-size: 1.5rem; font-weight: 800; color: var(--heading); margin-bottom: 0.75rem;">The DEV Editorial Guarantee</h3>
            <p style="color: var(--text); font-size: 14.5px; line-height: 1.6; margin-bottom: 1.25rem;">
                We believe in publishing only thoroughly tested, peer-reviewed advice. If you are not 100% satisfied with any book, email our team and we will refund you immediately. No questions asked.
            </p>
            <span class="label-mono" style="color: var(--primary);">Editorial Desk & Review Board</span>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/pages/books.blade.php ENDPATH**/ ?>