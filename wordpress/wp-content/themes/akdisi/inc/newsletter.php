<?php
/**
 * AKDISI newsletter AJAX handler.
 *
 * @package AKDISI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Subscribe an email address to the newsletter.
 *
 * @param string $email Subscriber email.
 * @return bool
 */
function akdisi_subscribe( $email ) {
	$email = sanitize_email( $email );
	if ( ! is_email( $email ) ) {
		return false;
	}

	$subs = get_option( 'akdisi_subscribers', array() );
	if ( ! is_array( $subs ) ) {
		$subs = array();
	}

	if ( in_array( $email, $subs, true ) ) {
		return true; // Idempotent — already subscribed.
	}

	$subs[] = $email;
	update_option( 'akdisi_subscribers', array_slice( array_values( array_unique( $subs ) ), -2000 ) );

	$to      = apply_filters( 'akdisi_newsletter_to', get_option( 'admin_email' ) );
	$subject = '[AKDISI] New newsletter subscriber';
	wp_mail( $to, $subject, "New subscriber: $email" );

	return true;
}

/**
 * AJAX handler for /kontak/ newsletter form.
 */
function akdisi_handle_newsletter() {
	check_ajax_referer( 'akdisi_newsletter', 'nonce' );

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Mohon masukkan alamat email yang valid.', 'akdisi' ) ), 422 );
	}

	// Throttle: max 5 subscriptions per IP per hour.
	$ip       = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ?? '' ) );
	$fr       = get_option( 'akdisi_nl_rate', array() );
	$now      = time();
	if ( is_array( $fr ) ) {
		$fr = array_filter( $fr, fn( $t ) => $now - $t < 3600 );
	}
	if ( is_array( $fr ) && count( $fr ) >= 5 ) {
		wp_send_json_error( array( 'message' => __( 'Terlalu banyak percobaan. Silakan coba lagi nanti.', 'akdisi' ) ), 429 );
	}
	$fr[]    = $now;
	update_option( 'akdisi_nl_rate', $fr );

	akdisi_subscribe( $email );

	wp_send_json_success(
		array(
			'message' => __( 'Anda sudah terdaftar — pantau inbox Anda untuk edisi berikutnya.', 'akdisi' ),
		)
	);
}
add_action( 'wp_ajax_akdisi_newsletter', 'akdisi_handle_newsletter' );
add_action( 'wp_ajax_nopriv_akdisi_newsletter', 'akdisi_handle_newsletter' );