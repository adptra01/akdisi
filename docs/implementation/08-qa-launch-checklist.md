# 08 — QA & Launch Checklist

**Source:** PRD Final Master AKDISI Website v5.0  
**Status:** Final  
**Date:** 2026-09-06  
**Reference:** PRD AKDISI Website v5.0.md, Sections 110–114

---

## TODO Checklist

### Functional Testing
- [ ] Homepage loads correctly
- [ ] Navigation works
- [ ] All links functional
- [ ] Forms submit correctly
- [ ] WhatsApp CTA works
- [ ] Contact form works
- [ ] Booth page works
- [ ] 404 page works
- [ ] Search works (if implemented)
- [ ] Mobile menu works

### Responsive Testing
- [ ] Desktop (1920px)
- [ ] Laptop (1366px)
- [ ] Tablet (768px)
- [ ] Mobile (390px)
- [ ] Mobile landscape
- [ ] Tablet landscape

### Browser Testing
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Edge (latest)
- [ ] Safari (macOS/iOS)
- [ ] Android Chrome
- [ ] iOS Safari

### Performance Testing
- [ ] Page speed (Lighthouse)
- [ ] Image optimization
- [ ] CSS/JS minified
- [ ] Caching enabled
- [ ] CDN configured

### SEO Testing
- [ ] Title tags unique
- [ ] Meta descriptions present
- [ ] H1 hierarchy correct
- [ ] Alt text present
- [ ] Canonical URLs set
- [ ] Sitemap valid
- [ ] Robots.txt correct
- [ ] Structured data valid
- [ ] Google Search Console verified
- [ ] Internal links work

### Conversion Testing
- [ ] CTA clicks work
- [ ] WhatsApp opens
- [ ] Form submits
- [ ] Lead captured
- [ ] Notification sent
- [ ] Booth QR works

### Security Testing
- [ ] HTTPS enabled
- [ ] Form validation
- [ ] Sanitization working
- [ ] Nonce verification
- [ ] SQL injection test
- [ ] XSS test
- [ ] CSRF test

### Content Testing
- [ ] No lorem ipsum
- [ ] No placeholder text
- [ ] Concept labels correct
- [ ] Proofread
- [ ] Images optimized
- [ ] Alt text present
- [ ] Links correct

### Technical Testing
- [ ] Database backup
- [ ] WordPress updated
- [ ] Plugins updated
- [ ] Theme functional
- [ ] Permalinks working
- [ ] 404 page works
- [ ] Cache cleared
- [ ] SSL valid

---

## PART A — FUNCTIONAL TESTS

### Homepage Tests

| # | Test | Expected Result | Status |
|---|------|----------------|--------|
| 1 | Homepage loads | 200 OK | Pending |
| 2 | Navigation visible | Desktop + Mobile | Pending |
| 3 | CTA "Konsultasi" | Links to /contact/ | Pending |
| 4 | CTA "Lihat Portfolio" | Links to /portfolio/ | Pending |
| 5 | Hero section | Headlines visible | Pending |
| 6 | Problem cards | 5 cards visible | Pending |
| 7 | Approach flow | 6 steps visible | Pending |
| 8 | Solutions cards | 4 cards visible | Pending |
| 9 | Services cards | 4 cards visible | Pending |
| 10 | Portfolio showcase | 3-4 projects | Pending |
| 11 | Why AKDISI | 5 pillars visible | Pending |
| 12 | Process section | 6 steps visible | Pending |
| 13 | FAQ section | 7 questions | Pending |
| 14 | Final CTA | "Konsultasikan Sekarang" | Pending |
| 15 | Footer | All links present | Pending |

### Service Pages Tests

| # | Test | Expected Result | Status |
|---|------|----------------|--------|
| 1 | Services index | 4 service cards | Pending |
| 2 | Service detail | Hero + Content | Pending |
| 3 | Related services | Linked correctly | Pending |
| 4 | CTA | Links to contact | Pending |

### Solution Pages Tests

| # | Test | Expected Result | Status |
|---|------|----------------|--------|
| 1 | Solutions index | 4 solution cards | Pending |
| 2 | Solution detail | Hero + Content | Pending |
| 3 | Related solutions | Linked correctly | Pending |
| 4 | CTA | Links to contact | Pending |

### Portfolio Tests

| # | Test | Expected Result | Status |
|---|------|----------------|--------|
| 1 | Portfolio archive | 8 projects visible | Pending |
| 2 | Portfolio detail | Full project info | Pending |
| 3 | Status label | CONCEPT/DEMO/ACTUAL | Pending |
| 4 | Related content | Linked correctly | Pending |
| 5 | Gallery | Images visible | Pending |

### Contact/Booth Tests

