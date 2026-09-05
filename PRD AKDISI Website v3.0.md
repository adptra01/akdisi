# PRODUCT REQUIREMENTS DOCUMENT (PRD) V3.0

**Product:** AKDISI Corporate & Marketing Website

**Version:** 3.0 (Final Product Definition)

**Primary Business Goal:** Generate Qualified B2B Leads

**Target Market:** Developer, Perumahan, Manajemen Properti, Asosiasi Pengembang (Fokus Area: Jambi)

---

## 1. Executive Summary & Product Vision

AKDISI Website V3.0 bukanlah brosur digital statis, melainkan **B2B Marketing & Lead-Generation Platform**. Website ini dirancang untuk merepresentasikan AKDISI sebagai mitra solusi (bukan sekadar vendor *coding*), mengedukasi calon klien berbasis masalah operasional mereka, dan memperpendek jalur menuju konsultasi (konversi).

**Arsitektur Nilai Produk:**
`BRAND (Identity) → TRUST (Portfolio) → EDUCATION (Insight/Solutions) → LEAD GENERATION (Consultation)`

**Non-Goals (Out of Scope untuk MVP):**
Sistem CRM, ERP, Customer Portal, Ticketing, Online Payment, dan Project Management *tidak* dibangun pada fase ini.

---

## 2. Target Audience & Core User Jobs

Pengalaman pengguna (UX) dan *copywriting* harus secara spesifik merespons 5 persona utama:

1. **Developer (Decision Maker):** Mencari sistem monitoring proyek, sales, dan administrasi. (CTA: Diskusikan Kebutuhan Sistem)
2. **Pengelola Perumahan:** Mencari solusi manajemen data penghuni, komplain, dan layanan warga. (CTA: Lihat Solusi Perumahan)
3. **Asosiasi/Organisasi:** Mencari sistem database anggota dan manajemen kegiatan. (CTA: Diskusikan Kebutuhan Organisasi)
4. **Bisnis Properti:** Mencari manajemen *lead* dan ketersediaan unit. (CTA: Konsultasikan Kebutuhan Anda)
5. **Booth Visitor:** Calon klien dengan waktu terbatas (< 60 detik) yang memindai QR code dari *smartphone*.

**Core User Jobs yang harus dijawab dalam 1-3 klik:**

* Siapa AKDISI dan apa yang mereka bangun?
* Apakah solusi mereka relevan dengan masalah bisnis saya saat ini?
* Seperti apa wujud/demo sistem yang pernah dibuat?
* Bagaimana cara cepat saya menghubungi mereka?

---

## 3. Information Architecture (Sitemap) & Navigation

Sitemap V3 difokuskan pada pemisahan antara **Services** (Kapabilitas AKDISI) dan **Solutions** (Konteks masalah industri klien).

**Sitemap Final MVP:**

* **Home** (`/`)
* **About** (`/about/`)
* **Services** (`/services/`)
* **Solutions** (`/solutions/`) -> *Housing, Developer, Property, Organization*
* **Portfolio** (`/portfolio/`) -> *Minimal 8 concept/demo projects*
* **Insight** (`/insight/`) -> *Minimal 3-5 artikel edukasi SEO*
* **FAQ** (`/faq/`)
* **Contact** (`/contact/`)
* **Booth Landing** (`/booth/`)

**Navigasi:**

* **Desktop:** `Services | Solutions | Portfolio | Insight | About | [ CTA: Konsultasi ]`
* **Mobile:** `[Logo] | [Menu Hamburger]` (CTA Konsultasi/WhatsApp menempel permanen/sticky di mobile).

---

## 4. Core Page Specifications

### A. Homepage (The Main Sales Page)

* **Hero Section:** *Headline* fokus pada solusi properti/perumahan, *copy* pendukung, tombol CTA utama (Konsultasi), dan visual berupa **Mockup UI Dashboard/Aplikasi** (bukan foto stok laptop generik).
* **Problem Section:** Menyoroti pain-points (*Data tersebar, proses manual, monitoring sulit*).
* **Approach Section:** 6 Langkah (Understand, Analyze, Design, Build, Implement, Improve) untuk membedakan AKDISI dari vendor *software* instan.
* **Solutions & Services:** Menampilkan pilar industri (Solutions) dan pilar teknis (Services).
* **Portfolio Highlight & FAQ:** Menampilkan 3-4 *featured portfolio* dan pertanyaan krusial klien.

### B. Portfolio System (The Proof Mechanism)

* **Aturan Transparansi Mutlak:** Proyek fiktif untuk demo wajib dilabeli **"Concept Project"** atau **"Demo Solution"**. Dilarang menggunakan logo klien asli tanpa izin.
* **Target MVP:** 8 Proyek (*KawasanHub, PropertiFlow, AsosiasiConnect, WargaCare, SalesProperty, DokumenProperti, ProjectMonitor, PropertiCare*).
* **Struktur Detail Halaman:** Image → Context → Problem → Solution → Features → UI Screens → Expected Outcome → CTA.

### C. Booth Landing Page (`/booth/`)

