# Dokumentasi SQL Routines (ReyXShop)

Dokumentasi ini mencakup Function, Procedure, dan Trigger database MySQL pada project ReyXShop sesuai dengan standar arsitektur `02-DATABASE.md`.

---

## 1. Function: `fn_product_final_price`
- **Alasan:** Menyediakan kalkulasi harga produk langsung di level database dengan efisiensi tinggi tanpa memuat seluruh relasi model kompleks di PHP.
- **Lokasi Pemakaian:** Query laporan dan query dashboard operasional.
- **Input:** `p_product_id` (BIGINT UNSIGNED)
- **Output:** `DECIMAL(14, 2)` (Harga produk / 0.00 jika tidak ditemukan)
- **Cara Update:** Edit file `database/sql/functions/fn_product_final_price.sql`, lalu jalankan ulang migration atau `DB::unprepared`.
- **Cara Rollback:** `DROP FUNCTION IF EXISTS fn_product_final_price;`

---

## 2. Procedure: `sp_update_product_stock`
- **Alasan:** Menjamin transaksi update stok produk atomik dengan lock `FOR UPDATE` untuk mencegah *race condition* saat checkout bersamaan.
- **Lokasi Pemakaian:** Proses pemesanan/checkout (OrderController / StockService).
- **Input:** 
  - `p_product_id` (BIGINT UNSIGNED)
  - `p_quantity_delta` (INT, positif untuk restock/pembatalan, negatif untuk pembelian)
- **Output:** Mengupdate kolom `stock` pada tabel `products` secara aman (tidak kurang dari 0).
- **Cara Update:** Edit file `database/sql/procedures/sp_update_product_stock.sql`, lalu jalankan ulang migration.
- **Cara Rollback:** `DROP PROCEDURE IF EXISTS sp_update_product_stock;`

---

## 3. Trigger: `trg_product_stock_status`
- **Alasan:** Menerapkan pengaman integritas data (defensive constraint) di tingkat basis data agar nilai stok tidak pernah bernilai negatif akibat error aplikasi.
- **Lokasi Pemakaian:** Otomatis tereksekusi sebelum operasi `UPDATE` pada tabel `products`.
- **Input:** Baris baru tabel `products`.
- **Output:** Menyetel `NEW.stock = 0` jika `NEW.stock < 0`.
- **Cara Update:** Edit file `database/sql/triggers/trg_product_stock_status.sql`, lalu jalankan ulang migration.
- **Cara Rollback:** `DROP TRIGGER IF EXISTS trg_product_stock_status;`
