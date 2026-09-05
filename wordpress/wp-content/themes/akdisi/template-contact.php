<?php
/**
 * Contact Page Template
 * v1.3.0 — split layout: info (left) + form card (right). Form lead gen + WhatsApp.
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: Contact Page
 */

get_header();

$phone = get_theme_mod( 'akdisi_phone', '628123456789' );
$email = get_theme_mod( 'akdisi_email', '' );
$wa_msg = get_theme_mod( 'akdisi_wa_message', 'Halo AKDISI, saya ingin konsultasi kebutuhan sistem.' );
$addr  = get_theme_mod( 'akdisi_address', 'Jambi, Indonesia' );
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<p class="eyebrow"><?php _e( 'Let’s Talk', 'akdisi' ); ?></p>
		<h1><?php echo esc_html( get_the_title() ); ?></h1>
		<p><?php _e( 'Ceritakan kebutuhan Anda — kami akan membantu Anda menemukan solusi yang tepat.', 'akdisi' ); ?></p>
	</div>
</section>

<div class="section">
	<div class="container">
		<div class="split-grid js-stagger">
			<div class="split-intro">
				<h2><?php _e( 'Ngobrol langsung', 'akdisi' ); ?></h2>
				<p style="color:var(--text-mut);margin-bottom:var(--s8);max-width:44ch;">
					<?php _e( 'Respons cepat, tanpa jargon. Jelaskan masalah Anda — kami bantu tentukan langkah selanjutnya.', 'akdisi' ); ?>
				</p>

				<a href="https://wa.me/<?php echo esc_attr( $phone ); ?>?text=<?php echo rawurlencode( $wa_msg ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-accent btn-large magnetic" data-ga-track="whatsapp_click" data-ga-content="contact_page" style="margin-bottom:var(--s8);">
					<?php _e( 'Chat WhatsApp', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>

				<div>
					<?php if ( $email ) : ?>
						<div class="kv-row"><div class="kv-label"><?php _e( 'Email', 'akdisi' ); ?></div><div class="kv-value"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></div></div>
					<?php endif; ?>
					<div class="kv-row"><div class="kv-label"><?php _e( 'Lokasi', 'akdisi' ); ?></div><div class="kv-value"><?php echo esc_html( $addr ); ?></div></div>
					<div class="kv-row"><div class="kv-label"><?php _e( 'Fokus', 'akdisi' ); ?></div><div class="kv-value"><?php _e( 'Konsultasi → rancangan → pembangunan aplikasi', 'akdisi' ); ?></div></div>
				</div>
			</div>

			<div class="contact-form-shell" id="contact">
				<h2><?php _e( 'Form Konsultasi', 'akdisi' ); ?></h2>

				<div id="form-success" class="form-success">
					<?php _e( 'Terima kasih. Kebutuhan Anda telah diterima. Tim AKDISI akan menghubungi Anda melalui kontak yang diberikan.', 'akdisi' ); ?>
				</div>

				<div class="form-general-error" role="alert" style="display:none;"></div>

				<form id="contact-form" class="contact-form" novalidate>
					<?php wp_nonce_field( 'akdisi_contact_nonce' ); ?>
					<input type="hidden" name="campaign" value="<?php echo esc_attr( sanitize_text_field( wp_unslash( $_GET['campaign'] ?? '' ) ) ); ?>">

					<div class="form-field">
						<label for="name"><?php _e( 'Nama *', 'akdisi' ); ?></label>
						<input type="text" id="name" name="name" required>
						<span class="field-error"></span>
					</div>
					<div class="form-field">
						<label for="organization"><?php _e( 'Organisasi / Perusahaan', 'akdisi' ); ?></label>
						<input type="text" id="organization" name="organization">
						<span class="field-error"></span>
					</div>
					<div class="form-field">
						<label for="position"><?php _e( 'Jabatan', 'akdisi' ); ?></label>
						<input type="text" id="position" name="position">
						<span class="field-error"></span>
					</div>
					<div class="form-field">
						<label for="whatsapp"><?php _e( 'WhatsApp *', 'akdisi' ); ?></label>
						<input type="tel" id="whatsapp" name="whatsapp" required placeholder="08xxxxxxxxxx">
						<span class="field-error"></span>
					</div>
					<div class="form-field">
						<label for="email"><?php _e( 'Email', 'akdisi' ); ?></label>
						<input type="email" id="email" name="email">
						<span class="field-error"></span>
					</div>
					<div class="form-field">
						<label for="org_type"><?php _e( 'Tipe Organisasi *', 'akdisi' ); ?></label>
						<select id="org_type" name="org_type" required>
							<option value=""><?php _e( '— Pilih —', 'akdisi' ); ?></option>
							<option value="perumahan"><?php _e( 'Perumahan / Kawasan', 'akdisi' ); ?></option>
							<option value="developer"><?php _e( 'Developer / Properti', 'akdisi' ); ?></option>
							<option value="organisasi"><?php _e( 'Organisasi / Komunitas', 'akdisi' ); ?></option>
							<option value="lainnya"><?php _e( 'Lainnya', 'akdisi' ); ?></option>
						</select>
						<span class="field-error"></span>
					</div>
					<div class="form-field">
						<label for="need"><?php _e( 'Kebutuhan Anda *', 'akdisi' ); ?></label>
						<input type="text" id="need" name="need" required placeholder="<?php esc_attr_e( 'Contoh: Sistem pengelolaan data atau aset bisnis', 'akdisi' ); ?>">
						<span class="field-error"></span>
					</div>
					<div class="form-field">
						<label for="description"><?php _e( 'Ceritakan masalah Anda *', 'akdisi' ); ?></label>
						<textarea id="description" name="description" rows="4" required placeholder="<?php esc_attr_e( 'Ceritakan masalah yang ingin Anda selesaikan...', 'akdisi' ); ?>"></textarea>
						<span class="field-error"></span>
					</div>

					<button type="submit" class="btn btn-primary btn-large btn-block magnetic" data-ga-track="form_submit" data-ga-content="contact_form">
						<?php _e( 'Kirim Permintaan', 'akdisi' ); ?>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer();