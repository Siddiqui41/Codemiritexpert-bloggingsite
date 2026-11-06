@extends('admin.layouts.admin')

@section('title', 'Newsletter Subscribers')
@section('page_title', 'Weekly Newsletter Subscriber Roster')

@section('content')
<div class="space-y-6">

    <div class="theme-surface border rounded-3xl overflow-hidden shadow-sm">
        <div class="p-6 border-b flex items-center justify-between" style="border-color: var(--border-color);">
            <div>
                <h2 class="font-serif font-black text-xl" style="color: var(--text-main);">Audience Distribution List</h2>
                <p class="text-xs font-mono mt-0.5" style="color: var(--text-muted);">Engineers subscribed to Tuesday Newsletter dispatches</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs font-mono px-3 py-1 rounded-full font-bold" style="background-color: var(--brand-light); color: var(--brand-primary);">
                    {{ $subscribers->total() }} Subscribers
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b text-[11px] font-mono uppercase tracking-wider theme-surface-soft" style="border-color: var(--border-color); color: var(--text-muted);">
                        <th class="py-4 px-6">Subscriber Email</th>
                        <th class="py-4 px-4">Subscribed At</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-xs" style="border-color: var(--border-color);">
                    @forelse($subscribers as $sub)
                    <tr class="hover:opacity-90 transition-opacity">
                        <td class="py-4 px-6 font-mono font-bold" style="color: var(--text-main);">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full" style="background-color: var(--brand-emerald);"></span>
                                {{ $sub->email }}
                            </div>
                        </td>

                        <td class="py-4 px-4 font-mono text-[11px]" style="color: var(--text-muted);">
                            {{ $sub->created_at->format('M d, Y • H:i') }}
                        </td>

                        <td class="py-4 px-4 font-mono">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold" style="background-color: rgba(91, 158, 120, 0.15); color: var(--brand-emerald);">
                                Active Opt-In
                            </span>
                        </td>

                        <td class="py-4 px-6 text-right font-mono">
                            <form action="{{ route('admin.subscribers.destroy', $sub->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Remove subscriber from distribution list?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-rose-500 hover:bg-rose-500/10 rounded-xl transition-colors" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-xs" style="color: var(--text-muted);">
                            Abhi koi subscriber register nahi hua.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subscribers->hasPages())
        <div class="p-4 border-t theme-surface-soft" style="border-color: var(--border-color);">
            {{ $subscribers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
