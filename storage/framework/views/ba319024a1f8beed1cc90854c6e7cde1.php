<?php $__env->startSection('title', 'Contact Editorial Desk — DEV'); ?>
<?php $__env->startSection('meta_description', 'Get in touch with the editorial team, pitch an article tutorial, or inquire about workshops and book publishing.'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-10">
    <div class="container" style="max-width: 860px;">
        
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span class="label-mono" style="color: var(--primary); display: block; margin-bottom: 0.5rem;">Editorial Inquiries</span>
            <h1 style="font-size: clamp(2.2rem, 4vw, 3rem); font-weight: 800; color: var(--heading); margin-bottom: 0.75rem;">
                Get in Touch with Our Team
            </h1>
            <p style="color: var(--muted); font-size: 16px; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                Have an engineering tutorial proposal, feedback on an article, or a question about our masterclasses? We read every dispatch.
            </p>
        </div>

        <?php if(session('contact_success')): ?>
            <div style="margin-bottom: 2rem; padding: 1.25rem 1.5rem; background-color: var(--chip2-bg); border: 1px solid var(--border); border-left: 5px solid var(--chip2-text); border-radius: 12px; display: flex; align-items: flex-start; gap: 1rem;">
                <span style="font-size: 22px;">📬</span>
                <div>
                    <h4 style="font-weight: 700; color: var(--chip2-text); font-size: 15px; margin: 0;">Message Delivered!</h4>
                    <p style="color: var(--chip2-text); font-size: 14px; margin-top: 0.25rem;"><?php echo e(session('contact_success')); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <div style="background-color: var(--surface); border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
            <form action="<?php echo e(route('pages.contact.submit')); ?>" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
                <?php echo csrf_field(); ?>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <div>
                        <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                            Your Full Name <span style="color: var(--primary);">*</span>
                        </label>
                        <input type="text" name="name" required value="<?php echo e(old('name')); ?>" placeholder="e.g. Sarah Connor" 
                               style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; outline: none;">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                            Email Address <span style="color: var(--primary);">*</span>
                        </label>
                        <input type="email" name="email" required value="<?php echo e(old('email')); ?>" placeholder="you@domain.com" 
                               style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; outline: none;">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <div>
                        <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                            Department / Topic Desk <span style="color: var(--primary);">*</span>
                        </label>
                        <select name="department" style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14px; outline: none; cursor: pointer;">
                            <option value="Editorial (Pitch an Article)">Editorial (Pitch an Article)</option>
                            <option value="Workshops & Conferences">Workshops & Masterclasses</option>
                            <option value="DEV Books & Orders">Books & Order Support</option>
                            <option value="Sponsorship & Partnerships">Sponsorship & Advertising</option>
                            <option value="General Technical Question">General Technical Question</option>
                        </select>
                        <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                            Subject Line <span style="color: var(--primary);">*</span>
                        </label>
                        <input type="text" name="subject" required value="<?php echo e(old('subject')); ?>" placeholder="Brief topic summary..." 
                               style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; outline: none;">
                        <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div>
                    <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                        Your Detailed Message / Pitch <span style="color: var(--primary);">*</span>
                    </label>
                    <textarea name="message" rows="6" required placeholder="Outline your proposal, draft or feedback here in detail..." 
                              style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; line-height: 1.55; outline: none; font-family: inherit;"><?php echo e(old('message')); ?></textarea>
                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <button type="submit" class="btn-smash" style="padding: 0.85rem 2rem;">
                        Transmit Dispatch to Editorial Desk →
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/pages/contact.blade.php ENDPATH**/ ?>