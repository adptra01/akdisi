<?php
/**
 * Template Name: About
 * Page template for /tentang/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'About AKDISI', 'akdisi' ),
	'title'   => __( 'We build digital products for teams that ship.', 'akdisi' ),
	'sub'     => __( 'A senior-only studio from Jambi, partnering with growing businesses across Indonesia and beyond.', 'akdisi' ),
) );
?>

<!-- Story -->
<section class="section section-bg">
	<div class="container mx-auto grid items-start gap-12 lg:grid-cols-[1fr_1.1fr]">
		<div data-reveal>
			<p class="eyebrow mb-4">Our story</p>
			<h2 class="section-title">Born from a simple frustration.</h2>
			<div class="mt-6 space-y-4 leading-relaxed text-ink-soft">
				<p>Too many digital projects fail — not because the team isn't skilled, but because nobody owns the outcome. Requirements drift, hand-offs lose context, and "done" means whatever the last invoice said.</p>
				<p>AKDISI started as a counter to that. A small, senior team where the people who design your product are the same people who build it — and who stay accountable after launch.</p>
				<p>Today we partner with founders, operators, and institutions on everything from marketing sites to full SaaS platforms. Same principle, bigger projects.</p>
			</div>
			<div class="mt-8 flex flex-wrap gap-4">
				<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="btn btn-primary">See our work</a>
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-outline">Get in touch</a>
			</div>
		</div>
		<div data-reveal class="grid gap-6 sm:grid-cols-2">
			<div class="rounded-2xl bg-brand-soft p-8">
				<p class="font-display text-5xl font-bold text-brand">2019</p>
				<p class="mt-3 text-sm text-ink-soft">Founded in Jambi as a two-person web studio.</p>
			</div>
			<div class="rounded-2xl border border-paper-line bg-paper-alt p-8">
				<p class="font-display text-5xl font-bold text-ink">40+</p>
				<p class="mt-3 text-sm text-ink-soft">Projects shipped across 12 industries.</p>
			</div>
			<div class="rounded-2xl border border-paper-line bg-paper-alt p-8">
				<p class="font-display text-5xl font-bold text-ink">12</p>
				<p class="mt-3 text-sm text-ink-soft">People, all senior — no juniors learning on your budget.</p>
			</div>
			<div class="rounded-2xl bg-ink p-8">
				<p class="font-display text-5xl font-bold text-white">98%</p>
				<p class="mt-3 text-sm text-stone-400">Of clients return for a second engagement.</p>
			</div>
		</div>
	</div>
</section>

<!-- Values -->
<section class="section section-alt">
	<div class="container mx-auto">
		<div data-reveal class="mb-12 max-w-2xl">
			<p class="eyebrow mb-4">Values</p>
			<h2 class="section-title">What we refuse to compromise.</h2>
		</div>
		<div class="grid gap-6 md:grid-cols-3">
			<?php
			$values = array(
				array( __( 'Own the outcome', 'akdisi' ), __( 'We measure success by your metrics — launches, conversions, retention — not by hours billed.', 'akdisi' ) ),
				array( __( 'Senior, always', 'akdisi' ), __( 'The person in your kickoff is the person shipping the work. No bait-and-switch staffing.', 'akdisi' ) ),
				array( __( 'Boring reliability', 'akdisi' ), __( 'Consistent demos, honest timelines, plain language. Excitement should come from the product.', 'akdisi' ) ),
			);
			foreach ( $values as $i => $v ) :
				?>
				<div data-reveal class="card p-7" style="transition-delay:<?php echo esc_attr( $i * 70 ); ?>ms">
					<div class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-brand-soft font-display text-sm font-bold text-brand"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></div>
					<h3 class="text-lg font-semibold text-ink"><?php echo esc_html( $v[0] ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $v[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();