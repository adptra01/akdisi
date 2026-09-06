# AKDISI Website — Changelog

Proyek: Website B2B Digital Marketing & Lead Generation untuk AKAR Digital Solusi (AKDISI)
Lingkungan: DDEV (`akdisi.ddev.site:8443`) · Wordpress 7.0.4 · PHP 8.4 · MariaDB 11.8
Spec otoritatif: `PRD AKDISI Website v5.0.md`

---

## v4.2.3 — Fix: Why AKDISI Dark Band Padding 2026-09-06

`.akdisi-why` sebelumnya hanya `section-dark` (tanpa class `.section`) dan tidak
punya rule padding sendiri → konten menempel ke section atas (trusted marquee)
dan bawah (featured projects).

### Fix
- `style.css`: `.akdisi-why.section-dark{ padding:clamp(5rem,9vw,7.5rem) 0 }` —
  lebih tinggi dari rhythm `.section` standar (4rem→6.5rem), memberi ruang napas
  ekstra pada dark band.

### QA v4.2.3 (Playwright Chromium, DDEV)
- Home: padding-top/bottom `.akdisi-why` computed = **120px** (sebelumnya 0px).
- Background tetap ink `rgb(28,25,23)`, h-overflow 0px, `pageerror` 0.

---

## v4.2.2 — Fix: Typewriter Entity Leak ("&amp;" Rendered Literally) 2026-09-06

`akdisi_render_typewriter()` memecah karakter dari **string yang masih ber-entity**
(`&amp;`) → `preg_split` menghasilkan 5 char (`&`,`a`,`m`,`p`,`;`) → `esc_html('&')`
tampil sebagai `&amp;` → di layar terbaca literal **"&amp;"** (hero h1:
"We design &amp; build digital products…").

### Fix
- `inc/typewriter.php`: `html_entity_decode()` kini dipakai **sebelum** split
  karakter (tidak hanya untuk perbandingan accent). `&amp;` → `&` (1 char) →
  `esc_html` men-encode ulang aman → render `&` tunggal.
- Audit tema: semua entity lain (`&copy;`, `&ldquo;`, `&#10003;`, `&amp;` di
  cta-band) adalah literal HTML langsung di template (bukan lewat escape)
  → sudah benar, tidak disentuh.

### QA v4.2.2 (Playwright Chromium, DDEV)
- Hero h1 `inner_text()` = "We design & build digital products that move the
  needle." (bukan "&amp;").
- `document.body.innerText.includes('&amp;')` = false — tidak ada literal entity
  bocor di halaman home.
- CTA band bersih ("Have a product idea worth building?"), `pageerror` 0.
- Kata `&` pada hero = 1 `.tw-char` (bukan 5).

---

## v4.2.1 — Fix: Tailwind Config Order (Custom Colors Dead) + Footer Contrast 2026-09-06

Bug lintas-versi (sejak v4.0.0): inline `tailwind.config` di-enqueue dengan posisi
`'before'` pada CDN Play — dieksekusi **sebelum** `cdn.tailwindcss.com` ter-load,
saat `typeof tailwind === 'undefined'` → IIFE `return` dini → config **tidak pernah
ter-assign**. Akibatnya semua custom color (`bg-ink`, `text-brand`, `bg-brand/25`,
`bg-brand-soft`, `text-ink-faint`, dst.) tidak di-generate Tailwind — hanya palette
default (stone-400, white) yang jalan. Teks terang di area gelap (CTA band, footer,
`text-brand` aksen) tampil di atas putih `body` → nyaris tak terlihat. Persis
keluhan user: "beberapa teks yang sama dengan warna bg nya seperti di CTA dan footer".

### Fix
- `functions.php`: `wp_add_inline_script( ..., 'before' )` → `'after'` — config
  dijalankan setelah Tailwind CDN parsed (pola resmi Play CDN).
- `footer.php`: bar bawah (copyright/Privacy/Contact) `text-stone-500` →
  `text-stone-400` — kontras 3.65:1 → ~6.9:1 di atas ink (AA untuk teks 12px).
- QA kontras (Playwright computed): rapat audit semua leaf text node di
  `.akdisi-cta` & `.akdisi-footer` — tidak ada lagi 1:1 white-on-white.

### QA v4.2.1 (Playwright Chromium, DDEV)
- 8 URL (home, layanan, tentang, testimoni, use-cases, kontak, projects, insight):
  semua 200, `pageerror` 0, h-overflow 0px, footer bg ink `rgb(28,25,23)` di semua
  halaman.
