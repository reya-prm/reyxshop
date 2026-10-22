# ReyxShop — Master Blueprint

## Project
ReyxShop adalah website resmi katalog/toko online untuk toko keluarga. Website menjadi storefront resmi yang menampilkan produk dan mengarahkan pembeli ke marketplace/WhatsApp.

## Stack
- Laravel 13
- PHP kompatibel Laravel 13
- MySQL
- Blade
- Tailwind CSS
- Livewire bila diperlukan
- Filament
- Laravel Reverb
- Vite
- Composer + NPM

Arsitektur utama **full Laravel**, bukan React frontend terpisah dan bukan REST API sebagai aplikasi terpisah.

## Scope
- Product catalog
- Categories
- Product images
- Product variants
- Marketplace links
- Reviews + admin replies
- Product Q&A
- Banners/promotions
- Store settings/status
- Live chat customer ↔ admin
- Filament admin
- Authentication/authorization

## Prinsip Development
- Bangun bertahap, bukan sekali jadi.
- Functionality lebih dulu daripada visual polish.
- Ikuti Laravel conventions.
- Jangan overengineering.
- Gunakan reusable components.
- Jangan lompat ke phase berikutnya tanpa kebutuhan.
- Pertahankan fitur yang sudah berjalan.

## Git
Setiap milestone bermakna dibuat commit.

Contoh:
`feat: add product management`

Rollback:
- `git restore` untuk perubahan lokal.
- `git revert` untuk membatalkan commit yang sudah dibuat.
- `git reset` hanya bila memang aman.

## Database
- Migration untuk schema.
- Seeder/factory untuk data.
- SQL Function.
- SQL Procedure.
- SQL Trigger.
- Migration `down()` harus bermakna.

## Urutan Utama
1. Setup
2. Laravel foundation
3. Database
4. Function/Procedure/Trigger
5. Models/relationships
6. Seeder/factory
7. Auth/authorization
8. Filament
9. Product/category management
10. Banner/store settings
11. Customer catalog
12. Product detail
13. Reviews
14. Q&A
15. Marketplace/WhatsApp
16. Live chat
17. Admin chat
18. Responsive polish
19. Security/performance
20. Testing
21. Production preparation
22. Deployment

## File Rules
- `01-SYSTEM.md` = requirement & behavior
- `02-DATABASE.md` = database/SQL
- `03-BACKEND.md` = Laravel/Filament
- `04-FRONTEND.md` = Blade/Tailwind/Livewire
- `05-DEPLOYMENT.md` = testing & deployment

Jika ada konflik, prioritaskan instruksi terbaru user dan arsitektur master ini.

## Agent Rule
Sebelum mengerjakan phase, baca master + MD yang relevan. Jangan membangun seluruh project sekaligus. Setelah milestone selesai, laporkan file yang berubah, hasil implementasi, command penting, dan rekomendasi commit.
