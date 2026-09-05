<?php
/**
 * Services Template
 * Listing empat layanan utama (PRD BAGIAN G) — link ke halaman detail masing-masing.
 * v1.3.0 — dark bento grid, editorial rhythm.
 *
 * @package AKDISI
 * @since 1.1.0
 *
 * Template Name: Services Page
 */

get_header();
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<p class="eyebrow"><?php _e( 'What We Build', 'akdisi' ); ?></p>
		<h1><?php echo esc_html( get_the_title() ); ?></h1>
		<p><?php _e( 'Kami membantu organisasi dan bisnis memahami kebutuhan, merancang solusi, dan membangun aplikasi.', 'akdisi' ); ?></p>
	</div>
</section>

<section class="section section-dark" id="layanan">
	<div class="grain" aria-hidden="true"></div>
	<div class="container">
		<div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:var(--s6);margin-bottom:var(--s10);">
			<div>
				<p class="eyebrow"><?php _e( 'Services', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Empat Layanan Utama', 'akdisi' ); ?></h2>
				<p class="section-lead"><?php _e( 'Semua dibangun custom — mengikuti proses bisnis Anda, bukan memaksa proses Anda mengikuti software.', 'akdisi' ); ?></p>
			</div>
		</div>

		<?php
		$service_pages = get_posts( [
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'post_parent'    => get_the_ID(),
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		] );

		if ( $service_pages ) :
		?>
		<div class="bento-grid js-stagger">
			<?php foreach ( $service_pages as $i => $service ) :
				$excerpt = has_excerpt( $service->ID )
					? get_the_excerpt( $service )
					: wp_trim_words( wp_strip_all_tags( (string) $service->post_content ), 22 );
			?>
			<div class="bento-card <?php echo 0 === $i % 2 ? 'wide' : 'narrow'; ?>">
				<span class="bento-num">0<?php echo esc_html( $i + 1 ); ?></span>
				<h3><?php echo esc_html( get_the_title( $service ) ); ?></h3>
				<p><?php echo esc_html( $excerpt ); ?></p>
				<a href="<?php echo esc_url( get_permalink( $service ) ); ?>" class="text-link" data-ga-track="cta_click" data-ga-content="service_<?php echo esc_attr( $service->post_name ); ?>"><?php _e( 'Pelajari Layanan', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<?php else : ?>
		<div class="bento-grid">
			<?php
			$defaults = [
				[ 'application-development',         __( 'Application Development', 'akdisi' ),       __( 'Pembangunan aplikasi yang dirancang berdasarkan kebutuhan dan proses bisnis organisasi.', 'akdisi' ) ],
				[ 'business-process-digitalization', __( 'Business Process Digitalization', 'akdisi' ), __( 'Mengubah proses manual menjadi workflow digital.', 'akdisi' ) ],
				[ 'data-administration-systems',     __( 'Data & Administration Systems', 'akdisi' ),   __( 'Sistem pengelolaan data anggota, unit, aset, dan dokumen.', 'akdisi' ) ],
				[ 'custom-business-solutions',       __( 'Custom Business Solutions', 'akdisi' ),       __( 'Solusi untuk kebutuhan khusus yang tidak cocok dengan software generik.', 'akdisi' ) ],
			];
			foreach ( $defaults as $i => $service ) :
			?>
			<div class="bento-card <?php echo 0 === $i % 2 ? 'wide' : 'narrow'; ?>">
				<span class="bento-num">0<?php echo esc_html( $i + 1 ); ?></span>
				<h3><?php echo esc_html( $service[1] ); ?></h3>
				<p><?php echo esc_html( $service[2] ); ?></p>
				<a href="<?php echo esc_url( home_url( '/services/' . $service[0] . '/' ) ); ?>" class="text-link"><?php _e( 'Pelajari Layanan', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<div class="section">
	<div class="container">
		<?php get_template_part( 'template-parts/cta-band', null, [
			'title'   => __( '<span class="serif">Diskusikan</span> kebutuhan Anda', 'akdisi' ),
			'text'    => __( 'Tidak yakin solusi apa yang Anda butuhkan? Kami siap membantu.', 'akdisi' ),
			'btn_ga'  => 'cta_band_services',
		] ); ?>
	</div>
</div>

<?php get_footer();