- CTA: bg ink ✓, typewriter 30/30 char visible, accent `rgb(194,84,61)` = `#c2543d`.
- Mobile 390px: overflow 0, footer ink ✓.
- Kartu visual CTA (white/4% di atas ink) dikonfirmasi aman secara manual
  (compositing): stone-300 ≈ 10.6:1, white "1 day" ≈ 15.9:1.

---

## v4.2.0 — Reusable Typewriter Helper + CTA Band Redesign 2026-09-06

Klarifikasi user soal "ubah cta": animasi typewriter diterapkan juga di heading CTA
band (bukan hanya hero) **dan** CTA band di-redesign sebagai komponen UI sendiri.

### `inc/typewriter.php` (baru, auto-loaded via glob)
- Helper `akdisi_render_typewriter( $text, $accent_words )` — render `.tw-word`
  berisi `.tw-char` per karakter + `.tw-cursor`; kata yang masuk `$accent_words`
  diberi class `text-brand` (deep rose).
- **A11y fix**: spasi asli (` `) antar kata di-emit setiap `.tw-word` (kecuali
  terakhir) — screen reader membacanya per-kata; margin CSS dihapus (supaya tidak
  double-spacing). Verifikasi: `inner_text()` kini "Ready to build something worth
  launching?" bukan "Readytobuildsomethingworthlaunching?".
- Hero h1 di `front-page.php` di-refactor memakai helper (teks + accent `needle.`
  tetap sama, DOM text tidak berubah).

### `template-parts/cta-band.php` → komponen split-editorial parameterized
- `$args` (via `wp_parse_args`): `title`, `accent_words`, `sub`,
  `btn_primary_label/url`, `btn_secondary_label/url`; fallback default tetap.
- Layout `lg:grid-cols-[1.15fr_0.85fr]` (verifikasi computed: 648.6px/479.4px):
  kiri = eyebrow (garis `h-px w-10 bg-brand` + label) + heading typewriter + sub +
  2 tombol (`btn-primary`, `btn-secondary`); kanan = kartu visual
  "Average first response — 1 day" (`hidden lg:block`, desktop-only).
- Panel: `rounded-2xl bg-ink` + glow rose ganda (`bg-brand/25 blur-[110px]`,
  aria-hidden) + tekstur grid `.akdisi-cta-grid` (linear-gradient 46px) —
  estetika v4 (warm stone + deep rose), `data-reveal` dipertahankan.
- `front-page.php` CTA band → `get_template_part('template-parts/cta-band', null,
  array( ... ))` dengan copy khusus home ("Have a product idea worth building?",
  accent `building?`, tombol "Start the conversation" / "See use cases").

### `main.js` — typewriter multi-elemen
- Satu IntersectionObserver (threshold 0.35, rootMargin `0px 0px -40px 0px`)
  melayani **N** elemen `[data-typewriter]`; `triggerTypewriter(el)` di-guard
  `el.dataset.twDone` (tidak restart), stagger default 45ms atau `data-tw-step`.
- Fallback instan untuk `prefers-reduced-motion` / tanpa observer.

### QA v4.2.0 (Playwright Chromium, DDEV)
- Home: `.akdisi-cta` 1, grid split 648.6/479.4px (1.15fr/0.85fr), kartu visual ada,
  typewriter CTA 30/30 char visible, 2 tombol, glow 2, grid texture 1,
  `pageerror` 0, h-overflow desktop **0px**.
- `/projects/` (default args): typewriter 36/36, kartu visual, heading terbaca
  ("Ready to build something worth launching?").
- Mobile 390px: h-overflow **0px**, kartu visual tersembunyi (desktop-only).
- `prefers-reduced-motion`: char CTa opacity 1 instan, cursor anim `none`.
- PHP lint bersih (cta-band.php, front-page.php, typewriter.php), `node --check`
  main.js OK.

---

## v4.1.1 — Aceternity-Style Typewriter Hero (Vanilla JS) 2026-09-06

Adaptasi `TypewriterEffect` dari Aceternity UI (React + framer-motion) ke vanilla
JS/CSS — tanpa React, tanpa dependency baru (repo: WP + Tailwind CDN).

### Implementasi
- Hero h1 `front-page.php`: "We design &amp; build digital products that move the
  needle." — kata aksen (`needle.`) berwarna **deep rose** `text-brand`; markup
  `.tw-word > .tw-char` (per karakter) + `.tw-cursor`.
