# 05 — WordPress Technical Specification

**Source:** PRD Final Master AKDISI Website v5.0  
**Status:** Final  
**Date:** 2026-09-06  
**Reference:** PRD AKDISI Website v5.0.md, Sections 84–108

---

## TODO Checklist

### Theme Setup
- [ ] Create custom theme `akdisi`
- [ ] Set up theme structure (style.css, functions.php)
- [ ] Configure WordPress settings (permalinks, front page)
- [ ] Create required page templates
- [ ] Register custom post types and taxonomies

### Custom Post Types
- [ ] Portfolio CPT (`akdisi_portfolio`)
- [ ] Insight CPT (`akdisi_insight`)
- [ ] FAQ CPT (`akdisi_faq`)
- [ ] Register taxonomies (`portfolio_category`)

### Custom Fields
- [ ] Portfolio meta fields (PRD §86)
- [ ] Service meta fields (PRD §87)
- [ ] Solution meta fields (PRD §88)
- [ ] Insight meta fields (PRD §89)
- [ ] Theme options (site title, description, social)

### Components
- [ ] Navigation component
- [ ] Footer component
- [ ] Hero section
- [ ] Card component
- [ ] Form component
- [ ] CTA component
- [ ] Accordion component
- [ ] Breadcrumb component

### Templates
- [ ] front-page.php (homepage)
- [ ] single-portfolio.php
- [ ] single-insight.php
- [ ] template-services.php
- [ ] template-service.php
- [ ] template-solutions.php
- [ ] template-solution.php
- [ ] template-about.php
- [ ] template-contact.php
- [ ] template-faq.php
- [ ] template-booth.php
- [ ] archive-portfolio.php
- [ ] archive-insight.php
- [ ] 404.php

### Functionality
- [ ] Lead generation form (AJAX)
- [ ] WhatsApp integration
- [ ] Analytics tracking
- [ ] SEO integration
- [ ] Security hardening
- [ ] Form validation and sanitization

### SEO & Analytics
- [ ] Meta title and description
- [ ] Open Graph tags
- [ ] Sitemap.xml
- [ ] Robots.txt
- [ ] Schema.org structured data
- [ ] Analytics tracking

---

## PART A — ENVIRONMENT REQUIREMENTS

### PHP

| Requirement | Value |
|-------------|-------|
| PHP Version | 8.4 |
| Memory Limit | 256MB |
| Time Limit | 300s |
| Extension | mysqli, mbstring, curl, zip, gd |

### Database

| Requirement | Value |
|-------------|-------|
| Database | MariaDB 11.8 |
| Version | 11.8+ |
| Collation | utf8mb4_unicode_ci |

### Web Server

| Requirement | Value |
|-------------|-------|
| Web Server | nginx / Apache |
| HTTPS | Required |
| SSL | Valid certificate |
| Caching | Redis / object cache |

---

## PART B — THEME SETUP

### Theme Information

```
Theme Name: AKDISI
Theme URI: https://akdisi.com
Description: Custom WordPress theme for AKDISI - B2B Digital Marketing Platform
Version: 1.0.0
Author: AKAR Digital Solusi
Author URI: https://akdisi.com
License: GPL v2 or later
Text Domain: akdisi
Tags: custom, responsive, wordpress, business
```

### File Structure

