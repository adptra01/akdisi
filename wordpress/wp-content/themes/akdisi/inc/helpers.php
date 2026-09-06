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
 * Footer services quick-links.
 *
 * @return array<string,string>
 */
function akdisi_footer_services() {
	return array(
		__( 'Pengembangan Website', 'akdisi' )  => home_url( '/layanan/' ),
		__( 'Desain UI/UX', 'akdisi' )          => home_url( '/layanan/' ),
		__( 'Identitas Brand', 'akdisi' )       => home_url( '/layanan/' ),
		__( 'Pemasaran Digital', 'akdisi' )     => home_url( '/layanan/' ),
	);
}
