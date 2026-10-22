# ReyxShop — System Requirements

## Customer
Customer dapat:
- Browse produk.
- Search.
- Filter kategori.
- Membuka detail produk.
- Melihat gambar, harga, stok, variasi.
- Membaca review.
- Membaca Q&A.
- Bertanya tentang produk.
- Membuka marketplace.
- Chat WhatsApp.
- Menggunakan live chat.

Browsing dan live chat tidak boleh dibuat bergantung pada registrasi yang rumit.

## Admin / Operator
Admin dapat:
- CRUD produk.
- CRUD kategori.
- Kelola gambar.
- Kelola variasi.
- Kelola marketplace links.
- Kelola banner.
- Kelola store status/settings.
- Moderasi review.
- Menjawab Q&A.
- Mengelola live chat.
- Mengelola admin/operator sesuai authorization.

## Product Catalog
Listing:
- image
- name
- price
- stock/status
- category
- search
- category filter

Detail:
- gallery
- name
- description
- price
- stock
- variants
- marketplace links
- WhatsApp
- reviews
- Q&A

Kategori dapat berupa jersey/clothing, gloves, riding gear, parts, accessories, dan harus admin-configurable.

## Marketplace
Website bukan pengganti checkout marketplace.
Channel:
- Shopee
- Lazada
- marketplace lain bila diperlukan
- WhatsApp

Satu produk dapat memiliki beberapa marketplace links.

## Reviews
Review memiliki product, customer identity/name bila relevan, rating, content, status, timestamps.
Admin dapat moderate dan memberi official reply.

## Q&A
Customer dapat bertanya tentang produk. Admin dapat menjawab. Simpan product, question, customer data bila ada, answer, admin, status/timestamps.

## Live Chat
Customer:
- buka floating widget
- mulai conversation
- kirim pesan
- menerima balasan

Admin:
- melihat conversation
- membuka conversation
- membalas

Gunakan Laravel Reverb untuk realtime. Guest chat diperbolehkan menggunakan session/token yang aman.

## Store Settings
Admin mengatur:
- open/closed status
- notice
- contact info
- WhatsApp
- marketplace/social links bila diperlukan
- global settings

## Banners
Admin mengatur:
- image
- title
- description
- link/action
- active state
- order
- optional schedule

## Admin Panel
Filament modules:
- Products
- Categories
- Images
- Variants
- Marketplace links
- Reviews
- Review replies
- Product questions
- Question answers
- Banners
- Store settings
- Chat conversations/messages
- Admin users

## Non-functional
- Responsive.
- Mobile friendly.
- Secure validation.
- Authorization.
- Database indexing.
- Reusable UI.
- Maintainable Laravel structure.
- Production-ready config.

## Priority
P0: catalog, product detail, admin CRUD, marketplace, WhatsApp, store settings.
P1: reviews, Q&A, banners, live chat.
P2: advanced polish/analytics.

Jangan menambah native checkout/payment/order management kecuali diminta kemudian.
