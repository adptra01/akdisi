<?php
/**
 * Single post fallback (regular posts, generic CPTs).
 *
 * @package AKDISI
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="section-bg border-b border-paper-line pt-16 pb-12">
		<div class="container mx-auto max-w-3xl">
			<div data-reveal>
				<p class="text-xs font-semibold uppercase tracking-wide text-brand"><?php echo esc_html( get_the_date() ); ?></p>
				<h1 class="mt-3 font-display text-[clamp(2rem,4.5vw,3.1rem)] font-bold leading-[1.1] tracking-tight text-ink"><?php the_title(); ?></h1>
			</div>
		</div>
	</section>

	<section class="section section-bg">
		<div class="container mx-auto max-w-3xl">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="mb-12 aspect-[16/9] overflow-hidden rounded-2xl bg-paper-alt">
					<?php the_post_thumbnail( 'akdisi-wide', array( 'class' => 'h-full w-full object-cover' ) ); ?>
				</div>
			<?php endif; ?>

			<article data-reveal class="prose-akdisi text-[17px] leading-relaxed text-ink-soft">
				<?php the_content(); ?>
			</article>
		</div>
	</section>
<?php endwhile; ?>

<?php get_footer(); ?>