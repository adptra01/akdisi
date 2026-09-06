<?php
/**
 * Insights archive — /insight/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Insight', 'akdisi' ),
	'title'   => __( 'Ide yang sedang kami pikirkan.', 'akdisi' ),
	'sub'     => __( 'Perspektif soal produk, desain, engineering, dan pertumbuhan dari tim AKDISI.', 'akdisi' ),
) );
?>

<section class="section section-bg">
	<div class="container mx-auto">
		<?php if ( have_posts() ) : ?>
			<div class="grid gap-10 lg:grid-cols-3">
				<?php
				$i = 0;
				while ( have_posts() ) :
					the_post();
					$first = ( 0 === $i );
					?>
					<article data-reveal <?php echo $first ? 'class="lg:col-span-2 lg:row-span-2"' : ''; ?> class="group">
						<a href="<?php the_permalink(); ?>" class="block">
							<div class="aspect-[16/9] overflow-hidden rounded-xl bg-paper-alt <?php echo $first ? 'lg:aspect-auto lg:h-full lg:min-h-[280px]' : ''; ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'akdisi-wide', array( 'class' => 'h-full w-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
								<?php else : ?>
									<div class="flex h-full items-center justify-center font-display text-3xl font-bold text-ink/15">AKDISI</div>
								<?php endif; ?>
							</div>
							<p class="mt-5 text-xs font-semibold uppercase tracking-wide text-brand"><?php echo esc_html( get_the_date() ); ?></p>
							<h2 class="mt-2 text-xl font-semibold leading-snug text-ink transition-colors group-hover:text-brand"><?php the_title(); ?></h2>
							<p class="mt-2 text-sm text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
						</a>
					</article>
					<?php
					$i++;
				endwhile;
				?>
			</div>
			<div class="mt-14">
				<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ) ); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-paper-alt p-12 text-center">
				<p class="text-ink-faint">Insight segera hadir. Sambil menunggu, lihat <a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="text-brand underline underline-offset-2">karya kami</a>.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();