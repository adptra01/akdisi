<?php
/**
 * Template Name: Use Cases
 * Page template for /use-cases/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Use case', 'akdisi' ),
	'title'   => __( 'Tempat kami memberikan dampak yang terukur.', 'akdisi' ),
	'sub'     => __( 'Pola pekerjaan yang rutin kami eksekusi dengan baik — beserta hasil yang menyertainya.', 'akdisi' ),
) );
?>

<section class="section section-bg">
	<div class="container mx-auto">
		<div class="grid gap-8 lg:grid-cols-2">
			<?php
			$cases = array(
				array(
					'title'  => __( 'Website marketing yang menghasilkan', 'akdisi' ),
					'desc'   => __( 'Dari sekadar brosur online menjadi mesin pendapatan: pesan yang tepat, design system, dan build yang cepat.', 'akdisi' ),
					'stack'  => 'WordPress · Astro · Vercel',
					'tag'    => 'Web',
				),
				array(
					'title'  => __( 'Peluncuran platform SaaS', 'akdisi' ),
					'desc'   => __( 'Dari MVP ke produksi dalam hitungan minggu — auth, billing, dashboard, dan analitik untuk tahu apa yang bekerja.', 'akdisi' ),
					'stack'  => 'React · Node · Postgres',
					'tag'    => 'Produk',
				),
				array(
					'title'  => __( 'Perombakan sistem internal', 'akdisi' ),
					'desc'   => __( 'Ganti spreedsheet dan pengetahuan yang tersebar dengan sistem terstruktur yang benar-benar dipakai tim Anda.', 'akdisi' ),
					'stack'  => 'Web app · Panel admin',
					'tag'    => 'Digital',
				),
				array(
					'title'  => __( 'Brand + kampanye peluncuran', 'akdisi' ),
					'desc'   => __( 'Penyegaran identitas dipadukan sistem landing page dan fondasi SEO untuk peluncuran yang berkesan.', 'akdisi' ),
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