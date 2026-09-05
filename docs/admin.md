# AKDISI Website — Admin Guide

Panduan pengelolaan konten website AKDISI di WordPress admin.

**URL admin:** `https://akdisi.ddev.site:8443/wp-admin/` (produksi: sesuai domain)
**Cara akses:** login dengan akun administrator.

---

## 1. Menu di Admin

| Menu | Isi | Cara kelola |
|------|-----|-------------|
| Posts → Categories | 5 kategori Insight (content pillars) | Tambah/rename kategori artikel |
| Posts → Insights | 6 artikel insight | Edit konten artikel biasa |
| Portfolio → Projects | 8 konsep project | Lihat "Portfolio Field Set" di bawah |
| Portfolio → Categories | Kategori portfolio | Grouping project |
| FAQ | 7 pertanyaan | Tambah/edit FAQ; urut via Order |
| Pages | Semua halaman statis | Edit konten halaman |
| Appearance → Menus | Menu utama + footer | Struktur navigasi |
| Appearance → Customize | Logo, deskripsi, WhatsApp, GA4 ID | Pengaturan identitas |

---

## 2. Portfolio Field Set (Detail Proyek)

Setiap Project punya metabox **"Detail Proyek"** di editor portfolio berisi:

- **Problem / Latar Belakang** — masalah yang diselesaikan
- **Solusi yang Diberikan** — pendekatan solusi
- **Fitur Utama** — satu fitur per baris (render sebagai bullet list)
- **Hasil / Dampak yang Diharapkan**
- **ID Halaman Layanan Terkait** — angka ID (50=Application Dev, 51=Business Process, 52=Data & Admin, 53=Custom Solutions)
- **Slug Solusi Terkait** — `housing` / `developer` / `property` / `organization`

Tampil di halaman project sebagai blok "Problem / Solusi / Fitur / Hasil" + blok
"Layanan & Solusi Terkait" + "Portfolio Terkait" (otomatis by kategori).

---

## 3. Leads / Form Kontak

Lead dari form kontak & booth tersimpan di **option `akdisi_leads`** (bukan tabel
custom — MVP). Cara lihat:

```bash
docker exec -u www-data ddev-akdisi-web wp --path=/var/www/html/wordpress \
  eval '$l = get_option("akdisi_leads", []); foreach ($l as $i => $row) { echo "#$i "; print_r($row); }'
```

Field lead: `name, organization, position, whatsapp, email, org_type, need,
description, campaign, date`.

Dashboard widget **"AKDISI Leads"** menampilkan 5 lead terbaru di beranda admin.

---

## 4. Pengaturan Penting (Customize)

- **akdisi_whatsapp** — nomor WA format internasional tanpa `+` (cth `628123456789`)
- **akdisi_wa_message** — pesan default WhatsApp CTA
- **akdisi_email** / **akdisi_address** / **akdisi_description**
- **akdisi_meta_description** — meta description situs (SEO)
- **akdisi_ga4_id** — Measurement ID GA4 (mis. `G-XXXXXXXXXX`). **Kosongkan
  selama belum ada ID** — snippet GA4 baru dirender saat ID terisi.

---

## 5. Halaman & Template

| Slug | Template | Catatan |
|------|----------|---------|
| `/` (Home, ID 6) | front-page.php | Hero, Problem, Approach, Solution, Service, Portfolio, Why, Process, FAQ, CTA |
| `/services/` + child | template-services.php / template-service.php | 4 layanan |
| `/solutions/` + child | template-solutions.php / template-solution.php | 4 solusi |
| `/about/` | template-about.php | |
| `/faq/` | template-faq.php | |
| `/contact/` | template-contact.php | Form lead (inline errors) |
| `/booth/` | template-booth.php | Landing khusus event; hidden header, seksi Problem + UTM |
| `/portfolio/` `/insight/` | archive.php | Archive CPT (halaman statis sudah dihapus) |

---

## 6. Tips Operasional

- Halaman **Portfolio/Insight statis TIDAK ada** — gunakan menu ke archive CPT,
  jangan buat page slug `portfolio`/`insight` baru (konflik rewrite).
- Insight memakai taxonomy **`category`** standar (5 pillars), bukan taxonomy custom.
- Privacy policy ter-link dari footer (wajib tetap ada).
- Robots.txt & sitemap: file fisik di docroot `wordpress/robots.txt`; sitemap
  `https://<site>/wp-sitemap.xml` (native WP).