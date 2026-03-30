# CLAUDE.md — Development Guide: Vica Projects

This file defines the rules, stack, conventions, and boundaries for working on this project.
**Read it entirely before writing any code.**

---

## 🌐 Language Rules

- **All code must be in English**: variable names, function names, class names, file names, folder names, route names, database columns, comments, and commit messages.
- **User prompts may come in Spanish** — that is fine. Always respond and write code in English regardless.
- When in doubt about naming: use English.

---

## 🧱 Tech Stack

| Layer | Technology | Version / Notes |
|---|---|---|
| Backend | **Laravel** | 11.x |
| Templating | **Blade** | Laravel native |
| CSS | **Custom CSS** + **Tailwind v4** | See CSS section below |
| JS | **Alpine.js** | Minimal interactivity only |
| Build | **Vite** | `npm run dev` / `npm run build` |
| DB | **SQLite** | File at `database/database.sqlite` |
| Auth | **Laravel Breeze** (Blade stack) | Already installed |
| Fonts | **Google Fonts** — Bebas Neue + Nunito | Via `@import` in `app.css` |

### ❌ DO NOT use
- React, Vue, Inertia, Livewire
- Bootstrap, Bulma, or any other CSS framework
- jQuery
- Any unapproved external JS libraries
- Sanctum API tokens (the app is server-side, not a SPA)

---

## 📁 Relevant File Structure

```
resources/
├── css/
│   ├── app.css          ← Main CSS. All variables and global styles go here
│   └── hero.css         ← Styles exclusive to the home hero. Only edit for hero changes
├── js/
│   ├── app.js
│   └── hero.js
└── views/
    ├── layouts/
    │   ├── admin.blade.php     ← Admin panel layout
    │   ├── app.blade.php       ← Main public layout
    │   └── guest.blade.php     ← Login / register
    ├── admin/
    │   ├── dashboard.blade.php
    │   └── projects/
    │       ├── create.blade.php
    │       ├── edit.blade.php
    │       └── index.blade.php
    ├── components/             ← Reusable Blade components
    ├── projects/               ← Public project views
    └── home.blade.php

app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── ProjectController.php
│   │   │   └── ProjectUpdateController.php
│   │   ├── HomeController.php
│   │   ├── ProjectController.php
│   │   └── FollowController.php
│   └── Middleware/
│       └── AdminMiddleware.php
└── Models/
    ├── Project.php
    ├── ProjectFollower.php
    ├── ProjectUpdate.php
    └── User.php
```

### 📄 Project Structure File
The file `structure.txt` in the project root contains the full directory tree.
- **Always named `structure.txt`** (English, no accents)
- **Update it whenever** files, folders, controllers, models, views, or migrations are added or removed
- Regenerate it with: `tree /F /A > structure.txt` (Windows) or `find . > structure.txt` (Unix)

---

## 🎨 CSS System

### Why Custom CSS + Tailwind together

This project uses **both** for a deliberate reason — they serve different purposes:

| Use | Tool |
|---|---|
| Spacing, flex, grid, gap utilities in Blade | **Tailwind** (`mt-4`, `flex`, `gap-2`, etc.) |
| Visual identity: colors, cards, buttons, borders, shadows | **Custom CSS** with CSS variables |

Laravel Breeze ships with Tailwind pre-configured. Custom CSS was layered on top to give the site its own visual identity. Using Tailwind alone would mean hardcoding colors everywhere and losing the CSS variable system. Using only custom CSS would mean reinventing basic layout utilities.

**The boundary rule:**
- Does it have a color, border, shadow, or branded appearance? → **Custom CSS class**
- Is it purely structural spacing or layout (`mt-4`, `grid`, `flex`)? → **Tailwind is fine**

### Main rule
**All new CSS goes in `resources/css/app.css`**, at the bottom of the file, in the appropriate section marked with a `/* === NAME === */` comment.

### Available variables (always use these — never hardcode colors)

```css
/* Fonts */
--font-title: 'Bebas Neue', sans-serif;
--font-body:  'Nunito', 'Segoe UI', system-ui, sans-serif;

/* Backgrounds */
--bg-dark:     #080c14;
--bg-elevated: #0e1628;
--bg-card:     #ffffff;
--bg-light:    #f4f6ff;

/* Text */
--text-light: #e2e8f6;
--text-muted: #6b7a99;
--text-dark:  #0f172a;

/* Accents */
--accent:       #818cf8;   /* indigo 400 */
--accent-solid: #4f46e5;   /* indigo 600 */
--teal:         #34d399;
--amber:        #f59e0b;

/* Borders */
--border:      rgba(255,255,255,0.07);
--stroke-dark: #0e1628;
```