* **Objective:** Konversi kilat untuk *scan* QR.
* **Structure:** Hero → Masalah → Solusi → Portofolio → CTA WhatsApp → Short Form.
* **Rule:** Tidak ada navigasi kompleks atau artikel *blog*. Pengguna harus bisa mencapai WhatsApp dalam maksimal 2 interaksi.

---

## 5. Conversion & Lead Generation Engine

Website dirancang dengan 3 lapisan konversi:

1. **Primary - WhatsApp Automation:**
Klik CTA akan membuka WhatsApp dengan *pre-filled message* dinamis.
*Contoh Booth:* "Halo AKDISI, saya mendapatkan informasi dari booth dan ingin berkonsultasi..."
2. **Secondary - Lead Form:**
Formulir kontak terstruktur. *Field Mandatory:* Nama, Organisasi, WhatsApp, Kebutuhan, Deskripsi. Tidak meminta informasi *budget* atau skala perusahaan pada tahap ini untuk mengurangi *friction*.
3. **Tertiary - Email/Contact Info:** Tersedia di *footer* dan halaman Contact.

---

## 6. Technical, SEO, & CMS Architecture

### A. Teknologi Utama

* **Platform:** WordPress (sebagai CMS MVP yang paling cepat di-deploy dan *migration-ready*).
* **Hosting Asumsi:** InfinityFree (wajib menggunakan desain ringan, minimal *plugin*, optimasi gambar agresif, dan sistem *caching* yang baik karena *resource limit*).
* **Security & Data:** Wajib HTTPS, *anti-spam* pada formulir kontak, dan *backups* rutin (Database + File di luar server).

### B. SEO Architecture

* **Targeting:** Local (*software house Jambi*), Industry (*sistem pengelolaan perumahan*), dan Problem (*digitalisasi administrasi perumahan*).
* **Technical:** Wajib memiliki URL hierarkis yang bersih (contoh: `/solutions/housing/`), *Canonical tags, Title/Meta Description* unik, H1, dan integrasi Google Search Console.

### C. Automasi Konten (Fase Lanjutan / n8n)

* Ekosistem *n8n* akan digunakan untuk riset dan *drafting* artikel AI.
* **Business Rule:** Konten *AI-Generated* wajib berstatus *Draft* dan harus melewati **Human Review** sebelum di-*publish*. Dilarang *auto-publish*.

---

## 7. UI/UX & Design System Direction

* **Vibe Visual:** Modern Corporate, Property, Digital. Bersih, terstruktur, *trustworthy*.
* **Color Palette:** Primary (Deep Navy/Dark Charcoal), Secondary (Warm Neutral), Accent (Muted Green), Background (Off-white).
* **Typography:** Plus Jakarta Sans (Primary) atau Inter (Alternative).
* **Mobile First:** Aksesibilitas *touch target* yang besar, gambar tidak meluber (*overflow*), dan form yang mudah diketik di *smartphone*.

---

## 8. Analytics & KPIs

* **North Star Metric:** Qualified Consultation Leads per bulan.
* **Event Tracking Wajib:** `page_view`, `cta_click`, `whatsapp_click`, `form_submit`, `portfolio_view`, `booth_visit`.
* URL parameter untuk booth: `?source=booth` untuk atribusi konversi dari *offline* ke *online*.

---

## 9. Eksekusi 7 Hari & Launch Criteria (Definition of Done)

**Timeline MVP (Feature Freeze di Hari 5):**

* **Day 1:** Blueprint & Design System.
* **Day 2-3:** Foundation & Core Pages (Home, About, Services, Contact).
* **Day 4:** Setup 8 Concept Portfolios & Detail pages.
* **Day 5:** Solutions, Insight, FAQ, Booth (Marketing & Conversion Engine).
* **Day 6:** SEO, Analytics, Setup WhatsApp/Forms.
* **Day 7:** QA, Mobile Testing, Launch.

**Launch Blocker (Website TIDAK BOLEH rilis jika):**

1. HTTPS rusak.
2. Form kontak atau CTA WhatsApp gagal mengirim pesan.
3. *Layout mobile* berantakan/sulit digunakan.
4. Terdapat proyek portofolio konsep/demo yang diklaim sebagai klien asli (*misleading*).

---

### Tindak Lanjut Analis PRD (Next Actionable Steps)

Seperti yang Anda sebutkan di poin 104, dokumen berikutnya yang paling krusial sebelum menyentuh desain/UI atau WordPress adalah **Blueprint Spesifikasi**.

Mengingat PRD V3 ini sudah solid, **apakah Anda ingin saya langsung membuatkan dokumen Nomor 1, 2, dan 3 sekarang?**

1. **Sitemap Final & URL Mapping** (Pemetaan struktural pasti untuk setiap halaman).
2. **User Flow Diagram** (Pemetaan langkah per langkah dari klik sumber hingga menjadi *lead*).
3. **Content Specification / Copywriting Outline** (Instruksi elemen teks apa saja yang wajib ada di *Hero*, *Section 2*, dst untuk halaman utama).