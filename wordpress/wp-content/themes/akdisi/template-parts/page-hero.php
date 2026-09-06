<?php
/**
 * Page hero — shared inner-page header.
 * Expects: $args[ 'eyebrow' ], $args[ 'title' ], $args[ 'sub' ].
 *
 * @package AKDISI
 */
$ary_eyebrow = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$ary_title   = isset( $args['title'] ) ? $args['title'] : get_the_title();
$ary_sub     = isset( $args['sub'] ) ? $args['sub'] : '';
?>
<section class="section-bg border-b border-paper-line pt-16 pb-12 md:pt-20 md:pb-16">
	<div class="container mx-auto">
		<div data-reveal class="max-w-3xl">
			<?php if ( $ary_eyebrow ) : ?>
				<p class="eyebrow mb-4"><?php echo esc_html( $ary_eyebrow ); ?></p>
			<?php endif; ?>
			<h1 class="font-display text-[clamp(2.2rem,5vw,3.4rem)] font-bold leading-[1.08] tracking-tight text-ink">
				<?php echo esc_html( $ary_title ); ?>
			</h1>
			<?php if ( $ary_sub ) : ?>
				<p class="mt-5 max-w-2xl text-lg leading-relaxed text-ink-soft"><?php echo esc_html( $ary_sub ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>