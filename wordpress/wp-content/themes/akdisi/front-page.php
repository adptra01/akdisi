<?php
/**
 * Front Page Template
 * PRD BAGIAN E §18–28 — Hero, Problem, Approach, Solution, Service, Portfolio, Why, Process, FAQ, CTA.
 * Nav links: use helper that prefers place (page_by_path) then archive URL.
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
?>

<section class="hero">
	<div class="container">
		<h1><?php echo esc_html( $hero_title ); ?></h1>
		<p><?php echo esc_html( $hero_subtitle ); ?></p>
		<div>
			<a href="<?php echo esc_url( akdisi_tpl_link( 'contact', home_url( '/contact/' ) ) ); ?>" class="btn btn-large btn-accent" data-ga-track="cta_click" data-ga-content="hero_primary"><?php _e( 'Konsultasikan Kebutuhan Anda', 'akdisi' ); ?></a>
			<a href="<?php echo esc_url( akdisi_tpl_link( 'portfolio', get_post_type_archive_link( 'akdisi_portfolio' ) ?: '' ) ); ?>" class="btn btn-large btn-secondary" data-ga-track="cta_click" data-ga-content="hero_secondary"><?php _e( 'Lihat Portfolio', 'akdisi' ); ?></a>
		</div>

		<!-- Hero mockup (PRD §79) -->
		<div class="hero-mockup" role="img" aria-label="<?php esc_attr_e( 'Contoh tampilan aplikasi dashboard', 'akdisi' ); ?>">
			<div class="mockup-bar"><span></span><span></span><span></span></div>
			<div class="mockup-body">
				<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
					<div>
						<div class="mockup-stat" style="font-size:1.75rem;">Rp0</div>
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
</section>

<!-- Problem -->
<section class="section">
	<div class="container">
		<div class="section-header">
			<h2><?php _e( 'Ketika Proses Bisnis Bertumbuh, Sistem Harus Ikut Berkembang', 'akdisi' ); ?></h2>
			<p><?php _e( 'Banyak organisasi terjebak pada proses lama yang lambat dan tidak akurat.', 'akdisi' ); ?></p>
		</div>
		<div class="card-grid">
			<div class="card"><div class="card-body"><h3><?php _e( 'Data Tersebar', 'akdisi' ); ?></h3><p><?php _e( 'Informasi tersimpan di banyak tempat dan sulit dianalisis.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Proses Manual', 'akdisi' ); ?></h3><p><?php _e( 'Pekerjaan berulang memakan waktu dan rentan kesalahan.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Monitoring Sulit', 'akdisi' ); ?></h3><p><?php _e( 'Perkembangan operasional tidak terpantau secara real-time.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Laporan Lambat', 'akdisi' ); ?></h3><p><?php _e( 'Laporan disusun manual sehingga sering terlambat.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Sistem yang Ada Tidak Sesuai', 'akdisi' ); ?></h3><p><?php _e( 'Software generik tidak mengikuti cara kerja organisasi Anda.', 'akdisi' ); ?></p></div></div>
		</div>
	</div>
</section>

<!-- Approach -->
<section class="section section-alt">
	<div class="container">
		<div class="section-header">
			<h2><?php _e( 'Kami Mulai dari Memahami Proses Bisnis Anda', 'akdisi' ); ?></h2>
			<p><?php _e( 'Setiap solusi dimulai dari pemahaman, bukan dari asumsi.', 'akdisi' ); ?></p>
		</div>
		<div class="process-steps">
			<div class="process-step"><div class="process-step-number">1</div><h3><?php _e( 'Understand', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">2</div><h3><?php _e( 'Analyze', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">3</div><h3><?php _e( 'Design', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">4</div><h3><?php _e( 'Build', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">5</div><h3><?php _e( 'Implement', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">6</div><h3><?php _e( 'Improve', 'akdisi' ); ?></h3></div>
		</div>
	</div>
</section>

<!-- Solutions -->
<section class="section">
	<div class="container">
		<div class="section-header">
			<h2><?php _e( 'Solusi untuk Berbagai Kebutuhan Bisnis', 'akdisi' ); ?></h2>
			<p><?php _e( 'Aplikasi yang dirancang sesuai konteks dan proses bisnis Anda — tidak terbatas pada satu sektor.', 'akdisi' ); ?></p>
		</div>
		<div class="card-grid">
			<?php
			$solutions = [
				'housing'      => [ __( 'Perumahan', 'akdisi' ), __( 'Pengelolaan kawasan dan layanan penghuni.', 'akdisi' ) ],
				'developer'    => [ __( 'Developer', 'akdisi' ), __( 'Proses bisnis developer dan penjualan unit.', 'akdisi' ) ],
				'property'     => [ __( 'Properti', 'akdisi' ), __( 'Pengelolaan bisnis dan aset properti.', 'akdisi' ) ],
				'organization' => [ __( 'Organisasi', 'akdisi' ), __( 'Administrasi dan pengelolaan organisasi.', 'akdisi' ) ],
			];
			foreach ( $solutions as $slug => $data ) :
			?>
			<div class="card">
				<div class="card-body">
					<h3><?php echo esc_html( $data[0] ); ?></h3>
					<p><?php echo esc_html( $data[1] ); ?></p>
					<a href="<?php echo esc_url( akdisi_tpl_link( 'solutions/' . $slug, home_url( '/solutions/' . $slug . '/' ) ) ); ?>" class="btn btn-secondary" style="margin-top:1rem;"><?php _e( 'Lihat Solusi', 'akdisi' ); ?></a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Services -->
<section class="section section-alt" id="services">
	<div class="container">
		<div class="section-header">
			<h2><?php _e( 'Layanan Kami', 'akdisi' ); ?></h2>
			<p><?php _e( 'Apa yang bisa Anda pesan dari AKDISI.', 'akdisi' ); ?></p>
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
		<div class="card-grid">
			<?php foreach ( $svc_pages as $svc ) : ?>
			<div class="card">
				<div class="card-body">
					<h3><?php echo esc_html( get_the_title( $svc ) ); ?></h3>
					<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( (string) $svc->post_content ), 20 ) ); ?></p>
					<a href="<?php echo esc_url( get_permalink( $svc ) ); ?>" class="btn btn-secondary" style="margin-top:1rem;"><?php _e( 'Pelajari Layanan', 'akdisi' ); ?></a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php else : ?>
		<div class="card-grid">
			<div class="card"><div class="card-body"><h3><?php _e( 'Application Development', 'akdisi' ); ?></h3><p><?php _e( 'Aplikasi custom sesuai kebutuhan dan proses bisnis Anda.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Business Process Digitalization', 'akdisi' ); ?></h3><p><?php _e( 'Mengubah proses manual menjadi workflow digital.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Data & Administration Systems', 'akdisi' ); ?></h3><p><?php _e( 'Sistem pengelolaan data dan administrasi yang tertata.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Custom Business Solutions', 'akdisi' ); ?></h3><p><?php _e( 'Solusi untuk kebutuhan khusus organisasi Anda.', 'akdisi' ); ?></p></div></div>
		</div>
		<?php endif; ?>
	</div>
</section>

<!-- Portfolio -->
<section class="section" id="portfolio">
	<div class="container">
		<div class="section-header">
			<h2><?php _e( 'Portfolio', 'akdisi' ); ?></h2>
			<p><?php _e( 'Contoh solusi yang telah kami rancang untuk berbagai kebutuhan.', 'akdisi' ); ?></p>
		</div>
		<?php
		$portfolios = new WP_Query( [ 'post_type' => 'akdisi_portfolio', 'posts_per_page' => 4, 'post_status' => 'publish' ] );
		if ( $portfolios->have_posts() ) :
		?>
		<div class="card-grid">
			<?php
			while ( $portfolios->have_posts() ) :
				$portfolios->the_post();
				$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
			?>
			<div class="card">
				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php the_post_thumbnail_url( 'akdisi-portfolio' ); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" loading="lazy">
				<?php endif; ?>
				<div class="card-body">
					<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
						<span class="card-category"><?php echo esc_html( implode( ', ', wp_list_pluck( $terms, 'name' ) ) ); ?></span>
					<?php endif; ?>
					<h3><?php the_title(); ?></h3>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>
					<a href="<?php the_permalink(); ?>" class="btn btn-secondary" style="margin-top:1rem;"><?php _e( 'Lihat Detail', 'akdisi' ); ?></a>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<?php
			wp_reset_postdata();
		endif;
		?>
		<div style="text-align:center;margin-top:2rem;">
			<a href="<?php echo esc_url( akdisi_tpl_link( 'portfolio', get_post_type_archive_link( 'akdisi_portfolio' ) ?: '' ) ); ?>" class="btn btn-primary"><?php _e( 'Lihat Semua Project', 'akdisi' ); ?></a>
		</div>
	</div>
</section>

<!-- Why AKDISI -->
<section class="section section-alt">
	<div class="container">
		<div class="section-header">
			<h2><?php _e( 'Mengapa AKDISI?', 'akdisi' ); ?></h2>
		</div>
		<div class="card-grid">
			<div class="card"><div class="card-body"><h3><?php _e( 'Business-first Approach', 'akdisi' ); ?></h3><p><?php _e( 'Solusi dimulai dari memahami bisnis, bukan dari teknologi.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Relevant Industry Context', 'akdisi' ); ?></h3><p><?php _e( 'Memahami konteks bisnis Anda di berbagai sektor — termasuk properti, perumahan, dan organisasi.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Custom Solution', 'akdisi' ); ?></h3><p><?php _e( 'Aplikasi dirancang mengikuti proses bisnis Anda.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Structured Process', 'akdisi' ); ?></h3><p><?php _e( 'Pengerjaan terstruktur dan terdokumentasi dengan jelas.', 'akdisi' ); ?></p></div></div>
			<div class="card"><div class="card-body"><h3><?php _e( 'Long-term Support', 'akdisi' ); ?></h3><p><?php _e( 'Dukungan berkelanjutan setelah sistem berjalan.', 'akdisi' ); ?></p></div></div>
		</div>
	</div>
</section>

<!-- Process -->
<section class="section">
	<div class="container">
		<div class="section-header">
			<h2><?php _e( 'Proses Kerja Kami', 'akdisi' ); ?></h2>
		</div>
		<div class="process-steps">
			<div class="process-step"><div class="process-step-number">1</div><h3><?php _e( 'Consultation', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">2</div><h3><?php _e( 'Requirement', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">3</div><h3><?php _e( 'Planning', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">4</div><h3><?php _e( 'Development', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">5</div><h3><?php _e( 'Implementation', 'akdisi' ); ?></h3></div>
			<div class="process-step"><div class="process-step-number">6</div><h3><?php _e( 'Support', 'akdisi' ); ?></h3></div>
		</div>
	</div>
</section>

<!-- FAQ -->
<?php
$faq = new WP_Query( [ 'post_type' => 'akdisi_faq', 'posts_per_page' => 5, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC' ] );
if ( $faq->have_posts() ) :
?>
<section class="section section-alt" id="faq">
	<div class="container">
		<div class="section-header">
			<h2><?php _e( 'Pertanyaan Umum', 'akdisi' ); ?></h2>
		</div>
		<div class="faq-list">
			<?php while ( $faq->have_posts() ) : $faq->the_post(); ?>
			<div class="faq-item">
				<button class="faq-question" aria-expanded="false">
					<?php the_title(); ?>
					<span class="faq-icon" aria-hidden="true">+</span>
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

<!-- CTA -->
<section class="cta-section">
	<div class="container">
		<h2><?php _e( 'Punya proses bisnis yang ingin dibuat lebih terstruktur?', 'akdisi' ); ?></h2>
		<p><?php _e( 'Konsultasikan kebutuhan Anda bersama kami.', 'akdisi' ); ?></p>
		<a href="<?php echo esc_url( akdisi_tpl_link( 'contact', home_url( '/contact/' ) ) ); ?>" class="btn btn-large"><?php _e( 'Konsultasikan Sekarang', 'akdisi' ); ?></a>
	</div>
</section>

<?php get_footer();