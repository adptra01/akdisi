<?php
/**
 * Garuda Perkasa — functions & includes.
 *
 * Tema WordPress company profile (fake project) — Jasa Konstruksi & Sipil.
 * Design v3: "Blueprint Engineering" — slate hitam + amber + steel,
 * Tailwind Play CDN + Flowbite 2.5.2 + GSAP 3.12.5 (ScrollTrigger).
 *
 * @package Garuda_Perkasa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PERKASA_VERSION', '3.2.0' );

/* -------------------------------------------------------------------------
 * Theme setup
 * ---------------------------------------------------------------------- */
function perkasa_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	register_nav_menus(
		array(
			'primary'        => __( 'Menu Utama (navbar + footer Perusahaan)', 'perkasa' ),
			'footer'         => __( 'Menu Footer (Perusahaan)', 'perkasa' ),
			'footer-services' => __( 'Menu Footer (Layanan)', 'perkasa' ),
		)
	);

	add_image_size( 'perkasa-wide', 1280, 720, true );
}
add_action( 'after_setup_theme', 'perkasa_setup' );

/* -------------------------------------------------------------------------
 * Assets — Tailwind Play CDN + config inline, Flowbite, GSAP, main.js
 * ---------------------------------------------------------------------- */
function perkasa_scripts() {
	// Google Fonts: Archivo (display) + Inter (body).
	wp_enqueue_style(
		'perkasa-fonts',
		'https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Stylesheet utama (tokens + komponen custom).
	wp_enqueue_style( 'perkasa-style', get_stylesheet_uri(), array( 'perkasa-fonts' ), PERKASA_VERSION );

	// Flowbite CSS (komponen library Tailwind).
	wp_enqueue_style(
		'flowbite-css',
		'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.css',
		array( 'perkasa-style' ),
		'2.5.2'
	);

	// Tailwind Play CDN (staging/dev — produksi → compile statis).
	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, true );

	// Konfigurasi Tailwind — HARUS jalan SETELAH CDN parses ('after').
	$tw_config = <<<'JS'
tailwind.config = {
	theme: {
		extend: {
			fontFamily: {
				display: ['Archivo', 'sans-serif'],
				body: ['Inter', 'sans-serif'],
			},
			container: { center: true, padding: '1.25rem' },
		},
	},
};
JS;
	wp_add_inline_script( 'tailwind-cdn', $tw_config, 'after' );

	// Flowbite JS (navbar collapse, accordion, dll.).
	wp_enqueue_script(
		'flowbite',
		'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.js',
		array(),
		'2.5.2',
		true
	);

	// GSAP + ScrollTrigger.
	wp_enqueue_script( 'gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), '3.12.5', true );
	wp_enqueue_script(
		'gsap-scrolltrigger',
		'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
		array( 'gsap' ),
		'3.12.5',
		true
	);

	// Script utama tema.
	wp_enqueue_script(
		'perkasa-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array( 'gsap', 'gsap-scrolltrigger', 'flowbite' ),
		PERKASA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'perkasa_scripts' );

/* -------------------------------------------------------------------------
 * Navigasi fallback (bila menu belum di-assign)
 * ---------------------------------------------------------------------- */
function perkasa_nav_fallback() {
	$items = array(
		'/'        => 'Beranda',
		'/proyek/' => 'Proyek',
		'/layanan/' => 'Layanan',
		'/tentang/' => 'Tentang',
		'/kontak/' => 'Kontak',
	);

	echo '<ul class="flex items-center gap-1 lg:gap-2">';
	foreach ( $items as $url => $label ) {
		$active = ( home_url( $url ) === get_permalink() ) ? ' text-amber-500' : ' text-slate-200';
		printf(
			'<li><a href="%s" class="nav-link px-3 py-2 text-sm font-medium transition-colors hover:text-amber-500%s">%s</a></li>',
			esc_url( home_url( $url ) ),
			esc_attr( $active ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

function perkasa_footer_nav_fallback() {
	$items = array(
		'/proyek/'  => 'Proyek',
		'/layanan/' => 'Layanan',
		'/tentang/' => 'Tentang',
		'/kontak/'  => 'Kontak',
	);
	echo '<ul class="space-y-2.5">';
	foreach ( $items as $url => $label ) {
		printf(
			'<li><a href="%s" class="text-sm text-slate-400 transition-colors hover:text-amber-400">%s</a></li>',
			esc_url( home_url( $url ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/* -------------------------------------------------------------------------
 * Footer — kolom Layanan (fallback saat menu footer-services belum di-assign)
 * ---------------------------------------------------------------------- */
function perkasa_footer_services_fallback() {
	$items = array(
		'/layanan/#gedung'        => 'Konstruksi Gedung',
		'/layanan/#infrastruktur' => 'Infrastruktur & Jalan',
		'/layanan/#renovasi'      => 'Renovasi & Rehabilitasi',
		'/layanan/#konsultasi'    => 'Konsultasi & Manajemen',
	);
	echo '<ul class="space-y-2.5">';
	foreach ( $items as $url => $label ) {
		printf(
			'<li><a href="%s" class="text-sm text-slate-400 transition-colors hover:text-amber-400">%s</a></li>',
			esc_url( home_url( $url ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/* -------------------------------------------------------------------------
 * Info kontak — dinamis via Customizer (wp-admin → Appearance → Customize)
 * ---------------------------------------------------------------------- */
function perkasa_get_contact( $key ) {
	$defaults = array(
		'address'   => 'Jl. Raya Industri No. 88, Jakarta Selatan 12345',
		'email'     => 'info@garudaperkasa.co.id',
		'phone'     => '(021) 5550-1234',
		'whatsapp'  => '6281234567890',
	);
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'perkasa_contact_' . $key, $default );
}

/**
 * Nomor WhatsApp tampilan lokal (628xx → 0xxx-xxxx-xxxx).
 *
 * @param string $number Nomor internasional tanpa "+".
 * @return string
 */
function perkasa_wa_display( $number ) {
	$digits = preg_replace( '/\D+/', '', $number );
	if ( 0 === strpos( $digits, '62' ) ) {
		$digits = '0' . substr( $digits, 2 );
	}
	return implode( '-', str_split( $digits, 4 ) );
}

/* -------------------------------------------------------------------------
 * Data proyek — sumber: plugin Perkasa Project Manager (CPT), fallback seed
 * ---------------------------------------------------------------------- */

/**
 * Seed default (saat CPT kosong / plugin nonaktif) — 6 proyek branding v3.
 *
 * @return array[]
 */
function perkasa_default_projects() {
	return array(
		array(
			'n'      => '01',
			't'      => 'Menara Graha Nusantara',
			'loc'    => 'Jakarta Selatan',
			'yr'     => '2024',
			'cat'    => 'Gedung',
			'dur'    => '21 bulan',
			'val'    => 'Komersial',
			'stat'   => 'Selesai',
			'd'      => 'Menara perkantoran 28 lantai dengan 2 basement, curtain wall double-glazed, dan sertifikasi greenship. Dibangun di atas lahan 4.200 m² dengan struktur beton + core baja.',
			'feats'  => array( '28 lantai + 2 basement', 'Curtain wall double-glazed', 'Greenship Gold', '3.200 m² per lantai tipikal' ),
		),
		array(
			'n'      => '02',
			't'      => 'Jalan Tol Trans Sumatra Seksi 5',
			'loc'    => 'Riau',
			'yr'     => '2023',
			'cat'    => 'Infrastruktur',
			'dur'    => '30 bulan',
			'val'    => 'Nasional',
			'stat'   => 'Selesai',
			'd'      => '42 km jalan tol dua arah, 4 interchange, 6 jembatan layang, dan rest area. Dibuka 2 bulan lebih awal dari kontrak setelah percepatan tanpa mengorbankan QC.',
			'feats'  => array( '42 km jalur tol', '4 interchange', '6 jembatan layang', 'Rest area + SPBU' ),
		),
		array(
			'n'      => '03',
			't'      => 'Rusunawa Nelayan Muara Angke',
			'loc'    => 'Jakarta Utara',
			'yr'     => '2022',
			'cat'    => 'Hunian',
			'dur'    => '18 bulan',
			'val'    => 'Pemerintah',
			'stat'   => 'Selesai',
			'd'      => '480 unit rumah susun sederhana sewa untuk nelayan, lengkap dengan ruang usaha bersama, taman, dan area bongkar muat hasil laut.',
			'feats'  => array( '480 unit hunian', 'Ruang usaha bersama', 'Area bongkar muat', 'Manajemen K3 site padat' ),
		),
		array(
			'n'      => '04',
			't'      => 'Jembatan Batanghari',
			'loc'    => 'Jambi',
			'yr'     => '2024',
			'cat'    => 'Infrastruktur',
			'dur'    => '36 bulan',
			'val'    => 'Nasional',
			'stat'   => 'Selesai',
			'd'      => 'Jembatan cable-stayed dengan bentang utama 380 m, menghubungkan dua kawasan ekonomi di lintas Sungai Batanghari. Fondasi bored pile kedalaman 45 m.',
			'feats'  => array( 'Bentang utama 380 m', 'Cable-stayed', 'Bored pile 45 m', '2 jalur + pejalan kaki' ),
		),
		array(
			'n'      => '05',
			't'      => 'Pabrik Pengolahan PT Sinar Mas',
			'loc'    => 'Karawang',
			'yr'     => '2023',
			'cat'    => 'Industrial',
			'dur'    => '24 bulan',
			'val'    => 'Industrial',
			'stat'   => 'Selesai',
			'd'      => 'Kawasan pabrik seluas 12 ha: struktur baja 40.000 m², utilitas terpadu, sistem pengolahan limbah, dan infrastruktur internal kawasan.',
			'feats'  => array( 'Lahan 12 ha', 'Struktur baja 40.000 m²', 'Utilitas & limbah terpadu', 'Jalan internal kawasan' ),
		),
		array(
			'n'      => '06',
			't'      => 'Revitalisasi GBK Ring 2',
			'loc'    => 'Jakarta Pusat',
			'yr'     => '2024',
			'cat'    => 'Sport',
			'dur'    => '14 bulan',
			'val'    => 'Pemerintah',
			'stat'   => 'Selesai',
			'd'      => 'Rehabilitasi tribun, canopy, dan tunnel stadion untuk kesiapan event internasional. Pekerjaan dilakukan tanpa menghentikan operasional venue secara penuh.',
			'feats'  => array( 'Rehabilitasi tribun', 'Canopy & tunnel', 'Sertifikasi venue internasional', 'Konstruksi tanpa henti operasi' ),
		),
	);
}

/**
 * Data proyek yang dipakai template — CPT (plugin) atau seed default.
 *
 * @return array[]
 */
function perkasa_get_projects() {
	if ( function_exists( 'perkasa_pm_get_projects' ) ) {
		$projects = perkasa_pm_get_projects();
		if ( ! empty( $projects ) ) {
			return $projects;
		}
	}
	return perkasa_default_projects();
}

/* -------------------------------------------------------------------------
 * SEO — pola output Yoast SEO (meta desc, canonical, robots, OG, Twitter,
 * Schema.org JSON-LD). Identitas memakai theme_mods Garuda Perkasa, bukan
 * blogname global (yang milik AKDISI).
 * ---------------------------------------------------------------------- */
require get_template_directory() . '/inc/seo.php';

/* -------------------------------------------------------------------------
 * Kecil-kecil: excerpt length & content width
 * ---------------------------------------------------------------------- */
add_filter( 'excerpt_length', function () { return 22; } );
add_filter( 'excerpt_more', function () { return '&hellip;'; } );

if ( ! isset( $content_width ) ) {
	$content_width = 1280;
}

/* -------------------------------------------------------------------------
 * Customizer — info kontak footer (wp-admin → Appearance → Customize)
 * ---------------------------------------------------------------------- */
require get_template_directory() . '/inc/customizer.php';