<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Book;
use App\Models\Workshop;
use App\Models\Newsletter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Authors
        $admin = User::create([
            'name' => 'Vitaly Friedman',
            'email' => 'admin@smashing.dev',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80',
            'bio' => 'Co-founder of Smashing Magazine, creative lead and author. Loves front-end design, typography, and cats.',
            'twitter' => '@smashingmag',
            'github' => 'vitalyfriedman',
        ]);

        $rachel = User::create([
            'name' => 'Rachel Andrew',
            'email' => 'rachel@smashing.dev',
            'password' => Hash::make('password123'),
            'role' => 'author',
            'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80',
            'bio' => 'CSS Working Group invited expert, technical editor, and web standards speaker.',
            'twitter' => '@rachelandrew',
            'github' => 'rachelandrew',
        ]);

        $addy = User::create([
            'name' => 'Addy Osmani',
            'email' => 'addy@smashing.dev',
            'password' => Hash::make('password123'),
            'role' => 'author',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
            'bio' => 'Engineering leader focusing on web performance, JavaScript tooling, and developer productivity.',
            'twitter' => '@addyosmani',
            'github' => 'addyosmani',
        ]);

        $miriam = User::create([
            'name' => 'Miriam Suzanne',
            'email' => 'miriam@smashing.dev',
            'password' => Hash::make('password123'),
            'role' => 'author',
            'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=300&q=80',
            'bio' => 'Invited Expert on the W3C CSS Working Group, author of Sass frameworks, and design system architect.',
            'twitter' => '@mirisuzanne',
            'github' => 'mirisuzanne',
        ]);

        // 2. Categories (Same 10 as Smashing Magazine)
        $categoriesData = [
            [
                'name' => 'Accessibility',
                'slug' => 'accessibility',
                'accent_color' => '#4F46E5', // Indigo
                'description' => 'Semantic HTML, ARIA patterns, keyboard navigation, and inclusive design for all users.',
                'order' => 1,
            ],
            [
                'name' => 'CSS',
                'slug' => 'css',
                'accent_color' => '#0284C7', // Sky Blue
                'description' => 'Modern CSS layout, cascade layers, container queries, animation, and responsive design.',
                'order' => 2,
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'accent_color' => '#D97706', // Amber
                'description' => 'Modern ECMAScript features, asynchronous patterns, reactive primitives, and architecture.',
                'order' => 3,
            ],
            [
                'name' => 'React',
                'slug' => 'react',
                'accent_color' => '#06B6D4', // Cyan
                'description' => 'React 19 Server Components, hooks, Concurrent Mode, and component architecture.',
                'order' => 4,
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vue',
                'accent_color' => '#10B981', // Emerald
                'description' => 'Composition API, Vite tooling, Pinia state, Nuxt SSR, and reactivity mechanics.',
                'order' => 5,
            ],
            [
                'name' => 'Design Systems',
                'slug' => 'design-systems',
                'accent_color' => '#8B5CF6', // Violet
                'description' => 'Design tokens, component libraries, cross-functional documentation, and scalable governance.',
                'order' => 6,
            ],
            [
                'name' => 'UX & UI Design',
                'slug' => 'ux-design',
                'accent_color' => '#EC4899', // Pink
                'description' => 'User research, interface psychology, micro-interactions, heuristics, and prototyping.',
                'order' => 7,
            ],
            [
                'name' => 'Performance',
                'slug' => 'performance',
                'accent_color' => '#14B8A6', // Teal
                'description' => 'Core Web Vitals, INP, bundle optimization, hydration metrics, and critical rendering path.',
                'order' => 8,
            ],
            [
                'name' => 'AI & Tools',
                'slug' => 'ai-tools',
                'accent_color' => '#6366F1', // Iris
                'description' => 'Agentic coding, developer workflows, compiler toolchains, and AI-assisted interfaces.',
                'order' => 9,
            ],
            [
                'name' => 'Career',
                'slug' => 'career',
                'accent_color' => '#E11D48', // Rose
                'description' => 'Engineering management, freelance consulting, contracts, remote culture, and burnout prevention.',
                'order' => 10,
            ],
        ];

        $cats = [];
        foreach ($categoriesData as $c) {
            $cats[$c['slug']] = Category::create($c);
        }

        // 3. Articles (2 per category = 20 total, rich and realistic)
        $articles = [
            // CSS (2)
            [
                'user_id' => $miriam->id,
                'category_id' => $cats['css']->id,
                'title' => 'Container Queries And The New Era Of Component-Driven Responsive CSS',
                'slug' => 'container-queries-component-driven-responsive-css',
                'kicker' => 'Featured Guide • Modern CSS Layout',
                'excerpt' => 'Why media queries were only the beginning. Discover how container queries and container query units fundamentally reinvent how modular UI components adapt to fluid parents.',
                'cover_image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80',
                'cover_caption' => 'Fluid CSS layout modularity across viewports and parent containers.',
                'reading_time' => '8 min read',
                'is_hero' => true,
                'is_featured' => true,
                'is_guide' => true,
                'views_count' => 38240,
                'claps_count' => 842,
                'status' => 'published',
                'tags' => ['CSS', 'Container Queries', 'Responsive Design', 'Design Systems'],
                'published_at' => now()->subDays(1),
                'content' => '
                    <p class="lead-text">For almost two decades, responsive web design meant querying the viewport. In modern component architectures, container queries enable cards and widgets to respond directly to their allocated space.</p>
                    <h2 id="container-basics">Defining a Container Context</h2>
                    <p>Simply assign <code>container-type: inline-size;</code> to any card wrapper, then write modular <code>@container (min-width: 450px)</code> queries.</p>
                ',
            ],
            [
                'user_id' => $rachel->id,
                'category_id' => $cats['css']->id,
                'title' => 'Subgrid Deep Dive: Aligning Nested Grids Without Layout Compromise',
                'slug' => 'subgrid-deep-dive-nested-grids',
                'kicker' => 'CSS Technique • Layout Rigor',
                'excerpt' => 'How CSS Subgrid solves the classic card-alignment dilemma, sharing tracks between parent and child grids seamlessly across variable content heights.',
                'cover_image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Nested subgrid lines aligning headers and footers across dynamic cards.',
                'reading_time' => '7 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => true,
                'views_count' => 19300,
                'claps_count' => 450,
                'status' => 'published',
                'tags' => ['CSS Grid', 'Subgrid', 'Front-End', 'Layout'],
                'published_at' => now()->subDays(2),
                'content' => '<p class="lead-text">Subgrid allows descendant grid elements to inherit row and column track definitions from their ancestor grid.</p>',
            ],

            // Performance (2)
            [
                'user_id' => $addy->id,
                'category_id' => $cats['performance']->id,
                'title' => 'Mastering Interaction To Next Paint (INP): Practical Optimization Strategies',
                'slug' => 'mastering-interaction-to-next-paint-inp',
                'kicker' => 'Performance Deep Dive • Core Web Vitals',
                'excerpt' => 'Interaction to Next Paint (INP) is now a core Google ranking benchmark. Learn how to profile long tasks, yield to the main thread, and guarantee 60fps responsiveness.',
                'cover_image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Measuring main-thread execution and rendering latency in Chrome DevTools.',
                'reading_time' => '7 min read',
                'is_hero' => false,
                'is_featured' => true,
                'is_guide' => false,
                'views_count' => 24190,
                'claps_count' => 610,
                'status' => 'published',
                'tags' => ['Performance', 'Core Web Vitals', 'INP', 'JavaScript'],
                'published_at' => now()->subDays(3),
                'content' => '<p class="lead-text">INP measures user input latency throughout the entire page lifecycle. Break synchronous work into micro-tasks with <code>scheduler.yield()</code>.</p>',
            ],
            [
                'user_id' => $addy->id,
                'category_id' => $cats['performance']->id,
                'title' => 'Optimizing Web Font Delivery: Subsetting, Variable Axes, And Zero Layout Shift',
                'slug' => 'optimizing-web-font-delivery-zero-cls',
                'kicker' => 'Web Typography • Performance',
                'excerpt' => 'How to eliminate Cumulative Layout Shift (CLS) from custom web fonts using font-display: swap, size-adjust override descriptors, and unicode range subsetting.',
                'cover_image' => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Glyph subsetting and fallback font metric overrides in CSS.',
                'reading_time' => '6 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 16400,
                'claps_count' => 395,
                'status' => 'published',
                'tags' => ['Performance', 'Typography', 'Fonts', 'CLS'],
                'published_at' => now()->subDays(4),
                'content' => '<p class="lead-text">Learn how the CSS <code>@font-face</code> <code>size-adjust</code> descriptor matches fallback fonts perfectly to web fonts.</p>',
            ],

            // Accessibility (2)
            [
                'user_id' => $rachel->id,
                'category_id' => $cats['accessibility']->id,
                'title' => 'Building Inclusive Design Tokens: Accessibility In Modern Design Systems',
                'slug' => 'building-inclusive-design-tokens-accessibility',
                'kicker' => 'Accessibility • Design Systems',
                'excerpt' => 'How to bake WCAG 2.2 contrast ratios, motion preferences, and forced-colors mode directly into design tokens before a single line of component code is written.',
                'cover_image' => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Color contrast matrices and semantic token architecture.',
                'reading_time' => '6 min read',
                'is_hero' => false,
                'is_featured' => true,
                'is_guide' => false,
                'views_count' => 18920,
                'claps_count' => 520,
                'status' => 'published',
                'tags' => ['Accessibility', 'Design Tokens', 'WCAG', 'Figma'],
                'published_at' => now()->subDays(5),
                'content' => '<p class="lead-text">By encoding contrast and focus ring metrics into design tokens, accessibility becomes automatic across entire engineering teams.</p>',
            ],
            [
                'user_id' => $admin->id,
                'category_id' => $cats['accessibility']->id,
                'title' => 'Accessible Form Validation in 2026: Live Regions, Summaries, and Focus Flow',
                'slug' => 'accessible-form-validation-aria-live-regions',
                'kicker' => 'Inclusive Forms • a11y',
                'excerpt' => 'A practical guide to coding accessible forms: using aria-invalid, aria-describedby, polite live regions, and maintaining keyboard focus on error states.',
                'cover_image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Screen reader feedback on accessible form validation errors.',
                'reading_time' => '8 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => true,
                'views_count' => 17800,
                'claps_count' => 430,
                'status' => 'published',
                'tags' => ['Accessibility', 'Forms', 'ARIA', 'Screen Readers'],
                'published_at' => now()->subDays(6),
                'content' => '<p class="lead-text">Connecting inputs to error messages via <code>aria-describedby</code> ensures blind and low-vision users receive unambiguous guidance.</p>',
            ],

            // React (2)
            [
                'user_id' => $admin->id,
                'category_id' => $cats['react']->id,
                'title' => 'React 19 Server Actions, useOptimistic, And Form Architecture',
                'slug' => 'react-19-server-actions-form-architecture',
                'kicker' => 'Front-End Architecture • React 19',
                'excerpt' => 'Explore the transformative paradigms of React 19: asynchronous form actions, progressive enhancement without client JS, and instant optimistic updates.',
                'cover_image' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'React component lifecycle and asynchronous server mutation mechanics.',
                'reading_time' => '9 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => true,
                'views_count' => 29400,
                'claps_count' => 730,
                'status' => 'published',
                'tags' => ['React', 'JavaScript', 'Server Actions', 'Web Architecture'],
                'published_at' => now()->subDays(7),
                'content' => '<p class="lead-text">React 19 replaces verbose useState forms with native form actions and optimistic UI primitives.</p>',
            ],
            [
                'user_id' => $addy->id,
                'category_id' => $cats['react']->id,
                'title' => 'React Compiler In Practice: Eliminating useMemo and useCallback Forever',
                'slug' => 'react-compiler-practice-eliminating-memoization',
                'kicker' => 'Compiler Revolution • React',
                'excerpt' => 'How the React Compiler automatically memoizes component sub-trees, removing the mental overhead of dependency arrays while maximizing render performance.',
                'cover_image' => 'https://images.unsplash.com/photo-1555066931-bf19f8fd1085?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Automated AST memoization with the React Compiler.',
                'reading_time' => '7 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 21200,
                'claps_count' => 510,
                'status' => 'published',
                'tags' => ['React', 'Compilers', 'Memoization', 'Performance'],
                'published_at' => now()->subDays(8),
                'content' => '<p class="lead-text">Say goodbye to manual dependency array bugs: the React Compiler inspects JavaScript semantics to optimize renders ahead of time.</p>',
            ],

            // JavaScript (2)
            [
                'user_id' => $addy->id,
                'category_id' => $cats['javascript']->id,
                'title' => 'Modern JavaScript State Primitives: Signals, Proxies, And Reactive Graphs',
                'slug' => 'modern-javascript-state-primitives-signals',
                'kicker' => 'Language Evolution • TC39 Standards',
                'excerpt' => 'An architectural breakdown of the TC39 Signals proposal and why frameworks from Angular to Vue, Solid, and Preact are converging on fine-grained reactive state.',
                'cover_image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Dependency graph execution and fine-grained reactive updates.',
                'reading_time' => '8 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 22400,
                'claps_count' => 590,
                'status' => 'published',
                'tags' => ['JavaScript', 'Signals', 'Reactivity', 'TC39'],
                'published_at' => now()->subDays(9),
                'content' => '<p class="lead-text">TC39 Signals standardize reactive data graphs directly into ECMAScript for unprecedented UI efficiency.</p>',
            ],
            [
                'user_id' => $rachel->id,
                'category_id' => $cats['javascript']->id,
                'title' => 'Asynchronous JavaScript Evolution: Async Context and Safe Resource Management',
                'slug' => 'async-javascript-evolution-async-context',
                'kicker' => 'ECMAScript Core • Async Flow',
                'excerpt' => 'Deep dive into AsyncContext, using statements for automated cleanup, and modern iterator helpers making asynchronous code cleaner and safer.',
                'cover_image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Async lifecycle tracing and memory management in V8.',
                'reading_time' => '7 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 14300,
                'claps_count' => 370,
                'status' => 'published',
                'tags' => ['JavaScript', 'Async', 'TC39', 'Clean Code'],
                'published_at' => now()->subDays(10),
                'content' => '<p class="lead-text">AsyncContext allows propagating values across asynchronous execution contexts without thread-local variables.</p>',
            ],

            // Vue.js (2)
            [
                'user_id' => $addy->id,
                'category_id' => $cats['vue']->id,
                'title' => 'Vue 3.5 & Reactivity Unleashed: Memory Optimizations And useTemplateRef',
                'slug' => 'vue-3-5-reactivity-unleashed-memory-optimizations',
                'kicker' => 'Framework Guide • Vue.js Core',
                'excerpt' => 'Vue 3.5 brings a 56% reduction in memory usage across reactive graphs and introduces useTemplateRef for clean, type-safe DOM element references.',
                'cover_image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Vue 3.5 reactive memory profiling and Composition API ergonomics.',
                'reading_time' => '7 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => true,
                'views_count' => 20100,
                'claps_count' => 490,
                'status' => 'published',
                'tags' => ['Vue.js', 'Vite', 'Composition API', 'Nuxt'],
                'published_at' => now()->subDays(11),
                'content' => '<p class="lead-text">The Vue 3.5 reactive engine refactor rewrites dependency tracking into a doubly-linked list, cutting memory overhead in half.</p>',
            ],
            [
                'user_id' => $miriam->id,
                'category_id' => $cats['vue']->id,
                'title' => 'Architecting Enterprise Nuxt 4 Applications: Full-Stack Conventions and Edge Deployments',
                'slug' => 'architecting-enterprise-nuxt-4-applications',
                'kicker' => 'Full-Stack Vue • Nuxt 4',
                'excerpt' => 'How Nuxt 4 streamlines full-stack architecture with the new app/ directory structure, Nitro server engine, and zero-config deployment to edge runtimes.',
                'cover_image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Nuxt 4 full-stack conventions running on Vercel and Cloudflare Workers.',
                'reading_time' => '8 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 16500,
                'claps_count' => 415,
                'status' => 'published',
                'tags' => ['Vue.js', 'Nuxt', 'Nitro', 'Edge'],
                'published_at' => now()->subDays(12),
                'content' => '<p class="lead-text">Nuxt 4 introduces unified directory structures and seamless Nitro engine API endpoints for modern web applications.</p>',
            ],

            // Design Systems (2)
            [
                'user_id' => $miriam->id,
                'category_id' => $cats['design-systems']->id,
                'title' => 'Scaling Design Tokens Across Multi-Brand Portfolios: Governance, Tooling, and Versioning',
                'slug' => 'scaling-design-tokens-multi-brand-portfolios',
                'kicker' => 'Design Systems • Enterprise Scale',
                'excerpt' => 'Architecting a design system that supports 10+ sub-brands without code duplication. How W3C Design Tokens Community Group standards unify Figma and CSS.',
                'cover_image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Multi-brand design tokens bridging design tools and front-end repositories.',
                'reading_time' => '9 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => true,
                'views_count' => 25800,
                'claps_count' => 640,
                'status' => 'published',
                'tags' => ['Design Systems', 'Tokens', 'Figma', 'CSS Architecture'],
                'published_at' => now()->subDays(13),
                'content' => '<p class="lead-text">Managing multi-brand design tokens requires clear separation between global values, semantic intents, and component overrides.</p>',
            ],
            [
                'user_id' => $rachel->id,
                'category_id' => $cats['design-systems']->id,
                'title' => 'Component Archaeology: Refactoring Legacy Web Components Without Breaking The Enterprise',
                'slug' => 'component-archaeology-refactoring-legacy-ui',
                'kicker' => 'System Evolution • Code Maintenance',
                'excerpt' => 'Strategies for incrementally replacing 5-year-old component libraries with modern CSS and Web Components without disrupting 50+ product teams.',
                'cover_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Refactoring legacy component APIs with progressive deprecation notices.',
                'reading_time' => '7 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 15700,
                'claps_count' => 380,
                'status' => 'published',
                'tags' => ['Design Systems', 'Refactoring', 'Web Components', 'Architecture'],
                'published_at' => now()->subDays(14),
                'content' => '<p class="lead-text">Successful design system migration requires automated codemods, deprecation linter warnings, and transparent transition guides.</p>',
            ],

            // UX & UI Design (2)
            [
                'user_id' => $miriam->id,
                'category_id' => $cats['ux-design']->id,
                'title' => 'Designing Frictionless Checkout Experiences: 15 Common Micro-Fails',
                'slug' => 'frictionless-checkout-experiences-micro-fails',
                'kicker' => 'UX Heuristics • Conversion Design',
                'excerpt' => 'From postal code autofill bugs to ambiguous error labels, examine the subtle design flaws that frustrate customers at the final step of purchase.',
                'cover_image' => 'https://images.unsplash.com/photo-1556742049-0a67e557224f?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Auditing checkout input fields and payment interface flows.',
                'reading_time' => '6 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 14100,
                'claps_count' => 380,
                'status' => 'published',
                'tags' => ['UX', 'Ecommerce', 'Form Design', 'Usability'],
                'published_at' => now()->subDays(15),
                'content' => '<p class="lead-text">Over 70% of digital shopping carts are abandoned before completion. Good UX heuristics can recover substantial revenue.</p>',
            ],
            [
                'user_id' => $admin->id,
                'category_id' => $cats['ux-design']->id,
                'title' => 'The Psychology of Micro-Interactions: Elevating Functional UI Into Memorable Products',
                'slug' => 'psychology-of-micro-interactions-delightful-ui',
                'kicker' => 'Interaction Design • Psychology',
                'excerpt' => 'Why subtle button feedback, skeleton loaders, and contextual animations build emotional trust and transform mechanical software into beloved products.',
                'cover_image' => 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Timing curves, spring physics, and sensory feedback in digital products.',
                'reading_time' => '8 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 18900,
                'claps_count' => 540,
                'status' => 'published',
                'tags' => ['UX', 'Animation', 'Product Design', 'Micro-interactions'],
                'published_at' => now()->subDays(16),
                'content' => '<p class="lead-text">Micro-interactions communicate status, confirm actions, and reassure the user that their inputs were registered.</p>',
            ],

            // AI & Tools (2)
            [
                'user_id' => $admin->id,
                'category_id' => $cats['ai-tools']->id,
                'title' => 'The Human Touch In An AI-Driven World: Where Software Craft Still Matters',
                'slug' => 'human-touch-ai-driven-world-software-craft',
                'kicker' => 'Editorial Opinion • Technology & Ethics',
                'excerpt' => 'As code generation tools flood repositories with synthetic scaffolding, architectural discernment, ethical constraints, and aesthetic subtlety become the defining competitive advantages.',
                'cover_image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Human cognition, creative intuition, and algorithmic tooling in symbiosis.',
                'reading_time' => '6 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 15200,
                'claps_count' => 480,
                'status' => 'published',
                'tags' => ['AI', 'Engineering Ethics', 'Future Tech', 'Design Craft'],
                'published_at' => now()->subDays(17),
                'content' => '<p class="lead-text">Deciding what software should exist and how it respects user privacy still requires human empathy and taste.</p>',
            ],
            [
                'user_id' => $addy->id,
                'category_id' => $cats['ai-tools']->id,
                'title' => 'Agentic Engineering Workflows: Integrating LLM Code Partners Without Losing Quality Control',
                'slug' => 'agentic-engineering-workflows-llm-code-partners',
                'kicker' => 'Developer Workflows • Agentic Coding',
                'excerpt' => 'How engineering teams structure prompt harnesses, test suites, and sandbox verification to safely orchestrate multi-step autonomous AI coding agents.',
                'cover_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Autonomous developer agent loops and continuous verification harnesses.',
                'reading_time' => '8 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => true,
                'views_count' => 23600,
                'claps_count' => 670,
                'status' => 'published',
                'tags' => ['AI', 'Agentic Coding', 'DevOps', 'Tooling'],
                'published_at' => now()->subDays(18),
                'content' => '<p class="lead-text">Pairing with agentic models requires robust automated tests to verify code generations before merging.</p>',
            ],

            // Career (2) -> Solving the exact screenshot!
            [
                'user_id' => $admin->id,
                'category_id' => $cats['career']->id,
                'title' => "The Senior Engineer's Compass: Navigating Staff+ Roles, Technical Leadership, and Career Longevity",
                'slug' => 'senior-engineers-compass-staff-plus-leadership',
                'kicker' => 'Career Growth • Engineering Leadership',
                'excerpt' => 'Moving beyond senior engineer requires an entirely different playbook: influencing organizational architecture, mentoring without micromanaging, and navigating political friction with calm authority.',
                'cover_image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Technical strategy meetings, cross-functional mentoring, and organizational influence.',
                'reading_time' => '9 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => true,
                'views_count' => 28500,
                'claps_count' => 780,
                'status' => 'published',
                'tags' => ['Career', 'Leadership', 'Staff Plus', 'Engineering Management'],
                'published_at' => now()->subDays(19),
                'content' => '
                    <p class="lead-text">Writing clean code is table stakes. When you reach the Staff and Principal engineering levels, your value is measured not by pull requests merged, but by the systemic leverage and technical velocity you unlock across entire teams.</p>
                    <h2 id="the-archetypes-of-staff-engineers">The 4 Core Archetypes of Staff+ Engineers</h2>
                    <p>In Will Larson’s seminal research, Staff engineers generally gravitate toward one of four primary archetypes:</p>
                    <ul>
                      <li><strong>The Tech Lead:</strong> Guides the execution and technical direction of a critical team.</li>
                      <li><strong>The Architect:</strong> Holds ownership over multi-system boundaries, schemas, and cross-team protocols.</li>
                      <li><strong>The Solver:</strong> Tackles acute, deeply difficult technical fires that require deep domain expertise.</li>
                      <li><strong>The Right Hand:</strong> Operates alongside executive leadership to solve thorny organizational challenges.</li>
                    </ul>
                    <h2 id="influence-without-authority">Mastering Influence Without Positional Authority</h2>
                    <p>Unlike managers who hold hiring and evaluation levers, Staff individual contributors must build consensus through persuasive documentation, prototyping, and active listening.</p>
                ',
            ],
            [
                'user_id' => $rachel->id,
                'category_id' => $cats['career']->id,
                'title' => 'Breaking Free From Developer Burnout: Sustainable Habits for Remote Engineers',
                'slug' => 'breaking-free-developer-burnout-sustainable-remote-work',
                'kicker' => 'Mental Health • Sustainable Work',
                'excerpt' => 'The insidious trap of remote work is that your office is always in your pocket. Practical frameworks for drawing ironclad boundaries, managing cognitive overload, and rejuvenating your creative spark.',
                'cover_image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=1000&q=80',
                'cover_caption' => 'Mindfulness, deliberate disconnection, and sustainable creative routines.',
                'reading_time' => '7 min read',
                'is_hero' => false,
                'is_featured' => false,
                'is_guide' => false,
                'views_count' => 21800,
                'claps_count' => 610,
                'status' => 'published',
                'tags' => ['Career', 'Burnout', 'Remote Work', 'Work Life Balance'],
                'published_at' => now()->subDays(20),
                'content' => '
                    <p class="lead-text">Burnout is rarely caused by working hard on something you love. It is caused by prolonged emotional exhaustion, loss of agency, and the chronic inability to mentally disengage from work.</p>
                    <h2 id="the-shutdown-ritual">The Power of the Daily Shutdown Ritual</h2>
                    <p>When your commute consists of walking five steps from your desk to your kitchen, your brain never registers that the workday has ended. Establish a tactile, deliberate ritual: close your laptop, write tomorrow’s three priorities on a physical notepad, and leave the room.</p>
                ',
            ],
        ];

        foreach ($articles as $art) {
            $created = Article::create($art);

            Comment::create([
                'article_id' => $created->id,
                'author_name' => 'Sophie Leclerc',
                'author_email' => 'sophie@example.com',
                'author_avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80',
                'content' => 'This is without question the clearest technical walkthrough on this topic I have read this year. The code examples clicked immediately.',
                'status' => 'approved',
                'likes_count' => 14,
            ]);

            Comment::create([
                'article_id' => $created->id,
                'author_name' => 'Daniel Kowalski',
                'author_email' => 'daniel@example.com',
                'author_avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80',
                'content' => 'The note regarding browser support and fallback strategy was particularly valuable. Deploying this in our design system next week!',
                'status' => 'approved',
                'likes_count' => 8,
            ]);
        }

        // 4. Smashing Books
        Book::create([
            'title' => 'Smart Interface Design Patterns',
            'slug' => 'smart-interface-design-patterns',
            'subtitle' => 'A 400-page curated collection of 100+ modern web components',
            'author' => 'Vitaly Friedman',
            'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=80',
            'price' => '$39',
            'description' => 'From mega-menus to complex filters, sliders, and pricing plans. Real-world patterns that solve hard interface challenges.',
            'link' => '#',
        ]);

        Book::create([
            'title' => 'Inclusive Design Patterns',
            'slug' => 'inclusive-design-patterns',
            'subtitle' => 'Coding accessible web components with semantic HTML and ARIA',
            'author' => 'Heydon Pickering',
            'cover_image' => 'https://images.unsplash.com/photo-1532012164546-f432f2e37b73?auto=format&fit=crop&w=600&q=80',
            'price' => '$35',
            'description' => 'A practical, irreverent guide to coding web interfaces that work for everyone, regardless of device, bandwidth, or ability.',
            'link' => '#',
        ]);

        Book::create([
            'title' => 'Form Design Patterns',
            'slug' => 'form-design-patterns',
            'subtitle' => 'A definitive guide to designing and coding user-friendly forms',
            'author' => 'Adam Silver',
            'cover_image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80',
            'price' => '$39',
            'description' => 'Make registration forms, checkouts, and surveys intuitive, accessible, and high-converting.',
            'link' => '#',
        ]);

        // 5. Workshops
        Workshop::create([
            'title' => 'Modern CSS & Design Systems Masterclass',
            'slug' => 'modern-css-design-systems-masterclass',
            'date_str' => 'Thu & Fri, Nov 19–20',
            'instructor' => 'Miriam Suzanne',
            'instructor_avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=150&q=80',
            'topic' => 'CSS Architecture & Tokens',
            'price' => '$250',
            'description' => 'Hands-on live interactive sessions on container queries, cascade layers, subgrid, and modern token pipelines.',
            'link' => '#',
        ]);

        Workshop::create([
            'title' => 'Front-End Performance & Core Web Vitals',
            'slug' => 'front-end-performance-core-web-vitals',
            'date_str' => 'Tue & Wed, Dec 3–4',
            'instructor' => 'Addy Osmani',
            'instructor_avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80',
            'topic' => 'Web Vitals & INP Optimization',
            'price' => '$250',
            'description' => 'Audit, profile, and conquer long tasks to achieve 99th percentile INP metrics.',
            'link' => '#',
        ]);

        // 6. Sample Subscribers
        Newsletter::create(['email' => 'developer@example.com']);
        Newsletter::create(['email' => 'designer@agency.io']);
    }
}
