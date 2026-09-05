<?php
/**
 * FAQ Template
 * v1.3.0 — editorial header + accordion + CTA band.
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: FAQ Page
 */
get_header();
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<p class="eyebrow"><?php _e( 'FAQ', 'akdisi' ); ?></p>
		<h1><?php echo esc_html( get_the_title() ); ?></h1>
		<p><?php _e( 'Pertanyaan umum seputar layanan AKDISI.', 'akdisi' ); ?></p>
	</div>
</section>

<div class="section">
	<div class="container" style="max-width:800px;">
		<?php
		$faqs = new WP_Query( [
			'post_type'      => 'akdisi_faq',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_status'    => 'publish',
		] );

		if ( $faqs->have_posts() ) :
			while ( $faqs->have_posts() ) : $faqs->the_post();
		?>
			<div class="faq-item">
				<button class="faq-question" aria-expanded="false">
					<?php the_title(); ?>
				</button>
				<div class="faq-answer">
					<?php the_content(); ?>
				</div>
			</div>
		<?php
			endwhile;
			wp_reset_postdata();
		else :
			while ( have_posts() ) : the_post(); ?>
				<div class="entry-content"><?php the_content(); ?></div>
			<?php endwhile;
		endif;
		?>
	</div>
</div>

<?php get_template_part( 'template-parts/cta-band', null, [
	'title'  => __( 'Masih ada pertanyaan? <span class="serif">Tanya langsung</span>', 'akdisi' ),
	'text'   => __( 'Kami senang dihubungi untuk kebutuhan yang lebih spesifik.', 'akdisi' ),
	'btn_ga' => 'cta_band_faq',
] ); ?>

<?php get_footer();