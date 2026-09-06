# 04 — UI Design System

**Source:** PRD Final Master AKDISI Website v5.0 + CHANGELOG v1.4.0  
**Status:** Final  
**Date:** 2026-09-06  
**Reference:** PRD AKDISI Website v5.0.md, Sections 75–83

---

## TODO Checklist

### Colors
- [ ] Define primary color palette
- [ ] Define secondary color palette
- [ ] Define accent color palette
- [ ] Define background colors
- [ ] Define text colors
- [ ] Define utility colors (success, error, warning)
- [ ] Test color contrast ratios

### Typography
- [ ] Define font families (display, body, mono)
- [ ] Define font sizes (scale)
- [ ] Define font weights
- [ ] Define line heights
- [ ] Define letter spacing
- [ ] Define heading hierarchy

### Spacing
- [ ] Define spacing scale
- [ ] Define container widths
- [ ] Define grid system

### Components
- [ ] Buttons (all variants)
- [ ] Cards (all variants)
- [ ] Forms (inputs, selects, etc.)
- [ ] Navigation (header, footer, mobile)
- [ ] Accordion
- [ ] Modal
- [ ] Badges
- [ ] Breadcrumb

---

## PART A — DESIGN TOKENS

### Color Palette

#### Primary / Dark Surface

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-ink` | `#101312` | Primary dark text |
| `--color-charcoal` | `#171c1a` | Dark surface |
| `--color-deep-charcoal` | `#0a0d12` | Deepest dark |
| `--color-surface-dark` | `#0d1117` | Dark background |
| `--color-ink-inverse` | `#f8f9fa` | Light text on dark |

#### Secondary / Light Surface

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-warm-white` | `#F5F4EF` | Light background |
| `--color-surface` | `#EAE9E3` | Light surface |
| `--color-surface-alt` | `#eceef0` | Secondary surface |
| `--color-titanium` | `#f8f9fa` | Lightest surface |

#### Brand / Accent

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-brand` | `#10b981` | Primary brand (emerald) |
| `--color-brand-hover` | `#059669` | Brand hover state |
| `--color-brand-light` | `#34d399` | Light brand |
| `--color-brand-glow` | `rgba(16,185,129,0.15)` | Active glow |
| `--color-forest` | `#3D5C4A` | Deep brand |

#### Text Colors

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-text-primary` | `#3d372f` | Primary text (dark bg) |
| `--color-text-secondary` | `#6b7280` | Secondary text |
| `--color-text-muted` | `#9ca3af` | Muted text |
| `--color-text-inverse` | `#f8f9fa` | Text on dark |
| `--color-text-inverse-secondary` | `rgba(248,249,250,0.7)` | Secondary on dark |

#### Border / Utility

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-border` | `#e5dfd4` | Light border |
| `--color-border-dark` | `rgba(240,246,252,0.1)` | Ghost border on dark |
| `--color-border-focus` | `--color-brand` | Focus ring |
| `--color-success` | `#10b981` | Success state |
| `--color-error` | `#ef4444` | Error state |
| `--color-warning` | `#f59e0b` | Warning state |

### Typography

#### Font Families

| Token | Font | Usage |
|-------|------|-------|
| `--font-display` | `Plus Jakarta Sans` | Headlines, display text |
| `--font-body` | `Inter` | Body text |
| `--font-mono` | `JetBrains Mono` | Metadata, telemetry, code |

#### Font Sizes (Scale)

| Token | Size | Usage |
|-------|------|-------|
| `--text-xs` | 0.75rem / 12px | Caption, label |
| `--text-sm` | 0.875rem / 14px | Small text |
| `--text-base` | 1rem / 16px | Body |
| `--text-lg` | 1.125rem / 18px | Large body |
| `--text-xl` | 1.25rem / 20px | Subheading |
| `--text-2xl` | 1.5rem / 24px | H4 |
| `--text-3xl` | 1.875rem / 30px | H3 |
| `--text-4xl` | 2.25rem / 36px | H2 |
| `--text-5xl` | 3rem / 48px | H1 mobile |
| `--text-6xl` | clamp(2.6rem, 6vw, 5.25rem) | H1 desktop hero |

#### Font Weights

