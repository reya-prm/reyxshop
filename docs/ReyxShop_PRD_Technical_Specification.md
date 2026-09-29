# PRD & Technical Specification — ReyxShop

## 1. Informasi Proyek

**Nama Proyek:** ReyxShop  
**Jenis:** Website Katalog & Toko Online Interaktif  
**Pemilik:** Toko kebutuhan off-road motor  
**Target:** Pelanggan toko dan pengunjung umum  
**Tujuan utama:** Menjadi website resmi ReyxShop untuk menampilkan katalog produk, membantu pelanggan menemukan produk, menyediakan komunikasi langsung dengan admin, serta mengarahkan transaksi ke marketplace atau WhatsApp.

---

# 2. Gambaran Umum

ReyxShop adalah website resmi toko yang menjual berbagai kebutuhan off-road motor, seperti:

- Jersey / baju riding
- Celana riding
- Sarung tangan
- Helm
- Goggles
- Sepatu / boots
- Body protector
- Aksesori motor
- Parts dan perlengkapan pendukung off-road
- Produk kebutuhan adventure / trail lainnya

Website tidak harus menjadi marketplace penuh seperti Shopee atau Tokopedia. Fokus utama ReyxShop adalah:

1. Menampilkan produk secara profesional.
2. Membantu pelanggan menemukan produk.
3. Memberikan informasi produk yang lengkap.
4. Mengarahkan pembelian ke Shopee, Lazada, atau WhatsApp.
5. Menyediakan live chat dengan admin.
6. Menampilkan review dan Q&A produk.
7. Memudahkan admin mengelola seluruh konten melalui panel admin.

---

# 3. Tujuan Bisnis

## Tujuan Utama

- Membangun identitas digital resmi ReyxShop.
- Meningkatkan kepercayaan pelanggan.
- Menjadi katalog pusat untuk seluruh produk.
- Mengarahkan pelanggan ke kanal pembelian resmi.
- Mengurangi ketergantungan pada marketplace sebagai satu-satunya sumber informasi produk.
- Memudahkan admin mengelola katalog dan komunikasi pelanggan.

## Indikator Keberhasilan

- Produk mudah ditemukan.
- Informasi produk lengkap.
- Pengunjung dapat berpindah dari produk ke marketplace dengan mudah.
- Pelanggan dapat menghubungi admin dengan cepat.
- Admin dapat mengelola produk tanpa harus mengubah kode.
- Website nyaman digunakan pada desktop maupun mobile.

---

# 4. Target Pengguna

## 4.1 Pengunjung / Pembeli

Pengunjung dapat:

- Melihat produk.
- Mencari produk.
- Memfilter berdasarkan kategori.
- Melihat detail produk.
- Melihat variasi produk.
- Melihat stok/status ketersediaan.
- Melihat review.
- Membaca Q&A.
- Mengirim pertanyaan.
- Menghubungi admin melalui live chat.
- Membeli melalui Shopee.
- Membeli melalui Lazada.
- Menghubungi WhatsApp untuk pembelian atau konsultasi.

Pengunjung tidak diwajibkan membuat akun hanya untuk melihat katalog atau memulai percakapan.

## 4.2 Admin / Operator

Admin dapat:

- Login ke panel admin.
- Mengelola produk.
- Mengelola kategori.
- Mengelola variasi.
- Mengelola stok/status produk.
- Mengelola marketplace link.
- Mengelola banner.
- Mengubah status toko.
- Membaca dan membalas live chat.
- Memoderasi review.
- Membalas Q&A.
- Melihat riwayat chat.
- Mengelola data pelanggan yang tersedia dari interaksi website.

---

# 5. Tech Stack

## Frontend

- Laravel Blade
- Tailwind CSS
- Alpine.js (opsional, hanya untuk interaksi ringan)
- Laravel routing / controllers

## Application Stack

- Laravel
- Blade
- Tailwind CSS
- Alpine.js (opsional)
- Laravel Reverb untuk real-time

## Admin Panel

