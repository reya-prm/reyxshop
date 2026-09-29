# ReyxShop

Website katalog & toko online interaktif untuk perlengkapan off-road motor.
Blueprint: [`docs/ReyxShop_PRD_Technical_Specification.md`](docs/ReyxShop_PRD_Technical_Specification.md)

**Stack:** Laravel 13 · Blade · Tailwind CSS · MySQL · Filament · Laravel Reverb

## Setup lokal

Butuh PHP >= 8.4, Composer, Node.js, dan MySQL.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# buat database MySQL `reyxshop`, sesuaikan DB_* di .env
npm run dev        # terminal 1
php artisan serve  # terminal 2
```

Buka http://localhost:8000