| Token | Weight | Usage |
|-------|--------|-------|
| `--font-normal` | 400 | Body text |
| `--font-medium` | 500 | Medium emphasis |
| `--font-semibold` | 600 | Subheadings |
| `--font-bold` | 700 | Headings |
| `--font-light` | 300 | Light accent numerals |

#### Line Heights

| Token | Value | Usage |
|-------|-------|-------|
| `--leading-tight` | 1.25 | Headlines |
| `--leading-normal` | 1.5 | Body |
| `--leading-relaxed` | 1.75 | Long content |

#### Letter Spacing

| Token | Value | Usage |
|-------|-------|-------|
| `--tracking-tight` | -0.02em | Large headlines |
| `--tracking-normal` | 0 | Body |
| `--tracking-wide` | 0.05em | All caps |
| `--tracking-wider` | 0.08em | Eyebrows |

---

## PART B — SPACING & LAYOUT

### Spacing Scale

| Token | Size | Usage |
|-------|------|-------|
| `--space-1` | 0.25rem / 4px | Tight spacing |
| `--space-2` | 0.5rem / 8px | Small |
| `--space-3` | 0.75rem / 12px | Medium-small |
| `--space-4` | 1rem / 16px | Base |
| `--space-5` | 1.25rem / 20px | Medium |
| `--space-6` | 1.5rem / 24px | Large |
| `--space-8` | 2rem / 32px | XL |
| `--space-10` | 2.5rem / 40px | 2XL |
| `--space-12` | 3rem / 48px | 3XL |
| `--space-16` | 4rem / 64px | 4XL |
| `--space-20` | 5rem / 80px | 5XL |
| `--space-24` | 6rem / 96px | 6XL |
| `--space-32` | 8rem / 128px | Hero |

### Container

| Token | Width | Usage |
|-------|-------|-------|
| `--container-sm` | 640px | Narrow content |
| `--container-md` | 768px | Tablet |
| `--container-lg` | 1024px | Desktop |
| `--container-xl` | 1200px | Wide |
| `--container-2xl` | 1320px | Max content |

### Grid System

```
Grid: 12 columns
Gutter: 24px (desktop), 16px (mobile)
Container max: 1320px
```

### Section Spacing

| Token | Value | Usage |
|-------|-------|-------|
| `--section-py` | 5rem / 80px | Section vertical padding (mobile) |
| `--section-py-lg` | 7rem / 112px | Section vertical padding (desktop) |

---

## PART C — COMPONENTS

### Buttons

#### Primary Button

```
Default:
  background: --color-brand
  color: white
  padding: 12px 24px
  border-radius: 6px
  font-weight: 600

Hover:
  background: --color-brand-hover
  transform: translateY(-1px)

Active:
  background: --color-brand-hover
  transform: translateY(0)
```

#### Secondary Button

```
Default:
  background: transparent
  border: 1px solid --color-border
  color: --color-text-primary
  padding: 12px 24px
  border-radius: 6px

Hover:
  background: --color-surface
  border-color: --color-text-primary
```

#### CTA Button (Mobile Sticky)

```
background: #25D366 (WhatsApp green)
color: white
padding: 14px 24px
border-radius: 999px (pill)
font-weight: 600
fixed: bottom
```

### Cards

#### Standard Card

```
background: white
border-radius: 8px
padding: 24px
border: 1px solid --color-border
transition: all 0.2s ease

Hover:
  border-color: --color-brand
  box-shadow: 0 4px 12px rgba(0,0,0,0.05)
```

#### Bento Card (Dark)

```
background: --color-charcoal
border-radius: 8px
padding: 32px
border: 1px solid --color-border-dark

Bento Number:
  font-size: 3rem
  font-weight: 300 (light)
  color: --color-brand
```

### Forms

#### Input Field

```
Default:
  background: white
  border: 1px solid --color-border
  border-radius: 6px
  padding: 12px 16px
  font-size: 1rem

Focus:
  border-color: --color-brand
  box-shadow: 0 0 0 3px --color-brand-glow

Error:
  border-color: --color-error
  box-shadow: 0 0 0 3px rgba(239,68,68,0.1)
```

#### Select

```
Same as Input Field
Plus arrow indicator
```

### Navigation

#### Desktop Header

```
Height: 84px (scrolled: 68px)
Background: white / transparent
Sticky: yes
Blur backdrop when scrolled

Logo: left
Nav: center
CTA: right
```

