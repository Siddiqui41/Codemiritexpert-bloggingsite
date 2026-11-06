@extends('layouts.app')

@section('title', 'DEV Guides — Master Handbooks & Curated Tracks')
@section('meta_description', 'Exhaustive step-by-step guides and curated learning tracks for modern frontend architects and UI designers.')

@section('content')
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
                        <strong style="color: var(--on-hero);">{{ $guides->total() }}</strong> Curated Guides
                    </span>
                    <span>•</span>
                    <span>Free & Community-Reviewed</span>
                </div>
            </div>
        </div>

        <!-- Guides Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 3.5rem;">
            @forelse($guides as $guide)
            <article class="smash-card" style="border-top-color: {{ $guide->category->accent_color }}; padding: 1.5rem;">
                <div style="display: flex; flex-direction: column; flex-grow: 1;">
                    <a href="{{ route('articles.show', $guide->slug) }}" style="display: block; overflow: hidden; border-radius: 8px; margin-bottom: 1.25rem; position: relative;">
                        <img src="{{ $guide->cover_image_url }}" 
                             alt="{{ $guide->title }}" 
                             style="width: 100%; height: 180px; object-fit: cover; transition: transform 250ms ease;"
                             onmouseover="this.style.transform='scale(1.03)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <span style="position: absolute; top: 10px; left: 10px; background-color: var(--surface); color: var(--heading); font-family: var(--font-mono); font-size: 11px; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 6px; border: 1px solid var(--border);">
                            ★ Comprehensive Guide
                        </span>
                    </a>

                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.65rem;">
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem;">
                            <span style="width: 7px; height: 7px; border-radius: 50%; background-color: {{ $guide->category->accent_color }}; display: inline-block;"></span>
                            <span class="label-mono" style="color: var(--primary);">{{ $guide->category->name }}</span>
                        </span>
                        <span style="display: flex; align-items: center; gap: 0.35rem; font-size: 13px; color: var(--muted);">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ $guide->reading_time }}
                        </span>
                    </div>

                    <h2 style="font-size: 1.35rem; font-weight: 700; line-height: 1.3; margin-bottom: 0.75rem;">
                        <a href="{{ route('articles.show', $guide->slug) }}" style="color: var(--heading); text-decoration: none;">
                            {{ $guide->title }}
                        </a>
                    </h2>

                    <p style="font-size: 15px; color: var(--text); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $guide->excerpt }}
                    </p>
                </div>

                <div style="padding-top: 1rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; margin-top: auto;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <img src="{{ $guide->author->avatar }}" alt="{{ $guide->author->name }}" style="width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border);">
                        <div>
                            <p style="font-size: 13.5px; font-weight: 700; color: var(--heading); margin: 0;">{{ $guide->author->name }}</p>
                            <p class="label-mono" style="font-size: 12px; color: var(--muted); margin: 0;">Updated {{ $guide->updated_at->format('M Y') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('articles.show', $guide->slug) }}" style="font-size: 13.5px; font-weight: 700; color: var(--primary); text-decoration: none;">
                        Read Guide →
                    </a>
                </div>
            </article>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem 0;">
                <p style="color: var(--muted); font-size: 15px;">No guides found at this time.</p>
            </div>
            @endforelse
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $guides->links() }}
        </div>

    </div>
</div>
@endsection
