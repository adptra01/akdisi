<?php
/**
 * Perkasa theme functions.
 *
 * @package Perkasa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup.
 */
function perkasa_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 160,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Menu Utama', 'perkasa' ),
		'footer'  => __( 'Menu Footer', 'perkasa' ),
	) );

	add_image_size( 'perkasa-wide', 1280, 720, true );
	add_image_size( 'perkasa-card', 760, 500, true );
}
add_action( 'after_setup_theme', 'perkasa_setup' );

/**
 * Enqueue assets.
 */
function perkasa_scripts() {
	// Tailwind CDN (Play — staging only).
	wp_enqueue_script(
		'tailwind-cdn',
		'https://cdn.tailwindcss.com',
		array(),
		'3.4.0',
		true
	);

	// Tailwind config (must load AFTER cdn).
	wp_add_inline_script( 'tailwind-cdn', "
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						ink:    '#1f2937',
						'ink-soft': '#4b5563',
						'ink-faint': '#9ca3af',
						brand:  '#1565c0',
						'brand-hover': '#1256a8',
						'brand-soft': '#e8f0fe',
						accent: '#f59e0b',
						dark:   '#0f172a',
						'dark-alt': '#1e293b',
						paper:  '#ffffff',
						'paper-alt': '#f8f9fa',
						'paper-line': '#e5e7eb',
					},
					fontFamily: {
						display: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
						body:    ['Inter', 'system-ui', 'sans-serif'],
					},
					container: { DEFAULT: '1200px' },
				},
			},
		}
	", 'after' );

	// Google Fonts.
	wp_enqueue_style( 'perkasa-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap', array(), null );

	// Theme styles.
	wp_enqueue_style( 'perkasa-style', get_stylesheet_uri(), array( 'perkasa-fonts' ), '1.0.0' );

	// Main JS.
	wp_enqueue_script( 'perkasa-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'perkasa_scripts' );

/**
 * Fallback primary menu.
 */
function perkasa_fallback_menu() {
	$items = array(
		__( 'Beranda', 'perkasa' )   => home_url( '/' ),
		__( 'Layanan', 'perkasa' )   => home_url( '/layanan/' ),
		__( 'Tentang', 'perkasa' )   => home_url( '/tentang/' ),
		__( 'Proyek', 'perkasa' )    => home_url( '/proyek/' ),
		__( 'Kontak', 'perkasa' )    => home_url( '/kontak/' ),
	);
	echo '<ul class="flex flex-col gap-2 md:flex-row md:gap-6">';
	foreach ( $items as $label => $url ) {
		$cls = ( is_page( wp_parse_url( $url, PHP_URL_PATH ) ) ) ? 'text-brand font-semibold' : 'hover:text-brand';
		printf( '<li><a class="text-sm font-medium %s" href="%s">%s</a></li>', $cls, esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Fallback footer menu.
 */
function perkasa_fallback_footer() {
	$links = array(
		__( 'Beranda', 'perkasa' )   => home_url( '/' ),
		__( 'Layanan', 'perkasa' )   => home_url( '/layanan/' ),
		__( 'Tentang', 'perkasa' )   => home_url( '/tentang/' ),
		__( 'Proyek', 'perkasa' )    => home_url( '/proyek/' ),
		__( 'Kontak', 'perkasa' )    => home_url( '/kontak/' ),
	);
	echo '<ul class="space-y-2 text-sm">';
	foreach ( $links as $label => $url ) {
		printf( '<li><a href="%s" class="hover:text-white transition-colors">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Footer services.
 */
function perkasa_footer_services() {
	return array(
		__( 'Konstruksi Gedung', 'perkasa' )       => home_url( '/layanan/' ),
		__( 'Infrastruktur & Jalan', 'perkasa' )   => home_url( '/layanan/' ),
		__( 'Renovasi & Rehabilitasi', 'perkasa' ) => home_url( '/layanan/' ),
		__( 'Konsultasi Teknis', 'perkasa' )       => home_url( '/layanan/' ),
	);
}

/**
 * SEO meta (simple — no plugin needed).
 */
function perkasa_seo_meta() {
	if ( is_singular() && ! is_front_page() ) {
		$desc = get_the_excerpt();
		if ( $desc ) {
			$desc = wp_strip_all_tags( $desc );
			$desc = substr( $desc, 0, 155 );
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
		}
	}
}
add_action( 'wp_head', 'perkasa_seo_meta', 5 );