#### Mobile Menu

```
Full-screen overlay
Hamburger icon (3 lines → X)
Close on outside click
Animation: slide in from right
```

### Accordion (FAQ)

```
Header:
  font-weight: 600
  padding: 16px 0
  border-bottom: 1px solid --color-border
  cursor: pointer

Icon: + / -
  rotation: 180deg on open

Content:
  padding: 16px 0
  max-height: 0
  overflow: hidden
  transition: max-height 0.3s ease
```

### Badges

```
Status Badge:
  padding: 4px 12px
  border-radius: 999px (pill)
  font-size: 0.75rem
  font-weight: 600
  text-transform: uppercase

Category Badge:
  font-family: --font-mono
  font-size: 0.6875rem (11px)
  letter-spacing: 0.08em
  text-transform: uppercase
  padding: 4px 10px
  border-radius: 4px
  background: --color-surface
```

---

## PART D — ELEVATION & EFFECTS

### Shadows

Not primary — use tonal elevation instead.

```
Shadow-sm: 0 1px 2px rgba(0,0,0,0.05)
Shadow-md: 0 4px 12px rgba(0,0,0,0.08)
Shadow-lg: 0 8px 24px rgba(0,0,0,0.12)
```

### Borders (Primary Elevation)

```
Ghost Border (Dark):
  border: 1px solid rgba(240,246,252,0.1)

Ghost Border (Light):
  border: 1px solid --color-border
```

### Active State Glow

```
background: --color-brand-glow
border-color: --color-brand
```

### Border Radius

| Token | Value | Usage |
|-------|-------|-------|
| `--radius-sm` | 4px | Small elements |
| `--radius-md` | 6px | Buttons |
| `--radius-lg` | 8px | Cards |
| `--radius-xl` | 12px | Large cards |
| `--radius-full` | 999px | Pills, avatars |

---

## PART E — TYPOGRAPHY PATTERNS

### Eyebrow Text

```
font-family: --font-mono
font-size: 0.6875rem (11px)
letter-spacing: 0.08em
text-transform: uppercase
color: --color-text-secondary
```

Pattern: `// EYEBROW TEXT` or `— EYEBROW TEXT —`

### Hero Headline

```
font-family: --font-display
font-size: clamp(2.6rem, 6vw, 5.25rem)
font-weight: 700
line-height: 1.1
letter-spacing: -0.02em
```

### Section Heading

```
font-family: --font-display
font-size: 2.25rem
font-weight: 700
line-height: 1.2
```

### Body Text

```
font-family: --font-body
font-size: 1rem
line-height: 1.6
```

### Stat Number (Light Numeral)

```
font-family: --font-display
font-weight: 300
font-size: 3rem (or larger)
color: --color-brand
```

### Mono Metadata

```
font-family: --font-mono
font-size: 0.75rem
letter-spacing: 0.02em
color: --color-text-secondary
```

---

## PART F — ANIMATION

### Transition Defaults

```
--transition-fast: 150ms ease
--transition-base: 200ms ease
--transition-slow: 300ms ease
```

### Micro-interactions

```
Button Press:
  scale: 0.98
  duration: 100ms

Card Hover:
  border-color: --color-brand
  transform: translateY(-2px)
  duration: 200ms

Link Hover:
  color: --color-brand
  duration: 150ms
```

### Reveal Animations

```
Hero Content:
  opacity: 0 → 1
  translateY: 20px → 0
  duration: 500ms
  stagger: 100ms

Section Enter:
  opacity: 0 → 1
  translateY: 30px → 0
  duration: 400ms
  trigger: scroll
```

### Scroll Animations

```
Parallax (Hero Image):
  speed: 0.3
  direction: vertical

Scroll Progress (Portfolio):
  horizontal scroll
  pin: yes
  scrub: 1
```

### Reduced Motion

```
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
```

---

## PART G — RESPONSIVE BREAKPOINTS

### Breakpoints

| Name | Value | Usage |
|------|-------|-------|
| `sm` | 640px | Small tablet |
| `md` | 768px | Tablet |
| `lg` | 1024px | Desktop |
| `xl` | 1200px | Large desktop |
| `2xl` | 1320px | Max content |

### Mobile-First Approach

