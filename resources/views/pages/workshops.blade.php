@extends('layouts.app')

@section('title', 'Online Workshops for Front-End Engineers — DEV')
@section('meta_description', 'Live, highly interactive online masterclasses with small cohorts, video recordings, and practical takeaways.')

@section('content')
<div class="py-10">
    <div class="container">
        
        <!-- Hero Header -->
        <div class="category-hero-card" style="margin-bottom: 3rem;">
            <div style="max-width: 760px;">
                <span class="label-mono" style="color: var(--on-hero); display: inline-block; background-color: rgba(255, 255, 255, 0.16); padding: 0.35rem 0.85rem; border-radius: 9999px; margin-bottom: 1.25rem;">
                    Live Virtual Masterclasses
                </span>
                <h1 class="category-hero-title">
                    Interactive Workshops for Frontend Pros
                </h1>
                <p class="category-hero-subtitle">
                    Hands-on, deep-dive training split across multi-day sessions. Ask questions directly to top industry architects and practice on real-world projects.
                </p>
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1.5rem; font-size: 13.5px; color: var(--on-hero-muted);">
                    <span style="display: flex; align-items: center; gap: 0.4rem;"><strong style="color: var(--on-hero);">✓</strong> High-Definition Recordings Included</span>
                    <span style="display: flex; align-items: center; gap: 0.4rem;"><strong style="color: var(--on-hero);">✓</strong> Small Cohorts & Live Q&A</span>
                    <span style="display: flex; align-items: center; gap: 0.4rem;"><strong style="color: var(--on-hero);">✓</strong> Interactive Exercises & Slide Decks</span>
                </div>
            </div>
        </div>

        <!-- Workshops List -->
        <div style="display: flex; flex-direction: column; gap: 2rem; margin-bottom: 4rem;">
            @foreach($workshops as $workshop)
            <div style="background-color: var(--surface); border-radius: 16px; padding: 2rem; border: 1px solid var(--border); display: grid; grid-template-columns: 1fr 280px; gap: 2rem; align-items: center; box-shadow: 0 2px 8px rgba(0,0,0,0.03);" class="workshop-row-grid">
                <div>
                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                        <span style="padding: 0.25rem 0.75rem; border-radius: 9999px; background-color: var(--chip-bg); color: var(--chip-text); font-family: var(--font-mono); font-size: 12px; font-weight: 700;">
                            {{ $workshop->topic }}
                        </span>
                        <span style="font-size: 13px; color: var(--muted); display: flex; align-items: center; gap: 0.35rem;">
                            <span>📅</span> {{ $workshop->date_str }}
                        </span>
                    </div>

                    <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--heading); line-height: 1.3; margin-bottom: 0.75rem;">
                        {{ $workshop->title }}
                    </h2>

                    <p style="color: var(--text); font-size: 14.5px; line-height: 1.6; margin-bottom: 1.5rem;">
                        {{ $workshop->description }}
                    </p>

                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <img src="{{ $workshop->instructor_avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80' }}" 
                             alt="{{ $workshop->instructor }}" 
                             style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border);">
                        <div>
                            <p style="font-size: 13.5px; font-weight: 700; color: var(--heading); margin: 0;">Lead Instructor: {{ $workshop->instructor }}</p>
                            <p class="label-mono" style="font-size: 12px; color: var(--muted); margin: 0;">Live on Zoom + Dedicated Cohort Slack Channel</p>
                        </div>
                    </div>
                </div>

                <div style="background-color: var(--surface-2); padding: 1.75rem; border-radius: 12px; border: 1px solid var(--border); text-align: center; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div style="margin-bottom: 1.5rem;">
                        <span class="label-mono" style="display: block; margin-bottom: 0.25rem;">Standard Seat</span>
                        <span style="font-size: 2.25rem; font-weight: 800; color: var(--heading); display: block;">{{ $workshop->price }}</span>
                        <span style="font-size: 12.5px; color: var(--muted); display: block; margin-top: 0.25rem;">Per attendee (early bird rate)</span>
                    </div>

                    <a href="{{ $workshop->link ?? '#' }}" class="btn-smash" style="width: 100%; text-align: center; padding: 0.75rem 0;">
                        Register for Workshop →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

<style>
  @media (max-width: 900px) {
    .workshop-row-grid {
      grid-template-columns: 1fr !important;
    }
  }
</style>
@endsection
