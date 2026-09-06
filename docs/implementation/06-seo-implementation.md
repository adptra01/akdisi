# 06 — SEO Implementation Specification

**Source:** PRD Final Master AKDISI Website v5.0  
**Status:** Final  
**Date:** 2026-09-06  
**Reference:** PRD AKDISI Website v5.0.md, Sections 52–58

---

## TODO Checklist

### Technical SEO
- [ ] Sitemap.xml
- [ ] Robots.txt
- [ ] Canonical URLs
- [ ] SSL/HTTPS
- [ ] Page speed optimization
- [ ] Core Web Vitals
- [ ] Structured data

### On-Page SEO
- [ ] Title tags
- [ ] Meta descriptions
- [ ] H1/H2/H3 hierarchy
- [ ] Alt text for images
- [ ] Internal linking
- [ ] URL structure

### Keyword Strategy
- [ ] Local keywords (Jambi)
- [ ] Industry keywords
- [ ] Problem keywords
- [ ] Search intent mapping

### Content SEO
- [ ] Insight articles
- [ ] Portfolio pages
- [ ] Service pages
- [ ] Solution pages
- [ ] Internal linking structure

### Off-Page SEO
- [ ] Open Graph tags
- [ ] Social media
- [ ] Backlink strategy
- [ ] Local SEO

---

## PART A — SEO STRATEGY

### Four Pillars

```
LOCAL          → Jambi and surrounding area
INDUSTRY       → Developer, housing, property, organization
PROBLEM        → Manual processes, data scattered
EDUCATION      → Insight articles, guides
```

### Search Intent Mapping

| Intent | Destination | Example Keyword |
|--------|-------------|-----------------|
| Brand | Home | AKDISI, AKAR Digital Solusi |
| Commercial | Services | jasa pembuatan aplikasi |
| Industry | Solutions | aplikasi perumahan |
| Proof | Portfolio | project management |
| Informational | Insight | digitalisasi perumahan |
| Conversion | Contact | konsultasi aplikasi |
| Campaign | Booth | booth event |

---

## PART B — KEYWORD STRATEGY

### Local Keywords

```
jasa pembuatan aplikasi Jambi
jasa pembuatan sistem Jambi
pengembangan aplikasi Jambi
software house Jambi
developer aplikasi Jambi
jasa aplikasi bisnis Jambi
```

### Industry Keywords

```
aplikasi perumahan
sistem pengelolaan perumahan
aplikasi developer perumahan
sistem properti
property management
aplikasi organisasi
aplikasi asosiasi
```

### Problem Keywords

```
digitalisasi administrasi perumahan
sistem pengaduan perumahan
sistem data penghuni
sistem monitoring developer
digitalisasi administrasi organisasi
```

### Long-Tail Keywords

```
jasa aplikasi untuk developer properti
sistem pengelolaan perumahan Jambi
aplikasi custom untuk organisasi
software house Jambi aplikasi bisnis
jasa pembuatan sistem monitoring developer
```

---

## PART C — ON-PAGE SEO REQUIREMENTS

### Title Tag Format

```
[Page Name] - [Service/Solution] | AKDISI
```

Examples:

- Home: `Solusi Aplikasi untuk Bisnis Properti dan Perumahan | AKDISI`
- Services: `Layanan - Custom Application Development | AKDISI`
- Portfolio: `Portfolio - Project Portfolio AKDISI`
- Insight: `Insight - Digitalisasi Perumahan & Developer`
- About: `About AKDISI - Custom Application Development Partner`
- Contact: `Kontak - Konsultasikan Kebutuhan Anda | AKDISI`

### Meta Description Format

```
[Brief description of service/solution, 150-160 characters]
```

Examples:

- Home: `AKDISI membantu organisasi dan bisnis membangun solusi aplikasi yang disesuaikan dengan proses operasional mereka. Custom application development partner.`
- Services: `Jasa pembuatan aplikasi custom untuk bisnis properti dan perumahan. Application development, business process digitalization, data systems.`
- Portfolio: `Portfolio AKDISI - project nyata untuk developer, perumahan, properti, dan organisasi. Custom solutions that work.`
- Insight: `Insight - artikel tentang digitalisasi perumahan, developer, property management, dan strategi aplikasi bisnis.`
- About: `AKDISI - Custom application development partner untuk bisnis properti dan perumahan. Konsultasikan kebutuhan Anda.`
- Contact: `Hubungi AKDISI untuk konsultasi kebutuhan aplikasi. WhatsApp, form, atau kunjungi langsung.`

### Heading Hierarchy

```
H1: One per page, unique, descriptive
H2: Section headings, 2-5 per page
H3: Subsection headings, as needed
H4-H6: Rarely used
```

### Image Optimization

```html
<img src="image.webp" 
     alt="Descriptive alt text with keyword" 
     title="Descriptive title"
     width="800" 
     height="600"
     loading="lazy"
     decoding="async">
```

### Internal Linking

Every page must have:

- [ ] Link to Home
- [ ] Link to Services
- [ ] Link to relevant Solution
- [ ] Link to relevant Portfolio
- [ ] Link to Contact
- [ ] Breadcrumb navigation

---

## PART D — TECHNICAL SEO

### Sitemap.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://akdisi.com/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://akdisi.com/services/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://akdisi.com/solutions/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://akdisi.com/portfolio/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>https://akdisi.com/insight/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>https://akdisi.com/about/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  <url>
    <loc>https://akdisi.com/contact/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
  <url>
    <loc>https://akdisi.com/booth/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  <!-- Portfolio items -->
  <url>
    <loc>https://akdisi.com/portfolio/kawasanhub/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  <!-- Insight articles -->
  <url>
    <loc>https://akdisi.com/insight/digitalisasi-perumahan/</loc>
    <lastmod>2026-09-06</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
</urlset>
```

### Robots.txt

```txt
User-agent: *
Allow: /
Disallow: /wp-admin/
Disallow: /wp-includes/
Disallow: /wp-content/plugins/
Disallow: /wp-content/themes/akdisi/inc/
Disallow: /wp-login.php
Disallow: /wp-cron.php

Sitemap: https://akdisi.com/sitemap.xml
```

### Canonical URLs

```html
<link rel="canonical" href="https://akdisi.com/solutions/housing/" />
```

### SSL/HTTPS

- [ ] SSL certificate installed
- [ ] HTTPS redirect enforced
- [ ] HSTS header enabled
- [ ] SSL certificate valid
- [ ] Mixed content fixed

---

## PART E — STRUCTURED DATA (Schema.org)

### Organization Schema

```json
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "AKAR Digital Solusi (AKDISI)",
  "url": "https://akdisi.com",
  "description": "Custom application development partner untuk bisnis properti dan perumahan",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Jambi",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+62-xxx-xxx-xxxx",
    "contactType": "sales",
    "availableLanguage": ["id", "en"]
  },
  "sameAs": [
    "https://wa.me/62xxx",
    "https://instagram.com/akdisi"
  ]
}
```

### Service Schema

```json
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Application Development",
  "description": "Pembangunan aplikasi yang dirancang berdasarkan kebutuhan bisnis",
  "provider": {
    "@type": "Organization",
    "name": "AKAR Digital Solusi"
  },
  "category": "Application Development",
  "areaServed": "Jambi, Indonesia"
}
```

### FAQ Schema

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Berapa lama pembuatan aplikasi?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tergantung kompleksitas dan kebutuhan..."
      }
    }
  ]
}
```

### Breadcrumb Schema

```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "https://akdisi.com/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Services",
      "item": "https://akdisi.com/services/"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Application Development",
      "item": "https://akdisi.com/services/application-development/"
    }
  ]
}
```

---

## PART F — CONTENT SEO

### Insight Articles

5 initial articles (PRD §51):

1. **Kapan Pengelolaan Perumahan Membutuhkan Sistem Digital?**
   - Pillar: Digitalisasi perumahan
   - Target keyword: sistem digital perumahan
   - Length: 1500-2000 words

