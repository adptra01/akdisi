# AKDISI Website — Changelog

Proyek: Website B2B Digital Marketing & Lead Generation untuk AKAR Digital Solusi (AKDISI)
Lingkungan: DDEV (`akdisi.ddev.site:8443`) · Wordpress 7.0.4 · PHP 8.4 · MariaDB 11.8
Spec otoritatif: `PRD AKDISI Website v5.0.md`

---

## v1.3.1 — Inner Pages Redesign 2026-09-05

Semua halaman dalam di-upgrade ke language design v1.3.0 (Variance 8 editorial,
bukan hanya pasang class lama). Sumber inspirasi: shadcnblocks/21st.dev pattern
(contact split, CTA band, bento values) — diterjemahkan ke PHP + CSS theme,
tanpa dependency baru.

### Komponen shared baru
- `template-parts/cta-band.php` — CTA dark rounded reusable (glow radial + grain +
  magnetic button) untuk semua halaman dalam; dipakai di archive, single, services,
  service, solutions, solution, about, faq.
- CSS `19B. Inner Page Components`: `.portfolio-filters` (pill filter bar),
  `.folio-grid` (asymmetric 6-col: item pertama full-width, sisanya pasangan),
  `.cta-band`, `.stat-grid`/`.stat-num`, `.split-grid` (5fr/7fr), `.facts-bar`
  (dl 4-col), `.article-meta`, `.tag-pills`, `.feature-list` (✓ grid 2-col),
  `.contact-form-shell` (form card), `.kv-row`.

### Template rewrite (11 file)
- **archive.php** — portfolio: filter bar + folio-grid asymmetric (first item
  full-bleed `span2`, sisanya pairs); insight: editorial post-list; FAQ fallback.
- **single.php** — portfolio detail: page-hero + facts-bar (type/konteks/status/
  tahun), thumb rounded, meta blocks, `feature-list`, gallery, related
  service/solution + related portfolio, CTA band. Insight: editorial article +
  tag-pills + insight terkait + CTA band.
- **template-services.php** — dark **bento** 4 layanan (wide/narrow) + CTA band.
- **template-service.php** — breadcrumb + content + related solutions (editorial
  rows) + related portfolio cards + FAQ + CTA band.
- **template-solutions.php** — editorial `solution-list` rows (index serif,
  hover accent) + CTA band.
- **template-solution.php** — breadcrumb + content + solusi lainnya rows + CTA band.
- **template-about.php** — split story + **stat-grid angka nyata** (portofolio/
  insight/layanan dari DB, bukan fabricated) + dark bento values + process-steps
  + kv info + CTA band.
- **template-contact.php** — **split 5fr/7fr**: info & WhatsApp (kiri) + form
  card (kanan); field/form/nonce/campaign tetap; submit magnetic.
- **template-faq.php** — header + accordion + CTA band.
- **index.php** — fallback/search: editorial list + empty state, tidak lagi
  menduplikasi hero homepage.

### Fix & QA
- **Fix AJAX filter portfolio**: render handler disamakan ke komponen `.folio-item`
  baru (sebelumnya markup lama → grid kosong); `akdisiData.loading` missing →
  "Memuat..." ditambahkan.
- Playwright: 22 URL OK; filter alive (administrasi → 1 item, reset → 8); geometri
  grid terverifikasi (folio 1320/648, split 523/733 ± 5fr/7fr, stats 4-col,
  bento 6-col); mobile 390px single-col tanpa h-scroll; `pageerror` 0.
- PHP lint bersih seluruh theme.

---

## v1.3.0 — Modern Digital Enterprise Redesign 2026-09-05

Overhaul visual penuh menurut arah desain user (Modern Digital Enterprise):
Variance 8 (editorial/asymmetric) · Motion 6 (GSAP ScrollTrigger) · Density 4.
Keputusan: custom CSS + token (bukan Tailwind), homepage-first, palette baru
menghapus navy v1.2.0.

### Design system baru
- **Palet**: Ink `#101312` / Graphite `#171c1a` (dark surface), Warm White `#F5F4EF`
  / Surface `#EAE9E3` (light), Akar Green `#789B87` / Forest `#3D5C4A` (brand,
  brand AKAR → growth), Lime Soft `#B7D36B` (aksen tipis). Semua CSS v1.2.0
  di-map ulang ke token — komponen lama (card, btn, form, bofta, FAQ) tetap
  kompatibel (`section-alt` alias).
- **Typography**: Plus Jakarta Sans + **Instrument Serif** (italic display accent);
  h1 hero fluid `clamp(2.6rem, 6vw, 5.25rem)`; `.serif` untuk kata/angka aksen.
- **Shape**: pill buttons (radius 999px, min-height 48px), card 16–24px,
  container 1320px, nav 84→68px saat scroll (blur backdrop).

### Homepage showcase (front-page.php rewrite)
- Rhythm dark/light **D-L-D-L-D-L-D-L-D**: hero dark → problem/approach light →
  services dark (bento 4) → solutions light (editorial rows asymmetric) →
  why dark (value grid 5) → portfolio light (horizontal) → process dark
  (pinned) → FAQ light → CTA dark.
