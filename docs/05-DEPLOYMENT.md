# ReyxShop — Testing & Deployment

## Goal
Membawa ReyxShop dari local development ke production secara aman.

## Environment
Development memakai `.env`, local MySQL, local Reverb, local storage.
Production memakai production env, database, storage, cache/session/queue sesuai kebutuhan, Reverb, domain, HTTPS.

Jangan commit `.env` atau secrets.

## Production
Set minimal:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL`
- production DB credentials
- application secrets

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
