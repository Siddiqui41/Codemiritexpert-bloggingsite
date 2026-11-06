<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $__env->yieldContent('title', 'DEV — Modern Engineering & Design'); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'DEV is a modern editorial publication for front-end engineers, architects, and web creators.'); ?>">

  <!-- Immediate Theme Application (Zero flash of unstyled content) -->
  <script>
    (function () {
      try {
        localStorage.removeItem('site-theme-pos');
        var theme = localStorage.getItem('site-theme');
        if (theme === 'night') {
          theme = 'dark';
        } else if (theme === 'warm' || theme === 'blue' || theme === 'green') {
          theme = 'light';
        }
        if (!theme || (theme !== 'light' && theme !== 'dark')) {
          theme = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
        }
        localStorage.setItem('site-theme', theme);
        document.documentElement.setAttribute('data-theme', theme);
        document.documentElement.style.colorScheme = theme;
      } catch (e) {
        document.documentElement.setAttribute('data-theme', 'light');
        document.documentElement.style.colorScheme = 'light';
      }
    })();
  </script>

  <!-- Google Fonts: Plus Jakarta Sans, Literata (serif for reading), JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Literata:ital,opsz,wght@0,7..72,400;0,7..72,500;0,7..72,600;0,7..72,700;0,7..72,800;1,7..72,400;1,7..72,600&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: ['selector', '[data-theme="dark"]'],
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
            serif: ['Literata', 'Georgia', 'serif'],
            mono: ['"JetBrains Mono"', 'monospace'],
          }
        }
      }
    }
  </script>

  <style>
    /* ========================================================
       GLOBAL COLOR SYSTEM (Single unified token architecture)
       ======================================================== */
    :root, [data-theme="light"] {
      color-scheme: light;
      --bg:            #FAFAF7;  /* page background */
      --surface:       #FFFFFF;  /* cards, topics bar, sidebar, footer */
      --surface-2:     #F4F3EE;  /* subtle panels, table stripes */
      --heading:       #14131C;  /* headings */
      --text:          #2B2A35;  /* body text */
      --muted:         #5C5B68;  /* dates, authors, captions, counts */
      --primary:       #4338CA;  /* links, buttons, active states */
      --primary-hover: #3730A3;
      --on-primary:    #FFFFFF;
      --brand:         #4338CA;  /* header band */
      --on-brand:      #FFFFFF;
      --hero-bg:       #4338CA;  /* category hero card */
      --on-hero:       #FFFFFF;
      --on-hero-muted: #E0E7FF;
      --accent:        #FBBF24;  /* Dashboard / main CTA button */
      --on-accent:     #1F1600;
      --chip-bg:       #ECEBFF;  /* topic pills */
      --chip-text:     #3730A3;
      --chip2-bg:      #D8F3E6;  /* secondary tags (green) */
      --chip2-text:    #0A5C3F;
      --border:        #E4E2EA;
      --code-bg:       #F0EFF6;

      /* Legacy compatibility mappings */
      --bg-page: var(--bg);
      --bg-surface: var(--surface);
      --bg-surface-soft: var(--surface-2);
      --text-main: var(--text);
      --text-muted: var(--muted);
      --brand-primary: var(--primary);
      --brand-primary-hover: var(--primary-hover);
      --brand-midnight: var(--surface);
      --brand-navy: var(--surface);
      --brand-amber: var(--accent);
      --brand-amber-light: var(--chip-bg);
      --brand-emerald: var(--chip2-text);
      --border-light: var(--border);
      --border-dark: var(--border);
    }

    [data-theme="dark"] {
      color-scheme: dark;
      --bg:            #12111A;
      --surface:       #1B1A27;
      --surface-2:     #232233;
      --heading:       #F5F4FB;
      --text:          #DAD9E6;
      --muted:         #A9A8BD;
      --primary:       #A5B4FC;
      --primary-hover: #C7D2FE;
      --on-primary:    #14122E;
      --brand:         #1E1B4B;
      --on-brand:      #FFFFFF;
      --hero-bg:       #2E2A7A;
      --on-hero:       #FFFFFF;
      --on-hero-muted: #E0E7FF;
      --accent:        #FBBF24;
      --on-accent:     #1F1600;
      --chip-bg:       rgba(165, 180, 252, 0.16);
      --chip-text:     #C7D2FE;
      --chip2-bg:      rgba(52, 211, 153, 0.16);
      --chip2-text:    #86EFAC;
      --border:        #2E2D40;
      --code-bg:       #232233;

      /* Legacy compatibility mappings */
      --bg-page: var(--bg);
      --bg-surface: var(--surface);
      --bg-surface-soft: var(--surface-2);
      --text-main: var(--text);
      --text-muted: var(--muted);
      --brand-primary: var(--primary);
      --brand-primary-hover: var(--primary-hover);
      --brand-midnight: var(--surface);
      --brand-navy: var(--surface);
      --brand-amber: var(--accent);
      --brand-amber-light: var(--chip-bg);
      --brand-emerald: var(--chip2-text);
      --border-light: var(--border);
      --border-dark: var(--border);
    }

    /* Base Font & Styles */
    :root {
      --font-heading: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      --font-body: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      --font-serif: 'Literata', Georgia, serif;
      --font-mono: 'JetBrains Mono', monospace;
    }

    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--bg);
      color: var(--text);
      font-family: var(--font-body);
      font-size: 16px;
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      -webkit-font-smoothing: antialiased;
      transition: background-color 150ms ease, color 150ms ease;
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: var(--font-heading);
      color: var(--heading);
      font-weight: 800;
      letter-spacing: -0.02em;
    }

    h1 {
      font-size: clamp(2.5rem, 5vw, 3rem);
      line-height: 1.15;
    }

    h2 {
      font-size: 1.875rem; /* 30px */
      line-height: 1.25;
    }

    h3 {
      font-size: 1.375rem; /* 22px */
      line-height: 1.35;
    }

    /* Links in prose */
    a {
      color: inherit;
      text-decoration: none;
      transition: color 150ms ease;
    }

    .prose-link {
      color: var(--primary);
      text-decoration: underline;
    }
    .prose-link:hover {
      color: var(--primary-hover);
    }

    /* Focus ring standard */
    a:focus-visible,
    button:focus-visible,
    input:focus-visible,
    select:focus-visible,
    textarea:focus-visible {
      outline: 2px solid var(--primary);
      outline-offset: 2px;
    }

    .header-band a:focus-visible,
    .header-band button:focus-visible,
    .header-band input:focus-visible {
      outline: 2px solid #FFFFFF !important;
      outline-offset: 2px !important;
    }

    img {
      display: block;
      max-width: 100%;
      height: auto;
    }

    .container {
      width: 100%;
      max-width: 1240px;
      margin-left: auto;
      margin-right: auto;
      padding-left: 1.5rem;
      padding-right: 1.5rem;
    }

    /* Uppercase mono labels */
    .label-mono {
      font-family: var(--font-mono);
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--muted);
    }

    /* -------------------------------------------------------------
       1. Header Band
       ------------------------------------------------------------- */
    .header-band {
      background-color: var(--brand);
      color: var(--on-brand);
      position: sticky;
      top: 0;
      z-index: 100;
      border-bottom: 1px solid rgba(0, 0, 0, 0.15);
    }

    .header-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 72px;
      gap: 1.5rem;
    }

    .brand-logo-wrap {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
      color: var(--on-brand);
      flex-shrink: 0;
    }

    .brand-icon {
      width: 34px;
      height: 34px;
      border-radius: 9px;
      background-color: rgba(255, 255, 255, 0.18);
      color: var(--on-brand);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .brand-wordmark {
      font-size: 1.55rem;
      font-weight: 900;
      letter-spacing: -0.03em;
      color: var(--on-brand);
      line-height: 1;
    }

    .nav-links-desktop {
      display: flex;
      align-items: center;
      gap: 0.35rem;
    }

    .nav-item {
      font-size: 16px;
      font-weight: 600;
      color: var(--on-brand);
      padding: 0.45rem 0.95rem;
      border-radius: 9999px;
      text-decoration: none;
      transition: background-color 150ms ease, color 150ms ease;
      display: inline-block;
    }

    .nav-item:hover,
    .nav-item.active {
      background-color: rgba(0, 0, 0, 0.22);
      color: var(--on-brand);
    }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 0.85rem;
      flex-shrink: 0;
    }

    /* Header Search */
    .header-search-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }

    .header-search-icon {
      position: absolute;
      left: 12px;
      color: var(--muted);
      pointer-events: none;
    }

    .header-search-input {
      background-color: var(--surface);
      color: var(--text);
      border: 1px solid var(--border);
      border-radius: 9999px;
      padding: 0.45rem 1rem 0.45rem 2.25rem;
      font-size: 14px;
      font-weight: 500;
      width: 175px;
      transition: width 200ms ease, border-color 150ms ease;
      outline: none;
    }

    .header-search-input::placeholder {
      color: var(--muted);
      opacity: 1;
    }

    .header-search-input:focus {
      width: 215px;
      outline: 2px solid #FFFFFF;
      outline-offset: 2px;
    }

    /* Theme Toggle Switch */
    .theme-toggle-switch {
      position: relative;
      width: 52px;
      height: 28px;
      background-color: rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.28);
      border-radius: 9999px;
      padding: 0 5px;
      display: inline-flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      outline: none;
      box-sizing: border-box;
      flex-shrink: 0;
      transition: background-color 150ms ease, border-color 150ms ease;
    }

    .theme-toggle-switch:focus-visible {
      outline: 2px solid #FFFFFF;
      outline-offset: 2px;
    }

    .toggle-icon-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1;
      pointer-events: none;
      width: 14px;
      height: 14px;
    }

    .toggle-sun {
      color: #FDE047;
    }

    .toggle-moon {
      color: #C7D2FE;
    }

    .toggle-thumb {
      position: absolute;
      top: 2px;
      left: 2px;
      width: 22px;
      height: 22px;
      background-color: #FFFFFF;
      border-radius: 50%;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
      transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 2;
      pointer-events: none;
    }

    [data-theme="dark"] .theme-toggle-switch {
      background-color: rgba(0, 0, 0, 0.5);
      border-color: rgba(255, 255, 255, 0.35);
    }

    [data-theme="dark"] .toggle-thumb {
      transform: translateX(24px);
      background-color: #FFFFFF;
    }

    @media (prefers-reduced-motion: reduce) {
      .theme-toggle-switch,
      .toggle-thumb {
        transition: none !important;
      }
    }

    /* Header Dashboard Button */
    .btn-dashboard-header {
      background-color: var(--accent);
      color: var(--on-accent) !important;
      font-weight: 700;
      font-size: 14px;
      padding: 0.45rem 1.15rem;
      border-radius: 9999px;
      text-decoration: none;
      transition: filter 150ms ease, transform 150ms ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: none;
    }

    .btn-dashboard-header:hover {
      filter: brightness(0.95);
      transform: translateY(-1px);
      color: var(--on-accent) !important;
    }

    /* -------------------------------------------------------------
       2. Topics Navigation Bar (Below Header)
       ------------------------------------------------------------- */
    .topics-strip {
      background-color: var(--surface);
      border-bottom: 1px solid var(--border);
      padding: 0.65rem 0;
      transition: background-color 150ms ease, border-color 150ms ease;
    }

    .topics-scroll-row {
      display: flex;
      align-items: center;
      gap: 0.85rem;
      overflow-x: auto;
      scrollbar-width: thin;
      scrollbar-color: var(--border) transparent;
      -webkit-overflow-scrolling: touch;
      padding-bottom: 2px;
    }

    .topics-scroll-row::-webkit-scrollbar {
      height: 4px;
    }
    .topics-scroll-row::-webkit-scrollbar-track {
      background: transparent;
    }
    .topics-scroll-row::-webkit-scrollbar-thumb {
      background-color: var(--border);
      border-radius: 4px;
    }

    .topics-label {
      font-family: var(--font-mono);
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--muted);
      white-space: nowrap;
      flex-shrink: 0;
    }

    .topics-list {
      display: flex;
      align-items: center;
      gap: 0.65rem;
    }

    .topic-pill {
      font-size: 14px;
      font-weight: 600;
      padding: 0.35rem 0.95rem;
      border-radius: 9999px;
      background-color: var(--chip-bg);
      color: var(--chip-text);
      text-decoration: none;
      white-space: nowrap;
      transition: filter 150ms ease, background-color 150ms ease, color 150ms ease;
      display: inline-flex;
      align-items: center;
    }

    .topic-pill:hover {
      filter: brightness(0.93);
      color: var(--chip-text);
    }

    .topic-pill.active {
      background-color: var(--primary);
      color: var(--on-primary);
      filter: none;
    }

    .topic-pill.active:hover {
      background-color: var(--primary-hover);
      color: var(--on-primary);
    }

    /* -------------------------------------------------------------
       3. Reusable Component Styles
       ------------------------------------------------------------- */
    .smash-card,
    .article-card-smashing {
      background-color: var(--surface);
      border: 1px solid var(--border);
      border-top: 4px solid var(--primary);
      border-radius: 12px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      transition: transform 200ms ease, box-shadow 200ms ease;
    }

    .smash-card:hover,
    .article-card-smashing:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.09);
    }

    .btn-smash {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      background-color: var(--primary);
      color: var(--on-primary) !important;
      font-weight: 700;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-size: 15px;
      transition: background-color 150ms ease, transform 150ms ease;
      cursor: pointer;
      text-decoration: none;
      border: none;
    }

    .btn-smash:hover {
      background-color: var(--primary-hover);
      transform: translateY(-1px);
      color: var(--on-primary) !important;
    }

    /* Category Hero Card */
    .category-hero-card {
      background-color: var(--hero-bg);
      color: var(--on-hero);
      border-radius: 20px;
      padding: 3rem 2.5rem;
      margin-bottom: 2.5rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      border-top: 6px solid var(--primary);
    }

    .category-hero-title {
      font-size: clamp(2.5rem, 5vw, 3rem);
      font-weight: 800;
      letter-spacing: -0.02em;
      color: var(--on-hero);
      margin-bottom: 1rem;
      line-height: 1.15;
    }

    .category-hero-subtitle {
      font-size: 1.15rem;
      line-height: 1.65;
      color: var(--on-hero-muted);
      margin-bottom: 1.5rem;
      max-width: 720px;
    }

    .category-badge-chip {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background-color: rgba(255, 255, 255, 0.16);
      color: var(--on-hero);
      padding: 0.35rem 0.85rem;
      border-radius: 9999px;
      font-size: 13px;
      font-weight: 600;
    }

    /* Switch Topic Row */
    .switch-topic-row {
      display: flex;
      align-items: center;
      gap: 0.65rem;
      overflow-x: auto;
      scrollbar-width: thin;
      scrollbar-color: var(--border) transparent;
      padding-bottom: 0.5rem;
      margin-bottom: 2.5rem;
    }

    .switch-topic-row::-webkit-scrollbar {
      height: 4px;
    }
    .switch-topic-row::-webkit-scrollbar-thumb {
      background-color: var(--border);
      border-radius: 4px;
    }

    .switch-topic-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.4rem 0.95rem;
      border-radius: 9999px;
      background-color: var(--surface);
      border: 1px solid var(--border);
      color: var(--heading);
      font-size: 13.5px;
      font-weight: 600;
      white-space: nowrap;
      text-decoration: none;
      transition: all 150ms ease;
    }

    .switch-topic-pill:hover {
      background-color: var(--surface-2);
      color: var(--heading);
    }

    .switch-topic-pill .topic-count {
      color: var(--muted);
      font-size: 13px;
      font-weight: 500;
    }

    .switch-topic-pill.active {
      background-color: var(--primary);
      border-color: var(--primary);
      color: var(--on-primary);
      font-weight: 700;
    }

    .switch-topic-pill.active .topic-count {
      color: var(--on-primary);
      font-weight: 600;
    }

    /* -------------------------------------------------------------
       4. Site Footer
       ------------------------------------------------------------- */
    .site-footer {
      background-color: var(--surface);
      color: var(--text);
      border-top: 1px solid var(--border);
      padding-top: 4rem;
      padding-bottom: 3rem;
      margin-top: auto;
      transition: background-color 150ms ease, border-color 150ms ease;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 1.5fr repeat(3, 1fr);
      gap: 3rem;
      margin-bottom: 3.5rem;
    }

    .footer-title {
      font-size: 13px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--heading);
      margin-bottom: 1.25rem;
    }

    .footer-links-list {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .footer-link-item {
      font-size: 14.5px;
      color: var(--muted);
      text-decoration: none;
      transition: color 150ms ease;
    }

    .footer-link-item:hover {
      color: var(--primary);
    }

    .footer-bottom-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 2rem;
      border-top: 1px solid var(--border);
      font-size: 13.5px;
      color: var(--muted);
    }

    /* Flash Message */
    .flash-alert {
      padding: 0.9rem 1.5rem;
      background-color: var(--chip2-text);
      color: #FFFFFF;
      font-weight: 700;
      text-align: center;
      position: sticky;
      top: 0;
      z-index: 200;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      font-size: 14px;
    }

    @media (max-width: 900px) {
      .footer-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 640px) {
      .nav-links-desktop {
        display: none;
      }
      .header-search-input {
        width: 130px;
      }
      .header-search-input:focus {
        width: 160px;
      }
      .footer-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Laravel Pagination Component Theme & Contrast Overrides */
    nav[role="navigation"] {
      color: var(--text) !important;
    }
    nav[role="navigation"] p {
      color: var(--muted) !important;
    }
    nav[role="navigation"] p span {
      color: var(--heading) !important;
      font-weight: 700 !important;
    }
    nav[role="navigation"] span[aria-current="page"] span {
      background-color: var(--primary) !important;
      color: var(--on-primary) !important;
      border-color: var(--primary) !important;
    }
    nav[role="navigation"] a,
    nav[role="navigation"] span[aria-disabled="true"] span {
      background-color: var(--surface) !important;
      color: var(--text) !important;
      border-color: var(--border) !important;
    }
    nav[role="navigation"] a:hover {
      background-color: var(--surface-2) !important;
      color: var(--primary) !important;
    }
  </style>

  <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

  <!-- Flash Messages -->
  <?php if(session('status') || session('comment_success') || session('newsletter_success') || session('contact_success')): ?>
    <div class="flash-alert" role="status">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
      <span><?php echo e(session('status') ?? session('comment_success') ?? session('newsletter_success') ?? session('contact_success')); ?></span>
    </div>
  <?php endif; ?>

  <!-- 1. Header Band -->
  <header class="header-band">
    <div class="container">
      <div class="header-inner">
        <!-- Logo and DEV Wordmark Grouped Together -->
        <a href="<?php echo e(route('home')); ?>" class="brand-logo-wrap" aria-label="DEV Home">
          <div class="brand-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="16 18 22 12 16 6"/>
              <polyline points="8 6 2 12 8 18"/>
            </svg>
          </div>
          <span class="brand-wordmark">DEV</span>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="nav-links-desktop" aria-label="Main Navigation">
          <a href="<?php echo e(route('home')); ?>" class="nav-item <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Articles</a>
          <a href="<?php echo e(route('pages.guides')); ?>" class="nav-item <?php echo e(request()->routeIs('pages.guides') ? 'active' : ''); ?>">Guides</a>
          <a href="<?php echo e(route('pages.books')); ?>" class="nav-item <?php echo e(request()->routeIs('pages.books') ? 'active' : ''); ?>">Books</a>
          <a href="<?php echo e(route('pages.workshops')); ?>" class="nav-item <?php echo e(request()->routeIs('pages.workshops') ? 'active' : ''); ?>">Workshops</a>
          <a href="<?php echo e(route('pages.about')); ?>" class="nav-item <?php echo e(request()->routeIs('pages.about') ? 'active' : ''); ?>">About</a>
          <a href="<?php echo e(route('pages.contact')); ?>" class="nav-item <?php echo e(request()->routeIs('pages.contact') ? 'active' : ''); ?>">Contact</a>
        </nav>

        <!-- Right Side Header Actions: Search, Toggle Switch, Dashboard Button -->
        <div class="header-actions">
          <!-- Search Form -->
          <form action="<?php echo e(route('articles.search')); ?>" method="GET" class="header-search-wrap" role="search">
            <svg class="header-search-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search..." class="header-search-input" aria-label="Search articles">
          </form>

          <!-- New Accessible Theme Toggle Switch -->
          <button type="button" 
                  id="theme-toggle" 
                  class="theme-toggle-switch" 
                  role="switch" 
                  aria-checked="false" 
                  aria-label="Dark mode">
            <span class="toggle-icon-wrap toggle-sun" aria-hidden="true">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4"/>
                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
              </svg>
            </span>
            <span class="toggle-icon-wrap toggle-moon" aria-hidden="true">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
              </svg>
            </span>
            <span class="toggle-thumb" aria-hidden="true"></span>
          </button>

          <!-- Dashboard / Admin Button -->
          <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn-dashboard-header">Dashboard</a>
          <?php else: ?>
            <a href="<?php echo e(route('admin.login')); ?>" class="btn-dashboard-header">Dashboard</a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- 2. Topics Bar (Below Header) -->
    <div class="topics-strip">
      <div class="container">
        <div class="topics-scroll-row">
          <span class="topics-label">TOPICS:</span>
          <div class="topics-list">
            <?php
              $globalCategories = \App\Models\Category::orderBy('order')->get();
            ?>
            <?php $__currentLoopData = $globalCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $isActive = (isset($category) && $category->id === $cat->id);
              ?>
              <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="topic-pill <?php echo e($isActive ? 'active' : ''); ?>">
                <?php echo e($cat->name); ?>

              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main style="flex-grow: 1;">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <!-- 3. Site Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <a href="<?php echo e(route('home')); ?>" class="brand-logo-wrap" style="color: var(--heading); margin-bottom: 1.25rem;">
            <div class="brand-icon" style="background-color: var(--primary); color: var(--on-primary);">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="16 18 22 12 16 6"/>
                <polyline points="8 6 2 12 8 18"/>
              </svg>
            </div>
            <span class="brand-wordmark" style="color: var(--heading);">DEV</span>
          </a>
          <p style="font-size: 14.5px; line-height: 1.65; color: var(--muted); margin-bottom: 1.5rem; max-width: 340px;">
            With a passion for human-centered design, inclusive code, and reliable front-end engineering. Delivering practical wisdom for designers and engineers worldwide.
          </p>
        </div>

        <div>
          <h4 class="footer-title">Browse Topics</h4>
          <div class="footer-links-list">
            <?php $__currentLoopData = $globalCategories->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e(route('category.show', $fCat->slug)); ?>" class="footer-link-item"><?php echo e($fCat->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

        <div>
          <h4 class="footer-title">Publications</h4>
          <div class="footer-links-list">
            <a href="<?php echo e(route('pages.guides')); ?>" class="footer-link-item">Engineering Guides</a>
            <a href="<?php echo e(route('pages.books')); ?>" class="footer-link-item">Printed & eBook Library</a>
            <a href="<?php echo e(route('pages.workshops')); ?>" class="footer-link-item">Online Live Masterclasses</a>
            <a href="<?php echo e(route('pages.about')); ?>" class="footer-link-item">Editorial Mission</a>
            <a href="<?php echo e(route('pages.contact')); ?>" class="footer-link-item">Pitch an Article</a>
          </div>
        </div>

        <div>
          <h4 class="footer-title">Weekly Dispatch</h4>
          <p style="font-size: 14px; margin-bottom: 1rem; color: var(--muted); line-height: 1.5;">
            A curated summary of useful tips and front-end techniques sent directly to your inbox.
          </p>
          <form action="<?php echo e(route('newsletter.subscribe')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div style="display: flex; gap: 0.4rem;">
              <input type="email" name="email" placeholder="Your developer email..." required style="padding: 0.55rem 0.85rem; border-radius: 8px; border: 1px solid var(--border); background-color: var(--surface-2); color: var(--text); font-size: 14px; flex-grow: 1; outline: none;">
              <button type="submit" style="background-color: var(--primary); color: var(--on-primary); border: none; font-weight: 700; padding: 0.55rem 1rem; border-radius: 8px; font-size: 14px; cursor: pointer;">Join</button>
            </div>
          </form>
        </div>
      </div>

      <div class="footer-bottom-bar">
        <span>© 2026 DEV Editorial Magazine. Built with clean code & modern CSS.</span>
        <div style="display: flex; gap: 1.5rem;">
          <a href="<?php echo e(route('pages.about')); ?>" class="footer-link-item">About Us</a>
          <a href="<?php echo e(route('pages.contact')); ?>" class="footer-link-item">Contact</a>
          <a href="<?php echo e(route('admin.login')); ?>" class="footer-link-item" style="color: var(--primary); font-weight: 700;">Admin Panel</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Theme Toggle Controller Script -->
  <script>
    (function() {
      function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        document.documentElement.style.colorScheme = theme;
        try {
          localStorage.setItem('site-theme', theme);
        } catch (e) {}

        var toggles = document.querySelectorAll('.theme-toggle-switch, #theme-toggle');
        toggles.forEach(function(btn) {
          btn.setAttribute('aria-checked', theme === 'dark' ? 'true' : 'false');
        });
      }

      function initToggles() {
        var current = document.documentElement.getAttribute('data-theme') || 'light';
        var toggles = document.querySelectorAll('.theme-toggle-switch, #theme-toggle');
        toggles.forEach(function(btn) {
          btn.setAttribute('aria-checked', current === 'dark' ? 'true' : 'false');
          btn.addEventListener('click', function() {
            var cur = document.documentElement.getAttribute('data-theme') || 'light';
            var next = cur === 'dark' ? 'light' : 'dark';
            applyTheme(next);
          });
        });
      }

      window.addEventListener('storage', function(e) {
        if (e.key === 'site-theme' && e.newValue) {
          var nextTheme = e.newValue === 'dark' ? 'dark' : 'light';
          document.documentElement.setAttribute('data-theme', nextTheme);
          document.documentElement.style.colorScheme = nextTheme;
          var toggles = document.querySelectorAll('.theme-toggle-switch, #theme-toggle');
          toggles.forEach(function(btn) {
            btn.setAttribute('aria-checked', nextTheme === 'dark' ? 'true' : 'false');
          });
        }
      });

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initToggles);
      } else {
        initToggles();
      }
    })();
  </script>

  <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/layouts/app.blade.php ENDPATH**/ ?>