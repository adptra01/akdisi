Tidak perlu ada PRD berikutnya.

Saya justru menyarankan **PRD V4 yang tadi kita buat menjadi PRD terakhir**, tetapi isinya sekarang kita **kunci sebagai Final Master PRD**. Setelah dokumen ini selesai, pekerjaan berikutnya **bukan membuat PRD V5/V6**, melainkan mengimplementasikan dokumen ini menjadi desain, content, WordPress, integrasi, testing, dan launch.

Di bawah ini saya lengkapi sampai level yang bisa dijadikan **single source of truth** untuk proyek website AKDISI.

# PRD FINAL MASTER — AKDISI WEBSITE

**Nama Produk:** AKDISI Website
**Perusahaan:** AKAR Digital Solusi (AKDISI)
**Dokumen:** Final Master Product Requirements Document
**Status:** FINAL / BASELINE IMPLEMENTATION
**Versi:** 4.0 Final
**Target:** Corporate Profile + B2B Marketing + Lead Generation Platform
**Target Industri:** Developer, perumahan, properti, asosiasi pengembang, organisasi terkait
**Geografis Awal:** Jambi dan sekitarnya
**CMS:** WordPress sebagai pilihan utama
**Hosting Awal:** InfinityFree
**Automation:** n8n
**Primary Conversion:** Konsultasi melalui WhatsApp
**Secondary Conversion:** Lead form
**Pengelola:** Owner / technical background

---

# BAGIAN A — PRODUCT FOUNDATION

## 1. Product Vision

Website AKDISI harus menjadi **mesin pemasaran digital B2B**, bukan sekadar halaman profil perusahaan.

Fungsi utamanya:

```text
ATTRACT
   ↓
EDUCATE
   ↓
BUILD TRUST
   ↓
SHOW RELEVANCE
   ↓
SHOW PROOF
   ↓
CONVERT
   ↓
QUALIFY LEAD
   ↓
CONSULTATION
```

---

# 2. Business Problem

AKDISI memulai pemasaran dari kondisi:

* brand belum dikenal luas;
* aset marketing belum tersedia;
* portfolio publik belum banyak;
* target market spesifik;
* pemasaran akan dilakukan secara offline melalui booth;
* website harus mendukung sales;
* website harus dapat dikembangkan menjadi channel SEO.

Masalah utama yang harus diselesaikan:

> Bagaimana membuat calon pelanggan B2B yang belum mengenal AKDISI cukup percaya dan cukup tertarik untuk memulai percakapan?

---

# 3. Product Objective

Website harus:

1. memperkenalkan AKDISI;
2. menjelaskan jasa secara sederhana;
3. menunjukkan pemahaman terhadap industri;
4. memberikan contoh solusi;
5. menunjukkan portfolio;
6. menjelaskan proses kerja;
7. mengurangi keraguan calon pelanggan;
8. menyediakan CTA yang jelas;
9. menangkap lead;
10. menjadi foundation SEO.

---

# 4. Primary Business KPI

KPI utama:

> **Qualified B2B Consultation Leads**

Bukan:

* page views;
* jumlah artikel;
* jumlah followers;
* jumlah visitor semata.

Traffic hanya berguna jika menghasilkan peluang bisnis.

---

# 5. Secondary KPI

* WhatsApp clicks;
* form submissions;
* qualified leads;
* consultation bookings;
* portfolio views;
* solution page views;
* service page views;
* organic traffic;
* booth QR visits;
* conversion rate.

---

# 6. Product Success Definition

Website dianggap berhasil jika:

> Pengunjung yang berasal dari Google, referral, social media, atau booth dapat memahami AKDISI, menemukan relevansi terhadap bisnis mereka, melihat contoh solusi, lalu menghubungi AKDISI tanpa kebingungan.

---

# BAGIAN B — TARGET CUSTOMER

# 7. Primary Audience

### Developer Perumahan

Kebutuhan:

* monitoring proyek;
* sales;
* unit;
* data;
* administrasi;
* reporting.

### Organisasi Perumahan

Kebutuhan:

* penghuni;
* unit;
* administrasi;
* layanan;
* pengaduan;
* komunikasi.

### Asosiasi Pengembang

Kebutuhan:

* member;
* database;
* dokumen;
* kegiatan;
* komunikasi;
* reporting.

### Bisnis Properti

Kebutuhan:

* property;
* leads;
* sales;
* inventory;
* reporting;
* administration.

---

# 8. Decision Maker

Website harus berbicara kepada:

* owner;
* director;
* manager;
* operational manager;
* IT/technical person;
* administrator;
* decision maker organisasi.

Jangan hanya menggunakan bahasa programmer.

---

# 9. Customer Pain Points

Pain point utama:

```text
Data tersebar
Proses manual
Spreadsheet terlalu banyak
Informasi sulit dicari
Approval tidak terstruktur
Monitoring lambat
Laporan manual
Duplikasi data
Komunikasi tidak terdokumentasi
Software existing tidak sesuai
```

---

# BAGIAN C — POSITIONING

# 10. Positioning Statement

