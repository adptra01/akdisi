<?php
/**
 * Template Name: Tentang
 * Template Post Type: page
 *
 * Halaman tentang perusahaan — Garuda Perkasa v3.
 *
 * @package Garuda_Perkasa
 */

get_header();

$perkasa_stats = array(
	array( 'num' => 150, 'suffix' => '+', 'label' => 'Proyek selesai' ),
	array( 'num' => 12, 'suffix' => '', 'label' => 'Provinsi terjangkau' ),
	array( 'num' => 28, 'suffix' => '', 'label' => 'Tahun pengalaman' ),
	array( 'num' => 480, 'suffix' => '+', 'label' => 'Tenaga ahli & pekerja' ),
);

$perkasa_values = array(
	array( 't' => 'Kejujuran Estimasi', 'd' => 'Kami menyampaikan biaya dan risiko sejak awal — termasuk hal yang tidak menyenangkan didengar.' ),
	array( 't' => 'Kerja Terukur', 'd' => 'Setiap tahap punya standard operasi, checklist, dan dokumentasi yang bisa Anda audit.' ),
	array( 't' => 'Keselamatan Mutlak', 'd' => 'Tidak ada target yang lebih penting dari pulangnya pekerja dengan selamat.' ),
	array( 't' => 'Komitmen Jangka Panjang', 'd' => 'Banyak klien kami kembali untuk proyek kedua dan ketiga — itu tolok ukur sebenarnya.' ),
);

$perkasa_timeline = array(
	array( 'yr' => '1999', 't' => 'Berdiri di Jakarta', 'd' => 'Garuda Perkasa lahir sebagai kontraktor rumah tinggal & ruko di Jabodetabek.' ),
	array( 'yr' => '2005', 't' => 'Penetrasi Sumatra', 'd' => 'Proyek infrastruktur pertama di Riau membuka jaringan kerja hingga 12 provinsi.' ),
	array( 'yr' => '2012', 't' => 'Sertifikasi K3 & ISO', 'd' => 'ISO 9001 dan SMK3 diterapkan menyeluruh di seluruh site.' ),
	array( 'yr' => '2017', 't' => '100+ proyek', 'd' => 'Tonggak 100 proyek tercapai; fokus bergeser ke gedung bertingkat.' ),
	array( 'yr' => '2021', 't' => 'Kawasan industri', 'd' => 'Divisi industrial berdiri: pabrik, gudang, dan utilitas kawasan.' ),
	array( 'yr' => '2024', 't' => '150+ proyek & 12 provinsi', 'd' => 'Ekspansi jembatan bentang panjang dan rehabilitasi gedung cagar.' ),
);

$perkasa_certs = array( 'ISO 9001:2015', 'ISO 45001', 'SMK3 PP 50/2012', 'Kualifikasi B2', 'SBU Jasa Pelaksana', 'Anggota Gapeksindo' );
?>

