# AKDISI Website — Plugin Status & Rationale

**Status: 0 plugin aktif.** Ini keputusan desain, bukan kelalaian.

## Mengapa 0 Plugin (PRD §104)

1. **Kinerja** — plugin menambah CSS/JS/query yang memperlambat FCP & LCP.
   Situs ini statis konten berat + lead form ringan; tidak butuh runtime berat.
2. **Keamanan** — setiap plugin = kode pihak ketiga = permukaan serangan.
   0 plugin = minimalkan risiko kompromi, akun admin, dan supply-chain.
3. **Migrasi tanpa dependency** — target hosting shared (InfinityFree) ganti kapan
   saja; tidak ada lock-in plugin yang ditinggalkan pengembangnya.
4. **PRD §104 eksplisit**: "minimum plugins" — semua fitur yang dibutuhkan
   diselesaikan native/core/theme.

## Fitur yang Dikerjakan Native (tanpa plugin)

| Kebutuhan umumnya via plugin | Di sini disediakan oleh |
|------------------------------|--------------------------|
| SEO meta description + Open Graph | theme `akdisi` (`functions.php`) |
| Sitemap XML | WP core (`wp-sitemap.xml`) |
| Robots.txt | file fisik di docroot |
| Favicon | WP `site_icon` + file SVG/PNG |
| Form lead + validation + simpan | theme (AJAX + nonce, simpan ke option) |
| WhatsApp CTA | theme |
| GA4 analytics | theme (conditional pada theme mod) |
| Schema.org | theme (`akdisi_add_schema_markup`) |
| Portfolio/Insight/FAQ | WP core CPT + taxonomy rego di theme |
| Breadcrumb | theme template |

## Yang Sengaja TIDAK Dipasang

- **Elementor / page builder** — konten di-template, bukan drag-drop; heavy JS dihindari.
- **Yoast / RankMath** — meta & OG sudah di theme; menambah weight + update churn.
- **Contact Form 7 / WPForms** — form custom AJAX lebih ringan, error inline
  per-field persis PRD §106-107, lead tersimpan langsung.
- **WP Rocket / cache plugin** — pada tahap ini belum perlu; bila produktif
  lambat, pertimbangkan cache server-side (hosting) bukan plugin.
- **Security plugin (Wordfence dll)** — hardening manual di theme + 0 plugin
  adalah pertahanan utama; keamanan hosting + strong password lebih berdampak.
- **Backup plugin** — backup manual scripting (lihat `docs/hosting-deploy.md` §4).

## Kapan Plugin Layak

- **n8n / otomasi lead → CRM** (Phase 2, PRD §120): integrasi lebih baik dilakukan
  via webhook/API custom daripada plugin third-party.
- Jika traffic besar & performa menurun: gunakan cache **server-side** (VPS nginx)
  terlebih dahulu, plugin cache hanya sebagai opsi terakhir.

## Catatan WP Core

- WordPress **7.0.4**, theme custom `akdisi`, PHP 8.4, MariaDB 11.8 (dev DDEV).
- Auto-update core aktif; lakukan backup sebelum update mayor.
- Portfolio/Insight diakses publik via WordPress REST biasa (`show_in_rest: true`)
  untuk archive & konten; form & admin tetap nonce-protected.