- Filament PHP
- Filament Resources
- Filament Widgets jika diperlukan

## Database

- MySQL

## Development

- Git
- GitHub
- Composer
- Node.js / npm

---

# 6. Arsitektur Sistem

ReyxShop menggunakan **full Laravel** sebagai satu aplikasi utama. Tidak ada React, Vite frontend terpisah, atau REST API sebagai arsitektur utama.

```text
Browser
   |
   v
Laravel
   +---- Blade + Tailwind CSS
   +---- Controllers / Requests / Services
   +---- Eloquent Models
   +---- Filament Admin
   +---- Laravel Reverb
   |
   v
MySQL
```

## Laravel

Laravel bertanggung jawab terhadap:

- Routing dan halaman website.
- Blade views.
- Business logic.
- Validasi.
- Database dan Eloquent ORM.
- Authentication dan authorization.
- Produk, kategori, variasi, review, Q&A, chat, banner, dan store status.
- Admin panel melalui Filament.
- Broadcasting real-time melalui Laravel Reverb.

## Blade + Tailwind

Blade bertanggung jawab terhadap rendering halaman server-side.

Tailwind digunakan untuk seluruh styling frontend dan komponen UI.

Alpine.js hanya digunakan jika dibutuhkan untuk interaksi ringan seperti modal, dropdown, filter mobile, gallery, atau state widget tanpa membuat frontend terpisah.

## Filament

Filament bertanggung jawab terhadap:

- Administrasi data.
- CRUD.
- Moderasi.
- Monitoring.
- Pengelolaan konten.
- Dashboard admin.

# 7. Struktur Halaman Frontend

## 7.1 Homepage

Bagian utama:

1. Navbar
2. Hero section
3. Store status
4. Promotional banner
5. Featured categories
6. Produk unggulan
7. Produk terbaru
8. Promo
9. Why Choose ReyxShop
10. Review pelanggan
11. Marketplace CTA
12. Footer
13. Floating live chat

### Hero

Contoh headline:

> GEAR UP. RIDE HARD.

Subheadline:

> Perlengkapan dan kebutuhan off-road untuk menemani setiap perjalananmu.

CTA:

- Belanja Sekarang
- Jelajahi Produk

---

# 8. Halaman Katalog Produk

Route contoh:

```text
/products
```

Fitur:

- Search.
- Filter kategori.
- Filter harga jika diperlukan.
- Filter status.
- Sorting.
- Pagination.
- Product grid.

Kategori contoh:

- Jersey
- Celana Riding
- Gloves
- Helm
- Goggles
- Boots
- Body Protection
- Aksesori Motor
- Parts
- Adventure Gear

---

# 9. Product Detail

Route contoh:

```text
/products/{slug}
```

Informasi:

- Foto utama.
- Galeri foto.
- Nama produk.
- Kategori.
- Harga.
- Harga diskon jika ada.
- Rating.
- Deskripsi.
- Spesifikasi.
- Variasi.
- Stok.
- Informasi ukuran.
- Marketplace link.
- WhatsApp CTA.

CTA:

```text
BUY ON SHOPEE
BUY ON LAZADA
CHAT WHATSAPP
```

---

# 10. Sistem Variasi Produk

Produk dapat memiliki variasi seperti:

- Ukuran: S, M, L, XL, XXL.
- Warna.
- Model.
- Tipe.
- Variasi khusus produk.

Setiap variasi dapat memiliki:

- Nama variasi.
- SKU.
- Harga.
- Stok.
- Status aktif.

Contoh:

```text
Reyx Enduro Jersey

Ukuran:
S / M / L / XL / XXL

Warna:
Black / Red / White
```

---

# 11. Live Chat Real-Time

Live chat tersedia sebagai widget di frontend.

## Pengunjung

Tidak perlu registrasi rumit.

Data awal percakapan dapat menggunakan:

- Nama pengunjung.
- Session / guest identifier.
- Pesan.

## Admin

Admin memiliki inbox pada Filament.

