# 01 — Sitemap & User Flow Specification

**Source:** PRD Final Master AKDISI Website v5.0, Section AU  
**Status:** Final  
**Date:** 2026-09-06  
**Reference:** PRD AKDISI Website v5.0.md

---

## TODO Checklist

### Sitemap
- [ ] Verify all URLs are correct
- [ ] Verify parent-child relationships
- [ ] Check for duplicate content
- [ ] Verify URL structure consistency
- [ ] Test all navigation links

### User Flows
- [ ] Map organic search flow
- [ ] Map booth/QR flow
- [ ] Map referral flow
- [ ] Map direct traffic flow
- [ ] Identify drop-off points
- [ ] Add missing CTAs

### Internal Linking
- [ ] Verify content graph connections
- [ ] Add related content blocks
- [ ] Check breadcrumb implementation
- [ ] Verify footer links

---

## PART A — SITEMAP

### Final Sitemap

```
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
│   └── {project-slug}/
│       ├── kawasanhub/
│       ├── propertiFlow/
│       ├── asosiasiConnect/
│       ├── wargaCare/
│       ├── salesProperty/
│       ├── dokumenProperti/
│       ├── projectMonitor/
│       └── propertiCare/
│
├── insight/
│   └── {article-slug}/
│       ├── digitalisasi-perumahan/
│       ├── digitalisasi-developer/
│       ├── property-management/
│       ├── business-process/
│       └── application-strategy/
│
├── faq/
│
├── contact/
│
└── booth/
```

### URL Rules

**Gunakan:**
```
/services/
/solutions/housing/
/portfolio/kawasanhub/
/insight/digitalisasi-perumahan/
```

**Hindari:**
```
/page?id=123
/post123
/project-final-v2
```

---

## PART B — PAGE LIST

### Core Pages (P0)

| # | Page | URL | Priority | Template |
|---|------|-----|----------|----------|
| 1 | Home | `/` | P0 | front-page.php |
| 2 | About | `/about/` | P1 | template-about.php |
| 3 | Services Index | `/services/` | P0 | template-services.php |
| 4 | Service Detail | `/services/{slug}/` | P0 | template-service.php |
| 5 | Portfolio Archive | `/portfolio/` | P0 | archive-portfolio.php |
| 6 | Portfolio Detail | `/portfolio/{slug}/` | P0 | single-portfolio.php |
| 7 | Contact | `/contact/` | P0 | template-contact.php |
| 8 | Booth | `/booth/` | P0 | template-booth.php |

### Secondary Pages (P1)

| # | Page | URL | Priority | Template |
|---|------|-----|----------|----------|
| 9 | Solutions Index | `/solutions/` | P1 | template-solutions.php |
| 10 | Solution Detail | `/solutions/{slug}/` | P1 | template-solution.php |
| 11 | Insight Archive | `/insight/` | P1 | archive-insight.php |
| 12 | Insight Detail | `/insight/{slug}/` | P1 | single-insight.php |
| 13 | FAQ | `/faq/` | P1 | template-faq.php |

### Content Types

| Type | Archive | Single | Slug Pattern |
|------|---------|--------|--------------|
| Service | `/services/` | `/services/{slug}/` | kebab-case |
| Solution | `/solutions/` | `/solutions/{slug}/` | kebab-case |
| Portfolio | `/portfolio/` | `/portfolio/{slug}/` | kebab-case |
| Insight | `/insight/` | `/insight/{slug}/` | kebab-case |
| FAQ | `/faq/` | - | - |

---

## PART C — NAVIGATION STRUCTURE

### Desktop Navigation

```
┌─────────────────────────────────────────────────────────────────────┐
│  LOGO                                        Services ▼ Solutions ▼ │
│  AKDISI.                                     Portfolio Insight About  │
│                                               [Konsultasi]         │
└─────────────────────────────────────────────────────────────────────┘
```

### Desktop Menu Items

