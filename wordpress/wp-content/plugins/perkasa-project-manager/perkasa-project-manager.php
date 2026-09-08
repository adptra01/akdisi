<?php
/**
 * Plugin Name:       Perkasa Project Manager
 * Description:       Kelola proyek Garuda Perkasa dari wp-admin — CPT perkasa_project + meta box "Detail Proyek" (lokasi, tahun, durasi, nilai, status, fitur, galeri). Data dipakai template halaman Proyek & Proyek Unggulan via helper perkasa_pm_get_projects().
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            Garuda Perkasa (fake project)
 * License:           GPL-2.0-or-later
 * Text Domain:       perkasa
 *
 * @package Perkasa_Project_Manager
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const PERKASA_PM_VERSION   = '1.0.0';
const PERKASA_PM_POST_TYPE = 'perkasa_project';
const PERKASA_PM_CAT       = 'perkasa_project_cat';
const PERKASA_PM_KEYS      = array( 'location', 'year', 'duration', 'value_type', 'status', 'features' );
const PERKASA_PM_GALLERY   = 'perkasa_project_gallery';

/* -------------------------------------------------------------------------
 * CPT + taxonomy
 * ---------------------------------------------------------------------- */
function perkasa_pm_register_post_type() {
	register_post_type(
		PERKASA_PM_POST_TYPE,
		array(
			'labels'       => array(
				'name'          => __( 'Proyek Perkasa', 'perkasa' ),
				'singular_name' => __( 'Proyek', 'perkasa' ),
				'add_new_item'  => __( 'Tambah Proyek Baru', 'perkasa' ),
				'edit_item'     => __( 'Edit Proyek', 'perkasa' ),
				'not_found'     => __( 'Belum ada proyek.', 'perkasa' ),
			),
			'public'       => true,
			'show_in_rest' => true,
			'has_archive'  => false,
			'rewrite'      => false, // Daftar proyek = halaman /proyek/ (Template: Proyek).
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'menu_icon'    => 'dashicons-building',
			'menu_position'=> 5,
			'capability_type' => 'post',
		)
	);

	register_taxonomy(
		PERKASA_PM_CAT,
		PERKASA_PM_POST_TYPE,
		array(
			'labels'       => array(
				'name'          => __( 'Kategori Proyek', 'perkasa' ),
				'singular_name' => __( 'Kategori', 'perkasa' ),
			),
			'hierarchical' => true,
			'public'       => true,
			'show_in_rest' => true,
			'rewrite'      => false,
		)
	);
}
add_action( 'init', 'perkasa_pm_register_post_type' );

/* -------------------------------------------------------------------------
 * Post meta (REST-aware)
 * ---------------------------------------------------------------------- */
function perkasa_pm_register_meta() {
	foreach ( PERKASA_PM_KEYS as $key ) {
		register_post_meta(
			PERKASA_PM_POST_TYPE,
			$key,
			array(
				'type'         => 'string',
				'single'       => true,
				'show_in_rest' => true,
			)
		);
	}
	register_post_meta(
		PERKASA_PM_POST_TYPE,
		PERKASA_PM_GALLERY,
		array(
			'type'         => 'array',
			'single'       => true,
			'show_in_rest' => array(
				'schema' => array(
					'type'  => 'array',
					'items' => array( 'type' => 'integer' ),
				),
			),
			'sanitize_callback' => 'perkasa_pm_sanitize_gallery',
		)
	);
}
add_action( 'init', 'perkasa_pm_register_meta' );

/**
 * Sanitize gallery: array of positive attachment IDs (aman untuk scalar/array/CSV).
 *
 * @param mixed $value Raw value.
 * @return int[]|int
 */
function perkasa_pm_sanitize_gallery( $value ) {
	if ( is_array( $value ) ) {
		$ids = $value;
	} elseif ( is_string( $value ) && '' !== trim( $value, " \t\n\r[]" ) ) {
		$ids = preg_split( '/[\s,]+/', trim( $value, " \t\n\r[]" ) );
	} else {
		return absint( $value );
	}
	return array_values( array_unique( array_filter( array_map( 'absint', $ids ) ) ) );
}

/* -------------------------------------------------------------------------
 * Public helpers — dipakai template tema
 * ---------------------------------------------------------------------- */

/**
 * Gallery attachment IDs.
 *
 * @param int $post_id Post ID.
 * @return int[]
 */
function perkasa_pm_get_gallery( $post_id ) {
	return perkasa_pm_sanitize_gallery( get_post_meta( $post_id, PERKASA_PM_GALLERY, true ) );
}

/**
 * Nama kategori pertama (term) proyek.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function perkasa_pm_cat_name( $post_id ) {
	$terms = get_the_terms( $post_id, PERKASA_PM_CAT );
	if ( is_array( $terms ) && ! empty( $terms ) ) {
		return $terms[0]->name;
	}
	return '';
}

/**
 * Data proyek terstruktur — format kompatibel array hardcoded v3
 * (n, t, loc, yr, cat, dur, val, stat, d, feats).
 *
 * @return array[]
 */
