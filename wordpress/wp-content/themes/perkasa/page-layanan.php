<?php
/**
 * Template Name: Layanan
 * Template Post Type: page
 *
 * Halaman layanan — Garuda Perkasa v3.
 *
 * @package Garuda_Perkasa
 */

get_header();

$perkasa_services = array(
	array(
		'n'    => '01',
		'id'   => 'gedung',
		'g'    => 'Konstruksi Gedung',
		'd'    => 'Perkantoran, rumah sakit, pabrik, hunian vertikal. Kami menangani struktur, arsitektur, MEP, hingga finishing — dengan kontrol mutu di setiap lantai.',
		'feat' => array(
			'Gedung bertingkat hingga 30 lantai',
			'Struktur beton & baja komposit',
			'MEP (mekanikal-elektrikal-plumbing) terintegrasi',
			'Manajemen K3 site kepadatan tinggi',
		),
		'out'  => 'Luas tipikal hingga 3.200 m²/lantai',
	),
	array(
		'n'    => '02',
		'id'   => 'infrastruktur',
		'g'    => 'Infrastruktur & Jalan',
		'd'    => 'Jalan tol, jembatan, drainase, irigasi, dan pekerjaan tanah skala besar. Mobilitas alat berat dan pengaturan lalu lintas menjadi perhatian utama.',
		'feat' => array(
			'Jalan & jembatan (bentang hingga 380 m)',
			'Pekerjaan tanah & galian besar',
			'Drainase, irigasi, bangunan air',
			'Manajemen lalu lintas proyek',
		),
		'out'  => 'Ruas hingga 42 km dalam satu paket',
	),
	array(
		'n'    => '03',
		'id'   => 'renovasi',
		'g'    => 'Renovasi & Rehabilitasi',
		'd'    => 'Perkuatan struktur, retrofit seismik, dan rehabilitasi bangunan tua — termasuk gedung yang tetap beroperasi selama pengerjaan.',
		'feat' => array(
			'Perkuatan struktur (jacketing, CFRP)',
			'Retrofit tahan gempa',
			'Rehabilitasi fasad & interior',
			'Konstruksi tanpa menghentikan operasional',
		),
		'out'  => 'Bangunan cagar & komersial tetap jalan',
	),
	array(
		'n'    => '04',
		'id'   => 'konsultasi',
		'g'    => 'Konsultasi & Manajemen',
		'd'    => 'Perencanaan, pengawasan, dan manajemen konstruksi. Kami mendampingi dari studi kelayakan, perizinan, hingga serah terima.',
		'feat' => array(
			'Studi kelayakan & estimasi biaya',
			'Pengurusan perizinan (IMB/PBG, SLF)',
			'Pengawasan & quality assurance',
			'Manajemen konstruksi (MK)',
		),
		'out'  => 'Konsultasi 30 menit pertama gratis',
	),
);

$perkasa_caps = array(
	array( 'Kemampuan', 'Spesifikasi', 'Standar & Sertifikasi' ),
	array( 'Gedung bertingkat', 'Beton bertulang, baja komposit, curtain wall, hingga 30 lantai', 'SNI 1726 (gempa), SNI 2847 (beton)' ),
	array( 'Struktur baja', 'Rangka baja berat, fabrikasi & ereksi, las tersertifikasi', 'AWS D1.1, sertifikat welder BNSP' ),
	array( 'Jalan & jembatan', 'Perkerasan lentur/kaku, jembatan bentang panjang, cable-stayed', 'Spesifikasi PUPR, AASHTO' ),
	array( 'Pekerjaan tanah', 'Galian massal, timbunan pilihan, stabilisasi, sheet pile', 'ASTM D698 (proctor)' ),
	array( 'Manajemen K3', 'SMK3, APD lengkap, HIRADC per aktivitas, zero accident target', 'PP 50/2012, ISO 45001' ),
	array( 'Manajemen mutu', 'QC checklist per tahap, uji material, uji beban (load test)', 'ISO 9001, SNI series' ),
);
?>

