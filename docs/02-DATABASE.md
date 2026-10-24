# ReyxShop — Database Specification

## Database
MySQL.

Migration adalah source of truth untuk schema utama.

Custom SQL:
```text
database/sql/
├── functions/
├── procedures/
└── triggers/
```

## Tables

### users
Laravel users/admin.

### categories
`id, name, slug, description, is_active, timestamps`

### products
`id, category_id, name, slug, description, price, stock, is_active, timestamps`

### product_images
`id, product_id, image_path, alt_text, sort_order, is_primary, timestamps`

### product_variants
`id, product_id, name, value, additional_price, stock, sku, is_active, timestamps`

### marketplace_links
`id, product_id, marketplace, url, is_active, timestamps`

### banners
`id, title, description, image_path, link_url, sort_order, is_active, starts_at, ends_at, timestamps`

### reviews
`id, product_id, user_id, rating, content, status, timestamps`

(Catatan: `user_id` wajib untuk data baru. Legacy data lama mungkin masih memiliki `customer_name nullable`, tapi fitur baru mewajibkan login.)

### review_replies
`id, review_id, user_id, content, timestamps`

### product_questions
`id, product_id, user_id, question, status, timestamps`

(Catatan: `user_id` wajib untuk data baru. Legacy data lama mungkin masih memiliki `customer_name nullable`, tapi fitur baru mewajibkan login.)

### question_answers
`id, question_id, user_id, answer, timestamps`

### chat_conversations
`id, user_id, assigned_user_id nullable, status, last_message_at nullable, timestamps`

(Catatan: `user_id` wajib untuk data baru. Legacy data lama mungkin masih memiliki `customer_name nullable`, tapi fitur baru mewajibkan login.)

### chat_messages
`id, conversation_id, user_id, sender_type, message, read_at nullable, timestamps`

(Catatan: `user_id` wajib untuk data baru. Legacy data lama mungkin masih memiliki `customer_name nullable`, tapi fitur baru mewajibkan login.)

### store_settings
`id, key, value, type, timestamps`

## Relationships
```text
categories
  └── products
       ├── product_images
       ├── product_variants
       ├── marketplace_links
       ├── reviews
       │    └── review_replies
       └── product_questions
            └── question_answers

chat_conversations
  └── chat_messages

users
  └── admin replies/answers/chat messages
```

Gunakan foreign keys, indexes, dan unique constraints sesuai kebutuhan.

## Suggested Indexes
- products.slug
- products.category_id
- products.is_active
- categories.slug
- marketplace_links.product_id
- reviews.product_id
- product_questions.product_id
- chat_messages.conversation_id
- chat_conversations.status
- chat_conversations.last_message_at

## SQL Function
Buat minimal satu Function yang benar-benar berguna.

Contoh:
`fn_product_final_price(product_id)`

Tujuan: reusable calculation untuk harga final.

## SQL Procedure
Contoh:
`sp_update_product_stock(product_id, quantity_delta)`

Tujuan: operasi update stock yang terkontrol.

## SQL Trigger
Contoh:
`trg_product_stock_status`

Tujuan: mengubah state/status terkait setelah perubahan stock bila memang diperlukan.

Trigger tidak boleh menimbulkan side effect tersembunyi yang menyulitkan Laravel.

## File SQL
```text
database/sql/
├── functions/
│   └── fn_product_final_price.sql
├── procedures/
│   └── sp_update_product_stock.sql
└── triggers/
    └── trg_product_stock_status.sql
```

Nama boleh berubah jika implementasi membutuhkan.

## Migration Rollback
Setiap migration memiliki `down()` yang benar.

Development:
```bash
php artisan migrate
php artisan migrate:rollback
php artisan migrate
```

Jangan menjalankan destructive command secara sembarangan di production.

## Development Order
1. migrations
2. foreign keys/indexes
3. models/relationships
4. seeders/factories
5. Function
6. Procedure
7. Trigger
8. integration
9. commit milestone

## Rules
- Migration untuk schema.
- Seeder/factory untuk data awal/testing.
- Jangan simpan secrets dalam SQL.
- Gunakan transaction untuk operasi multi-step penting.
- Jangan membuat routine hanya untuk memenuhi checklist.
