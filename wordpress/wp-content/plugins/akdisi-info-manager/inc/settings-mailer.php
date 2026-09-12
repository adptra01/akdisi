<?php
/**
 * AKDISI Info Manager — "Kirim Email" (Gmail SMTP + App Password gratis).
 * Semua wp_mail() (form kontak, newsletter, notifikasi) terkirim via
 * akun Gmail dengan App Password — tanpa plugin pihak ketiga.
 *
 * @package AKDISI_IM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Opsi SMTP tersimpan + status siap kirim.
 *
 * @return array{user:string,app_password:string,from_name:string,host:string,port:int,secure:string,ready:bool}
 */
function akdisi_im_smtp_opts() {
	$o = get_option( 'akdisi_im_smtp', array() );
	if ( ! is_array( $o ) ) {
		$o = array();
	}
	$opts = array(
		'user'         => sanitize_email( $o['user'] ?? '' ),
		'app_password' => (string) ( $o['app_password'] ?? '' ),
		'from_name'    => sanitize_text_field( $o['from_name'] ?? '' ),
		'host'         => sanitize_text_field( $o['host'] ?? '' ) ?: 'smtp.gmail.com',
		'port'         => absint( $o['port'] ?? 0 ) ?: 587,
		'secure'       => in_array( $o['secure'] ?? 'tls', array( 'tls', 'ssl', 'none' ), true ) ? ( $o['secure'] ?? 'tls' ) : 'tls',
	);
	$opts['ready'] = '' !== $opts['user'] && '' !== $opts['app_password'];
	return $opts;
}

/**
 * Sanitize input SMTP — App Password kosong = pertahankan yang lama.
 *
 * @param mixed $input Raw array dari form.
 * @return array<string,string|int>
 */
function akdisi_im_sanitize_smtp( $input ) {
	$input = is_array( $input ) ? $input : array();
	$old   = (array) get_option( 'akdisi_im_smtp', array() );

	// App Password Gmail ditampilkan berkelompok (xxxx xxxx xxxx) — buang spasi.
	$pass = strtoupper( str_replace( ' ', '', sanitize_text_field( $input['app_password'] ?? '' ) ) );
	if ( '' === $pass ) {
		$pass = (string) ( $old['app_password'] ?? '' );
	}

	return array(
		'user'         => sanitize_email( $input['user'] ?? '' ),
		'app_password' => $pass,
		'from_name'    => sanitize_text_field( $input['from_name'] ?? '' ),
		'host'         => sanitize_text_field( $input['host'] ?? '' ) ?: 'smtp.gmail.com',
		'port'         => absint( $input['port'] ?? 0 ) ?: 587,
		'secure'       => in_array( $input['secure'] ?? 'tls', array( 'tls', 'ssl', 'none' ), true ) ? ( $input['secure'] ?? 'tls' ) : 'tls',
	);
}

/**
 * Submenu "Kirim Email" + register settings + handler test kirim.
 */
function akdisi_im_admin_menu_email() {
	add_submenu_page(
		'akdisi-info-manager',
		__( 'Kirim Email', 'akdisi' ),
		__( 'Kirim Email', 'akdisi' ),
		'manage_options',
		'akdisi-im-email',
		'akdisi_im_render_email_page'
	);
}
add_action( 'admin_menu', 'akdisi_im_admin_menu_email' );

/**
 * Register settings.
 */
function akdisi_im_register_email_settings() {
	register_setting( 'akdisi_im_email_group', 'akdisi_im_smtp', array( 'sanitize_callback' => 'akdisi_im_sanitize_smtp' ) );
}
add_action( 'admin_init', 'akdisi_im_register_email_settings' );

/**
 * Terapkan SMTP ke semua wp_mail() bila terkonfigurasi.
 *
 * @param PHPMailer $phpmailer Instance PHPMailer.
 */
function akdisi_im_phpmailer( $phpmailer ) {
	$o = akdisi_im_smtp_opts();
	if ( ! $o['ready'] ) {
		return;
	}
	$phpmailer->isSMTP();
	$phpmailer->Host       = $o['host'];
	$phpmailer->Port       = $o['port'];
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Username   = $o['user'];
	$phpmailer->Password   = $o['app_password'];
	if ( 'ssl' === $o['secure'] ) {
		$phpmailer->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
	} elseif ( 'tls' === $o['secure'] ) {
		$phpmailer->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
	}
	$phpmailer->From     = $o['user'];
	$phpmailer->FromName = $o['from_name'] ?: get_bloginfo( 'name' );
}
add_action( 'phpmailer_init', 'akdisi_im_phpmailer' );