Fitur:

- Daftar percakapan.
- Status unread.
- Detail percakapan.
- Balas pesan.
- Timestamp.
- Status conversation.

## Real-Time

Gunakan:

```text
Laravel Reverb
atau
Pusher
```

Alur:

```text
Customer
   |
   | Send message
   v
Laravel API
   |
   v
Database
   |
   v
Broadcast Event
   |
   v
Admin
```

Balasan admin mengikuti alur sebaliknya.

---

# 12. Review Produk

Setiap produk memiliki bagian review.

Review memiliki:

- Nama pengguna.
- Rating.
- Isi review.
- Tanggal.
- Produk.
- Status moderasi.

Status:

```text
pending
approved
rejected
```

Review hanya tampil di frontend jika:

```text
status = approved
```

---

# 13. Admin Reply Review

Admin dapat memberikan balasan resmi.

Frontend menampilkan:

```text
Customer Review
     |
     +-- ReyxShop Official Reply
```

Balasan resmi harus memiliki identitas yang jelas agar pelanggan dapat membedakan jawaban admin dengan review pengguna.

---

# 14. Product Q&A

Setiap produk memiliki bagian:

```text
Tanya Jawab
```

Pengunjung dapat mengirim pertanyaan.

Admin dapat:

- Melihat pertanyaan.
- Menjawab.
- Menyembunyikan pertanyaan jika diperlukan.

Status:

```text
pending
answered
hidden
```

---

# 15. Dynamic Banner

Admin dapat mengelola banner homepage.

Data banner:

- Judul.
- Subtitle.
- Gambar.
- CTA text.
- CTA URL.
- Urutan.
- Status aktif.
- Tanggal mulai.
- Tanggal selesai.

Contoh:

```text
OFF-ROAD SEASON SALE
Diskon hingga 30%
[SHOP NOW]
```

---

# 16. Store Status

Admin memiliki switch:

```text
Toko Buka
Toko Tutup
```

Frontend menampilkan:

```text
● TOKO BUKA
```

atau:

```text
● TOKO TUTUP
```

Status harus dapat diubah tanpa deploy ulang.

---

# 17. Marketplace Integration

Setiap produk dapat memiliki link:

- Shopee.
- Lazada.
- WhatsApp.

Contoh data:

```text
shopee_url
lazada_url
whatsapp_number
```

Link marketplace dikelola admin melalui Filament.

Jika salah satu link tidak tersedia, tombol tersebut tidak perlu ditampilkan.

---

# 18. WhatsApp Integration

WhatsApp digunakan untuk:

- Konsultasi produk.
- Tanya stok.
- Tanya ukuran.
- Pembelian langsung.
- Customer support.

Format pesan dapat dibuat otomatis berdasarkan produk.

Contoh:

```text
Halo ReyxShop, saya ingin bertanya tentang produk Reyx Enduro Jersey.
```

---

# 19. Database Design

## users

```text
id
name
email
password
role
created_at
updated_at
```

Role:

```text
admin
operator
```

---

## categories

```text
id
name
slug
description
image
is_active
created_at
updated_at
```

---

## products

```text
id
category_id
name
slug
description
price
discount_price
sku
stock
status
thumbnail
created_at
updated_at
```

Status:

```text
active
inactive
out_of_stock
```

---

## product_images

```text
id
product_id
image
sort_order
created_at
updated_at
```

---

## product_variants

```text
id
product_id
name
sku
price
stock
is_active
created_at
updated_at
```

---

## marketplace_links

```text
id
product_id
shopee_url
lazada_url
whatsapp_url
created_at
updated_at
```

---

## banners

```text
id
title
subtitle
image
button_text
button_url
sort_order
is_active
start_at
end_at
created_at
updated_at
```

---

## reviews

```text
id
product_id
name
rating
message
status
created_at
updated_at
```

---

## review_replies

```text
id
review_id
admin_id
message
created_at
updated_at
```

---

## product_questions

```text
id
product_id
name
question
status
created_at
updated_at
```