> **AKDISI membantu organisasi dan bisnis membangun solusi aplikasi yang disesuaikan dengan proses dan kebutuhan operasional mereka.**

---

# 11. Core Value Proposition

> **Solusi Aplikasi yang Dibangun untuk Proses Bisnis Anda.**

---

# 12. Supporting Proposition

AKDISI bukan menjual:

> "teknologi X."

AKDISI menjual:

> solusi terhadap proses bisnis.

---

# 13. Messaging Framework

Semua halaman mengikuti:

```text
PROBLEM
 ↓
CONTEXT
 ↓
SOLUTION
 ↓
BENEFIT
 ↓
PROOF
 ↓
CTA
```

---

# 14. Tone

Gunakan:

* profesional;
* jelas;
* konsultatif;
* percaya diri;
* modern;
* business-oriented.

Hindari:

* jargon berlebihan;
* klaim berlebihan;
* bahasa terlalu teknis;
* bahasa startup yang terlalu santai;
* klaim "terbaik";
* klaim tanpa bukti.

---

# BAGIAN D — WEBSITE ARCHITECTURE

# 15. Final Sitemap

```text
/
├── about/
│
├── services/
│   ├── application-development/
│   ├── business-process-digitalization/
│   ├── data-administration-systems/
│   └── custom-business-solutions/
│
├── solutions/
│   ├── housing/
│   ├── developer/
│   ├── property/
│   └── organization/
│
├── portfolio/
│   └── {project}/
│
├── insight/
│   └── {article}/
│
├── faq/
│
├── contact/
│
└── booth/
```

---

# 16. Navigation

Desktop:

```text
LOGO

Services
Solutions
Portfolio
Insight
About

[Konsultasi]
```

Mobile:

```text
LOGO       MENU
```

CTA harus tetap mudah ditemukan.

---

# 17. Footer

Footer:

```text
AKDISI
Solusi Aplikasi untuk Bisnis

Services
Solutions
Portfolio
Insight
About
Contact

WhatsApp
Email
Location

Privacy Policy
```

---

# BAGIAN E — HOMEPAGE

# 18. Homepage Objective

Homepage harus menjawab:

> Siapa AKDISI?

> Apa yang dilakukan?

> Apakah relevan bagi saya?

> Bagaimana memulai?

---

# 19. Hero

H1:

> **Solusi Aplikasi untuk Bisnis Properti dan Perumahan**

Supporting:

> Bangun sistem yang menyesuaikan proses bisnis organisasi Anda—mulai dari pengelolaan data, administrasi, layanan, hingga kebutuhan operasional yang lebih spesifik.

Primary CTA:

> **Konsultasikan Kebutuhan Anda**

Secondary:

> **Lihat Portfolio**

Visual:

> UI application mockup.

---

# 20. Problem Section

Headline:

> **Ketika Proses Bisnis Bertumbuh, Sistem Harus Ikut Berkembang**

Cards:

* Data tersebar;
* proses manual;
* monitoring sulit;
* laporan lambat;
* sistem existing tidak sesuai.

---

# 21. Approach

Headline:

> **Kami Mulai dari Memahami Proses Bisnis Anda**

Flow:

```text
Understand
    ↓
Analyze
    ↓
Design
    ↓
Build
    ↓
Implement
    ↓
Improve
```

---

# 22. Solution Section

Cards:

### Housing

Solusi untuk pengelolaan kawasan dan layanan penghuni.

### Developer

Solusi untuk mendukung proses bisnis developer.

### Property

Solusi untuk pengelolaan bisnis properti.

### Organization

Solusi untuk administrasi dan pengelolaan organisasi.

---

# 23. Service Section

Four cards:

1. Application Development
2. Business Process Digitalization
3. Data & Administration Systems
4. Custom Business Solutions

---

# 24. Portfolio Section

Homepage menampilkan:

3–4 portfolio terbaik.

Card:

```text
Image
Category
Project Name
Description
View Solution
```

---

# 25. Why AKDISI

Pillars:

```text
Business-first approach
Relevant industry context
Custom solution
Structured process
Long-term support
```

---

# 26. Process Section

```text
Consultation
      ↓
Requirement
      ↓
Planning
      ↓
Development
      ↓
Implementation
      ↓
Support
```

---

# 27. FAQ

Minimum:

1. Berapa lama pembuatan aplikasi?
2. Apakah aplikasi dapat disesuaikan?
3. Bagaimana proses konsultasi?
4. Apakah ada maintenance?
5. Apakah aplikasi dapat dikembangkan bertahap?
6. Bagaimana menentukan kebutuhan aplikasi?
7. Apakah dapat mengembangkan sistem existing?

---

# 28. Final CTA

Headline:

> **Punya proses bisnis yang ingin dibuat lebih terstruktur?**

CTA:

> Konsultasikan Sekarang

---

# BAGIAN F — ABOUT

# 29. About Objective

Membangun:

> identity + trust + context.

---

# 30. About Structure

```text
Hero
↓
Who We Are
↓
What We Believe
↓
How We Work
↓
Industry Focus
↓
Direction
↓
CTA
```

---

# 31. About Principle

