<?php
/**
 * Front Page Template — v2.0.0
 * Editorial Asymmetric + Liquid Glass + Kinetic Typography.
 *
 * @package AKDISI
 * @since 2.0.0
 */

if ( ! function_exists( 'akdisi_tpl_link' ) ) {
	function akdisi_tpl_link( string $path, string $archive ): string {
		$page = get_page_by_path( $path );
		if ( $page && 'publish' === $page->post_status ) {
			return (string) get_permalink( $page );
		}
		return $archive;
	}
}

get_header();
?>

<!-- ============ HERO (DARK · asymmetric split) ============ -->
<section class="hero" id="beranda">
	<div class="hero-bg-grid" aria-hidden="true"></div>
	<div class="hero-glow" aria-hidden="true"></div>
	<div class="container">
		<div class="hero-content">
			<p class="eyebrow"><?php _e( 'AKAR Digital Solusi — Jambi, Indonesia', 'akdisi' ); ?></p>
			<h1 class="hero-headline">
				<span class="hero-line"><span><?php _e( 'Custom Application', 'akdisi' ); ?></span></span>
				<span class="hero-line"><span class="thin"><?php _e( 'Development', 'akdisi' ); ?></span></span>
				<span class="hero-line"><span class="accent"><?php _e( 'Partner.', 'akdisi' ); ?></span></span>
			</h1>
			<p class="hero-sub"><?php _e( 'Kami membangun aplikasi dan sistem yang menyesuaikan proses bisnis Anda — mengubah cara kerja manual, spreadsheet, dan WhatsApp menjadi sistem terstruktur yang terukur.', 'akdisi' ); ?></p>
			<div class="hero-cta">
				<a href="<?php echo esc_url( akdisi_tpl_link( 'contact', home_url( '/contact/' ) ) ); ?>" class="btn btn-primary btn-large magnetic" data-ga-track="cta_click" data-ga-content="hero_primary"><?php _e( 'Konsultasikan Kebutuhan Anda', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
				<a href="<?php echo esc_url( akdisi_tpl_link( 'portfolio', get_post_type_archive_link( 'akdisi_portfolio' ) ?: '' ) ); ?>" class="btn btn-glass btn-large magnetic" data-ga-track="cta_click" data-ga-content="hero_secondary"><?php _e( 'Lihat Portfolio', 'akdisi' ); ?></a>
			</div>
			<div class="hero-meta">
				<div><strong>08</strong><?php _e( 'Concept systems', 'akdisi' ); ?></div>
				<div><strong>04</strong><?php _e( 'Core services', 'akdisi' ); ?></div>
				<div><strong>B2B</strong><?php _e( 'Process-first', 'akdisi' ); ?></div>
			</div>
		</div>

		<div class="hero-mockup js-parallax" data-parallax="0.12" role="img" aria-label="<?php esc_attr_e( 'Contoh tampilan aplikasi dashboard', 'akdisi' ); ?>">
			<div class="mockup-bar"><span class="mk-dot-1"></span><span></span><span></span></div>
			<div class="mockup-body">
				<div class="mockup-stats">
					<div>
						<div class="mockup-stat">1,284</div>
						<div class="mockup-label"><?php _e( 'Unit Terdata', 'akdisi' ); ?></div>
					</div>
					<div>
						<div class="mockup-stat">96.4%</div>
						<div class="mockup-label"><?php _e( 'Laporan Tepat Waktu', 'akdisi' ); ?></div>
					</div>
					<div>
						<div class="mockup-stat">37</div>
						<div class="mockup-label"><?php _e( 'Alur Terdigitalisasi', 'akdisi' ); ?></div>
					</div>
				</div>
				<div class="mockup-row">
					<div class="mockup-card"><div class="mk-title"></div><div class="mk-line"></div><div class="mk-line short"></div></div>
					<div class="mockup-card"><div class="mk-title"></div><div class="mk-line"></div><div class="mk-line short"></div></div>
					<div class="mockup-card"><div class="mk-title"></div><div class="mk-line"></div><div class="mk-line short"></div></div>
				</div>
			</div>
		</div>
	</div>
	<span class="hero-scroll-hint" aria-hidden="true"><?php _e( 'Scroll', 'akdisi' ); ?></span>
</section>

<!-- ============ MARQUEE (kinetic strip) ============ -->
<div class="marquee" aria-hidden="true" style="background:var(--color-void);">
	<div class="marquee-track">
		<span><i>●</i><?php _e( 'Application Development', 'akdisi' ); ?></span>
		<span><i>●</i><?php _e( 'Business Process Digitalization', 'akdisi' ); ?></span>
		<span><i>●</i><?php _e( 'Data & Administration Systems', 'akdisi' ); ?></span>
		<span><i>●</i><?php _e( 'Custom Business Solutions', 'akdisi' ); ?></span>
		<span><i>●</i><?php _e( 'Application Development', 'akdisi' ); ?></span>
		<span><i>●</i><?php _e( 'Business Process Digitalization', 'akdisi' ); ?></span>
		<span><i>●</i><?php _e( 'Data & Administration Systems', 'akdisi' ); ?></span>
		<span><i>●</i><?php _e( 'Custom Business Solutions', 'akdisi' ); ?></span>
	</div>
</div>

<!-- ============ PROBLEM (LIGHT · editorial 2-col) ============ -->
<section class="section section-light" id="masalah">
	<div class="container">
		<div class="grid-golden">
			<div>
				<p class="eyebrow"><?php _e( 'The Challenge', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Proses manual tidak harus menghambat pertumbuhan.', 'akdisi' ); ?></h2>
			</div>
			<div>
				<p class="section-lead"><?php _e( 'Banyak organisasi masih mengandalkan cara kerja yang tidak terstruktur — data tersebar, laporan lambat, monitoring sulit. Kami membantu mentransformasikannya menjadi sistem digital yang efisien.', 'akdisi' ); ?></p>
				<div class="transform-flow js-stagger" style="margin-top:var(--s10);">
					<div class="transform-step">
						<div class="transform-node">
							<span class="transform-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 13h6M9 17h4"/></svg>
							</span>
							<span class="transform-label"><?php _e( 'Proses Manual', 'akdisi' ); ?></span>
						</div>
						<p><?php _e( 'Excel, WhatsApp, kertas — data tersebar dan sulit dilacak.', 'akdisi' ); ?></p>
					</div>
					<div class="transform-arrow" aria-hidden="true">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</div>
					<div class="transform-step">
						<div class="transform-node">
							<span class="transform-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><path d="M12 8v4l3 3"/></svg>
							</span>
							<span class="transform-label"><?php _e( 'Analisis & Perancangan', 'akdisi' ); ?></span>
						</div>
						<p><?php _e( 'Kami memahami alur kerja Anda, lalu merancang arsitektur sistem yang tepat.', 'akdisi' ); ?></p>
					</div>
					<div class="transform-arrow" aria-hidden="true">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</div>
					<div class="transform-step">
						<div class="transform-node">
							<span class="transform-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/><line x1="14" y1="4" x2="10" y2="20"/></svg>
							</span>
							<span class="transform-label"><?php _e( 'Sistem Terstruktur', 'akdisi' ); ?></span>
						</div>
						<p><?php _e( 'Aplikasi custom yang berjalan sesuai proses bisnis Anda — bukan sebaliknya.', 'akdisi' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ============ SERVICES (DARK · bento asymmetric) ============ -->
<section class="section section-dark" id="services">
	<div class="container">
		<div class="section-header-split">
			<div>
				<p class="eyebrow"><?php _e( 'What We Build', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Layanan yang mengikuti proses Anda.', 'akdisi' ); ?></h2>
			</div>
			<div class="side-note">
				<p class="section-lead"><?php _e( 'Semua dibangun custom — bukan software paket.', 'akdisi' ); ?></p>
				<p style="margin-top:var(--s4);"><a href="<?php echo esc_url( akdisi_tpl_link( 'services', home_url( '/services/' ) ) ); ?>" class="text-link"><?php _e( 'Semua Layanan', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a></p>
			</div>
		</div>
		<?php
		$svc_pages = get_posts( [
			'post_type'      => 'page',
			'posts_per_page' => 4,
			'post_parent'    => get_page_by_path( 'services' ) ? (int) get_page_by_path( 'services' )->ID : 0,
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		] );
		if ( $svc_pages ) :
		?>
		<div class="bento-grid js-stagger">
			<?php foreach ( $svc_pages as $i => $svc ) : ?>
			<div class="bento-card <?php echo 0 === $i % 2 ? 'wide' : 'narrow'; ?>">
				<span class="bento-num">0<?php echo esc_html( $i + 1 ); ?></span>
				<h3><?php echo esc_html( get_the_title( $svc ) ); ?></h3>
				<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( (string) $svc->post_content ), 18 ) ); ?></p>
				<a href="<?php echo esc_url( get_permalink( $svc ) ); ?>" class="text-link" data-ga-track="cta_click" data-ga-content="service_<?php echo esc_attr( $svc->post_name ); ?>"><?php _e( 'Pelajari Layanan', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<?php else : ?>
		<div class="bento-grid js-stagger">
			<div class="bento-card wide"><span class="bento-num">01</span><h3><?php _e( 'Application Development', 'akdisi' ); ?></h3><p><?php _e( 'Aplikasi custom sesuai kebutuhan dan proses bisnis Anda.', 'akdisi' ); ?></p></div>
			<div class="bento-card narrow"><span class="bento-num">02</span><h3><?php _e( 'Business Process Digitalization', 'akdisi' ); ?></h3><p><?php _e( 'Mengubah proses manual menjadi workflow digital.', 'akdisi' ); ?></p></div>
			<div class="bento-card narrow"><span class="bento-num">03</span><h3><?php _e( 'Data & Administration Systems', 'akdisi' ); ?></h3><p><?php _e( 'Sistem pengelolaan data dan administrasi yang tertata.', 'akdisi' ); ?></p></div>
			<div class="bento-card wide"><span class="bento-num">04</span><h3><?php _e( 'Custom Business Solutions', 'akdisi' ); ?></h3><p><?php _e( 'Solusi untuk kebutuhan khusus organisasi Anda.', 'akdisi' ); ?></p></div>
		</div>
		<?php endif; ?>
	</div>
</section>

<!-- ============ SOLUTIONS (LIGHT · editorial rows) ============ -->
<section class="section section-light" id="solusi">
	<div class="container">
		<div class="grid-golden" style="margin-bottom:var(--s8);">
			<div>
				<p class="eyebrow"><?php _e( 'Solutions', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Solusi untuk berbagai kebutuhan bisnis.', 'akdisi' ); ?></h2>
			</div>
			<p class="section-lead"><?php _e( 'Aplikasi yang dirancang sesuai konteks dan proses bisnis Anda — tidak terbatas pada satu sektor.', 'akdisi' ); ?></p>
		</div>
		<div class="solution-list js-stagger">
			<?php
			$solutions = [
				'housing'      => [ __( 'Perumahan', 'akdisi' ), __( 'Pengelolaan kawasan dan layanan penghuni.', 'akdisi' ) ],
				'developer'    => [ __( 'Developer', 'akdisi' ), __( 'Proses bisnis developer dan penjualan unit.', 'akdisi' ) ],
				'property'     => [ __( 'Properti', 'akdisi' ), __( 'Pengelolaan bisnis dan aset properti.', 'akdisi' ) ],
				'organization' => [ __( 'Organisasi', 'akdisi' ), __( 'Administrasi dan pengelolaan organisasi.', 'akdisi' ) ],
			];
			foreach ( $solutions as $slug => $data ) :
			?>
			<a href="<?php echo esc_url( akdisi_tpl_link( 'solutions/' . $slug, home_url( '/solutions/' . $slug . '/' ) ) ); ?>" class="solution-row" data-ga-track="cta_click" data-ga-content="solution_<?php echo esc_attr( $slug ); ?>">
				<span class="solution-index">0<?php echo esc_html( array_search( $slug, array_keys( $solutions ), true ) + 1 ); ?></span>
				<div class="solution-main">
					<h3><?php echo esc_html( $data[0] ); ?></h3>
					<p><?php echo esc_html( $data[1] ); ?></p>
				</div>
				<span class="text-link"><?php _e( 'Lihat Solusi', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ MARKET PROOF (DARK · asymmetric) ============ -->
<section class="section section-dark" id="proof">
	<div class="container">
		<div class="section-header-split">
			<div>
				<p class="eyebrow"><?php _e( 'Selected Work', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Bukti implementasi nyata.', 'akdisi' ); ?></h2>
			</div>
			<p class="section-lead side-note"><?php _e( 'Sistem yang telah kami bangun — dari pengelolaan kawasan hingga dashboard developer.', 'akdisi' ); ?></p>
		</div>

		<?php
		$highlights = [
			'kawasanhub'    => [ __( 'KawasanHub', 'akdisi' ), __( 'Platform terpadu pengelolaan data penghuni, unit, dan layanan kawasan perumahan.', 'akdisi' ), 'Perumahan' ],
			'properti-care' => [ __( 'PropertiCare', 'akdisi' ), __( 'Portal layanan terpadu untuk penghuni — pengaduan, informasi, dan pelacakan real-time.', 'akdisi' ), 'Service Management' ],
			'projectmonitor'=> [ __( 'ProjectMonitor', 'akdisi' ), __( 'Sistem monitoring progres proyek pembangunan untuk developer perumahan.', 'akdisi' ), 'Dashboard' ],
		];
		?>
		<div class="proof-grid js-stagger">
			<?php foreach ( $highlights as $slug => $data ) :
				$post_obj = get_page_by_path( $slug, OBJECT, 'akdisi_portfolio' );
				if ( ! $post_obj ) {
					$args = [ 'post_type' => 'akdisi_portfolio', 'name' => $slug, 'posts_per_page' => 1, 'post_status' => 'publish' ];
					$q = new WP_Query( $args );
					if ( $q->have_posts() ) { $post_obj = $q->post; }
					wp_reset_postdata();
				}
			?>
			<a href="<?php echo esc_url( $post_obj ? get_permalink( $post_obj ) : home_url( '/portfolio/' ) ); ?>" class="proof-card" data-ga-track="cta_click" data-ga-content="proof_<?php echo esc_attr( $slug ); ?>">
				<span class="card-category"><?php echo esc_html( $data[2] ); ?></span>
				<h3><?php echo esc_html( $data[0] ); ?></h3>
				<p><?php echo esc_html( $data[1] ); ?></p>
				<span class="text-link"><?php _e( 'Lihat Detail', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</span>
			</a>
			<?php endforeach; ?>
		</div>

		<div style="margin-top:var(--s10);">
			<a href="<?php echo esc_url( akdisi_tpl_link( 'portfolio', get_post_type_archive_link( 'akdisi_portfolio' ) ?: '' ) ); ?>" class="btn btn-glass magnetic" data-ga-track="cta_click" data-ga-content="portfolio_all"><?php _e( 'Lihat Semua Project', 'akdisi' ); ?>
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
			</a>
		</div>
	</div>
</section>

<!-- ============ WHY AKDISI (LIGHT · asymmetric 4) ============ -->
<section class="section section-light" id="mengapa">
	<div class="container">
		<p class="eyebrow"><?php _e( 'Why AKDISI', 'akdisi' ); ?></p>
		<h2 class="section-title"><?php _e( 'Mengapa AKDISI?', 'akdisi' ); ?></h2>
		<div class="value-grid js-stagger" style="margin-top:var(--s8);">
			<div class="value-item">
				<span class="value-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6l8-4z"/><path d="M8.5 12l2.5 2.5 4.5-5"/></svg></span>
				<h3><?php _e( 'Business-first Approach', 'akdisi' ); ?></h3>
				<p><?php _e( 'Solusi dimulai dari memahami bisnis, bukan dari teknologi.', 'akdisi' ); ?></p>
			</div>
			<div class="value-item">
				<h3><?php _e( 'Custom, Not Generic', 'akdisi' ); ?></h3>
				<p><?php _e( 'Aplikasi dirancang mengikuti proses bisnis Anda — bukan software paket.', 'akdisi' ); ?></p>
			</div>
			<div class="value-item">
				<h3><?php _e( 'Industry Context', 'akdisi' ); ?></h3>
				<p><?php _e( 'Pemahaman konteks bisnis di berbagai sektor — properti, perumahan, organisasi.', 'akdisi' ); ?></p>
			</div>
			<div class="value-item">
				<h3><?php _e( 'Structured Process', 'akdisi' ); ?></h3>
				<p><?php _e( 'Pengerjaan terstruktur dan terdokumentasi — hingga dukungan jangka panjang.', 'akdisi' ); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- ============ PROCESS (DARK · pinned) ============ -->
<section class="section section-dark process-pin" id="proses" data-pin>
	<div class="container">
		<div class="grid-golden">
			<div>
				<p class="eyebrow"><?php _e( 'How We Work', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Proses kerja kami.', 'akdisi' ); ?></h2>
			</div>
			<p class="section-lead"><?php _e( 'Empat tahap yang jelas — dari diskusi hingga sistem berjalan dan didukung.', 'akdisi' ); ?></p>
		</div>
		<div class="proc-steps">
			<?php
			$process = [
				[ 'Consultation',        __( 'Diskusi awal untuk memahami tujuan dan kebutuhan bisnis Anda.', 'akdisi' ) ],
				[ 'Analysis & Design',   __( 'Kebutuhan dipetakan menjadi arsitektur sistem yang jelas.', 'akdisi' ) ],
				[ 'Development',         __( 'Sistem dibangun bertahap dengan pengujian di setiap milestone.', 'akdisi' ) ],
				[ 'Deployment & Support', __( 'Implementasi, pelatihan, dan dukungan berkelanjutan.', 'akdisi' ) ],
			];
			foreach ( $process as $i => $step ) :
			?>
			<div class="proc-step">
				<span class="proc-step-num">0<?php echo esc_html( $i + 1 ); ?></span>
				<div>
					<h3><?php echo esc_html( $step[0] ); ?></h3>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ FAQ (LIGHT) ============ -->
<?php
$faq = new WP_Query( [ 'post_type' => 'akdisi_faq', 'posts_per_page' => 5, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC' ] );
if ( $faq->have_posts() ) :
?>
<section class="section section-light" id="faq">
	<div class="container">
		<div class="grid-golden" style="margin-bottom:var(--s8);">
			<div>
				<p class="eyebrow"><?php _e( 'FAQ', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Pertanyaan umum.', 'akdisi' ); ?></h2>
			</div>
			<p class="section-lead"><?php _e( 'Jawaban singkat untuk hal yang paling sering ditanyakan.', 'akdisi' ); ?></p>
		</div>
		<div class="faq-list">
			<?php while ( $faq->have_posts() ) : $faq->the_post(); ?>
			<div class="faq-item">
				<button class="faq-question" aria-expanded="false">
					<?php the_title(); ?>
				</button>
				<div class="faq-answer"><?php the_content(); ?></div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php
	wp_reset_postdata();
endif;
?>

<!-- ============ CTA (DARK · split, not centered) ============ -->
<section class="cta-section">
	<div class="hero-bg-grid" aria-hidden="true"></div>
	<div class="grain" aria-hidden="true"></div>
	<div class="container">
		<div>
			<p class="eyebrow"><?php _e( 'Start Here', 'akdisi' ); ?></p>
			<h2><?php echo wp_kses_post( __( 'Siap memindahkan proses manual ke <span class="accent">sistem digital</span>?', 'akdisi' ) ); ?></h2>
			<p><?php _e( 'Konsultasikan kebutuhan Anda bersama tim teknis kami — tanpa jargon, langsung ke solusi.', 'akdisi' ); ?></p>
		</div>
		<div>
			<a href="<?php echo esc_url( akdisi_tpl_link( 'contact', home_url( '/contact/' ) ) ); ?>" class="btn btn-primary btn-large magnetic" data-ga-track="cta_click" data-ga-content="cta_final"><?php _e( 'Konsultasikan Sekarang', 'akdisi' ); ?>
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
