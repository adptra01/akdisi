<?php
/**
 * Customizer — Info Kontak Garuda Perkasa.
 *
 * Edit dari wp-admin → Appearance → Customize → "Info Kontak".
 * Footer membaca via perkasa_get_contact() (functions.php).
 *
 * @package Garuda_Perkasa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer section + settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function perkasa_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'perkasa_company',
		array(
			'title'    => __( 'Identitas Perusahaan', 'perkasa' ),
			'priority' => 25,
		)
	);

	$company_fields = array(
		'name'    => array(
			'label'       => __( 'Nama perusahaan', 'perkasa' ),
			'type'        => 'text',
			'description' => __( 'Dipakai untuk SEO: title, Open Graph, dan Schema.org. Bukan blogname global (itu milik AKDISI).', 'perkasa' ),
		),
		'tagline' => array(
			'label'       => __( 'Tagline / deskripsi singkat', 'perkasa' ),
			'type'        => 'textarea',
			'description' => __( 'Meta description default (home) & deskripsi Organization pada Schema.org.', 'perkasa' ),
		),
	);

	foreach ( $company_fields as $key => $args ) {
		$setting_id = 'perkasa_company_' . $key;

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => 'name' === $key ? perkasa_site_name() : perkasa_site_tagline(),
				'sanitize_callback' => 'textarea' === $args['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $args['label'],
				'description' => isset( $args['description'] ) ? $args['description'] : '',
				'section'     => 'perkasa_company',
				'type'        => $args['type'],
			)
		);
	}

	$wp_customize->add_section(
		'perkasa_contact',
		array(
			'title'    => __( 'Info Kontak', 'perkasa' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'address'  => array(
			'label'       => __( 'Alamat', 'perkasa' ),
			'type'        => 'textarea',
			'description' => __( 'Tampil di footer (blok Brand & kontak).', 'perkasa' ),
		),
		'email'    => array(
			'label' => __( 'Email', 'perkasa' ),
			'type'  => 'email',
			'sanitize' => 'sanitize_email',
		),
		'phone'    => array(
			'label' => __( 'Telepon', 'perkasa' ),
			'type'  => 'text',
		),
		'whatsapp' => array(
			'label'       => __( 'Nomor WhatsApp (format internasional, tanpa +)', 'perkasa' ),
			'type'        => 'text',
			'description' => __( 'Contoh: 6281234567890 — dipakai untuk link wa.me dan tampilan lokal 0812-3456-7890.', 'perkasa' ),
		),
	);

	foreach ( $fields as $key => $args ) {
		$setting_id = 'perkasa_contact_' . $key;

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => perkasa_get_contact( $key ),
				'sanitize_callback' => isset( $args['sanitize'] ) ? $args['sanitize'] : 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $args['label'],
				'description' => isset( $args['description'] ) ? $args['description'] : '',
				'section'     => 'perkasa_contact',
				'type'        => $args['type'],
			)
		);
	}
}
add_action( 'customize_register', 'perkasa_customize_register' );