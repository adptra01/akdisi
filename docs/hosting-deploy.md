# AKDISI Website — Hosting & Deployment

Target deployment: **InfinityFree** (shared hosting, nginx) — migration-ready,
tanpa ketergantungan pada plugin atau fitur khusus DDEV.

---

## 1. Arsitektur Deployment

```
Hosting (nginx + PHP 8.x + MariaDB)
├── wordpress/            → docroot (seluruh isi folder wordpress/)
│   ├── robots.txt        → fisik (nginx tidak serve virtual robots — wajib file)
│   ├── wp-content/
│   │   ├── themes/akdisi/   → theme custom
│   │   └── uploads/         → media (favicon, gambar)
└── database              → export .sql dari DDEV
```

**Stack:** WordPress core (standar), theme `akdisi`, **0 plugin aktif** (PRD §104).
Tidak ada cron WP, tidak ada background job, tidak ada layanan eksternal wajib
selain Google Fonts (Plus Jakarta Sans) — jika hosting memblokir, font fallback
ke sistem (dapat di-self-host).

---

## 2. Langkah Deploy ke InfinityFree (atau hosting serupa)

1. **Export database:**
   ```bash
   docker exec ddev-akdisi-db mysqldump -uroot -proot akdisi > akdisi.sql
   ```
2. **Upload:** seluruh isi `wordpress/` (bukan folder `wordpress/` itu sendiri)
   ke folder `htdocs/` via file manager / FTP.
3. **Import database** via phpMyAdmin InfinityFree → `Import`.
4. **Edit `wp-config.php`:** DB name/user/pass host (InfinityFree: `sqlXXX.infinityfree.com`).
5. **Update URL** (Home + Site Address) di admin → Settings → General, atau:
   ```bash
   wp option update home 'https://akdisi.co.id'
   wp option update siteurl 'https://akdisi.co.id'
   ```
6. **Ganti referensi domain lama** di database (opsional jika pindah domain):
   ```bash
   wp search-replace 'https://akdisi.ddev.site:8443' 'https://akdisi.co.id' --all-tables
   ```
7. **Verifikasi:** `https://<domain>/wp-sitemap.xml`, `/robots.txt`, favicon,
   semua halaman 200.

---

## 3. Checklist Post-Deploy

- [ ] `robots.txt` ada di docroot & merujuk Sitemap yang benar
- [ ] `site_icon` (favicon) ter-set
- [ ] Permalink structure = `/%postname%/` (Settings → Permalinks → simpan)
- [ ] GA4 ID terisi (Customize → akdisi_ga4_id) — ukur sesudah live
- [ ] Meta description & Open Graph sesuai (`wp_head`)
- [ ] Form kontak/booth test kirim (nonce inline errors work di server baru)
- [ ] SSL aktif (InfinityFree free SSL) — pastikan tidak mixed-content
- [ ] Backup pertama tersimpan

---

## 4. Backup Scope (PRD §102)

Backup rutin mencakup 5 area:
1. Database (mysqldump)
2. `wp-content/themes/akdisi/` (theme = seluruh kustomisasi)
3. `wp-content/uploads/` (media)
4. `wp-config.php`
5. `robots.txt`

Script backup lokal (DDEV):
```bash
#!/usr/bin/env bash
# backup-akdisi.sh
STAMP=$(date +%Y%m%d-%H%M)
mkdir -p backups/$STAMP
docker exec ddev-akdisi-db mysqldump -uroot -proot akdisi > backups/$STAMP/db.sql
tar -czf backups/$STAMP/theme.tar.gz -C wordpress/wp-content/themes akdisi
tar -czf backups/$STAMP/uploads.tar.gz -C wordpress/wp-content uploads
cp wordpress/wp-config.php wordpress/robots.txt backups/$STAMP/
```

---

## 5. Plugins

**0 plugin aktif** — keputusan desain (PRD §104 "minimum plugins"): kecepatan,
permukaan serangan kecil, migrasi tanpa dependency. Fitur (SEO meta, OG, sitemap,
form, leads, favicon, GA4) semua native/core atau di theme.
Lihat `docs/plugins.md` untuk detail rasional + daftar yang TIDAK diinstall dan why.

---

## 6. VPS / Docker (opsional, skala)

Bila lalu pindah ke VPS: cukup container nginx + PHP-FPM + MariaDB, serve docroot
yang sama, sertakan `robots.txt`. Ternary: tidak perlu konfigurasi khusus theme.
Perlu diingat: `wp-config.php` pada InfinityFree memakai host DB terpisah —
sesuaikan konstanta DB_HOST.