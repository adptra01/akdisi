<?php
/**
 * AKDISI contact form AJAX handler.
 *
 * @package AKDISI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Localize ajaxUrl for the contact form.
 */
function akdisi_localize_ajax() {
	wp_localize_script(
		'akdisi-main',
		'akdisiData',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'akdisi_localize_ajax' );

/**
 * Store a lead from the contact form.
 *
 * @param string $name    Contact name.
 * @param string $email   Contact email.
 * @param string $company Company (optional).
 * @param string $budget  Budget range (optional).
 * @param string $message Project message.
 * @return int|WP_Error
 */
function akdisi_save_lead( $name, $email, $company, $budget, $message ) {
	$leads = get_option( 'akdisi_leads', array() );
	if ( ! is_array( $leads ) ) {
		$leads = array();
	}

	$leads[] = array(
		'name'     => $name,
		'email'    => sanitize_email( $email ),
		'company'  => sanitize_text_field( $company ),
		'budget'   => sanitize_text_field( $budget ),
		'message'  => sanitize_textarea_field( $message ),
		'ip'       => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
		'user_agent'=> sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ?? '' ),
		'created'  => gmdate( 'Y-m-d H:i:s' ),
	);

	$saved = update_option( 'akdisi_leads', array_slice( $leads, -200 ) );

	if ( ! $saved ) {
		return new WP_Error( 'save_failed', __( 'Lead gagal disimpan.', 'akdisi' ) );
	}

	return count( $leads );
}

/**
 * AJAX contact form submission.
 */
function akdisi_handle_contact() {
	check_ajax_referer( 'akdisi_contact', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$budget  = isset( $_POST['budget'] ) ? sanitize_text_field( wp_unslash( $_POST['budget'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || mb_strlen( $message ) < 10 ) {
		wp_send_json_error( array( 'message' => __( 'Mohon isi semua kolom wajib dengan benar.', 'akdisi' ) ), 422 );
	}

	// Expecting the white-label @akdisi.com inbox; extendable via filter.
	$to      = apply_filters( 'akdisi_contact_to', get_option( 'admin_email' ) );
	$subject = sprintf( '[AKDISI] New lead: %s', $name );

	$body  = "Name: $name\n";
	$body .= "Email: $email\n";
	if ( $company ) { $body .= "Company: $company\n"; }
	if ( $budget )  { $body .= "Budget: $budget\n"; }
	$body .= "\nMessage:\n$message\n";

	$mail_ok = wp_mail( $to, $subject, $body );

	$lead_id = akdisi_save_lead( $name, $email, $company, $budget, $message );
	if ( is_wp_error( $lead_id ) ) {
		wp_send_json_error( array( 'message' => __( 'Lead gagal tersimpan. Mohon email kami langsung.', 'akdisi' ) ), 500 );
	}

	wp_send_json_success(
		array(
			'message' => __( 'Terima kasih — pesan Anda sudah dalam perjalanan. Kami membalas dalam satu hari kerja.', 'akdisi' ),
			'id'      => $lead_id,
		)
	);
}
add_action( 'wp_ajax_akdisi_contact', 'akdisi_handle_contact' );
add_action( 'wp_ajax_nopriv_akdisi_contact', 'akdisi_handle_contact' );