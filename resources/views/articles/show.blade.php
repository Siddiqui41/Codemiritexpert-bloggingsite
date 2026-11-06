@extends('layouts.app')

@section('title', $article->title . ' — DEV Editorial')
@section('meta_description', $article->excerpt)

@section('styles')
<style>
  /* Reading Progress Bar */
  .reading-progress-bar {
    position: fixed;
    top: 0;
    left: 0;
    height: 4px;
    background-color: var(--primary);
    width: 0%;
    z-index: 999;
    transition: width 100ms ease-out;
  }

  .article-layout {
    display: grid;
    grid-template-columns: 240px minmax(0, 68ch) 1fr;
    gap: 3.5rem;
    align-items: start;
    position: relative;
    padding: 3.5rem 0 5rem;
  }

  .toc-box {
    position: sticky;
    top: 100px;
    background-color: var(--surface);
    border: 1px solid var(--border);
    border-top: 4px solid var(--primary);
    border-radius: 12px;
    padding: 1.25rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }

  .toc-title {
    font-family: var(--font-mono);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
    margin-bottom: 0.85rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
  }

  .toc-link {
    display: block;
    font-size: 14px;
    color: var(--muted);
    padding: 0.35rem 0;
    line-height: 1.45;
    text-decoration: none;
    transition: color 150ms ease;
  }

  .toc-link:hover {
    color: var(--primary);
    font-weight: 600;
  }

  /* -------------------------------------------------------------
     Article Reading Typography (Strict spec: Literata serif, 19px, line-height 1.8, max 68ch)
     ------------------------------------------------------------- */
  .article-rich-text {
    font-family: var(--font-serif);
    font-size: 19px;
    line-height: 1.8;
    color: var(--text);
    max-width: 68ch;
    margin-left: auto;
    margin-right: auto;
  }

  .article-rich-text p {
    font-size: 19px;
    line-height: 1.8;
    color: var(--text);
    margin-bottom: 1.2em;
  }

  .article-rich-text h2 {
    font-family: var(--font-heading);
    font-size: 1.875rem; /* 30px */
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-top: 2.75rem;
    margin-bottom: 1rem;
    color: var(--heading);
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
    scroll-margin-top: 100px;
    line-height: 1.25;
  }

  .article-rich-text h3 {
    font-family: var(--font-heading);
    font-size: 1.375rem; /* 22px */
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-top: 2rem;
    margin-bottom: 0.75rem;
    color: var(--heading);
    scroll-margin-top: 100px;
    line-height: 1.35;
  }

  .article-rich-text a {
    color: var(--primary);
    text-decoration: underline;
    transition: color 150ms ease;
  }

  .article-rich-text a:hover {
    color: var(--primary-hover);
  }

  .article-rich-text pre {
    background-color: var(--code-bg);
    color: var(--text);
    border: 1px solid var(--border);
    padding: 1.25rem 1.5rem;
    border-radius: 8px;
    overflow-x: auto;
    font-family: var(--font-mono);
    font-size: 14.5px;
    line-height: 1.6;
    margin: 2rem 0;
  }

  .article-rich-text code {
    font-family: var(--font-mono);
    background-color: var(--code-bg);
    color: var(--primary);
    padding: 0.15rem 0.4rem;
    border-radius: 4px;
    font-size: 0.9em;
  }

  .article-rich-text pre code {
    background: none;
    color: inherit;
    padding: 0;
  }

  .smashing-quote {
    margin: 2.25rem 0;
    padding: 1.5rem 2rem;
    background-color: var(--surface-2);
    border-left: 4px solid var(--primary);
    border-radius: 0 10px 10px 0;
    font-family: var(--font-serif);
    font-size: 1.25rem;
    font-style: italic;
    color: var(--text);
    line-height: 1.6;
  }

  .smashing-quote cite {
    display: block;
    font-family: var(--font-heading);
    font-size: 13.5px;
    font-style: normal;
    font-weight: 700;
    color: var(--primary);
    margin-top: 0.75rem;
  }

  /* Claps Button */
  .btn-clap-interactive {
    display: inline-flex;
    align-items: center;
    gap: 0.65rem;
    background-color: var(--surface);
    border: 2px solid var(--primary);
    color: var(--primary);
    font-weight: 700;
    font-size: 15px;
    padding: 0.65rem 1.35rem;
    border-radius: 9999px;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 150ms ease;
  }

  .btn-clap-interactive:hover {
    background-color: var(--primary);
    color: var(--on-primary);
    transform: scale(1.04);
  }

  @media (max-width: 1100px) {
    .article-layout {
      grid-template-columns: 1fr;
    }
    .toc-box {
      position: static;
      margin-bottom: 2rem;
    }
  }
