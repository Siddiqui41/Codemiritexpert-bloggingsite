<?php $__env->startSection('title', 'Newsletter Subscribers'); ?>
<?php $__env->startSection('page_title', 'Weekly Newsletter Subscriber Roster'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden">
        <div class="p-6 border-b border-slate-800 flex items-center justify-between">
            <div>
                <h2 class="font-serif font-black text-xl text-white">Audience Distribution List</h2>
                <p class="text-xs font-mono text-slate-400 mt-0.5">Engineers subscribed to Tuesday Smashing Newsletter dispatches</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full font-bold">
                    <?php echo e($subscribers->total()); ?> Subscribers
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-slate-800 text-[11px] font-mono uppercase tracking-wider text-slate-400 bg-slate-950/40">
                        <th class="py-4 px-6">Subscriber Email</th>
                        <th class="py-4 px-4">Subscribed At</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-xs">
                    <?php $__empty_1 = true; $__currentLoopData = $subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-800/40 transition-colors">
                        <td class="py-4 px-6 font-mono text-white">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                <?php echo e($sub->email); ?>

                            </div>
                        </td>

                        <td class="py-4 px-4 font-mono text-slate-400 text-[11px]">
                            <?php echo e($sub->created_at->format('M d, Y • H:i')); ?>

                        </td>

                        <td class="py-4 px-4 font-mono">
                            <span class="px-2.5 py-1 rounded-full text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                Active Opt-In
                            </span>
                        </td>

                        <td class="py-4 px-6 text-right font-mono">
                            <form action="<?php echo e(route('admin.subscribers.destroy', $sub->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Remove subscriber from distribution list?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="px-3 py-1 bg-rose-950/60 hover:bg-rose-900 border border-rose-800/60 text-rose-300 rounded-lg text-xs font-bold transition-colors">
                                    Unsubscribe
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="py-12 text-center text-slate-500 font-mono text-xs">
                            No active newsletter subscribers found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-800">
            <?php echo e($subscribers->links()); ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/admin/subscribers/index.blade.php ENDPATH**/ ?>