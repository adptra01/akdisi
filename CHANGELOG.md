# AKDISI Website — Changelog

Proyek: Website B2B Digital Marketing & Lead Generation untuk AKAR Digital Solusi (AKDISI)
Lingkungan: DDEV (`akdisi.ddev.site:8443`) · Wordpress 7.0.4 · PHP 8.4 · MariaDB 11.8
Spec otoritatif: `PRD AKDISI Website v5.0.md`

---

## v2.0.1 — Liquid Glass v2 + Visual QA 2026-09-06

Adaptasi pola "liquid glass card" komunitas 21st.dev — diimplementasi ulang
native dalam token AKDISI (tanpa dependensi, tanpa copy-paste kode).

### Liquid Glass v2 (`style.css` §16)
- **Specular highlight**: gradient cahaya sudut kiri-atas di semua permukaan
  kaca (card, bento, proof, hero mockup, form shell) — light/dark aware.
- **Sheen sweep on hover**: pita cahaya diagonal menyapu permukaan saat hover
  (`transform` only, 0.9s expo; disabled di `prefers-reduced-motion`).
- Digabung dengan spotlight cursor glow (`--mx`/`--my`) yang sudah ada —
  depth berlapis: specular + spotlight + sheen.

### Visual QA (Playwright Chromium, DDEV)
- 7 URL desktop + 3 mobile: semua 200, `pageerror` 0, mobile h-overflow 0px.
- Token terverifikasi: spark `#10b981`, void `#05080c`, Satoshi 80px H1
  left-aligned, marquee + 4 bento + 3 hero-lines present.
- Anti-slop audit: no Inter, no pure-black bg, no pill buttons, hero `start`,
  grids 5/2/4-col (never 3-equal), glass `blur(20px)`, no purple
  (match hanya WP core preset, inert).
- Hover bento: sheen mid-sweep + spotlight opacity 1 terkonfirmasi via
  computed style, tanpa JS error.

---
## v2.0.0 — Editorial Asymmetric Redesign (Awwwards/Dribbble Grade) 2026-09-06

Redesign total karena tema v1.x terasa "AI slop". Arah baru: Editorial Asymmetric +
Liquid Glass + Kinetic Typography — distinctive, premium, restrained. Single accent
emerald dipertahankan (brand continuity), Inter dihapus total.

### Design system v2 (`docs/implementation/00-design-system-v2.md`)
- **Fonts**: Satoshi (display, Fontshare) + Outfit (body) + Space Grotesk (accent) +
  JetBrains Mono (mono). Plus Jakarta Sans + Inter dihapus.
- **Palet**: Deep space `#05080c`/`#0a0f1a`/`#111827` (no pure black), paper `#fafafa`,
  single emerald `#10b981`/`#34d399`. Ghost borders, tonal shadows, glow emerald.
- **Layout**: asymmetric — golden-ratio split, editorial 3-col, bento 5-col
  (wide 3 / narrow 2, never 3-equal), solution rows zig-zag indent, proof 1.25fr/1fr.
- **Material**: liquid glass — backdrop-blur + inner refraction border + inner highlight
  + spotlight cursor glow (`--mx`/`--my`).
- **Motion**: transform/opacity only, spring easing, stagger, ScrollTrigger storytelling,
  magnetic buttons (fine pointer), marquee kinetic strip (pause on hover),
  prefers-reduced-motion kill-switch.

### style.css rewrite (v1 1490+ baris → v2 685 baris, lean)
- Tokens v2 + legacy aliases (`--bg-deep`, `--primary`, dll.) agar template lama tetap jalan.
- Hero v2: asymmetric split (konten kiri / mockup kanan), kinetic 3-baris headline,
  hero-meta stats organik, marquee strip.
- Section rhythm: header-split (judul kiri / note kanan), CTA split (bukan centered).
- Komponen: btn-glass, bento 5-col, proof asymmetric, value 4-col asymmetric,
  folio 5-col asymmetric, spotlight hover.
- Anti-slop: no centered hero, no 3-col equal cards, no Inter, no pure black,
  no oversaturated accent, no generic copy.

### front-page.php rewrite (v2.0.0)
- Copy PRD dipertahankan kata-per-kata (hanya layout berubah).
- Hero 3-baris (Custom Application / Development / Partner.) + meta stats.
- Marquee kinetic strip (4 layanan, loop).
- Problem: golden-ratio editorial (judul kiri / lead+flow kanan).
- Services/solutions/proof/why/process/FAQ/CTA: asymmetric splits.
- CTA: split layout (teks kiri / tombol kanan), bukan centered.

### functions.php
- Fonts v2 enqueue (Fontshare Satoshi + Google Outfit/Space Grotesk/JetBrains Mono).
- main.js version bump 2.0.0. GSAP CDN tetap (3.12.5).

### main.js v2.0.0
- Existing dipertahankan: header scroll, mobile menu, FAQ accordion, GSAP hero
  clip-reveal, [data-reveal], .js-stagger, parallax, horizontal portfolio pin,
  process pin, magnetic buttons, AJAX portfolio filter, contact form inline errors,
  GA4 tracking.
- Baru: marquee pause-on-hover, spotlight cursor glow (`--mx`/`--my`) untuk
  bento/proof/card (fine pointer only, transform/opacity only).
- `node --check` clean.

### QA
- JS syntax OK (`node --check`).
- Backup pre-redesign: `.backup-v1.5.0-20260906/` (style.css, front-page.php, functions.php, main.js).
- PHP lint menyusul via DDEV (php tidak tersedia di host).

---