- Hero split: kiri teks editorial (h1 2 baris clip-reveal, eyebrow, 2 CTA
  magnetic) + kanan mockup dark glass (parallax; PRD §79 tetap, bukan stock image).
- Bento services dengan nomor serif; solution rows index serif + hover accent;
  portfolio **horizontal scroll** desktop (ScrollTrigger pin + progress bar,
  fallback scroll-snap mobile); process **pinned storytelling** (step highlight,
  desktop; fallback list statis); CTA besar dengan serif italic.
- Semua copy PRD dipertahankan kata demi kata (hanya layout berubah); h1 DOM text
  tidak berubah (sedikit pengganti class).

### Motion (GSAP + ScrollTrigger, CDN jsdelivr 3.12.5)
- Enqueue GSAP + ScrollTrigger via `functions.php` (deferred, dependency main.js).
- Signatures: hero clip-reveal stagger (`power3.out`), parallax subtle (`data-parallax`),
  stagger reveal grids (`.js-stagger`), horizontal portfolio (pin+scrub, desktop
  only), process active-step, **magnetic buttons** (fine pointer only, `gsap.quickTo`).
- Hanya `transform`/`opacity` — tanpa CLS. `prefers-reduced-motion` kill-switch;
  no-JS visible (`html.no-js` swap di header, reveal hanya jika `html.js`).

### Halaman dalam & template lain
- `.page-hero` light baru (surface + border) menggantikan `.hero` kecil di
  archive, single, services, solutions, about, faq, contact (12 patchnote).
- Header adaptif: `body.header-light` (teks gelap) pada halaman dalam — home,
  booth, 404 pakai header terang-on-dark. Logo default "AKDISI." dengan dot hijau.
- 404: dark editorial 4**0**4 serif + grid backdrop + CTA magnetic + GA track.
- FAQ accordion, form, entry-content, breadcrumb, related-cards, pagination —
  semuanya re-token; screenshot theme diganti (1200×900 homepage baru).

### QA v1.3.0
- Playwright: 10 URL OK (200; 404 → 404), design token terverifikasi via computed
  style, rhythm 9 section terkonfirmasi, horizontal track bergeser -546px + progress,
  form 5 inline errors + focus, booth campaign+nonce, mobile menu, `pageerror` nol.
- **CWV mobile (PerformanceObserver)**: FCP 0.42s · LCP 0.42s · CLS 0.000 · ~63 KB
  resource (Lighthouse penuh menyusul pasca-prod).
- Docs: `docs/performance.md` ditulis ulang untuk v1.3.0.

---

## v1.2.0 — Design System + Portfolio Detail + Analytics + Booth/Form 2026-09-05

Menutup PRD §47/§76-83/§86/§90-92/§96-107/§114. Keputusan user: align warna PRD §76,
GA4 menunggu Measurement ID, portfolio naik ke field set terstruktur.

### Design system (PRD §76-83)
- **Palet baru**: deep navy (`#0f1b2d`/`#182a45`), muted green accent (`#2f7d62`/`#256450`),
  warm neutrals (`#f7f4ef`, `#3d372f` text, `#e5dfd4` border) — blue lama dihapus,
  seluruh komponen di-map via CSS token.
- **Plus Jakarta Sans** enqueue (fallback Inter); `display=swap`.
- **Sticky mobile CTA** bar (WhatsApp, hidden ≥768px, data-ga-track).
- **Hero mockup** CSS (bukan stock image, PRD §79) di homepage.
- `.entry-content` styling (h2/h3/h4, ul/ol, blockquote) — konten layanan/solusi/insight kini branded.
- Aksesibilitas: heading-order dikoreksi, kontras booth-card di section terang, mockup-label digelapkan.

### Portfolio field set (PRD §47/§86)
- `register_post_meta` untuk Problem/Solution/Features/Outcome/Related Service/
  Related Solution/Gallery (`show_in_rest` + schema array) + metabox admin
  "Detail Proyek" (nonce + capability check).
- `single.php` rewrite: blok Problem→Solusi→Fitur→Hasil, galeri, blok Layanan &
  Solusi Terkait, Portfolio Terkait (by category), CTA.
- Isi data detail untuk 8 project (KawasanHub s/d PropertiCare) incl. related
  service/solution + 4 features per project.

### Internal linking (PRD §90)
- Insight single: Insight Terkait by category + CTA.
- Service single: Solusi (4) & Portfolio Terkait (by meta related_service).
- Solution single: Solusi Lainnya + Layanan & Portfolio Terkait (by slug).

### Analytics (PRD §91-92)
- GA4 snippet conditional — hanya dirender jika theme mod `akdisi_ga4_id` terisi.
- main.js events: `cta_click`, `whatsapp_click`, `form_start`, `form_submit`,
  `{type}_view` (portfolio/insight/service/solution/faq), `booth_visit`.
- `akdisiPageView` global di footer (berdasar template/post type).

### Booth (PRD §66-70)
- Seksi Problem eksplisit (4 pain points) di urutan §68.
- UTM tracking → hidden `campaign` (`booth:source=...,medium=...`), tersimpan ke lead.
- WhatsApp message booth per §66 (default).

