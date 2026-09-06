<?php
/**
 * Plugin Name:       AKDISI Project Manager
 * Description:       Meta box "Detail Proyek" untuk CPT akdisi_project — deskripsi singkat, klien, peran, status, URL kunjungan situs, dan galeri gambar. Data dipakai template single-akdisi_project.php.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            AKDISI
 * License:           GPL-2.0-or-later
 * Text Domain:       akdisi
 *
 * @package AKDISI_Project_Manager
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const AKDISI_PM_VERSION    = '1.0.0';
const AKDISI_PM_POST_TYPE  = 'akdisi_project';
const AKDISI_PM_KEYS       = array( 'client', 'role', 'status', 'visit_url' );
const AKDISI_PM_GALLERY    = 'akdisi_project_gallery';

/**
 * Register post meta (REST-aware) — single source of truth untuk data detail proyek.
 */
function akdisi_pm_register_meta() {
	foreach ( array( 'client', 'role', 'status' ) as $key ) {
		register_post_meta(
			AKDISI_PM_POST_TYPE,
			$key,
			array(
				'type'         => 'string',
				'single'       => true,
				'show_in_rest' => true,
			)
		);
	}
	register_post_meta(
		AKDISI_PM_POST_TYPE,
		'visit_url',
		array(
			'type'         => 'string',
			'single'       => true,
			'show_in_rest' => true,
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	register_post_meta(
		AKDISI_PM_POST_TYPE,
		AKDISI_PM_GALLERY,
		array(
			'type'         => 'array',
			'single'       => true,
			'show_in_rest' => array(
				'schema' => array(
					'type'  => 'array',
					'items' => array( 'type' => 'integer' ),
				),
			),
			'sanitize_callback' => 'akdisi_pm_sanitize_gallery',
		)
	);
}
add_action( 'init', 'akdisi_pm_register_meta' );

/**
 * Sanitize gallery: array of positive attachment IDs.
 *
 * CATATAN: WP menerapkan `sanitize_callback` ter-register via `map_deep`
 * (rekursif per-scalar), bukan ke nilai utuh — jadi callback harus aman
 * untuk keduanya: array (diterima langsung) maupun scalar (satu elemen).
 *
 * @param mixed $value Raw value (array ID atau int).
 * @return int[]|int
 */
function akdisi_pm_sanitize_gallery( $value ) {
	if ( is_array( $value ) ) {
		$ids = $value;
	} elseif ( is_string( $value ) && '' !== trim( $value, " \t\n\r[]" ) ) {
		$ids = preg_split( '/[\s,]+/', trim( $value, " \t\n\r[]" ) );
	} else {
		return absint( $value );
	}
	return array_values( array_unique( array_filter( array_map( 'absint', $ids ) ) ) );
}

/**
 * Public helpers — dipakai template tema.
 */

/**
 * Gallery attachment IDs.
 *
 * @param int $post_id Post ID.
 * @return int[]
 */
function akdisi_pm_get_gallery( $post_id ) {
	return akdisi_pm_sanitize_gallery( get_post_meta( $post_id, AKDISI_PM_GALLERY, true ) );
}

/**
 * Visit site URL (safe, stripped).
 *
 * @param int $post_id Post ID.
 * @return string
 */
function akdisi_pm_get_visit_url( $post_id ) {
	return esc_url_raw( (string) get_post_meta( $post_id, 'visit_url', true ) );
}

/**
 * Meta box registration.
 */
function akdisi_pm_add_meta_box() {
	add_meta_box(
		'akdisi_pm_details',
		__( 'Detail Proyek', 'akdisi' ),
		'akdisi_pm_render_meta_box',
		AKDISI_PM_POST_TYPE,
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'akdisi_pm_add_meta_box' );

/**
 * Render meta box.
 *
 * @param WP_Post $post Post object.
 */
function akdisi_pm_render_meta_box( $post ) {
	wp_nonce_field( 'akdisi_pm_save', 'akdisi_pm_nonce' );
	$gallery = akdisi_pm_get_gallery( $post->ID );
	?>
	<style>
		.akdisi-pm-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
		.akdisi-pm-field{margin-bottom:14px}
		.akdisi-pm-field label{display:block;font-weight:600;margin-bottom:4px}
		.akdisi-pm-field input[type=text],.akdisi-pm-field input[type=url],.akdisi-pm-field textarea{width:100%}
		.akdisi-pm-hint{color:#78716c;font-size:12px;margin-top:2px}
		.akdisi-pm-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:8px;margin-top:8px}
		.akdisi-pm-gallery img{width:100%;height:80px;object-fit:cover;border-radius:6px;display:block}
	</style>
	<div class="akdisi-pm-grid">
		<div class="akdisi-pm-field">
			<label for="akdisi_pm_excerpt"><?php esc_html_e( 'Deskripsi singkat', 'akdisi' ); ?></label>
			<textarea id="akdisi_pm_excerpt" name="akdisi_pm_excerpt" rows="3"><?php echo esc_textarea( get_the_excerpt( $post ) ); ?></textarea>
			<p class="akdisi-pm-hint"><?php esc_html_e( 'Dipakai untuk meta description, kutipan di hero halaman proyek, dan arsip.', 'akdisi' ); ?></p>
		</div>
		<div class="akdisi-pm-field">
			<label for="akdisi_pm_visit_url"><?php esc_html_e( 'URL kunjungan situs', 'akdisi' ); ?></label>
			<input type="url" id="akdisi_pm_visit_url" name="akdisi_pm_visit_url" value="<?php echo esc_url( akdisi_pm_get_visit_url( $post->ID ) ); ?>" placeholder="https://contoh-demo.com">
			<p class="akdisi-pm-hint"><?php esc_html_e( 'Tampil sebagai tombol "Kunjungi situs" di halaman detail proyek.', 'akdisi' ); ?></p>
		</div>
		<div class="akdisi-pm-field">
			<label for="akdisi_pm_client"><?php esc_html_e( 'Klien', 'akdisi' ); ?></label>
			<input type="text" id="akdisi_pm_client" name="akdisi_pm_client" value="<?php echo esc_attr( get_post_meta( $post->ID, 'client', true ) ); ?>">
		</div>
		<div class="akdisi-pm-field">
			<label for="akdisi_pm_role"><?php esc_html_e( 'Peran', 'akdisi' ); ?></label>
			<input type="text" id="akdisi_pm_role" name="akdisi_pm_role" value="<?php echo esc_attr( get_post_meta( $post->ID, 'role', true ) ); ?>" placeholder="Desain + Bangun">
		</div>
		<div class="akdisi-pm-field">
			<label for="akdisi_pm_status"><?php esc_html_e( 'Status', 'akdisi' ); ?></label>
			<input type="text" id="akdisi_pm_status" name="akdisi_pm_status" value="<?php echo esc_attr( get_post_meta( $post->ID, 'status', true ) ); ?>" placeholder="Tayang">
		</div>
	</div>
	<div class="akdisi-pm-field">
		<label><?php esc_html_e( 'Galeri gambar', 'akdisi' ); ?></label>
		<button type="button" class="button" id="akdisi_pm_gallery_open"><?php esc_html_e( 'Pilih / Kelola gambar', 'akdisi' ); ?></button>
		<button type="button" class="button" id="akdisi_pm_gallery_clear"<?php echo $gallery ? '' : ' style="display:none"'; ?>><?php esc_html_e( 'Kosongkan', 'akdisi' ); ?></button>
		<input type="hidden" id="akdisi_pm_gallery" name="akdisi_pm_gallery" value="<?php echo esc_attr( implode( ',', $gallery ) ); ?>">
		<div class="akdisi-pm-gallery" id="akdisi_pm_gallery_preview"></div>
		<p class="akdisi-pm-hint"><?php esc_html_e( 'Tampil sebagai grid di halaman detail proyek. Gambar utama (featured image) tetap di panel kanan atas.', 'akdisi' ); ?></p>
	</div>
	<?php
}

/**
 * Enqueue admin JS/CSS pada layar edit proyek.
 *
 * @param string $hook Current admin page.
 */
function akdisi_pm_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	if ( AKDISI_PM_POST_TYPE !== get_post_type() ) {
		return;
	}
	wp_enqueue_media();
	wp_add_inline_script(
		'jquery',
		'(function($){
			function akdisiPmRender(ids){
				var $prev=$("#akdisi_pm_gallery_preview");
				$prev.empty();
				$.each(ids,function(i,id){
					var att=wp.media.attachment(id);
					var $img=$("<img>").attr("alt","").attr("loading","lazy");
					$img.appendTo($prev);
					att.fetch().done(function(){
						var u=att.get("sizes")&&att.get("sizes").thumbnail?att.get("sizes").thumbnail.url:att.get("url");
						$img.attr("src",u);
					});
				});
			}
			function akdisiPmIds(){return ($("#akdisi_pm_gallery").val()||"").split(",").map(Number).filter(Boolean);}
			function akdisiPmSet(ids){$("#akdisi_pm_gallery").val(ids.join(","));akdisiPmRender(ids);$("#akdisi_pm_gallery_clear")[ids.length?"show":"hide"]();}
			$(function(){
				var frame=null;
				akdisiPmRender(akdisiPmIds());
				$("#akdisi_pm_gallery_open").on("click",function(e){e.preventDefault();
					if(frame){frame.open();return;}
					frame=wp.media({title:"Pilih Gambar Galeri",button:{text:"Pilih"},multiple:true,library:{type:"image"}});
					frame.on("select",function(){
						var ids=[];
						frame.state().get("selection").each(function(a){ids.push(parseInt(a.id,10));});
						akdisiPmSet(ids);
					});
					frame.open();
				});
				$("#akdisi_pm_gallery_clear").on("click",function(e){e.preventDefault();akdisiPmSet([]);});
			});
		})(jQuery);',
		'after'
	);
}
add_action( 'admin_enqueue_scripts', 'akdisi_pm_admin_assets' );

