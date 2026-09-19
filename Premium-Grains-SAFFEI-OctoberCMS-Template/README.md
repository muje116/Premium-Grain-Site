# Premium Grains — October CMS website

This workspace contains a complete October CMS site based on the supplied Premium Grains profile and the generated visual theme. SAFFEI is presented as one configurable project within the wider Premium Grains business.

## Project structure

- `october-app/` — the runnable October CMS application.
- `october-app/themes/premium-grains/` — active theme with configurable pages, project listing/detail routes, banners, layouts, partials and responsive assets.
- `october-app/plugins/sparc/premiumgrains/` — custom backend content plugin, migrations, settings, project/team/contact models and CRUD controllers.
- `dist/` — standalone static preview from the original generated theme.
- `october-theme/premium-grains/` — original theme source preserved for reference.

## Run locally

Requirements: PHP 8.3+, Composer, and the PHP extensions used by October CMS (including SQLite, DOM/XML, cURL, GD, mbstring and ZIP).

From `october-app/`:

```powershell
# Only needed when .env is not already present
Copy-Item .env.example .env
composer install
php artisan october:migrate --force
php artisan serve --host=127.0.0.1 --port=8000
```

MySQL is the primary local database. The current `.env` targets `127.0.0.1:3306`, database `premium_grains`, user `root`, with an empty password for the local WAMP development service. For any shared or production environment, replace these values with a dedicated MySQL user and secret.

Before the first migration on another machine, create the database once:

```sql
CREATE DATABASE premium_grains CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

SQLite remains available as a fallback by changing `DB_CONNECTION=sqlite` and setting `DB_DATABASE` to `storage/database.sqlite`.

Open:

- Frontend: http://127.0.0.1:8000/
- Backend: http://127.0.0.1:8000/admin

On a fresh environment, complete October’s first-run backend setup to create the administrator account.

## Backend content management

After signing in, use the **Premium Grains** menu in the backend to manage:

- Pages and SEO metadata
- A reusable banner image for every page
- Projects and project content items, with SAFFEI seeded as the first project
- Vision, mission and values
- The five-part agribusiness model
- Kasiya and Mpherembe farm hubs
- Partnership points
- Team members, portraits and biographies
- Contact form messages

Use **Settings → Premium Grains** for the brand name, descriptor, hero image, purpose, contact email, phone, address, locations, motto, footer copy and social media URLs. The public pages read these records through the `premiumContent` component, so content changes do not require editing Twig templates.

Migration `1.0.3` adds three clearly marked demo team profiles plus example contact and social media values so the editable surfaces are populated during review. Replace those values with approved launch information before publishing. Each public page has its own generated banner image, and the shared layout includes an animated closing landscape section with reduced-motion support.

The main public navigation is **About**, **Our model**, **Projects**, **Farm hubs**, **Contact** and **Partner with us**. The former `/saffei` and `/journey` URLs redirect into the SAFFEI project detail route at `/projects/saffei`.

## Source-content note

The attached profile supplies the factual brand, programme, location and partnership content used in the seeded records. The original generated theme’s launch notes treated the partnership email and hero photography as placeholders; those are intentionally editable in the backend and should be confirmed before launch.