</style>
@endsection

@section('content')

  <!-- Reading Progress Bar -->
  <div id="readingProgress" class="reading-progress-bar"></div>

  <!-- Article Banner Header (Using var(--surface) for clean card contrast) -->
  <div style="background-color: var(--surface); border-bottom: 1px solid var(--border); padding: 3.5rem 0 3rem;">
    <div class="container" style="max-width: 860px;">
      
      <!-- Breadcrumb & Kicker -->
      <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
        <a href="{{ route('home') }}" style="font-weight: 600; font-size: 14px; color: var(--muted);">Home</a>
        <span style="color: var(--muted);">/</span>
        <a href="{{ route('category.show', $article->category->slug) }}" style="font-weight: 700; font-size: 14px; color: var(--primary);">
          {{ $article->category->name }}
        </a>
        <span style="color: var(--muted);">/</span>
        <span class="label-mono" style="color: var(--primary);">
          {{ $article->kicker ?? 'Editorial Guide' }}
        </span>
      </div>

      <h1 style="font-size: clamp(2.3rem, 4.5vw, 3.25rem); font-weight: 800; line-height: 1.15; margin-bottom: 1.25rem; letter-spacing: -0.02em; color: var(--heading);">
        {{ $article->title }}
      </h1>

      <p style="font-size: 1.2rem; line-height: 1.6; color: var(--muted); margin-bottom: 2rem;">
        {{ $article->excerpt }}
      </p>

      <!-- Author Metadata Strip -->
      <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 1.5rem; border-top: 1px solid var(--border); flex-wrap: wrap; gap: 1rem;">
        <div style="display: flex; align-items: center; gap: 1rem;">
          <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid {{ $article->category->accent_color }};">
          <div>
            <div style="font-weight: 700; font-size: 16px; color: var(--heading);">{{ $article->author->name }}</div>
            <div style="font-size: 13.5px; color: var(--muted);">
              {{ $article->published_at ? $article->published_at->format('F d, Y') : 'Recent' }} • {{ $article->reading_time }} • {{ $article->views_count }} views
            </div>
          </div>
        </div>

        <div>
          <button id="clapButton" class="btn-clap-interactive" onclick="submitClap('{{ $article->slug }}')">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
            <span id="clapsDisplay">{{ $article->claps_count }}</span> Claps
          </button>
        </div>
      </div>

    </div>
  </div>

  <!-- Featured Image -->
  @if($article->cover_image)
  <div class="container" style="max-width: 960px; margin-top: 2.5rem;">
    <div style="border-radius: 12px; overflow: hidden; border: 1px solid var(--border); box-shadow: 0 4px 16px rgba(0,0,0,0.06);">
      <img src="{{ $article->cover_image_url }}" alt="{{ $article->title }}" style="width: 100%; max-height: 520px; object-fit: cover;">
      @if($article->cover_caption)
        <div style="padding: 0.75rem 1.25rem; font-size: 13.5px; color: var(--muted); background-color: var(--surface); border-top: 1px solid var(--border); font-style: italic;">
          {{ $article->cover_caption }}
        </div>
      @endif
    </div>
  </div>
  @endif

  <!-- Main Article Layout with TOC and Reading Column -->
  <div class="container">
    <div class="article-layout">
      
      <!-- Left Column: Table of Contents -->
      <aside>
        <div class="toc-box">
          <div class="toc-title">Table of Contents</div>
          <div id="dynamicToc">
            <!-- Populated via JS from h2 elements -->
          </div>
        </div>
      </aside>

      <!-- Middle Column: Reading Content (Literata Serif, 19px, line-height 1.8, max 68ch) -->
      <div>
        <div class="article-rich-text" id="articleBody">
          {!! $article->content !!}
        </div>

        <!-- Tags (using --chip-bg and --chip-text) -->
        @if($article->tags)
          <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 3.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border); align-items: center;">
            <span class="label-mono" style="margin-right: 0.5rem;">Filed Under:</span>
            @foreach($article->tags as $tag)
              <a href="{{ route('articles.search', ['q' => $tag]) }}" 
                 style="background-color: var(--chip-bg); color: var(--chip-text); font-size: 13.5px; font-weight: 600; padding: 0.3rem 0.75rem; border-radius: 9999px; text-decoration: none;">
                #{{ $tag }}
              </a>
            @endforeach
          </div>
        @endif

        <!-- Author Bio Card -->
        <div style="display: flex; gap: 1.5rem; padding: 2rem; background-color: var(--surface); border-radius: 12px; border: 1px solid var(--border); margin: 3.5rem 0; align-items: center;">
          <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}" style="width: 72px; height: 72px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); flex-shrink: 0;">
          <div>
            <span class="label-mono" style="color: var(--primary); display: block; margin-bottom: 0.35rem;">About the Author</span>
            <h3 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--heading);">{{ $article->author->name }}</h3>
            <p style="font-size: 14.5px; color: var(--muted); line-height: 1.55; margin-bottom: 0.75rem;">{{ $article->author->bio }}</p>
            @if($article->author->twitter)
              <a href="https://twitter.com/{{ ltrim($article->author->twitter, '@') }}" target="_blank" style="font-size: 14px; font-weight: 700; color: var(--primary);">
                Follow {{ $article->author->twitter }} on X →
              </a>
            @endif
          </div>
        </div>

        <!-- Comments Section -->
        <section id="discussion" style="margin-top: 4rem; padding-top: 2.5rem; border-top: 2px solid var(--border);">
          <div style="display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 2rem;">
            <h2 style="font-size: 1.875rem; font-weight: 800; color: var(--heading); margin: 0; padding: 0; border: none;">
              Community Discussion ({{ $article->comments->count() }})
            </h2>
          </div>

          <!-- Comment Submission Form -->
          <div style="background-color: var(--surface); border: 1px solid var(--border); border-radius: 12px; padding: 2rem; margin-bottom: 3rem;">
            <h4 style="font-size: 1.15rem; font-weight: 800; color: var(--heading); margin-bottom: 1.25rem;">Join the Conversation</h4>
            
            <form action="{{ route('articles.comment', $article->slug) }}" method="POST">
              @csrf
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                  <label style="display: block; font-size: 13px; font-weight: 700; color: var(--heading); margin-bottom: 0.35rem;">Your Name *</label>
                  <input type="text" name="author_name" required placeholder="e.g. Alex Morgan" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); background-color: var(--surface-2); color: var(--text); border-radius: 8px; font-size: 14.5px; outline: none;">
                </div>
                <div>
                  <label style="display: block; font-size: 13px; font-weight: 700; color: var(--heading); margin-bottom: 0.35rem;">Email Address (Private) *</label>
                  <input type="email" name="author_email" required placeholder="e.g. alex@company.com" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); background-color: var(--surface-2); color: var(--text); border-radius: 8px; font-size: 14.5px; outline: none;">
                </div>
              </div>

              <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--heading); margin-bottom: 0.35rem;">Your Thoughtful Contribution *</label>
                <textarea name="content" rows="4" required placeholder="Share your experience, alternative pattern, or question..." style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); background-color: var(--surface-2); color: var(--text); border-radius: 8px; font-size: 14.5px; line-height: 1.5; font-family: inherit; outline: none;"></textarea>
              </div>

              <button type="submit" class="btn-smash" style="padding: 0.75rem 1.5rem;">
                Post Commentary
              </button>
            </form>
          </div>

          <!-- Existing Comments List -->
          <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @forelse($article->comments as $comment)
              <div style="display: flex; gap: 1rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border);">
                <img src="{{ $comment->author_avatar ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=100&q=80' }}" alt="{{ $comment->author_name }}" style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 1px solid var(--border);">
                <div>
                  <div style="display: flex; align-items: baseline; gap: 0.75rem; margin-bottom: 0.35rem;">
                    <span style="font-weight: 700; font-size: 14.5px; color: var(--heading);">{{ $comment->author_name }}</span>
                    <span style="font-size: 13px; color: var(--muted);">{{ $comment->created_at->diffForHumans() }}</span>
                  </div>
                  <p style="font-size: 15px; color: var(--text); line-height: 1.6;">
                    {{ $comment->content }}
                  </p>
                </div>
              </div>
            @empty
              <p style="color: var(--muted); font-size: 14.5px;">No comments posted yet. Be the first to spark the discussion!</p>
            @endforelse
          </div>
        </section>

      </div>

      <!-- Right Column: Empty spacer -->
      <div></div>
    </div>
  </div>

  <!-- Related Articles Row -->
  @if($relatedArticles->count() > 0)
  <section style="background-color: var(--surface-2); padding: 4rem 0; border-top: 1px solid var(--border);">
    <div class="container">
      <div style="margin-bottom: 2rem;">
        <h3 style="font-size: 1.65rem; font-weight: 800; color: var(--heading);">Related In {{ $article->category->name }}</h3>
      </div>
      <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
        @foreach($relatedArticles as $rel)
          <article class="smash-card" style="border-top-color: {{ $rel->category->accent_color }}; padding: 1.5rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
              <span style="display: inline-flex; align-items: center; gap: 0.35rem;">
                <span style="width: 7px; height: 7px; border-radius: 50%; background-color: {{ $rel->category->accent_color }}; display: inline-block;"></span>
                <span class="label-mono" style="color: var(--primary);">{{ $rel->category->name }}</span>
              </span>
              <span style="font-size: 13px; color: var(--muted);">{{ $rel->reading_time }}</span>
            </div>
            <div>
              <h4 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">
                <a href="{{ route('articles.show', $rel->slug) }}" style="color: var(--heading); text-decoration: none;">{{ $rel->title }}</a>
              </h4>
              <p style="font-size: 14px; color: var(--text); line-height: 1.55;">{{ $rel->excerpt }}</p>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