---

## question_answers

```text
id
question_id
admin_id
answer
created_at
updated_at
```

---

## chat_conversations

```text
id
guest_identifier
name
status
last_message_at
created_at
updated_at
```

Status:

```text
open
closed
```

---

## chat_messages

```text
id
conversation_id
sender_type
sender_id
message
is_read
created_at
updated_at
```

Sender type:

```text
customer
admin
```

---

## store_settings

```text
id
store_name
is_open
whatsapp_number
shopee_url
lazada_url
description
created_at
updated_at
```

---

# 20. Relasi Database

```text
Category
   |
   +---- Products
             |
             +---- Product Images
             |
             +---- Product Variants
             |
             +---- Marketplace Links
             |
             +---- Reviews
             |       |
             |       +---- Review Replies
             |
             +---- Product Questions
                     |
                     +---- Question Answers
```

Chat:

```text
Chat Conversation
      |
      +---- Chat Messages
```

---

# 21. Laravel Application Flow

Website menggunakan Laravel routes dan controller secara langsung.

Contoh route:

```text
GET  /products
GET  /products/{slug}
POST /products/{product}/reviews
POST /products/{product}/questions
POST /chat/conversations
POST /chat/conversations/{conversation}/messages
GET  /store
GET  /banners
```

Tidak diperlukan REST API terpisah untuk frontend utama. Jika API internal benar-benar dibutuhkan di masa depan, endpoint dapat ditambahkan tanpa mengubah arsitektur utama.

# 22. Laravel Response & Validation Standard

Gunakan pola Laravel standar:

- Form Request untuk validasi input.
- Controller untuk menerima request dan mengatur alur.
- Service hanya jika business logic mulai kompleks.
- Eloquent untuk akses database.
- Policy / Gate untuk authorization.
- Redirect + session flash message untuk aksi form biasa.
- Blade error state untuk validasi.

Contoh feedback:

```text
Data berhasil disimpan.
Terjadi kesalahan. Silakan coba lagi.
```

# 23. Admin Panel Filament

## Dashboard

Dashboard menampilkan informasi ringkas:

- Total produk.
- Produk aktif.
- Produk habis.
- Review pending.
- Q&A pending.
- Chat belum dibaca.
- Status toko.

---

# 24. Filament Resources

Resource yang diperlukan:

```text
ProductResource
CategoryResource
ProductVariantResource
BannerResource
ReviewResource
ProductQuestionResource
ChatConversationResource
UserResource
StoreSettingResource
```

---

# 25. Product Management

Admin dapat:

- Tambah produk.
- Edit produk.
- Hapus produk.
- Upload foto.
- Mengatur kategori.
- Mengatur harga.
- Mengatur stok.
- Mengatur variasi.
- Mengatur marketplace.
- Mengubah status produk.

---

# 26. Review Moderation

Admin dapat:

```text
Pending
Approved
Rejected
```

Action:

- Approve.
- Reject.
- Delete.
- Reply.

---

# 27. Chat Inbox

Admin dapat melihat:

```text
Inbox
----------------------
Andi       2 new
Budi       1 new
Customer   0 new
```

Ketika conversation dibuka:

```text
Customer:
Kak ukuran L masih ada?

Admin:
Masih tersedia kak.
```

Chat diperbarui secara real-time.

---

# 28. UI / UX Design

## Brand Identity

Nama:

```text
REYXSHOP
```

Tema:

```text
Light, Modern, Sporty, Premium
```

Warna:

```text
Primary: Red
Background: White / Off-White
Surface: White
Text: Slate / Dark Gray
Secondary Text: Gray
Accent: Soft Red
Border: Light Gray
```

Desain tidak menggunakan dark mode sebagai tampilan utama. Gunakan whitespace yang cukup, typography yang tegas, card bersih, dan aksen merah secukupnya.

## Visual Style

Karakter desain:

- Premium.
- Aggressive.
- Sporty.
- Rugged.
- Modern.
- Clean.
- Professional.

