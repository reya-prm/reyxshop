<div align="center">

# 👕 ReyxShop Kids

**Toko Keluarga Digital untuk Pakaian Anak Berkualitas**

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-3.x-FFAA00?style=for-the-badge)](https://filamentphp.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tests](https://img.shields.io/badge/tests-48%20passing-success?style=for-the-badge)](.)

*Platform katalog modern dengan integrasi marketplace, live chat real-time, dan sistem review terverifikasi untuk pakaian anak.*

[Demo](#) · [Dokumentasi](./docs) · [Deployment Guide](./DEPLOY.md)

</div>

---

## 🎯 Overview

ReyxShop Kids adalah platform storefront digital yang menghubungkan toko keluarga dengan orang tua yang mencari pakaian anak berkualitas. Dibangun dengan Laravel 11 dan Filament 3, sistem ini menyediakan katalog produk lengkap, integrasi ke marketplace (Shopee, Tokopedia, Blibli), live chat dengan admin, serta sistem review dan Q&A terverifikasi.

### ✨ Key Features

#### 🛍️ **Storefront (Customer)**
- **Katalog Dinamis** — Filter kategori, search, sorting, pagination
- **Product Detail** — Multi-image gallery, varian produk, marketplace links
- **Verified Reviews** — Rating & review dari customer terverifikasi email
- **Product Q&A** — Tanya-jawab dengan admin, public answers
- **Live Chat** — Real-time messaging dengan operator menggunakan Laravel Reverb
- **Responsive Design** — Mobile-first, mengikuti design system modern

#### ⚡ **Admin Panel (Filament)**
- **Dashboard Analytics** — Pending reviews, unanswered Q&A, unread chats
- **Product Management** — Upload multi-image, varian, marketplace integration
- **Customer Engagement** — Chat inbox, review moderation, Q&A answers
- **Role-Based Access** — Admin, operator, customer (Spatie Permission)
- **Store Settings** — Jam operasional, WhatsApp, status toko

#### 🔒 **Security & Quality**
- ✅ Email verification wajib untuk interaksi (review, Q&A, chat)
- ✅ Rate limiting anti-spam (throttle middleware)
- ✅ Role-based authorization dengan Spatie Laravel-Permission
- ✅ 48 automated tests (Feature + Unit) — 135 assertions
- ✅ SQL injection & XSS protection (Laravel built-in)

---

## 🚀 Quick Start

### Requirements
```
PHP 8.2+
MySQL 8.0+ / MariaDB 10.3+
Composer 2.x
Node.js 18+ & npm
```

### Installation

```bash
# Clone repository
git clone https://github.com/reya-prm/reyxshop.git
cd reyxshop

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database (.env)
DB_DATABASE=reyxshop
DB_USERNAME=root
DB_PASSWORD=

# Run migrations & seed demo data
php artisan migrate
php artisan db:seed

# Build frontend assets
npm run build

# Start development server
php artisan serve
```

### 🔑 Default Login

**Admin Panel** (`http://127.0.0.1:8000/admin`)
```
Email: admin@reyxshop.local
Password: password
```
⚠️ **Ubah password setelah login pertama!**

**Customer** — Daftar via `/register`, verifikasi email untuk unlock fitur review/chat.

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Specific test suite
php artisan test --filter=ReviewAuthorizationTest
```

**Test Coverage:**
- ✅ Authentication & Authorization
- ✅ Email Verification Flow
- ✅ Review & Rating Submission
- ✅ Product Q&A Workflow
- ✅ Live Chat Isolation
- ✅ Admin Panel Access Control

---

## 📦 Tech Stack

| Layer | Technology |
|-------|------------|
| **Backend** | Laravel 11.x |
| **Database** | MySQL 8.0 |
| **Admin Panel** | Filament 3.x |
| **Frontend** | Blade Templates, Tailwind CSS 3.x, Alpine.js |
| **Real-time** | Laravel Reverb (WebSockets) |
| **Auth** | Laravel Breeze + Email Verification |
| **Permissions** | Spatie Laravel-Permission |
| **Queue** | Database Driver (production: Redis/SQS) |
| **Email** | SMTP (Gmail, Mailgun, AWS SES) |

### Design System

Mengikuti **DESIGN.md** dengan brand identity:
- **Primary:** Coral `#E8442A` — CTAs, accents
- **Secondary:** Charcoal `#111827` — headings, text
- **Background:** Ash `#F4F5F7` — page backgrounds
- **Typography:** Plus Jakarta Sans (Google Fonts)
- **Components:** Pill buttons, floating shadows, rounded-card (14px)

---

## 📐 Architecture

```
┌─────────────────────────────────────────┐
│          Public Storefront              │
│  (Blade + Tailwind + Alpine.js)         │
│  - Home, Catalog, Product Detail        │
│  - Review, Q&A, Live Chat               │
└──────────────┬──────────────────────────┘
               │
               ├── Laravel 11 Core
               │   ├── Models (Eloquent)
               │   ├── Controllers
               │   ├── Policies & Gates
               │   └── Observers
               │
               ├── Filament Admin Panel
               │   ├── Resources (CRUD)
               │   ├── Widgets (Dashboard)
               │   └── Relation Managers
               │
               └── Database (MySQL)
                   ├── users (roles via Spatie)
                   ├── products → images, variants
                   ├── reviews → replies
                   ├── product_questions → answers
                   └── chat_conversations → messages
```

---

## 🗂️ Project Structure

```
reyxshop/
├── app/
│   ├── Filament/          # Admin panel resources, widgets
│   ├── Http/
│   │   ├── Controllers/   # HomeController, ProductController, ChatController
│   │   └── Requests/      # Form validation (StoreReview, StoreQuestion)
│   ├── Models/            # Eloquent models dengan relationships
│   ├── Observers/         # Auto-update question status pada answer
│   ├── Policies/          # Authorization policies
│   └── Providers/         # Service providers (role creation, gates)
│
├── resources/
│   ├── views/
│   │   ├── components/    # Blade components (buttons, inputs, logo)
│   │   ├── layouts/       # Master layouts (app, guest, navigation)
│   │   ├── products/      # Catalog, detail pages
│   │   └── home.blade.php # Landing page
│   └── css/app.css        # Tailwind entry point
│
├── database/
│   ├── migrations/        # Database schema
│   ├── seeders/           # Demo data (AdminUserSeeder, DatabaseSeeder)
│   └── factories/         # Model factories untuk testing
│
├── tests/Feature/         # Integration tests (48 tests)
│
├── docs/                  # Spec documents (PRD, technical design)
├── DEPLOY.md              # Production deployment guide
└── README.md              # This file
```

---

## 🔐 Roles & Permissions

| Role | Dashboard | Catalog | Reviews | Q&A | Chat | Admin Panel |
|------|-----------|---------|---------|-----|------|-------------|
| **Admin** | ✅ | ✅ | Moderate | Answer | Manage | Full Access |
| **Operator** | ✅ | ✅ | Read | Answer | Manage | Limited |
| **Customer** | ✅ | ✅ | Submit* | Ask* | Send* | ❌ |

*Requires email verification*

---

## 📧 Email Verification

### Development (MailHog)
```bash
# Install MailHog via Docker
docker run -d -p 1025:1025 -p 8025:8025 mailhog/mailhog

# Update .env
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
```
Buka `http://127.0.0.1:8025` untuk melihat inbox fake.

### Production
Konfigurasikan provider SMTP di `.env`:
```env
# Gmail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

Lihat [DEPLOY.md](./DEPLOY.md) untuk alternatif provider (Mailgun, AWS SES).

---

## 🚀 Production Deployment

Panduan lengkap deployment ke production tersedia di **[DEPLOY.md](./DEPLOY.md)**, mencakup:

- ✅ Server requirements & setup
- ✅ Environment configuration
- ✅ Email provider setup (Gmail, Mailgun, SES)
- ✅ Queue worker (systemd service)
- ✅ Nginx configuration dengan SSL
- ✅ Security checklist
- ✅ Performance optimization
- ✅ Troubleshooting guide

---

## 🐛 Known Limitations

- **Live Chat:** Basic implementation (no typing indicators, read receipts)
- **Search:** Simple LIKE query (bisa upgrade ke Algolia/Meilisearch)
- **Image Storage:** Local filesystem (production: gunakan S3/Cloudinary)
- **Analytics:** Belum terintegrasi (Google Analytics/Matomo dapat ditambahkan)
- **Multi-language:** Saat ini bahasa Indonesia saja

---

## 🛠️ Development

```bash
# Watch for changes
npm run dev           # Terminal 1: Vite dev server
php artisan serve     # Terminal 2: Laravel server

# Run tests in watch mode
php artisan test --watch

# Clear all cache
php artisan optimize:clear
```

---

## 📄 License

Private project for ReyxShop family business. All rights reserved.

---

## 👥 Contributors

**Built with ❤️ by:**
- [@reya-prm](https://github.com/reya-prm) — Development & Architecture

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) — The PHP Framework for Web Artisans
- [Filament](https://filamentphp.com) — Accelerated Admin Panel Builder
- [Tailwind CSS](https://tailwindcss.com) — Utility-First CSS Framework
- [Spatie](https://spatie.be) — Laravel Packages (Permissions, SEO Tools)
- [Alpine.js](https://alpinejs.dev) — Lightweight JavaScript Framework

---

<div align="center">

**Made in Indonesia 🇮🇩 for the Off-Road Community**

[⬆ Back to Top](#-reyxshop)

</div>
