# FCG — Company Portfolio & Dashboard

A Laravel 8 website for a construction / engineering company: a public marketing site (projects, services, categories, clients, contact) backed by an authenticated admin dashboard for managing all of that content.

- **Framework:** Laravel 8 (PHP 8.2)
- **Admin UI:** AdminLTE 3 + Bootstrap 5, built with Laravel Mix
- **Rich text:** Summernote (WYSIWYG), sanitized server-side with HTMLPurifier
- **Background work:** queued image optimization (`database` queue)

## Requirements

- PHP 8.2 (`ext-gd` for image optimization)
- Composer
- Node.js + npm
- MySQL 5.7+ / MariaDB

## Setup

```bash
git clone <repo> && cd fcg
composer install
npm install

cp .env.example .env          # then edit DB_* and set QUEUE_CONNECTION=database
php artisan key:generate
php artisan migrate            # add --seed if seeders are present

npm run dev                    # build front-end assets (or `npm run watch`)
php artisan serve
```

Uploaded images are written to `public/uploads/...` (the `public_uploads` disk), so make sure that directory is writable. Create it — and `storage/` — with write permissions for the web-server user.

### Background queue

Image uploads are optimized asynchronously on the `images` queue. The configured queue driver is `database`, so a worker must be running or new/updated images won't be processed:

```bash
php artisan queue:table && php artisan migrate   # once, if the jobs table doesn't exist
php artisan queue:work --queue=images,default
```

## Development

| Task | Command |
|------|---------|
| Build assets (dev) | `npm run dev` |
| Rebuild on change | `npm run watch` |
| Build for production | `npm run prod` |
| Run the app | `php artisan serve` |
| Run the queue worker | `php artisan queue:work --queue=images,default` |

### Testing

```bash
composer test                                        # full suite
./vendor/bin/phpunit --filter test_method_name       # a single test
```

`composer test` wraps PHPUnit with CLI flags that suppress `E_DEPRECATED` / `E_USER_DEPRECATED` so vendor deprecation notices stay out of the output. Tests run with `APP_ENV=testing` (array cache/session, sync queue — see `phpunit.xml`).

> Note: the in-memory SQLite lines in `phpunit.xml` are commented out, so tests run against whatever database your environment is configured with. Point it at a disposable database before running them.

### After deploying

```bash
composer deploy:cache          # optimize:clear + config/route/view cache
```

## How it fits together

- **Routing is split by area.** `routes/web.php` (public, `FrontController`) and `routes/dashboard.php` (admin CRUD under `/dashboard`, guarded by `auth`) are loaded with separate controller namespaces in `RouteServiceProvider`.

- **Heavy caching on the read path.** Every cache key and the 24h TTL live in `config/cache_keys.php`. The front-end caches its expensive queries, and `AppServiceProvider` caches site-wide data (settings, navigation categories, HQ branch) and shares it with every view. Admin writes dispatch a `CacheInvalidated` event that clears the affected keys, so edits show up immediately.

- **ModSecurity WAF workaround for rich text.** The host's WAF rejects WYSIWYG HTML as XSS before Laravel sees the request. The dashboard Base64-encodes those fields on submit; the `DecodeBase64Fields` middleware decodes them back, and controllers then sanitize the HTML with HTMLPurifier (allow-list in `config/purifier.php`).

- **Security headers / CSP** are set globally by the `AddSecurityHeaders` middleware. If you add a new CDN, font, or embed to a view, update the matching CSP source list there or the browser will block it.

- **Each admin resource** follows the same shape: Controller + `Store*`/`Update*` form requests + Policy + Factory + Blade views under `resources/views/dashboard/<resource>/`.
