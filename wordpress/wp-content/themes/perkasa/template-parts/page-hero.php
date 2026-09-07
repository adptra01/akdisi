<?php
/**
 * Page hero — shared inner-page header.
 *
 * @package Perkasa
 */
$eyebrow = $args['eyebrow'] ?? '';
$title   = $args['title'] ?? get_the_title();
$sub     = $args['sub'] ?? '';
?>
<section class="section-alt border-b border-paper-line py-14 md:py-20">
	<div class="container mx-auto px-5 lg:px-8">
		<div data-reveal class="max-w-3xl">
			<?php if ( $eyebrow ) : ?>
				<p class="eyebrow mb-4"><?php echo esc_html( $eyebrow ); ?></p>
			<?php endif; ?>
			<h1 class="font-display text-[clamp(2rem,4.5vw,3.2rem)] font-bold leading-[1.1] tracking-tight text-ink">
				<?php echo esc_html( $title ); ?>
			</h1>
			<?php if ( $sub ) : ?>
				<p class="mt-4 max-w-2xl text-lg leading-relaxed text-ink-soft"><?php echo esc_html( $sub ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
