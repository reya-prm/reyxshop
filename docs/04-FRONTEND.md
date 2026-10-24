# ReyxShop — Frontend Specification

## Stack
Customer-facing frontend:
- Blade
- Tailwind CSS
- Livewire bila berguna
- Vite

Tidak menggunakan React sebagai separate frontend app.

## Priority
1. Usability
2. Responsive
3. Clear product information
4. Fast navigation
5. Consistent components
6. Visual polish

Functionality lebih dahulu daripada visual polish.

## Main Pages

### Auth Pages
- Login (`/login`)
- Register (`/register`) – form: name, email, password, password confirmation
- Forgot Password (`/forgot-password`)
- Reset Password (`/reset-password/{token}`)
- Email Verification (`/email/verify`) – notice dan resend link
- Layout konsisten dengan storefront, Tailwind, mobile‑first.

### Home
- navbar (dengan auth state: Login/Register bila guest, nama user + Logout bila sudah login)
- store status/notice
- hero/banner
- featured products
- categories
- promotions
- marketplace/contact CTA
- footer
- floating chat (hanya untuk user yang sudah login & verified)

### Product Listing
- search
- category filter
- product grid
- price
- stock/status
- pagination/loading

### Product Detail
- gallery
- name
- price
- description
- variants
- stock
- marketplace buttons
- WhatsApp
- reviews
- Q&A

## Reusable Components
- Navbar
- Footer
- ProductCard
- ProductGrid
- SearchBar
- CategoryFilter
- ProductGallery
- VariantSelector
- Rating
- ReviewList
- QuestionList
- MarketplaceButton
- WhatsAppButton
- Banner
- StoreStatus
- ChatWidget

Jangan membuat component abstraction yang tidak memberi manfaat.

## Responsive
Wajib mobile, tablet, desktop. Mobile menjadi prioritas karena storefront kemungkinan banyak dibuka dari HP.

## Forms
Review, question, chat:
- validation feedback
- loading state
- success/error feedback
- accessible labels

## Search/Filter
Search harus sederhana dan berguna. Filter kategori dapat mempertahankan URL/state jika sesuai.

## Images
- optimized
- proper alt text
- primary image
- thumbnails/navigation

## Marketplace/WhatsApp
Action harus jelas:
- Buy on Shopee
- Buy on Lazada
- Chat via WhatsApp

Jangan memberi kesan bahwa website memiliki checkout native.

## Chat UX
Floating button tidak mengganggu. Panel harus punya message list, input, loading/error state, dan realtime update bila tersedia.

## Design Direction
- Modern
- Clean
- Light
- Professional
- Product-focused
- Tidak terlalu dark
- Tidak outdated
- Spacing dan typography rapi
- Mobile-first

Detail visual dapat disempurnakan setelah functionality selesai.

## Frontend Order
1. Layout
2. Navbar/footer
3. Home
4. Product listing
5. Search/filter
6. Product detail
7. Marketplace/WhatsApp
8. Reviews
9. Q&A
10. Chat
11. Responsive polish
12. Accessibility/performance polish

## Rules
- Reuse components.
- Hindari duplicated markup.
- Blade tetap readable.
- Business logic jangan ditaruh berlebihan di template.
- Konten admin-managed jangan di-hardcode.
