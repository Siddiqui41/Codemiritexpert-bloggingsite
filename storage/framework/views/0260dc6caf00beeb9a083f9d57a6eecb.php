<?php $__env->startSection('title', 'Manage Categories & Topics'); ?>
<?php $__env->startSection('page_title', 'Curated Topics & Taxonomies'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Create / Edit Category Form -->
        <div class="lg:col-span-5 bg-slate-900 border border-slate-800 rounded-3xl p-6 h-fit shadow-xl">
            <h2 id="formHeaderTitle" class="font-serif font-black text-xl text-white mb-1">Add New Topic Category</h2>
            <p id="formHeaderSubtitle" class="text-xs font-mono text-slate-400 mb-6">Create a new editorial pillar with a distinct accent color</p>

            <form id="categoryForm" action="<?php echo e(route('admin.categories.store')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div id="methodContainer"></div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-1.5">
                        Topic Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" id="catName" required placeholder="e.g. Design Systems, Next.js" 
                           class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-1.5">
                        Brand Accent Color (Hex) <span class="text-rose-500">*</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="colorPicker" value="#4F46E5" oninput="document.getElementById('hexInput').value = this.value" 
                               class="w-10 h-10 rounded-xl bg-transparent border-0 cursor-pointer">
                        <input type="text" name="accent_color" id="hexInput" value="#4F46E5" required 
                               oninput="document.getElementById('colorPicker').value = this.value"
                               class="flex-1 px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-mono focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-1.5">
                        Display Order Weight
                    </label>
                    <input type="number" name="order" id="catOrder" value="1" 
                           class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-mono focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold text-slate-300 mb-1.5">
                        Topic Description
                    </label>
                    <textarea name="description" id="catDescription" rows="3" placeholder="Brief summary of what this topic encompasses for readers..." 
                              class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <div class="pt-2 flex items-center gap-3">
                    <button type="submit" id="catSubmitBtn" class="flex-1 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-mono font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-indigo-600/30 cursor-pointer border-0">
                        Create Topic Pillar →
                    </button>
                    <button type="button" id="catCancelBtn" onclick="resetCategoryForm()" class="hidden py-3 px-4 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl font-mono font-bold text-xs uppercase transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        <!-- Categories Table -->
        <div class="lg:col-span-7 bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl">
            <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <h2 class="font-serif font-black text-xl text-white">Active Categories</h2>
                    <p class="text-xs font-mono text-slate-400 mt-0.5">Currently featured on top navigation and card badges</p>
                </div>
                <span class="text-xs font-mono bg-indigo-500/10 text-indigo-400 px-3 py-1 rounded-full font-bold">
                    <?php echo e($categories->count()); ?> Topics
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-800 text-[11px] font-mono uppercase tracking-wider text-slate-400 bg-slate-950/40">
                            <th class="py-3 px-6">Topic</th>
                            <th class="py-3 px-4">Accent</th>
                            <th class="py-3 px-4">Articles</th>
                            <th class="py-3 px-4">Order</th>
                            <th class="py-3 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-xs">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="py-3.5 px-6">
                                <a href="<?php echo e(route('category.show', $category->slug)); ?>" target="_blank" class="font-bold text-white hover:text-indigo-400 flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full" style="background-color: <?php echo e($category->accent_color); ?>"></span>
                                    <?php echo e($category->name); ?>

                                </a>
                                <span class="text-[10px] font-mono text-slate-500">/category/<?php echo e($category->slug); ?></span>
                            </td>

                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-400">
                                <span class="inline-flex items-center gap-1.5 bg-slate-950 px-2.5 py-1 rounded-lg border border-slate-800">
                                    <span class="w-2 h-2 rounded-full" style="background-color: <?php echo e($category->accent_color); ?>"></span>
                                    <code><?php echo e($category->accent_color); ?></code>
                                </span>
                            </td>

                            <td class="py-3.5 px-4 font-mono">
                                <span class="px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 text-[10px] font-bold">
                                    <?php echo e($category->articles_count); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-4 font-mono text-slate-400">
                                #<?php echo e($category->order); ?>

                            </td>

                            <td class="py-3.5 px-6 text-right font-mono space-x-1.5 whitespace-nowrap">
                                <button type="button" 
                                        onclick="editCategory(<?php echo e($category->id); ?>, '<?php echo e(addslashes($category->name)); ?>', '<?php echo e($category->accent_color); ?>', <?php echo e($category->order); ?>, '<?php echo e(addslashes($category->description ?? '')); ?>')"
                                        class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg text-xs font-bold transition-colors cursor-pointer">
                                    Edit
                                </button>
                                <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Deleting a category will unassign its articles. Continue?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="px-2.5 py-1 bg-rose-950/60 hover:bg-rose-900 border border-rose-800/60 text-rose-300 rounded-lg text-xs font-bold transition-colors cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<script>
    function editCategory(id, name, color, order, desc) {
        document.getElementById('formHeaderTitle').textContent = 'Edit Topic: ' + name;
        document.getElementById('formHeaderSubtitle').textContent = 'Update topic configuration and styling';
        document.getElementById('categoryForm').action = '/admin/categories/' + id;
        document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        document.getElementById('catName').value = name;
        document.getElementById('colorPicker').value = color;
        document.getElementById('hexInput').value = color;
        document.getElementById('catOrder').value = order;
        document.getElementById('catDescription').value = desc;
        
        document.getElementById('catSubmitBtn').textContent = 'Save Changes →';
        document.getElementById('catCancelBtn').classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function resetCategoryForm() {
        document.getElementById('formHeaderTitle').textContent = 'Add New Topic Category';
        document.getElementById('formHeaderSubtitle').textContent = 'Create a new editorial pillar with a distinct accent color';
        document.getElementById('categoryForm').action = '<?php echo e(route("admin.categories.store")); ?>';
        document.getElementById('methodContainer').innerHTML = '';
        
        document.getElementById('catName').value = '';
        document.getElementById('colorPicker').value = '#4F46E5';
        document.getElementById('hexInput').value = '#4F46E5';
        document.getElementById('catOrder').value = '1';
        document.getElementById('catDescription').value = '';
        
        document.getElementById('catSubmitBtn').textContent = 'Create Topic Pillar →';
        document.getElementById('catCancelBtn').classList.add('hidden');
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>