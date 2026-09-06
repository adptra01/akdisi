<?php
/**
 * Template Name: Services
 * Page template for /layanan/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Layanan', 'akdisi' ),
	'title'   => __( 'Layanan digital full-cycle', 'akdisi' ),
	'sub'     => __( 'Strategi, desain, engineering, dan pertumbuhan — satu tim senior dari ide pertama hingga produk tayang.', 'akdisi' ),
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
					'title'  => __( 'Strategi Produk', 'akdisi' ),
					'desc'   => __( 'Riset pasar, analisis kompetitor, dan peta jalan prioritas yang memastikan Anda membangun hal yang tepat.', 'akdisi' ),
					'points' => array( 'Workshop penemuan', 'Scoping MVP & peta jalan', 'Positioning & penamaan', 'Analisis kompetitif' ),
				),
				array(
					'num'    => '02',
					'title'  => __( 'Desain UI/UX', 'akdisi' ),
					'desc'   => __( 'Antarmuka dan design system yang terasa pas — diteliti, diprototipe, dan diuji dengan pengguna nyata.', 'akdisi' ),
					'points' => array( 'Wireframe & prototipe', 'Design system', 'Uji kegunaan', 'Design token & dokumentasi' ),
				),
				array(
					'num'    => '03',
					'title'  => __( 'Pengembangan Website & Aplikasi', 'akdisi' ),
					'desc'   => __( 'Produk cepat, aman, dan mudah dirawat di atas stack modern — dari situs marketing hingga platform SaaS.', 'akdisi' ),
					'points' => array( 'Tema WordPress kustom', 'Aplikasi React / Node', 'Desain & integrasi API', 'Performa & aksesibilitas' ),
				),
				array(
					'num'    => '04',
					'title'  => __( 'Pertumbuhan & Pemasaran', 'akdisi' ),
					'desc'   => __( 'SEO, analitik, dan program konversi yang terus memberi hasil setelah tayang — bukan metrik vanity.', 'akdisi' ),
					'points' => array( 'SEO teknis', 'Analitik & funnel', 'Sistem landing page', 'Operasi konten' ),
				),
			);
			foreach ( $services as $i => $s ) :
				?>
				<article data-reveal class="card p-8 md:p-10" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<div class="flex items-baseline justify-between">
						<span class="font-display text-sm font-bold text-brand"><?php echo esc_html( $s['num'] ); ?></span>
						<span class="badge badge-neutral">Retainer atau per proyek</span>
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
				<p class="eyebrow mb-4">Skema kerja sama</p>
				<h2 class="section-title">Tiga cara bekerja bersama.</h2>
			</div>
		</div>
		<div class="grid gap-6 md:grid-cols-3">
			<?php
			$models = array(
				array( __( 'Tim Sprint', 'akdisi' ), __( 'Tim senior bergabung dengan tim Anda untuk satu sprint tetap (2–4 minggu). Demo mingguan, transparan penuh.', 'akdisi' ), __( 'Cocok saat Anda punya momentum dan butuh kapasitas cepat.', 'akdisi' ) ),
				array( __( 'Retainer Produk', 'akdisi' ), __( 'Kemitraan desain + engineering berkelanjutan dengan backlog bersama dan prioritas bulanan.', 'akdisi' ), __( 'Cocok jika Anda rilis terus-menerus dan ingin satu tim yang bertanggung jawab.', 'akdisi' ) ),
				array( __( 'Lingkup Tetap', 'akdisi' ), __( 'Deliverable, milestone, dan harga yang jelas. Ideal untuk peluncuran atau rebuild tertentu.', 'akdisi' ), __( 'Cocok saat lingkup sudah pasti dan anggaran tetap.', 'akdisi' ) ),
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