Jangan membuat halaman "tentang kami" menjadi sejarah perusahaan yang panjang.

Prioritas:

> relevansi terhadap customer.

---

# BAGIAN G — SERVICES

# 32. Service Architecture

Services menjawab:

> **"Apa yang bisa saya pesan dari AKDISI?"**

---

# 33. Application Development

Deskripsi:

> Pembangunan aplikasi yang dirancang berdasarkan kebutuhan dan proses bisnis organisasi.

Use cases:

* internal applications;
* management systems;
* dashboards;
* operational systems;
* administration.

---

# 34. Business Process Digitalization

Fokus:

> mengubah proses manual menjadi workflow digital.

Use cases:

* approval;
* administration;
* monitoring;
* reporting;
* workflow.

---

# 35. Data & Administration Systems

Use cases:

* member;
* resident;
* unit;
* property;
* documents;
* reporting.

---

# 36. Custom Business Solutions

Untuk:

> kebutuhan khusus yang tidak cocok dengan software generik.

---

# 37. Service Detail Template

Setiap service:

```text
Hero
↓
Problem
↓
Target Customer
↓
Use Cases
↓
What We Can Build
↓
Benefits
↓
Process
↓
FAQ
↓
CTA
```

---

# BAGIAN H — SOLUTIONS

# 38. Purpose

Solutions menjawab:

> **"Apa yang dapat dilakukan AKDISI untuk industri saya?"**

Ini berbeda dengan Services.

---

# 39. Housing Solution

Potential capabilities:

* resident management;
* unit management;
* complaint;
* announcements;
* administration;
* service tracking;
* reporting.

---

# 40. Developer Solution

Potential:

* project monitoring;
* property database;
* sales monitoring;
* document management;
* internal administration;
* dashboard;
* reporting.

---

# 41. Property Solution

Potential:

* property management;
* lead management;
* unit management;
* sales;
* reporting.

---

# 42. Organization Solution

Potential:

* member management;
* document management;
* event management;
* administration;
* communication;
* reporting.

---

# BAGIAN I — PORTFOLIO

# 43. Portfolio Objective

Portfolio adalah:

> proof mechanism.

Bukan sekadar gallery.

---

# 44. Portfolio Types

Setiap portfolio harus mempunyai status:

```text
CONCEPT PROJECT
DEMO SOLUTION
ACTUAL PROJECT
```

---

# 45. Portfolio Transparency Rule

**WAJIB.**

Concept project tidak boleh terlihat sebagai client project.

Jangan membuat:

> "Project untuk PT XYZ"

jika tidak pernah ada.

---

# 46. Initial Portfolio

Delapan concept project:

| Project         | Fokus        |
| --------------- | ------------ |
| KawasanHub      | Housing      |
| PropertiFlow    | Property     |
| AsosiasiConnect | Organization |
| WargaCare       | Housing      |
| SalesProperty   | Developer    |
| DokumenProperti | Property     |
| ProjectMonitor  | Developer    |
| PropertiCare    | Property     |

---

# 47. Portfolio Detail

Template:

```text
Project Name
Status
Category

Context

Problem

Solution

Key Features

User Flow

Expected Outcome

Screens

Related Solution

Related Service

CTA
```

---

# 48. Portfolio Visual

Setiap project minimal:

* hero mockup;
* dashboard;
* 2–4 UI screens;
* feature highlights.

Gunakan desain visual konsisten.

---

# BAGIAN J — INSIGHT

# 49. Insight Objective

Insight mempunyai empat fungsi:

```text
SEO
+
Education
+
Authority
+
Lead Nurturing
```

---

# 50. Content Pillars

1. Digitalisasi perumahan
2. Digitalisasi developer
3. Property management
4. Business process
5. Application strategy

---

# 51. Initial Articles

Minimal 5:

1. Kapan Pengelolaan Perumahan Membutuhkan Sistem Digital?
2. Masalah Administrasi Developer yang Dapat Didigitalisasi
3. Apa yang Perlu Dipersiapkan Sebelum Membuat Aplikasi Bisnis?
4. Sistem Informasi untuk Pengelolaan Organisasi
5. Aplikasi Custom vs Software Siap Pakai

---

# BAGIAN K — SEO

# 52. SEO Strategy

SEO dibagi:

```text
LOCAL
+
INDUSTRY
+
PROBLEM
+
EDUCATION
```

---

# 53. Local Keywords

Contoh:

* jasa pembuatan aplikasi Jambi;
* jasa pembuatan sistem Jambi;
* pengembangan aplikasi Jambi;
* software house Jambi;
* developer aplikasi Jambi;
* jasa aplikasi bisnis Jambi.

---

# 54. Industry Keywords

* aplikasi perumahan;
* sistem pengelolaan perumahan;
* aplikasi developer perumahan;
* sistem properti;
* property management;
* aplikasi organisasi;
* aplikasi asosiasi.

---

# 55. Problem Keywords

* digitalisasi administrasi perumahan;
* sistem pengaduan perumahan;
* sistem data penghuni;
* sistem monitoring developer;
* digitalisasi administrasi organisasi.

---