Inspirasi visual:

- Motocross.
- Enduro.
- Trail.
- Adventure riding.
- Motorsport.

Hindari:

- Desain terlalu ramai.
- Terlalu banyak gradient.
- Card terlalu membulat.
- Tampilan seperti marketplace generik.
- Warna terlalu banyak.

---

# 29. Responsive Design

Website wajib mendukung:

- Desktop.
- Laptop.
- Tablet.
- Mobile.

Mobile harus memiliki:

- Navbar responsif.
- Product grid responsif.
- Filter yang mudah digunakan.
- Tombol CTA yang mudah disentuh.
- Live chat yang nyaman.
- Galeri produk yang responsif.

---

# 30. Search & Filter

Search dapat mencari:

- Nama produk.
- SKU.
- Kategori.

Filter:

- Kategori.
- Harga.
- Status.
- Variasi jika relevan.

Sorting:

```text
Terbaru
Harga Terendah
Harga Tertinggi
Nama A-Z
Produk Terpopuler
```

---

# 31. SEO

Setiap halaman produk harus memiliki:

- Dynamic title.
- Meta description.
- Slug SEO-friendly.
- Open Graph image.
- Canonical URL jika diperlukan.

Contoh:

```text
/reys-enduro-jersey
```

---

# 32. Security

Backend harus menerapkan:

- Request validation.
- Authorization.
- Authentication untuk admin.
- Rate limiting.
- Sanitasi input.
- Proteksi endpoint admin.
- Validasi upload gambar.
- Proteksi mass assignment.
- CORS sesuai kebutuhan frontend.

Pengunjung tidak boleh memiliki akses langsung terhadap endpoint admin.

---

# 33. Upload Image

Admin dapat upload:

- Product image.
- Banner image.
- Category image.

Validasi minimal:

```text
jpg
jpeg
png
webp
```

Ukuran file dibatasi melalui backend.

---

# 34. Error Handling

Frontend harus memiliki state:

```text
Loading
Success
Empty
Error
```

Contoh:

```text
Loading products...
```

Jika tidak ada produk:

```text
Produk tidak ditemukan.
```

Jika API gagal:

```text
Terjadi masalah saat mengambil data.
Silakan coba lagi.
```

---

# 35. Empty State

Contoh:

```text
Tidak ada produk yang sesuai dengan pencarianmu.
```

Untuk chat:

```text
Belum ada percakapan.
```

Untuk review:

```text
Belum ada ulasan untuk produk ini.
```

---

# 36. Project Structure

Struktur utama:

```text
app/
├── Filament/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Middleware/
├── Models/
├── Events/
├── Services/
└── Policies/

database/
├── factories/
├── migrations/
└── seeders/

resources/
├── views/
│   ├── layouts/
│   ├── components/
│   ├── home/
│   ├── products/
│   ├── chat/
│   └── pages/
├── css/
│   └── app.css
└── js/
    └── app.js

routes/
├── web.php
└── channels.php

public/
└── images/
```
# 37. Blade Components

Komponen UI yang disarankan:

```text
Navbar
Hero
StoreStatus
Banner
CategoryCard
ProductCard
ProductGrid
SearchBar
FilterPanel
ProductGallery
ProductInfo
ProductVariation
MarketplaceButtons
ReviewList
ReviewCard
QuestionList
QuestionForm
LiveChat
ChatMessage
Footer
LoadingState
EmptyState
ErrorState
```

Komponen dibuat sebagai Blade Components yang reusable.

# 45. Tahapan Pengembangan & Strategi Commit

Pengembangan wajib dilakukan bertahap. Jangan menyelesaikan seluruh fitur dalam satu commit. Setiap tahap harus selesai, dijalankan, dan di-recheck sebelum commit.

## Tahap 1 — Project Foundation
- Buat project Laravel.
- Konfigurasi `.env`.
- Hubungkan MySQL.
- Setup Git dan GitHub.
- Setup Tailwind CSS.
- Buat layout Blade dasar.
- Buat halaman test sederhana.