<main id="perkasa-main">

	<section class="bp-grid relative overflow-hidden bg-[#060a12] text-white" aria-labelledby="page-title">
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div data-parallax="8" class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-amber-500/15 blur-[110px]"></div>
		</div>
		<div class="relative mx-auto max-w-7xl px-5 pb-16 pt-28 lg:pb-20 lg:pt-40">
			<p class="eyebrow spec-label mb-5 text-amber-500" data-reveal>Layanan</p>
			<h1 id="page-title" class="font-display text-4xl font-black uppercase leading-[0.95] tracking-tight sm:text-6xl lg:text-7xl" data-reveal>
				Dikerjakan Secara<br><span class="text-amber-500">Teknis</span>, Bukan Asal Jadi
			</h1>
			<p class="mt-6 max-w-xl text-sm leading-relaxed text-slate-300 sm:text-base" data-reveal>
				Empat bidang layanan — satu standar: gambar kerja lengkap, jadwal nyata,
				dan kontrol mutu di setiap tahap.
			</p>
		</div>
	</section>

	<section class="bg-paper py-20 lg:py-28" aria-label="Rincian layanan">
		<div class="mx-auto max-w-7xl space-y-20 px-5">
			<?php foreach ( $perkasa_services as $svc ) : ?>
				<article id="<?php echo esc_attr( $svc['id'] ); ?>" class="grid items-center gap-10 lg:grid-cols-2" data-reveal>
					<div class="relative">
						<span class="giant-num block text-[9rem] leading-none" aria-hidden="true"><?php echo esc_html( $svc['n'] ); ?></span>
						<div class="mt-2 h-1.5 w-24 bg-amber-500" aria-hidden="true"></div>
					</div>
					<div>
						<h2 class="font-display text-3xl font-black uppercase tracking-tight text-[#060a12]"><?php echo esc_html( $svc['g'] ); ?></h2>
						<p class="mt-4 text-sm leading-relaxed text-slate-500"><?php echo esc_html( $svc['d'] ); ?></p>
						<ul class="mt-6 grid gap-2.5">
							<?php foreach ( $svc['feat'] as $f ) : ?>
								<li class="flex items-start gap-3 text-sm text-slate-600">
									<span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-sm bg-amber-500 text-xs font-black text-[#060a12]" aria-hidden="true">✓</span>
									<?php echo esc_html( $f ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
						<p class="chip mt-6"><span class="text-amber-600">Output:</span> <?php echo esc_html( $svc['out'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="bp-grid relative bg-[#0d1520] py-20 text-white lg:py-24" aria-labelledby="cap-heading">
		<div class="mx-auto max-w-5xl px-5">
			<p class="eyebrow spec-label mb-4 text-amber-500" data-reveal>Spesifikasi</p>
			<h2 id="cap-heading" class="font-display text-3xl font-black uppercase tracking-tight sm:text-4xl" data-reveal>
				Kemampuan & Standar
			</h2>

			<div class="mt-10 overflow-x-auto rounded-xl border border-slate-800" data-reveal>
				<table class="cap-table min-w-[42rem]">
					<thead>
						<tr>
							<?php foreach ( $perkasa_caps[0] as $th ) : ?>
								<th scope="col"><?php echo esc_html( $th ); ?></th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( array_slice( $perkasa_caps, 1 ) as $row ) : ?>
							<tr>
								<?php foreach ( $row as $i => $cell ) : ?>
									<td <?php echo 0 === $i ? 'class="!text-white font-semibold"' : ''; ?>><?php echo esc_html( $cell ); ?></td>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<section class="relative overflow-hidden bg-amber-500 py-14" aria-label="Ajakan konsultasi">
		<div class="bp-grid absolute inset-0 opacity-40" aria-hidden="true"></div>
		<div class="relative mx-auto flex max-w-7xl flex-col items-start justify-between gap-6 px-5 lg:flex-row lg:items-center">
			<h2 class="font-display text-2xl font-black uppercase tracking-tight text-[#060a12] sm:text-3xl" data-reveal>
				Konsultasi 30 menit — gratis.
			</h2>
			<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-ink" data-reveal data-ga-track="services_cta">Mulai Konsultasi</a>
		</div>
	</section>

</main>

<?php
get_footer();