# 56. Search Intent

| Intent        | Destination |
| ------------- | ----------- |
| Brand         | Home        |
| Commercial    | Services    |
| Industry      | Solutions   |
| Proof         | Portfolio   |
| Informational | Insight     |
| Conversion    | Contact     |
| Campaign      | Booth       |

---

# 57. On-page SEO

Setiap halaman indexable:

* unique title;
* meta description;
* H1;
* H2/H3;
* canonical;
* URL;
* alt;
* internal links;
* Open Graph;
* structured data jika relevan.

---

# 58. URL Rules

Gunakan:

```text
/services/
/solutions/housing/
/portfolio/kawasanhub/
/insight/digitalisasi-perumahan/
```

Hindari:

```text
/page?id=123
/post123
/project-final-v2
```

---

# BAGIAN L — N8N

# 59. n8n Purpose

n8n bukan sekadar "AI penulis artikel".

n8n menjadi:

> **content operations layer.**

---

# 60. n8n Workflow

```text
Keyword
   ↓
Topic
   ↓
Content Brief
   ↓
Outline
   ↓
AI Draft
   ↓
SEO Metadata
   ↓
Human Review
   ↓
WordPress Draft
   ↓
Approval
   ↓
Publish
   ↓
Notification
```

---

# 61. AI Governance

Default:

> **AI tidak boleh langsung publish.**

Human approval wajib untuk:

* klaim perusahaan;
* client references;
* statistics;
* industry claims;
* legal/regulatory information;
* portfolio;
* final article.

---

# BAGIAN M — LEAD GENERATION

# 62. Conversion Hierarchy

Prioritas:

```text
1. WhatsApp
2. Form
3. Email
```

---

# 63. Contact Form

Fields:

```text
Nama *
Organisasi *
Jabatan
WhatsApp *
Email
Jenis Organisasi
Kebutuhan *
Deskripsi *
Estimasi waktu kebutuhan
```

---

# 64. Lead Status

```text
NEW
 ↓
CONTACTED
 ↓
QUALIFIED
 ↓
CONSULTATION
 ↓
CLOSED
```

---

# 65. Lead Source

```text
Website
Google
Social
Referral
Booth
QR
Direct
```

---

# 66. WhatsApp Message

Default:

> Halo AKDISI, saya ingin berkonsultasi mengenai kebutuhan aplikasi untuk organisasi/perusahaan kami.

Booth:

> Halo AKDISI, saya mendapatkan informasi AKDISI dari booth/event dan ingin berkonsultasi mengenai kebutuhan aplikasi kami.

---

# BAGIAN N — BOOTH

# 67. Booth Landing Page

URL:

```text
/booth/
```

---

# 68. Booth Structure

```text
Hero
↓
Problem
↓
Solutions
↓
Portfolio
↓
Why AKDISI
↓
WhatsApp
↓
Short Form
```

---

# 69. Booth UX Rule

Target:

> Visitor dapat menemukan CTA dalam 1–2 interactions.

---

# 70. QR

QR diarahkan ke:

```text
/booth/
```

bukan homepage.

Gunakan campaign tracking.

---

# BAGIAN O — USER EXPERIENCE

# 71. Organic Flow

```text
Google
 ↓
Insight
 ↓
Solution
 ↓
Portfolio
 ↓
Service
 ↓
CTA
 ↓
Lead
```

---

# 72. Booth Flow

```text
Booth
 ↓
QR
 ↓
/booth/
 ↓
Solution
 ↓
Portfolio
 ↓
WhatsApp
 ↓
Lead
```

---

# 73. Referral Flow

```text
Referral
 ↓
Home
 ↓
About / Services
 ↓
Portfolio
 ↓
Contact
```

---

# 74. Sales Meeting Flow

```text
Meeting
 ↓
Home
 ↓
Relevant Solution
 ↓
Portfolio
 ↓
Discussion
```

---

# BAGIAN P — UI/UX

# 75. Design Direction

Keywords:

```text
Modern
Corporate
Professional
Clean
Structured
Premium
Trustworthy
Digital
```

---

# 76. Color

Recommended:

### Primary

Deep navy / dark charcoal.

### Secondary

Warm neutral.

### Accent

Muted green.

### Background

White / off-white.

---

# 77. Typography

Primary:

> Plus Jakarta Sans

Alternative:

> Inter

---

# 78. Component System

Minimum:

```text
Header
Footer
Button
Card
Service Card
Solution Card
Portfolio Card
Article Card
Badge
Accordion
Input
Select
Form
Breadcrumb
CTA
Section Header
Sticky CTA
```

---

# 79. Hero Visual

Prioritas:

> Application UI mockup.

Hindari hero utama berupa:

> generic laptop stock image.

---

# 80. Animation

Allowed:

* subtle reveal;
* hover;
* smooth scroll;
* micro-interaction.

Avoid:

* excessive animation;
* long preload;
* autoplay video;
* heavy parallax.

---

# BAGIAN Q — MOBILE

# 81. Mobile Priority

Mobile sangat penting karena:

```text
BOOTH
 ↓
QR
 ↓
SMARTPHONE
```