| Position | Label | URL | Type | Children |
|----------|-------|-----|------|----------|
| 1 | Logo | `/` | link | - |
| 2 | Services | `/services/` | dropdown | 4 service pages |
| 3 | Solutions | `/solutions/` | dropdown | 4 solution pages |
| 4 | Portfolio | `/portfolio/` | link | - |
| 5 | Insight | `/insight/` | link | - |
| 6 | About | `/about/` | link | - |
| 7 | [Konsultasi] | `/contact/` | CTA button | - |

### Mobile Navigation

```
┌─────────────────────────────────────────────────────┐
│  LOGO                                    [MENU ☰]  │
│  AKDISI.                                              │
└─────────────────────────────────────────────────────┘
```

Mobile menu: hamburger → full-screen overlay with all links

### Footer Navigation

```
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│  AKDISI.                              Services               │
│  Custom Application Development      /services/              │
│  Partner                              /solutions/             │
│                                       /portfolio/            │
│  ────────────────────────────────────────────────────────── │
│                                                              │
│  Solutions               Contact              Legal            │
│  /solutions/housing/     WhatsApp             Privacy Policy   │
│  /solutions/developer/   Email                                 │
│  /solutions/property/    Location                               │
│  /solutions/organization                                     │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

---

## PART D — USER FLOWS

### Flow 1: Organic Search

```
┌─────────────┐
│   Google    │
│  Search     │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Website   │  ← Landing page based on keyword
│   Visit     │
└──────┬──────┘
       │
       ▼
┌─────────────────────────────────────────────────────────────┐
│                     CONTENT GRAPH                           │
│                                                             │
│   Insight ──► Solution ──► Portfolio ──► Service ──► CTA   │
│                                                             │
└──────┬─────────────────────────────────────────────────────┘
       │
       ▼
┌─────────────┐
│   CTA      │  ← WhatsApp or Form
│   Click    │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Lead     │
│   Generated│
└─────────────┘
```

### Flow 2: Booth/QR Code

```
┌─────────────┐
│   Booth    │
│   Event    │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   QR Scan  │  ← Links to /booth/
│             │  ← Campaign tracking: booth:source=X,medium=event
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  /booth/   │
│  Landing   │
└──────┬──────┘
       │
       ▼
┌─────────────────────────────────────────┐
│          BOOTH FLOW                     │
│                                         │
│   Problem → Solutions → Portfolio      │
│                                         │
│         → Why AKDISI → WhatsApp/Form   │
│                                         │
└──────┬──────────────────────────────────┘
       │
       ▼
┌─────────────┐
│   Lead     │
│   Generated│
└─────────────┘
```

### Flow 3: Referral

```
┌─────────────┐
│  Referral  │
│  (Link/    │
│   Mention) │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Home     │
│   /        │
└──────┬──────┘
       │
       ▼
┌──────────────────────────────────────┐
│        REFERRAL FLOW                  │
│                                        │
│   About / Services → Portfolio        │
│                                        │
│         → Contact → Consultation      │
│                                        │
└──────┬───────────────────────────────┘
       │
       ▼
┌─────────────┐
│   Lead     │
│   Generated│
└─────────────┘
```

### Flow 4: Direct Traffic

```
┌─────────────┐
│   Direct   │
│   Visit    │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Home     │
│   /        │
└──────┬──────┘
       │
       ▼
┌─────────────────────────────────────────────┐
│           DIRECT FLOW                         │
│                                              │
│   Explore → Services/Solutions → Portfolio   │
│                                              │
│         → About → Contact → Consultation     │
│                                              │
└──────┬──────────────────────────────────────┘
       │
       ▼
┌─────────────┐
│   Lead     │
│   Generated│
└─────────────┘
```

---

## PART E — CONTENT GRAPH (Internal Linking)

### Required Internal Links

```
INSIGHT
   │
   └──► SOLUTION (related)
           │
           └──► PORTFOLIO (related)
                   │
                   └──► SERVICE (related)
                           │
                           └──► CONTACT