```
wordpress/
├── wp-content/
│   ├── themes/
│   │   └── akdisi/
│   │       ├── style.css
│   │       ├── functions.php
│   │       ├── index.php
│   │       ├── front-page.php
│   │       ├── header.php
│   │       ├── footer.php
│   │       ├── single.php
│   │       ├── archive.php
│   │       ├── 404.php
│   │       ├── search.php
│   │       ├── page.php
│   │       ├── page-about.php
│   │       ├── page-contact.php
│   │       ├── page-faq.php
│   │       ├── page-services.php
│   │       ├── page-solutions.php
│   │       ├── page-booth.php
│   │       ├── template-services.php
│   │       ├── template-service.php
│   │       ├── template-solutions.php
│   │       ├── template-solution.php
│   │       ├── template-about.php
│   │       ├── template-contact.php
│   │       ├── template-faq.php
│   │       ├── template-booth.php
│   │       ├── archive-portfolio.php
│   │       ├── archive-insight.php
│   │       ├── single-portfolio.php
│   │       ├── single-insight.php
│   │       ├── single-faq.php
│   │       ├── inc/
│   │       │   ├── classes/
│   │       │   │   ├── Theme_Setup.php
│   │       │   │   ├── CPT_Portfolio.php
│   │       │   │   ├── CPT_Insight.php
│   │       │   │   ├── CPT_Faq.php
│   │       │   │   ├── Taxonomy_Portfolio.php
│   │       │   │   ├── Custom_Fields.php
│   │       │   │   ├── Lead_Form.php
│   │       │   │   ├── Analytics.php
│   │       │   │   └── SEO.php
│   │       │   ├── template-parts/
│   │       │   │   ├── cta-band.php
│   │       │   │   ├── portfolio-card.php
│   │       │   │   ├── solution-row.php
│   │       │   │   ├── service-card.php
│   │       │   │   ├── feature-list.php
│   │       │   │   ├── stat-grid.php
│   │       │   │   └── breadcrumb.php
│   │       │   └── functions/
│   │       │       ├── enqueue.php
│   │       │       ├── navigation.php
│   │       │       ├── setup.php
│   │       │       └── helpers.php
│   │       ├── assets/
│   │       │   ├── css/
│   │       │   │   ├── style.css
│   │       │   │   ├── main.css
│   │       │   │   └── responsive.css
│   │       │   ├── js/
│   │       │   │   ├── main.js
│   │       │   │   ├── components/
│   │       │   │   │   ├── form.js
│   │       │   │   │   ├── navigation.js
│   │       │   │   │   ├── accordion.js
│   │       │   │   │   ├── scroll-animations.js
│   │       │   │   │   └── analytics.js
│   │       │   │   └── lib/
│   │       │   │       ├── gsap.min.js
│   │       │   │       └── scrolltrigger.min.js
│   │       │   └── images/
│   │       │       ├── favicon.svg
│   │       │       └── favicon.png
│   │       └── languages/
│   │           └── akdisi.pot
│   ├── uploads/
│   └── plugins/
└── ...
```

### Theme Functions

```php
<?php
/**
 * Theme Name: AKDISI
 * Description: Custom WordPress theme for AKDISI - B2B Digital Marketing Platform
 * Version: 1.0.0
 * Author: AKAR Digital Solusi
 * Text Domain: akdisi
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

// Define theme constants
define('AKDISI_VERSION', '1.0.0');
define('AKDISI_THEME_DIR', get_template_directory());
define('AKDISI_THEME_URI', get_template_directory_uri());
define('AKDISI_ASSETS_URI', AKDISI_THEME_URI . '/assets');

// Include required files
require_once AKDISI_THEME_DIR . '/inc/functions/setup.php';
require_once AKDISI_THEME_DIR . '/inc/functions/enqueue.php';
require_once AKDISI_THEME_DIR . '/inc/functions/navigation.php';
require_once AKDISI_THEME_DIR . '/inc/functions/helpers.php';

// Include classes
require_once AKDISI_THEME_DIR . '/inc/classes/Theme_Setup.php';
require_once AKDISI_THEME_DIR . '/inc/classes/CPT_Portfolio.php';
require_once AKDISI_THEME_DIR . '/inc/classes/CPT_Insight.php';
require_once AKDISI_THEME_DIR . '/inc/classes/CPT_Faq.php';
require_once AKDISI_THEME_DIR . '/inc/classes/Taxonomy_Portfolio.php';
require_once AKDISI_THEME_DIR . '/inc/classes/Custom_Fields.php';
require_once AKDISI_THEME_DIR . '/inc/classes/Lead_Form.php';
require_once AKDISI_THEME_DIR . '/inc/classes/Analytics.php';
require_once AKDISI_THEME_DIR . '/inc/classes/SEO.php';

// Initialize theme
add_action('after_setup_theme', function() {
    \AKDISI\Theme_Setup::init();
});
```

---

## PART C — CUSTOM POST TYPES