---

# 82. Mobile Layout

Prioritas:

```text
Hero
CTA
Solutions
Portfolio
Process
CTA
```

---

# 83. Mobile Sticky CTA

Recommended:

```text
┌────────────────────────┐
│    WhatsApp AKDISI     │
└────────────────────────┘
```

---

# BAGIAN R — CMS

# 84. CMS Content Types

```text
Pages
Services
Solutions
Portfolio
Insight
FAQ
```

---

# 85. Owner Capabilities

Owner harus dapat:

* membuat artikel;
* edit artikel;
* membuat portfolio;
* edit portfolio;
* membuat service;
* edit solution;
* edit FAQ;
* update CTA;
* update contact.

---

# 86. Portfolio Fields

```text
Title
Slug
Category
Status
Description
Context
Problem
Solution
Features
Expected Outcome
Hero Image
Gallery
Related Service
Related Solution
CTA
SEO Title
SEO Description
```

---

# 87. Service Fields

```text
Title
Slug
Description
Problem
Target Audience
Use Cases
Benefits
Process
FAQ
CTA
SEO
```

---

# 88. Solution Fields

```text
Title
Slug
Industry
Problem
Use Cases
Potential Features
Benefits
Related Services
Related Portfolio
CTA
SEO
```

---

# 89. Insight Fields

```text
Title
Slug
Excerpt
Content
Category
Author
Featured Image
SEO Title
SEO Description
Publish Date
```

---

# BAGIAN S — INTERNAL LINKING

# 90. Content Graph

```text
Insight
 ↓
Solution
 ↓
Portfolio
 ↓
Service
 ↓
Contact
```

Setiap content type harus memiliki related content.

---

# BAGIAN T — ANALYTICS

# 91. Events

Track:

```text
page_view
cta_click
whatsapp_click
form_start
form_submit
portfolio_view
service_view
solution_view
booth_visit
```

---

# 92. Event Properties

Minimal:

```text
page
cta_name
source
campaign
content
category
```

---

# 93. Conversion Funnel

```text
Visitor
 ↓
Engaged Visitor
 ↓
Content View
 ↓
CTA Click
 ↓
Inquiry
 ↓
Qualified Lead
 ↓
Consultation
 ↓
Client
```

---

# BAGIAN U — TRUST

# 94. Trust Architecture

Trust dibangun melalui:

```text
Professional Identity
+
Relevant Content
+
Relevant Portfolio
+
Transparent Labels
+
Clear Process
+
Professional Design
+
Easy Communication
```

---

# 95. Forbidden Claims

Tidak boleh menggunakan:

* fake client;
* fake testimonial;
* fake award;
* fake certification;
* fake partnership;
* fake statistics;
* fake project result;
* fake company logo.

---

# BAGIAN V — ACCESSIBILITY

# 96. Accessibility Requirements

Minimum:

* semantic HTML;
* keyboard navigation;
* contrast;
* labels;
* focus state;
* alt;
* heading hierarchy;
* readable typography.

---

# BAGIAN W — PERFORMANCE

# 97. Performance Requirements

Prioritas:

```text
Image Optimization
 ↓
Lightweight Theme
 ↓
Minimal Plugins
 ↓
Caching
 ↓
Minimal JavaScript
```

---

# 98. Image Rules

Gunakan:

* WebP/AVIF bila sesuai;
* responsive image;
* compression;
* lazy loading;
* ukuran sesuai display.

---

# BAGIAN X — SECURITY

# 99. Security Requirements

Minimum:

* HTTPS;
* strong credentials;
* role-based access;
* updates;
* spam protection;
* validation;
* sanitization;
* backup.

---

# 100. Privacy

Website harus memiliki:

> Privacy Policy.

Form hanya mengumpulkan data yang diperlukan untuk proses inquiry.

---

# BAGIAN Y — BACKUP

# 101. Backup Scope

Backup:

```text
Database
Media
Theme
Custom Code
Configuration
```

Minimal satu backup harus berada di luar hosting production.

---

# BAGIAN Z — HOSTING

# 102. InfinityFree

InfinityFree dapat digunakan sebagai:

> **initial MVP hosting.**

Tetapi architecture harus migration-ready.

Target masa depan:

```text
InfinityFree
    ↓
VPS / Managed Hosting
```

tanpa redesign total.

---

# BAGIAN AA — TECHNICAL ARCHITECTURE

# 103. Recommended Architecture

```text
                INTERNET
                   │
                   ▼
              WordPress
                   │
        ┌──────────┼──────────┐
        │          │          │
       CMS        SEO       Forms
        │          │          │
        └──────────┼──────────┘
                   │
                Analytics
                   │
                  n8n
                   │
             Content Workflow
```

---

# 104. Plugin Philosophy

Jangan menggunakan plugin sebanyak mungkin.

Prinsip:

> **Minimum plugins, maximum maintainability.**

Setiap plugin harus punya alasan bisnis/teknis.

---

# BAGIAN AB — ERROR HANDLING

# 105. 404

Harus menyediakan:

```text
Page Not Found

[Back to Home]

[Contact AKDISI]
```

