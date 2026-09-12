<?php
/**
 * Plugin Name: AKDISI Info Manager
 * Description: Info website AKDISI dari satu menu wp-admin — Info Perusahaan (kontak), Kirim Email (Gmail SMTP gratis), dan management Proyek & Klien. Insight memakai artikel (Post) bawaan WordPress.
 * Version:     2.0.0
 * Author:      AKDISI
 * License:     GPL-2.0-or-later
 * Text Domain: akdisi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AKDISI_IM_VERSION', '2.0.0' );

/**
 * Muat modul (glob agar mudah ditambah).
 */
function akdisi_im_load() {
	foreach ( glob( plugin_dir_path( __FILE__ ) . 'inc/*.php' ) as $file ) {
		require_once $file;
	}
}
akdisi_im_load();

/**
 * Aktivasi — pastikan CPT terdaftar sebelum flush rewrite.
 */
function akdisi_im_activate() {
	akdisi_im_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'akdisi_im_activate' );

/**
 * Deaktivasi — bersihkan rewrite.
 */
function akdisi_im_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'akdisi_im_deactivate' );
