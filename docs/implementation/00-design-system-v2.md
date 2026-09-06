# AKDISI Design System v2.0 — AWWWARDS/DRIBBBLE INSPIRED

## Design Direction

**Keywords:** Editorial Asymmetric • Liquid Glass • Kinetic Typography • Spatial Depth • Purposeful Motion

**Referensi Visual:**
- awwwards.com winners: asymmetrical editorial layouts, oversized kinetic typography, liquid glass morphism, scroll-driven storytelling
- dribbble.com premium: micro-interactions with spring physics, magnetic UI, depth through layering, purposeful negative space

---

## 1. COLOR SYSTEM

### Primary Palette — Deep Space + Electric Accent

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-void` | `#05080c` | Deepest background (hero, dark sections) |
| `--color-abyss` | `#0a0f1a` | Dark section backgrounds |
| `--color-deep` | `#111827` | Elevated dark surfaces (cards, panels) |
| `--color-slate-950` | `#020617` | Alternative deep |
| `--color-surface` | `#0e1525` | Glass base |

### Light Palette

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-paper` | `#fafafa` | Light background |
| `--color-cream` | `#fdfbf7` | Warm light sections |
| `--color-white` | `#ffffff` | Pure white |

### Brand Accent — Electric Emerald (Single Accent)

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-spark` | `#00ff88` | Primary CTAs, active states, highlights |
| `--color-spark-dim` | `#00cc6a` | Hover states |
| `--color-spark-soft` | `rgba(0, 255, 136, 0.08)` | Subtle backgrounds |
| `--color-spark-glow` | `rgba(0, 255, 136, 0.35)` | Glow effects |

### Semantic Colors

| Token | Hex | Usage |
|-------|-----|-------|
| `--color-text-primary` | `#f1f5f9` | Primary text on dark |
| `--color-text-secondary` | `#94a3b8` | Secondary text |
| `--color-text-muted` | `#64748b` | Muted, metadata |
| `--color-text-inverse` | `#0f172a` | Text on light |
| `--color-border` | `rgba(148, 163, 184, 0.12)` | Subtle borders |
| `--color-border-strong` | `rgba(148, 163, 184, 0.24)` | Stronger borders |
| `--color-error` | `#ff4757` | Error states |
| `--color-warning` | `#ffa502` | Warning states |

### Gradient System

```css
--grad-hero: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(0,255,136,0.06), transparent 70%);
--grad-card: linear-gradient(135deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
--grad-glass: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
--grad-spark: linear-gradient(135deg, #00ff88, #00cc6a);
--grad-text: linear-gradient(135deg, #f1f5f9, #94a3b8);
```

---

## 2. TYPOGRAPHY SYSTEM

### Font Stack — Distinctive & Premium

| Role | Font | Weights |
|------|------|---------|
| **Display/Headlines** | `Satoshi` (fallback: `Space Grotesk`, `Outfit`) | 300, 400, 500, 600, 700, 900 |
| **Body/UI** | `Geist` (fallback: `Inter`, `DM Sans`) | 400, 500, 600 |
| **Mono/Technical** | `JetBrains Mono` (fallback: `Geist Mono`, `Space Mono`) | 400, 500, 600 |
| **Accent/Editorial** | `Space Grotesk` (fallback: `Satoshi`) | 300, 500, 700 |

### Type Scale — Fluid & Expressive

```css
--text-xs: 0.75rem;      /* 12px - metadata */
--text-sm: 0.875rem;     /* 14px - small UI */
--text-base: 1rem;       /* 16px - body */
--text-lg: 1.125rem;     /* 18px - lead */
--text-xl: 1.375rem;     /* 22px - subhead */
--text-2xl: clamp(1.75rem, 3.5vw, 2.5rem);  /* 28-40px */
--text-3xl: clamp(2.25rem, 4.5vw, 3.5rem);  /* 36-56px */
--text-4xl: clamp(3rem, 6vw, 5rem);         /* 48-80px - hero */
--text-5xl: clamp(4rem, 8vw, 7rem);         /* 64-112px - display */
--text-6xl: clamp(5.5rem, 12vw, 10rem);     /* 88-160px - kinetic */
```

### Typography Rules