---

# 106. Form Error

Error harus:

* jelas;
* dekat dengan field;
* mudah diperbaiki.

---

# 107. Form Success

Setelah submit:

> Terima kasih. Kebutuhan Anda telah diterima. Tim AKDISI akan menghubungi Anda melalui kontak yang diberikan.

---

# BAGIAN AC — CONTENT GOVERNANCE

# 108. Editorial Status

```text
IDEA
 ↓
BRIEF
 ↓
DRAFT
 ↓
REVIEW
 ↓
APPROVED
 ↓
PUBLISHED
 ↓
UPDATE
 ↓
ARCHIVE
```

---

# 109. Content Ownership

Owner bertanggung jawab terhadap:

* accuracy;
* portfolio status;
* company information;
* contact;
* published claims.

---

# BAGIAN AD — QA

# 110. QA Categories

```text
Functional
Responsive
Browser
Performance
SEO
Accessibility
Conversion
Security
Content
```

---

# 111. Functional Tests

Test:

* homepage;
* navigation;
* service;
* solution;
* portfolio;
* insight;
* FAQ;
* contact;
* WhatsApp;
* booth;
* 404.

---

# 112. Conversion Test

Harus diuji:

```text
CTA
 ↓
Destination
 ↓
WhatsApp/Form
 ↓
Submission
 ↓
Notification
```

---

# 113. Browser Test

Minimum:

* Chrome;
* Firefox;
* Edge;
* Android Chrome;
* iOS Safari jika tersedia.

---

# BAGIAN AE — LAUNCH

# 114. Launch Checklist

### Brand

* [ ] Logo
* [ ] Favicon
* [ ] Company description
* [ ] Contact
* [ ] WhatsApp

### Website

* [ ] Home
* [ ] About
* [ ] Services
* [ ] Solutions
* [ ] Portfolio
* [ ] Insight
* [ ] FAQ
* [ ] Contact
* [ ] Booth

### Content

* [ ] No lorem ipsum
* [ ] No placeholder
* [ ] Concept labels correct
* [ ] Proofread

### SEO

* [ ] Title
* [ ] Meta
* [ ] H1
* [ ] Sitemap
* [ ] Robots
* [ ] Canonical
* [ ] Internal links

### Analytics

* [ ] Page views
* [ ] CTA
* [ ] WhatsApp
* [ ] Form
* [ ] Booth tracking

### Technical

* [ ] HTTPS
* [ ] Backup
* [ ] Responsive
* [ ] 404
* [ ] Forms
* [ ] Performance

---

# BAGIAN AF — ONE WEEK EXECUTION

# 115. Day 1

**Foundation**

```text
Sitemap
Content structure
Brand direction
Technical architecture
```

Output:

> structure terkunci.

---

# 116. Day 2

**Design System**

```text
Typography
Colors
Buttons
Cards
Header
Footer
Spacing
```

---

# 117. Day 3

**Core Website**

```text
Home
About
Services
Contact
```

---

# 118. Day 4

**Portfolio**

```text
Portfolio archive
Portfolio detail
8 concept projects
Mockups
```

---

# 119. Day 5

**Marketing**

```text
Solutions
Insight
FAQ
Booth
```

---

# 120. Day 6

**Marketing Infrastructure**

```text
SEO
Analytics
WhatsApp
Forms
n8n foundation
```

---

# 121. Day 7

**QA + Launch**

```text
Functional QA
Mobile QA
SEO QA
Conversion QA
Backup
Launch
```

---

# BAGIAN AG — SCOPE CONTROL

# 122. Must Have

```text
Home
Services
Portfolio
Contact
WhatsApp
Booth
Mobile
SEO Basic
```

---

# 123. Should Have

```text
About
Solutions
FAQ
Insight
Analytics
```

---

# 124. Post-Launch

```text
Advanced n8n
CRM
Advanced analytics
Advanced filtering
Personalized content
Customer portal
```

---

# 125. Feature Freeze

Setelah hari ke-5:

> **Tidak boleh menambah fitur besar.**

Hanya:

* bug;
* content;
* SEO;
* performance;
* QA.

---

# BAGIAN AH — MAINTENANCE

# 126. Weekly

* cek lead;
* cek WhatsApp;
* cek form;
* cek error;
* cek website.

---

# 127. Monthly

* update WordPress;
* update plugins;
* backup;
* review analytics;
* publish content;
* broken-link check.

---

# 128. Quarterly

* update portfolio;
* update services;
* update solutions;
* SEO audit;
* performance audit;
* conversion review;
* backup recovery test.

---

# BAGIAN AI — POST-LAUNCH ROADMAP

# 129. 0–30 Days

Fokus:

```text
Stability
Lead
UX
Analytics
```

---

# 130. 31–60 Days

Fokus:

```text
SEO
Insight
Portfolio
Internal Linking
```

---

# 131. 61–90 Days

Fokus:

```text
Content Clusters
n8n
Campaign Landing Pages
Lead Optimization
```

---

# 132. 90+ Days

Jika traffic dan lead sudah terbukti:

```text
CRM
Automation
Advanced Analytics
Better Hosting
Customer Portal
```

---

# BAGIAN AJ — FINAL PRODUCT RULES

# 133. Rule 01 — Business First

Semua copy harus menjawab:

> Apa manfaatnya bagi bisnis?

---

# 134. Rule 02 — Never Fake Proof

Concept tetap concept.

---

# 135. Rule 03 — CTA Always Available

Pengunjung selalu mempunyai jalan menuju:

> konsultasi.

---

# 136. Rule 04 — Mobile First

Khususnya `/booth/`.

---

# 137. Rule 05 — Content Must Be Useful

Jangan membuat artikel hanya untuk mengejar keyword.

---

# 138. Rule 06 — AI Requires Review

n8n membantu produksi.

Manusia tetap bertanggung jawab atas publikasi.

---

# 139. Rule 07 — Keep Architecture Portable

Jangan membuat website bergantung pada InfinityFree.

---

# 140. Rule 08 — Minimize Complexity

Jangan membangun sistem yang sebenarnya belum dibutuhkan.

---

# BAGIAN AK — DEFINITION OF READY

# 141. Page Ready

Page boleh masuk development jika:

* objective jelas;
* audience jelas;
* content outline ada;
* CTA jelas;
* visual direction ada;
* acceptance criteria ada.

---

# BAGIAN AL — DEFINITION OF DONE

# 142. Page Done

Page selesai apabila:

* content final;
* responsive;
* CTA bekerja;
* links bekerja;
* SEO metadata tersedia;
* image optimized;
* mobile tested;
* no critical errors.

---

# BAGIAN AM — DEFINITION OF PRODUCT DONE

# 143. Website Done

Website secara keseluruhan dianggap selesai apabila:

```text
Brand
✓

Content
✓

Design
✓

CMS
✓

Portfolio
✓

SEO
✓

Analytics
✓

Lead Generation
✓

WhatsApp
✓

Booth
✓

Mobile
✓

Security
✓

Backup
✓

QA
✓

Launch
✓
```

---

# BAGIAN AN — ACCEPTANCE CRITERIA FINAL

# 144. Business Acceptance

Pengunjung harus dapat memahami:

> AKDISI siapa.

> AKDISI melakukan apa.

> AKDISI relevan untuk siapa.

> Bagaimana AKDISI bekerja.

> Bagaimana menghubungi AKDISI.

---

# 145. Marketing Acceptance

Website harus memiliki:

* clear positioning;
* relevant solution pages;
* portfolio;
* CTA;
* lead capture;
* booth landing page;
* SEO foundation.

---

# 146. Technical Acceptance

Website harus:

* responsive;
* secure;
* manageable;
* portable;
* backed up;
* measurable.

---

# 147. Content Acceptance

Tidak boleh terdapat:

* lorem ipsum;
* placeholder;
* fake client;
* fake testimonial;
* fake statistics;
* misleading portfolio.

---

# BAGIAN AO — FINAL INFORMATION MODEL

Secara konseptual website terdiri dari:

```text
                    AKDISI
                      │
        ┌─────────────┼─────────────┐
        │             │             │
       BRAND       SERVICES      SOLUTIONS
        │             │             │
      About           │         Industry
                      │             │
                      └──────┬──────┘
                             │
                         PORTFOLIO
                             │
                         INSIGHT
                             │
                          TRUST
                             │
                           CTA
                             │
                    ┌────────┴────────┐
                    │                 │
                WhatsApp             Form
                    │                 │
                    └────────┬────────┘
                             │
                            LEAD
                             │
                       CONSULTATION
                             │
                           SALES
```

---

# BAGIAN AP — FINAL CONTENT MODEL

```text
PAGE
 ├── Home
 ├── About
 ├── Contact
 ├── FAQ
 └── Booth

SERVICE
 ├── Application Development
 ├── Business Process Digitalization
 ├── Data & Administration
 └── Custom Solutions

SOLUTION
 ├── Housing
 ├── Developer
 ├── Property
 └── Organization

PORTFOLIO
 ├── Concept
 ├── Demo
 └── Actual

INSIGHT
 ├── Industry
 ├── Problem
 ├── Education
 └── Strategy
```

---

# BAGIAN AQ — FINAL CONVERSION ARCHITECTURE

Seluruh website akhirnya bermuara ke:

```text
                TRAFFIC
                   │
        ┌──────────┼──────────┐
        │          │          │
      Google     Booth     Referral
        │          │          │
        └──────────┼──────────┘
                   ▼
                 WEBSITE
                   │
             RELEVANCE
                   │
                PROOF
                   │
                 TRUST
                   │
                  CTA
                   │
        ┌──────────┴──────────┐
        │                     │
     WhatsApp               Form
        │                     │
        └──────────┬──────────┘
                   ▼
                  LEAD
                   │
              QUALIFICATION
                   │
              CONSULTATION
                   │
                 SALES
```

---

# BAGIAN AR — FINAL DESIGN PRINCIPLE

Website AKDISI harus terasa:

> **"perusahaan yang memahami bisnis dan mampu membangun sistem"**

bukan:

