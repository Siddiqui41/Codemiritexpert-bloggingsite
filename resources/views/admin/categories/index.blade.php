@extends('admin.layouts.admin')

@section('title', 'Manage Categories & Topics')
@section('page_title', 'Curated Topics & Taxonomies')

@section('content')
<div class="space-y-8">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Create / Edit Category Form -->
        <div class="lg:col-span-5 theme-surface border rounded-3xl p-6 h-fit shadow-sm">
            <h2 id="formHeaderTitle" class="font-serif font-black text-xl mb-1" style="color: var(--text-main);">Add New Topic Category</h2>
            <p id="formHeaderSubtitle" class="text-xs font-mono mb-6" style="color: var(--text-muted);">Create a new editorial pillar with a distinct accent color</p>

            <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div id="methodContainer"></div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-1.5" style="color: var(--text-main);">
                        Topic Name <span style="color: var(--brand-rose);">*</span>
                    </label>
                    <input type="text" name="name" id="catName" required placeholder="e.g. Design Systems, Next.js" 
                           class="theme-input w-full px-4 py-2.5 rounded-xl text-xs border">
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-1.5" style="color: var(--text-main);">
                        Brand Accent Color (Hex) <span style="color: var(--brand-rose);">*</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="colorPicker" value="#E07A5F" oninput="document.getElementById('hexInput').value = this.value" 
                               class="w-10 h-10 rounded-xl bg-transparent border-0 cursor-pointer">
                        <input type="text" name="accent_color" id="hexInput" value="#E07A5F" required 
                               oninput="document.getElementById('colorPicker').value = this.value"
                               class="theme-input flex-1 px-4 py-2.5 rounded-xl text-xs font-mono border">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-1.5" style="color: var(--text-main);">
                        Display Order Weight
                    </label>
                    <input type="number" name="order" id="catOrder" value="1" 
                           class="theme-input w-full px-4 py-2.5 rounded-xl text-xs font-mono border">
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider font-bold mb-1.5" style="color: var(--text-main);">
                        Topic Description
                    </label>
                    <textarea name="description" id="catDescription" rows="3" placeholder="Brief summary of what this topic encompasses for readers..." 
                              class="theme-input w-full px-4 py-2.5 rounded-xl text-xs border"></textarea>
                </div>

                <div class="pt-2 flex items-center gap-3">
                    <button type="submit" id="catSubmitBtn" class="theme-primary-btn flex-1 py-3 rounded-xl font-mono font-bold text-xs uppercase tracking-wider shadow-md">
                        Create Topic Pillar →
                    </button>
                    <button type="button" id="catCancelBtn" onclick="resetCategoryForm()" class="hidden px-4 py-3 border rounded-xl font-mono font-bold text-xs hover:opacity-80 transition-opacity" style="border-color: var(--border-color); color: var(--text-muted);">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        <!-- Categories List Table -->
        <div class="lg:col-span-7 theme-surface border rounded-3xl overflow-hidden shadow-sm">
            <div class="p-6 border-b flex items-center justify-between" style="border-color: var(--border-color);">
                <div>
                    <h3 class="font-serif font-black text-xl" style="color: var(--text-main);">Active Taxonomy Pillars</h3>
                    <p class="text-xs font-mono mt-0.5" style="color: var(--text-muted);">All 10 active topic categories</p>
                </div>
                <span class="font-mono text-xs font-bold px-3 py-1 rounded-full" style="background-color: var(--brand-light); color: var(--brand-primary);">
                    {{ count($categories) }} Categories
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-[11px] font-mono uppercase tracking-wider theme-surface-soft" style="border-color: var(--border-color); color: var(--text-muted);">
                            <th class="py-3 px-6">Topic / Slug</th>
                            <th class="py-3 px-4">Accent</th>
                            <th class="py-3 px-4">Articles</th>
                            <th class="py-3 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-xs" style="border-color: var(--border-color);">
                        @foreach($categories as $category)
                        <tr class="hover:opacity-90 transition-opacity">
                            <td class="py-4 px-6">
                                <div class="font-bold" style="color: var(--text-main);">{{ $category->name }}</div>
                                <div class="text-[10px] font-mono mt-0.5" style="color: var(--text-muted);">/category/{{ $category->slug }}</div>
                            </td>

                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="w-3.5 h-3.5 rounded-full border border-black/10 shadow-sm" style="background-color: {{ $category->accent_color }}"></span>
                                    <span class="font-mono text-[11px]" style="color: var(--text-muted);">{{ $category->accent_color }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-4 whitespace-nowrap font-mono" style="color: var(--text-main);">
                                {{ $category->articles_count ?? $category->articles()->count() }} posts
                            </td>

                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" 
                                            onclick="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->accent_color }}', {{ $category->order }}, '{{ addslashes($category->description ?? '') }}')"
                                            class="theme-primary-btn px-3 py-1.5 rounded-xl font-mono text-xs font-bold shadow-sm">
                                        Edit ✏️
                                    </button>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Deleting category will also delete its articles. Proceed?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-xl text-rose-500 hover:bg-rose-500/10 transition-colors" title="Delete Topic">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function editCategory(id, name, color, order, desc) {
        document.getElementById('formHeaderTitle').innerText = 'Edit Topic: ' + name;
        document.getElementById('formHeaderSubtitle').innerText = 'Modify taxonomy attributes and accent';
        
        const form = document.getElementById('categoryForm');
        form.action = '/admin/categories/' + id;
        
        document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('catName').value = name;
        document.getElementById('colorPicker').value = color;
        document.getElementById('hexInput').value = color;
        document.getElementById('catOrder').value = order;
        document.getElementById('catDescription').value = desc;
        
        document.getElementById('catSubmitBtn').innerText = 'Update Topic Pillar ✓';
        document.getElementById('catCancelBtn').classList.remove('hidden');
    }

    function resetCategoryForm() {
        document.getElementById('formHeaderTitle').innerText = 'Add New Topic Category';
        document.getElementById('formHeaderSubtitle').innerText = 'Create a new editorial pillar with a distinct accent color';
        
        const form = document.getElementById('categoryForm');
        form.action = "{{ route('admin.categories.store') }}";
        
        document.getElementById('methodContainer').innerHTML = '';
        form.reset();
        document.getElementById('colorPicker').value = '#E07A5F';
        document.getElementById('hexInput').value = '#E07A5F';
        
        document.getElementById('catSubmitBtn').innerText = 'Create Topic Pillar →';
        document.getElementById('catCancelBtn').classList.add('hidden');
    }
</script>
@endsection
