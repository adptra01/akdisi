<?php
/**
 * Template Name: Use Cases
 * Page template for /use-cases/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Use cases', 'akdisi' ),
	'title'   => __( 'Where we make a measurable dent.', 'akdisi' ),
	'sub'     => __( 'Patterns of work we repeatedly execute well — and the outcomes that follow.', 'akdisi' ),
) );
?>

<section class="section section-bg">
	<div class="container mx-auto">
		<div class="grid gap-8 lg:grid-cols-2">
			<?php
			$cases = array(
				array(
					'title'  => __( 'Marketing sites that convert', 'akdisi' ),
					'desc'   => __( 'From brochure-ware to revenue-generating presence: messaging, design systems, and fast builds.', 'akdisi' ),
					'stack'  => 'WordPress · Astro · Vercel',
					'tag'    => 'Web',
				),
				array(
					'title'  => __( 'SaaS platform launch', 'akdisi' ),
					'desc'   => __( 'MVP to production in weeks — auth, billing, dashboards, and the analytics to know what works.', 'akdisi' ),
					'stack'  => 'React · Node · Postgres',
					'tag'    => 'Product',
				),
				array(
					'title'  => __( 'Internal tooling overhaul', 'akdisi' ),
					'desc'   => __( 'Replace spreadsheets and tribal knowledge with structured systems your team actually uses.', 'akdisi' ),
					'stack'  => 'Web app · Admin panel',
					'tag'    => 'Digital',
				),
				array(
					'title'  => __( 'Brand + launch campaign', 'akdisi' ),
					'desc'   => __( 'Identity refresh paired with a landing system and SEO foundation for a memorable launch.', 'akdisi' ),
					'stack'  => 'Brand · Landing · SEO',
					'tag'    => 'Growth',
				),
			);
			foreach ( $cases as $i => $c ) :
				?>
				<article data-reveal class="card group p-8" style="transition-delay:<?php echo esc_attr( $i * 70 ); ?>ms">
					<div class="mb-5 flex items-center justify-between">
						<span class="badge badge-soft"><?php echo esc_html( $c['tag'] ); ?></span>
						<span class="font-display text-2xl font-bold text-ink/10"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					</div>
					<h2 class="text-xl font-semibold text-ink transition-colors group-hover:text-brand"><?php echo esc_html( $c['title'] ); ?></h2>
					<p class="mt-3 leading-relaxed text-ink-soft"><?php echo esc_html( $c['desc'] ); ?></p>
					<p class="mt-5 text-xs font-mono uppercase tracking-wider text-ink-faint"><?php echo esc_html( $c['stack'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();