> **"jasa programmer yang mempunyai website."**

Ini adalah prinsip desain, copywriting, portfolio, dan UX yang paling penting.

---

# BAGIAN AS — FINAL PRIORITY MATRIX

| Elemen          |      Business Value | Priority |
| --------------- | ------------------: | -------- |
| Homepage        |       Sangat tinggi | P0       |
| WhatsApp CTA    |       Sangat tinggi | P0       |
| Portfolio       |       Sangat tinggi | P0       |
| Services        |       Sangat tinggi | P0       |
| Booth           |       Sangat tinggi | P0       |
| Contact         |       Sangat tinggi | P0       |
| Solutions       |              Tinggi | P1       |
| About           |              Tinggi | P1       |
| Insight         |              Tinggi | P1       |
| FAQ             |              Medium | P1       |
| n8n             |              Medium | P2       |
| CRM             | Rendah untuk launch | P3       |
| Customer Portal |    Tidak diperlukan | P4       |

---

# BAGIAN AT — FINAL DECISION LOG

Keputusan yang dikunci dalam PRD ini:

1. **Website adalah B2B marketing platform.**
2. **Business process lebih penting daripada teknologi.**
3. **Services dan Solutions dipisahkan.**
4. **Portfolio menjadi proof mechanism.**
5. **Concept portfolio wajib diberi label.**
6. **Booth memiliki landing page khusus.**
7. **WhatsApp menjadi primary CTA.**
8. **Form menjadi secondary lead channel.**
9. **n8n digunakan untuk content operation.**
10. **AI tidak auto-publish secara default.**
11. **WordPress menjadi pilihan CMS awal.**
12. **InfinityFree hanya menjadi hosting awal.**
13. **Architecture harus migration-ready.**
14. **Mobile menjadi prioritas tinggi.**
15. **SEO dibangun dari struktur website, bukan hanya plugin SEO.**
16. **Fake proof dilarang.**
17. **MVP harus sederhana.**
18. **Feature freeze dilakukan sebelum launch.**
19. **Analytics harus mengukur conversion, bukan hanya traffic.**
20. **Setelah PRD ini tidak diperlukan PRD versi berikutnya.**

---

# BAGIAN AU — MASTER IMPLEMENTATION ORDER

Mulai dari sini, **jangan membuat PRD baru lagi**.

Urutan kerja resmi proyek:

```text
                    FINAL MASTER PRD
                           │
                           ▼
                  01. SITEMAP FINAL
                           │
                           ▼
                  02. USER FLOW FINAL
                           │
                           ▼
                03. CONTENT SPECIFICATION
                           │
                           ▼
                  04. WIREFRAME
                           │
                           ▼
                05. UI DESIGN SYSTEM
                           │
                           ▼
             06. WORDPRESS ARCHITECTURE
                           │
                           ▼
              07. CONTENT IMPLEMENTATION
                           │
                           ▼
                    08. DEVELOPMENT
                           │
             ┌─────────────┼─────────────┐
             ▼             ▼             ▼
            SEO           n8n        ANALYTICS
             │             │             │
             └─────────────┼─────────────┘
                           ▼
                         QA
                           │
                           ▼
                        LAUNCH
                           │
                           ▼
                     MAINTENANCE
```

---

# BAGIAN AV — DOKUMEN YANG TIDAK LAGI DISEBUT PRD

Setelah **Final Master PRD ini**, dokumen kerja berikut boleh dibuat, tetapi **bukan PRD baru**:

### 01 — Sitemap & User Flow Specification

Menentukan seluruh halaman dan alur pengguna secara detail.

### 02 — Content Specification

Menentukan copy setiap section secara lengkap.

### 03 — Wireframe Specification

Menentukan struktur visual setiap halaman.

### 04 — UI Design System

Menentukan warna, typography, spacing, components, button, card, form, dsb.

### 05 — WordPress Technical Specification

Menentukan theme, content type, plugin, struktur CMS, template, deployment.

### 06 — SEO Implementation Specification

Menentukan keyword → URL → title → meta → schema → internal linking.

### 07 — n8n Workflow Specification

Menentukan workflow automation secara teknis.

### 08 — QA & Launch Checklist

Menentukan testing sebelum website dipublikasikan.

**Dokumen-dokumen tersebut adalah artefak implementasi dari PRD ini, bukan PRD V5.**

---

# STATUS AKHIR

## **PRD AKDISI Website: FINAL — LOCKED**

Saya akan menganggap dokumen ini sebagai **baseline final proyek AKDISI Website**.

Tidak perlu:

```text
PRD V5
PRD V6
PRD V7
PRD Final V2
PRD Final Revisi
```

lagi.

Mulai tahap berikutnya, kita tinggal **menurunkan PRD Final ini menjadi blueprint implementasi**.

Urutan yang paling tepat adalah:

> **Sitemap & User Flow Final → Content Specification → Wireframe → UI Design System → WordPress Technical Specification → Implementasi.**

Dengan demikian kita tidak lagi menghabiskan waktu membuat dokumen PRD berulang-ulang, tetapi langsung bergerak dari **requirement → design → development → launch**.
