<?php
/**
 * AKDISI Info Manager — Post types: Proyek (public) & Klien (admin-only).
 *
 * @package AKDISI_IM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register CPT Proyek + taksonomi kategori + CPT Klien.
 * Keduanya ditempatkan sebagai submenu "Info Website".
 */
function akdisi_im_register_post_types() {

	register_post_type(
		'akdisi_project',
		array(
			'labels'       => array(
				'name'          => __( 'Proyek', 'akdisi' ),
				'singular_name' => __( 'Proyek', 'akdisi' ),
				'add_new_item'  => __( 'Tambah Proyek Baru', 'akdisi' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'menu_icon'    => 'dashicons-portfolio',
			'rewrite'      => array( 'slug' => 'projects', 'with_front' => false ),
			'show_in_rest' => true,
			'show_in_menu' => 'akdisi-info-manager',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		)
	);

	register_taxonomy(
		'akdisi_project_cat',
		'akdisi_project',
		array(
			'labels'            => array( 'name' => __( 'Kategori Proyek', 'akdisi' ) ),
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'project-category' ),
		)
	);

	register_post_type(
		'akdisi_client',
		array(
			'labels'       => array(
				'name'          => __( 'Klien', 'akdisi' ),
				'singular_name' => __( 'Klien', 'akdisi' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'has_archive'  => false,
			'menu_icon'    => 'dashicons-groups',
			'show_in_menu' => 'akdisi-info-manager',
			'supports'     => array( 'title', 'page-attributes' ),
		)
	);
}
add_action( 'init', 'akdisi_im_register_post_types' );
