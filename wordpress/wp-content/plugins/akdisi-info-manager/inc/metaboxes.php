<?php
/**
 * AKDISI Info Manager — Metabox "Detail Proyek".
 * Digabung dari plugin akdisi-project-manager (v1.0.0, di-retire).
 * Nama fungsi publik & meta key dipertahankan agar template tema
 * (single-akdisi_project.php) tidak berubah.
 *
 * @package AKDISI_IM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const AKDISI_IM_PROJECT_TYPE = 'akdisi_project';
const AKDISI_IM_GALLERY_KEY  = 'akdisi_project_gallery';

/**
 * Register post meta (REST-aware).
 */
function akdisi_im_register_project_meta() {
	foreach ( array( 'client', 'role', 'status' ) as $key ) {
		register_post_meta(
			AKDISI_IM_PROJECT_TYPE,
			$key,
			array(
				'type'         => 'string',
				'single'       => true,
				'show_in_rest' => true,
			)
		);
	}
	register_post_meta(
		AKDISI_IM_PROJECT_TYPE,
		'visit_url',
		array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	register_post_meta(
		AKDISI_IM_PROJECT_TYPE,
		AKDISI_IM_GALLERY_KEY,
		array(
			'type'              => 'array',
			'single'            => true,
			'show_in_rest'      => array(
				'schema' => array(
					'type'  => 'array',
					'items' => array( 'type' => 'integer' ),
				),
			),
			'sanitize_callback' => 'akdisi_im_sanitize_gallery',
		)
	);
}
add_action( 'init', 'akdisi_im_register_project_meta' );

/**
 * Sanitize gallery — aman untuk array, scalar, maupun string CSV
 * (WP memanggil sanitize_callback via map_deep per-scalar).
 *
 * @param mixed $value Raw value.
 * @return int[]|int
 */
function akdisi_im_sanitize_gallery( $value ) {
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
 * Gallery attachment IDs (helper publik untuk template).
 *
 * @param int $post_id Post ID.
 * @return int[]
 */
function akdisi_pm_get_gallery( $post_id ) {
	return akdisi_im_sanitize_gallery( get_post_meta( $post_id, AKDISI_IM_GALLERY_KEY, true ) );
}

/**
 * Visit site URL (helper publik untuk template).
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
function akdisi_im_add_project_meta_box() {
	add_meta_box(
		'akdisi_im_project_details',
		__( 'Detail Proyek', 'akdisi' ),
		'akdisi_im_render_project_meta_box',
		AKDISI_IM_PROJECT_TYPE,
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'akdisi_im_add_project_meta_box' );

/**
 * Render meta box.
 *
 * @param WP_Post $post Post object.
 */
function akdisi_im_render_project_meta_box( $post ) {
	wp_nonce_field( 'akdisi_im_project_save', 'akdisi_im_project_nonce' );
	$gallery = akdisi_pm_get_gallery( $post->ID );
	?>
	<style>
		.akdisi-im-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
		.akdisi-im-field{margin-bottom:14px}
		.akdisi-im-field label{display:block;font-weight:600;margin-bottom:4px}
		.akdisi-im-field input[type=text],.akdisi-im-field input[type=url],.akdisi-im-field textarea{width:100%}
		.akdisi-im-hint{color:#78716c;font-size:12px;margin-top:2px}
		.akdisi-im-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:8px;margin-top:8px}
		.akdisi-im-gallery img{width:100%;height:80px;object-fit:cover;border-radius:6px;display:block}
	</style>
	<div class="akdisi-im-grid">
		<div class="akdisi-im-field">
			<label for="akdisi_im_excerpt"><?php esc_html_e( 'Deskripsi singkat', 'akdisi' ); ?></label>
			<textarea id="akdisi_im_excerpt" name="akdisi_im_excerpt" rows="3"><?php echo esc_textarea( get_the_excerpt( $post ) ); ?></textarea>
			<p class="akdisi-im-hint"><?php esc_html_e( 'Dipakai untuk meta description, kutipan di hero halaman proyek, dan arsip.', 'akdisi' ); ?></p>
		</div>
		<div class="akdisi-im-field">
			<label for="akdisi_im_visit_url"><?php esc_html_e( 'URL kunjungan situs', 'akdisi' ); ?></label>
			<input type="url" id="akdisi_im_visit_url" name="akdisi_im_visit_url" value="<?php echo esc_url( akdisi_pm_get_visit_url( $post->ID ) ); ?>" placeholder="https://contoh-demo.com">
			<p class="akdisi-im-hint"><?php esc_html_e( 'Tampil sebagai tombol "Kunjungi situs" di halaman detail proyek.', 'akdisi' ); ?></p>
		</div>
		<div class="akdisi-im-field">
			<label for="akdisi_im_client"><?php esc_html_e( 'Klien', 'akdisi' ); ?></label>
			<input type="text" id="akdisi_im_client" name="akdisi_im_client" value="<?php echo esc_attr( get_post_meta( $post->ID, 'client', true ) ); ?>">
		</div>
		<div class="akdisi-im-field">
			<label for="akdisi_im_role"><?php esc_html_e( 'Peran', 'akdisi' ); ?></label>
			<input type="text" id="akdisi_im_role" name="akdisi_im_role" value="<?php echo esc_attr( get_post_meta( $post->ID, 'role', true ) ); ?>" placeholder="Desain + Bangun">
		</div>
		<div class="akdisi-im-field">
			<label for="akdisi_im_status"><?php esc_html_e( 'Status', 'akdisi' ); ?></label>
			<input type="text" id="akdisi_im_status" name="akdisi_im_status" value="<?php echo esc_attr( get_post_meta( $post->ID, 'status', true ) ); ?>" placeholder="Tayang">
		</div>
	</div>
	<div class="akdisi-im-field">
		<label><?php esc_html_e( 'Galeri gambar', 'akdisi' ); ?></label>
		<button type="button" class="button" id="akdisi_im_gallery_open"><?php esc_html_e( 'Pilih / Kelola gambar', 'akdisi' ); ?></button>
		<button type="button" class="button" id="akdisi_im_gallery_clear"<?php echo $gallery ? '' : ' style="display:none"'; ?>><?php esc_html_e( 'Kosongkan', 'akdisi' ); ?></button>
		<input type="hidden" id="akdisi_im_gallery" name="akdisi_im_gallery" value="<?php echo esc_attr( implode( ',', $gallery ) ); ?>">
		<div class="akdisi-im-gallery" id="akdisi_im_gallery_preview"></div>
		<p class="akdisi-im-hint"><?php esc_html_e( 'Tampil sebagai grid di halaman detail proyek. Gambar utama (featured image) tetap di panel kanan atas.', 'akdisi' ); ?></p>
	</div>
	<?php
}

/**
 * Enqueue admin JS pada layar edit proyek (media manager galeri).
 *
 * @param string $hook Current admin page.
 */
function akdisi_im_project_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	if ( AKDISI_IM_PROJECT_TYPE !== get_post_type() ) {
		return;
	}
	wp_enqueue_media();
	wp_add_inline_script(
		'jquery',
		'(function($){
			function akdisiImRender(ids){
				var $prev=$("#akdisi_im_gallery_preview");
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
			function akdisiImIds(){return ($("#akdisi_im_gallery").val()||"").split(",").map(Number).filter(Boolean);}
			function akdisiImSet(ids){$("#akdisi_im_gallery").val(ids.join(","));akdisiImRender(ids);$("#akdisi_im_gallery_clear")[ids.length?"show":"hide"]();}
			$(function(){
				var frame=null;
				akdisiImRender(akdisiImIds());
				$("#akdisi_im_gallery_open").on("click",function(e){e.preventDefault();
					if(frame){frame.open();return;}
					frame=wp.media({title:"Pilih Gambar Galeri",button:{text:"Pilih"},multiple:true,library:{type:"image"}});
					frame.on("select",function(){
						var ids=[];
						frame.state().get("selection").each(function(a){ids.push(parseInt(a.id,10));});
						akdisiImSet(ids);
					});
					frame.open();
				});
				$("#akdisi_im_gallery_clear").on("click",function(e){e.preventDefault();akdisiImSet([]);});
			});
		})(jQuery);',
		'after'
	);
}
add_action( 'admin_enqueue_scripts', 'akdisi_im_project_admin_assets' );

