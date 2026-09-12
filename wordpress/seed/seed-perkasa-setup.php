<?php
/**
 * Seed Setup — Garuda Perkasa Theme (fresh install bootstrap).
 *
 * Jalankan setelah upload & aktivasi tema perkasa (plugin
 * perkasa-project-manager opsional — tema punya fallback):
 *
 *   ddev wp eval-file wordpress/seed/seed-perkasa-setup.php
 *
 * Idempotent by slug. Membuat:
 *   - Pages: Beranda (front), Layanan, Proyek, Tentang, Kontak
 *   - Template assignment (page-*.php)
 *   - Menus + lokasi: Menu Utama Perkasa (primary & footer),
 *     Layanan Perkasa (footer-services)
 *   - Setting front page
 *
 * @package Perkasa
 */

function seed_perkasa_page_exists( $slug ) {
	$q = get_page_by_path( $slug, OBJECT, 'page' );
	return $q ? $q->ID : 0;
}

function seed_perkasa_ensure_page( $slug, $title, $template, $content = '' ) {
	$id = seed_perkasa_page_exists( $slug );
	if ( ! $id ) {
		$id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => $content,
			),
			true
		);
		if ( is_wp_error( $id ) ) {
			return 0;
		}
	}
	if ( 'default' === get_page_template_slug( $id ) && $template ) {
		update_post_meta( $id, '_wp_page_template', $template );
	}
	return $id;
}

function seed_perkasa_ensure_menu( $title, $slug ) {
	$menu = wp_get_nav_menu_object( $slug );
	if ( $menu ) {
		return (int) $menu->term_id;
	}
	$id = wp_create_nav_menu( $title );
	return is_wp_error( $id ) ? 0 : (int) $id;
}

function seed_perkasa_menu_item( $menu_id, $label, $url ) {
	$items = wp_get_nav_menu_items( $menu_id );
	if ( $items ) {
		foreach ( $items as $it ) {
			if ( untrailingslashit( $it->url ) === untrailingslashit( $url ) ) {
				return;
			}
		}
	}
	wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-title'  => $label,
			'menu-item-url'    => $url,
			'menu-item-status' => 'publish',
		)
	);
}

$home    = seed_perkasa_ensure_page( 'home', 'Beranda', '', '<p>Selamat datang di Garuda Perkasa.</p>' );
$layanan = seed_perkasa_ensure_page( 'layanan', 'Layanan', 'page-layanan.php' );
$proyek  = seed_perkasa_ensure_page( 'proyek', 'Proyek', 'page-proyek.php' );
$tentang = seed_perkasa_ensure_page( 'tentang', 'Tentang', 'page-tentang.php' );
$kontak  = seed_perkasa_ensure_page( 'kontak', 'Kontak', 'page-kontak.php' );

// Menu Utama — lokasi 'primary' (navbar) DAN 'footer' (kolom Perusahaan).
$utama = seed_perkasa_ensure_menu( 'Menu Utama Perkasa', 'menu-utama-perkasa' );
foreach ( array(
	'Beranda' => home_url( '/' ),
	'Proyek'  => home_url( '/proyek/' ),
	'Layanan' => home_url( '/layanan/' ),
	'Tentang' => home_url( '/tentang/' ),
	'Kontak'  => home_url( '/kontak/' ),
) as $label => $url ) {
	seed_perkasa_menu_item( $utama, $label, $url );
}

// Menu Layanan — lokasi 'footer-services' (4 anchor halaman layanan).
$layanan_menu = seed_perkasa_ensure_menu( 'Layanan Perkasa', 'layanan-perkasa' );
foreach ( array(
	'Konstruksi Gedung'            => home_url( '/layanan/#gedung' ),
	'Infrastruktur & Jalan'        => home_url( '/layanan/#infrastruktur' ),
	'Renovasi & Rehabilitasi'      => home_url( '/layanan/#renovasi' ),
	'Konsultasi & Manajemen'       => home_url( '/layanan/#konsultasi' ),
) as $label => $url ) {
	seed_perkasa_menu_item( $layanan_menu, $label, $url );
}

$locations = get_theme_mod( 'nav_menu_locations', array() );
$locations['primary']         = $utama;
$locations['footer']          = $utama;
$locations['footer-services'] = $layanan_menu;
set_theme_mod( 'nav_menu_locations', $locations );

if ( 'page' !== get_option( 'show_on_front' ) || (int) get_option( 'page_on_front' ) !== $home ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home );
	update_option( 'page_for_posts', 0 );
}

flush_rewrite_rules();

echo "[seed-perkasa] done — home=$home layanan=$layanan proyek=$proyek utama=$utama layanan-menu=$layanan_menu\n";