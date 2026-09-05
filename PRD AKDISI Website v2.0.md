**Product Requirements Document (PRD): AKDISI Corporate Website V2.0**

*Asumsi Eksplisit: Diasumsikan bahwa domain utama dan akun hosting (InfinityFree) sudah diamankan dan siap digunakan, serta tim memiliki aset logo/brand guidelines dasar untuk memulai iterasi desain.*

## 1. Deskripsi Produk dan Tujuan Utama

AKDISI Website V2.0 adalah sebuah platform *B2B digital marketing* dan *lead-generation* yang dirancang untuk mendukung aktivitas penjualan jasa pembuatan aplikasi bisnis. Platform ini difokuskan pada pasar perumahan, developer, manajemen properti, dan asosiasi di wilayah Jambi dan sekitarnya.

**Tujuan Utama:**

* **Establish Digital Presence & Credibility:** Menjadi wajah digital perusahaan yang profesional dan membangun kepercayaan (Trust) calon klien.
* **Lead Generation:** Mengkonversi pengunjung dari berbagai channel (Google, media sosial, *referral*, dan *booth/event* offline) menjadi prospek yang melakukan konsultasi (WhatsApp/Form).
* **Sales Enablement:** Menyediakan katalog portofolio (termasuk *concept/demo projects*) yang dapat digunakan langsung oleh tim sales saat melakukan *pitching* atau presentasi.

## 2. Target Pengguna dan Use Cases

**Target Pengguna Utama:**

* **Decision Maker (Owner/Director/Manager):** Mencari vendor IT yang memahami proses bisnis mereka, peduli pada efisiensi biaya, dan memiliki rekam jejak solusi yang relevan.
* **Operational Staff (Admin/Estate Manager):** Mencari solusi sistem untuk mengurangi pekerjaan manual dan pelaporan yang rumit; bertindak sebagai *influencer* ke manajemen.
* **Pengunjung Booth / Event Offline:** Audiens dengan waktu terbatas yang membutuhkan gambaran cepat tentang layanan AKDISI via pemindaian *QR code*.

**Use Cases:**

* **Event/Booth Visitor Journey:** Pengunjung memindai QR di *booth* fisik → diarahkan ke halaman khusus (*Booth Landing Page*) → melihat contoh solusi → menekan CTA WhatsApp untuk konsultasi cepat.
* **Direct Sales Journey:** Tim sales AKDISI membuka website saat *meeting* tatap muka → mendemonstrasikan halaman "Portfolio" sesuai industri klien → memicu diskusi teknis.
* **Organic Search Journey:** Pengguna mencari "jasa pembuatan aplikasi perumahan Jambi" di Google → masuk ke artikel *Insight* atau halaman *Solutions* → melihat portofolio terkait → mengisi Form konsultasi.

## 3. Fitur Utama dan Requirements Fungsional

**A. Core Pages & Information Architecture (P0 / MVP)**

* **Homepage:** Menampilkan *Hero section* berorientasi masalah klien, proposisi nilai, daftar layanan, *featured portfolio*, proses kerja (6 tahap), dan FAQ.
* **Services Page:** Halaman detail untuk 4 pilar layanan utama (Pengembangan Aplikasi, Digitalisasi Proses, Sistem Data & Admin, Custom Solution).
* **Portfolio & Detail Pages:** Katalog minimum 6-8 proyek. **Business Rule Mutlak:** Proyek fiktif/demo harus dilabeli secara transparan sebagai "Concept Project" atau "Demo Solution" tanpa menggunakan logo/data nyata tanpa izin.
* **Booth Landing Page:** Halaman konversi cepat tanpa navigasi rumit (tanpa blog/header panjang) khusus untuk lalu lintas QR Code.
* **Insight/Blog & FAQ:** Pusat edukasi dan penanganan keraguan klien (*objection handling*).

**B. Lead Generation & Conversion Mechanism**

* **WhatsApp CTA (Primary):** Tombol klik-ke-WhatsApp dengan *pre-filled message* dinamis berdasarkan halaman sumber (misal: "Halo AKDISI, saya dari booth...").
* **Lead Form (Secondary):** Formulir kontak minimalis (Nama, Organisasi, WhatsApp, Kebutuhan) yang memberikan notifikasi *success* jelas dan menangkap data *lead*.

**C. CMS & Content Governance**

* **Platform WordPress:** Memungkinkan admin (Owner/Editor) melakukan CRUD (Create, Read, Update, Delete) pada Halaman, Portofolio, Artikel, dan FAQ tanpa *coding*.
* **Status Konten:** Alur publikasi wajib mendukung *Draft → Human Review → Published*, terutama jika menggunakan *AI-generated content* di masa depan.

**D. Technical & SEO Requirements**

