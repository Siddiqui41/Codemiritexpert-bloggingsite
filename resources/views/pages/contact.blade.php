@extends('layouts.app')

@section('title', 'Contact Editorial Desk — DEV')
@section('meta_description', 'Get in touch with the editorial team, pitch an article tutorial, or inquire about workshops and book publishing.')

@section('content')
<div class="py-10">
    <div class="container" style="max-width: 860px;">
        
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span class="label-mono" style="color: var(--primary); display: block; margin-bottom: 0.5rem;">Editorial Inquiries</span>
            <h1 style="font-size: clamp(2.2rem, 4vw, 3rem); font-weight: 800; color: var(--heading); margin-bottom: 0.75rem;">
                Get in Touch with Our Team
            </h1>
            <p style="color: var(--muted); font-size: 16px; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                Have an engineering tutorial proposal, feedback on an article, or a question about our masterclasses? We read every dispatch.
            </p>
        </div>

        @if(session('contact_success'))
            <div style="margin-bottom: 2rem; padding: 1.25rem 1.5rem; background-color: var(--chip2-bg); border: 1px solid var(--border); border-left: 5px solid var(--chip2-text); border-radius: 12px; display: flex; align-items: flex-start; gap: 1rem;">
                <span style="font-size: 22px;">📬</span>
                <div>
                    <h4 style="font-weight: 700; color: var(--chip2-text); font-size: 15px; margin: 0;">Message Delivered!</h4>
                    <p style="color: var(--chip2-text); font-size: 14px; margin-top: 0.25rem;">{{ session('contact_success') }}</p>
                </div>
            </div>
        @endif

        <div style="background-color: var(--surface); border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
            <form action="{{ route('pages.contact.submit') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
                @csrf
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <div>
                        <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                            Your Full Name <span style="color: var(--primary);">*</span>
                        </label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="e.g. Sarah Connor" 
                               style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; outline: none;">
                        @error('name')<p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                            Email Address <span style="color: var(--primary);">*</span>
                        </label>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="you@domain.com" 
                               style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; outline: none;">
                        @error('email')<p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <div>
                        <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                            Department / Topic Desk <span style="color: var(--primary);">*</span>
                        </label>
                        <select name="department" style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14px; outline: none; cursor: pointer;">
                            <option value="Editorial (Pitch an Article)">Editorial (Pitch an Article)</option>
                            <option value="Workshops & Conferences">Workshops & Masterclasses</option>
                            <option value="DEV Books & Orders">Books & Order Support</option>
                            <option value="Sponsorship & Partnerships">Sponsorship & Advertising</option>
                            <option value="General Technical Question">General Technical Question</option>
                        </select>
                        @error('department')<p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                            Subject Line <span style="color: var(--primary);">*</span>
                        </label>
                        <input type="text" name="subject" required value="{{ old('subject') }}" placeholder="Brief topic summary..." 
                               style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; outline: none;">
                        @error('subject')<p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="label-mono" style="display: block; color: var(--heading); margin-bottom: 0.5rem;">
                        Your Detailed Message / Pitch <span style="color: var(--primary);">*</span>
                    </label>
                    <textarea name="message" rows="6" required placeholder="Outline your proposal, draft or feedback here in detail..." 
                              style="width: 100%; padding: 0.85rem 1rem; background-color: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 14.5px; line-height: 1.55; outline: none; font-family: inherit;">{{ old('message') }}</textarea>
                    @error('message')<p style="color: var(--primary); font-size: 13px; margin-top: 0.35rem;">{{ $message }}</p>@enderror
                </div>

                <div>
                    <button type="submit" class="btn-smash" style="padding: 0.85rem 2rem;">
                        Transmit Dispatch to Editorial Desk →
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
