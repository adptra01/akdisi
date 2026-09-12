<?php
/**
 * AKDISI Info Manager — Halaman "Info Perusahaan".
 * Kontak perusahaan (email/telepon/WhatsApp/lokasi/jam/alamat) di sini.
 * Nama & tagline perusahaan memakai Settings → General bawaan WordPress
 * (Judul Situs & Slogan) — tema sudah membacanya via bloginfo().
 *
 * @package AKDISI_IM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default kontak — sama dengan default tema.
 *
 * @return array<string,string>
 */
function akdisi_im_contact_defaults() {
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
 * Helper publik — kontak tersimpan (merged dengan default).
 * Dipakai tema: akdisi_get_contact() memanggil fungsi ini bila plugin aktif.
 *
 * @return array<string,string>
 */
function akdisi_im_contact() {
	$saved = get_option( 'akdisi_info_contact', array() );
	if ( ! is_array( $saved ) ) {
		$saved = array();
	}
	return array_merge( akdisi_im_contact_defaults(), $saved );
}

/**
 * Sanitize input kontak.
 *
 * @param mixed $input Raw array dari form.
 * @return array<string,string>
 */
function akdisi_im_sanitize_contact( $input ) {
	$input = is_array( $input ) ? $input : array();
	return array(
		'email'    => sanitize_email( $input['email'] ?? '' ),
		'phone'    => sanitize_text_field( $input['phone'] ?? '' ),
		'whatsapp' => preg_replace( '/[^0-9]/', '', (string) ( $input['whatsapp'] ?? '' ) ),
		'location' => sanitize_text_field( $input['location'] ?? '' ),
		'hours'    => sanitize_textarea_field( $input['hours'] ?? '' ),
		'address'  => sanitize_textarea_field( $input['address'] ?? '' ),
	);
}

/**
 * Menu utama "Info Website" + halaman default "Info Perusahaan".
 */
function akdisi_im_admin_menu() {
	add_menu_page(
		__( 'Info Website', 'akdisi' ),
		__( 'Info Website', 'akdisi' ),
		'manage_options',
		'akdisi-info-manager',
		'akdisi_im_render_company_page',
		'dashicons-admin-settings',
		26
	);
	add_submenu_page(
		'akdisi-info-manager',
		__( 'Info Perusahaan', 'akdisi' ),
		__( 'Info Perusahaan', 'akdisi' ),
		'manage_options',
		'akdisi-info-manager',
		'akdisi_im_render_company_page'
	);
}
add_action( 'admin_menu', 'akdisi_im_admin_menu' );

/**
 * Register settings.
 */
function akdisi_im_register_company_settings() {
	register_setting( 'akdisi_im_contact_group', 'akdisi_info_contact', array( 'sanitize_callback' => 'akdisi_im_sanitize_contact' ) );
}
add_action( 'admin_init', 'akdisi_im_register_company_settings' );

/**
 * Render halaman Info Perusahaan.
 */
function akdisi_im_render_company_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$c = akdisi_im_contact();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Info Perusahaan', 'akdisi' ); ?></h1>
		<p class="description">
			<?php esc_html_e( 'Kontak ini tampil di footer, halaman Kontak, WhatsApp, dan data SEO situs.', 'akdisi' ); ?>
			<strong><?php esc_html_e( 'Nama & tagline perusahaan diatur di Settings → General (Judul Situs & Slogan).', 'akdisi' ); ?></strong>
		</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'akdisi_im_contact_group' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="akdisi_im_email"><?php esc_html_e( 'Email', 'akdisi' ); ?></label></th>
					<td><input type="email" id="akdisi_im_email" name="akdisi_info_contact[email]" value="<?php echo esc_attr( $c['email'] ); ?>" class="regular-text"></td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_phone"><?php esc_html_e( 'Telepon (tampilan)', 'akdisi' ); ?></label></th>
					<td><input type="text" id="akdisi_im_phone" name="akdisi_info_contact[phone]" value="<?php echo esc_attr( $c['phone'] ); ?>" class="regular-text" placeholder="+62 812-3456-7890"></td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_wa"><?php esc_html_e( 'WhatsApp (angka penuh, tanpa +)', 'akdisi' ); ?></label></th>
					<td><input type="text" id="akdisi_im_wa" name="akdisi_info_contact[whatsapp]" value="<?php echo esc_attr( $c['whatsapp'] ); ?>" class="regular-text" placeholder="6281234567890"></td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_location"><?php esc_html_e( 'Lokasi', 'akdisi' ); ?></label></th>
					<td><input type="text" id="akdisi_im_location" name="akdisi_info_contact[location]" value="<?php echo esc_attr( $c['location'] ); ?>" class="regular-text"></td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_hours"><?php esc_html_e( 'Jam kerja', 'akdisi' ); ?></label></th>
					<td><textarea id="akdisi_im_hours" name="akdisi_info_contact[hours]" rows="2" class="large-text"><?php echo esc_textarea( $c['hours'] ); ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_address"><?php esc_html_e( 'Alamat lengkap (opsional)', 'akdisi' ); ?></label></th>
					<td><textarea id="akdisi_im_address" name="akdisi_info_contact[address]" rows="3" class="large-text"><?php echo esc_textarea( $c['address'] ); ?></textarea></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