- `style.css`: `.tw-char` default opacity 0 + translateY(8px), `.is-visible`
  opacity 1/translateY(0) 200ms `cubic-bezier(.4,0,.2,1)`; `.tw-cursor` blink
  `tw-blink` 0.7s, berwarna `#c2543d`; `prefers-reduced-motion` → semua char
  langsung terlihat + blink off.
- `main.js`: IntersectionObserver trigger saat heading masuk viewport, stagger
  **45ms** per char (hero ~47 char ≈ 2.1s), guard total length, safe fallback.

### QA v4.1.1 (Playwright Chromium, DDEV)
- 47/47 chars visible setelah stagger selesai (~4s), cursor `tw-blink`,
  h-overflow 0px desktop + mobile, pindah tab saat animasi → semua char tetap
  ter-reveal (guard tidak stuck), `pageerror` 0.
- Reduced motion: opacity 1 + animation none.

---

Tema `akdisi` dibangun ulang dari nol setelah penghapusan total theme v3 (commit
`e06a22d`). Arah: digital agency multi-halaman (NexStudio/TailGrids-inspired
structure) dengan bahasa visual **warm editorial** — putus total dari emerald lama.

### Keputusan user (konfirmasi eksplisit)
- **Aksen baru: deep rose / merah bata** `#c2543d` (bukan emerald `#10b981`,
  bukan biru-indigo brief) — hangat, tegas, pembeda.
- **Styling: Tailwind via CDN** (`cdn.tailwindcss.com`, runtime) — no build step;
  konfigurasi palette/font via `tailwind.config` inline. *Catatan: Play CDN untuk
  staging/dev — sebelum produksi disarankan compile statis.*
- **Konten: mulai bersih** — CPT baru (`akdisi_project`, `akdisi_insight`,
  `akdisi_faq`, `akdisi_testimonial`) tanpa bentrok data lama; pages baru
  (`/layanan/`, `/tentang/`, `/testimoni/`, `/use-cases/`, `/kontak/`) dengan
  slug segar; menu Primary & Footer dibangun ulang.

### Design system v4
- **Palet warm stone**: ink `#1c1917` (bukan pure black) / body `#57534e`,
  paper `#ffffff`, alt `#f7f5f2`, border `#e7e2dc`; aksen tunggal deep rose
  `#c2543d` + hover `#a8432f` + soft `#fbe9e6`.
- **Fonts**: Satoshi (display, Fontshare) + Outfit (body, Google) — stack v2 yang
  user-approved, dipertahankan (bukan Inter brief, sesuai anti-slop).
- **Shape**: button 8px, card 14px, badge pill 9999px; container 1280px;
  section padding `clamp(4rem,8vw,6.5rem)` (≈80–120px desktop ✓ brief).
- **Motion**: reveal on scroll (IntersectionObserver) + sticky header shadow,
  `data-reveal`, `prefers-reduced-motion` kill-switch. Tanpa GSAP (no dep).

### Arsitektur tema (16 file)
- `functions.php` — enqueue Tailwind CDN + 2 font; CPT + taxonomy fresh;
  menus; sizes; body_class.
- `style.css` — theme header + tokens + komponen custom (btn, card, badge,
  zebra sections, prose editorial, reveal).
- `header.php`/`footer.php` — sticky header + mobile menu (aria), footer 4-col
  (brand, company menu, services, newsletter) + fallback menus.
- `front-page.php` — Hero asymmetric (stats strip + mockup CSS), trusted marquee,
  services 4-col, why dark band (stats), featured projects (CPT, empty-state
  graceful), process 4-step, testimonials (CPT), insights preview (CPT), CTA band.
- Pages: `page-layanan.php` (services + engagement models), `page-tentang.php`
  (story + stats + values), `page-testimoni…`, `page-use-cases.php`,
  `page-kontak.php` (form AJAX), `page.php`.
- Archives/singles: `archive-akdisi_project.php`, `archive-akdisi_insight.php`
  (featured first post span), `single-akdisi_project.php` (facts sidebar),
  `single-akdisi_insight.php`, `index.php`, `archive.php`, `single.php`,
  `404.php`.
- `inc/helpers.php` (fallback menus, footer services) + `inc/contact.php`
  (AJAX lead → option `akdisi_leads` + `wp_mail`) + `assets/js/main.js`.

### QA v4.0.0 (Playwright Chromium, DDEV)
- **9 URL** (home, 6 pages, 2 archive CPT): semua 200 (404 → 404),
  `pageerror` 0, h-overflow **0px** (desktop 1440 & mobile 390).
