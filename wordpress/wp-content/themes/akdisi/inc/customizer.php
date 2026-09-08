<?php
/**
 * AKDISI Customizer — Info Kontak (satu sumber kebenaran untuk footer,
 * halaman kontak, dan Schema.org Organization).
 *
 * @package AKDISI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Contact defaults — dipakai Customizer & helper tema.
 *
 * @return array<string,string>
 */
function akdisi_contact_defaults() {
	return array(
		'email'    => 'hello@akdisi.com',
		'phone'    => '+62 812-3456-7890',
		'whatsapp' => '6281234567890',
		'location' => 'Jambi, Indonesia',
		'hours'    => 'Senin–Jumat, 09.00–17.00 WIB. Permintaan singkat biasanya dibalas di hari yang sama.',
		'address'  => '',
	);
}

/**
 * Register contact settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function akdisi_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'akdisi_contact',
		array(
			'title'    => __( 'Info Kontak', 'akdisi' ),
			'priority' => 30,
		)
	);

	$defaults = akdisi_contact_defaults();

	$fields = array(
		'email'    => array( 'label' => __( 'Email', 'akdisi' ), 'type' => 'email', 'cb' => 'sanitize_email' ),
		'phone'    => array( 'label' => __( 'Telepon (tampilan)', 'akdisi' ), 'type' => 'text', 'cb' => 'sanitize_text_field' ),
		'whatsapp' => array( 'label' => __( 'WhatsApp (angka penuh, tanpa +)', 'akdisi' ), 'type' => 'text', 'cb' => 'sanitize_text_field' ),
		'location' => array( 'label' => __( 'Lokasi', 'akdisi' ), 'type' => 'text', 'cb' => 'sanitize_text_field' ),
		'hours'    => array( 'label' => __( 'Jam kerja', 'akdisi' ), 'type' => 'textarea', 'cb' => 'sanitize_textarea_field' ),
		'address'  => array( 'label' => __( 'Alamat lengkap (opsional)', 'akdisi' ), 'type' => 'textarea', 'cb' => 'sanitize_textarea_field' ),
	);

	foreach ( $fields as $key => $cfg ) {
		$setting_id = 'akdisi_contact_' . $key;
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $cfg['cb'],
			)
		);

		$args = array(
			'label'   => $cfg['label'],
			'section' => 'akdisi_contact',
			'type'    => $cfg['type'],
		);
		if ( 'email' === $cfg['type'] ) {
			$wp_customize->add_control( $setting_id, $args );
		} else {
			$wp_customize->add_control( $setting_id, $args );
		}
	}
}
add_action( 'customize_register', 'akdisi_customize_register' );