## v1.5.0 — Portfolio & Insight Detail Templates 2026-09-06

Lengkapi arsitektur konten dengan template detail untuk Portfolio dan Insight,
sesuai spesifikasi PRD §47, §86, §89 dan implementation docs (05-wordpress-technical-spec.md).

### New Templates

#### `single-portfolio.php` — Portfolio Detail Page
- **Hero**: breadcrumb + status badge (CONCEPT/DEMO/ACTUAL) + konteks + headline
- **Problem & Solution**: dual-column layout side-by-side
- **Key Features**: grid dengan ikon checkmark
- **Gallery**: auto-grid responsive screenshots
- **Expected Outcome**: centered callout
- **Related Service**: link ke halaman layanan terkait
- **Related Portfolio**: 3 project serupa by category
- **CTA Band**: reusable dark rounded dengan glow emerald

#### `single-insight.php` — Insight/Article Detail
- **Hero**: breadcrumb + kategori + tanggal + headline + excerpt
- **Article**: editorial content dengan entry-content styling
- **Related Insights**: 3 artikel terbaru terkait
- **CTA Band**: reusable dark rounded

### Implementation Notes
- Semua template mengikuti design system v1.4.0 (Precision Engineering)
- Data-driven: memakai meta fields dari metabox admin (portfolio) / standard WP fields (insight)
- Reusable components: `template-parts/cta-band.php`, breadcrumb, eyebrow, magnetic buttons
- GA4 tracking via `data-ga-track` pada semua CTA
- GSAP ScrollTrigger reveal animations via `[data-reveal]` dan `.js-stagger`

### Technical
- PHP lint clean (single-portfolio.php, single-insight.php)
- WordPress coding standards: escaping, sanitization, nonce, capability checks
- Responsive: mobile-first grid, min-h-[100dvh] hero
- Accessibility: semantic HTML, aria labels, focus states, prefers-reduced-motion respected

---

## v1.4.0 — Precision Engineering & Architecture Redesign 2026-09-06

Overhaul visual penuh ke "Precision Engineering & Architecture" — Corporate
High-Tech Minimalist + Developer Console Utility. Palet, tipografi, shape,
elevation, dan konten homepage dirombak total.

### Design system baru
- **Palet**: Deep charcoal `#0a0d12`/`#0d1117` (dark), titanium light `#f8f9fa`/
  `#eceef0` (light). Brand emerald `#10b981`/`#34d399` (bukan sage lama).
- **Typography**: Plus Jakarta Sans (display/headlines) + **Inter** (body) +
  **JetBrains Mono** (metadata/telemetry/eyebrows). Instrument Serif dihapus.
- **Shape**: low-radius — card 8px, button 6px, pill hanya untuk status indicators.
  Bukan pill buttons lagi.
- **Elevation**: tonal layering + ghost borders (`rgba(240,246,252,0.1)`), bukan
  drop shadows. Active glow `rgba(16,185,129,0.15)`.
- **Eyebrow**: monospace uppercase (`JetBrains Mono 11px 0.08em`) dengan line prefix.

### Homepage rewrite (front-page.php)
- Hero: "Custom Application Development Partner" — positioning tajam, bukan
  "Jasa Pembuatan Aplikasi" generik.
- Transformation Flow: visual 3-step (Proses Manual → Analisis & Perancangan →
  Sistem Terstruktur) dengan icons SVG, menggantikan Approach 6-step lama.
- Market Proof section: 3 highlight portfolio (KawasanHub, PropertiCare,
  ProjectMonitor) di dark section — bukti implementasi nyata.
- Process: 4 step (Consultation → Deployment & Support), bukan 6.
- CTA: "Siap Memindahkan Proses Manual ke Sistem Digital?"
- Solutions: dipertahankan (editorial rows).
- Value props: 4 item (bukan 5) — light cards di light section.

### Component changes
- `.bento-card .bento-num` → `font-weight: 300` (light numeral, bukan serif).
- `.proc-step-num` → `font-weight: 300` (light numeral).
- `.stat-num` → `font-weight: 300` + emerald color.
- `.portfolio-filter-btn` → monospace, low-radius (bukan pill).
- `.cta-band` → emerald radial glow (bukan sage).
- `.hero-mockup .mockup-stat` → monospace font.
- `.hero-mockup .mockup-label` → monospace uppercase.
- `.card-category` → monospace, low-radius (bukan pill).
- New: `.transform-flow`, `.transform-step`, `.transform-node`, `.transform-icon`,
  `.transform-label`, `.transform-arrow` (transformation flow).
- New: `.proof-grid`, `.proof-card` (market proof portfolio highlights).

### Typography migration
- `--font-sans` → `--font-display` (Plus Jakarta Sans) + `--font-body` (Inter).
- `--font-serif` → removed (Instrument Serif dropped).
- Added: `--font-mono` (JetBrains Mono) for metadata/telemetry.
- All `.eyebrow` → `font-family: var(--font-mono)`.
- All `.stat-label`, `.post-card-meta`, `.breadcrumb`, `.footer-heading` → mono.

### Footer + Schema
- Footer description: "Custom application development partner..."
- Schema.org description updated.

### QA
- PHP lint clean (front-page.php, functions.php).
- Playwright: homepage, services, portfolio, about, 404 — all OK (10 screenshots).
- Design tokens verified: emerald `#10b981`, charcoal `#0d1117`, monospace eyebrows,
  low-radius shapes, ghost borders.

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
  full-bleed `span2`, sisanya pasangan); insight: editorial post-list; FAQ fallback.
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

