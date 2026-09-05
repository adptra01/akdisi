<?php
/**
 * Front Page Template
 * PRD BAGIAN E §18–28 — Hero, Problem, Approach, Solution, Service, Portfolio, Why, Process, FAQ, CTA.
 * v1.3.0 — Modern Digital Enterprise layout: dark/light rhythm, editorial hero split,
 * bento services, asymmetric solutions, horizontal portfolio (desktop), pinned process.
 * Nav links: use helper that prefers page (page_by_path) then archive URL.
 *
 * @package AKDISI
 * @since 1.1.0
 */

if ( ! function_exists( 'akdisi_tpl_link' ) ) {
	/**
	 * Resolve a front-end section link. Prefer a page with $path; fall back to an archive URL.
	 */
	function akdisi_tpl_link( string $path, string $archive ): string {
		$page = get_page_by_path( $path );
		if ( $page && 'publish' === $page->post_status ) {
			return (string) get_permalink( $page );
		}
		return $archive;
	}
}

get_header();

$hero_title    = get_theme_mod( 'akdisi_hero_title', 'Jasa Pembuatan Aplikasi & Solusi Digital untuk Bisnis Anda' );
$hero_subtitle = get_theme_mod(
	'akdisi_hero_subtitle',
	'Kami membangun aplikasi dan sistem informasi yang menyesuaikan proses bisnis Anda — mulai dari pengelolaan data, administrasi, layanan, hingga kebutuhan operasional yang spesifik, di berbagai sektor.'
);

/* Split headline: accent the core keyword with serif italic (DOM text unchanged → SEO/PRD safe). */
$title_words  = preg_split( '/\s+/u', trim( $hero_title ) );
$title_part1  = implode( ' ', array_slice( $title_words, 0, 3 ) );
$title_rest   = implode( ' ', array_slice( $title_words, 3 ) );
?>

