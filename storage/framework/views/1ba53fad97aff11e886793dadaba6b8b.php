<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Editorial Console'); ?> — DEV Admin</title>
    
    <!-- Immediate Theme Application (Zero flash) -->
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: ['selector', '[data-theme="dark"]'],
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
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
        }

        /* Backward compatibility mappings */
        :root {
          --bg-page: var(--bg);
          --bg-surface: var(--surface);
          --bg-surface-soft: var(--surface-2);
          --bg-sidebar: var(--surface);
          --bg-header: var(--surface);
          --border-color: var(--border);
          --border-light: var(--border);
          --brand-primary: var(--primary);
          --brand-primary-hover: var(--primary-hover);
          --brand-light: var(--chip-bg);
          --brand-midnight: var(--surface);
          --brand-navy: var(--surface);
          --brand-amber: var(--accent);
          --brand-emerald: var(--chip2-text);
          --text-main: var(--text);
          --text-muted: var(--muted);
          --text-on-primary: var(--on-primary);
          --input-bg: var(--surface);
          --input-border: var(--border);
          --table-hover: var(--surface-2);
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            transition: background-color 150ms ease, color 150ms ease;
        }

        .theme-surface {
            background-color: var(--surface);
            border-color: var(--border);
            color: var(--text);
        }

        .theme-surface-soft {
            background-color: var(--surface-2);
            border-color: var(--border);
        }

        .theme-sidebar {
            background-color: var(--surface);
            border-color: var(--border);
        }

        .theme-header {
            background-color: var(--surface);
            border-color: var(--border);
        }

        .theme-primary-btn {
            background-color: var(--primary);
            color: var(--on-primary) !important;
            transition: all 0.15s ease;
        }
        .theme-primary-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .theme-input {
            background-color: var(--surface-2);
            border-color: var(--border);
            color: var(--text);
        }
        .theme-input:focus {
            border-color: var(--primary);
            outline: 2px solid var(--primary);
            outline-offset: -1px;
        }

        /* Theme Toggle Switch */
        .theme-toggle-switch {
          position: relative;
          width: 52px;
          height: 28px;
          background-color: var(--surface-2);
          border: 1px solid var(--border);
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
          outline: 2px solid var(--primary);
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
          color: #EAB308;
        }

        .toggle-moon {
          color: #818CF8;
        }

        .toggle-thumb {
          position: absolute;
          top: 2px;
          left: 2px;
          width: 22px;
          height: 22px;
          background-color: #FFFFFF;
          border-radius: 50%;
          box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
          transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1);
          z-index: 2;
          pointer-events: none;
        }

        [data-theme="dark"] .toggle-thumb {
          transform: translateX(24px);
        }

        @media (prefers-reduced-motion: reduce) {
          .theme-toggle-switch,
          .toggle-thumb {
            transition: none !important;
          }
        }
    </style>