* **Local & Problem-Intent SEO:** Implementasi *Unique Title, Meta Description, H1/H2*, optimasi alt teks gambar, dan struktur URL yang menargetkan *keyword* lokal Jambi serta masalah industri.
* **Mobile-First Experience:** Tombol mudah disentuh (*touch-friendly*), gambar proporsional, dan form sederhana pada *viewport* 360px - 414px.

## 4. Success Metrics dan KPIs

* **North Star Metric:** *Qualified Consultation Leads* (Jumlah prospek valid yang masuk untuk konsultasi per bulan).
* **Acquisition Metrics:** Jumlah pemindaian QR Booth yang sukses memuat halaman (*booth visits*); Persentase traffic organik vs *referral*.
* **Engagement Metrics:** Jumlah tampilan detail Portofolio (*Portfolio Views*).
* **Conversion Metrics:** Rasio klik CTA WhatsApp (*WhatsApp Clicks*); Jumlah pengisian Formulir kontak yang berhasil (*Form Submissions*).

## 5. Timeline dan Prioritas

**Prioritas Rilis:**

* **P0 (MVP - Launch Blocker):** Halaman inti (Home, About, Services, Portfolio, Contact, Booth), UI responsif, WhatsApp/Form CTA berfungsi, platform WordPress, HTTPS, Basic SEO.
* **P1 (Post-Launch):** Insight/Blog lengkap, Halaman Solutions spesifik industri, Advanced Analytics (Google Search Console).
* **P2 (Future Roadmap):** Automasi n8n untuk konten, integrasi CRM, dan *Marketing Automation*.

**Timeline 1-Minggu Delivery Plan (MVP):**

* **Day 1:** Product Definition & Content Hierarchy finalisasi.
* **Day 2:** Foundation (Setup WordPress, Theme, Global Styles).
* **Day 3:** Pembuatan Core Pages (Home, Services, About, Contact).
* **Day 4:** Setup Portfolio (struktur, 6-8 *concept projects*, *UI mockups*).
* **Day 5:** Conversion System (Halaman Booth, WhatsApp Link, Form tracking).
* **Day 6:** SEO Optimization & Quality Assurance (QA).
* **Day 7:** Go-Live, Final Backup, DNS/SSL check, dan Booth QR Testing.

## 6. Dependencies dan Risks

| Risiko / Kendala | Dampak | Strategi Mitigasi |
| --- | --- | --- |
| **Transparansi Portofolio** (Proyek konsep dianggap menipu) | Tinggi | Wajib menggunakan label *Concept/Demo* secara eksplisit; larangan keras penggunaan logo *real* tanpa izin. |
| **Keterbatasan Hosting (InfinityFree)** | Sedang | *Minimum viable plugin stack*; optimasi ukuran gambar; implementasi *caching*; persiapan arsitektur *migration-ready*. |
| **Konversi Rendah (Traffic ada, lead tidak ada)** | Tinggi | Optimasi Halaman Booth; menyederhanakan *field* pada Form Kontak; pastikan tombol WhatsApp selalu terlihat (sticky) di *mobile*. |
| **Spam pada Formulir Kontak** | Sedang | Pemasangan lapisan keamanan Form (*Anti-spam/Honeypot*) yang ringan. |

## 7. Acceptance Criteria (Definition of Done)

Fitur dinyatakan selesai dan siap diluncurkan jika memenuhi kriteria berikut:

* **Fungsional & Konversi:**
* Tombol CTA WhatsApp berhasil membuka aplikasi dengan *template* pesan yang benar.
* Form Contact dapat divalidasi (menolak input kosong pada *mandatory field*) dan memunculkan *success message* saat disubmit.
* Halaman `/booth` dapat diakses langsung dari QR code tanpa *redirect* error.


* **Portofolio & Konten:**
* Minimal 6 proyek portofolio tersedia dan dapat diakses dengan lancar.
* Semua proyek *demo* telah memiliki atribut visual (mockup) dan label "Concept Project" yang jelas.
* Tidak ada teks *placeholder* (lorem ipsum) yang tersisa di halaman P0.


* **Teknis & UX:**
* Website memuat dengan baik di resolusi *mobile* (diuji di 360px dan 390px) tanpa ada elemen teks atau gambar yang terpotong (*overflow*).
* CMS WordPress mengizinkan penambahan portofolio dan artikel baru tanpa merusak *layout* global.
* HTTPS/SSL aktif dan seluruh navigasi utama (*header/footer*) tidak menghasilkan *error 404*.


* **SEO & Analytics:**
* URL *canonical*, Meta Deskripsi, dan *Tag H1* unik terpasang pada semua halaman P0.
* *Event tracking* minimum (CTA klik, *form submit*, *whatsapp click*) terdeteksi di sistem analitik yang dikonfigurasi.