```

### Related Content Rules

| Content Type | Must Link To |
|--------------|--------------|
| Insight | Related Insight, Related Solution, Related Portfolio |
| Solution | Related Solution, Related Service, Related Portfolio |
| Portfolio | Related Portfolio, Related Service, Related Solution |
| Service | Related Service, Related Solution, Related Portfolio |

### Breadcrumb Structure

| Page | Breadcrumb |
|------|------------|
| `/services/application-development/` | Home → Services → Application Development |
| `/solutions/housing/` | Home → Solutions → Housing |
| `/portfolio/kawasanhub/` | Home → Portfolio → KawasanHub |
| `/insight/digitalisasi-perumahan/` | Home → Insight → Digitalisasi Perumahan |

---

## PART F — CTA PLACEMENT

### Homepage CTAs

| Section | CTA | Destination |
|---------|-----|------------|
| Hero | Primary: Konsultasikan Kebutuhan Anda | `/contact/` |
| Hero | Secondary: Lihat Portfolio | `/portfolio/` |
| Services | Lihat Detail | `/services/{slug}/` |
| Solutions | Pelajari | `/solutions/{slug}/` |
| Portfolio | Lihat Detail | `/portfolio/{slug}/` |
| Final CTA | Konsultasikan Sekarang | `/contact/` |

### Inner Page CTAs

| Page | CTA Position | CTA Text | Destination |
|------|--------------|----------|-------------|
| Service | Bottom | Konsultasikan Kebutuhan | `/contact/` |
| Solution | Bottom | Konsultasikan Kebutuhan | `/contact/` |
| Portfolio | Bottom | Tertarik dengan solusi serupa? | `/contact/` |
| Insight | Bottom | Konsultasikan Kebutuhan | `/contact/` |
| About | Bottom | Hubungi AKDISI | `/contact/` |
| FAQ | Bottom | Masih punya pertanyaan? | `/contact/` |

### Sticky CTA (Mobile)

```
┌─────────────────────────────────────────────┐
│                                             │
│          [💬 WhatsApp AKDISI]              │
│                                             │
└─────────────────────────────────────────────┘
```

- Fixed at bottom of screen
- Visible on mobile only (hidden ≥768px)
- Always links to WhatsApp

---

## PART G — MOBILE PRIORITY

Mobile-first karena booth menggunakan QR code yang discan via smartphone.

### Mobile Page Priority

| Priority | Page | Reason |
|----------|------|--------|
| P0 | `/booth/` | Booth → QR → Mobile |
| P0 | `/contact/` | WhatsApp primary CTA |
| P0 | Home `/` | First impression |
| P1 | `/portfolio/` | Proof mechanism |
| P1 | `/services/` | Service discovery |
| P2 | `/solutions/` | Industry relevance |
| P2 | Insight | SEO content |
| P2 | `/about/` | Trust building |

### Mobile Layout Order (Homepage)

```
1. Hero + CTA
2. Solutions (horizontal scroll)
3. Portfolio (horizontal scroll)
4. Services (grid)
5. Process
6. CTA
7. Sticky WhatsApp
```

---

## PART H — REDIRECTS

### Redirect Map (if changing URLs)

| Old URL | New URL | Status |
|---------|---------|--------|
| `/home/` | `/` | 301 |
| `/services.html` | `/services/` | 301 |
| `/about-us/` | `/about/` | 301 |
| `/contact-us/` | `/contact/` | 301 |

---

## PART I — TECHNICAL NOTES

### WordPress Configuration

- Permalinks: `/%postname%/`
- Page for posts: None (CPT archives)
- Page for front page: Home (front-page.php)

### SEO Considerations

- All pages must be indexable except: booth (if noindex desired for campaign)
- Canonical URL on all pages
- Sitemap includes: pages, services, solutions, portfolio, insight
- Robots.txt allows all except wp-admin

---

## VERIFICATION CHECKLIST

Before marking complete:

- [ ] All URLs return 200 or appropriate status
- [ ] All navigation links work
- [ ] All CTAs point to correct destinations
- [ ] Breadcrumbs are accurate on all pages
- [ ] Mobile menu includes all pages
- [ ] Footer links are complete
- [ ] No orphan pages (unreachable from navigation)
- [ ] Related content blocks populated
- [ ] 404 page tested
