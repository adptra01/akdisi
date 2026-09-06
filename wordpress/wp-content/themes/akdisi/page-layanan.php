<?php
/**
 * Template Name: Services
 * Page template for /layanan/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Services', 'akdisi' ),
	'title'   => __( 'Full-cycle digital services', 'akdisi' ),
	'sub'     => __( 'Strategy, design, engineering, and growth — one senior team from first sketch to shipped product.', 'akdisi' ),
) );
?>

<!-- Service offerings -->
<section class="section section-bg">
	<div class="container mx-auto">
		<div class="grid gap-6 lg:grid-cols-2">
			<?php
			$services = array(
				array(
					'num'    => '01',
					'title'  => __( 'Product Strategy', 'akdisi' ),
					'desc'   => __( 'Market research, competitor teardowns, and prioritised roadmaps that de-risk what you build.', 'akdisi' ),
					'points' => array( 'Discovery workshops', 'MVP scoping & roadmaps', 'Positioning & naming', 'Competitive analysis' ),
				),
				array(
					'num'    => '02',
					'title'  => __( 'UI/UX Design', 'akdisi' ),
					'desc'   => __( 'Interfaces and design systems that feel inevitable — researched, prototyped, and tested with real users.', 'akdisi' ),
					'points' => array( 'Wireframes & prototypes', 'Design systems', 'Usability testing', 'Design tokens & docs' ),
				),
				array(
					'num'    => '03',
					'title'  => __( 'Web & App Development', 'akdisi' ),
					'desc'   => __( 'Fast, accessible, maintainable products built on modern stacks — from marketing sites to SaaS platforms.', 'akdisi' ),
					'points' => array( 'Custom WordPress themes', 'React / Node applications', 'API design & integration', 'Performance & accessibility' ),
				),
				array(
					'num'    => '04',
					'title'  => __( 'Growth & Marketing', 'akdisi' ),
					'desc'   => __( 'SEO, analytics, and conversion programs that compound after launch — not vanity metrics.', 'akdisi' ),
					'points' => array( 'Technical SEO', 'Analytics & funnels', 'Landing page systems', 'Content operations' ),
				),
			);
			foreach ( $services as $i => $s ) :
				?>
				<article data-reveal class="card p-8 md:p-10" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<div class="flex items-baseline justify-between">
						<span class="font-display text-sm font-bold text-brand"><?php echo esc_html( $s['num'] ); ?></span>
						<span class="badge badge-neutral">On retainer or per project</span>
					</div>
					<h2 class="mt-4 flex items-center gap-3 text-2xl font-semibold text-ink">
						<?php echo esc_html( $s['title'] ); ?>
					</h2>
					<p class="mt-3 leading-relaxed text-ink-soft"><?php echo esc_html( $s['desc'] ); ?></p>
					<ul class="mt-6 grid gap-2.5 sm:grid-cols-2">
						<?php foreach ( $s['points'] as $p ) : ?>
							<li class="flex items-center gap-2 text-sm text-ink-soft">
								<span class="text-brand">&#10003;</span><?php echo esc_html( $p ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Engagement models -->
<section class="section section-alt">
	<div class="container mx-auto">
		<div data-reveal class="mb-12 grid items-end gap-6 lg:grid-cols-[1fr_auto]">
			<div>
				<p class="eyebrow mb-4">Engagement</p>
				<h2 class="section-title">Three ways to work together.</h2>
			</div>
		</div>
		<div class="grid gap-6 md:grid-cols-3">
			<?php
			$models = array(
				array( __( 'Sprint Teams', 'akdisi' ), __( 'Senior team embedded with yours for a fixed sprint (2–4 wks). Weekly demos, full transparency.', 'akdisi' ), __( 'Best when you have momentum and need capacity fast.', 'akdisi' ) ),
				array( __( 'Product Retainer', 'akdisi' ), __( 'Ongoing design + engineering partnership with a shared backlog and monthly priorities.', 'akdisi' ), __( 'Best when you ship continuously and want one accountable team.', 'akdisi' ) ),
				array( __( 'Fixed Scope', 'akdisi' ), __( 'Clearly defined deliverables, milestones, and price. Ideal for a specific launch or rebuild.', 'akdisi' ), __( 'Best when scope is known and budget is fixed.', 'akdisi' ) ),
			);
			foreach ( $models as $i => $m ) :
				?>
				<div data-reveal class="rounded-2xl border border-paper-line bg-white p-7" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<h3 class="text-lg font-semibold text-ink"><?php echo esc_html( $m[0] ); ?></h3>
					<p class="mt-3 text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $m[1] ); ?></p>
					<p class="mt-5 border-t border-paper-line pt-4 text-xs text-ink-faint"><?php echo esc_html( $m[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();