</head>
<body class="h-full font-sans flex flex-col md:flex-row antialiased">

    <!-- Sidebar Navigation -->
    <aside class="w-full md:w-64 theme-sidebar border-r flex flex-col shrink-0 z-30 shadow-sm" style="border-color: var(--border);">
        <!-- Logo / Brand Header -->
        <div class="p-6 border-b" style="border-color: var(--border);">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-black text-xl shadow-md" style="background-color: var(--primary); color: var(--on-primary);">
                    DEV
                </div>
                <div>
                    <span class="font-bold text-lg tracking-tight block" style="color: var(--heading);">DEV Studio</span>
                    <span class="text-[11px] font-mono font-bold uppercase tracking-wider block" style="color: var(--primary);">Editorial CMS</span>
                </div>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-2 flex-1">
            <div class="px-3 py-1 text-[11px] font-mono font-bold uppercase tracking-wider" style="color: var(--muted);">
                Management Menu
            </div>

            <a href="<?php echo e(route('admin.dashboard')); ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold font-mono tracking-wider transition-all <?php echo e(request()->routeIs('admin.dashboard') ? 'shadow-sm font-bold' : 'hover:opacity-80'); ?>"
               style="<?php echo e(request()->routeIs('admin.dashboard') ? 'background-color: var(--primary); color: var(--on-primary);' : 'color: var(--text);'); ?>">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>DASHBOARD</span>
            </a>

            <a href="<?php echo e(route('admin.articles.index')); ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold font-mono tracking-wider transition-all <?php echo e(request()->routeIs('admin.articles.*') ? 'shadow-sm font-bold' : 'hover:opacity-80'); ?>"
               style="<?php echo e(request()->routeIs('admin.articles.*') ? 'background-color: var(--primary); color: var(--on-primary);' : 'color: var(--text);'); ?>">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <span>ARTICLES (BLOGS)</span>
            </a>

            <a href="<?php echo e(route('admin.categories.index')); ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold font-mono tracking-wider transition-all <?php echo e(request()->routeIs('admin.categories.*') ? 'shadow-sm font-bold' : 'hover:opacity-80'); ?>"
               style="<?php echo e(request()->routeIs('admin.categories.*') ? 'background-color: var(--primary); color: var(--on-primary);' : 'color: var(--text);'); ?>">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                <span>TOPICS / CATEGORIES</span>
            </a>

            <a href="<?php echo e(route('admin.comments.index')); ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold font-mono tracking-wider transition-all <?php echo e(request()->routeIs('admin.comments.*') ? 'shadow-sm font-bold' : 'hover:opacity-80'); ?>"
               style="<?php echo e(request()->routeIs('admin.comments.*') ? 'background-color: var(--primary); color: var(--on-primary);' : 'color: var(--text);'); ?>">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <span>COMMENTS MODERATION</span>
            </a>

            <a href="<?php echo e(route('admin.subscribers.index')); ?>" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold font-mono tracking-wider transition-all <?php echo e(request()->routeIs('admin.subscribers.*') ? 'shadow-sm font-bold' : 'hover:opacity-80'); ?>"
               style="<?php echo e(request()->routeIs('admin.subscribers.*') ? 'background-color: var(--primary); color: var(--on-primary);' : 'color: var(--text);'); ?>">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span>SUBSCRIBERS</span>
            </a>

            <div class="pt-4 mt-4 border-t" style="border-color: var(--border);">
                <a href="<?php echo e(route('home')); ?>" target="_blank" class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-mono font-medium hover:underline" style="color: var(--primary);">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Public Site ↗</span>
                </a>
            </div>
        </nav>

        <!-- Current User Profile & Sign Out Button -->
        <div class="p-4 border-t flex items-center justify-between" style="border-color: var(--border); background-color: var(--surface-2);">
            <div class="flex items-center gap-3 overflow-hidden">
                <img src="<?php echo e(auth()->user()->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80'); ?>" 
                     alt="<?php echo e(auth()->user()->name ?? 'Admin'); ?>" 
                     class="w-8 h-8 rounded-full object-cover ring-2 ring-primary/30 shrink-0">
                <div class="overflow-hidden">
                    <p class="text-xs font-bold truncate" style="color: var(--heading);"><?php echo e(auth()->user()->name ?? 'Editorial Admin'); ?></p>
                    <p class="text-[11px] font-mono truncate" style="color: var(--muted);"><?php echo e(auth()->user()->email ?? 'admin@dev.site'); ?></p>
                </div>
            </div>

            <!-- Sign Out Form -->
            <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" title="Logout from Admin Panel" class="p-2 rounded-xl hover:bg-rose-500/10 text-rose-500 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Body -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- Top Banner Bar -->
        <header class="theme-header border-b px-6 py-4 flex flex-wrap items-center justify-between gap-4 sticky top-0 z-20" style="border-color: var(--border);">
            <div class="flex items-center gap-3">
                <h1 class="text-lg font-bold" style="color: var(--heading);"><?php echo $__env->yieldContent('page_title', 'Editorial Overview'); ?></h1>
            </div>

            <!-- Header Controls: Theme Toggle & Action Button -->
            <div class="flex items-center gap-4">
                <button type="button" 
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

                <a href="<?php echo e(route('admin.articles.create')); ?>" class="theme-primary-btn inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold font-mono uppercase tracking-wider shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>+ New Blog Post</span>
                </a>
            </div>
        </header>

        <!-- Flash Notifications -->
        <?php if(session('success')): ?>
            <div class="mx-6 mt-6 p-4 rounded-xl flex items-center gap-3 text-sm border shadow-sm" style="background-color: var(--chip2-bg); border-color: var(--chip2-text); color: var(--chip2-text);">
                <span class="font-bold text-lg">✓</span>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="mx-6 mt-6 p-4 rounded-xl flex items-center gap-3 text-sm border shadow-sm" style="background-color: rgba(217, 93, 81, 0.15); border-color: #D95D51; color: var(--text);">
                <span class="font-bold text-lg" style="color: #D95D51;">✕</span>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <!-- Main Page Body -->
        <main class="p-6 md:p-8 flex-1">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- Toggle Script -->
    <script>
      (function() {
        function applyTheme(theme) {
          document.documentElement.setAttribute('data-theme', theme);
          document.documentElement.style.colorScheme = theme;
          try {
            localStorage.setItem('site-theme', theme);
          } catch (e) {}

          var toggles = document.querySelectorAll('.theme-toggle-switch');
          toggles.forEach(function(btn) {
            btn.setAttribute('aria-checked', theme === 'dark' ? 'true' : 'false');
          });
        }

        function initToggles() {
          var current = document.documentElement.getAttribute('data-theme') || 'light';
          var toggles = document.querySelectorAll('.theme-toggle-switch');
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
            var toggles = document.querySelectorAll('.theme-toggle-switch');
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
</body>
</html>
<?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/admin/layouts/admin.blade.php ENDPATH**/ ?>