<main id="perkasa-main">

	<section class="bp-grid relative overflow-hidden bg-[#060a12] text-white" aria-labelledby="page-title">
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div data-parallax="8" class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-amber-500/15 blur-[110px]"></div>
		</div>
		<div class="relative mx-auto max-w-7xl px-5 pb-16 pt-28 lg:pb-20 lg:pt-40">
			<p class="eyebrow spec-label mb-5 text-amber-500" data-reveal>Tentang</p>
			<h1 id="page-title" class="font-display text-4xl font-black uppercase leading-[0.95] tracking-tight sm:text-6xl lg:text-7xl" data-reveal>
				Dibangun Oleh<br><span class="text-amber-500">Hari-Hari Kerja</span>, Bukan Janji
			</h1>
			<p class="mt-6 max-w-xl text-sm leading-relaxed text-slate-300 sm:text-base" data-reveal>
				Sejak 1999, nama kami tumbuh dari proyek demi proyek — bukan dari
				iklan. Dari ruko kecil di Jakarta hingga jembatan 380 meter di Jambi.
			</p>
		</div>
	</section>

	<!-- Cerita + stats -->
	<section class="bg-paper py-20 lg:py-28" aria-label="Cerita perusahaan">
		<div class="mx-auto max-w-7xl px-5">
			<div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr]">
				<div data-reveal>
					<p class="eyebrow spec-label mb-4 text-amber-600">Cerita</p>
					<h2 class="font-display text-3xl font-black uppercase tracking-tight text-[#060a12] sm:text-4xl">
						Dari Regu Kecil,<br>Menjadi 480 Tenaga
					</h2>
					<div class="mt-6 space-y-4 text-sm leading-relaxed text-slate-500">
						<p>
							Garuda Perkasa dimulai tahun 1999 oleh tiga insinyur sipil
							dengan satu pick-up dan satu komitmen: menyelesaikan apa yang
							disepakati. Dua puluh delapan tahun kemudian, kami mengelola
							proyek senilai miliaran rupiah — dengan komitmen yang sama
							persis.
						</p>
						<p>
							Kami percaya reputasi dibangun di lapangan, bukan di ruang
							rapat. Itu sebabnya setiap proyek memiliki jadwal yang realistis,
							biaya yang transparan, dan laporan yang bisa Anda periksa kapan pun.
						</p>
						<p>
							Hari ini, tim kami terdiri dari 480+ tenaga bersertifikat,
							didukung peralatan berat milik sendiri dan jaringan subkontraktor
							yang telah bekerja sama bertahun-tahun.
						</p>
					</div>
				</div>

				<div class="grid grid-cols-2 gap-px self-start overflow-hidden rounded-xl border border-slate-200 bg-slate-200" data-reveal>
					<?php foreach ( $perkasa_stats as $s ) : ?>
						<div class="bg-white p-6">
							<p class="font-display text-3xl font-black text-amber-600">
								<span data-count="<?php echo esc_attr( $s['num'] ); ?>"><?php echo esc_html( $s['num'] ); ?></span><?php echo esc_html( $s['suffix'] ); ?>
							</p>
							<p class="spec-label mt-2 text-slate-400"><?php echo esc_html( $s['label'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Nilai -->
	<section class="bg-white py-20 lg:py-24" aria-labelledby="value-heading">
		<div class="mx-auto max-w-7xl px-5">
			<p class="eyebrow spec-label mb-4 text-amber-600" data-reveal>Nilai</p>
			<h2 id="value-heading" class="font-display text-3xl font-black uppercase tracking-tight text-[#060a12] sm:text-4xl" data-reveal>
				Empat Yang Tidak Bisa Ditawar
			</h2>
			<div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
				<?php foreach ( $perkasa_values as $v ) : ?>
					<div class="gp-card p-7" data-reveal>
						<span class="block h-1.5 w-12 bg-amber-500" aria-hidden="true"></span>
						<h3 class="mt-5 font-display text-lg font-bold text-[#060a12]"><?php echo esc_html( $v['t'] ); ?></h3>
						<p class="mt-2 text-sm leading-relaxed text-slate-500"><?php echo esc_html( $v['d'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Timeline -->
	<section class="bp-grid relative bg-[#0d1520] py-20 text-white lg:py-28" aria-labelledby="timeline-heading">
		<div class="mx-auto max-w-7xl px-5">
			<p class="eyebrow spec-label mb-4 text-amber-500" data-reveal>Perjalanan</p>
			<h2 id="timeline-heading" class="font-display text-3xl font-black uppercase tracking-tight sm:text-4xl lg:text-5xl" data-reveal>
				28 Tahun Di Lapangan
			</h2>

			<ol class="mt-14 grid gap-px overflow-hidden rounded-xl border border-slate-800 bg-slate-800 sm:grid-cols-2 lg:grid-cols-3">
				<?php foreach ( $perkasa_timeline as $tl ) : ?>
					<li class="bg-[#060a12] p-7" data-reveal>
						<p class="font-display text-4xl font-black text-amber-500"><?php echo esc_html( $tl['yr'] ); ?></p>
						<h3 class="mt-3 font-display text-lg font-bold text-white"><?php echo esc_html( $tl['t'] ); ?></h3>
						<p class="mt-2 text-sm leading-relaxed text-slate-400"><?php echo esc_html( $tl['d'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<!-- Sertifikasi -->
	<section class="bg-paper py-20" aria-labelledby="cert-heading">
		<div class="mx-auto max-w-7xl px-5 text-center">
			<p class="spec-label mb-3 text-amber-600" data-reveal>Sertifikasi & keanggotaan</p>
			<h2 id="cert-heading" class="font-display text-2xl font-black uppercase tracking-tight text-[#060a12] sm:text-3xl" data-reveal>
				Diakui, Tersertifikasi, Terkualifikasi
			</h2>
			<div class="mt-8 flex flex-wrap justify-center gap-3" data-reveal>
				<?php foreach ( $perkasa_certs as $c ) : ?>
					<span class="chip !border-slate-300 !py-2 !px-4 !text-sm"><?php echo esc_html( $c ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="relative overflow-hidden bg-amber-500 py-14" aria-label="Ajakan kerjasama">
		<div class="bp-grid absolute inset-0 opacity-40" aria-hidden="true"></div>
		<div class="relative mx-auto flex max-w-7xl flex-col items-start justify-between gap-6 px-5 lg:flex-row lg:items-center">
			<h2 class="font-display text-2xl font-black uppercase tracking-tight text-[#060a12] sm:text-3xl" data-reveal>
				Mari kenalan dulu — sesi kopi kami gratis.
			</h2>
			<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-ink" data-reveal data-ga-track="about_cta">Hubungi Kami</a>
		</div>
	</section>

</main>

<?php
get_footer();