@extends('admin.layouts.admin')

@section('title', 'Comments Moderation')
@section('page_title', 'Reader Commentary & Moderation')

@section('content')
<div class="space-y-6">

    <div class="theme-surface border rounded-3xl overflow-hidden shadow-sm">
        <div class="p-6 border-b flex items-center justify-between" style="border-color: var(--border-color);">
            <div>
                <h2 class="font-serif font-black text-xl" style="color: var(--text-main);">Reader Discussions</h2>
                <p class="text-xs font-mono mt-0.5" style="color: var(--text-muted);">Approve or unpublish comments across all published articles</p>
            </div>
            <span class="text-xs font-mono px-3 py-1 rounded-full font-bold" style="background-color: var(--brand-light); color: var(--brand-primary);">
                {{ $comments->total() }} Comments
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b text-[11px] font-mono uppercase tracking-wider theme-surface-soft" style="border-color: var(--border-color); color: var(--text-muted);">
                        <th class="py-4 px-6">Reader Author</th>
                        <th class="py-4 px-4">Commentary Body</th>
                        <th class="py-4 px-4">Referenced Article</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-4">Date</th>
                        <th class="py-4 px-6 text-right">Moderation Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-xs" style="border-color: var(--border-color);">
                    @forelse($comments as $comment)
                    <tr class="hover:opacity-90 transition-opacity">
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <img src="{{ $comment->author_avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80' }}" alt="{{ $comment->author_name }}" class="w-7 h-7 rounded-full object-cover">
                                <div>
                                    <p class="font-bold" style="color: var(--text-main);">{{ $comment->author_name }}</p>
                                    <p class="text-[10px] font-mono" style="color: var(--text-muted);">{{ $comment->author_email }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="py-4 px-4">
                            <p class="max-w-sm line-clamp-2 leading-relaxed" style="color: var(--text-main);">
                                "{{ $comment->content }}"
                            </p>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap">
                            @if($comment->article)
                                <a href="{{ route('articles.show', $comment->article->slug) }}" target="_blank" class="hover:underline max-w-[200px] truncate block font-serif font-bold" style="color: var(--brand-primary);">
                                    {{ $comment->article->title }}
                                </a>
                            @else
                                <span class="italic" style="color: var(--text-muted);">Deleted Article</span>
                            @endif
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-mono uppercase font-bold" style="{{ $comment->status === 'approved' ? 'background-color: rgba(91, 158, 120, 0.15); color: var(--brand-emerald);' : 'background-color: rgba(242, 204, 143, 0.15); color: var(--brand-amber);' }}">
                                {{ $comment->status }}
                            </span>
                        </td>

                        <td class="py-4 px-4 whitespace-nowrap font-mono text-[11px]" style="color: var(--text-muted);">
                            {{ $comment->created_at->format('M d, Y') }}
                        </td>

                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('admin.comments.toggle', $comment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-xl font-mono text-xs font-bold transition-all border" style="{{ $comment->status === 'approved' ? 'border-color: var(--border-color); color: var(--text-muted);' : 'background-color: var(--brand-primary); color: var(--text-on-primary); border-color: transparent;' }}">
                                        {{ $comment->status === 'approved' ? 'Hide' : 'Approve ✓' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Kya aap is comment ko permanently delete karna chahte hain?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-rose-500 hover:bg-rose-500/10 rounded-xl transition-colors" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-xs" style="color: var(--text-muted);">
                            Filhal koi comments mojood nahi hain.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($comments->hasPages())
        <div class="p-4 border-t theme-surface-soft" style="border-color: var(--border-color);">
            {{ $comments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