### @import order in app.css (DO NOT change)
```css
@import url('https://fonts.googleapis.com/css2?...');
@import "tailwindcss";
@import './hero.css';
/* rest of CSS below */
```

> ⚠️ `@import` statements MUST always come first. Never add `@import` inside `hero.css` or in the middle of any CSS file — this will break the Vite/PostCSS build.

---

## 🖥️ Admin Panel — Visual Conventions

The admin panel uses its own class system. Always respect these:

| Element | Class(es) |
|---|---|
| Admin layout | `.admin-layout` / `.admin-sidebar` / `.admin-main` |
| Page wrapper | `.admin-page` |
| Page header | `.admin-page-header` |
| Stat cards | `.admin-stat-card` / `.admin-stat-value` / `.admin-stat-label` |
| Charts | `.admin-chart-card` / `.admin-chart-inner` |
| Tables | `.admin-table-wrap` / `.admin-table` |
| Forms | `.admin-form` / `.admin-form-grid` / `.form-group` |
| Primary button | `.btn-primary` |
| Danger button | `.btn-danger-sm` |
| Alerts | `.admin-alert--success` / `.admin-alert--error` |

**Admin color palette** (light surfaces on dark sidebar):
- Page background: `#f1f5f9`
- Cards: `#ffffff` with border `#e2e8f0`
- Sidebar: `#1e293b`
- Primary text: `#1e293b`
- Secondary text: `#64748b`

---

## ⚙️ Laravel Conventions

### Controllers
- **Admin** controllers go in `app/Http/Controllers/Admin/`
- Use **Resource Controllers** when applicable
- Validate with `$request->validate([...])` or Form Requests in `app/Http/Requests/`

### Routes
- Public routes in `routes/web.php`
- Admin routes grouped with `['auth', 'admin']` middleware:
```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // admin routes here
});
```

### Models
- Always define `$fillable` on every model
- Use Eloquent relationships, not raw queries when possible
- Only use soft deletes if explicitly required by the business logic

### Blade
- Use `@extends`, `@section`, `@yield` — do not create new layouts unnecessarily
- Reusable components go in `resources/views/components/`
- Pass data to views from the controller — no business logic in Blade files
- Always escape with `{{ }}`, use `{!! !!}` only for trusted first-party HTML

### Migrations
- One migration per logical change
- Never modify already-run migrations — create new ones instead
- Use descriptive names: `add_is_featured_to_projects_table`

---

## 🚫 Hard Rules

1. **Do not install composer or npm packages** without asking first
2. **Do not change the database schema** without creating a migration
3. **Do not modify** `layouts/app.blade.php` or `layouts/admin.blade.php` for single-page changes — use `@push('styles')` / `@push('scripts')` instead
4. **Do not duplicate CSS** — search for an existing class before creating a new one
5. **Do not use `!important`** unless absolutely necessary and documented
6. **Do not hardcode colors** — always use the CSS variables from `app.css`
7. **Do not create new CSS files** — everything goes in `app.css` (except the existing `hero.css`)
8. **Do not break the `@import` order** in `app.css`
9. **Do not use `localStorage` or `sessionStorage`** — state is managed server-side
10. **Do not use API token authentication** — the app uses Laravel sessions
11. **Do not name files or folders in Spanish** — all names must be in English
12. **Update `structure.txt`** whenever the file/folder tree changes

---

## ✅ Correct Workflow

### Adding a new feature:
1. Create migration if DB changes are needed → `php artisan make:migration`
2. Update or create the Model
3. Create or update the Controller
4. Add route in `web.php`
5. Create Blade view in the correct folder
6. Add CSS at the bottom of `app.css` if needed
7. Run `npm run dev` to compile assets
8. **Update `structure.txt`**

### Fixing a visual bug:
1. Identify which CSS class affects the element (browser inspector)
2. Find that class in `app.css`
3. Modify only what is needed
4. Verify it does not break other elements sharing the same class

### Changes to the admin panel:
1. Views are in `resources/views/admin/`
2. Admin CSS is in the `/* ADMIN PANEL */` section of `app.css`
3. Always respect the existing admin palette and class names

---

## 🗄️ Current Models and Relationships

```
User
 ├── hasMany ProjectFollower
 └── is_admin (boolean)

Project
 ├── hasMany ProjectFollower
 ├── hasMany ProjectUpdate
 ├── status: concept | mvp | live
 ├── progress: integer (0–100)
 ├── votes: integer
 └── featured: boolean

ProjectFollower
 ├── belongsTo User
 ├── belongsTo Project
 └── role: follower | tester

ProjectUpdate
 ├── belongsTo Project
 └── type: update | milestone | launch
```