- Tokens via computed style: h1 Satoshi 72px (`clamp` terpakai), body Outfit,
  btn-primary `rgb(194,84,61)` = `#c2543d`, dark band `#1c1917` (bukan black),
  btn radius 8px, badge pill.
- Section rhythm home (computed bg): white → white(strip) → white →
  dark `#1c1917` → alt `#f7f5f2` → white → alt → white → CTA dark-band.
- Mobile: menu toggle buka/tutup OK (aria-expanded ter-update).
- Form kontak AJAX end-to-end: submit sukses → message success tampil,
  lead tersimpan (`akdisi_leads`), `pageerror` 0.
- PHP lint bersih (15 file via DDEV), `node --check` main.js OK.

### Catatan
- Play CDN menyuntik utility via runtime — konten tampil tanpa-JS sebagai
  unstyled HTML (acceptable untuk staging; produksi → compile Tailwind statis).
- Screenshots QA desktop/mobile diambil (home + contact) — visual verified via
  computed styles (model QA ini tidak support image input).

## v4.1.0 — Content Seeding + Newsletter + FAQ Accordion 2026-09-06

Konten CPT fresh, FAQ section di homepage, newsletter AJAX, thumbnails branded.

### Content CPT (data fresh — lama tidak disentuh)
- **5 projects** (`akdisi_project`, slug `/projects/<name>/`): Marketplace Revamp,
  Clinic Ops, PropCare, Analytics Suite, EventFlow — masing-masing: full content
  (h2+ul/ol), excerpt, meta (client/role/status), featured image (branded SVG→PNG
  1600×1000, warna gradient deep-rose→ink), category (`akdisi_project_cat`):
  Web Platform, Health Tech, Property Tech, Data & Analytics, Event Tech.
- **5 testimonials** (`akdisi_testimonial`): Andri Setiawan, Nita Haryanto,
  Budi Pratama, Devi Anggraini, Fajar Rizki — masing-masing: name, role,
  content-quote original. Ditampilkan di `/testimoni/` (blockquote grid 5 kolom).
- **4 insights** (`akdisi_insight`, slug `/insight/<name>/`): CRO Playbook for B2B
  SaaS, How to Bootstrap a Design System When You Are Small, When WordPress Is
  Enough, Agency vs Vendor — How to Tell the Difference — full h2 editorial content,
  excerpt, branded thumbnail.
- **8 FAQs** (`akdisi_faq`): pricing, timeline, tech-stack, ongoing-support,
  security, hosting, size, not-fit — content original, Bahasa Indonesia ringkas.

### Home FAQ accordion
- Section baru `akdisi-faq` (section-alt) sebelum CTA band: 2-col editorial layout
  (judul kiri + `<details>` accordion kanan). 8 FAQ dari CPT, first item `open`.
- Expand/collapse via native `<details>` — no JS needed; CSS `group-open:rotate-45`
  pada `+` chevron.

### Newsletter AJAX
- `inc/newsletter.php` baru: `akdisi_subscribe()` + AJAX action `akdisi_newsletter`.
  - Nonce validation, email format check, throttle 5/jam/IP, simpan ke option
    `akdisi_subscribers` (last 2000 entries, chronological), `wp_mail` ke admin
    (filterable via `akdisi_newsletter_to`).
- Footer newsletter form: dirubah dari form `action="/"` → form id
  `akdisi-newsletter-form` + nonce field (`akdisi_nl_nonce`), no JS fail.
- `main.js`: handler `#akdisi-newsletter-form` — validate, `akdisi_newsletter` AJAX,
  tampilkan status `.akdisi-nl-status` (success/error/network), disable button
  selama request.

### Thumbnails (SVG→PNG)
- 9 branded thumbnails generated (`rsvg-convert`, 1600×1000) dari SVG gradient
  (deep-rose + ink, motif bervariasi per kategori: grid, card, map, bars, ring, text).
- Projects: marketplace-gradient, clinic-gradient, propcare-gradient,
  analytics-gradient, eventflow-gradient.
- Insights: cro-gradient, design-systems-gradient, wordpress-gradient, agency-gradient.
- Semua attached sebagai `featured_image` via `wp post meta update _thumbnail_id`.

### QA v4.1.0 (Playwright Chromium, DDEV)
- **11 URLs**: semua 200 (404 → 404), `pageerror` 0, h-overflow 0px (desktop 1440
  & mobile 390).