### Portfolio CPT

```php
register_post_type('akdisi_portfolio', [
    'labels' => [
        'name' => 'Portfolio',
        'singular_name' => 'Portfolio Item',
        'menu_name' => 'Portfolio',
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => ['slug' => 'portfolio'],
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'],
    'taxonomies' => ['portfolio_category'],
    'menu_icon' => 'dashicons-portfolio',
    'show_in_rest' => true,
]);
```

### Insight CPT

```php
register_post_type('akdisi_insight', [
    'labels' => [
        'name' => 'Insights',
        'singular_name' => 'Insight',
        'menu_name' => 'Insight',
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => ['slug' => 'insight'],
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
    'taxonomies' => ['category'],
    'menu_icon' => 'dashicons-welcome-write-blog',
    'show_in_rest' => true,
]);
```

### FAQ CPT

```php
register_post_type('akdisi_faq', [
    'labels' => [
        'name' => 'FAQ',
        'singular_name' => 'FAQ',
        'menu_name' => 'FAQ',
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => ['slug' => 'faq'],
    'supports' => ['title', 'editor', 'custom-fields'],
    'menu_icon' => 'dashicons-editor-help',
    'show_in_rest' => true,
]);
```

### Portfolio Category Taxonomy

```php
register_taxonomy('portfolio_category', 'akdisi_portfolio', [
    'labels' => [
        'name' => 'Portfolio Categories',
        'singular_name' => 'Portfolio Category',
    ],
    'hierarchical' => true,
    'show_in_rest' => true,
    'rewrite' => ['slug' => 'portfolio-category'],
]);
```

---

## PART D — CUSTOM FIELDS / META

### Portfolio Meta Fields (PRD §86)

| Field | Type | Description |
|-------|------|-------------|
| status | select | CONCEPT / DEMO / ACTUAL |
| context | text | Project context |
| problem | textarea | Problem description |
| solution | textarea | Solution description |
| features | repeater | Key features |
| expected_outcome | textarea | Expected outcome |
| hero_image | image | Hero image |
| gallery | gallery | Gallery images |
| related_service | post_object | Related service |
| related_solution | post_object | Related solution |
| cta | text | CTA text |
| seo_title | text | SEO title |
| seo_description | text | SEO meta description |

### Service Meta Fields (PRD §87)

| Field | Type | Description |
|-------|------|-------------|
| description | textarea | Service description |
| problem | textarea | Problem statement |
| target_audience | text | Target audience |
| use_cases | repeater | Use cases |
| benefits | repeater | Benefits |
| process | textarea | Service process |
| faq | repeater | FAQ items |
| cta | text | CTA text |
| seo_title | text | SEO title |
| seo_description | text | SEO meta description |

### Solution Meta Fields (PRD §88)

| Field | Type | Description |
|-------|------|-------------|
| industry | text | Industry focus |
| problem | textarea | Problem description |
| use_cases | repeater | Use cases |
| potential_features | repeater | Potential features |
| benefits | repeater | Benefits |
| related_services | post_object | Related services |
| related_portfolio | post_object | Related portfolio |
| cta | text | CTA text |
| seo_title | text | SEO title |
| seo_description | text | SEO meta description |

### Insight Meta Fields (PRD §89)

| Field | Type | Description |
|-------|------|-------------|
| excerpt | text | Short excerpt |
| category | select | Content pillar |
| author | text | Author name |
| featured_image | image | Featured image |
| seo_title | text | SEO title |
| seo_description | text | SEO meta description |
| publish_date | date | Publish date |

---

## PART E — PAGE TEMPLATES

### Template Hierarchy

| Page Type | Template File | Purpose |
|-----------|--------------|---------|
| Homepage | front-page.php | Main landing page |
| About | page-about.php | About company |
| Services Index | template-services.php | Services overview |
| Service Detail | template-service.php | Single service page |
| Portfolio Archive | archive-portfolio.php | Portfolio listing |
| Portfolio Detail | single-portfolio.php | Single project |
| Insight Archive | archive-insight.php | Insights listing |
| Insight Detail | single-insight.php | Single article |
| Solutions Index | template-solutions.php | Solutions overview |
| Solution Detail | template-solution.php | Single solution |
| FAQ | template-faq.php | FAQ page |
| Contact | template-contact.php | Contact form |
| Booth | template-booth.php | Booth landing page |
| 404 | 404.php | Not found page |