/**
 * Save handler — nonce, capability, sanitize, excerpt sebagai satu sumber kebenaran.
 *
 * @param int $post_id Post ID.
 */
function akdisi_im_save_project( $post_id ) {
	if ( ! isset( $_POST['akdisi_im_project_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['akdisi_im_project_nonce'] ), 'akdisi_im_project_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( array( 'client', 'role', 'status' ) as $key ) {
		if ( isset( $_POST[ 'akdisi_im_' . $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ 'akdisi_im_' . $key ] ) ) );
		}
	}
	if ( isset( $_POST['akdisi_im_visit_url'] ) ) {
		update_post_meta( $post_id, 'visit_url', esc_url_raw( wp_unslash( $_POST['akdisi_im_visit_url'] ) ) );
	}
	if ( isset( $_POST['akdisi_im_gallery'] ) ) {
		$ids = array_map( 'absint', explode( ',', sanitize_text_field( wp_unslash( $_POST['akdisi_im_gallery'] ) ) ) );
		$ids = array_values( array_filter( $ids ) );
		if ( $ids ) {
			update_post_meta( $post_id, AKDISI_IM_GALLERY_KEY, $ids );
		} else {
			delete_post_meta( $post_id, AKDISI_IM_GALLERY_KEY );
		}
	}

	// Deskripsi singkat → post_excerpt (satu sumber kebenaran dengan SEO meta).
	if ( isset( $_POST['akdisi_im_excerpt'] ) ) {
		$excerpt = sanitize_textarea_field( wp_unslash( $_POST['akdisi_im_excerpt'] ) );
		if ( $excerpt !== get_post_field( 'post_excerpt', $post_id ) ) {
			remove_action( 'save_post_' . AKDISI_IM_PROJECT_TYPE, __FUNCTION__ );
			wp_update_post(
				array(
					'ID'           => $post_id,
					'post_excerpt' => $excerpt,
				)
			);
			add_action( 'save_post_' . AKDISI_IM_PROJECT_TYPE, __FUNCTION__ );
		}
	}
}
add_action( 'save_post_' . AKDISI_IM_PROJECT_TYPE, 'akdisi_im_save_project' );
