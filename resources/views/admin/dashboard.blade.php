@extends('admin.layouts.admin')

@section('title', 'Editorial Dashboard')
@section('page_title', 'Admin Dashboard & Content Hub')

@section('content')
<div class="space-y-8">
    
    <!-- Simplified Process Stepper Guide: Visual Workflow -->
    <div class="theme-surface border rounded-3xl p-6 sm:p-7 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-5 border-b" style="border-color: var(--border-color);">
            <div>
                <span class="text-[11px] font-mono font-bold uppercase tracking-wider px-2.5 py-1 rounded-md" style="background-color: var(--brand-light); color: var(--brand-primary);">
                    Easy Blogging Workflow
                </span>
                <h2 class="text-xl font-serif font-black mt-2" style="color: var(--text-main);">Blog Post Kaise Process Hota Hai? (4 Simple Steps)</h2>
                <p class="text-xs mt-0.5" style="color: var(--text-muted);">Admin panel se naya blog upload aur manage karne ka step-by-step process:</p>
            </div>
            <a href="{{ route('admin.articles.create') }}" class="theme-primary-btn px-5 py-2.5 rounded-xl font-mono font-bold text-xs uppercase tracking-wider inline-flex items-center gap-2 self-start md:self-auto shadow-md">
                <span>Start Step 1: Write Article</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-5">
            <!-- Step 1 -->
            <div class="theme-surface-soft p-4 rounded-2xl border" style="border-color: var(--border-color);">
                <div class="flex items-center gap-2.5 mb-2">
                    <span class="w-7 h-7 rounded-lg flex items-center justify-center font-mono font-bold text-xs" style="background-color: var(--brand-primary); color: var(--text-on-primary);">1</span>
                    <span class="font-bold text-xs uppercase font-mono" style="color: var(--text-main);">Draft Headline</span>
                </div>
                <p class="text-[11px] leading-relaxed" style="color: var(--text-muted);">
                    Article ka Title, Topic Category (CSS, JS, Career wagera) aur Author byline select karein.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="theme-surface-soft p-4 rounded-2xl border" style="border-color: var(--border-color);">
                <div class="flex items-center gap-2.5 mb-2">
                    <span class="w-7 h-7 rounded-lg flex items-center justify-center font-mono font-bold text-xs" style="background-color: var(--brand-primary); color: var(--text-on-primary);">2</span>
                    <span class="font-bold text-xs uppercase font-mono" style="color: var(--text-main);">Upload Image</span>
                </div>
                <p class="text-[11px] leading-relaxed" style="color: var(--text-muted);">
                    Apne PC se Cover Image upload karein. File direct <code class="px-1 py-0.5 rounded text-[10px] bg-black/10">public/assets/uploads/</code> mein save hoti hai.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="theme-surface-soft p-4 rounded-2xl border" style="border-color: var(--border-color);">
                <div class="flex items-center gap-2.5 mb-2">
                    <span class="w-7 h-7 rounded-lg flex items-center justify-center font-mono font-bold text-xs" style="background-color: var(--brand-primary); color: var(--text-on-primary);">3</span>
                    <span class="font-bold text-xs uppercase font-mono" style="color: var(--text-main);">Write Content</span>
                </div>
                <p class="text-[11px] leading-relaxed" style="color: var(--text-muted);">
                    Article body mein clean content, code blocks aur subheadings add karein sath excerpt summary likhein.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="theme-surface-soft p-4 rounded-2xl border" style="border-color: var(--border-color);">
                <div class="flex items-center gap-2.5 mb-2">
                    <span class="w-7 h-7 rounded-lg flex items-center justify-center font-mono font-bold text-xs" style="background-color: var(--brand-primary); color: var(--text-on-primary);">4</span>
                    <span class="font-bold text-xs uppercase font-mono" style="color: var(--text-main);">Publish & Live</span>
                </div>
                <p class="text-[11px] leading-relaxed" style="color: var(--text-muted);">
                    Status "Published" set karein, foran live website par render ho jaye ga aur comments moderate ho sakenge.
                </p>
            </div>
        </div>
    </div>

    <!-- Top Stat Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Articles -->
        <div class="theme-surface border rounded-3xl p-6 relative overflow-hidden shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono uppercase tracking-wider font-bold" style="color: var(--text-muted);">Total Articles</span>
                <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold" style="background-color: var(--brand-light); color: var(--brand-primary);">📝</span>
            </div>
            <div class="text-3xl font-serif font-black mb-1" style="color: var(--text-main);">{{ $stats['total_articles'] }}</div>
            <div class="text-xs font-mono flex items-center gap-1" style="color: var(--brand-emerald);">
                <span>✓ Active in MySQL Database</span>
            </div>
        </div>

        <!-- Impressions / Views -->
        <div class="theme-surface border rounded-3xl p-6 relative overflow-hidden shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono uppercase tracking-wider font-bold" style="color: var(--text-muted);">Total Impressions</span>
                <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold" style="background-color: var(--brand-light); color: var(--brand-primary);">👁️</span>
            </div>
            <div class="text-3xl font-serif font-black mb-1" style="color: var(--text-main);">{{ number_format($stats['total_views']) }}</div>
            <div class="text-xs font-mono" style="color: var(--text-muted);">Live reader pageviews</div>
        </div>

        <!-- Claps -->
        <div class="theme-surface border rounded-3xl p-6 relative overflow-hidden shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono uppercase tracking-wider font-bold" style="color: var(--text-muted);">Community Claps</span>
                <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold" style="background-color: var(--brand-light); color: var(--brand-primary);">👏</span>
            </div>
            <div class="text-3xl font-serif font-black mb-1" style="color: var(--text-main);">{{ number_format($stats['total_claps']) }}</div>
            <div class="text-xs font-mono" style="color: var(--brand-amber);">Reader appreciation</div>
        </div>

        <!-- Subscribers -->
        <div class="theme-surface border rounded-3xl p-6 relative overflow-hidden shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono uppercase tracking-wider font-bold" style="color: var(--text-muted);">Newsletter Subs</span>
                <span class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold" style="background-color: var(--brand-light); color: var(--brand-primary);">📬</span>
            </div>
            <div class="text-3xl font-serif font-black mb-1" style="color: var(--text-main);">{{ number_format($stats['total_subscribers']) }}</div>
            <div class="text-xs font-mono" style="color: var(--brand-emerald);">Active subscribers</div>
        </div>
    </div>

    <!-- Secondary Counters Bar -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.categories.index') }}" class="theme-surface-soft border rounded-2xl p-4 flex items-center justify-between hover:opacity-90 transition-opacity" style="border-color: var(--border-color);">
            <span class="text-xs font-mono" style="color: var(--text-muted);">Topics & Categories</span>
            <span class="font-mono font-bold" style="color: var(--text-main);">{{ $stats['total_categories'] }}</span>
        </a>
        <a href="{{ route('admin.comments.index') }}" class="theme-surface-soft border rounded-2xl p-4 flex items-center justify-between hover:opacity-90 transition-opacity" style="border-color: var(--border-color);">
            <span class="text-xs font-mono" style="color: var(--text-muted);">Total Comments</span>
            <span class="font-mono font-bold" style="color: var(--text-main);">{{ $stats['total_comments'] }}</span>
        </a>
        <a href="{{ route('admin.comments.index') }}" class="theme-surface-soft border rounded-2xl p-4 flex items-center justify-between hover:opacity-90 transition-opacity" style="border-color: var(--border-color);">
            <span class="text-xs font-mono" style="color: var(--text-muted);">Pending Moderation</span>
            <span class="font-mono font-bold" style="color: var(--brand-primary);">{{ $stats['pending_comments'] }}</span>
        </a>
        <div class="theme-surface-soft border rounded-2xl p-4 flex items-center justify-between" style="border-color: var(--border-color);">
            <span class="text-xs font-mono" style="color: var(--text-muted);">Staff Authors</span>
            <span class="font-mono font-bold" style="color: var(--text-main);">{{ $stats['total_authors'] }}</span>
        </div>
    </div>

    <!-- Recent Articles & Comments Split Table -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Recent Articles -->
        <div class="lg:col-span-7 theme-surface border rounded-3xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6 pb-4 border-b" style="border-color: var(--border-color);">
                <div>
                    <h2 class="font-serif font-black text-xl" style="color: var(--text-main);">Recent Published Articles</h2>
                    <p class="text-xs font-mono mt-0.5" style="color: var(--text-muted);">Recent dispatches in MySQL</p>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="text-xs font-mono font-bold uppercase tracking-wider hover:underline" style="color: var(--brand-primary);">
                    All Articles ({{ $stats['total_articles'] }}) →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-[11px] font-mono uppercase tracking-wider" style="border-color: var(--border-color); color: var(--text-muted);">
                            <th class="pb-3">Title & Details</th>
                            <th class="pb-3">Topic</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-xs" style="border-color: var(--border-color);">
                        @forelse($recentArticles as $article)
                        <tr class="hover:opacity-90 transition-opacity">
                            <td class="py-3.5 pr-3">
                                <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="font-bold line-clamp-1 hover:underline" style="color: var(--text-main);">
                                    {{ $article->title }}
                                </a>
                                <div class="text-[10px] font-mono mt-0.5" style="color: var(--text-muted);">
                                    By {{ $article->author->name }} • {{ $article->views_count }} reads
                                </div>
                            </td>
                            <td class="py-3.5 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase" style="background-color: {{ $article->category->accent_color }}20; color: {{ $article->category->accent_color }};">
                                    {{ $article->category->name }}
                                </span>
                            </td>
                            <td class="py-3.5 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono uppercase font-bold" style="background-color: var(--brand-light); color: var(--brand-primary);">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right whitespace-nowrap">
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="font-mono text-xs font-bold hover:underline" style="color: var(--brand-primary);">
                                    Edit ✏️
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-xs" style="color: var(--text-muted);">
                                Koi article mojood nahi hai. Naya create karein!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Comments Moderation -->
        <div class="lg:col-span-5 theme-surface border rounded-3xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6 pb-4 border-b" style="border-color: var(--border-color);">
                <div>
                    <h2 class="font-serif font-black text-xl" style="color: var(--text-main);">Latest Comments</h2>
                    <p class="text-xs font-mono mt-0.5" style="color: var(--text-muted);">Readers feedback & claps</p>
                </div>
                <a href="{{ route('admin.comments.index') }}" class="text-xs font-mono font-bold uppercase tracking-wider hover:underline" style="color: var(--brand-primary);">
                    Moderate All →
                </a>
            </div>

            <div class="space-y-4">
                @forelse($recentComments as $comment)
                <div class="p-4 rounded-2xl border theme-surface-soft" style="border-color: var(--border-color);">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-xs" style="color: var(--text-main);">{{ $comment->author_name }}</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded" style="{{ $comment->status === 'approved' ? 'background-color: rgba(91, 158, 120, 0.2); color: var(--brand-emerald);' : 'background-color: rgba(242, 204, 143, 0.2); color: var(--brand-amber);' }}">
                            {{ ucfirst($comment->status) }}
                        </span>
                    </div>
                    <p class="text-xs line-clamp-2 leading-relaxed" style="color: var(--text-muted);">
                        "{{ $comment->content }}"
                    </p>
                    <div class="mt-2 text-[10px] font-mono truncate" style="color: var(--text-muted);">
                        On: {{ $comment->article->title ?? 'Article' }}
                    </div>
                </div>
                @empty
                <div class="py-8 text-center text-xs" style="color: var(--text-muted);">
                    Koi comments pending nahi hain.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
