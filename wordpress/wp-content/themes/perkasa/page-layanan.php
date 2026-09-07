<?php
/**
 * Template Name: Layanan
 * Page: /layanan/
 *
 * @package Perkasa
 */
get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Layanan', 'perkasa' ),
	'title'   => __( 'Solusi konstruksi menyeluruh untuk setiap tahap proyek', 'perkasa' ),
	'sub'     => __( 'Dari studi kelayakan hingga serah terima — tim kami menangani seluruh aspek teknis dan manajerial proyek Anda.', 'perkasa' ),
) );
?>

<section class="section">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="space-y-12">
			<?php
			$layanan = array(
				array(
					'title' => 'Konstruksi Gedung',
					'sub'   => 'Gedung komersial, hunian, dan institusional',
					'desc'  => 'Kami menangani proyek gedung dari struktur hingga MEP (mekanikal, elektrikal, plumbing). Pengalaman kami mencakup gedung perkantoran 12+ lantai, apartemen, hingga pabrik dengan spesifikasi khusus.',
					'features' => array( 'Fondasi & struktur', 'MEP & interior', 'Green building option', 'Pengawasan harian' ),
				),
				array(
					'title' => 'Infrastruktur & Jalan',
					'sub'   => 'Jalan raya, jembatan, dan fasilitas publik',
					'desc'  => 'Proyek infrastruktur pemerintah dan swasta — mulai dari jalan arteri, jembatan beton/baja, hingga fasilitas utilitas. Kami bekerja dengan standar Bina Marga dan Kemen PUPR.',
					'features' => array( 'Jalan & jembatan', 'Drainase & irigasi', 'Fasilitas publik', 'Survey & topografi' ),
				),
				array(
					'title' => 'Renovasi & Rehabilitasi',
					'sub'   => 'Mengembalikan fungsi dan nilai bangunan',
					'desc'  => 'Bangunan tua atau rusak perlu pendekatan berbeda — kami melakukan assessment struktur terlebih dahulu, lalu merancang solusi renovasi yang hemat biaya namun tetap aman.',
					'features' => array( 'Assessment struktur', 'Rencana renovasi', 'Penghematan biaya', 'Progres dokumentasi' ),
				),
				array(
					'title' => 'Konsultasi Teknis',
					'sub'   => 'Analisis, estimasi, dan pengawasan',
					'desc'  => 'Tim insinyur bersertifikat kami siap membantu analisis kelayakan, estimasi RAB, hingga pengawasan berkala untuk memastikan proyek Anda berjalan sesuai rencana.',
					'features' => array( 'Studi kelayakan', 'Estimasi RAB', 'Pengawasan berkala', 'Laporan progres' ),
				),
			);
			foreach ( $layanan as $i => $l ) :
				?>
				<div data-reveal class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr] <?php echo ( $i % 2 ) ? 'direction-rtl' : ''; ?>">
					<div class="<?php echo ( $i % 2 ) ? 'lg:order-2' : ''; ?>">
						<p class="eyebrow mb-3"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></p>
						<h2 class="font-display text-2xl font-bold text-ink"><?php echo esc_html( $l['title'] ); ?></h2>
						<p class="mt-1 text-sm text-brand font-medium"><?php echo esc_html( $l['sub'] ); ?></p>
						<p class="mt-4 leading-relaxed text-ink-soft"><?php echo esc_html( $l['desc'] ); ?></p>
						<div class="mt-6 grid grid-cols-2 gap-3">
							<?php foreach ( $l['features'] as $f ) : ?>
								<div class="flex items-center gap-2 text-sm text-ink-soft">
									<span class="text-brand text-lg" aria-hidden="true">&#10003;</span>
									<?php echo esc_html( $f ); ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="<?php echo ( $i % 2 ) ? 'lg:order-1' : ''; ?>">
						<div class="flex h-full min-h-[280px] items-center justify-center rounded-xl bg-gradient-to-br from-ink to-dark-alt">
							<span class="font-display text-6xl font-bold text-white/10"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="section">
	<div class="container mx-auto px-5 lg:px-8">
		<div data-reveal class="perkasa-cta relative px-8 py-14 md:px-14 md:py-20">
			<div class="relative max-w-xl">
				<p class="eyebrow mb-4" style="color:#93b8e8">
					<span class="mr-3 inline-block h-px w-8 bg-brand" aria-hidden="true"></span>
					<?php echo esc_html( __( 'Siap Memulai?', 'perkasa' ) ); ?>
				</p>
				<h2 class="font-display text-[clamp(1.8rem,4vw,2.8rem)] font-bold leading-[1.1] tracking-tight text-white">
					<?php echo esc_html( __( 'Cari tahu bagaimana kami bisa membantu proyek Anda.', 'perkasa' ) ); ?>
				</h2>
				<p class="mt-4 max-w-md text-lg leading-relaxed text-stone-400">
					<?php echo esc_html( __( 'Konsultasi gratis 30 menit — tanpa komitmen.', 'perkasa' ) ); ?>
				</p>
				<div class="mt-8 flex flex-wrap gap-4">
					<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-primary btn-lg">Hubungi Kami</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