### Form (PRD §106-107)
- Error **per-field inline** (bukan `alert()`); focus field pertama bermasalah.
- Success message persis §107 di contact & booth.
- Fix nonce: JS memakai nonce field form (`_wpnonce`) — sebelumnya salah action
  (akdisi_nonce vs akdisi_contact_nonce) → 403.
- Fix handler: validasi org_type/need/email yang sebelumnya keliru mapping.

### SEO teknis (PRD §114)
- `wordpress/robots.txt` fisik (Allow / + Disallow admin + Sitemap link) —
  nginx/InfinityFree tak serve virtual robots.
- Favicon: `favicon.svg` + `favicon.png` (rsvg), upload media (ID 61), `site_icon` set.
- Meta description booth (excerpt field) — SEO 100 di semua halaman audit.

### 404 (PRD §105)
- Tombol "Kembali ke Beranda" + **"Hubungi AKDISI"** → /contact/.

### Positioning: jasa aplikasi umum (user request)
- Tagline/hero/meta-desc/footer/OG digeneralisasi — "Jasa Pembuatan Aplikasi &
  Solusi Digital untuk Bisnis Anda" (sektor properti/perumahan/organisasi jadi
  konteks, bukan satu-satunya fokus).
- `/solutions/` + section solusi home di-reframe "Berdasarkan Sektor/Kebutuhan"
  dengan copy non-sektoral; booth/archive/services copy disesuaikan.

### Docs & Perf
- `docs/admin.md`, `docs/hosting-deploy.md` (InfinityFree migration + backup), `docs/plugins.md` (0 plugin rationale), `docs/performance.md`.
- **Lighthouse:** Home 93/100/100/100 · Portfolio 91/100/100/100 · Booth 92/100/100/100 (Perf/A11y/BP/SEO).

---

## v1.1.0 — Aleksej 2026-09-05

Implementasi major terhadap PRD v5. Menutup gap sitemap, konten, dan arsitektur.

### Fix arsitektur
- **Insight CPT** — daftar `taxonomy 'category'` (fix `wp post term set ... category` → "Invalid taxonomy category"), kini artikel bisa dikategorikan.
- **Konflik rewrite Portfolio/Insight** — page statis slug `portfolio` (9) & `insight` (10) dihapus karena ter-shadow oleh archive CPT (`/portfolio/`, `/insight/`). `page_for_posts` → 0. Menu didorong ke archive URL.

### Konten baru
- **Homepage** — dibuat `front-page.php` penuh sesuai PRD §18–28 (Hero, Problem §20, Approach §21, Solution §22, Service §23, Portfolio §24, Why AKDISI §25, Process §26, FAQ §27, CTA §28). Sebelumnya homepage kosong (default page.php).
- **Insight** — 6 artikel (5 initial PRD §51 + 1 existing). Kategori = 5 content pillars §50 (Digitalisasi Perumahan, Digitalisasi Developer, Property Management, Business Process, Application Strategy).
- **Solutions** (BAGIAN H) — `/solutions/` + 4 sub-halaman Housing/Developer/Property/Organization (`template-solutions.php`, `template-solution.php`).
- **Services detail** (§37) — 4 child pages di bawah `/services/` (`template-service.php`): application-development, business-process-digitalization, data-administration-systems, custom-business-solutions. `template-services.php` ditulis ulang jadi grid link ke child pages.
- **Privacy Policy** — page `/privacy-policy/` + link footer (PRD §17).

### Navigasi & SEO
- **Main menu** — reorder per PRD §16 (Home, Layanan, Solusi, Portfolio, Insight, Tentang, FAQ, Kontak); Portfolio/Insight/Solusi jadi custom link.
- **Footer menu** — menu "Footer Menu" (Layanan, Solusi, Portfolio, Insight, Tentang, Kontak) di lokasi `footer`.
- **SEO** (§52–57) — meta description (theme mod `akdisi_meta_description` + fallback), Open Graph tags, title tag + tagline lokal Jambi.

### Files berubah (theme `akdisi/`)
- `functions.php` — insight taxonomy, SEO (meta desc + OG).
- `front-page.php` (baru), `template-solutions.php` (baru), `template-solution.php` (baru), `template-service.php` (baru).
- `template-services.php` (rewrite), `template-contact.php` (wp_unslash campaign), `footer.php` (privacy link).

---

## v1.0.0 — Initial build

- Setup DDEV (Wordpress, docroot `wordpress`, PHP 8.4, MariaDB 11.8, tz Asia/Jakarta).
- WP install + permalink `/%postname%/`.
- Theme custom `akdisi` (style.css, functions.php, header/footer/index/page/single/archive/404 + template-*).
- CPT: `akdisi_portfolio`, `akdisi_insight`, `akdisi_faq`; taxonomy `portfolio_category`.
- Konten: 8 concept portfolio, 7 FAQ, 1 insight; pages Home/About/Layanan/Portfolio/Insight/FAQ/Kontak/Booth.
- Form lead gen (AJAX, nonce, simpan ke option), WhatsApp float, security hardening, schema.org org.
