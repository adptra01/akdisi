<?php
/**
 * Fallback template — archive, search, dll.
 *
 * @package Perkasa
 */

get_header();
get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => is_search() ? 'Hasil pencarian' : 'Arsip',
	'title'   => is_search() ? 'Hasil pencarian untuk: ' . get_search_query() : wp_title( '', false ),
) );
?>

<main id="primary" class="container mx-auto px-4 py-16 md:py-24">
	<?php if ( have_posts() ) : ?>
		<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article class="akdisi-card" data-reveal>
					<a href="<?php the_permalink(); ?>" class="block p-6 no-underline">
						<h2 class="text-lg font-semibold text-ink hover:text-brand"><?php the_title(); ?></h2>
						<p class="mt-2 text-sm text-ink/60"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
					</a>
				</article>
			<?php endwhile; ?>
		</div>

		<div class="mt-12">
			<?php
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => '&larr; Sebelumnya',
				'next_text' => 'Berikutnya &rarr;',
			) );
			?>
		</div>
	<?php else : ?>
		<div class="text-center py-16">
			<p class="text-lg text-ink/60">Tidak ada konten ditemukan.</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary mt-6">Kembali ke Beranda</a>
		</div>
	<?php endif; ?>
</main>

<?php
get_footer();