/**
 * Tangkap pesan error wp_mail (dipakai halaman test kirim).
 */
function akdisi_im_capture_mail_error() {
	add_action(
		'wp_mail_failed',
		static function ( $wp_error ) {
			if ( is_wp_error( $wp_error ) ) {
				$GLOBALS['akdisi_im_mail_error'] = $wp_error->get_error_message();
			}
		}
	);
}

/**
 * Handler test kirim email (form POST → admin-post.php).
 */
function akdisi_im_handle_test_mail() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Akses ditolak.', 'akdisi' ) );
	}
	check_admin_referer( 'akdisi_im_test_mail' );

	$o    = akdisi_im_smtp_opts();
	$args = array( 'page' => 'akdisi-im-email' );

	if ( ! $o['ready'] ) {
		$args['im_test'] = 'unconfigured';
		wp_safe_redirect( add_query_arg( $args, admin_url( 'admin.php' ) ) );
		exit;
	}

	$to = sanitize_email( wp_unslash( $_POST['im_test_to'] ?? '' ) );
	if ( ! is_email( $to ) ) {
		$to = get_option( 'admin_email' );
	}

	akdisi_im_capture_mail_error();
	$subject = sprintf( '[%s] Email percobaan — konfigurasi SMTP berhasil', get_bloginfo( 'name' ) );
	$body    = "Alhamdulillah — konfigurasi Gmail SMTP situs Anda sudah benar.\n\n"
		. "Email ini dikirim otomatis dari halaman Info Website → Kirim Email.\n"
		. 'Situs: ' . home_url( '/' ) . "\n"
		. 'Waktu: ' . gmdate( 'Y-m-d H:i:s' ) . " UTC\n";

	$sent = wp_mail( $to, $subject, $body );

	$args['im_test'] = $sent ? 'ok' : 'fail';
	if ( ! $sent && ! empty( $GLOBALS['akdisi_im_mail_error'] ) ) {
		$args['im_test_msg'] = rawurlencode( $GLOBALS['akdisi_im_mail_error'] );
	}
	wp_safe_redirect( add_query_arg( $args, admin_url( 'admin.php' ) ) );
	exit;
}
add_action( 'admin_post_akdisi_im_test_mail', 'akdisi_im_handle_test_mail' );

/**
 * Render halaman Kirim Email.
 */