**Commit:** `chore: setup laravel project and tailwind`

## Tahap 2 — Base Layout & Design System
- Navbar.
- Footer.
- Container.
- Typography.
- Button.
- Badge.
- Card.
- Alert.
- Responsive base.
- Terapkan desain light, modern, sporty.

**Commit:** `feat: create base blade layout and design system`

## Tahap 3 — Database Foundation
- Buat migration.
- Buat model.
- Buat relationship.
- Buat factory dan seeder dasar.
- Jalankan migration dan seed.
- Re-check struktur database.

**Commit:** `feat: create core database structure`

## Tahap 4 — Category Management
- CRUD kategori melalui Filament.
- Upload gambar kategori.
- Status aktif/nonaktif.

**Commit:** `feat: add category management`

## Tahap 5 — Product Management
- CRUD produk.
- Kategori.
- Harga.
- SKU.
- Stok.
- Status.
- Thumbnail.

**Commit:** `feat: add product management`

## Tahap 6 — Product Images & Variants
- Galeri produk.
- Variasi.
- SKU variasi.
- Harga variasi.
- Stok variasi.

**Commit:** `feat: add product variants and gallery`

## Tahap 7 — Marketplace Integration
- Shopee.
- Lazada.
- WhatsApp.
- Dynamic CTA.
- Sembunyikan CTA yang tidak memiliki link.

**Commit:** `feat: add marketplace integration`

## Tahap 8 — Customer Catalog
- Homepage.
- Product listing.
- Search.
- Filter.
- Sorting.
- Pagination.
- Product detail.

**Commit:** `feat: build customer product catalog`

## Tahap 9 — Homepage Content
- Hero.
- Banner dinamis.
- Featured categories.
- Featured products.
- Store status.
- CTA marketplace.
- Footer.

**Commit:** `feat: build dynamic homepage`

## Tahap 10 — Review & Q&A
- Review submission.
- Moderation.
- Admin reply.
- Product Q&A.
- Answer management.

**Commit:** `feat: add product reviews and qna`

## Tahap 11 — Live Chat
- Conversation.
- Messages.
- Guest identifier.
- Admin inbox.
- Laravel Reverb.
- Real-time message update.

**Commit:** `feat: add realtime customer chat`

## Tahap 12 — Authentication & Authorization
- Admin authentication.
- Role admin/operator.
- Policy.
- Proteksi route admin.
- Authorization check.

**Commit:** `feat: secure admin access`

## Tahap 13 — SEO, Error & UX
- Dynamic title.
- Meta description.
- Open Graph.
- Loading state.
- Empty state.
- Error state.
- Validation feedback.

**Commit:** `feat: improve seo and user experience`

## Tahap 14 — Security & Performance
- Request validation.
- Rate limiting.
- Upload validation.
- Mass assignment protection.
- N+1 check.
- Eager loading.
- Image optimization.
- Caching jika diperlukan.

**Commit:** `refactor: improve security and performance`

## Tahap 15 — Testing & Final QA
- Feature testing.
- Form validation testing.
- Authorization testing.
- Responsive testing.
- Browser testing.
- Chat testing.
- Marketplace CTA testing.

**Commit:** `test: add final application tests`

## Tahap 16 — Production & Deployment
- Production `.env`.
- Database migration.
- Storage setup.
- Queue/realtime configuration.
- Cache optimization.
- Final smoke test.

**Commit:** `chore: prepare application for production`

### Aturan Setiap Tahap

Sebelum commit:

1. Selesaikan task tahap tersebut.
2. Jalankan aplikasi.
3. Test fitur yang baru dibuat.
4. Re-check perubahan pertama kali.
5. Perbaiki error yang ditemukan.
6. Re-check kedua kali.
7. Pastikan tidak merusak fitur tahap sebelumnya.
8. Baru lakukan commit dan push.

Jangan menggabungkan beberapa tahap besar menjadi satu commit hanya agar development terlihat selesai lebih cepat.