| # | Test | Expected Result | Status |
|---|------|----------------|--------|
| 1 | Contact form | Fields visible | Pending |
| 2 | Form validation | Inline errors | Pending |
| 3 | Form submission | Success message | Pending |
| 4 | WhatsApp CTA | Opens WhatsApp | Pending |
| 5 | Booth page | Full page content | Pending |
| 6 | Booth QR | Links to /booth/ | Pending |

### 404 Tests

| # | Test | Expected Result | Status |
|---|------|----------------|--------|
| 1 | Invalid URL | 404 page | Pending |
| 2 | Back to Home button | Links to / | Pending |
| 3 | Contact link | Links to /contact/ | Pending |

---

## PART B — RESPONSIVE TESTING

### Breakpoints

| Device | Width | Priority |
|--------|-------|----------|
| Desktop | 1920px | P0 |
| Laptop | 1366px | P0 |
| Tablet | 768px | P0 |
| Mobile | 390px | P0 |
| Mobile landscape | 667px | P1 |
| Tablet landscape | 1024px | P1 |

### Mobile-Specific Tests

| # | Test | Expected Result | Status |
|---|------|----------------|--------|
| 1 | Sticky CTA | Visible on mobile | Pending |
| 2 | Hamburger menu | Opens/closes | Pending |
| 3 | Touch targets | ≥44px | Pending |
| 4 | Text readability | No zoom required | Pending |
| 5 | No horizontal scroll | Content fits width | Pending |
| 6 | Image scaling | Proper aspect ratio | Pending |
| 7 | Button accessibility | Tappable | Pending |

---

## PART C — BROWSER TESTING

| Browser | Version | Status |
|---------|---------|--------|
| Chrome | Latest | Pending |
| Firefox | Latest | Pending |
| Edge | Latest | Pending |
| Safari | macOS/iOS | Pending |
| Android Chrome | Latest | Pending |
| iOS Safari | Latest | Pending |

### Cross-Browser Issues

- [ ] CSS grid/flexbox
- [ ] JavaScript functionality
- [ ] Form validation
- [ ] Animations
- [ ] Font rendering
- [ ] Image display

---

## PART D — PERFORMANCE TESTING

### Lighthouse Targets

| Metric | Target | Current | Status |
|--------|--------|---------|--------|
| Performance | ≥90 | - | Pending |
| Accessibility | ≥95 | - | Pending |
| Best Practices | ≥90 | - | Pending |
| SEO | ≥95 | - | Pending |

### Page Weight

| Page | Target | Current | Status |
|------|--------|---------|--------|
| Homepage | <1MB | - | Pending |
| Service | <800KB | - | Pending |
| Portfolio | <1MB | - | Pending |
| Insight | <800KB | - | Pending |

### Core Web Vitals

| Metric | Target | Current | Status |
|--------|--------|---------|--------|
| LCP | <2.5s | - | Pending |
| FID | <100ms | - | Pending |
| CLS | <0.1 | - | Pending |

---

## PART E — SEO TESTING

### On-Page SEO Checklist

| # | Test | Expected | Status |
|---|------|----------|--------|
| 1 | Title tags | Unique per page | Pending |
| 2 | Meta descriptions | 150-160 chars | Pending |
| 3 | H1 hierarchy | One H1 per page | Pending |
| 4 | Alt text | All images | Pending |
| 5 | Canonical URLs | Set on all pages | Pending |
| 6 | Internal links | Working | Pending |
| 7 | Sitemap.xml | Valid XML | Pending |
| 8 | Robots.txt | Correct rules | Pending |
| 9 | Structured data | Valid JSON-LD | Pending |
| 10 | SSL/HTTPS | Valid certificate | Pending |

### Google Search Console

- [ ] Verify ownership
- [ ] Submit sitemap
- [ ] Check indexing
- [ ] Monitor errors
- [ ] Core Web Vitals
- [ ] Mobile usability

---

## PART F — CONVERSION TESTING

### CTA Flows

| # | Flow | Steps | Expected | Status |
|---|------|-------|----------|--------|
| 1 | WhatsApp click | CTA → WhatsApp | Opens chat | Pending |
| 2 | Form submit | Form → Submit | Success message | Pending |
| 3 | Booth QR | QR → /booth/ | Booth page | Pending |
| 4 | Portfolio CTA | CTA → contact | Lead generated | Pending |

### Lead Tracking

| # | Test | Expected | Status |
|---|------|----------|--------|
| 1 | Form submission | Lead saved | Pending |
| 2 | WhatsApp click | Tracked | Pending |
| 3 | Booth visit | Tracked | Pending |
| 4 | Source tracking | Correct | Pending |
| 5 | Campaign tracking | Working | Pending |

---

## PART G — SECURITY TESTING

### OWASP Top 10 Checks

