# ReyxShop — Backend Specification

## Stack
- Laravel 13
- PHP kompatibel Laravel 13
- MySQL
- Blade
- Livewire bila diperlukan
- Filament
- Laravel Reverb
- Vite

Full Laravel. Tidak menggunakan React sebagai aplikasi frontend terpisah.

## Structure
Gunakan:
- Models
- Controllers bila sesuai
- Form Requests
- Policies
- Services bila business logic memang membutuhkan
- Events/listeners bila diperlukan
- Jobs bila asynchronous work memang diperlukan

Hindari abstraksi yang tidak perlu.

## Models
- User
- Category
- Product
- ProductImage
- ProductVariant
- MarketplaceLink
- Banner
- Review
- ReviewReply
- ProductQuestion
- QuestionAnswer
- ChatConversation
- ChatMessage
- StoreSetting

Relationship mengikuti `02-DATABASE.md`.

## Validation
Validasi product, category, image, review, question, chat, banner, marketplace URL.
Jangan mengandalkan client-side validation.

## Authorization
Gunakan policies/authorization untuk admin actions.

- **Guest tidak boleh mengakses admin.**
- **Review, Q&A (tanya produk), dan Live Chat memerlukan login & email terverifikasi.**
- Role `customer` otomatis diberikan saat registrasi.
- Model `User` menggunakan `MustVerifyEmail`.
- Admin panel (`/admin`) hanya dapat diakses oleh role `admin` dan `operator`.
- Middleware `auth` + `verified` wajib pada route untuk review, question, chat.

## Filament
Bangun bertahap:
- ProductResource
- CategoryResource
- image/variant/marketplace relation management
- ReviewResource
- ProductQuestionResource
- BannerResource
- StoreSetting management
- Chat inbox

Gunakan relation managers jika lebih bersih.

## Customer Pages
- Home
- Product listing
- Search/filter
- Product detail
- Reviews
- Q&A
- Chat widget

Gunakan Blade/Livewire sesuai kompleksitas.

## Live Chat
```text
Customer (login & verified)
  ↓
ChatConversation
  ↓
ChatMessage
  ↓
Event
  ↓
Laravel Reverb
  ↓
Admin / Customer
```

Customer harus login untuk menggunakan live chat. Jangan expose admin data.

## Marketplace & WhatsApp
URL marketplace berasal dari database. WhatsApp number berasal dari store settings, bukan hardcode di banyak file.

## SQL Routine Integration
Dokumentasikan alasan, lokasi pemakaian, input/output, dan cara update/rollback setiap Function/Procedure/Trigger.

## Error Handling
Production tidak boleh expose stack trace, SQL error, secrets, atau internal paths.

## Development Phases
### 1. Foundation
Laravel 13, env, DB, Vite/Tailwind, Git.

### 2. Database
Migrations, models, relationships, seeders/factories, SQL routines.

### 3. Admin
Filament, auth, product/category CRUD, images/variants/links, banner/settings.

### 4. Customer
Catalog, search/filter, detail, reviews, Q&A, marketplace/WhatsApp.

### 5. Chat
Conversation/message, customer widget, admin inbox, Reverb.

### 6. Hardening
Authorization, validation, performance, security, tests.

## Git
```bash
git add .
git commit -m "feat: add product management"
```

Rollback local:
```bash
git restore <file>
```

Rollback committed change:
```bash
git revert <commit>
```

Gunakan reset secara hati-hati.
