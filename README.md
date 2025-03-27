# 🎮 SEO-Friendly Content Manager for Games & Apps

A modular, SEO-optimized Laravel-based admin panel tailored for managing content related to games and applications. Built with scalability, reusability, and performance in mind.

---

## 🚀 Features (Completed So Far)

- Blog post management with SEO meta support
- News module with tag & meta integration
- Tag system with polymorphic `TagRelation`
- SEO meta manager with Blade component
- Image upload & auto-thumbnail with WebP support
- Publisher module (with type flags: game/app/both)
- Game genre & platform modules
- Polymorphic `GameGenreRelation` and `GamePlatformRelation`
- Game module with:
    - Publisher & tag relation
    - Genre & platform relation
    - Metacritic/Steam/OpenCritic ratings
    - Release date, macOS support
- Admin UI built with Bootstrap 5.3
- Preview modal for content
- Modular blade components (`image-input`, `seo-inputs`, etc.)
- Seeder data for:
    - Game genres (100+)
    - Platforms
    - Publishers (Top 100)
    - Games (20 dummy titles)

---

## 🧩 Technologies

- Laravel 11.x
- PostgreSQL
- Redis (for cache & sessions)
- Bootstrap 5.3
- Intervention Image (image processing)
- Rich text editor (custom Blade component)
- Blade Components + Form macros

---

## 🛠 Installation

```bash
git clone git@github.com:gurkanatik/hackthemac.git
cd hackthemac

# Install dependencies
composer install
npm install && npm run dev

# Setup env
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --seed
php artisan storage:link
```

> Requires PHP 8.2+, Laravel 11, PostgreSQL

---

## 🗺️ Roadmap (Upcoming Features)

- [ ] 🎨 Front-end theme integration (user-facing)
- [ ] 📱 App Module (same as Game, without genres)
- [ ] 🧾 Review Module (user/game review system)
- [ ] 🏷️ Dynamic filtering by tag/genre/platform
- [ ] 🔎 Searchable frontend game explorer
- [ ] 📥 CSV/XML Import for games (bulk)
- [ ] 🧠 AI Meta Generator (optional module)

---

## 📁 Folder Structure Overview

```
app/
  ├── Models/
  ├── Http/Controllers/Admin/
  ├── Http/Requests/Admin/
  ├── Services/
  ├── Traits/
  └── View/Components/Admin/
resources/views/admin/
  ├── games/
  ├── tags/
  ├── publishers/
  └── ...
```

---

## 💡 Contribution

You're welcome to contribute! Feel free to fork this project or open issues for feature suggestions.

---

## 📜 License

MIT — use it freely for commercial or personal projects.