- **Headlines**: `font-family: var(--font-display); font-weight: 300-500; letter-spacing: -0.03em; line-height: 1.05`
- **Display/Kinetic**: `font-weight: 300; letter-spacing: -0.05em; line-height: 0.95`
- **Body**: `font-family: var(--font-body); font-weight: 400; line-height: 1.7; max-width: 65ch`
- **Lead**: `font-size: var(--text-lg); font-weight: 400; line-height: 1.6; color: var(--color-text-secondary)`
- **Mono/Technical**: `font-family: var(--font-mono); font-size: var(--text-xs); letter-spacing: 0.08em; text-transform: uppercase`
- **Eyebrow**: `font-family: var(--font-mono); font-size: 11px; font-weight: 500; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-spark)`

---

## 3. SPACING & LAYOUT

### Spacing Scale (4px base + fluid)

```css
--space-1: 0.25rem;   /* 4px */
--space-2: 0.5rem;    /* 8px */
--space-3: 0.75rem;   /* 12px */
--space-4: 1rem;      /* 16px */
--space-5: 1.25rem;   /* 20px */
--space-6: 1.5rem;    /* 24px */
--space-8: 2rem;      /* 32px */
--space-10: 2.5rem;   /* 40px */
--space-12: 3rem;     /* 48px */
--space-16: 4rem;     /* 64px */
--space-20: 5rem;     /* 80px */
--space-24: 6rem;     /* 96px */
--space-32: 8rem;     /* 128px */
--space-40: 10rem;    /* 160px */
```

### Container System

```css
--container-sm: 640px;
--container-md: 880px;
--container-lg: 1120px;
--container-xl: 1280px;
--container-2xl: 1440px;
--container-full: 100%;
```

### Grid System

- **Desktop**: 12-col, 32px gutter, max-width 1440px
- **Tablet**: 8-col, 24px gutter
- **Mobile**: 4-col, 16px gutter (collapse to single-col for asymmetric)

### Asymmetric Layout Tokens

```css
--layout-split-70: 70% / 30%;
--layout-split-60: 60% / 40%;
--layout-split-65: 65% / 35%;
--layout-editorial: 1fr 1.5fr 1fr;  /* 3-col asymmetric */
--layout-golden: 1fr 1.618fr;        /* Golden ratio split */
```

---

## 4. SHAPE & RADIUS

```css
--radius-none: 0;
--radius-xs: 4px;
--radius-sm: 6px;       /* Buttons, small UI */
--radius-md: 10px;      /* Cards, inputs */
--radius-lg: 16px;      /* Large cards, panels */
--radius-xl: 24px;      /* Hero elements, modals */
--radius-2xl: 32px;     /* Major containers */
--radius-pill: 9999px;  /* Pills, tags only */
--radius-organic: 24px 24px 0 24px;  /* Organic shapes */
```

---

## 5. ELEVATION & MATERIALS

### Glassmorphism System (Liquid Glass)

```css
/* Base Glass */
--glass-bg: rgba(14, 21, 37, 0.72);
--glass-border: rgba(148, 163, 184, 0.1);
--glass-shadow: 0 4px 24px rgba(0,0,0,0.15), inset 0 1px 0 rgba(255,255,255,0.05);
--glass-blur: blur(20px) saturate(180%);

/* Elevated Glass */
--glass-bg-elevated: rgba(17, 24, 39, 0.85);
--glass-border-elevated: rgba(0, 255, 136, 0.15);
--glass-shadow-elevated: 0 12px 48px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.08);

/* Liquid Glass - Refraction Effect */
--glass-refraction: 
  inset 0 1px 0 rgba(255,255,255,0.15),
  inset 0 -1px 0 rgba(0,0,0,0.1),
  0 2px 8px rgba(0,0,0,0.1),
  0 8px 32px rgba(0,0,0,0.15);
```

### Shadow System (Tonal, No Muddy Shadows)

```css
--shadow-xs: 0 1px 2px rgba(0,0,0,0.08);
--shadow-sm: 0 2px 8px rgba(0,0,0,0.12);
--shadow-md: 0 8px 24px rgba(0,0,0,0.15);
--shadow-lg: 0 16px 48px rgba(0,0,0,0.2);
--shadow-xl: 0 24px 64px rgba(0,0,0,0.25);
--shadow-glow: 0 0 48px rgba(0,255,136,0.15);
--shadow-glow-strong: 0 0 80px rgba(0,255,136,0.25);
--shadow-inner: inset 0 2px 8px rgba(0,0,0,0.15);
```

---

## 6. MOTION SYSTEM

### Timing & Easing