```css
/* Base (mobile) */
.element { }

/* Tablet and up */
@media (min-width: 768px) { }

/* Desktop and up */
@media (min-width: 1024px) { }

/* Large desktop */
@media (min-width: 1200px) { }
```

### Header Behavior

| State | Height | Background | Nav |
|-------|--------|------------|-----|
| Desktop (top) | 84px | transparent | full |
| Desktop (scrolled) | 68px | white + blur | full |
| Mobile | auto | white | hamburger |

---

## PART H — ICON SET

### Icon Style

- Style: Outline (line icons)
- Stroke width: 1.5px or 2px
- Size: 24px default, 20px small, 16px xs
- Color: Current color (inherits from parent)

### Required Icons

```
Navigation:
  menu (hamburger)
  close (X)
  chevron-down
  chevron-right

Actions:
  arrow-right
  arrow-up-right (external)
  send (form submit)
  copy

Social:
  whatsapp
  mail
  phone
  location

UI:
  plus / minus (accordion)
  check
  search
  filter
```

### Icon Usage

```html
<!-- Inline SVG -->
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M5 12h14M12 5l7 7-7 7"/>
</svg>

<!-- Icon Component -->
<Icon name="arrow-right" size="24" />
```

---

## PART I — IMAGE RULES

### Hero Visual

- Priority: Application UI mockup
- Avoid: Generic laptop stock image
- Style: Dark glass / code editor aesthetic

### Image Optimization

```
Format: WebP/AVIF
Responsive: srcset with sizes
Compression: 80% quality
Lazy loading: all below fold
Placeholder: blur-up technique
```

### Aspect Ratios

```
Hero: 16:9 or 21:9
Card thumbnail: 4:3 or 16:10
Portrait: 3:4
Square: 1:1
```

---

## PART J — CSS ARCHITECTURE

### File Structure

```
styles/
├── tokens.css          # Design tokens
├── reset.css           # CSS reset
├── base.css            # Base styles
├── typography.css      # Typography
├── components/
│   ├── button.css
│   ├── card.css
│   ├── form.css
│   ├── nav.css
│   ├── accordion.css
│   └── ...
├── layouts/
│   ├── container.css
│   ├── grid.css
│   └── section.css
└── utilities.css       # Utility classes
```

### CSS Custom Properties

```css
:root {
  /* Colors */
  --color-ink: #101312;
  --color-charcoal: #171c1a;
  --color-brand: #10b981;
  /* ... */

  /* Typography */
  --font-display: 'Plus Jakarta Sans', system-ui, sans-serif;
  --font-body: 'Inter', system-ui, sans-serif;
  --font-mono: 'JetBrains Mono', monospace;
  /* ... */

  /* Spacing */
  --space-4: 1rem;
  --space-6: 1.5rem;
  /* ... */

  /* Transitions */
  --transition-base: 200ms ease;
  /* ... */
}
```

### BEM Naming

```css
/* Block */
.card { }

/* Element */
.card__image { }
.card__title { }
.card__body { }

/* Modifier */
.card--featured { }
.card--dark { }
```

---

## PART K — ACCESSIBILITY

### Color Contrast

- Text on light: minimum 4.5:1 (WCAG AA)
- Text on dark: minimum 4.5:1
- Large text: minimum 3:1
- UI components: minimum 3:1

### Focus States

```css
:focus-visible {
  outline: 2px solid var(--color-brand);
  outline-offset: 2px;
}
```

### Screen Reader

```html
<!-- Skip link -->
<a href="#main" class="sr-only">Skip to content</a>

<!-- Visually hidden -->
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}
```

### Reduced Motion

```css
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
```

---

## PART L — CSS DELIVERABLES

### Minified Production

```bash
# Development
npm run css:dev

# Production
npm run css:build
```

### Output

```
dist/
└── css/
    ├── main.min.css
    └── main.min.css.map
```

---

## VERIFICATION CHECKLIST

Before marking design system complete:

- [ ] All color tokens defined and documented
- [ ] Typography scale verified
- [ ] Spacing system implemented
- [ ] All components styled
- [ ] Responsive breakpoints tested
- [ ] Dark/light mode support (if needed)
- [ ] Accessibility standards met
- [ ] Animation performance verified
- [ ] Icon set complete
- [ ] CSS architecture documented
