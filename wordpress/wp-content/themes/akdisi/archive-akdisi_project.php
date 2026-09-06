<?php
/**
 * Projects archive — /projects/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Selected work', 'akdisi' ),
	'title'   => __( 'Projects', 'akdisi' ),
	'sub'     => __( "A selection of products, platforms, and campaigns we've designed and built.", 'akdisi' ),
) );
?>

<section class="section section-bg">
	<div class="container mx-auto">
		<?php if ( have_posts() ) : ?>
			<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article data-reveal class="card group">
						<a href="<?php the_permalink(); ?>" class="block">
							<div class="aspect-[16/10] overflow-hidden bg-paper-alt">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'akdisi-card', array( 'class' => 'h-full w-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
								<?php else : ?>
									<div class="flex h-full items-center justify-center font-display text-3xl font-bold text-ink/15">AKDISI</div>
								<?php endif; ?>
							</div>
							<div class="p-6">
								<span class="badge badge-soft mb-3">
									<?php echo esc_html( wp_strip_all_tags( get_the_term_list( get_the_ID(), 'akdisi_project_cat', '', ', ', '' ) ) ?: __( 'Case study', 'akdisi' ) ); ?>
								</span>
								<h2 class="text-lg font-semibold text-ink transition-colors group-hover:text-brand"><?php the_title(); ?></h2>
								<p class="mt-2 text-sm text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
							</div>
						</a>
					</article>
				<?php endwhile; ?>
			</div>

			<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ) ); ?>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-paper-alt p-12 text-center">
				<p class="text-ink-faint">No projects published yet. Check back soon — or <a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="text-brand underline underline-offset-2">start one with us</a>.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();