```css
--ease-out: cubic-bezier(0.16, 1, 0.3, 1);      /* Standard out */
--ease-in: cubic-bezier(0.7, 0, 0.84, 0);       /* Standard in */
--ease-out-expo: cubic-bezier(0.19, 1, 0.22, 1); /* Expressive out */
--ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1); /* Spring feel */
--ease-bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55); /* Overshoot */

--dur-instant: 100ms;
--dur-fast: 200ms;
--dur-base: 350ms;
--dur-slow: 500ms;
--dur-slower: 700ms;
--dur-slowest: 1000ms;
```

### Motion Tokens (GSAP)

```js
// Spring configurations
const springGentle = { type: "spring", stiffness: 80, damping: 18 };
const springFirm = { type: "spring", stiffness: 120, damping: 20 };
const springBouncy = { type: "spring", stiffness: 180, damping: 12 };
const springExpo = { duration: 1.2, ease: "expo.out" };

// Stagger
const staggerFast = 0.05;
const staggerBase = 0.08;
const staggerSlow = 0.12;
```

### Motion Principles

1. **Transform + Opacity Only** — No layout thrashing
2. **Spring Physics** — Default for all interactive elements
3. **Stagger Everything** — Sequential reveals create spatial awareness
4. **Scroll-Driven** — GSAP ScrollTrigger for storytelling
5. **Reduced Motion** — Kill switch for accessibility

---

## 7. COMPONENT SPECIFICATIONS

### Buttons

| Variant | Style |
|---------|-------|
| **Primary** | Glass bg, spark border, spark text, magnetic |
| **Secondary** | Glass bg, subtle border, primary text |
| **Ghost** | Transparent, border on hover, text link style |
| **Kinetic** | Large, spark gradient text, magnetic, particle burst on click |

```css
.btn {
  --btn-h: 52px;
  --btn-h-lg: 64px;
  --btn-radius: var(--radius-sm);
  --btn-font: var(--font-display);
  --btn-weight: 500;
  --btn-letter: 0.01em;
}

.btn-primary {
  background: var(--glass-bg);
  border: 1px solid var(--color-spark);
  color: var(--color-spark);
  backdrop-filter: var(--glass-blur);
}
.btn-primary:hover {
  background: var(--color-spark);
  color: var(--color-void);
  box-shadow: var(--shadow-glow-strong);
}
```

### Cards — Liquid Glass Panels

```css
.card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-lg);
  backdrop-filter: var(--glass-blur);
  box-shadow: var(--glass-shadow);
  transition: transform var(--dur-base) var(--ease-out-expo),
              box-shadow var(--dur-base) var(--ease-out-expo),
              border-color var(--dur-base);
}
.card:hover {
  transform: translateY(-6px) scale(1.01);
  border-color: var(--color-spark);
  box-shadow: var(--glass-shadow-elevated), var(--shadow-glow);
}
```

### Forms — Editorial Input System

```css
.field {
  --field-h: 56px;
  --field-radius: var(--radius-md);
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  color: var(--color-text-primary);
  backdrop-filter: var(--glass-blur);
  transition: border-color var(--dur-fast), box-shadow var(--dur-fast);
}
.field:focus {
  border-color: var(--color-spark);
  box-shadow: 0 0 0 3px var(--color-spark-soft), var(--glass-shadow);
}
.field-error { border-color: var(--color-error); }
```

### Navigation

```css
.nav-link {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  font-weight: 500;
  color: var(--color-text-secondary);
  position: relative;
}
.nav-link::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 0;
  height: 1px;
  background: var(--color-spark);
  transition: width var(--dur-base) var(--ease-out-expo);
}
.nav-link:hover::after,
.nav-link.active::after { width: 100%; }
```

---

## 8. SECTION RHYTHM

### Dark/Light Alternation with Purpose

```
HOMEPAGE RHYTHM:
┌─────────────────────────────────────┐
│  HERO (Dark)          - Immersive   │
├─────────────────────────────────────┤
│  PROBLEM (Light)      - Grounded    │
├─────────────────────────────────────┤
│  TRANSFORMATION (Glass) - Ethereal  │
├─────────────────────────────────────┤
│  SERVICES (Dark Bento) - Structured │
├─────────────────────────────────────┤
│  SOLUTIONS (Editorial) - Narrative  │
├─────────────────────────────────────┤
│  PROOF (Dark) - Evidence            │
├─────────────────────────────────────┤
│  PROCESS (Pinned) - Journey         │
├─────────────────────────────────────┤
│  CTA (Gradient Glass) - Conversion  │
└─────────────────────────────────────┘
```

