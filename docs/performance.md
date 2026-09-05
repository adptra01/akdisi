# AKDISI Website — Performance & QA Report

**Tanggal eksekusi:** 2026-09-05 · **Versi:** v1.3.0 (Modern Digital Enterprise redesign)
**Tool:** Playwright (Chromium) + PerformanceObserver (CWV) · DDEV localhost
**Catatan:** Kualitas DDEV lokal — angka prod bisa berbeda (network/hosting), namun
tren kualitas sama.

---

## 1. Core Web Vitals (homepage, emulasi mobile 390×844)

| Metric | Nilai | Target |
|--------|-------|--------|
| First Contentful Paint (FCP) | 0.42 s | < 1.8 s |
| Largest Contentful Paint (LCP) | 0.42 s | < 2.5 s |
| Cumulative Layout Shift (CLS) | 0.000 | < 0.1 |
| Total resource home (transfer) | ~63 KB | — |

LCP = teks hero (mockup CSS, tanpa gambar hero). GSAP + ScrollTrigger hanya
memutar `transform`/`opacity` → tanpa hitungan CLS, dengan `prefers-reduced-motion`
kill-switch. Audit Lighthouse penuh menyusul pasca-deploy prod.

### Baseline v1.2.0 (Lighthouse, sebelum redesign)

| Halaman | Performance | Accessibility | Best Practices | SEO |
|---------|-------------|---------------|----------------|-----|
| `/` (Homepage) | 93 | 100 | 100 | 100 |
| `/portfolio/kawasanhub/` | 91 | 100 | 100 | 100 |
| `/booth/` | 92 | 100 | 100 | 100 |

---

## 2. Volume Aset (v1.3.0)

| Aset | Ukuran |
|------|--------|
| HTML `/` (+ inline OG/schema) | ~37 KB |
| `style.css` | ~32 KB (single file, token-driven) |
| `main.js` (deferred) | ~8 KB |
| GSAP + ScrollTrigger (CDN jsdelivr, deferred) | ~70 KB (cacheable lintas situs) |
| Google Fonts (Plus Jakarta Sans + Instrument Serif) | eksternal, `display=swap` |

0 plugin, 1 stylesheet, 3 JS deferred — tanpa render-blocking JS, font
`display=swap`, tanpa gambar hero (mockup CSS). Portfolio images `loading=lazy`
(native).

---

## 3. Aksesibilitas (v1.3.0)

- **Palet baru** diverifikasi kontras: Ink `#101312`/warm-white `#F5F4EF`
  (rasio ~16:1), text-mut `#6B6F6A` on warm-white (~4.6:1), Akar Green `#789B87`
  ≈ 4.5:1 on ink (dipakai untuk teks aksen/eyebrow di section gelap).
- **Heading order** — 1× h1 per halaman; hero h1 split via `<span>` (DOM text
  tidak berubah → SEO aman); proses/step h3, tanpa skip level.
- **Motion** — semua animasi di-guard `(prefers-reduced-motion: reduce)`;
  konten `js-reveal` hanya disembunyikan ketika `html.js` (no-JS tampil normal);
  touchmenus off-canvas mengunci scroll body.
- Form: label + `required` + inline `field-error` + focus; touch target min 44px.
- Mobile sticky CTA tersembunyi di desktop, body padding kompensasi scroll.
- `prefers-reduced-motion` → layout statis (fallback grid, tidak ada pin).

---

## 4. QA Fungsional (Playwright, v1.3.0)

- [x] Semua URL utama 200: home, services/solutions (+child), portfolio
      archive+single, about, faq, contact, booth, privacy, 404 (404 status)
- [x] Design system terpasang (computed style): body `rgb(245,244,239)`, hero
      `rgb(16,19,18)` min-height 100dvh, h1 84px Plus Jakarta Sans, btn pill
      radius 999px, mockup radius 24px
- [x] Rhythm section D-L-D-L-D-L-D-L-D terverifikasi (9 section)
- [x] GSAP/ScrollTrigger loaded; intro clip-reveal hero; horizontal portfolio
      track bergeser sesuai scroll (x 0 → -546px, progress bar ikut);
      `pageerror` nol
- [x] Header: fixed transparan → blur saat scroll; `body.header-light` (text
      gelap) pada halaman dalam, dark pada home/booth/404
- [x] Contact form: submit kosong → 5 inline field errors + fokus ke field
      pertama
- [x] Booth: hidden campaign field + nonce form terverifikasi
- [x] Mobile 390px: menu off-canvas toggle + sticky CTA
- [x] Console: tanpa error nyata

---

## 5. Catatan Lanjutan

- GA4 events (cta_click, whatsapp_click, form_start, form_submit, *_view,
  booth_visit) tetap wired via `data-ga-track` — aktif begitu `akdisi_ga4_id`
  diisi di Customize.
- GSAP via CDN jsdelivr → gunakan `defer` (sudah); di prod pertimbangkan
  preconnect `https://cdn.jsdelivr.net` + `https://fonts.gstatic.com`.
- Perf prod: aktifkan cache server-side + static long-cache; re-run Lighthouse
  setelah deploy ke hosting untuk baseline prod.