<!-- ============ HERO (DARK) ============ -->
<section class="hero" id="beranda">
	<div class="hero-bg-grid" aria-hidden="true"></div>
	<div class="grain" aria-hidden="true"></div>
	<div class="container">
		<div class="hero-content">
			<p class="eyebrow"><?php _e( 'AKAR Digital Solusi — Jambi, Indonesia', 'akdisi' ); ?></p>
			<h1 class="hero-headline">
				<span class="hero-line"><span><?php echo esc_html( $title_part1 ); ?></span></span>
				<span class="hero-line"><span><?php echo esc_html( $title_rest ); ?></span></span>
			</h1>
			<p class="hero-sub"><?php echo esc_html( $hero_subtitle ); ?></p>
			<div class="hero-cta">
				<a href="<?php echo esc_url( akdisi_tpl_link( 'contact', home_url( '/contact/' ) ) ); ?>" class="btn btn-accent btn-large magnetic" data-ga-track="cta_click" data-ga-content="hero_primary"><?php _e( 'Konsultasikan Kebutuhan Anda', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
				<a href="<?php echo esc_url( akdisi_tpl_link( 'portfolio', get_post_type_archive_link( 'akdisi_portfolio' ) ?: '' ) ); ?>" class="btn btn-ghost btn-large magnetic" data-ga-track="cta_click" data-ga-content="hero_secondary"><?php _e( 'Lihat Portfolio', 'akdisi' ); ?></a>
			</div>
		</div>

		<!-- Hero mockup (PRD §79) — dark glass app UI, data-parallax -->
		<div class="hero-mockup js-parallax" data-parallax="0.12" role="img" aria-label="<?php esc_attr_e( 'Contoh tampilan aplikasi dashboard', 'akdisi' ); ?>">
			<div class="mockup-bar"><span class="mk-dot-1"></span><span></span><span></span></div>
			<div class="mockup-body">
				<div class="mockup-stats">
					<div>
						<div class="mockup-stat">Rp0</div>
						<div class="mockup-label"><?php _e( 'Iuran Terhimpun Bulan Ini', 'akdisi' ); ?></div>
					</div>
					<div>
						<div class="mockup-stat">128</div>
						<div class="mockup-label"><?php _e( 'Pengaduan Selesai', 'akdisi' ); ?></div>
					</div>
					<div>
						<div class="mockup-stat">92%</div>
						<div class="mockup-label"><?php _e( 'Tingkat Penyelesaian', 'akdisi' ); ?></div>
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

<!-- ============ PROBLEM + APPROACH (LIGHT) ============ -->
<section class="section section-light" id="masalah">
	<div class="container">
		<div class="section-header">
			<p class="eyebrow"><?php _e( 'The Problem', 'akdisi' ); ?></p>
			<h2 class="section-title"><?php _e( 'Ketika Proses Bisnis Bertumbuh, Sistem Harus Ikut Berkembang', 'akdisi' ); ?></h2>
			<p class="section-lead"><?php _e( 'Banyak organisasi terjebak pada proses lama yang lambat dan tidak akurat.', 'akdisi' ); ?></p>
		</div>
		<div class="card-grid js-stagger">
			<div class="card"><div class="card-body"><span class="card-category">01</span><h3><?php _e( 'Data Tersebar', 'akdisi' ); ?></h3><p><?php _e( 'Informasi tersimpan di banyak tempat dan sulit dianalisis.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><span class="card-category">02</span><h3><?php _e( 'Proses Manual', 'akdisi' ); ?></h3><p><?php _e( 'Pekerjaan berulang memakan waktu dan rentan kesalahan.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><span class="card-category">03</span><h3><?php _e( 'Monitoring Sulit', 'akdisi' ); ?></h3><p><?php _e( 'Perkembangan operasional tidak terpantau secara real-time.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><span class="card-category">04</span><h3><?php _e( 'Laporan Lambat', 'akdisi' ); ?></h3><p><?php _e( 'Laporan disusun manual sehingga sering terlambat.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><span class="card-category">05</span><h3><?php _e( 'Sistem yang Ada Tidak Sesuai', 'akdisi' ); ?></h3><p><?php _e( 'Software generik tidak mengikuti cara kerja organisasi Anda.', 'akdisi' ); ?></p></div></div>
		</div>

		<div class="approach-block" style="margin-top:var(--s12);">
			<p class="eyebrow"><?php _e( 'The Approach', 'akdisi' ); ?></p>
			<h2 class="section-title"><?php _e( 'Kami Mulai dari Memahami Proses Bisnis Anda', 'akdisi' ); ?></h2>
			<div class="approach-steps js-stagger" style="display:flex;flex-wrap:wrap;gap:var(--s3);margin-top:var(--s6);">
				<?php
				$approach = [ 'Understand', 'Analyze', 'Design', 'Build', 'Implement', 'Improve' ];
				foreach ( $approach as $i => $step ) :
				?>
				<span class="approach-chip" style="display:inline-flex;align-items:center;gap:var(--s2);padding:0.6rem 1.1rem;border:1px solid var(--line-light);border-radius:var(--r-pill);background:var(--white);font-size:var(--text-sm);font-weight:600;">
					<span style="font-family:var(--font-serif);color:var(--forest);font-size:1.1em;"><?php echo esc_html( $i + 1 ); ?></span>
					<?php esc_html_e( $step, 'akdisi' ); ?>
				</span>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- ============ SERVICES (DARK · bento) ============ -->
<section class="section section-dark" id="services">
	<div class="grain" aria-hidden="true"></div>
	<div class="container">
		<div class="section-header" style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:var(--s6);">
			<div>
				<p class="eyebrow"><?php _e( 'Services', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Layanan Kami', 'akdisi' ); ?></h2>
				<p class="section-lead"><?php _e( 'Apa yang bisa Anda pesan dari AKDISI.', 'akdisi' ); ?></p>
			</div>
			<a href="<?php echo esc_url( akdisi_tpl_link( 'services', home_url( '/services/' ) ) ); ?>" class="text-link"><?php _e( 'Semua Layanan', 'akdisi' ); ?>
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
			</a>
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
		<div class="bento-grid js-stagger" style="margin-top:var(--s10);">
			<?php foreach ( $svc_pages as $i => $svc ) : ?>
			<div class="bento-card <?php echo 0 === $i % 2 ? 'wide' : 'narrow'; ?>">
				<span class="bento-num">0<?php echo esc_html( $i + 1 ); ?></span>
				<h3><?php echo esc_html( get_the_title( $svc ) ); ?></h3>
				<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( (string) $svc->post_content ), 22 ) ); ?></p>
				<a href="<?php echo esc_url( get_permalink( $svc ) ); ?>" class="text-link" data-ga-track="cta_click" data-ga-content="service_<?php echo esc_attr( $svc->post_name ); ?>"><?php _e( 'Pelajari Layanan', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<?php else : ?>
		<div class="bento-grid js-stagger" style="margin-top:var(--s10);">
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
		<p class="eyebrow"><?php _e( 'Solutions', 'akdisi' ); ?></p>
		<h2 class="section-title"><?php _e( 'Solusi untuk Berbagai Kebutuhan Bisnis', 'akdisi' ); ?></h2>
		<p class="section-lead" style="margin-bottom:var(--s8);"><?php _e( 'Aplikasi yang dirancang sesuai konteks dan proses bisnis Anda — tidak terbatas pada satu sektor.', 'akdisi' ); ?></p>
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
				<div>
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

<!-- ============ WHY AKDISI (DARK) ============ -->
<section class="section section-dark" id="mengapa">
	<div class="grain" aria-hidden="true"></div>
	<div class="container">
		<p class="eyebrow"><?php _e( 'Why AKDISI', 'akdisi' ); ?></p>
		<h2 class="section-title"><?php _e( 'Mengapa AKDISI?', 'akdisi' ); ?></h2>
		<div class="value-grid js-stagger" style="margin-top:var(--s8);">
			<div class="value-item tall">
				<span class="value-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6l8-4z"/><path d="M8.5 12l2.5 2.5 4.5-5"/></svg></span>
				<h3><?php _e( 'Business-first Approach', 'akdisi' ); ?></h3>
				<p><?php _e( 'Solusi dimulai dari memahami bisnis, bukan dari teknologi.', 'akdisi' ); ?></p>
			</div>
			<div class="value-item"><h3><?php _e( 'Relevant Industry Context', 'akdisi' ); ?></h3><p><?php _e( 'Memahami konteks bisnis Anda di berbagai sektor — termasuk properti, perumahan, dan organisasi.', 'akdisi' ); ?></p></div>
			<div class="value-item"><h3><?php _e( 'Custom Solution', 'akdisi' ); ?></h3><p><?php _e( 'Aplikasi dirancang mengikuti proses bisnis Anda.', 'akdisi' ); ?></p></div>
			<div class="value-item"><h3><?php _e( 'Structured Process', 'akdisi' ); ?></h3><p><?php _e( 'Pengerjaan terstruktur dan terdokumentasi dengan jelas.', 'akdisi' ); ?></p></div>
			<div class="value-item"><h3><?php _e( 'Long-term Support', 'akdisi' ); ?></h3><p><?php _e( 'Dukungan berkelanjutan setelah sistem berjalan.', 'akdisi' ); ?></p></div>
		</div>
	</div>
</section>

<!-- ============ PORTFOLIO (LIGHT · horizontal scroll desktop) ============ -->
<section class="section section-light pf-section" id="portfolio">
	<?php
	$portfolios = new WP_Query( [ 'post_type' => 'akdisi_portfolio', 'posts_per_page' => 6, 'post_status' => 'publish' ] );
	if ( $portfolios->have_posts() ) :
	?>
	<div class="container">
		<div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:var(--s6);">
			<div>
				<p class="eyebrow"><?php _e( 'Selected Work', 'akdisi' ); ?></p>
				<h2 class="section-title"><?php _e( 'Portfolio', 'akdisi' ); ?></h2>
				<p class="section-lead"><?php _e( 'Contoh solusi yang telah kami rancang untuk berbagai kebutuhan. Geser untuk menjelajah.', 'akdisi' ); ?></p>
			</div>
			<a href="<?php echo esc_url( akdisi_tpl_link( 'portfolio', get_post_type_archive_link( 'akdisi_portfolio' ) ?: '' ) ); ?>" class="btn btn-primary magnetic" data-ga-track="cta_click" data-ga-content="portfolio_all"><?php _e( 'Lihat Semua Project', 'akdisi' ); ?></a>
		</div>
	</div>
	<div class="pf-viewport" data-horizontal>
		<div class="pf-track">
			<?php
			while ( $portfolios->have_posts() ) :
				$portfolios->the_post();
				$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
			?>
			<article class="pf-card">
				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php the_post_thumbnail_url( 'akdisi-portfolio' ); ?>" alt="<?php the_title_attribute(); ?>" class="pf-img" loading="lazy">
				<?php endif; ?>
				<div class="pf-card-body">
					<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
						<span class="card-category"><?php echo esc_html( implode( ', ', wp_list_pluck( $terms, 'name' ) ) ); ?></span>
					<?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
					<a href="<?php the_permalink(); ?>" class="pf-arrow" aria-label="<?php esc_attr_e( 'Lihat detail proyek', 'akdisi' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
	</div>
	<div class="container">
		<div class="pf-progress" aria-hidden="true"><div class="pf-progress-bar"></div></div>
	</div>
	<?php
		wp_reset_postdata();
	endif;
	?>
</section>

<!-- ============ PROCESS (DARK · pinned storytelling) ============ -->
<section class="section section-dark process-pin" id="proses" data-pin>
	<div class="grain" aria-hidden="true"></div>
	<div class="container">
		<p class="eyebrow"><?php _e( 'How We Work', 'akdisi' ); ?></p>
		<h2 class="section-title"><?php _e( 'Proses Kerja Kami', 'akdisi' ); ?></h2>
		<div class="proc-steps" style="margin-top:var(--s10);">
			<?php
			$process = [
				[ 'Consultation',    'Diskusi awal untuk memahami tujuan dan kebutuhan bisnis Anda.' ],
				[ 'Requirement',     'Kebutuhan dikumpulkan dan dipetakan menjadi spesifikasi yang jelas.' ],
				[ 'Planning',        'Rencana kerja, arsitektur, dan estimasi disusun sebelum pembangunan.' ],
				[ 'Development',     'Sistem dibangun bertahap dengan pengujian di setiap milestone.' ],
				[ 'Implementation',  'Deployment, migrasi data, dan pelatihan pengguna dilakukan bersama tim Anda.' ],
				[ 'Support',         'Dukungan berkelanjutan dan penyempurnaan setelah sistem berjalan.' ],
			];
			foreach ( $process as $i => $step ) :
			?>
			<div class="proc-step">
				<span class="proc-step-num">0<?php echo esc_html( $i + 1 ); ?></span>
				<div>
					<h3><?php esc_html_e( $step[0], 'akdisi' ); ?></h3>
					<p><?php esc_html_e( $step[1], 'akdisi' ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<p class="process-note"><?php _e( 'Setiap proyek mengikuti alur yang terstruktur dan terdokumentasi — dari konsultasi hingga dukungan jangka panjang.', 'akdisi' ); ?></p>
	</div>
</section>

<!-- ============ FAQ (LIGHT) ============ -->
<?php
$faq = new WP_Query( [ 'post_type' => 'akdisi_faq', 'posts_per_page' => 5, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC' ] );
if ( $faq->have_posts() ) :
?>
<section class="section section-light" id="faq">
	<div class="container">
		<div class="section-header" style="text-align:center;">
			<p class="eyebrow" style="justify-content:center;"><?php _e( 'FAQ', 'akdisi' ); ?></p>
			<h2 class="section-title"><?php _e( 'Pertanyaan Umum', 'akdisi' ); ?></h2>
		</div>
		<div class="faq-list" style="margin-top:var(--s8);">
			<?php while ( $faq->have_posts() ) : $faq->the_post(); ?>
			<div class="faq-item">
				<button class="faq-question" aria-expanded="false">
					<?php the_title(); ?>
				</button>
				<div class="faq-answer" style="padding-left:var(--s6);padding-right:var(--s6);"><?php the_content(); ?></div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php
	wp_reset_postdata();
endif;
?>

<!-- ============ CTA (DARK) ============ -->
<section class="cta-section">
	<div class="grain" aria-hidden="true"></div>
	<div class="container">
		<h2><?php echo wp_kses_post( __( 'Punya proses bisnis yang ingin dibuat lebih <span class="serif">terstruktur</span>?', 'akdisi' ) ); ?></h2>
		<p><?php _e( 'Konsultasikan kebutuhan Anda bersama kami.', 'akdisi' ); ?></p>
		<a href="<?php echo esc_url( akdisi_tpl_link( 'contact', home_url( '/contact/' ) ) ); ?>" class="btn btn-accent btn-large magnetic" data-ga-track="cta_click" data-ga-content="cta_final"><?php _e( 'Konsultasikan Sekarang', 'akdisi' ); ?>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
		</a>
	</div>
</section>

<?php get_footer();