<?php
/**
 * Generic page template — fallback for pages without a dedicated template.
 *
 * @package AKDISI
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="section-bg border-b border-paper-line pt-16 pb-12">
		<div class="container mx-auto">
			<div data-reveal>
				<h1 class="font-display text-[clamp(2rem,4.5vw,3.2rem)] font-bold leading-[1.08] tracking-tight text-ink"><?php the_title(); ?></h1>
			</div>
		</div>
	</section>

	<section class="section section-bg">
		<div class="container mx-auto max-w-3xl">
			<article data-reveal class="prose-akdisi text-[17px] leading-relaxed text-ink-soft">
				<?php the_content(); ?>
			</article>
		</div>
	</section>
<?php endwhile; ?>

<?php get_footer(); ?>