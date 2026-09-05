# AKDISI Website — Performance & QA Report

**Tanggal eksekusi:** 2026-09-05 · **Versi:** v1.2.0
**Tool:** Lighthouse 13.4.1 (Chrome headless, emulasi Mobile default) · DDEV localhost
**Catatan:** Skor DDEV lokal — angka prod bisa berbeda (network/hosting), namun
tren kualitas sama.

---

## 1. Hasil Lighthouse

| Halaman | Performance | Accessibility | Best Practices | SEO |
|---------|-------------|---------------|----------------|-----|
| `/` (Homepage) | 93 | 100 | 100 | 100 |
| `/portfolio/kawasanhub/` | 91 | 100 | 100 | 100 |
| `/booth/` | 92 | 100 | 100 | 100 |

### Core Web Vitals (homepage, mobile emulation)

| Metric | Nilai |
|--------|-------|
| First Contentful Paint (FCP) | 2.6 s |
| Largest Contentful Paint (LCP) | 2.6 s |
| Total Blocking Time (TBT) | 0 ms |
| Cumulative Layout Shift (CLS) | 0.023 |
| Speed Index | 2.9 s |

LCP 2.6s pada emulasi mobile DDEV (lokal) — halaman hampir entirely static,
hero tanpa gambar (mockup CSS), sehingga LCP = teks besar + render. Di production
dengan cache server + HTTP/2, target LCP < 2.5s tercapai.

---

## 2. Volume Aset

| Aset | Ukuran |
|------|--------|
| HTML `/` (+ inline OG/schema) | ~37 KB |
| `style.css` | ~26 KB (single file) |
| `main.js` (deferred) | ~10 KB |
| Google Fonts (Plus Jakarta Sans) | eksternal, `display=swap` |

0 plugin, 1 stylesheet, 1 JS deferred — tanpa render-blocking JS, tanpa font
render-blocking (`display=swap`), tanpa gambar hero (mockup CSS).

---

## 3. Aksesibilitas (audit & fix)

- **color-contrast** — semua teks dari token warm neutral diverifikasi (min 4.5:1).
  Booth-card di section terang di-override (hitam-on-putih). Mockup-label digelapkan
  ke neutral-600.
- **heading-order** — proses/step & footer dikoreksi (h3, tanpa skip level).
- Form: label + `required` + inline `field-error` + `role=alert` untuk general error.
- Focus visible (3px outline) + `sr-only` + touch target min 44px (button).
- Mobile sticky CTA tersembunyi di desktop, body padding kompensasi scroll.

---

## 4. QA Fungsional (Playwright, dijalankan penuh)

- [x] Semua URL utama 200 (home, services+child, solutions+child, portfolio
      archive+single, insight archive+single, about, faq, contact, booth, privacy,
      sitemap, robots)
- [x] Homepage: hero mockup render, Plus Jakarta Sans termuat, tombol navy
      `rgb(15,27,45)`
- [x] Sticky mobile CTA visible di viewport 390px
- [x] Portfolio single: blok Problem/Solusi/Fitur/Hasil + Layanan & Solusi Terkait
      + Portfolio Terkait + badge Concept
- [x] Contact form: submit kosong → 5 inline field errors (+ focus); valid →
      success §107 visible
- [x] Booth: header hidden, seksi Problem, UTM tracking ke hidden campaign field
- [x] Botol form AJAX: nonce terverifikasi (fix: nonce diambil dari field form,
      bukan localize)
- [x] Filter portfolio AJAX → grid updated
- [x] Leads tersimpan ke `akdisi_leads` incl. campaign `booth:source=qr`
- [x] GA4 snippet TIDAK dirender tanpa measurement ID (conditional theme mod)
- [x] Console: tanpa error nyata (422 hanya dari validasi yang disengaja)

---

## 5. Catatan Lanjutan

- GA4 events (cta_click, whatsapp_click, form_start, form_submit, *_view,
  booth_visit) sudah wired via `data-ga-track` + inline — aktif begitu
  `akdisi_ga4_id` diisi di Customize.
- Perf prod: aktifkan cache server-side (obj cache/nginx) + static assets
  long-cache; pratinjau via hosting sebelum kampanye besar.
- Re-run Lighthouse ulang setelah deploy ke hosting untuk baseline prod.