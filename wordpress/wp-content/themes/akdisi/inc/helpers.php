<?php
/**
 * AKDISI template helpers.
 *
 * @package AKDISI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fallback primary menu when none is assigned.
 *
 * @param array $args wp_nav_menu args.
 */
function akdisi_fallback_menu( $args = array() ) {
	$items = array(
		__( 'Layanan', 'akdisi' )    => home_url( '/layanan/' ),
		__( 'Proyek', 'akdisi' )     => home_url( '/projects/' ),
		__( 'Tentang', 'akdisi' )    => home_url( '/tentang/' ),
		__( 'Insight', 'akdisi' )    => home_url( '/insight/' ),
		__( 'Kontak', 'akdisi' )     => home_url( '/kontak/' ),
	);
	printf( '<ul class="%s">', isset( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : '' );
	foreach ( $items as $label => $url ) {
		$cls = ( is_page( wp_parse_url( $url, PHP_URL_PATH ) ) ) ? 'text-brand' : 'hover:text-brand';
		printf( '<li><a class="text-sm font-medium %s" href="%s">%s</a></li>', $cls, esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Fallback footer menu.
 */
function akdisi_fallback_footer() {
	$links = array(
		__( 'Tentang', 'akdisi' )   => home_url( '/tentang/' ),
		__( 'Proyek', 'akdisi' )    => home_url( '/projects/' ),
		__( 'Insight', 'akdisi' )   => home_url( '/insight/' ),
		__( 'Kontak', 'akdisi' )    => home_url( '/kontak/' ),
	);
	echo '<ul class="space-y-2 text-sm">';
	foreach ( $links as $label => $url ) {
		printf( '<li><a href="%s" class="hover:text-white">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Footer services quick-links — 4 layanan inti (custom app development).
 *
 * @return array<string,string>
 */
function akdisi_footer_services() {
	return array(
		__( 'Pengembangan Aplikasi Kustom', 'akdisi' ) => home_url( '/layanan/application-development/' ),
		__( 'Digitalisasi Proses Bisnis', 'akdisi' )   => home_url( '/layanan/business-process-digitalization/' ),
		__( 'Sistem Administrasi & Data', 'akdisi' )   => home_url( '/layanan/data-administration-systems/' ),
		__( 'Solusi Bisnis Kustom', 'akdisi' )         => home_url( '/layanan/custom-business-solutions/' ),
	);
}
