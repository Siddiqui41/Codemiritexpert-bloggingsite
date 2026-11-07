# Smashing Dev — Professional Editorial Magazine & Complete CMS

A full-stack, responsive **Smashing Magazine Clone** built with **Laravel 12** on **PHP 8.3**, featuring complete content management, automated image file storage into `public/assets/uploads/articles`, interactive reader engagements, and full category management.

---

## 🎨 Visual Identity & Color System
Retains Smashing Magazine's iconic editorial structure (mascot hero, top category pills, colored top card borders, reading progress bars, and discussion threads) with a modernized palette:
- **Primary Brand / Electric Indigo**: `#4F46E5`
- **Deep Midnight Slate**: `#0B0F19` / `#020617`
- **Amber Gold Accents**: `#F59E0B`
- **Emerald Highlights**: `#10B981`
- **Rose Accents**: `#E11D48`
- **Soft Warm Editorial Canvas**: `#FAF9F6`

---

## 🚀 How to Run the Website

### Option 1: One-Click Launcher (Easiest)
Just double-click **`run_site.bat`** (or **`run_laravel.bat`**). It will free port 8000 if occupied, boot Laravel, and open your browser automatically!

### Option 2: Run via Terminal
```bash
cd "d:\web development\codemir blog site\smashing-blog"
php artisan serve --port=8000
```

- **Frontend Magazine**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Admin Editorial Panel**: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)

---

## 🔐 Admin Panel Credentials
- **URL**: `http://127.0.0.1:8000/admin/login`
- **Email**: `admin@smashing.dev`
- **Password**: `password123`

---

## 📁 Image File Storage Architecture
When uploading article cover images through the Admin Panel:
- **Destination Folder**: `public/assets/uploads/articles/`
- **Supported Formats**: JPG, PNG, WebP, GIF, SVG (up to 10MB)
- **URL Resolution**: Automatically generated via `cover_image_url` attribute (supports local file uploads and external CDN links seamlessly).
- **Automated Cleanup**: Deleting an article safely removes the associated uploaded image file from disk to prevent storage leaks.

---

## 📑 Complete System Features

### 1. Public Magazine Front-End
- **Homepage (`/`)**:
  - Hero featured story with author bio and reading statistics
  - Top category pill bar with color indicators and instant article count badges
  - Pinned featured articles with hover animations and cover thumbnails
  - Smashing Guides track
  - Responsive latest articles grid with category kickers, claps (👏), and comments
  - Smashing Books & Live Workshops showcase
  - Newsletter subscription box with validation
- **Article Reader (`/articles/{slug}`)**:
  - Real-time scroll reading progress bar
  - Auto-generated Table of Contents (TOC) from `<h2>` headings
  - Interactive AJAX clap button (👏)
  - Full author biography card
  - Reader comments list & working submission form
  - Related articles carousel
- **Topic Hubs (`/category/{slug}`)**:
  - 10 Smashing categories: **Accessibility, CSS, JavaScript, React, Vue.js, Design Systems, UX & UI Design, Performance, AI & Tools, Career**
  - Gradient header styled with topic's accent color
  - Fast topic switcher pill bar
  - Responsive article grid
- **Search Engine (`/search`)**:
  - Full-text search with category filters and popular topic chips
- **Editorial Pages**:
  - `/guides`: Curated handbook tracks
  - `/books`: Printed hardcover and DRM-free eBook catalog
  - `/workshops`: Live interactive virtual masterclasses with instructor details
  - `/about`: Editorial manifesto, principles, and masthead team
  - `/contact`: Department-routed submission desk with feedback notices

### 2. Admin Editorial Console (`/admin`)
- **Dashboard**: High-level metrics, quick draft action, recent articles, and commentary stream.
- **Article Management (`/admin/articles`)**:
  - Full CRUD with file upload directly to `public/assets/uploads/articles`
  - Live image preview for file uploads and URL inputs
  - Formatting toolbar for HTML/Markdown (`H2`, `H3`, `Bold`, `Italic`, `Code Block`, `Quote`, `List`)
  - Tags management (comma-separated with badge display)
  - Feature switches: **Lead Hero Story**, **Pinned Top 3 Feature**, **Definitive Guide Track**
  - Publication Status: **Publish Immediately** vs **Save as Draft**
- **Categories Manager (`/admin/categories`)**:
  - Inline and modal editing for category name, slug, description, display order weight, and hex color picker.
- **Comments Moderation (`/admin/comments`)**:
  - Toggle Approved / Pending status with one click, or delete spam comments.
- **Subscribers Roster (`/admin/subscribers`)**:
  - Real-time list of newsletter subscribers with unsubscribe actions.
