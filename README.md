# Laravel FAQ Accordion

> **Archived (2026-10-03).** No longer maintained by PN Scripts; kept read-only for reference.

A Laravel 13 starter kit for a small public FAQ page. Visitors see an accordion of published questions. Signed-in users add, edit, and delete items.

This is a teaching and bootstrap kit, not a helpdesk or knowledge base. There is no search, no categories, no Filament admin, no GraphQL, and no CMS package.

Listed as an open-source starter on [pnscripts.com](https://pnscripts.com).

## Features

- Public home accordion (Alpine.js from a CDN; first item open, others collapsed)
- Keyboard-friendly question buttons (`aria-expanded` / `aria-controls`)
- Session auth: register, log in, log out (Blade, no Breeze)
- Authenticated create / edit / delete for FAQ items (question + answer)
- Public list is published items only, ordered by `sort_order` then `id`
- SQLite by default

## Requirements

- PHP 8.3+
- Composer
- SQLite

## Install

```bash
git clone git@github.com:pnscripts/laravel-faq-accordion.git
cd laravel-faq-accordion
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

No npm build is required. The accordion uses Alpine from a CDN and CSS from `public/css/app.css`.

## Demo credentials

After `php artisan migrate --seed`:

| Field | Value |
| --- | --- |
| Email | `faq@example.com` |
| Password | `password` |

Four published FAQ items are seeded.

## Tests

```bash
php artisan test
```

Feature tests use SQLite in memory (`phpunit.xml`).

## Limitations

- Not a CMS, Filament panel, or knowledge-base product
- No categories, tags, search, or Markdown rendering
- Any authenticated user may create, update, or delete any FAQ item (no owner-only policy)
- Auth is minimal session login/register; there is no email verification or password reset
- Alpine is loaded from a CDN; the kit does not ship a Vite frontend stack you must run

## License

MIT. Copyright (c) 2026 Petar Nikolov / PN Scripts. See [LICENSE](LICENSE).