function akdisi_im_render_email_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$o     = akdisi_im_smtp_opts();
	$notif = '';

	if ( isset( $_GET['im_test'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$state = sanitize_key( wp_unslash( $_GET['im_test'] ) );
		if ( 'ok' === $state ) {
			$notif = '<div class="notice notice-success"><p><strong>' . esc_html__( 'Email percobaan terkirim. Cek inbox tujuan — konfigurasi sudah benar.', 'akdisi' ) . '</strong></p></div>';
		} elseif ( 'fail' === $state ) {
			$msg   = isset( $_GET['im_test_msg'] ) ? sanitize_text_field( rawurldecode( wp_unslash( $_GET['im_test_msg'] ) ) ) : '';
			$notif = '<div class="notice notice-error"><p><strong>' . esc_html__( 'Gagal mengirim:', 'akdisi' ) . '</strong> ' . esc_html( $msg ?: __( 'kesalahan tidak diketahui — periksa alamat & App Password.', 'akdisi' ) ) . '</p></div>';
		} elseif ( 'unconfigured' === $state ) {
			$notif = '<div class="notice notice-warning"><p>' . esc_html__( 'Isi Gmail & App Password dulu, simpan, lalu tes kirim.', 'akdisi' ) . '</p></div>';
		}
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Kirim Email', 'akdisi' ); ?></h1>

		<?php if ( $notif ) { echo wp_kses_post( $notif ); } ?>

		<?php if ( $o['ready'] ) : ?>
			<div class="notice notice-info"><p>
				<?php
				printf(
					/* translators: %s: alamat gmail */
					esc_html__( 'Aktif — semua email situs (form kontak & newsletter) dikirim via %s.', 'akdisi' ),
					'<strong>' . esc_html( $o['user'] ) . '</strong>'
				);
				?>
			</p></div>
		<?php else : ?>
			<div class="notice notice-warning"><p><?php esc_html_e( 'Belum terkonfigurasi — email dari form kontak baru tersimpan di database, belum terkirim ke inbox.', 'akdisi' ); ?></p></div>
		<?php endif; ?>

		<h2><?php esc_html_e( 'Cara membuat App Password Gmail (gratis)', 'akdisi' ); ?></h2>
		<ol style="max-width:640px">
			<li><?php esc_html_e( 'Buka myaccount.google.com → menu "Keamanan".', 'akdisi' ); ?></li>
			<li><?php esc_html_e( 'Aktifkan "Verifikasi 2 Langkah" (wajib untuk App Password).', 'akdisi' ); ?></li>
			<li><?php esc_html_e( 'Masih di halaman Keamanan, cari "App passwords" / "Sandi aplikasi" → buat baru (nama bebas, mis. "Website AKDISI").', 'akdisi' ); ?></li>
			<li><?php esc_html_e( 'Google menampilkan password 16 karakter — salin dan tempel di kolom App Password di bawah.', 'akdisi' ); ?></li>
			<li><?php esc_html_e( 'Simpan, lalu gunakan tombol "Kirim email percobaan" untuk memastikan.', 'akdisi' ); ?></li>
		</ol>

		<form method="post" action="options.php">
			<?php settings_fields( 'akdisi_im_email_group' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="akdisi_im_user"><?php esc_html_e( 'Alamat Gmail', 'akdisi' ); ?></label></th>
					<td>
						<input type="email" id="akdisi_im_user" name="akdisi_im_smtp[user]" value="<?php echo esc_attr( $o['user'] ); ?>" class="regular-text" placeholder="namasaya@gmail.com">
						<p class="description"><?php esc_html_e( 'Juga dipakai sebagai alamat pengirim (From).', 'akdisi' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_pass"><?php esc_html_e( 'App Password (16 karakter)', 'akdisi' ); ?></label></th>
					<td>
						<input type="password" id="akdisi_im_pass" name="akdisi_im_smtp[app_password]" value="" class="regular-text code" autocomplete="new-password" placeholder="<?php echo $o['app_password'] ? '•••• •••• •••• ••••' : 'abcd efgh ijkl mnop'; ?>">
						<p class="description"><?php esc_html_e( 'Biarkan kosong untuk tetap memakai password yang tersimpan.', 'akdisi' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_from"><?php esc_html_e( 'Nama pengirim', 'akdisi' ); ?></label></th>
					<td><input type="text" id="akdisi_im_from" name="akdisi_im_smtp[from_name]" value="<?php echo esc_attr( $o['from_name'] ); ?>" class="regular-text" placeholder="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_host"><?php esc_html_e( 'Host SMTP', 'akdisi' ); ?></label></th>
					<td>
						<input type="text" id="akdisi_im_host" name="akdisi_im_smtp[host]" value="<?php echo esc_attr( $o['host'] ); ?>" class="regular-text">
						<p class="description"><?php esc_html_e( 'Default Gmail: smtp.gmail.com, port 587, enkripsi TLS.', 'akdisi' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="akdisi_im_port"><?php esc_html_e( 'Port', 'akdisi' ); ?></label></th>
					<td>
						<input type="number" id="akdisi_im_port" name="akdisi_im_smtp[port]" value="<?php echo esc_attr( (string) $o['port'] ); ?>" class="small-text">
						<span style="margin-left:16px">
							<label for="akdisi_im_secure"><?php esc_html_e( 'Enkripsi', 'akdisi' ); ?></label>
							<select id="akdisi_im_secure" name="akdisi_im_smtp[secure]">
								<option value="tls" <?php selected( $o['secure'], 'tls' ); ?>>TLS</option>
								<option value="ssl" <?php selected( $o['secure'], 'ssl' ); ?>>SSL</option>
								<option value="none" <?php selected( $o['secure'], 'none' ); ?>><?php esc_html_e( 'Tanpa', 'akdisi' ); ?></option>
							</select>
						</span>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>

		<hr>
		<h2><?php esc_html_e( 'Kirim email percobaan', 'akdisi' ); ?></h2>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="akdisi_im_test_mail">
			<?php wp_nonce_field( 'akdisi_im_test_mail' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="akdisi_im_test_to"><?php esc_html_e( 'Kirim ke', 'akdisi' ); ?></label></th>
					<td>
						<input type="email" id="akdisi_im_test_to" name="im_test_to" value="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>" class="regular-text">
						<?php submit_button( __( 'Kirim email percobaan', 'akdisi' ), 'secondary', 'submit', false ); ?>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<?php
}