function perkasa_pm_get_projects() {
	$query = new WP_Query(
		array(
			'post_type'      => PERKASA_PM_POST_TYPE,
			'posts_per_page' => -1,
			'orderby'        => 'menu_order date',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		)
	);

	$projects = array();
	$index    = 1;

	foreach ( $query->posts as $post ) {
		$excerpt = get_post_field( 'post_excerpt', $post );
		$desc    = $excerpt
			? $excerpt
			: wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $post ) ), 40, '&hellip;' );

		$features_raw = (string) get_post_meta( $post->ID, 'features', true );
		$features     = array_values( array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) ) );

		$projects[] = array(
			'n'     => str_pad( (string) $index, 2, '0', STR_PAD_LEFT ),
			't'     => get_the_title( $post ),
			'loc'   => (string) get_post_meta( $post->ID, 'location', true ),
			'yr'    => (string) get_post_meta( $post->ID, 'year', true ),
			'cat'   => perkasa_pm_cat_name( $post->ID ),
			'dur'   => (string) get_post_meta( $post->ID, 'duration', true ),
			'val'   => (string) get_post_meta( $post->ID, 'value_type', true ),
			'stat'  => (string) get_post_meta( $post->ID, 'status', true ),
			'd'     => $desc,
			'feats' => $features,
			'id'    => $post->ID,
		);

		$index++;
	}

	wp_reset_postdata();

	return $projects;
}

/* -------------------------------------------------------------------------
 * Meta box "Detail Proyek"
 * ---------------------------------------------------------------------- */
function perkasa_pm_add_meta_box() {
	add_meta_box(
		'perkasa_pm_details',
		__( 'Detail Proyek', 'perkasa' ),
		'perkasa_pm_render_meta_box',
		PERKASA_PM_POST_TYPE,
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'perkasa_pm_add_meta_box' );

/**
 * Render meta box.
 *
 * @param WP_Post $post Post object.
 */
function perkasa_pm_render_meta_box( $post ) {
	wp_nonce_field( 'perkasa_pm_save', 'perkasa_pm_nonce' );
	$gallery = perkasa_pm_get_gallery( $post->ID );
	$vals    = array();
	foreach ( PERKASA_PM_KEYS as $key ) {
		$vals[ $key ] = (string) get_post_meta( $post->ID, $key, true );
	}
	?>
	<style>
		.perkasa-pm-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
		.perkasa-pm-field{margin-bottom:14px}
		.perkasa-pm-field label{display:block;font-weight:600;margin-bottom:4px}
		.perkasa-pm-field input[type=text],.perkasa-pm-field textarea{width:100%}
		.perkasa-pm-hint{color:#78716c;font-size:12px;margin-top:2px}
		.perkasa-pm-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:8px;margin-top:8px}
		.perkasa-pm-gallery img{width:100%;height:80px;object-fit:cover;border-radius:6px;display:block}
	</style>
	<div class="perkasa-pm-field">
		<label for="perkasa_pm_excerpt"><?php esc_html_e( 'Deskripsi singkat', 'perkasa' ); ?></label>
		<textarea id="perkasa_pm_excerpt" name="perkasa_pm_excerpt" rows="3"><?php echo esc_textarea( get_the_excerpt( $post ) ); ?></textarea>
		<p class="perkasa-pm-hint"><?php esc_html_e( 'Satu sumber kebenaran: dipakai sebagai deskripsi di kartu proyek (post_excerpt).', 'perkasa' ); ?></p>
	</div>
	<div class="perkasa-pm-grid">
		<div class="perkasa-pm-field">
			<label for="perkasa_pm_location"><?php esc_html_e( 'Lokasi', 'perkasa' ); ?></label>
			<input type="text" id="perkasa_pm_location" name="perkasa_pm_location" value="<?php echo esc_attr( $vals['location'] ); ?>" placeholder="Jakarta Selatan">
		</div>
		<div class="perkasa-pm-field">
			<label for="perkasa_pm_year"><?php esc_html_e( 'Tahun', 'perkasa' ); ?></label>
			<input type="text" id="perkasa_pm_year" name="perkasa_pm_year" value="<?php echo esc_attr( $vals['year'] ); ?>" placeholder="2024">
		</div>
		<div class="perkasa-pm-field">
			<label for="perkasa_pm_duration"><?php esc_html_e( 'Durasi', 'perkasa' ); ?></label>
			<input type="text" id="perkasa_pm_duration" name="perkasa_pm_duration" value="<?php echo esc_attr( $vals['duration'] ); ?>" placeholder="21 bulan">
		</div>
		<div class="perkasa-pm-field">
			<label for="perkasa_pm_value_type"><?php esc_html_e( 'Nilai', 'perkasa' ); ?></label>
			<input type="text" id="perkasa_pm_value_type" name="perkasa_pm_value_type" value="<?php echo esc_attr( $vals['value_type'] ); ?>" placeholder="Komersial / Nasional / Pemerintah">
		</div>
		<div class="perkasa-pm-field">
			<label for="perkasa_pm_status"><?php esc_html_e( 'Status', 'perkasa' ); ?></label>
			<input type="text" id="perkasa_pm_status" name="perkasa_pm_status" value="<?php echo esc_attr( $vals['status'] ); ?>" placeholder="Selesai">
		</div>
	</div>
	<div class="perkasa-pm-field">
		<label for="perkasa_pm_features"><?php esc_html_e( 'Fitur / capaian (satu per baris)', 'perkasa' ); ?></label>
		<textarea id="perkasa_pm_features" name="perkasa_pm_features" rows="4"><?php echo esc_textarea( $vals['features'] ); ?></textarea>
		<p class="perkasa-pm-hint"><?php esc_html_e( 'Tiap baris menjadi satu item daftar centang di kartu proyek.', 'perkasa' ); ?></p>
	</div>
	<div class="perkasa-pm-field">
		<label><?php esc_html_e( 'Galeri gambar', 'perkasa' ); ?></label>
		<button type="button" class="button" id="perkasa_pm_gallery_open"><?php esc_html_e( 'Pilih / Kelola gambar', 'perkasa' ); ?></button>
		<button type="button" class="button" id="perkasa_pm_gallery_clear"<?php echo $gallery ? '' : ' style="display:none"'; ?>><?php esc_html_e( 'Kosongkan', 'perkasa' ); ?></button>
		<input type="hidden" id="perkasa_pm_gallery" name="perkasa_pm_gallery" value="<?php echo esc_attr( implode( ',', $gallery ) ); ?>">
		<div class="perkasa-pm-gallery" id="perkasa_pm_gallery_preview"></div>
	</div>
	<?php
}

/**
 * Enqueue admin JS/CSS pada layar edit proyek.
 *
 * @param string $hook Current admin page.
 */
function perkasa_pm_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	if ( PERKASA_PM_POST_TYPE !== get_post_type() ) {
		return;
	}
	wp_enqueue_media();
	wp_add_inline_script(
		'jquery',
		'(function($){
			function perkasaPmRender(ids){
				var $prev=$("#perkasa_pm_gallery_preview");
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
			function perkasaPmIds(){return ($("#perkasa_pm_gallery").val()||"").split(",").map(Number).filter(Boolean);}
			function perkasaPmSet(ids){$("#perkasa_pm_gallery").val(ids.join(","));perkasaPmRender(ids);$("#perkasa_pm_gallery_clear")[ids.length?"show":"hide"]();}
			$(function(){
				var frame=null;
				perkasaPmRender(perkasaPmIds());
				$("#perkasa_pm_gallery_open").on("click",function(e){e.preventDefault();
					if(frame){frame.open();return;}
					frame=wp.media({title:"Pilih Gambar Galeri",button:{text:"Pilih"},multiple:true,library:{type:"image"}});
					frame.on("select",function(){
						var ids=[];
						frame.state().get("selection").each(function(a){ids.push(parseInt(a.id,10));});
						perkasaPmSet(ids);
					});
					frame.open();
				});
				$("#perkasa_pm_gallery_clear").on("click",function(e){e.preventDefault();perkasaPmSet([]);});
			});
		})(jQuery);',
		'after'
	);
}
add_action( 'admin_enqueue_scripts', 'perkasa_pm_admin_assets' );

