<?php $__env->startSection('title', 'Comments Moderation'); ?>
<?php $__env->startSection('page_title', 'Reader Commentary & Moderation'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden">
        <div class="p-6 border-b border-slate-800 flex items-center justify-between">
            <div>
                <h2 class="font-serif font-black text-xl text-white">Reader Discussions</h2>
                <p class="text-xs font-mono text-slate-400 mt-0.5">Approve or unpublish comments across all published articles</p>
            </div>
            <span class="text-xs font-mono bg-indigo-500/10 text-indigo-400 px-3 py-1 rounded-full font-bold">
                <?php echo e($comments->total()); ?> Total Threads
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-slate-800 text-[11px] font-mono uppercase tracking-wider text-slate-400 bg-slate-950/40">
                        <th class="py-4 px-6">Reader Author</th>
                        <th class="py-4 px-4">Commentary Body</th>
                        <th class="py-4 px-4">Referenced Article</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-4">Date</th>
                        <th class="py-4 px-6 text-right">Moderation Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-xs">
                    <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-800/40 transition-colors">
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <img src="<?php echo e($comment->author_avatar); ?>" alt="<?php echo e($comment->author_name); ?>" class="w-7 h-7 rounded-full object-cover">
                                <div>
                                    <p class="font-bold text-white"><?php echo e($comment->author_name); ?></p>
                                    <p class="text-[10px] font-mono text-slate-400"><?php echo e($comment->author_email); ?></p>
                                </div>
                            </div>
                        </td>

                        <td class="py-4 px-4">
                            <p class="text-slate-200 font-sans max-w-sm line-clamp-2">
                                "<?php echo e($comment->content); ?>"
                            </p>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap">
                            <?php if($comment->article): ?>
                                <a href="<?php echo e(route('articles.show', $comment->article->slug)); ?>" target="_blank" class="text-indigo-400 hover:underline max-w-[180px] truncate block font-serif">
                                    <?php echo e($comment->article->title); ?>

                                </a>
                            <?php else: ?>
                                <span class="text-slate-500 italic">Deleted Article</span>
                            <?php endif; ?>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap font-mono">
                            <span class="px-2.5 py-1 rounded-full text-[10px] <?php echo e($comment->status === 'approved' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30'); ?>">
                                ● <?php echo e(ucfirst($comment->status)); ?>

                            </span>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap font-mono text-[11px] text-slate-400">
                            <?php echo e($comment->created_at->format('M d, Y')); ?>

                        </td>

                        <td class="py-4 px-6 text-right whitespace-nowrap font-mono space-x-2">
                            <form action="<?php echo e(route('admin.comments.toggle', $comment->id)); ?>" method="POST" class="inline-block">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="px-3 py-1 <?php echo e($comment->status === 'approved' ? 'bg-amber-950/60 hover:bg-amber-900 text-amber-300 border border-amber-800/60' : 'bg-emerald-950/60 hover:bg-emerald-900 text-emerald-300 border border-emerald-800/60'); ?> rounded-lg text-xs font-bold transition-colors">
                                    <?php echo e($comment->status === 'approved' ? 'Set Pending' : 'Approve'); ?>

                                </button>
                            </form>

                            <form action="<?php echo e(route('admin.comments.destroy', $comment->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Delete this comment permanently?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="px-3 py-1 bg-rose-950/60 hover:bg-rose-900 border border-rose-800/60 text-rose-300 rounded-lg text-xs font-bold transition-colors">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-500 font-mono text-xs">
                            No reader comments currently recorded.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-800">
            <?php echo e($comments->links()); ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/admin/comments/index.blade.php ENDPATH**/ ?>