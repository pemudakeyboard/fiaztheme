---
name: fiaztheme
description: Builds the PT FIAZ CAKRAWALA INDONUSA custom WordPress theme (enterprise construction/HVAC company profile). Reads docs/ before any code. Use when working in fiaztheme, FIAZ Cakrawala, company profile theme, ACF/CPT setup, GSAP animations, or Awwwards-style WordPress development for this project.
---

# Fiaztheme — WordPress Theme Development

## Mandatory: Read Docs Before Code

Before writing, editing, or scaffolding **any** code in this theme folder, read these files in order:

1. [docs/00-PROJECT-BRIEF.md](docs/00-PROJECT-BRIEF.md) — business context, services, audience, goals
2. [docs/01-SKILL-WORDPRESS-DEVELOPER.md](docs/01-SKILL-WORDPRESS-DEVELOPER.md) — stack, standards, security
3. [docs/02-DESIGN-DIRECTION.md](docs/02-DESIGN-DIRECTION.md) — brand, layout, UX goals
4. [docs/03-INFORMATION-ARCHITECTURE.md](docs/03-INFORMATION-ARCHITECTURE.md) — sitemap, page structure
5. [docs/04-PROJECT-PLAN.md](docs/04-PROJECT-PLAN.md) — phases and deliverables
6. [docs/MASTER CURSOR PROMPT.md](docs/MASTER CURSOR PROMPT.md) — full technical spec

Do not skip this step. Do not generate placeholder code without an architecture plan.

## Pre-Code Checklist

Copy and complete before generating code:

```
Pre-Code Checklist:
- [ ] Read all docs listed above
- [ ] Requirements analyzed
- [ ] Architecture plan stated
- [ ] Folder structure explained
- [ ] ACF field structure explained
- [ ] CPT structure explained
- [ ] Then generate code
```

## Project Identity

**Client:** PT FIAZ CAKRAWALA INDONUSA — construction, HVAC, mechanical/electrical, general supplier, technical services.

**Positioning:** Engineering company, industrial solution provider, national HVAC specialist — **not** a generic contractor or AC shop.

**Design benchmark:** Awwwards-inspired (Basic Agency, Instrument, Locomotive, Active Theory, Stink Studios).

**Avoid:** Themeforest style, Elementor/Divi layouts, Bootstrap corporate templates, AI section stacking, generic contractor sites.

## Stack

| Layer | Tools |
|-------|-------|
| Backend | WordPress Core, ACF Pro, Custom Post Types, theme.json |
| Frontend | HTML5, SCSS, Vanilla JS, GSAP, ScrollTrigger, SwiperJS |
| Performance | Core Web Vitals, lazy loading, WebP/AVIF, SVG |
| Security | Nonce, sanitization, escaping, capability checks |

**Do not use:** Elementor, Divi, WPBakery, Revolution Slider, Contact Form 7.

## Theme Structure

```
/assets
/inc
/template-parts
/templates
/acf-json
```

Use WordPress Coding Standards, OOP architecture, modular components.

## Custom Post Types

Register: `project`, `service`, `client`, `director`.

Each CPT supports: title, featured image, custom fields (ACF).

## Design System

**Fonts:** Space Grotesk (primary), Inter (secondary)

| Element | Size |
|---------|------|
| Hero | 72px–120px |
| Section title | 48px–64px |
| Body | 18px, line-height 1.6 |

**Colors:**

| Role | Value |
|------|-------|
| Primary | `#0D1117` |
| Secondary | `#FFFFFF` |
| Accent | `#F97316` |
| Neutral | `#6B7280` |

High contrast. No colorful corporate palettes. Minimal cards, no excessive gradients/shadows.

## Sitemap & Homepage

**Pages:** Home, About, Services, Projects, Clients, Contact

**Homepage sections (order):**

1. Hero — large statement (e.g. "Engineering Beyond Construction")
2. Company overview
3. Statistics
4. Services
5. Featured projects
6. Clients
7. Legality
8. Directors
9. Contact CTA
10. Footer

**Projects:** Filter by year (2021–2026) and category (HVAC, Construction, Maintenance, Mechanical, Electrical). Timeline + grid views. Visual storytelling priority.

## Animation

GSAP + ScrollTrigger. Premium motion: text reveal, fade up, parallax, counter, section pinning.

**Avoid:** bounce, elastic, cartoon effects.

## Performance Targets

| Metric | Target |
|--------|--------|
| Desktop score | 100 |
| Mobile score | 90+ |
| LCP | <2.5s |
| CLS | <0.1 |
| INP | <200ms |

Use deferred JS, critical CSS, lazy loading.

## Contact Form

Custom form via `wp_mail()` + `admin-post.php`. Nonce, sanitization, validation, spam protection.

## SEO

Schema.org (Organization, Service, Project), Open Graph, breadcrumb, sitemap.

## Accessibility

WCAG 2.1 — semantic HTML, keyboard navigation, contrast compliance.

## Development Phases

Follow [docs/04-PROJECT-PLAN.md](docs/04-PROJECT-PLAN.md): Research → UI Design → Theme Dev → Animations → Content → Optimization → Launch.

## Additional Resources

- Full creative/technical spec: [docs/MASTER CURSOR PROMPT.md](docs/MASTER CURSOR PROMPT.md)
- UX layout principles: [docs/02-DESIGN-DIRECTION.md](docs/02-DESIGN-DIRECTION.md)
- Page content structure: [docs/03-INFORMATION-ARCHITECTURE.md](docs/03-INFORMATION-ARCHITECTURE.md)