/**
 * Save handler — nonce, capability, sanitize, dan single source of truth untuk excerpt.
 *
 * @param int $post_id Post ID.
 */
function akdisi_pm_save( $post_id ) {
	if ( ! isset( $_POST['akdisi_pm_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['akdisi_pm_nonce'] ), 'akdisi_pm_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( array( 'client', 'role', 'status' ) as $key ) {
		if ( isset( $_POST[ 'akdisi_pm_' . $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ 'akdisi_pm_' . $key ] ) ) );
		}
	}
	if ( isset( $_POST['akdisi_pm_visit_url'] ) ) {
		update_post_meta( $post_id, 'visit_url', esc_url_raw( wp_unslash( $_POST['akdisi_pm_visit_url'] ) ) );
	}
	if ( isset( $_POST['akdisi_pm_gallery'] ) ) {
		$ids = array_map( 'absint', explode( ',', sanitize_text_field( wp_unslash( $_POST['akdisi_pm_gallery'] ) ) ) );
		if ( $ids ) {
			update_post_meta( $post_id, AKDISI_PM_GALLERY, $ids );
		} else {
			delete_post_meta( $post_id, AKDISI_PM_GALLERY );
		}
	}

	// Deskripsi singkat → post_excerpt (satu sumber kebenaran dengan SEO meta).
	if ( isset( $_POST['akdisi_pm_excerpt'] ) ) {
		$excerpt = sanitize_textarea_field( wp_unslash( $_POST['akdisi_pm_excerpt'] ) );
		if ( $excerpt !== get_post_field( 'post_excerpt', $post_id ) ) {
			remove_action( 'save_post_' . AKDISI_PM_POST_TYPE, __FUNCTION__ );
			wp_update_post(
				array(
					'ID'           => $post_id,
					'post_excerpt' => $excerpt,
				)
			);
			add_action( 'save_post_' . AKDISI_PM_POST_TYPE, __FUNCTION__ );
		}
	}
}
add_action( 'save_post_' . AKDISI_PM_POST_TYPE, 'akdisi_pm_save' );