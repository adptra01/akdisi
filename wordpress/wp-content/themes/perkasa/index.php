<?php
/**
 * Fallback: archive / search / index — Garuda Perkasa v3.
 *
 * @package Garuda_Perkasa
 */

get_header();
?>

<main id="perkasa-main">
	<section class="bp-grid relative overflow-hidden bg-[#060a12] text-white">
		<div class="relative mx-auto max-w-7xl px-5 pb-16 pt-28 lg:pt-40">
			<p class="eyebrow spec-label mb-5 text-amber-500">Berita &amp; Arsip</p>
			<h1 class="font-display text-4xl font-black uppercase tracking-tight sm:text-5xl">
				<?php
				if ( is_search() ) {
					echo esc_html( 'Hasil pencarian' );
				} elseif ( is_archive() ) {
					echo esc_html( 'Arsip' );
				} else {
					echo esc_html( 'Konten' );
				}
				?>
			</h1>
		</div>
	</section>

	<section class="bg-paper py-20">
		<div class="mx-auto max-w-4xl px-5">
			<?php if ( have_posts() ) : ?>
				<div class="space-y-6">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article class="gp-card p-7">
							<h2 class="font-display text-xl font-bold text-[#060a12]">
								<a href="<?php the_permalink(); ?>" class="hover:text-amber-600"><?php the_title(); ?></a>
							</h2>
							<?php if ( has_excerpt() ) : ?>
								<p class="mt-2 text-sm text-slate-500"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php endif; ?>
						</article>
					<?php endwhile; ?>
				</div>
				<div class="mt-10"><?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?></div>
			<?php else : ?>
				<div class="rounded-xl border border-slate-200 bg-white p-10 text-center">
					<p class="font-display text-xl font-bold text-[#060a12]">Belum ada konten.</p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-amber mt-5">Kembali ke Beranda</a>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();