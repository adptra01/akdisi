<?php
/**
 * Page hero seragam halaman dalam — Garuda Perkasa v3.
 *
 * Args: eyebrow, title (HTML), sub.
 *
 * @package Garuda_Perkasa
 */

$perkasa_eyebrow = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$perkasa_sub     = isset( $args['sub'] ) ? $args['sub'] : '';
$perkasa_title   = isset( $args['title'] ) ? $args['title'] : 'Perkasa';
?>
<section class="bp-grid relative overflow-hidden bg-[#060a12] text-white" aria-labelledby="page-title">
	<div class="pointer-events-none absolute inset-0" aria-hidden="true">
		<div data-parallax="8" class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-amber-500/15 blur-[110px]"></div>
	</div>
	<div class="relative mx-auto max-w-7xl px-5 pb-16 pt-28 lg:pb-20 lg:pt-40">
		<?php if ( $perkasa_eyebrow ) : ?>
			<p class="eyebrow spec-label mb-5 text-amber-500" data-reveal><?php echo esc_html( $perkasa_eyebrow ); ?></p>
		<?php endif; ?>
		<h1 id="page-title" class="font-display text-4xl font-black uppercase leading-[0.95] tracking-tight sm:text-6xl lg:text-7xl" data-reveal>
			<?php echo wp_kses_post( $perkasa_title ); ?>
		</h1>
		<?php if ( $perkasa_sub ) : ?>
			<p class="mt-6 max-w-xl text-sm leading-relaxed text-slate-300 sm:text-base" data-reveal><?php echo esc_html( $perkasa_sub ); ?></p>
		<?php endif; ?>
	</div>
</section>