---

## 🔐 Authentication and Roles

- Standard **Laravel Breeze** auth
- `is_admin` boolean field on the `users` table
- `AdminMiddleware` protects all `/admin/*` routes
- To check admin in Blade: `@if(auth()->user()->is_admin)`

---

## 📝 Naming Conventions

| Type | Convention | Example |
|---|---|---|
| Public CSS classes | descriptive kebab-case | `.project-card-meta` |
| Admin CSS classes | `admin-` prefix | `.admin-stat-card` |
| Auth CSS classes | `auth-` prefix | `.auth-input` |
| Controllers | PascalCase + Controller | `ProjectController` |
| Models | PascalCase singular | `ProjectFollower` |
| Views | kebab-case | `project-show.blade.php` |
| Blade variables | camelCase | `$totalProjects` |
| Named routes | dot.notation | `admin.projects.edit` |
| Files and folders | English only, kebab-case or PascalCase as appropriate | `structure.txt` |

---

## 💡 Project Context

- This is **Vica's** (a developer) personal project showcase and portfolio
- The public-facing site uses a **dark theme** with indigo/teal accents
- The admin panel uses a **light theme** with a dark sidebar
- Users can follow projects as **followers** or **testers**
- The voting system works for both authenticated and guest users (session-based)
- Dashboard charts use **Chart.js 4** loaded via CDN in the view
- The logo (150px tall) is at `public/logo.svg`

---

## 🔒 Security & Git Rules

### Files that must NEVER be committed to a public repository

| File / Pattern | Reason |
|---|---|
| `.env` | Contains DB credentials, app key, mail passwords |
| `structure.txt` | Exposes full server path, username, and project tree |
| `storage/logs/` | Contains stack traces with internal paths |
| `public/build/` | Compiled assets, regenerated by Vite |
| `public/hot` | Vite dev server indicator |
| `/vendor/` | PHP dependencies, installed by Composer |
| `/node_modules/` | JS dependencies, installed by npm |
| `.vscode/settings.json` | May contain local paths or tokens |

### Before every push to a public GitHub repo, verify:
1. Run `git status` — no .env files staged
2. Run `git diff --cached` — no credentials visible
3. Confirm `.gitignore` is up to date
4. Never force-push to main without review

### structure.txt rules
- Keep locally — it helps Claude Code understand the project
- Never commit to git (it is in .gitignore)
- Regenerate with: `tree /F /A > structure.txt` (then scope manually)
- Update whenever files or folders are added or removed

---

## 📋 Changelog

All updates to this document are logged here with date and description.

| Date | Change |
|---|---|
| 2026-03-29 | Initial document created |
| 2026-03-29 | Added language rules (English-only code, Spanish prompts allowed) |
| 2026-03-29 | Renamed `estructura.txt` → `structure.txt`, added update rule |
| 2026-03-29 | Added CSS hybrid explanation (Custom CSS vs Tailwind boundary rule) |
| 2026-03-29 | Added changelog section to track document updates |
| 2026-03-29 | Added security rules section, added structure.txt and sensitive files to .gitignore |
| 2026-03-29 | Fixed test doc blocks (/** POST @test */ → /** @test */); replaced all hardcoded URL strings in tests with route() helper |
| 2026-03-29 | Removed API layer: deleted Api\ProjectController, Api/ folder, ProjectApiTest; cleared routes/api.php |
| 2026-03-30 | Added hero-image texture to about page hero section using CSS ::before pseudo-element at 40% opacity |
| 2026-03-30 | Added collaborators feature: ProjectCollaborator model, migration, admin UI to add/remove collaborators per project, collaborator count on project cards, collaborator section on project show page |
| 2026-03-30 | Added collaborators column to admin projects index table; added withCount to Admin\ProjectController@index |
| 2026-03-30 | Fixed admin layout width bug: removed grid from .admin-layout (double-offset with fixed sidebar was halving content width) |
| 2026-03-30 | Fixed Form Request namespace (Illuminate\Http\Request → App\Http\Requests); fixed $request->validate() → $request->validated(); completed missing rules in ProjectStoreRequest and ProjectUpdateRequest (title, link, category, launch_date) |
| 2026-03-30 | Implemented ProjectStatus enum (app/Enums/ProjectStatus.php) with model cast and Enum validation rule in both Form Requests. Updated all Blade views to use $project->status->value. Created ProjectFactory. Confirmed public ProjectController handles view rendering only (index + show). |