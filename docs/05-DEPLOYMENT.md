# ReyxShop — Testing & Deployment

## Goal
Membawa ReyxShop dari local development ke production secara aman.

## Environment
Development memakai `.env`, local MySQL, local Reverb, local storage.
Production memakai production env, database, storage, cache/session/queue sesuai kebutuhan, Reverb, domain, HTTPS.

Jangan commit `.env` atau secrets.

## Production
+### SMTP untuk email verification
+Set mail driver ke `smtp` dengan kredensial produksi:
+```
+MAIL_MAILER=smtp
+MAIL_HOST=smtp.example.com
+MAIL_PORT=587
+MAIL_USERNAME=you@example.com
+MAIL_PASSWORD=very-secret
+MAIL_ENCRYPTION=tls
+MAIL_FROM_ADDRESS=no-reply@reyxshop.com
+MAIL_FROM_NAME="ReyxShop"
+```
+Pastikan `queue` dijalankan untuk mengirim email secara async.
+
+### Reverb production configuration
+Pada `.env` produksi tambahkan:
+```
+BROADCAST_CONNECTION=reverb
+REVERB_APP_KEY=prod_key
+REVERB_APP_ID=prod_id
+REVERB_APP_SECRET=prod_secret
+REVERB_HOST=your-reverb-host.com
+REVERB_PORT=443
+REVERB_SCHEME=wss
+```
+Jalankan Reverb daemon atau supervisor service:
+```bash
+php artisan reverb:start --daemon
+```
+Pastikan firewall memperbolehkan port WebSocket (443) dan gunakan TLS.
+```

Gunakan PHP/extensions yang kompatibel dengan Laravel 13.

## Build
Contoh deployment:
```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Command dapat disesuaikan dengan hosting.

## Reverb
Jika chat realtime aktif:
- configure production Reverb env
- jalankan Reverb service/process
- configure reverse proxy/process manager jika diperlukan
- gunakan secure websocket configuration

## Storage
Gunakan Laravel storage untuk product/banner images.
Pastikan disk, permission, `storage:link`, dan backup sesuai environment.

## Database
Sebelum migration production, pastikan backup tersedia.
Jangan menggunakan destructive commands secara sembarangan.

Function/Procedure/Trigger harus versioned dan diterapkan melalui deployment process yang terdokumentasi.

## Testing
### Functional
Test:
- Home
- Product list
- Search
- Filter
- Product detail
- Variants
- Marketplace
- WhatsApp
- Reviews
- Q&A
- Chat
- Admin CRUD
- Store status
- Banners

### Authorization
Pastikan guest tidak dapat masuk admin dan unauthorized user tidak dapat memodifikasi data.

### Validation
Uji invalid product, upload, review, question, chat, marketplace URL.

### Responsive
Test mobile, tablet, desktop.

## Performance
- Optimize images.
- Check N+1 queries.
- Use pagination.
- Cache where appropriate.
- Build production assets.
- Avoid unnecessary DB queries.

## Security
- APP_DEBUG=false
- server-side validation
- authorization
- CSRF
- secure authentication
- secret protection
- no internal error exposure
- dependencies maintained

## Deployment Order
1. Production environment
2. `.env`
3. dependencies
4. frontend build
5. database
6. migrations/routines
7. storage
8. Reverb
9. Laravel optimize
10. required processes
11. domain

## Git Release
```text
feature
  ↓
development
  ↓
stable/main
  ↓
production
```

Meaningful commits tetap digunakan.

## Rollback
Code:
`git revert <commit>`

Local changes:
`git restore <file>`

Database:
gunakan migration rollback hanya jika aman dan sesuai kondisi. Production data rollback harus direncanakan karena tidak selalu reversible.

## Definition of Done
- Core customer features work.
- Admin manages core data.
- Relationships work.
- Function/Procedure/Trigger integrated/documented.
- Reviews/Q&A work.
- Marketplace/WhatsApp work.
- Live chat works if enabled.
- Authorization works.
- Responsive.
- Production config ready.
- Secrets not committed.
- Git history contains meaningful milestones.
