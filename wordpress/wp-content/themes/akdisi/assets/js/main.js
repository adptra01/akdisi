/**
 * AKDISI v4.0.0 — main.js
 * Mobile menu, sticky header shadow, scroll-reveal (IntersectionObserver),
 * footer year, reduced-motion aware.
 */
( function () {
	'use strict';

	const prefersReduced = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* ---------- Mobile menu ---------- */
	const toggle = document.getElementById( 'nav-toggle' );
	const mobileMenu = document.getElementById( 'mobile-menu' );

	if ( toggle && mobileMenu ) {
		const setOpen = ( open ) => {
			mobileMenu.classList.toggle( 'hidden', ! open );
			toggle.setAttribute( 'aria-expanded', String( open ) );
			toggle.setAttribute( 'aria-label', open ? 'Tutup menu' : 'Buka menu' );
		};
		toggle.addEventListener( 'click', () => {
			setOpen( mobileMenu.classList.contains( 'hidden' ) );
		} );
		// Close on any link click inside.
		mobileMenu.addEventListener( 'click', ( e ) => {
			if ( e.target.closest( 'a' ) ) setOpen( false );
		} );
	}

	/* ---------- Sticky header shadow ---------- */
	const header = document.getElementById( 'site-header' );
	const onScroll = () => {
		if ( ! header ) return;
		const scrolled = window.scrollY > 8;
		header.classList.toggle( 'shadow-sm', scrolled );
	};
	window.addEventListener( 'scroll', onScroll, { passive: true } );
	onScroll();

	/* ---------- Scroll reveal ---------- */
	if ( ! prefersReduced ) {
		const observer = new IntersectionObserver(
			( entries ) => {
				entries.forEach( ( entry ) => {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-visible' );
						observer.unobserve( entry.target );
					}
				} );
			},
			{ threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
		);
		document.querySelectorAll( '[data-reveal]' ).forEach( ( el ) => observer.observe( el ) );
	} else {
		document.querySelectorAll( '[data-reveal]' ).forEach( ( el ) => el.classList.add( 'is-visible' ) );
	}

	/* ---------- Typewriter headline(s) ---------- */
	const triggerTypewriter = ( el ) => {
		// Skip if already revealed (avoid re-trigger after re-render).
		if ( el.dataset.twDone ) return;
		el.dataset.twDone = '1';
		const step = el.dataset.twStep ? parseInt( el.dataset.twStep, 10 ) : 45;
		const chars = el.querySelectorAll( '.tw-char' );
		chars.forEach( ( c, i ) => {
			setTimeout( () => c.classList.add( 'is-visible' ), i * step );
		} );
	};

	const twHeadlines = document.querySelectorAll( '[data-typewriter]' );
	if ( twHeadlines.length && ! prefersReduced && window.IntersectionObserver ) {
		const twObserver = new IntersectionObserver(
			( entries ) => {
				entries.forEach( ( entry ) => {
					if ( entry.isIntersecting ) {
						triggerTypewriter( entry.target );
						twObserver.unobserve( entry.target );
					}
				} );
			},
			{ threshold: 0.35, rootMargin: '0px 0px -40px 0px' }
		);
		twHeadlines.forEach( ( el ) => twObserver.observe( el ) );
	} else if ( twHeadlines.length ) {
		// Reduced motion or no observer: reveal everything immediately.
		twHeadlines.forEach( triggerTypewriter );
	}

	/* ---------- Contact form (AJAX) ---------- */
	const form = document.getElementById( 'akdisi-contact-form' );
	if ( form && window.akdisiData ) {
		const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		const fields = {
			name: form.querySelector( '#f-name' ),
			email: form.querySelector( '#f-email' ),
			message: form.querySelector( '#f-message' ),
		};
		const errors = {
			name: form.querySelector( '#f-name ~ .akdisi-field-error' ),
			email: form.querySelector( '#f-email ~ .akdisi-field-error' ),
			message: form.querySelector( '#f-message ~ .akdisi-field-error' ),
		};
		const status = form.querySelector( '.akdisi-form-status' );

		const setError = ( key, has ) => {
			const field = fields[ key ];
			field.classList.toggle( 'border-brand', has );
			field.classList.toggle( 'border-paper-line', ! has );
			errors[ key ].classList.toggle( 'hidden', ! has );
		};

		const validate = () => {
			let ok = true;
			if ( ! fields.name.value.trim() ) { setError( 'name', true ); ok = false; } else setError( 'name', false );
			if ( ! emailRe.test( fields.email.value.trim() ) ) { setError( 'email', true ); ok = false; } else setError( 'email', false );
			if ( fields.message.value.trim().length < 10 ) { setError( 'message', true ); ok = false; } else setError( 'message', false );
			return ok;
		};

		form.addEventListener( 'submit', async ( e ) => {
			e.preventDefault();
			if ( ! validate() ) return;
			status.classList.add( 'hidden' );
			status.textContent = '';

			const body = new URLSearchParams();
			body.set( 'action', 'akdisi_contact' );
			body.set( 'nonce', form.querySelector( '#akdisi_nonce' ).value );
			body.set( 'name', fields.name.value.trim() );
			body.set( 'email', fields.email.value.trim() );
			body.set( 'company', ( form.querySelector( '#f-company' ).value || '' ).trim() );
			body.set( 'budget', form.querySelector( '#f-budget' ).value );
			body.set( 'message', fields.message.value.trim() );

			const submit = form.querySelector( 'button[type="submit"]' );
			const original = submit.innerHTML;
			submit.disabled = true;
			submit.innerHTML = 'Sending&hellip;';

			try {
				const res = await fetch( window.akdisiData.ajaxUrl, { method: 'POST', body } );
				const data = await res.json();
				if ( data.success ) {
					form.reset();
					status.textContent = data.data.message;
					status.classList.remove( 'hidden', 'bg-brand-soft', 'text-brand' );
				} else {
					status.textContent = ( data.data && data.data.message ) || 'Something went wrong. Please try again.';
					status.classList.remove( 'hidden', 'bg-brand-soft', 'text-brand' );
					status.classList.add( 'bg-paper-alt', 'text-ink' );
				}
			} catch ( err ) {
				status.textContent = 'Network error — please try again.';
				status.classList.remove( 'hidden', 'bg-brand-soft', 'text-brand' );
				status.classList.add( 'bg-paper-alt', 'text-ink' );
			} finally {
				submit.disabled = false;
				submit.innerHTML = original;
			}
		} );
	}

	/* ---------- Newsletter form (AJAX) ---------- */
	const nlForm = document.getElementById( 'akdisi-newsletter-form' );
	if ( nlForm && window.akdisiData ) {
		const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		const nlEmail = nlForm.querySelector( 'input[name="nl-email"]' );
		const nlStatus = nlForm.querySelector( '.akdisi-nl-status' );

		nlForm.addEventListener( 'submit', async ( e ) => {
			e.preventDefault();
			const email = nlEmail.value.trim();
			if ( ! emailRe.test( email ) ) {
				nlStatus.textContent = 'Please enter a valid email.';
				nlStatus.classList.remove( 'hidden' );
				nlEmail.focus();
				return;
			}
			const btn = nlForm.querySelector( 'button[type="submit"]' );
			const original = btn.innerHTML;
			btn.disabled = true;
			btn.innerHTML = 'Joining&hellip;';

			const body = new URLSearchParams();
			body.set( 'action', 'akdisi_newsletter' );
			body.set( 'nonce', nlForm.querySelector( '#akdisi_nl_nonce' ).value );
			body.set( 'email', email );

			try {
				const res = await fetch( window.akdisiData.ajaxUrl, { method: 'POST', body } );
				const data = await res.json();
				nlStatus.textContent = data.success ? data.data.message : ( data.data && data.data.message ) || 'Could not subscribe. Try again.';
				if ( data.success ) {
					nlEmail.value = '';
					nlStatus.classList.add( 'text-brand-soft', 'text-brand', 'font-medium' );
				} else {
					nlStatus.classList.remove( 'text-brand-soft', 'text-brand', 'font-medium' );
				}
				nlStatus.classList.remove( 'hidden' );
			} catch ( err ) {
				nlStatus.textContent = 'Network error — please try again.';
				nlStatus.classList.remove( 'hidden', 'text-brand-soft', 'text-brand', 'font-medium' );
			} finally {
				btn.disabled = false;
				btn.innerHTML = original;
			}
		} );
	}
} )();