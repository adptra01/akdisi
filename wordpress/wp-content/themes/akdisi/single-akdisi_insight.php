<?php
/**
 * Single insight — article detail.
 *
 * @package AKDISI
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="section-bg border-b border-paper-line pt-16 pb-12">
		<div class="container mx-auto max-w-3xl">
			<nav class="mb-6 text-sm text-ink-faint" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/insight/' ) ); ?>" class="hover:text-brand">Insight</a>
				<span class="mx-2">/</span>
				<span class="text-ink"><?php the_title(); ?></span>
			</nav>
			<div data-reveal>
				<p class="text-xs font-semibold uppercase tracking-wide text-brand"><?php echo esc_html( get_the_date() ); ?></p>
				<h1 class="mt-3 font-display text-[clamp(2rem,4.5vw,3.1rem)] font-bold leading-[1.1] tracking-tight text-ink"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="mt-5 text-lg leading-relaxed text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
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

			<div class="mt-12 border-t border-paper-line pt-8">
				<a href="<?php echo esc_url( home_url( '/insight/' ) ); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-brand">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5m6-6-6 6 6 6"/></svg>
					All insights
				</a>
			</div>
		</div>
	</section>
<?php endwhile; ?>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();