<?php
/**
 * Generic archive fallback.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Arsip', 'akdisi' ),
	'title'   => wp_strip_all_tags( get_the_archive_title() ),
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
						<a href="<?php the_permalink(); ?>" class="block p-7">
							<span class="badge badge-soft mb-3"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ?? get_post_type() ); ?></span>
							<h2 class="text-lg font-semibold text-ink transition-colors group-hover:text-brand"><?php the_title(); ?></h2>
							<p class="mt-2 text-sm text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
						</a>
					</article>
				<?php endwhile; ?>
			</div>
			<div class="mt-14">
				<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ) ); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-paper-alt p-12 text-center">
				<p class="text-ink-faint">Belum ada yang dipublikasikan.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>