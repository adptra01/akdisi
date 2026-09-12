<?php
/**
 * AKDISI v4.7.0 — Digital Agency theme functions.
 *
 * @package AKDISI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AKDISI_VERSION', '4.8.0' );

/**
 * Theme setup: menus, supports, image sizes.
 */
function akdisi_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 48, 'width' => 200, 'flex-width' => true ) );

	register_nav_menus(
		array(
			'primary'        => __( 'Menu Utama', 'akdisi' ),
			'footer'         => __( 'Menu Footer', 'akdisi' ),
			'footer-services' => __( 'Menu Layanan Footer', 'akdisi' ),
		)
	);

	// Editorial, warm-tinted image crops for cards.
	add_image_size( 'akdisi-card', 760, 500, true );   // 3:2-ish
	add_image_size( 'akdisi-wide', 1280, 720, true ); // 16:9
	add_image_size( 'akdisi-avatar', 120, 120, true );
}
add_action( 'after_setup_theme', 'akdisi_setup' );

/**
 * Content width.
 */
function akdisi_content_width() {
	$GLOBALS['content_width'] = 1280;
}
add_action( 'after_setup_theme', 'akdisi_content_width', 0 );

/**
 * Enqueue assets: Tailwind CDN (no-build dev), Google Fonts, theme css/js.
 */
function akdisi_scripts() {
	// Satoshi (display) via Fontshare + Outfit (body) via Google Fonts.
	wp_enqueue_style(
		'akdisi-fonts',
		'https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700,900&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'akdisi-outfit',
		'https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Tailwind Play CDN — dynamic (no build step). Runtime CSS rendering on client.
	wp_enqueue_script(
		'akdisi-tailwind',
		'https://cdn.tailwindcss.com',
		array(),
		'3.4.16',
		false
	);
	// Config MUST run AFTER the CDN script is parsed: with 'before' the IIFE saw
	// `typeof tailwind === 'undefined'` and bailed, so custom colors (ink, brand,
	// paper) were never registered → bg-ink/text-brand etc. silently missing.
	wp_add_inline_script( 'akdisi-tailwind', akdisi_tailwind_config(), 'after' );

	// Theme css (tokens + components; no cross-type deps — Tailwind CDN injects its own <style>).
	wp_enqueue_style( 'akdisi-style', get_stylesheet_uri(), array(), AKDISI_VERSION );

	// Theme js.
	wp_enqueue_script( 'akdisi-main', get_template_directory_uri() . '/assets/js/main.js', array(), AKDISI_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'akdisi_scripts' );

// SEO ala Yoast (meta, robots, canonical, OG, Twitter, Schema.org) — inc/seo.php.
// Customizer "Info Kontak" (email/WA/lokasi/jam kerja) — inc/customizer.php.
// Keduanya auto-loaded via glob inc/*.php di bawah.

/**
 * Tailwind v3 CDN runtime config — palette & fonts.
 */
function akdisi_tailwind_config() {
	return <<<'JS'
(function(){
  if (typeof tailwind === 'undefined') return;
  tailwind.config = {
    theme: {
      extend: {
        container: { center: true, padding: 'clamp(1rem,4vw,2.5rem)', screens: { '2xl':'1280px' } },
        colors: {
          brand: {
            DEFAULT: '#c2543d',
            dark: '#a8432f',
            soft: '#fbe9e6',
            softer: '#fdf3f1',
          },
          ink: {
            DEFAULT: '#1c1917',
            soft: '#57534e',
            faint: '#78716c',
          },
          paper: { DEFAULT: '#ffffff', alt: '#f7f5f2', line: '#e7e2dc' },
        },
        fontFamily: {
          display: ['Satoshi','Outfit','sans-serif'],
          body: ['Outfit','sans-serif'],
        },
      },
    },
  };
})();
JS;
}

/**
 * Register content types khusus tema.
 * Catatan: CPT `akdisi_project` (+ taksonomi) kini didaftarkan plugin
 * akdisi-info-manager; Insight memakai Pos (post) bawaan WordPress.
 */
function akdisi_register_post_types() {

	register_post_type(
		'akdisi_faq',
		array(
			'labels'       => array( 'name' => __( 'FAQ', 'akdisi' ), 'singular_name' => __( 'FAQ', 'akdisi' ) ),
			'public'       => false,
			'show_ui'      => true,
			'menu_icon'    => 'dashicons-editor-help',
			'show_in_rest' => true,
			'supports'     => array( 'title', 'editor' ),
		)
	);
}
add_action( 'init', 'akdisi_register_post_types' );

/**
 * Testimonials as comments-free custom post type (kept simple).
 */
function akdisi_register_testimonials() {
	register_post_type(
		'akdisi_testimonial',
		array(
			'labels'       => array( 'name' => __( 'Testimoni', 'akdisi' ), 'singular_name' => __( 'Testimoni', 'akdisi' ) ),
			'public'       => true,
			'has_archive'  => false,
			'menu_icon'    => 'dashicons-format-quote',
			'show_in_rest' => true,
			'supports'     => array( 'title', 'editor' ),
		)
	);
}
add_action( 'init', 'akdisi_register_testimonials' );

/**
 * Typography-friendly excerpt.
 */
function akdisi_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'akdisi_excerpt_more' );

/**
 * Body class helpers.
 */
function akdisi_body_class( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'akdisi-home';
	}
	return $classes;
}
add_filter( 'body_class', 'akdisi_body_class' );

// Load optional single-file components (metaboxes, helpers).
foreach ( glob( get_template_directory() . '/inc/*.php' ) as $file ) {
	require_once $file;
}
