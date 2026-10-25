# 🚀 ReyxShop Kids Production Deployment Guide

## Pre-Deployment Checklist

### 1. Server Requirements
- PHP 8.2+
- MySQL 8.0+ / MariaDB 10.3+
- Composer 2.x
- Node.js 18+ & npm
- SSL certificate (Let's Encrypt recommended)

### 2. Environment Setup

Copy `.env.example` to `.env` and configure:

```bash
cp .env.example .env
```

**Critical .env settings:**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://reyxshop.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reyxshop
DB_USERNAME=laravel
DB_PASSWORD=your-strong-password

# Email (pilih salah satu provider)
# Option 1: Gmail SMTP
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@reyxshop.com"
MAIL_FROM_NAME="ReyxShop"

# Option 2: Mailgun
# MAIL_MAILER=mailgun
# MAILGUN_DOMAIN=mg.reyxshop.com
# MAILGUN_SECRET=your-mailgun-api-key

# Option 3: AWS SES
# MAIL_MAILER=ses
# AWS_ACCESS_KEY_ID=your-key
# AWS_SECRET_ACCESS_KEY=your-secret
# AWS_DEFAULT_REGION=us-east-1

# Queue (database recommended for small-medium traffic)
QUEUE_CONNECTION=database

# Session & Cache (redis recommended for multi-server)
SESSION_DRIVER=database
CACHE_STORE=database
```

### 3. Installation Steps

```bash
# Clone repository
git clone https://github.com/reya-prm/reyxshop.git
cd reyxshop

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Seed admin user & roles
php artisan db:seed --class=AdminUserSeeder

# Cache config for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 4. Queue Worker Setup (Systemd)

Create `/etc/systemd/system/reyxshop-worker.service`:

```ini
[Unit]
Description=ReyxShop Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/reyxshop/artisan queue:work --tries=3 --timeout=90

[Install]
WantedBy=multi-user.target
```

Enable and start:
```bash
sudo systemctl enable reyxshop-worker
sudo systemctl start reyxshop-worker
```

### 5. Nginx Configuration

```nginx
server {
    listen 80;
    server_name reyxshop.com www.reyxshop.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name reyxshop.com www.reyxshop.com;
    root /var/www/reyxshop/public;

    ssl_certificate /etc/letsencrypt/live/reyxshop.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/reyxshop.com/privkey.pem;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 6. Post-Deployment

```bash
# Create admin account
php artisan tinker
>>> $admin = User::create(['name'=>'Admin', 'email'=>'admin@reyxshop.com', 'password'=>bcrypt('your-secure-password'), 'email_verified_at'=>now()]);
>>> $admin->assignRole('admin');

# Test email sending
php artisan tinker
>>> Mail::raw('Test email', function($msg) { $msg->to('your-email@example.com')->subject('ReyxShop Test'); });

# Monitor queue
php artisan queue:monitor

# Check logs
tail -f storage/logs/laravel.log
```

## Admin Credentials (Development/Seeded)

**Default admin (from seeder):**
- Email: `admin@reyxshop.local`
- Password: `password`

⚠️ **CHANGE IMMEDIATELY IN PRODUCTION!**

## Email Verification Flow

1. User registers → Laravel sends verification email automatically
2. User clicks link in email → account verified
3. Only verified users can:
   - Submit product reviews
   - Ask product questions
   - Use live chat

## Roles & Access

- **admin**: Full Filament panel access, all permissions
- **operator**: Limited Filament access (chat, Q&A management)
- **customer**: Storefront only, no admin access

## Troubleshooting

**Email not sending:**
- Check `.env` MAIL_* settings
- Test with `php artisan tinker` (see above)
- Check provider logs (Gmail, Mailgun, SES)
- Ensure queue worker running: `systemctl status reyxshop-worker`

**Dashboard blank after login:**
- Customer users redirect to home (storefront)
- Admin/operator redirect to `/admin` (Filament panel)
- This is expected behavior

**Permission denied errors:**
- Run `chmod -R 755 storage bootstrap/cache`
- Run `chown -R www-data:www-data storage bootstrap/cache`

**500 errors:**
- Check `storage/logs/laravel.log`
- Ensure `.env` configured correctly
- Run `php artisan config:clear`

## Security Checklist

- [ ] Change default admin password
- [ ] Set `APP_DEBUG=false` in production
- [ ] Use strong `APP_KEY` (auto-generated)
- [ ] Use SSL certificate (HTTPS only)
- [ ] Enable firewall (UFW/iptables)
- [ ] Regular database backups
- [ ] Keep Laravel & dependencies updated
- [ ] Monitor logs for suspicious activity

## Performance Optimization

```bash
# Enable OPcache in php.ini
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000

# Laravel optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database indexing (already applied in migrations)
# Consider Redis for cache/session on high traffic
```

## Support & Maintenance

- GitHub: https://github.com/reya-prm/reyxshop
- Laravel Docs: https://laravel.com/docs/11.x
- Filament Docs: https://filamentphp.com/docs

---

**Last updated:** 2026-10-24
