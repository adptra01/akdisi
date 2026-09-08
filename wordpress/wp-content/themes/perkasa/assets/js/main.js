/**
 * Garuda Perkasa — main.js v3
 *
 * GSAP 3.12.5 + ScrollTrigger, Flowbite init, form validation inline,
 * header shadow. Guard penuh prefers-reduced-motion.
 */
(function () {
	'use strict';

	document.documentElement.classList.add('js');

	var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var gsapApi = window.gsap;

	/* ------------------------------------------------------------------
	 * Header shadow saat scroll
	 * ------------------------------------------------------------------ */
	var header = document.getElementById('perkasa-header');
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 12);
		};
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	/* ------------------------------------------------------------------
	 * Flowbite (pasti ter-init setelah DOM siap)
	 * ------------------------------------------------------------------ */
	if (window.initFlowbite) {
		window.initFlowbite();
	}

	if (!gsapApi || prefersReduced) {
		return; // Konten tetap terlihat via CSS reduced-motion fallback.
	}

	var ScrollTriggerApi = window.ScrollTrigger;

	/* ------------------------------------------------------------------
	 * Hero clip-reveal per baris
	 * ------------------------------------------------------------------ */
	var hero = document.querySelector('[data-hero]');
	if (hero) {
		var heroLines = hero.querySelectorAll('[data-hero-line]');
		if (heroLines.length) {
			gsapApi.set(heroLines, { yPercent: 115 });
			gsapApi.to(heroLines, {
				yPercent: 0,
				duration: 0.95,
				ease: 'power4.out',
				stagger: 0.14,
				delay: 0.15,
			});
		}
	}

	/* ------------------------------------------------------------------
	 * Reveal on scroll — trigger PER ELEMEN (bukan satu trigger global),
	 * supaya animasi muncul tepat saat elemen masuk viewport.
	 * ------------------------------------------------------------------ */
	var revealEls = document.querySelectorAll('[data-reveal]');
	revealEls.forEach(function (el) {
		gsapApi.fromTo(
			el,
			{ opacity: 0, y: 26 },
			{
				opacity: 1,
				y: 0,
				duration: 0.75,
				ease: 'power2.out',
				immediateRender: true,
				scrollTrigger: {
					trigger: el,
					start: 'top 88%',
					once: true,
				},
			}
		);
	});

	/* ------------------------------------------------------------------
	 * Parallax dekoratif (decorative layer only — bukan teks/kontrol)
	 * ------------------------------------------------------------------ */
	document.querySelectorAll('[data-parallax]').forEach(function (el) {
		var speed = parseFloat(el.getAttribute('data-parallax')) || 8;
		gsapApi.to(el, {
			yPercent: speed,
			ease: 'none',
			scrollTrigger: {
				trigger: el.parentElement,
				start: 'top bottom',
				end: 'bottom top',
				scrub: true,
			},
		});
	});

	/* ------------------------------------------------------------------
	 * Count-up stat
	 * ------------------------------------------------------------------ */
	document.querySelectorAll('[data-count]').forEach(function (el) {
		var target = parseInt(el.getAttribute('data-count'), 10) || 0;
		gsapApi.fromTo(
			el,
			{ innerText: 0 },
			{
				innerText: target,
				duration: 1.6,
				ease: 'power1.inOut',
				snap: { innerText: 1 },
				scrollTrigger: { trigger: el, start: 'top 90%', once: true },
			}
		);
	});

	/* ------------------------------------------------------------------
	 * Proyek unggulan — pin horizontal (desktop only; mobile vertikal biasa)
	 * ------------------------------------------------------------------ */
	var mm = gsapApi.matchMedia();

	mm.add('(min-width: 1024px)', function () {
		var section = document.querySelector('[data-projects-section]');
		var track = document.querySelector('[data-projects-track]');
		if (!section || !track) {
			return;
		}

		var getDist = function () {
			return track.scrollWidth - window.innerWidth;
		};

		var cards = track.querySelectorAll('.gp-card-dark').length;
		var snapVal = cards > 1 ? 1 / (cards - 1) : 1;

		var tween = gsapApi.to(track, {
			x: function () { return -getDist(); },
			ease: 'none',
			scrollTrigger: {
				// Pin SECTION, bukan wrapper card — seluruh section ikut dikunci
				// selama scroll horizontal; section berikutnya baru naik setelah
				// pin selesai (tanpa tumpang tindih / track tertutup).
				trigger: section,
				start: 'top top',
				end: function () { return '+=' + getDist(); },
				scrub: 1,
				pin: true,
				snap: snapVal,
				invalidateOnRefresh: true,
				anticipatePin: 1,
			},
		});

		return function () {
			tween.scrollTrigger && tween.scrollTrigger.kill();
			tween.kill();
		};
	});

	// Refresh layout after fonts/images selesai.
	window.addEventListener('load', function () {
		if (ScrollTriggerApi && ScrollTriggerApi.refresh) {
			ScrollTriggerApi.refresh();
		}
	});

	/* ------------------------------------------------------------------
	 * Form kontak — validasi inline (required/email/select) + fokus pertama
	 * ------------------------------------------------------------------ */
	var form = document.getElementById('perkasa-contact-form');
	if (form) {
		var fields = [
			{ id: 'f-nama', rule: 'required', msg: 'Nama wajib diisi.' },
			{ id: 'f-email', rule: 'email', msg: 'Format email tidak valid.' },
			{ id: 'f-telp', rule: 'required', msg: 'Nomor telepon wajib diisi.' },
			{ id: 'f-jenis', rule: 'select', msg: 'Pilih jenis proyek.' },
			{ id: 'f-pesan', rule: 'required', msg: 'Pesan wajib diisi.' },
		];

		var clearError = function (f) {
			var el = document.getElementById(f.id);
			var err = document.getElementById(f.id + '-error');
			el.classList.remove('border-red-500');
			el.removeAttribute('aria-invalid');
			if (err) {
				err.textContent = '';
				err.classList.add('hidden');
			}
		};

		var showError = function (f) {
			var el = document.getElementById(f.id);
			var err = document.getElementById(f.id + '-error');
			el.classList.add('border-red-500');
			el.setAttribute('aria-invalid', 'true');
			if (err) {
				err.textContent = f.msg;
				err.classList.remove('hidden');
			}
		};

		fields.forEach(function (f) {
			var el = document.getElementById(f.id);
			if (el) {
				el.addEventListener('input', function () { clearError(f); });
				el.addEventListener('change', function () { clearError(f); });
			}
		});

		form.addEventListener('submit', function (e) {
			e.preventDefault();

			var ok = true;
			var firstBad = null;

			fields.forEach(function (f) {
				var el = document.getElementById(f.id);
				var val = el ? el.value.trim() : '';
				var bad = false;

				if (f.rule === 'required' && !val) { bad = true; }
				if (f.rule === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) { bad = true; }
				if (f.rule === 'select' && !val) { bad = true; }

				if (bad) {
					showError(f);
					ok = false;
					if (!firstBad) { firstBad = el; }
				} else {
					clearError(f);
				}
			});

			if (!ok) {
				if (firstBad) { firstBad.focus(); }
				return;
			}

			// Sukses (simulasi — proyek fiktif, tanpa backend).
			form.classList.add('hidden');
			var success = document.getElementById('perkasa-form-success');
			if (success) { success.classList.remove('hidden'); }
		});
	}
})();