2. **Masalah Administrasi Developer yang Dapat Didigitalisasi**
   - Pillar: Digitalisasi developer
   - Target keyword: digitalisasi administrator developer
   - Length: 1500-2000 words

3. **Apa yang Perlu Dipersiapkan Sebelum Membuat Aplikasi Bisnis?**
   - Pillar: Application strategy
   - Target keyword: persiapan aplikasi bisnis
   - Length: 1500-2000 words

4. **Sistem Informasi untuk Pengelolaan Organisasi**
   - Pillar: Business process
   - Target keyword: sistem informasi organisasi
   - Length: 1500-2000 words

5. **Aplikasi Custom vs Software Siap Pakai**
   - Pillar: Application strategy
   - Target keyword: aplikasi custom vs siap pakai
   - Length: 1500-2000 words

### Content Optimization Rules

- Keyword density: 1-2%
- Use keyword in H1, first paragraph, and conclusion
- Internal links: 3-5 per article
- External links: 1-2 per article (authoritative sources)
- Image alt text with keyword
- Meta description 150-160 characters
- URL slug: kebab-case, no spaces

---

## PART G — ANALYTICS & MONITORING

### Google Analytics 4 Events

```javascript
// Page view
gtag('event', 'page_view', {
  page_title: document.title,
  page_location: window.location.href,
  page_referrer: document.referrer
});

// CTA click
gtag('event', 'cta_click', {
  cta_name: 'konsultasi',
  page: window.location.pathname
});

// WhatsApp click
gtag('event', 'whatsapp_click', {
  source: 'sticky_cta'
});

// Form submit
gtag('event', 'form_submit', {
  form_name: 'contact_form'
});
```

### Google Search Console

- [ ] Verify ownership
- [ ] Submit sitemap.xml
- [ ] Monitor indexing
- [ ] Check for crawl errors
- [ ] Monitor Core Web Vitals
- [ ] Track keyword rankings

### SEO Audit Checklist

| Audit Item | Frequency | Tool |
|------------|-----------|------|
| Page speed | Monthly | Lighthouse |
| Broken links | Weekly | Screaming Frog |
| Index status | Monthly | Google Search Console |
| Keyword ranking | Monthly | Ahrefs/SEMrush |
| Content gap | Quarterly | Ahrefs/SEMrush |
| Technical SEO | Quarterly | Screaming Frog |
| Backlink profile | Monthly | Ahrefs |

---

## PART H — IMPLEMENTATION PRIORITY

### Phase 1: Technical Foundation (P0)

1. SSL/HTTPS setup
2. Sitemap.xml
3. Robots.txt
4. Canonical URLs
5. Structured data
6. Speed optimization

### Phase 2: Content SEO (P1)

1. Title tags and meta descriptions
2. Heading hierarchy
3. Alt text for images
4. Internal linking
5. Insight articles (5)
6. Portfolio SEO

### Phase 3: Advanced SEO (P2)

1. Keyword tracking
2. Backlink strategy
3. Local SEO (Google Business Profile)
4. Schema markup expansion
5. Content clusters
6. Advanced analytics

---

## PART I — LOCAL SEO

### Google Business Profile

- [ ] Create profile
- [ ] Verify business
- [ ] Add business info
- [ ] Upload photos
- [ ] Post updates
- [ ] Collect reviews

### Local Citation

- [ ] Company name: AKAR Digital Solusi (AKDISI)
- [ ] Address: Jambi, Indonesia
- [ ] Phone: [number]
- [ ] Email: info@akdisi.com
- [ ] Website: https://akdisi.com

---

## PART J — VERIFICATION CHECKLIST

Before marking SEO spec complete:

- [ ] All pages have unique title tags
- [ ] All pages have meta descriptions
- [ ] Heading hierarchy correct
- [ ] Alt text on all images
- [ ] Internal links work
- [ ] Sitemap.xml valid
- [ ] Robots.txt correct
- [ ] Canonical URLs set
- [ ] Structured data valid
- [ ] SSL/HTTPS enabled
- [ ] Speed targets met
- [ ] Analytics tracking working
- [ ] Search Console verified
- [ ] Keyword research complete
- [ ] Content SEO strategy documented
