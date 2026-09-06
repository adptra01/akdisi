<?php
/**
 * Template Name: Testimonials
 * Page template for /testimoni/.
 *
 * @package AKDISI
 */

get_header();

$testimonials = new WP_Query(
	array(
		'post_type'      => 'akdisi_testimonial',
		'posts_per_page' => 12,
		'no_found_rows'  => true,
		'post_status'    => 'publish',
	)
);

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Testimonials', 'akdisi' ),
	'title'   => __( "Don't take our word for it.", 'akdisi' ),
	'sub'     => __( "A few words from the founders and operators we've shipped with.", 'akdisi' ),
) );
?>

<section class="section section-bg">
	<div class="container mx-auto">
		<?php if ( $testimonials->have_posts() ) : ?>
			<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
				<?php
				while ( $testimonials->have_posts() ) :
					$testimonials->the_post();
					$role = get_post_meta( get_the_ID(), 'role', true );
					?>
					<figure data-reveal class="card flex flex-col p-7">
						<div class="mb-4 flex gap-1 text-brand" aria-label="5 stars">★★★★★</div>
						<blockquote class="flex-1 text-[15px] leading-relaxed text-ink-soft">&ldquo;<?php echo esc_html( get_the_excerpt() ?: wp_trim_words( get_the_content(), 32 ) ); ?>&rdquo;</blockquote>
						<figcaption class="mt-6 flex items-center gap-3 border-t border-paper-line pt-5">
							<div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-soft font-display text-sm font-bold text-brand">
								<?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?>
							</div>
							<div>
								<p class="text-sm font-semibold text-ink"><?php the_title(); ?></p>
								<p class="text-xs text-ink-faint"><?php echo esc_html( $role ?: __( 'Client partner', 'akdisi' ) ); ?></p>
							</div>
						</figcaption>
					</figure>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-paper-alt p-12 text-center">
				<p class="text-ink-faint">Client stories will be published here as they come in.</p>
				<p class="mt-3 text-sm text-ink-faint">Want to be first? <a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="text-brand underline underline-offset-2">Start a project</a>.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();