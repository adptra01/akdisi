<?php
/**
 * Plugin Name: AKDISI Info Manager
 * Description: Konten dinamis situs AKDISI dari wp-admin — layanan, proses, nilai, use case, skema kerja sama, statistik, dan klien marquee. Tanpa hardcode di template.
 * Version:     1.0.0
 * Author:      AKDISI
 * License:     GPL-2.0-or-later
 * Text Domain: akdisi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the seven "site info" post types (admin-only, no front-end).
 */
function akdisi_info_register_post_types() {
	$common = array(
		'public'       => false,
		'show_ui'      => true,
		'show_in_rest' => true,
		'has_archive'  => false,
		'supports'     => array( 'title', 'page-attributes' ),
	);

	register_post_type(
		'akdisi_service',
		array_merge(
			$common,
			array(
				'labels'   => array(
					'name'          => __( 'Layanan', 'akdisi' ),
					'singular_name' => __( 'Layanan', 'akdisi' ),
				),
				'menu_icon' => 'dashicons-admin-generic',
				'supports' => array( 'title', 'excerpt', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'akdisi_step',
		array_merge(
			$common,
			array(
				'labels'   => array(
					'name'          => __( 'Proses (Langkah)', 'akdisi' ),
					'singular_name' => __( 'Langkah Proses', 'akdisi' ),
				),
				'menu_icon' => 'dashicons-sort',
				'supports' => array( 'title', 'excerpt', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'akdisi_value',
		array_merge(
			$common,
			array(
				'labels'   => array(
					'name'          => __( 'Nilai', 'akdisi' ),
					'singular_name' => __( 'Nilai', 'akdisi' ),
				),
				'menu_icon' => 'dashicons-awards',
				'supports' => array( 'title', 'excerpt', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'akdisi_use_case',
		array_merge(
			$common,
			array(
				'labels'   => array(
					'name'          => __( 'Use Case', 'akdisi' ),
					'singular_name' => __( 'Use Case', 'akdisi' ),
				),
				'menu_icon' => 'dashicons-networking',
				'supports' => array( 'title', 'excerpt', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'akdisi_engagement',
		array_merge(
			$common,
			array(
				'labels'   => array(
					'name'          => __( 'Skema Kerja Sama', 'akdisi' ),
					'singular_name' => __( 'Skema Kerja Sama', 'akdisi' ),
				),
				'menu_icon' => 'dashicons-excerpt-view',
				'supports' => array( 'title', 'excerpt', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'akdisi_stat',
		array_merge(
			$common,
			array(
				'labels'   => array(
					'name'          => __( 'Statistik', 'akdisi' ),
					'singular_name' => __( 'Statistik', 'akdisi' ),
				),
				'menu_icon' => 'dashicons-chart-bar',
				'supports' => array( 'title', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'akdisi_client',
		array_merge(
			$common,
			array(
				'labels'   => array(
					'name'          => __( 'Klien Marquee', 'akdisi' ),
					'singular_name' => __( 'Klien', 'akdisi' ),
				),
				'menu_icon' => 'dashicons-groups',
				'supports' => array( 'title', 'page-attributes' ),
			)
		)
	);
}
add_action( 'init', 'akdisi_info_register_post_types' );

/**
 * Register post meta — REST-aware.
 */
function akdisi_info_register_post_meta() {
	$string_meta = array(
		'_akdisi_service_icon'     => 'akdisi_service',
		'_akdisi_service_detail'   => 'akdisi_service',
		'_akdisi_service_points'   => 'akdisi_service',
		'_akdisi_use_case_stack'   => 'akdisi_use_case',
		'_akdisi_use_case_tag'     => 'akdisi_use_case',
		'_akdisi_engagement_note'  => 'akdisi_engagement',
		'_akdisi_stat_value'       => 'akdisi_stat',
		'_akdisi_stat_label'       => 'akdisi_stat',
	);
	foreach ( $string_meta as $key => $type ) {
		register_post_meta(
			$type,
			$key,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
	}

	// URL disimpan via esc_url_raw.
	register_post_meta(
		'akdisi_use_case',
		'_akdisi_use_case_url',
		array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	// Grup statistik — array whitelist (hero / why / about).
	register_post_meta(
		'akdisi_stat',
		'_akdisi_stat_groups',
		array(
			'type'              => 'array',
			'single'            => true,
			'show_in_rest'      => array(
				'schema' => array(
					'type'  => 'array',
					'items' => array( 'type' => 'string' ),
				),
			),
			'sanitize_callback' => 'akdisi_info_sanitize_groups',
			'default'           => array( 'hero' ),
		)
	);
}
add_action( 'init', 'akdisi_info_register_post_meta' );

/**
 * Sanitize stat groups — safe for array, scalar, or CSV input
 * (WP calls sanitize_callback via map_deep, per-scalar).
 *
 * @param mixed $value Raw value.
 * @return array
 */
function akdisi_info_sanitize_groups( $value ) {
	$allowed = array( 'hero', 'why', 'about' );
	if ( is_array( $value ) ) {
		return array_values( array_intersect( $value, $allowed ) );
	}
	if ( is_string( $value ) ) {
		$value = array_map( 'trim', explode( ',', $value ) );
		return array_values( array_intersect( $value, $allowed ) );
	}
	return array();
}

/**
 * Metaboxes for the info post types.
 */
function akdisi_info_add_meta_boxes() {
	add_meta_box( 'akdisi_service_box', __( 'Detail Layanan', 'akdisi' ), 'akdisi_info_render_service_box', 'akdisi_service', 'normal', 'high' );
	add_meta_box( 'akdisi_use_case_box', __( 'Detail Use Case', 'akdisi' ), 'akdisi_info_render_use_case_box', 'akdisi_use_case', 'normal', 'high' );
	add_meta_box( 'akdisi_engagement_box', __( 'Catatan Skema', 'akdisi' ), 'akdisi_info_render_engagement_box', 'akdisi_engagement', 'normal', 'high' );
	add_meta_box( 'akdisi_stat_box', __( 'Detail Statistik', 'akdisi' ), 'akdisi_info_render_stat_box', 'akdisi_stat', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'akdisi_info_add_meta_boxes' );

/**
 * Nonce field shared by all info boxes.
 */
function akdisi_info_nonce() {
	wp_nonce_field( 'akdisi_info_save', 'akdisi_info_nonce' );
}

/**
 * Render: service box.
 *
 * @param WP_Post $post Current post.
 */
function akdisi_info_render_service_box( $post ) {
	akdisi_info_nonce();
	$icon   = get_post_meta( $post->ID, '_akdisi_service_icon', true );
	$detail = get_post_meta( $post->ID, '_akdisi_service_detail', true );
	$points = get_post_meta( $post->ID, '_akdisi_service_points', true );
	?>
	<p>
		<label for="akdisi-service-icon"><strong><?php esc_html_e( 'Ikon (SVG path, opsional)', 'akdisi' ); ?></strong></label><br>
		<input type="text" id="akdisi-service-icon" name="akdisi_service_icon" value="<?php echo esc_attr( $icon ); ?>" class="widefat" placeholder="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
	</p>
	<p>
		<label for="akdisi-service-detail"><strong><?php esc_html_e( 'Deskripsi detail (halaman Layanan)', 'akdisi' ); ?></strong></label><br>
		<textarea id="akdisi-service-detail" name="akdisi_service_detail" rows="4" class="widefat"><?php echo esc_textarea( $detail ); ?></textarea>
	</p>
	<p>
		<label for="akdisi-service-points"><strong><?php esc_html_e( 'Poin/layanan (satu per baris, halaman Layanan)', 'akdisi' ); ?></strong></label><br>
		<textarea id="akdisi-service-points" name="akdisi_service_points" rows="6" class="widefat"><?php echo esc_textarea( $points ); ?></textarea>
	</p>
	<p class="description"><?php esc_html_e( 'Ringkasan: pakai kolom "Ringkasan" (excerpt) di samping — dipakai di kartu Beranda.', 'akdisi' ); ?></p>
	<?php
}

/**
 * Render: use case box.
 *
 * @param WP_Post $post Current post.
 */
function akdisi_info_render_use_case_box( $post ) {
	akdisi_info_nonce();
	$stack = get_post_meta( $post->ID, '_akdisi_use_case_stack', true );
	$tag   = get_post_meta( $post->ID, '_akdisi_use_case_tag', true );
	$url   = get_post_meta( $post->ID, '_akdisi_use_case_url', true );
	?>
	<p>
		<label for="akdisi-use-case-tag"><strong><?php esc_html_e( 'Badge/sektor', 'akdisi' ); ?></strong></label><br>
		<input type="text" id="akdisi-use-case-tag" name="akdisi_use_case_tag" value="<?php echo esc_attr( $tag ); ?>" class="widefat" placeholder="Properti">
	</p>
	<p>
		<label for="akdisi-use-case-stack"><strong><?php esc_html_e( 'Stack (monospace)', 'akdisi' ); ?></strong></label><br>
		<input type="text" id="akdisi-use-case-stack" name="akdisi_use_case_stack" value="<?php echo esc_attr( $stack ); ?>" class="widefat" placeholder="Web app · CRM · Dashboard">
	</p>
	<p>
		<label for="akdisi-use-case-url"><strong><?php esc_html_e( 'URL tujuan', 'akdisi' ); ?></strong></label><br>
		<input type="url" id="akdisi-use-case-url" name="akdisi_use_case_url" value="<?php echo esc_url( $url ); ?>" class="widefat" placeholder="https://...">
	</p>
	<p class="description"><?php esc_html_e( 'Deskripsi: pakai kolom "Ringkasan" (excerpt) di samping.', 'akdisi' ); ?></p>
	<?php
}

/**
 * Render: engagement box.
 *
 * @param WP_Post $post Current post.
 */
function akdisi_info_render_engagement_box( $post ) {
	akdisi_info_nonce();
	$note = get_post_meta( $post->ID, '_akdisi_engagement_note', true );
	?>
	<p>
		<label for="akdisi-engagement-note"><strong><?php esc_html_e( 'Catatan (baris bawah kartu — "Cocok saat ...")', 'akdisi' ); ?></strong></label><br>
		<textarea id="akdisi-engagement-note" name="akdisi_engagement_note" rows="3" class="widefat"><?php echo esc_textarea( $note ); ?></textarea>
	</p>
	<p class="description"><?php esc_html_e( 'Deskripsi: pakai kolom "Ringkasan" (excerpt) di samping.', 'akdisi' ); ?></p>
	<?php
}

/**
 * Render: stat box.
 *
 * @param WP_Post $post Current post.
 */
function akdisi_info_render_stat_box( $post ) {
	akdisi_info_nonce();
	$value  = get_post_meta( $post->ID, '_akdisi_stat_value', true );
	$label  = get_post_meta( $post->ID, '_akdisi_stat_label', true );
	$groups = (array) get_post_meta( $post->ID, '_akdisi_stat_groups', true );
	if ( empty( $groups ) ) {
		$groups = array( 'hero' );
	}
	?>
	<p>
		<label for="akdisi-stat-value"><strong><?php esc_html_e( 'Nilai (angka)', 'akdisi' ); ?></strong></label><br>
		<input type="text" id="akdisi-stat-value" name="akdisi_stat_value" value="<?php echo esc_attr( $value ); ?>" class="widefat" placeholder="40+">
	</p>
	<p>
		<label for="akdisi-stat-label"><strong><?php esc_html_e( 'Label', 'akdisi' ); ?></strong></label><br>
		<input type="text" id="akdisi-stat-label" name="akdisi_stat_label" value="<?php echo esc_attr( $label ); ?>" class="widefat" placeholder="Proyek selesai">
	</p>
	<p>
		<strong><?php esc_html_e( 'Tampil di', 'akdisi' ); ?></strong><br>
		<?php foreach ( array( 'hero' => __( 'Beranda (strip hero)', 'akdisi' ), 'why' => __( 'Beranda (band gelap)', 'akdisi' ), 'about' => __( 'Halaman Tentang', 'akdisi' ) ) as $group_key => $group_label ) : ?>
			<label style="margin-right:14px">
				<input type="checkbox" name="akdisi_stat_groups[]" value="<?php echo esc_attr( $group_key ); ?>" <?php checked( in_array( $group_key, $groups, true ) ); ?>>
				<?php echo esc_html( $group_label ); ?>
			</label>
		<?php endforeach; ?>
	</p>
	<?php
}

/**
 * Save metaboxes.
 *
 * @param int $post_id Post ID.
 */
function akdisi_info_save_boxes( $post_id ) {
	if ( ! isset( $_POST['akdisi_info_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['akdisi_info_nonce'] ), 'akdisi_info_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array(
		'akdisi_service_icon'   => array( 'meta' => '_akdisi_service_icon', 'cb' => 'sanitize_text_field' ),
		'akdisi_service_detail' => array( 'meta' => '_akdisi_service_detail', 'cb' => 'sanitize_textarea_field' ),
		'akdisi_service_points' => array( 'meta' => '_akdisi_service_points', 'cb' => 'sanitize_textarea_field' ),
		'akdisi_use_case_tag'   => array( 'meta' => '_akdisi_use_case_tag', 'cb' => 'sanitize_text_field' ),
		'akdisi_use_case_stack' => array( 'meta' => '_akdisi_use_case_stack', 'cb' => 'sanitize_text_field' ),
		'akdisi_use_case_url'   => array( 'meta' => '_akdisi_use_case_url', 'cb' => 'esc_url_raw' ),
		'akdisi_engagement_note' => array( 'meta' => '_akdisi_engagement_note', 'cb' => 'sanitize_textarea_field' ),
		'akdisi_stat_value'     => array( 'meta' => '_akdisi_stat_value', 'cb' => 'sanitize_text_field' ),
		'akdisi_stat_label'     => array( 'meta' => '_akdisi_stat_label', 'cb' => 'sanitize_text_field' ),
	);

	foreach ( $fields as $field => $cfg ) {
		if ( ! isset( $_POST[ $field ] ) ) {
			continue;
		}
		$value = call_user_func( $cfg['cb'], wp_unslash( $_POST[ $field ] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		if ( '' === $value ) {
			delete_post_meta( $post_id, $cfg['meta'] );
		} else {
			update_post_meta( $post_id, $cfg['meta'], $value );
		}
	}

	$groups = isset( $_POST['akdisi_stat_groups'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['akdisi_stat_groups'] ) ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$groups = akdisi_info_sanitize_groups( $groups );
	if ( empty( $groups ) ) {
		delete_post_meta( $post_id, '_akdisi_stat_groups' );
	} else {
		update_post_meta( $post_id, '_akdisi_stat_groups', $groups );
	}
}
add_action( 'save_post', 'akdisi_info_save_boxes' );