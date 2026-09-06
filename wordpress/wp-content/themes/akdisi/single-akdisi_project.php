<?php
/**
 * Single project — project detail page.
 *
 * @package AKDISI
 */

get_header();

while ( have_posts() ) :
	the_post();

	$cats  = get_the_term_list( get_the_ID(), 'akdisi_project_cat', '', ', ', '' );
	$visit = function_exists( 'akdisi_pm_get_visit_url' ) ? akdisi_pm_get_visit_url( get_the_ID() ) : '';
	$gal   = function_exists( 'akdisi_pm_get_gallery' ) ? akdisi_pm_get_gallery( get_the_ID() ) : array();
	?>
	<section class="section-bg border-b border-paper-line pt-16 pb-12">
		<div class="container mx-auto">
			<nav class="mb-6 text-sm text-ink-faint" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="hover:text-brand">Proyek</a>
				<span class="mx-2">/</span>
				<span class="text-ink"><?php the_title(); ?></span>
			</nav>
			<div data-reveal class="max-w-3xl">
				<?php if ( $cats ) : ?>
					<span class="badge badge-soft mb-4"><?php echo wp_kses_post( $cats ); ?></span>
				<?php endif; ?>
				<h1 class="font-display text-[clamp(2rem,4.5vw,3.2rem)] font-bold leading-[1.08] tracking-tight text-ink"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="mt-5 text-lg leading-relaxed text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="section section-bg">
		<div class="container mx-auto">
			<div class="aspect-[16/8] overflow-hidden rounded-2xl bg-paper-alt">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'akdisi-wide', array( 'class' => 'h-full w-full object-cover' ) ); ?>
				<?php else : ?>
					<div class="flex h-full items-center justify-center font-display text-6xl font-bold text-ink/10">AKDISI</div>
				<?php endif; ?>
			</div>

			<div class="mt-14 grid gap-12 lg:grid-cols-[1.4fr_1fr]">
				<div class="prose-akdisi space-y-6 leading-relaxed text-ink-soft" data-reveal>
					<?php the_content(); ?>
				</div>
				<aside data-reveal class="lg:sticky lg:top-28 lg:self-start">
					<div class="rounded-2xl border border-paper-line bg-paper-alt p-7 space-y-4">
						<h2 class="text-sm font-semibold uppercase tracking-wide text-ink">Fakta proyek</h2>
						<dl class="space-y-3 text-sm">
							<div class="flex justify-between gap-4"><dt class="text-ink-faint">Klien</dt><dd class="text-ink font-medium"><?php echo esc_html( get_post_meta( get_the_ID(), 'client', true ) ?: '—' ); ?></dd></div>
							<div class="flex justify-between gap-4"><dt class="text-ink-faint">Tahun</dt><dd class="text-ink font-medium"><?php echo esc_html( get_the_date( 'Y' ) ); ?></dd></div>
							<div class="flex justify-between gap-4"><dt class="text-ink-faint">Peran</dt><dd class="text-ink font-medium"><?php echo esc_html( get_post_meta( get_the_ID(), 'role', true ) ?: 'Desain + Bangun' ); ?></dd></div>
							<div class="flex justify-between gap-4"><dt class="text-ink-faint">Status</dt><dd class="text-brand font-medium"><?php echo esc_html( get_post_meta( get_the_ID(), 'status', true ) ?: 'Tayang' ); ?></dd></div>
						</dl>
						<?php if ( $visit ) : ?>
							<a href="<?php echo esc_url( $visit ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary w-full justify-center" data-ga-track="visit_site">Kunjungi situs ↗</a>
						<?php endif; ?>
						<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn <?php echo $visit ? 'btn-outline' : 'btn-primary'; ?> w-full justify-center">Diskusikan proyek serupa</a>
					</div>
				</aside>
			</div>
		</div>

		<?php if ( $gal ) : ?>
			<div class="container mx-auto">
				<div class="mt-16" data-reveal>
					<h2 class="font-display text-2xl font-bold tracking-tight text-ink">Galeri</h2>
					<div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
						<?php
						foreach ( $gal as $aid ) :
							$img = wp_get_attachment_image( $aid, 'akdisi-card', false, array( 'class' => 'h-full w-full object-cover', 'loading' => 'lazy' ) );
							if ( ! $img ) {
								continue;
							}
							?>
							<figure class="overflow-hidden rounded-xl bg-paper-alt"><?php echo $img; ?></figure>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</section>

	<?php endwhile; ?>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();