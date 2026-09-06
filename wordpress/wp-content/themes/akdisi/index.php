<?php
/**
 * Fallback index — search results and generic archives.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => is_search() ? __( 'Hasil pencarian', 'akdisi' ) : __( 'Arsip', 'akdisi' ),
	'title'   => is_search() ? sprintf( __( 'Hasil untuk &ldquo;%s&rdquo;', 'akdisi' ), get_search_query() ) : get_the_archive_title(),
	'sub'     => __( 'Semua yang layak diterbitkan, dalam satu tempat.', 'akdisi' ),
) );
?>

<section class="section section-bg">
	<div class="container mx-auto">
		<?php if ( have_posts() ) : ?>
			<div class="mx-auto grid max-w-4xl gap-10">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article data-reveal class="group border-b border-paper-line pb-10">
						<a href="<?php the_permalink(); ?>">
							<p class="text-xs font-semibold uppercase tracking-wide text-brand"><?php echo esc_html( get_the_date() ); ?></p>
							<h2 class="mt-2 text-2xl font-semibold text-ink transition-colors group-hover:text-brand"><?php the_title(); ?></h2>
							<p class="mt-3 text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
						</a>
					</article>
				<?php endwhile; ?>
			</div>
			<div class="mt-14">
				<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ) ); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="mx-auto max-w-2xl rounded-2xl border border-dashed border-paper-line bg-paper-alt p-12 text-center">
				<p class="font-display text-5xl font-bold text-ink/20"><?php echo is_search() ? '0' : '404'; ?></p>
				<h2 class="mt-4 text-xl font-semibold text-ink">
					<?php echo is_search() ? esc_html__( 'Tidak ada yang cocok dengan pencarian Anda.', 'akdisi' ) : esc_html__( 'Belum ada apa pun di sini.', 'akdisi' ); ?>
				</h2>
				<p class="mt-2 text-ink-soft">
					<?php
					if ( is_search() ) {
						printf( __( 'Coba kata kunci lain, atau <a href="%s" class="text-brand underline underline-offset-2">jelajahi layanan kami</a>.', 'akdisi' ), esc_url( home_url( '/layanan/' ) ) );
					} else {
						printf( __( 'Kembali ke <a href="%s" class="text-brand underline underline-offset-2">beranda</a> untuk mulai menjelajah.', 'akdisi' ), esc_url( home_url( '/' ) ) );
					}
					?>
				</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>