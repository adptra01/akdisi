/**
 * Perkasa theme — main.js
 *
 * Handles: sticky header shadow, mobile menu toggle,
 * reveal-on-scroll (IntersectionObserver), contact form validation.
 */
(function () {
  'use strict';

  /* ── Sticky header shadow ── */
  const header = document.getElementById('site-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('shadow-md', window.scrollY > 10);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ── Mobile menu toggle ── */
  const toggle = document.getElementById('menu-toggle');
  const menu   = document.getElementById('mobile-menu');
  const iconM  = document.getElementById('icon-menu');
  const iconX  = document.getElementById('icon-close');

  if (toggle && menu) {
    toggle.addEventListener('click', () => {
      const open = menu.classList.toggle('hidden') === false;
      toggle.setAttribute('aria-expanded', open);
      toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
      if (iconM) iconM.classList.toggle('hidden', open);
      if (iconX) iconX.classList.toggle('hidden', !open);
    });
  }

  /* ── Reveal on scroll ── */
  const reveals = document.querySelectorAll('[data-reveal]');
  if (reveals.length) {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) {
      reveals.forEach(el => el.classList.add('is-visible'));
    } else if ('IntersectionObserver' in window) {
      const obs = new IntersectionObserver(
        entries => {
          entries.forEach(e => {
            if (e.isIntersecting) {
              e.target.classList.add('is-visible');
              obs.unobserve(e.target);
            }
          });
        },
        { threshold: 0.12, rootMargin: '0px 0px -32px 0px' }
      );
      reveals.forEach(el => obs.observe(el));
    } else {
      reveals.forEach(el => el.classList.add('is-visible'));
    }
  }

  /* ── Contact form (client-side only — fake project) ── */
  const form = document.getElementById('perkasa-contact-form');
  if (form) {
    const fields = {
      name:    { el: form.querySelector('#cf-name'),    rules: ['required'] },
      email:   { el: form.querySelector('#cf-email'),   rules: ['required', 'email'] },
      need:    { el: form.querySelector('#cf-need'),    rules: ['required'] },
      message: { el: form.querySelector('#cf-msg'),     rules: ['required'] },
    };

    const clearError = (f) => {
      const err = f.el.parentElement.querySelector('.field-error');
      if (err) { err.textContent = ''; err.classList.add('hidden'); }
      f.el.classList.remove('border-red-500');
    };

    const showError = (f, msg) => {
      const err = f.el.parentElement.querySelector('.field-error');
      if (err) { err.textContent = msg; err.classList.remove('hidden'); }
      f.el.classList.add('border-red-500');
    };

    const validate = () => {
      let ok = true;
      Object.values(fields).forEach(clearError);
      Object.entries(fields).forEach(([key, f]) => {
        const val = (f.el.value || '').trim();
        for (const r of f.rules) {
          if (r === 'required' && !val) { showError(f, 'Field ini wajib diisi.'); ok = false; break; }
          if (r === 'email' && val && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) { showError(f, 'Format email tidak valid.'); ok = false; break; }
        }
      });
      return ok;
    };

    // Clear errors on input
    Object.values(fields).forEach(f => {
      f.el.addEventListener('input', () => clearError(f));
      f.el.addEventListener('change', () => clearError(f));
    });

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const status = form.querySelector('.perkasa-form-status');
      if (!validate()) {
        // Focus first error
        const firstErr = form.querySelector('.border-red-500');
        if (firstErr) firstErr.focus();
        return;
      }
      // Simulate success (no backend — fake project)
      form.style.display = 'none';
      if (status) {
        status.textContent = 'Terima kasih! Pesan Anda sudah kami terima. Kami akan menghubungi Anda dalam 1 hari kerja.';
        status.className = 'perkasa-form-status rounded-lg bg-green-50 px-4 py-3 text-sm text-green-800';
      }
    });
  }

})();