---

## 9. INTERACTION PATTERNS

### Magnetic Elements
- Buttons pull toward cursor (fine pointer only)
- Cards have subtle magnetic hover
- Text links have magnetic underline

### Scroll-Driven (GSAP ScrollTrigger)
- Hero clip-reveal + parallax
- Stagger reveals on scroll
- Horizontal scroll galleries (pin + scrub)
- Pinned storytelling sections
- Progress indicators

### Micro-Interactions
- Button press: scale(0.97) + particle burst
- Card hover: lift + glow + border spark
- Input focus: glow ring + label float
- Link hover: magnetic underline expansion
- Page transitions: liquid swipe

### Perpetual Motion (Dashboard/Stats)
- Number counters with spring
- Rotating gradients on cards
- Floating particles in hero
- Breathing status indicators

---

## 10. RESPONSIVE BEHAVIOR

### Breakpoints
```css
--bp-sm: 480px;   /* Mobile landscape */
--bp-md: 768px;   /* Tablet */
--bp-lg: 1024px;  /* Laptop */
--bp-xl: 1280px;  /* Desktop */
--bp-2xl: 1440px; /* Wide */
--bp-3xl: 1920px; /* Ultra-wide */
```

### Mobile-First Collapse Rules

| Component | Desktop | Mobile (<768px) |
|-----------|---------|-----------------|
| Asymmetric grids | Multi-col fractional | Single column, stacked |
| Horizontal scroll | Pin + scrub | Native scroll-snap |
| Pinned sections | Pin + scrub | Static, stacked |
| Magnetic buttons | Mouse follow | Disabled (touch) |
| Stagger grids | 0.08s stagger | 0.04s stagger |
| Hero layout | Split 50/50 | Stacked, centered |
| Nav | Horizontal | Full-screen overlay |

---

## 11. ACCESSIBILITY

- `prefers-reduced-motion`: Disable all non-essential animation
- `prefers-contrast`: High contrast mode
- Focus visible: 2px spark outline, 2px offset
- Semantic HTML5 landmarks
- ARIA labels on all interactive elements
- Color contrast: WCAG AA minimum (4.5:1)

---

## 12. IMPLEMENTATION NOTES

### CSS Architecture
```
/style.css (main)
├── 1. Design Tokens (CSS Custom Properties)
├── 2. Reset & Base
├── 3. Typography
├── 4. Layout & Grid
├── 5. Components (Buttons, Cards, Forms, Nav)
├── 6. Glassmorphism System
├── 7. Motion Utilities
├── 8. Section Framework
├── 9. Page-Specific
├── 10. Responsive
├── 11. Accessibility
└── 12. Print
```

### Font Loading Strategy
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Satoshi:wght@300;400;500;600;700;900&family=Geist:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@300;500;700&display=swap">
```

### GSAP Loading
```html
<!-- Deferred, after main content -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js" defer></script>
```

---

## 13. QUALITY CHECKLIST

- [ ] No pure black (#000000)
- [ ] No Inter font anywhere
- [ ] No 3-col equal card grids
- [ ] No centered hero layouts
- [ ] No generic "Elevate/Seamless/Unleash" copy
- [ ] No fake metrics (99.99%, etc.)
- [ ] All shadows tinted to background
- [ ] All interactive elements have spring physics
- [ ] All scroll animations use transform/opacity
- [ ] Reduced motion fully supported
- [ ] Mobile collapse tested at 375px, 390px, 414px
- [ ] Glassmorphism has refraction borders
- [ ] Magnetic only on fine pointer
- [ ] Single accent color throughout
- [ ] Kinetic typography on hero/display

---

## 14. INSPIRATION REFERENCES

### AWWWARDS Sites to Study
- **Locomotive** — Scroll-driven storytelling, kinetic typography
- **Fantasy** — Asymmetric editorial, oversized type
- **Resn** — Liquid interactions, 3D depth
- **Dogstudio/DEPT** — Glassmorphism, magnetic UI
- **Active Theory** — WebGL + scroll sync
- **Hello Monday** — Micro-interactions, personality

### Dribbble Searches
- "Liquid glass UI"
- "Magnetic button"
- "Kinetic typography"
- "Editorial web design"
- "Asymmetric layout"
- "Scroll trigger animation"
- "Bento grid dashboard"