### Template Structure (Standard)

```php
<?php
/**
 * Template Name: [Template Name]
 * Description: [Template description]
 */

get_header(); ?>

<main id="main" class="main">
    <section class="hero">
        <?php get_template_part('template-parts/hero'); ?>
    </section>
    
    <section class="content">
        <?php the_content(); ?>
    </section>
    
    <section class="cta">
        <?php get_template_part('template-parts/cta-band'); ?>
    </section>
</main>

<?php get_footer();
```

---

## PART F — FEATURES

### Lead Generation Form

Fields:

- Nama (required)
- Organisasi (required)
- Jabatan
- WhatsApp (required)
- Email
- Jenis Organisasi
- Kebutuhan (required)
- Deskripsi (required)
- Estimasi waktu kebutuhan

Validation:

- Server-side validation
- Sanitization
- Nonce verification
- AJAX submission
- Success message
- Lead saved to database

### WhatsApp Integration

```php
// WhatsApp URL generator
function generate_whatsapp_url($message) {
    $phone = get_option('akdisi_whatsapp_number');
    return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
}
```

Default messages:

- Standard: "Halo AKDISI, saya ingin berkonsultasi mengenai kebutuhan aplikasi untuk organisasi/perusahaan kami."
- Booth: "Halo AKDISI, saya mendapatkan informasi AKDISI dari booth/event dan ingin berkonsultasi mengenai kebutuhan aplikasi kami."

### Analytics Tracking

Events to track:

- page_view
- cta_click
- whatsapp_click
- form_start
- form_submit
- portfolio_view
- service_view
- solution_view
- booth_visit

Event properties:

- page
- cta_name
- source
- campaign
- content
- category

Implementation:

```js
// Global page view tracking
window.akdisiPageView = {
    page: window.location.pathname,
    type: 'page_view',
    source: document.referrer || 'direct',
    campaign: getURLParam('utm_source') || 'direct'
};

// CTA click tracking
document.addEventListener('click', (e) => {
    if (e.target.matches('[data-ga-track]')) {
        trackEvent('cta_click', {
            cta_name: e.target.dataset.gaTrack,
            source: window.akdisiPageView.source,
            campaign: window.akdisiPageView.campaign
        });
    }
});
```

### SEO Integration

Requirements:

- Meta title and description per page
- Open Graph tags
- Canonical URLs
- Schema.org structured data
- Sitemap.xml
- Robots.txt
- Internal linking
- Alt text for images

---

## PART G — SECURITY REQUIREMENTS

### Security Hardening

```php
// Nonce verification
check_admin_referer('akdisi_nonce', 'akdisi_nonce');

// Capability check
if (!current_user_can('edit_posts')) {
    wp_die('Unauthorized access');
}

// Sanitization
$sanitized = sanitize_text_field($_POST['field_name']);
$email = sanitize_email($_POST['email']);
$url = esc_url($_POST['url']);

// Escape output
echo esc_html($output);
echo esc_attr($attribute);
```

### Form Security

```php
// Verify nonce
if (!wp_verify_nonce($_POST['_wpnonce'], 'akdisi_contact')) {
    wp_send_json_error('Invalid nonce');
}

// Validate email
if (!is_email($_POST['email'])) {
    wp_send_json_error('Invalid email');
}

// Validate required fields
if (empty($_POST['nama']) || empty($_POST['kebutuhan'])) {
    wp_send_json_error('Field required');
}
```

### Security Headers

```nginx
# Security headers
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
add_header Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';" always;
```

---

## PART H — DATABASE

### Database Tables

WordPress core tables are used. Additional tables for custom data:

