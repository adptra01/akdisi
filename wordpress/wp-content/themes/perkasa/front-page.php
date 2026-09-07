<?php get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Beranda', 'perkasa' ),
	'title'   => __( 'Garuda Perkasa — Membangun Indonesia dengan Presisi dan Integritas', 'perkasa' ),
	'sub'     => __( 'Sejak 1999, kami membangun gedung, infrastruktur, dan solusi sipil yang melayani kebutuhan nyata — dari proyek pemerintah hingga komersial.', 'perkasa' ),
) );
?>

<!-- 4 Layanan -->
<section class="section-alt">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="section-header" data-reveal>
			<p class="eyebrow mb-4">Layanan Kami</p>
			<h2 class="font-display text-[clamp(1.8rem,3vw,2.4rem)] font-bold leading-tight tracking-tight text-ink">Solusi konstruksi untuk berbagai skala proyek</h2>
			<p class="mt-4 text-ink-soft leading-relaxed">Dari gedung komersial hingga infrastruktur jalan — kami menangani proyek Anda dari perencanaan hingga serah terima.</p>
		</div>
		<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
			<?php
			$services = array(
				array( 'icon' => '&#9881;', 'title' => 'Konstruksi Gedung', 'desc' => 'Gedung perkantoran, apartemen, dan komersial dari fondasi hingga interiornya.' ),
				array( 'icon' => '&#9651;', 'title' => 'Infrastruktur & Jalan', 'desc' => 'Jalan raya, jembatan, dan infrastruktur publik untuk konektivitas regional.' ),
				array( 'icon' => '&#9733;', 'title' => 'Renovasi', 'desc' => 'Rehabilitasi gedung dan infrastruktur lama agar kembali aman dan fungsional.' ),
				array( 'icon' => '&#9878;', 'title' => 'Konsultasi Teknis', 'desc' => 'Analisis struktur, estimasi biaya, dan pengawasan proyek oleh insinyur bersertifikat.' ),
			);
			foreach ( $services as $i => $s ) :
				?>
				<div data-reveal class="card group p-7" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-brand-soft text-xl text-brand">
						<?php echo $s['icon']; ?>
					</div>
					<h3 class="font-display text-lg font-bold text-ink group-hover:text-brand transition-colors"><?php echo esc_html( $s['title'] ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $s['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Stats strip -->
<section class="section-dark">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="grid grid-cols-2 gap-8 md:grid-cols-4" data-reveal>
			<div class="stat-card">
				<div class="stat-num">150+</div>
				<p class="stat-label">Proyek Selesai</p>
			</div>
			<div class="stat-card">
				<div class="stat-num">25</div>
				<p class="stat-label">Tahun Pengalaman</p>
			</div>
			<div class="stat-card">
				<div class="stat-num">50+</div>
				<p class="stat-label">Tim Teknis</p>
			</div>
			<div class="stat-card">
				<div class="stat-num">100%</div>
				<p class="stat-label">Komitmen Kualitas</p>
			</div>
		</div>
	</div>
</section>

<!-- Proyek unggulan -->
<section class="section">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="section-header center" data-reveal>
			<p class="eyebrow mb-4">Proyek Terbaru</p>
			<h2 class="font-display text-[clamp(1.8rem,3vw,2.4rem)] font-bold leading-tight tracking-tight text-ink">Portofolio kami dalam angka</h2>
		</div>
		<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
			<?php
			$projects = array(
				array( 'title' => 'Apartemen Mahakam', 'loc' => 'Jakarta Selatan', 'tag' => 'Gedung', 'desc' => '18 lantai, 240 unit hunian premium dengan fasilitas komersial.' ),
				array( 'title' => 'Jembatan Nusantara', 'loc' => 'Kalimantan Timur', 'tag' => 'Infrastruktur', 'desc' => 'Jembatan bentang panjang 420m untuk konektivitas dua kabupaten.' ),
				array( 'title' => 'Gedung Perkantoran Sentra', 'loc' => 'Surabaya', 'tag' => 'Gedung', 'desc' => '12 lantai Grade A office tower dengan sertifikasi green building.' ),
			);
			foreach ( $projects as $i => $p ) :
				?>
				<div data-reveal class="project-card card group overflow-hidden" style="transition-delay:<?php echo esc_attr( $i * 80 ); ?>ms">
					<div class="relative h-48 bg-gradient-to-br from-ink to-dark-alt flex items-center justify-center">
						<span class="font-display text-4xl font-bold text-white/10"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<span class="absolute bottom-3 left-3"><span class="badge badge-primary"><?php echo esc_html( $p['tag'] ); ?></span></span>
					</div>
					<div class="p-6">
						<h3 class="font-display text-lg font-bold text-ink group-hover:text-brand transition-colors"><?php echo esc_html( $p['title'] ); ?></h3>
						<p class="mt-1 text-xs text-ink-faint"><?php echo esc_html( $p['loc'] ); ?></p>
						<p class="mt-3 text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $p['desc'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- CTA band -->
<section class="section">
	<div class="container mx-auto px-5 lg:px-8">
		<div data-reveal class="perkasa-cta relative px-8 py-14 md:px-14 md:py-20">
			<div class="relative max-w-xl">
				<p class="eyebrow mb-4" style="color:#93b8e8">
					<span class="mr-3 inline-block h-px w-8 bg-brand" aria-hidden="true"></span>
					<?php echo esc_html( __( 'Mari Berdiskusi', 'perkasa' ) ); ?>
				</p>
				<h2 class="font-display text-[clamp(1.8rem,4vw,2.8rem)] font-bold leading-[1.1] tracking-tight text-white">
					<?php echo esc_html( __( 'Punya proyek konstruksi yang butuh mitra terpercaya?', 'perkasa' ) ); ?>
				</h2>
				<p class="mt-4 max-w-md text-lg leading-relaxed text-stone-400">
					<?php echo esc_html( __( 'Sesi konsultasi 30 menit — cukup untuk menilai apakah kami cocok menjadi mitra Anda.', 'perkasa' ) ); ?>
				</p>
				<div class="mt-8 flex flex-wrap gap-4">
					<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-primary btn-lg">Hubungi Sekarang</a>
					<a href="<?php echo esc_url( home_url( '/proyek/' ) ); ?>" class="btn btn-on-dark btn-lg">Lihat Proyek Kami</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
