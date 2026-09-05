<?php
/**
 * About Template
 * v1.3.0 — story + real stats + dark values bento + philosophy.
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: About Page
 */
get_header();

$portfolio_count = (int) wp_count_posts( 'akdisi_portfolio' )->publish;
$insight_count   = (int) wp_count_posts( 'akdisi_insight' )->publish;
$services_count  = count( get_posts( [ 'post_type' => 'page', 'post_parent' => get_page_by_path( 'services' ) ? get_page_by_path( 'services' )->ID : 0, 'post_status' => 'publish', 'fields' => 'ids', 'numberposts' => -1 ] ) );
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<p class="eyebrow"><?php _e( 'Our Story', 'akdisi' ); ?></p>
		<h1><?php echo esc_html( get_the_title() ); ?></h1>
		<p><?php _e( 'AKAR Digital Solusi (AKDISI) — pasangan pengembangan solusi digital untuk organisasi dan bisnis Anda.', 'akdisi' ); ?></p>
	</div>
</section>

<div class="section">
	<div class="container">
		<div class="split-grid">
			<div class="entry-content" style="font-size:var(--text-lg);">
				<?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
				?>
			</div>
			<div>
				<div class="stat-grid js-stagger">
					<div data-index="0"><div class="stat-num"><?php echo esc_html( $portfolio_count ); ?></div><div class="stat-label"><?php _e( 'Portfolio Project', 'akdisi' ); ?></div></div>
					<div data-index="1"><div class="stat-num"><?php echo esc_html( $insight_count ); ?></div><div class="stat-label"><?php _e( 'Artikel Insight', 'akdisi' ); ?></div></div>
					<div data-index="2"><div class="stat-num"><?php echo esc_html( $services_count ); ?></div><div class="stat-label"><?php _e( 'Layanan Utama', 'akdisi' ); ?></div></div>
					<div data-index="3"><div class="stat-num">4</div><div class="stat-label"><?php _e( 'Sektor Solusi', 'akdisi' ); ?></div></div>
				</div>
				<div class="split-intro" style="margin-top:var(--s10);">
					<div class="kv-row"><div class="kv-label"><?php _e( 'Berbasis di', 'akdisi' ); ?></div><div class="kv-value"><?php _e( 'Jambi, Indonesia', 'akdisi' ); ?></div></div>
					<div class="kv-row"><div class="kv-label"><?php _e( 'Fokus', 'akdisi' ); ?></div><div class="kv-value"><?php _e( 'Digitalisasi proses bisnis & pembuatan aplikasi', 'akdisi' ); ?></div></div>
					<div class="kv-row"><div class="kv-label"><?php _e( 'Cara kerja', 'akdisi' ); ?></div><div class="kv-value"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php _e( 'Konsultasi langsung', 'akdisi' ); ?></a></div></div>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="section section-dark">
	<div class="grain" aria-hidden="true"></div>
	<div class="container">
		<p class="eyebrow"><?php _e( 'Values', 'akdisi' ); ?></p>
		<h2 class="section-title"><?php _e( 'Nilai Kami', 'akdisi' ); ?></h2>
		<p class="section-lead" style="max-width:52ch;"><?php _e( 'Prinsip yang kami pegang di setiap proyek — dari diskusi pertama hingga sistem berjalan.', 'akdisi' ); ?></p>

		<?php
		$values = [
			[ __( 'Memahami Bisnis Dulu', 'akdisi' ), __( 'Kami memulai dari kebutuhan bisnis, bukan dari teknologi.', 'akdisi' ) ],
			[ __( 'Terstruktur', 'akdisi' ), __( 'Proses kerja jelas dan terdokumentasi di setiap tahapan.', 'akdisi' ) ],
			[ __( 'Transparan', 'akdisi' ), __( 'Komunikasi terbuka dan jujur mengenai kemampuan dan progress.', 'akdisi' ) ],
			[ __( 'Solusi yang Berkembang', 'akdisi' ), __( 'Sistem Anda dapat dikembangkan seiring kebutuhan bisnis yang berubah.', 'akdisi' ) ],
			[ __( 'Mudah Dihubungi', 'akdisi' ), __( 'Konsultasi langsung via WhatsApp untuk mendiskusikan kebutuhan Anda.', 'akdisi' ) ],
		];
		?>
		<div class="bento-grid js-stagger" style="margin-top:var(--s10);">
			<?php foreach ( $values as $i => $value ) : ?>
			<div class="bento-card <?php echo 0 === $i % 2 ? 'wide' : 'narrow'; ?>">
				<span class="bento-num">0<?php echo esc_html( $i + 1 ); ?></span>
				<h3><?php echo esc_html( $value[0] ); ?></h3>
				<p><?php echo esc_html( $value[1] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<div class="section">
	<div class="container">
		<div class="section-header" style="text-align:center;">
			<p class="eyebrow" style="justify-content:center;"><?php _e( 'How We Work', 'akdisi' ); ?></p>
			<h2 class="section-title"><?php _e( 'Filosofi Kerja', 'akdisi' ); ?></h2>
		</div>
		<div class="process-steps js-stagger">
			<div class="process-step"><div class="process-step-number">1</div><h4><?php _e( 'Diagnosa', 'akdisi' ); ?></h4><p><?php _e( 'Pahami masalah dan kebutuhan.', 'akdisi' ); ?></p></div>
			<div class="process-step"><div class="process-step-number">2</div><h4><?php _e( 'Rancang', 'akdisi' ); ?></h4><p><?php _e( 'Desain solusi yang tepat.', 'akdisi' ); ?></p></div>
			<div class="process-step"><div class="process-step-number">3</div><h4><?php _e( 'Bangun', 'akdisi' ); ?></h4><p><?php _e( 'Kembangkan secara bertahap & teruji.', 'akdisi' ); ?></p></div>
			<div class="process-step"><div class="process-step-number">4</div><h4><?php _e( 'Kembangkan', 'akdisi' ); ?></h4><p><?php _e( 'Terus dikembangkan bersama bisnis Anda.', 'akdisi' ); ?></p></div>
		</div>
	</div>
</div>

<?php get_template_part( 'template-parts/cta-band', null, [
	'title'  => __( 'Kenali kebutuhan bisnis Anda — <span class="serif">mulai dari cerita</span>', 'akdisi' ),
	'text'   => __( 'Ceritakan masalah yang ingin Anda selesaikan. Kami bantu merancang jalannya.', 'akdisi' ),
	'btn_ga' => 'cta_band_about',
] ); ?>

<?php get_footer();