/**
 * Save handler — nonce, capability, sanitize, excerpt.
 *
 * @param int $post_id Post ID.
 */
function perkasa_pm_save( $post_id ) {
	if ( ! isset( $_POST['perkasa_pm_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['perkasa_pm_nonce'] ), 'perkasa_pm_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( PERKASA_PM_KEYS as $key ) {
		if ( isset( $_POST[ 'perkasa_pm_' . $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ 'perkasa_pm_' . $key ] ) ) );
		}
	}
	if ( isset( $_POST['perkasa_pm_gallery'] ) ) {
		$ids = array_map( 'absint', explode( ',', sanitize_text_field( wp_unslash( $_POST['perkasa_pm_gallery'] ) ) ) );
		if ( $ids ) {
			update_post_meta( $post_id, PERKASA_PM_GALLERY, $ids );
		} else {
			delete_post_meta( $post_id, PERKASA_PM_GALLERY );
		}
	}

	// Deskripsi singkat → post_excerpt (satu sumber kebenaran).
	if ( isset( $_POST['perkasa_pm_excerpt'] ) ) {
		$excerpt = sanitize_textarea_field( wp_unslash( $_POST['perkasa_pm_excerpt'] ) );
		if ( $excerpt !== get_post_field( 'post_excerpt', $post_id ) ) {
			remove_action( 'save_post_' . PERKASA_PM_POST_TYPE, __FUNCTION__ );
			wp_update_post(
				array(
					'ID'           => $post_id,
					'post_excerpt' => $excerpt,
				)
			);
			add_action( 'save_post_' . PERKASA_PM_POST_TYPE, __FUNCTION__ );
		}
	}
}
add_action( 'save_post_' . PERKASA_PM_POST_TYPE, 'perkasa_pm_save' );