| # | Test | Status |
|---|------|--------|
| 1 | SQL Injection | Pending |
| 2 | XSS | Pending |
| 3 | CSRF | Pending |
| 4 | Broken Authentication | Pending |
| 5 | Sensitive Data Exposure | Pending |
| 6 | XML External Entities | Pending |
| 7 | Broken Access Control | Pending |
| 8 | Security Misconfiguration | Pending |
| 9 | Cross-Site Scripting | Pending |
| 10 | Insecure Deserialization | Pending |

### WordPress Security

- [ ] Admin access restricted
- [ ] Strong passwords
- [ ] Two-factor authentication
- [ ] Login attempt limit
- [ ] File permissions correct
- [ ] WordPress updated
- [ ] Plugins updated
- [ ] Security headers set

---

## PART H — CONTENT TESTING

### Content Checklist

| # | Check | Status |
|---|-------|--------|
| 1 | No lorem ipsum | Pending |
| 2 | No placeholder text | Pending |
| 3 | Concept labels correct | Pending |
| 4 | Proofread | Pending |
| 5 | Images optimized | Pending |
| 6 | Alt text present | Pending |
| 7 | Links correct | Pending |
| 8 | CTAs working | Pending |
| 9 | Grammar/spelling | Pending |
| 10 | Brand consistency | Pending |

---

## PART I — LAUNCH CHECKLIST

### Pre-Launch

| # | Task | Owner | Status |
|---|------|-------|--------|
| 1 | All functional tests pass | Dev | Pending |
| 2 | All responsive tests pass | Dev | Pending |
| 3 | All browser tests pass | Dev | Pending |
| 4 | Performance targets met | Dev | Pending |
| 5 | SEO checks complete | SEO | Pending |
| 6 | Security checks complete | Security | Pending |
| 7 | Content proofread | Content | Pending |
| 8 | Backup created | Dev | Pending |
| 9 | DNS/SSL configured | Dev | Pending |
| 10 | Analytics verified | Dev | Pending |

### Launch Day

| # | Task | Owner | Status |
|---|------|-------|--------|
| 1 | Database backup | DBA | Pending |
| 2 | Deploy to production | Dev | Pending |
| 3 | Verify homepage | QA | Pending |
| 4 | Verify all links | QA | Pending |
| 5 | Verify forms | QA | Pending |
| 6 | Verify WhatsApp | QA | Pending |
| 7 | Verify SSL | Dev | Pending |
| 8 | Verify analytics | Dev | Pending |
| 9 | Verify SEO | SEO | Pending |
| 10 | Monitor for 24h | Dev | Pending |

### Post-Launch (1 Week)

| # | Task | Frequency | Status |
|---|------|-----------|--------|
| 1 | Check leads | Daily | Pending |
| 2 | Check WhatsApp | Daily | Pending |
| 3 | Check forms | Daily | Pending |
| 4 | Check errors | Daily | Pending |
| 5 | Check website | Daily | Pending |
| 6 | Review analytics | Weekly | Pending |
| 7 | Update WordPress | Monthly | Pending |
| 8 | Update plugins | Monthly | Pending |
| 9 | Backup | Weekly | Pending |
| 10 | SEO audit | Quarterly | Pending |

---

## PART J — ROLLBACK PLAN

### Rollback Triggers

- Critical bug blocking users
- Security breach
- Data loss
- Performance degradation >50%
- SEO penalty

### Rollback Steps

1. Identify issue
2. Stop deployment
3. Restore backup
4. Verify rollback
5. Fix issue
6. Re-deploy
7. Verify fix

### Backup Points

- [ ] Pre-launch backup
- [ ] Post-launch backup (1 day)
- [ ] Weekly backups
- [ ] Monthly backups

---

## PART K — SUCCESS CRITERIA

### Business Acceptance

- [ ] Homepage clearly communicates AKDISI value
- [ ] Services clearly explained
- [ ] Solutions relevant to target industry
- [ ] Portfolio shows proof
- [ ] CTA always visible
- [ ] WhatsApp works
- [ ] Form works
- [ ] Leads captured

### Technical Acceptance

- [ ] Responsive on all devices
- [ ] Secure (HTTPS, headers)
- [ ] Manageable (CMS)
- [ ] Portable (no vendor lock-in)
- [ ] Backed up
- [ ] Measurable (analytics)

### Content Acceptance

- [ ] No lorem ipsum
- [ ] No placeholder text
- [ ] No fake client/testimonial
- [ ] No fake statistics
- [ ] No misleading portfolio

---

## VERIFICATION CHECKLIST

Before marking QA spec complete:

- [ ] All functional tests defined
- [ ] All responsive tests defined
- [ ] All browser tests defined
- [ ] All performance tests defined
- [ ] All SEO tests defined
- [ ] All conversion tests defined
- [ ] All security tests defined
- [ ] All content tests defined
- [ ] Launch checklist complete
- [ ] Rollback plan documented
- [ ] Success criteria defined
