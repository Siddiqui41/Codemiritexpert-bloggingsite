@extends('layouts.app')

@section('title', 'About Us — Editorial Mission & Masthead — DEV')
@section('meta_description', 'Learn about DEV: an independent publication dedicated to web designers, frontend engineers, and accessibility advocates.')

@section('content')
<div class="py-10">
    <div class="container">
        
        <!-- Mission Header -->
        <div class="category-hero-card" style="margin-bottom: 3rem;">
            <div style="max-width: 760px;">
                <span class="label-mono" style="color: var(--on-hero); display: inline-block; background-color: rgba(255, 255, 255, 0.16); padding: 0.35rem 0.85rem; border-radius: 9999px; margin-bottom: 1.25rem;">
                    Editorial Manifesto
                </span>
                <h1 class="category-hero-title">
                    Built by Practitioners, for Practitioners
                </h1>
                <p class="category-hero-subtitle">
                    We deliver reliable, useful, and honest articles on web design, frontend architecture, accessibility, and user experience. No hype, no fluff — only tested engineering patterns.
                </p>
            </div>
        </div>

        <!-- Principles Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
            <div style="background-color: var(--surface); border-radius: 16px; padding: 2rem; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                <div style="width: 48px; height: 48px; background-color: var(--chip-bg); color: var(--chip-text); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 1rem;">
                    ⚖️
                </div>
                <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--heading); margin-bottom: 0.5rem;">Thoroughly Peer-Reviewed</h3>
                <p style="color: var(--text); font-size: 14.5px; line-height: 1.6;">
                    Every tutorial is tested across real browsers, screen readers, and performance budgets before publication by our technical editors.
                </p>
            </div>

            <div style="background-color: var(--surface); border-radius: 16px; padding: 2rem; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                <div style="width: 48px; height: 48px; background-color: var(--chip2-bg); color: var(--chip2-text); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 1rem;">
                    ♿
                </div>
                <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--heading); margin-bottom: 0.5rem;">Accessibility First</h3>
                <p style="color: var(--text); font-size: 14.5px; line-height: 1.6;">
                    We champion inclusive web standards. Every UI pattern featured adheres to WCAG 2.2 AA criteria and respects keyboard and assistive navigation.
                </p>
            </div>

            <div style="background-color: var(--surface); border-radius: 16px; padding: 2rem; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                <div style="width: 48px; height: 48px; background-color: var(--chip-bg); color: var(--chip-text); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 1rem;">
                    🛡️
                </div>
                <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--heading); margin-bottom: 0.5rem;">Zero Tracking & Respect</h3>
                <p style="color: var(--text); font-size: 14.5px; line-height: 1.6;">
                    No intrusive banner ads, no third-party behavioral trackers, and no paywalls on our core articles. The web should be open and fast.
                </p>
            </div>
        </div>

        <!-- Masthead Team -->
        <div style="margin-bottom: 4rem;">
            <div style="text-align: center; max-width: 640px; margin: 0 auto 3rem;">
                <span class="label-mono" style="color: var(--primary); display: block; margin-bottom: 0.5rem;">The Masthead</span>
                <h2 style="font-size: 2rem; font-weight: 800; color: var(--heading);">Meet Our Editorial Team</h2>
                <p style="color: var(--muted); font-size: 15px; margin-top: 0.5rem;">The passionate engineers, authors, and designers curating the magazine.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 2rem;">
                @foreach($team as $member)
                <div style="background-color: var(--surface); border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border); text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                    <img src="{{ $member->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80' }}" 
                         alt="{{ $member->name }}" 
                         style="width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 1rem; object-fit: cover; border: 2px solid var(--primary);">
                    <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--heading); margin-bottom: 0.25rem;">{{ $member->name }}</h3>
                    <p class="label-mono" style="color: var(--primary); margin-bottom: 0.75rem;">
                        {{ ucfirst($member->role) }}
                    </p>
                    <p style="color: var(--muted); font-size: 13.5px; line-height: 1.55;">
                        {{ $member->bio ?? 'Senior editor and technical reviewer specializing in modern web architecture.' }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
