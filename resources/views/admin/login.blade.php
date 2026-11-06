<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — DEV Admin Console</title>
    
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
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

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

        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 150ms ease, color 150ms ease;
        }

        .theme-surface {
            background-color: var(--surface);
            border-color: var(--border);
            color: var(--text);
        }

        .theme-primary-btn {
            background-color: var(--primary);
            color: var(--on-primary);
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
<body class="h-full flex items-center justify-center p-4 antialiased">

    <div class="w-full max-w-md">
        
        <!-- Top Back Link & Theme Toggle -->
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('home') }}" class="text-xs font-mono font-bold flex items-center gap-1.5 transition-colors hover:underline" style="color: var(--primary);">
                ← Back to Public Site
            </a>
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
        </div>

        <!-- Logo Header -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl font-black text-2xl shadow-lg mb-3" style="background-color: var(--primary); color: var(--on-primary);">
                DEV
            </div>
            <h1 class="font-bold text-3xl tracking-tight" style="color: var(--heading);">DEV Studio</h1>
            <p class="text-xs font-mono font-bold uppercase tracking-widest mt-1" style="color: var(--primary);">Editorial CMS Portal</p>
        </div>

        <!-- Status & Flash Messages -->
        @if(session('status'))
            <div class="mb-5 p-4 rounded-xl text-xs font-mono text-center border shadow-sm" style="background-color: var(--chip2-bg); border-color: var(--chip2-text); color: var(--chip2-text);">
                ✓ {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-5 p-4 rounded-xl text-xs font-mono border shadow-sm flex items-center gap-2" style="background-color: rgba(217, 93, 81, 0.15); border-color: #D95D51; color: var(--text);">
                <span class="font-bold">⚠️</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-4 rounded-xl text-xs font-mono border shadow-sm" style="background-color: rgba(217, 93, 81, 0.15); border-color: #D95D51; color: var(--text);">
                @foreach($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Login Card -->
        <div class="theme-surface border rounded-3xl p-8 shadow-xl relative overflow-hidden" style="border-color: var(--border);">
            <div class="absolute top-0 left-0 right-0 h-1.5" style="background-color: var(--primary);"></div>

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-mono font-bold uppercase tracking-wider mb-2" style="color: var(--heading);">Editor Account Email</label>
                    <input type="email" name="email" required value="{{ old('email', 'admin@smashing.dev') }}" placeholder="admin@smashing.dev"
                           class="theme-input w-full px-4 py-3 border rounded-xl text-sm transition-all outline-none">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase tracking-wider mb-2" style="color: var(--heading);">Master Password</label>
                    <input type="password" name="password" required placeholder="••••••••••••"
                           class="theme-input w-full px-4 py-3 border rounded-xl text-sm transition-all outline-none">
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer" style="color: var(--muted);">
                        <input type="checkbox" name="remember" class="rounded accent-indigo-600">
                        <span>Remember editorial session</span>
                    </label>
                </div>

                <button type="submit" class="theme-primary-btn w-full py-3.5 rounded-xl font-bold font-mono text-xs uppercase tracking-wider shadow-lg flex items-center justify-center gap-2 cursor-pointer border-0">
                    <span>Unlock Studio Console</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>

        <p class="text-center text-xs font-mono mt-6" style="color: var(--muted);">
            DEV Magazine & Editorial Publishing Network © 2026
        </p>
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
