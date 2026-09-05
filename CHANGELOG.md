# AKDISI Website — Changelog

Proyek: Website B2B Digital Marketing & Lead Generation untuk AKAR Digital Solusi (AKDISI)
Lingkungan: DDEV (`akdisi.ddev.site:8443`) · Wordpress 7.0.4 · PHP 8.4 · MariaDB 11.8
Spec otoritatif: `PRD AKDISI Website v5.0.md`

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
