/**
 * AKDISI Theme - Main JavaScript
 * Mobile-first, lightweight, no heavy dependencies
 */
(function () {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-navigation');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function () {
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            mainNav.classList.toggle('active');
        });

        // Close menu when clicking a link
        mainNav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menuToggle.setAttribute('aria-expanded', 'false');
                mainNav.classList.remove('active');
            });
        });
    }

    /**
     * FAQ Accordion
     */
    document.querySelectorAll('.faq-question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const answer = this.nextElementSibling;
            const expanded = this.getAttribute('aria-expanded') === 'true';

            // Close all
            document.querySelectorAll('.faq-question').forEach(function (b) {
                b.setAttribute('aria-expanded', 'false');
                b.nextElementSibling.classList.remove('open');
            });

            // Open clicked
            if (!expanded && answer) {
                this.setAttribute('aria-expanded', 'true');
                answer.classList.add('open');
            }
        });
    });

    /**
     * Portfolio Filter
     */
    const filterBtns = document.querySelectorAll('.portfolio-filter-btn');
    const portfolioGrid = document.querySelector('.portfolio-grid');

    if (filterBtns.length && portfolioGrid) {
        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                // Update active state
                filterBtns.forEach(function (b) {
                    b.classList.remove('active');
                });
                this.classList.add('active');

                const category = this.dataset.category;

                // Show loading state
                portfolioGrid.innerHTML = '<p style="text-align:center;padding:2rem;">' + akdisiData.loading + '</p>';

                // AJAX request
                fetch(akdisiData.ajaxUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=akdisi_portfolio_filter&category=' + encodeURIComponent(category) + '&nonce=' + encodeURIComponent(akdisiData.nonce),
                })
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        if (data.success) {
                            portfolioGrid.innerHTML = data.data.html;
                        }
                    })
                    .catch(function () {
                        portfolioGrid.innerHTML = '<p>Failed to load projects.</p>';
                    });
            });
        });
    }

    /**
     * Contact Form — inline per-field errors (PRD §106) + success (PRD §107)
     */
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

            // Reset errors
            this.querySelectorAll('.form-field.error').forEach(function (el) {
                el.classList.remove('error');
            });

            const formData = new FormData(this);
            formData.append('action', 'akdisi_contact');
            const nonceInput = this.querySelector('input[name="_wpnonce"]');
            formData.append('nonce', nonceInput ? nonceInput.value : akdisiData.nonce);

            // Disable submit button
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
                        // Show per-field inline errors
                        Object.keys(data.data.errors).forEach(function (field) {
                            const input = contactForm.querySelector('[name="' + field + '"]');
                            const wrapper = input ? input.closest('.form-field') : null;
                            if (wrapper) {
                                wrapper.classList.add('error');
                                const msg = wrapper.querySelector('.field-error');
                                if (msg) { msg.textContent = data.data.errors[field]; }
                            }
                        });
                        // Fallback message for errors without a visible field
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

    /**
     * Event tracking via data-ga-track (PRD §91-92)
     */
    document.addEventListener('click', function (e) {
        const trackEl = e.target.closest('[data-ga-track]');
        if (!trackEl || typeof gtag === 'undefined') { return; }
        gtag('event', trackEl.getAttribute('data-ga-track'), {
            'event_category': 'engagement',
            'event_label': trackEl.getAttribute('data-ga-content') || trackEl.getAttribute('href') || '',
        });
    });

    /**
     * Page-view tracking for content types (PRD §92)
     */
    if (typeof gtag !== 'undefined' && window.akdisiPageView) {
        const type = window.akdisiPageView.type;
        gtag('event', type === 'booth' ? 'booth_visit' : type + '_view', {
            'event_category': 'content',
            'event_label': window.akdisiPageView.title,
        });
    }

    /**
     * WhatsApp CTA tracking
     */
    document.querySelectorAll('a[href*="wa.me"], a[href*="api.whatsapp"]').forEach(function (link) {
        link.addEventListener('click', function () {
            // Track CTA click
            if (typeof gtag !== 'undefined') {
                gtag('event', 'whatsapp_click', {
                    'event_category': 'conversion',
                    'event_label': 'WhatsApp CTA',
                });
            }
        });
    });

    /**
     * Lazy loading images
     */
    if ('loading' in HTMLImageElement.prototype) {
        // Native lazy loading supported
        document.querySelectorAll('img[loading="lazy"]').forEach(function (img) {
            img.addEventListener('load', function () {
                this.classList.add('loaded');
            });
        });
    } else {
        // Fallback: simple Intersection Observer
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.add('loaded');
                        }
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function (img) {
                observer.observe(img);
            });
        }
    }
})();