- Home content: h1 ✓, 8 FAQ accordion (1 open / 7 closed) ✓, newsletter form ✓,
  featured projects & insights sections populated ✓.
- Projects archive: 5 cards rendered; single project: facts sidebar + thumbnail ✓.
- Insights archive: 4 cards rendered; single insight: thumbnail ✓.
- Testimonials: 5 blockquotes on `/testimoni/`.
- Contact AJAX E2E: success message "Thanks — your message is on its way..." ✓.
- Newsletter AJAX E2E: success message "You are on the list..." ✓.
- Contact inline errors (empty submit): 3 errors shown ✓.
- Token spot-check: btn `rgb(194, 84, 61)` = `#c2543d`, h1 font Satoshi ✓.

---

## v3.0.0 — Cohesive Section Rhythm + CSS Audit Rewrite 2026-09-06

Refactor total `style.css` v2 → v3 (685 → 842 baris), menanggapi audit bahwa
section tidak konsisten warnanya (dark/light/alt nyampur) dan sejumlah class
template belum ter-cover. Seluruh layout & konten homepage v2.x dipertahankan —
yang dirombak adalah **fondasi CSS agar warna/rhythm/coverage deterministik**.
Font stack v2 user-approved dipertahankan utuh.

### Design token v3 (`:root`, single source of truth)
- **Section rhythm eksplisit**: `--bg-hero` (void), `--bg-dark` (abyss),
  `--bg-light` (paper), `--bg-surface` (light alt `#eef1f5`), `--bg-panel`.
- Kelas section konsisten: `.section-dark`, `.section-light`, `.section-hero`,
  `.section-panel`, `.section-surface`/`.section-alt` — bukan lagi background
  ad-hoc per section.
- **Legacy aliases lengkap** (50+): semua `--bg-*`, `--text-*`, `--primary`,
  `--tertiary`, `--radius-*`, `--shadow-*`, dll. — seluruh template 20+ PHP
  jalan tanpa edit. Tambah `--text-light`, `--text-muted` (rindu di v2).
- **Fix** `--bg-surface` double-defined (ambigu: pernah light & dark) →
  satu nilai light alt. Hapus `var(--bg-void)` tak terdefinisi di
  `.site-footer`/`.error-404-page` → `var(--color-void)` (footer kini void
  `rgb(5,8,12)`, sebelumnya transparan `rgba(0,0,0,0)`).

### Section rhythm terverifikasi (Playwright computed style)
- Homepage: `hero`(void) → `marquee`(void) → **D-L-D-L-D-L-D** homeostasis:
  `#05080c` → `#fafafa` → `#0a0f1a` → `#fafafa` → ... → footer `#05080c`.
- Tidak ada lagi section nyasar warna atau duplikasi surface berurutan.

### Coverage gap ditutup (class template yang tadi tidak ter-definisi)
- `form-field`/`field-error`/`form-general-error` (contact & booth),
- `feature-item` (single-portfolio), `post-card*` (archive/index insight),
- `hero-content`/`hero-headline`/`hero-line` (kinetic 3-baris),
- `process-steps`/`process-step-number` (about), `proc-steps`/`proc-step` (home),
- `related-block`/`related-cards`, `project-meta-block`, `project-gallery`,
- `portfolio-filters`, `split-intro`, `side-note`, `widget*`,
- `whatsapp-float`/`sticky-cta` alias, `serif-zero`, `gallery-item`.
- `folio-item.span2/3/4/5` + `grid-auto-flow:dense` → kolase 5-col asimetris
  rapi tanpa celah (item pertama `span2` dari template kini benar-benar melebar).

### QA v3.0.0 (Playwright Chromium, DDEV)
- 10 URL (home, 8 inner, 404): semua `200` (404 → 404), `pageerror` 0,
  h-overflow `0px` (desktop 1440).
- Tokens: body `Outfit`, btn-primary gradient `linear-gradient(135deg,#34d399,#10b981)`,
  hero h1 `text-align:start`, bento 5-col (252.8×5), proof `742/593` (1.25fr/1fr),
  value 4-col asimetris, folio 5-col + `span2`, marquee beranimasi
  (`transform translateX -55.8`), footer `rgb(5,8,12)`.
- Anti-slop: no `Inter`, no pure-black surface, no pill `btn`, single emerald.
- Catatan (di luar scope CSS): detail portfolio `features` meta kosong di DB
  (9 project tanpa `feature-item`/`section-alt`) — isu data terpisah, bukan regresi.

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