```sql
-- Lead table (if needed)
CREATE TABLE wp_akdisi_leads (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    organisasi VARCHAR(255) NOT NULL,
    jabatan VARCHAR(100),
    whatsapp VARCHAR(20) NOT NULL,
    email VARCHAR(255),
    jenis_organisasi VARCHAR(100),
    kebutuhan TEXT,
    deskripsi TEXT,
    estimasi_waktu VARCHAR(50),
    source VARCHAR(50) DEFAULT 'website',
    campaign VARCHAR(100),
    status VARCHAR(20) DEFAULT 'NEW',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### Lead Status Flow

```
NEW → CONTACTED → QUALIFIED → CONSULTATION → CLOSED
```

### Lead Source

```
Website, Google, Social, Referral, Booth, QR, Direct
```

---

## PART I — PLUGINS

### Plugin Philosophy

Minimum plugins, maximum maintainability. Each plugin must have business/technical justification.

### Recommended Plugins (If Needed)

| Plugin | Reason | Priority |
|--------|--------|----------|
| Akismet | Anti-spam for comments/forms | Recommended |
| WP Super Cache | Caching | Recommended |
| Yoast SEO | SEO management | Optional |
| UpdraftPlus | Backup | Recommended |
| Wordfence | Security | Optional |

### Plugin-Free Approach

Prefer custom code over plugins where possible:

- SEO → Custom functions
- Sitemap → Custom endpoint
- Backup → Server configuration
- Security → Custom hardening
- Form → Custom AJAX
- Analytics → Custom scripts

---

## PART J — PERFORMANCE REQUIREMENTS

### Performance Targets

| Metric | Target | Tool |
|--------|--------|------|
| TTFB | < 200ms | GTmetrix |
| LCP | < 2.5s | Lighthouse |
| FID | < 100ms | Lighthouse |
| CLS | < 0.1 | Lighthouse |
| Total Page Weight | < 1MB | WebPageTest |

### Optimization Rules

1. Image optimization (WebP, lazy loading, responsive)
2. Minify CSS and JavaScript
3. Enable gzip/brotli compression
4. Use object cache (Redis)
5. Database optimization
6. Remove unused scripts
7. Defer non-critical CSS
8. Preload critical assets
9. Use CDN for static assets
10. Optimize database queries

---

## PART K — BACKUP & MAINTENANCE

### Backup Schedule

| Frequency | Scope | Method |
|-----------|-------|--------|
| Daily | Database | Server cron |
| Weekly | Media + Files | UpdraftPlus / server script |
| Monthly | Full backup | Offsite storage |

### Backup Storage

- At least one backup outside production hosting
- Encrypted storage
- Retention policy: 90 days
- Test recovery quarterly

---

## PART L — DEPLOYMENT

### Development → Staging → Production

```
Local Dev → Staging → Production
```

### Deployment Steps

1. Code review and merge
2. Deploy to staging
3. Test on staging
4. Deploy to production
5. Verify production
6. Clear cache
7. Verify analytics

### Environment Variables

```env
WP_ENV=production
DB_HOST=localhost
DB_NAME=akdisi_db
DB_USER=akdisi_user
DB_PASSWORD=secure_password
WP_DEBUG=false
```

---

## PART M — VERIFICATION CHECKLIST

Before marking WordPress technical spec complete:

- [ ] Theme structure documented
- [ ] CPTs registered
- [ ] Taxonomies registered
- [ ] Meta fields defined
- [ ] Templates created
- [ ] Lead form functional
- [ ] WhatsApp integration working
- [ ] Analytics tracking implemented
- [ ] SEO requirements met
- [ ] Security hardening applied
- [ ] Performance targets achievable
- [ ] Backup strategy documented
- [ ] Deployment process defined
- [ ] Plugin list finalized
- [ ] Database schema documented

---

## VERIFICATION CHECKLIST

Before marking technical spec complete:

- [ ] Theme requirements documented
- [ ] CPTs registered
- [ ] Custom fields defined
- [ ] Templates created
- [ ] Lead form functional
- [ ] WhatsApp integration working
- [ ] Analytics tracking implemented
- [ ] SEO requirements met
- [ ] Security hardening applied
- [ ] Performance targets achievable
- [ ] Backup strategy documented
- [ ] Deployment process defined
- [ ] Plugin list finalized
- [ ] Database schema documented
