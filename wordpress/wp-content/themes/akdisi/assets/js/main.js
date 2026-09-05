/**
 * AKDISI Theme - Main JavaScript
 * v1.3.0 — Modern Digital Enterprise motion (GSAP + ScrollTrigger)
 * Motion guards: prefers-reduced-motion + no-JS (html.js class swap in header).
 */
(function () {
    'use strict';

    const motionOK = window.matchMedia('(prefers-reduced-motion: reduce)').matches === false;
    const desktop = window.matchMedia('(min-width: 1025px)');
    const hasGSAP = typeof window.gsap !== 'undefined' && typeof window.ScrollTrigger !== 'undefined';

    /* ------------------------------------------------------------------
       0. HEADER scrolled state
       ------------------------------------------------------------------ */
    const header = document.querySelector('[data-header]');
    if (header) {
        const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    /* ------------------------------------------------------------------
       1. Mobile Menu Toggle
       ------------------------------------------------------------------ */
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-navigation');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function () {
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            mainNav.classList.toggle('active');
            document.body.style.overflow = expanded ? '' : 'hidden';
        });

        mainNav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menuToggle.setAttribute('aria-expanded', 'false');
                mainNav.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }

    /* ------------------------------------------------------------------
       2. FAQ Accordion
       ------------------------------------------------------------------ */
    document.querySelectorAll('.faq-question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const answer = this.nextElementSibling;
            const expanded = this.getAttribute('aria-expanded') === 'true';

            document.querySelectorAll('.faq-question').forEach(function (b) {
                b.setAttribute('aria-expanded', 'false');
                b.nextElementSibling.classList.remove('open');
            });

            if (!expanded && answer) {
                this.setAttribute('aria-expanded', 'true');
                answer.classList.add('open');
            }
        });
    });

    /* ------------------------------------------------------------------
       3. Motion — GSAP ScrollTrigger (skip on reduced motion / no GSAP)
       ------------------------------------------------------------------ */
    if (motionOK && hasGSAP) {
        const gsap = window.gsap;
        const ST = window.ScrollTrigger;
        gsap.registerPlugin(ST);

        /* 3.1 Hero intro — clip-reveal headline + fade supporting elements */
        const hero = document.querySelector('.hero');
        if (hero) {
            const lines = hero.querySelectorAll('.hero-line > span');
            if (lines.length) {
                gsap.fromTo(lines,
                    { yPercent: 115 },
                    { yPercent: 0, duration: 1.1, ease: 'power3.out', stagger: 0.12, delay: 0.1 }
                );
            }
            gsap.fromTo(
                hero.querySelectorAll('.hero .eyebrow, .hero-sub, .hero-cta'),
                { autoAlpha: 0, y: 26 },
                { autoAlpha: 1, y: 0, duration: 0.9, ease: 'power3.out', stagger: 0.14, delay: 0.5 }
            );
        }

        /* 3.2 Generic reveal — [data-reveal] single elements */
        document.querySelectorAll('[data-reveal]').forEach(function (el) {
            gsap.fromTo(el,
                { autoAlpha: 0, y: 32 },
                {
                    autoAlpha: 1, y: 0, duration: 0.9, ease: 'power3.out',
                    scrollTrigger: { trigger: el, start: 'top 85%', once: true },
                }
            );
        });

        /* 3.3 Staggered grids — .js-stagger direct children */
        document.querySelectorAll('.js-stagger').forEach(function (grid) {
            const items = Array.from(grid.children);
            if (!items.length) { return; }
            gsap.fromTo(items,
                { autoAlpha: 0, y: 28 },
                {
                    autoAlpha: 1, y: 0, duration: 0.7, ease: 'power3.out', stagger: 0.08,
                    scrollTrigger: { trigger: grid, start: 'top 85%', once: true },
                }
            );
        });

        /* 3.4 Parallax — [data-parallax] subtle y-drift */
        document.querySelectorAll('[data-parallax]').forEach(function (el) {
            const speed = parseFloat(el.getAttribute('data-parallax')) || 0.1;
            gsap.to(el, {
                yPercent: speed * 35,
                ease: 'none',
                scrollTrigger: {
                    trigger: el.closest('.hero') || el.parentElement,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1.2,
                },
            });
        });

        /* 3.5 Horizontal portfolio — pin + scrub, desktop only */
        const hzViewport = document.querySelector('[data-horizontal]');
        if (hzViewport && desktop.matches) {
            const hzSection = hzViewport.closest('.pf-section');
            const track = hzViewport.querySelector('.pf-track');
            const progress = document.querySelector('.pf-progress-bar');
            if (hzSection && track) {
                const amount = function () {
                    return track.scrollWidth - window.innerWidth;
                };
                gsap.to(track, {
                    x: function () { return -amount(); },
                    ease: 'none',
                    scrollTrigger: {
                        trigger: hzSection,
                        start: 'top top',
                        end: function () { return '+=' + Math.max(amount() + window.innerHeight, 800); },
                        scrub: 1,
                        pin: true,
                        anticipatePin: 1,
                        invalidateOnRefresh: true,
                        onUpdate: function (self) {
                            if (progress) { progress.style.transform = 'scaleX(' + self.progress + ')'; }
                        },
                    },
                });
            }
        }

        /* 3.6 Process storytelling — active step highlight on scroll (desktop) */
        const pin = document.querySelector('[data-pin]');
        if (pin && desktop.matches) {
            const steps = pin.querySelectorAll('.proc-step');
            if (steps.length) {
                gsap.set(steps, { opacity: 0.4, x: 0 });
                steps.forEach(function (step) {
                    gsap.to(step, {
                        opacity: 1,
                        x: 18,
                        duration: 0.45,
                        ease: 'power2.out',
                        scrollTrigger: {
                            trigger: step,
                            start: 'top 62%',
                            toggleActions: 'play none none reverse',
                        },
                    });
                });
                ST.create({
                    trigger: pin,
                    start: 'top top',
                    end: '+=' + (steps.length * 60 + 300) + '%',
                    pin: true,
                    anticipatePin: 1,
                });
            }
        }

        /* 3.7 Magnetic buttons (fine pointers only) */
        if (window.matchMedia('(pointer: fine)').matches) {
            document.querySelectorAll('.magnetic').forEach(function (btn) {
                const xTo = gsap.quickTo(btn, 'x', { duration: 0.4, ease: 'power3.out' });
                const yTo = gsap.quickTo(btn, 'y', { duration: 0.4, ease: 'power3.out' });
                btn.addEventListener('mousemove', function (e) {
                    const r = btn.getBoundingClientRect();
                    xTo((e.clientX - (r.left + r.width / 2)) * 0.3);
                    yTo((e.clientY - (r.top + r.height / 2)) * 0.4);
                });
                btn.addEventListener('mouseleave', function () {
                    xTo(0);
                    yTo(0);
                });
            });
        }

        ST.refresh();
    }

    /* ------------------------------------------------------------------
       4. Portfolio Filter (legacy AJAX filter)
       ------------------------------------------------------------------ */
    const filterBtns = document.querySelectorAll('.portfolio-filter-btn');
    const portfolioGrid = document.querySelector('.portfolio-grid');

    if (filterBtns.length && portfolioGrid) {
        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                filterBtns.forEach(function (b) { b.classList.remove('active'); });
                this.classList.add('active');

                const category = this.dataset.category;
                portfolioGrid.innerHTML = '<p style="text-align:center;padding:2rem;">' + akdisiData.loading + '</p>';

                fetch(akdisiData.ajaxUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'action=akdisi_portfolio_filter&category=' + encodeURIComponent(category) + '&nonce=' + encodeURIComponent(akdisiData.nonce),
                })
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        if (data.success) { portfolioGrid.innerHTML = data.data.html; }
                    })
                    .catch(function () {
                        portfolioGrid.innerHTML = '<p>Failed to load projects.</p>';
                    });
            });
        });
    }

    /* ------------------------------------------------------------------
       5. Contact Form — inline per-field errors (PRD §106) + success (§107)
       ------------------------------------------------------------------ */
    const contactForm = document.getElementById('contact-form');
    const formSuccess = document.getElementById('form-success');

    if (contactForm) {
        let formStarted = false;

        contactForm.addEventListener('input', function () {
            if (!formStarted) {
                formStarted = true;
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'form_start', { 'event_category': 'engagement' });
                }
            }
        });

        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            this.querySelectorAll('.form-field.error').forEach(function (el) {
                el.classList.remove('error');
            });

            const formData = new FormData(this);
            formData.append('action', 'akdisi_contact');
            const nonceInput = this.querySelector('input[name="_wpnonce"]');
            formData.append('nonce', nonceInput ? nonceInput.value : akdisiData.nonce);

            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = akdisiData.sending || 'Sending...';

            fetch(akdisiData.ajaxUrl, {
                method: 'POST',
                body: new URLSearchParams(formData),
            })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = akdisiData.submitText || 'Send Message';

                    if (data.success) {
                        if (formSuccess) {
                            formSuccess.classList.add('visible');
                            formSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            contactForm.reset();
                        }
                        if (typeof gtag !== 'undefined') {
                            gtag('event', 'form_submit', {
                                'event_category': 'conversion',
                                'event_label': 'contact',
                            });
                        }
                    } else if (data.data && data.data.errors) {
                        Object.keys(data.data.errors).forEach(function (field) {
                            const input = contactForm.querySelector('[name="' + field + '"]');
                            const wrapper = input ? input.closest('.form-field') : null;
                            if (wrapper) {
                                wrapper.classList.add('error');
                                const msg = wrapper.querySelector('.field-error');
                                if (msg) { msg.textContent = data.data.errors[field]; }
                            }
                        });
                        const fallback = data.data.errors._general || data.data.message;
                        if (fallback) {
                            const general = contactForm.querySelector('.form-general-error');
                            if (general) { general.textContent = fallback; general.style.display = 'block'; }
                        }
                        const firstError = contactForm.querySelector('.form-field.error input, .form-field.error textarea, .form-field.error select');
                        if (firstError) { firstError.focus(); }
                    } else {
                        const general = contactForm.querySelector('.form-general-error');
                        const msg = (data.data && data.data.message) || 'An error occurred.';
                        if (general) { general.textContent = msg; general.style.display = 'block'; }
                    }
                })
                .catch(function () {
                    submitBtn.disabled = false;
                    submitBtn.textContent = akdisiData.submitText || 'Send Message';
                    alert('Network error. Please try again.');
                });
        });
    }

    /* ------------------------------------------------------------------
       6. Event tracking via data-ga-track (PRD §91-92)
       ------------------------------------------------------------------ */
    document.addEventListener('click', function (e) {
        const trackEl = e.target.closest('[data-ga-track]');
        if (!trackEl || typeof gtag === 'undefined') { return; }
        gtag('event', trackEl.getAttribute('data-ga-track'), {
            'event_category': 'engagement',
            'event_label': trackEl.getAttribute('data-ga-content') || trackEl.getAttribute('href') || '',
        });
    });

    if (typeof gtag !== 'undefined' && window.akdisiPageView) {
        const type = window.akdisiPageView.type;
        gtag('event', type === 'booth' ? 'booth_visit' : type + '_view', {
            'event_category': 'content',
            'event_label': window.akdisiPageView.title,
        });
    }

    document.querySelectorAll('a[href*="wa.me"], a[href*="api.whatsapp"]').forEach(function (link) {
        link.addEventListener('click', function () {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'whatsapp_click', {
                    'event_category': 'conversion',
                    'event_label': 'WhatsApp CTA',
                });
            }
        });
    });
})();