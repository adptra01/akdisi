<?php
/**
 * Template Name: Tentang
 * Page: /tentang/
 *
 * @package Perkasa
 */
get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Tentang Kami', 'perkasa' ),
	'title'   => __( '25 tahun membangun Indonesia, dari tanah hingga menara', 'perkasa' ),
	'sub'     => __( 'Garuda Perkasa didirikan pada tahun 1999 di Jakarta. Dari proyek renovasi rumah tinggal, kini kami menjadi mitra konstruksi untuk pemerintah dan korporasi.', 'perkasa' ),
) );
?>

<!-- Cerita -->
<section class="section">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="grid items-start gap-12 lg:grid-cols-[1fr_1fr]">
			<div data-reveal>
				<p class="eyebrow mb-4">Cerita Kami</p>
				<h2 class="font-display text-2xl font-bold text-ink">Dimulai dari satu truk dan tiga orang insinyur</h2>
				<div class="mt-6 space-y-4 text-ink-soft leading-relaxed">
					<p>Garuda Perkasa didirikan oleh tiga insinyur sipil muda yang melihat kebutuhan akan mitra konstruksi yang tidak hanya jago teknis, tapi juga bisa dipercaya menyelesaikan proyek tepat waktu.</p>
					<p>Dari proyek renovasi rumah tinggal dan ruko kecil di Jakarta Selatan, kami perlahan membangun reputasi. Tahun 2008, kami menangani proyek pertama jembatan untuk Kabupaten Kutai Timur — sebuah proyek yang mengubah skala operasional kami selamanya.</p>
					<p>Hari ini, tim kami terdiri dari lebih dari 50 insinyur, arsitek, dan tenaga teknis bersertifikat. Kami telah menyelesaikan 150+ proyek di 12 provinsi, dengan fokus pada kualitas, keamanan, dan transparansi biaya.</p>
				</div>
			</div>
			<div data-reveal style="transition-delay:100ms">
				<div class="flex min-h-[360px] items-center justify-center rounded-xl bg-gradient-to-br from-ink to-dark-alt">
					<span class="font-display text-7xl font-bold text-white/10">25</span>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Values -->
<section class="section-alt">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="section-header center" data-reveal>
			<p class="eyebrow mb-4">Nilai Kami</p>
			<h2 class="font-display text-[clamp(1.8rem,3vw,2.4rem)] font-bold leading-tight tracking-tight text-ink">Yang kami pegang dalam setiap proyek</h2>
		</div>
		<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
			<?php
			$values = array(
				array( 'title' => 'Presisi', 'desc' => 'Setiap detail dihitung, setiap toleransi dipertimbangkan. Tidak ada yang "kira-kira" dalam pekerjaan kami.' ),
				array( 'title' => 'Integritas', 'desc' => 'Biaya transparan, jadwal realistis. Kami tidak menjual janji yang tidak bisa kami tepati.' ),
				array( 'title' => 'Keamanan', 'desc' => 'Standar K3 diutamakan. Setiap proyek memiliki prosedur keselamatan yang ketat dan dipantau harian.' ),
				array( 'title' => 'Tepat Waktu', 'desc' => 'Manajemen proyek yang ketat memastikan setiap milestone tercapai sesuai jadwal yang disepakati.' ),
			);
			foreach ( $values as $i => $v ) :
				?>
				<div data-reveal class="card p-7" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<div class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-brand-soft">
						<span class="text-lg font-bold text-brand"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					</div>
					<h3 class="font-display text-lg font-bold text-ink"><?php echo esc_html( $v['title'] ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $v['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Stats -->
<section class="section-dark">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="grid grid-cols-2 gap-8 md:grid-cols-4" data-reveal>
			<div class="stat-card"><div class="stat-num">150+</div><p class="stat-label">Proyek Selesai</p></div>
			<div class="stat-card"><div class="stat-num">12</div><p class="stat-label">Provinsi Terjangkau</p></div>
			<div class="stat-card"><div class="stat-num">50+</div><p class="stat-label">Tim Teknis</p></div>
			<div class="stat-card"><div class="stat-num">25</div><p class="stat-label">Tahun Pengalaman</p></div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