@endsection

@section('scripts')
<script>
  // 1. Reading Progress Bar
  window.addEventListener('scroll', () => {
    const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = totalHeight > 0 ? (window.scrollY / totalHeight) * 100 : 0;
    document.getElementById('readingProgress').style.width = Math.min(100, Math.max(0, progress)) + '%';
  });

  // 2. Generate Dynamic TOC from H2
  document.addEventListener('DOMContentLoaded', () => {
    const body = document.getElementById('articleBody');
    const tocContainer = document.getElementById('dynamicToc');
    if (!body || !tocContainer) return;

    const headings = body.querySelectorAll('h2');
    if (headings.length === 0) {
      const box = document.querySelector('.toc-box');
      if (box) box.style.display = 'none';
      return;
    }

    headings.forEach((h2, idx) => {
      let id = h2.getAttribute('id');
      if (!id) {
        id = 'section-' + idx;
        h2.setAttribute('id', id);
      }
      const link = document.createElement('a');
      link.href = '#' + id;
      link.className = 'toc-link';
      link.textContent = h2.textContent;
      tocContainer.appendChild(link);
    });
  });

  // 3. Interactive Claps AJAX
  function submitClap(slug) {
    const btn = document.getElementById('clapButton');
    const display = document.getElementById('clapsDisplay');

    fetch(`/articles/${slug}/clap`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        display.textContent = data.claps_count;
        btn.style.transform = 'scale(1.1)';
        setTimeout(() => btn.style.transform = '', 150);
      }
    })
    .catch(err => console.error(err));
  }
</script>
@endsection
