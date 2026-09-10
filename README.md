# Joy In Zoe Intercessory Ministries

A production-ready Laravel 12 website for **Joy In Zoe Intercessory Ministries** (JIZIM) — a Christian prayer and intercessory ministry committed to reaching the unreached through prayer and outreach.

*"Raising an altar of prayer, intercession, and spiritual awakening."*

---

## Requirements

- PHP **8.2+** (Laravel 12 requirement)
- Composer 2.x
- MySQL / MariaDB (XAMPP recommended for local development)
- Node.js 20+ and npm (for compiling Bootstrap 5 assets)
- Required PHP extensions: `pdo_mysql`, `mbstring`, `openssl`, `curl`, `fileinfo`, `zip`, `dom`, `gd`, `intl`

> In XAMPP, enable `extension=gd` and `extension=intl` in `C:\xampp\php\php.ini`, then restart Apache.

---

## Installation

### 1. Clone / place the project

Place the project files inside your web root (e.g. `C:\xampp\htdocs\joyinzoe` or use the XAMPP Apache virtual host / `php artisan serve`).

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Create the environment file

```bash
cp .env.example .env
```

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Compile frontend assets (Bootstrap 5)

```bash
npm install
npm run build        # production build
# or npm run dev      # while developing
```

---

## XAMPP Setup

1. Open the **XAMPP Control Panel** and start **Apache** and **MySQL**.
2. Ensure MySQL is running on `127.0.0.1:3306`.

### Database creation

Create a database named `joyinzoe` in phpMyAdmin, or run:

```sql
CREATE DATABASE joyinzoe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

> Laravel migrations create the tables. Do **not** create tables manually.

---

## `.env` Configuration

Edit `.env` with your real values. Never commit the real `.env` file. See `.env.example` for the complete list.

| Variable | Purpose |
| --- | --- |
| `APP_NAME` | Site name |
| `APP_ENV` | `local` or `production` |
| `APP_DEBUG` | `false` in production |
| `APP_URL` | Site base URL |
| `DB_DATABASE` | Database name (`joyinzoe`) |
| `DB_USERNAME` | Database user |
| `DB_PASSWORD` | Database password |
| `MAIL_*` | SMTP credentials (never hardcoded) |
| `SUPPORT_EMAIL` | Receives support/contact enquiries |
| `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PASSWORD` | Initial administrator credentials |

**Secrets (SMTP passwords, API keys, bot tokens, etc.) live only in `.env`.** They are never placed in source code.

---

## Migrations & Seeding

### Run migrations

```bash
php artisan migrate
```

### Seed the initial administrator

```bash
php artisan db:seed
```

The seeder reads `ADMIN_NAME`, `ADMIN_EMAIL` and `ADMIN_PASSWORD` from `.env`. The password is hashed with bcrypt and is never logged or displayed. Set a strong password before seeding.

> The initial administrator is the only account created by the seeder. Additional staff accounts (managers, users) are managed from the admin panel after login.

---

## Admin Login Setup

1. Complete the `.env` with `ADMIN_EMAIL` and `ADMIN_PASSWORD`.
2. Run `php artisan migrate` and `php artisan db:seed`.
3. Visit `/login` and sign in as the administrator.
4. From the admin panel, manage users, create managers, and administer the ministry.

**Roles:** `admin` (full control), `manager` (ministry content), `user` (member account). Visitors cannot choose a role during registration — they always register as `user`.

---

## Development Commands

```bash
php artisan serve            # local dev server on http://127.0.0.1:8000
npm run dev                  # Vite dev server for assets
php artisan test             # run the test suite
vendor/bin/pint              # format code (Laravel Pint)
vendor/bin/pint --test       # check formatting
php artisan migrate:fresh --seed   # reset DB and reseed
```

---

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`.
2. Run `composer install --optimize-autoloader --no-dev`.
3. Run `npm install && npm run build`.
4. Run `php artisan migrate --force`.
5. Cache config and routes:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
6. Set proper permissions on `storage/` and `bootstrap/cache/`.
7. Serve the `public/` directory as the web root.

---

## Storage Setup

```bash
php artisan storage:link
```

This links `public/storage` to `storage/app/public`. Uploaded ministry images (gallery, blog featured images, etc.) are served from here.

---

## Email Setup

Configure the `MAIL_*` variables in `.env` with your provider's SMTP credentials:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.yourprovider.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=no-reply@joyinzoe.org
MAIL_FROM_NAME="Joy In Zoe Intercessory Ministries"
```

For local development, `MAIL_MAILER=log` writes emails to `storage/logs/laravel.log` instead of sending them.

---

## YouTube Configuration

The YouTube section reads configuration from site settings/environment:

```env
# .env (only if using the YouTube Data API)
YOUTUBE_API_KEY=your-api-key
YOUTUBE_CHANNEL_ID=your-channel-id
```

The API key must never be exposed in frontend JavaScript. API responses are cached and failures are handled gracefully.

---

## Telegram Configuration

The private women's prayer-group is joined through an **admin approval workflow**. No invite link is exposed publicly.

```env
# .env (only if Telegram automation is enabled)
TELEGRAM_BOT_TOKEN=your-bot-token
TELEGRAM_GROUP_INVITE_LINK=private-invite-link
```

Bot tokens and private invite links live only in `.env`. Approved applicants receive the invitation through the approved workflow.

---

## Image Management

- Original ministry images live in `images/`.
- Only images supplied by Joy In Zoe (or uploaded by authorized administrators through the backend) are used.
- Publicly served assets are copied to `public/images/` and uploaded images go to `storage/app/public/`.
- Uploads are validated (MIME type, extension, size), stored with safe generated filenames, and cannot execute as server scripts.

---

## Backup Considerations

- Back up the MySQL database regularly (phpMyAdmin export or `mysqldump`).
- Back up `storage/app/public` (uploaded images) and the original `images/` folder.
- Keep `.env` safe and out of version control — store a copy in a secure location.
- After deploying, verify: `storage:link`, config caches, error pages, and role permissions.

---

## Security Notes

- `.env` is excluded from Git via `.gitignore`.
- CSRF protection, server-side validation, authorization policies, and rate limiting are applied throughout.
- Sensitive credentials are never hardcoded; all come from `.env`.
- Authorization is enforced server-side — visiting a URL alone cannot grant access.

---

© Joy In Zoe Intercessory Ministries. All rights reserved.
