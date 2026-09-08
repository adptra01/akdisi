<?php
/**
 * Front page — Garuda Perkasa v3.
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

$perkasa_services = array(
	array(
		'n'    => '01',
		'id'   => 'gedung',
		't'    => 'Konstruksi Gedung',
		'd'    => 'Perkantoran, rumah sakit, pabrik, hunian vertikal. Bangunan bertingkat hingga 30 lantai dengan standar mutu & K3 penuh.',
		'chip' => array( 'Struktur beton', 'Baja', 'Sampai 30 lantai' ),
	),
	array(
		'n'    => '02',
		'id'   => 'infrastruktur',
		't'    => 'Infrastruktur & Jalan',
		'd'    => 'Jalan tol, jembatan, drainase, irigasi. Konstruksi sipil skala kota hingga nasional dengan manajemen lalu lintas terencana.',
		'chip' => array( 'Jalan & tol', 'Jembatan', 'Drainase' ),
	),
	array(
		'n'    => '03',
		'id'   => 'renovasi',
		't'    => 'Renovasi & Rehabilitasi',
		'd'    => 'Perkuatan struktur, retrofit, dan rehabilitasi gedung tua tanpa menghentikan operasional bangunan.',
		'chip' => array( 'Retrofit', 'Perkuatan struktur', 'Rehabilitasi' ),
	),
	array(
		'n'    => '04',
		'id'   => 'konsultasi',
		't'    => 'Konsultasi & Manajemen',
		'd'    => 'Perencanaan, pengawasan, dan manajemen konstruksi — dari studi kelayakan hingga serah terima.',
		'chip' => array( 'Perencanaan', 'Pengawasan', 'MK' ),
	),
);

$perkasa_projects = perkasa_get_projects();

$perkasa_timeline = array(
	array( 'yr' => '1999', 't' => 'Berdiri di Jakarta', 'd' => 'Garuda Perkasa lahir sebagai kontraktor rumah tinggal & ruko di Jabodetabek.' ),
	array( 'yr' => '2005', 't' => 'Penetrasi Sumatra', 'd' => 'Proyek infrastruktur pertama di Riau membuka jaringan kerja hingga 12 provinsi.' ),
	array( 'yr' => '2012', 't' => 'Sertifikasi K3 & ISO', 'd' => 'ISO 9001 dan SMK3 diterapkan menyeluruh di seluruh site.' ),
	array( 'yr' => '2017', 't' => '100+ proyek', 'd' => 'Tonggak 100 proyek tercapai; fokus bergeser ke gedung bertingkat.' ),
	array( 'yr' => '2021', 't' => 'Kawasan industri', 'd' => 'Divisi industrial berdiri: pabrik, gudang, dan utilitas kawasan.' ),
	array( 'yr' => '2024', 't' => '150+ proyek & 12 provinsi', 'd' => 'Ekspansi jembatan bentang panjang dan rehabilitasi gedung cagar.' ),
);

$perkasa_faqs = array(
	array(
		'q' => 'Apakah melayani proyek di luar Jawa?',
		'a' => 'Ya. Kami aktif mengerjakan proyek di 12 provinsi, dari Sumatra hingga Kalimantan. Tim kami memiliki prosedur mobilisasi peralatan dan tenaga kerja terbukti untuk proyek antar-pulau.',
	),
	array(
		'q' => 'Bagaimana sistem pembayaran proyek?',
		'a' => 'Pembayaran berbasis milestone yang disepakati dalam kontrak — umumnya uang muka 20–30%, lalu termin per tahap pekerjaan (struktur, arsitektur, MEP, finishing). Tidak ada sistem borongan tanpa kontrak tertulis.',
	),
	array(
		'q' => 'Berapa lama durasi pembangunan gedung?',
		'a' => 'Bergantung luas dan kompleksitas. Rata-rata gedung 5–10 lantai selesai dalam 12–18 bulan. Jadwal rinci beserta kurva S diserahkan sebelum kontrak ditandatangani.',
	),
	array(
		'q' => 'Apakah konsultasi awal berbayar?',
		'a' => 'Tidak. Sesi konsultasi 30 menit pertama gratis — kami petakan kebutuhan Anda dan memberikan estimasi kasar biaya & durasi sebelum Anda memutuskan melangkah lebih jauh.',
	),
	array(
		'q' => 'Proyek renovasi kecil dilayani?',
		'a' => 'Dilayani. Renovasi dan konsultasi mulai dari nilai proyek Rp 50 juta. Tim kami juga menangani perizinan, gambar kerja, dan pengawasan standalone.',
	),
);
?>

<main id="perkasa-main">

	<!-- ================= HERO ================= -->
	<section class="bp-grid relative overflow-hidden bg-[#060a12] text-white" data-hero aria-label="Perkenalan">
		<!-- Decorative: glow amber + steel, parallax layer -->
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div data-parallax="10" class="absolute -right-32 -top-32 h-[28rem] w-[28rem] rounded-full bg-amber-500/15 blur-[120px]"></div>
			<div data-parallax="6" class="absolute -left-24 bottom-0 h-80 w-80 rounded-full bg-sky-400/10 blur-[100px]"></div>
		</div>

		<div class="relative mx-auto max-w-7xl px-5 pb-20 pt-28 lg:pb-28 lg:pt-40">
			<div class="max-w-4xl">
				<p class="eyebrow spec-label mb-7 text-amber-500" data-reveal>Kontraktor Konstruksi &amp; Sipil — Sejak 1999</p>

				<h1 class="font-display text-5xl font-black uppercase leading-[0.95] tracking-tight sm:text-6xl lg:text-8xl">
					<span class="clip-line"><span data-hero-line>Membangun</span></span>
					<span class="clip-line"><span data-hero-line>Infrastruktur</span></span>
					<span class="clip-line"><span data-hero-line>Masa Depan<span class="text-amber-500">.</span></span></span>
				</h1>

				<p class="mt-7 max-w-xl text-base leading-relaxed text-slate-300 sm:text-lg" data-reveal>
					Garuda Perkasa membangun gedung, jalan, dan kawasan — dari perencanaan
					hingga serah terima. Tepat waktu, tepat mutu, tanpa kompromi keselamatan.
				</p>

				<div class="mt-9 flex flex-wrap gap-4" data-reveal>
					<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-amber" data-ga-track="hero_cta">Diskusikan Proyek</a>
					<a href="<?php echo esc_url( home_url( '/proyek/' ) ); ?>" class="btn btn-outline-light" data-ga-track="hero_secondary">Lihat Proyek</a>
				</div>
			</div>

			<!-- Stats strip -->
			<div class="mt-16 grid grid-cols-2 gap-px overflow-hidden rounded-xl border border-slate-800 bg-slate-800 lg:mt-20 lg:grid-cols-4" data-reveal>
				<?php foreach ( $perkasa_stats as $s ) : ?>
					<div class="bg-[#0d1520] p-6">
						<p class="font-display text-3xl font-black text-amber-500 lg:text-4xl">
							<span data-count="<?php echo esc_attr( $s['num'] ); ?>"><?php echo esc_html( $s['num'] ); ?></span><?php echo esc_html( $s['suffix'] ); ?>
						</p>
						<p class="spec-label mt-2 text-slate-400"><?php echo esc_html( $s['label'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= TAPE MARQUEE ================= -->
	<div class="tape" aria-hidden="true">
		<div class="tape-track">
			<?php for ( $i = 0; $i < 2; $i++ ) : ?>
				<div class="tape-seg">
					<span>Konstruksi Gedung</span><span class="text-[#060a12]/60">✦</span>
					<span>Infrastruktur &amp; Jalan</span><span class="text-[#060a12]/60">✦</span>
					<span>Renovasi</span><span class="text-[#060a12]/60">✦</span>
					<span>Konsultasi Sipil</span><span class="text-[#060a12]/60">✦</span>
					<span>K3 &amp; Mutu</span><span class="text-[#060a12]/60">✦</span>
					<span>Pembangunan Kawasan</span><span class="text-[#060a12]/60">✦</span>
				</div>
			<?php endfor; ?>
		</div>
	</div>

	<!-- ================= LAYANAN ================= -->
	<section class="bp-grid-light relative bg-paper py-20 lg:py-28" aria-labelledby="layanan-heading">
		<div class="mx-auto max-w-7xl px-5">
			<div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
				<div>
					<p class="eyebrow spec-label mb-4 text-amber-600" data-reveal>Layanan</p>
					<h2 id="layanan-heading" class="font-display text-3xl font-black uppercase tracking-tight text-[#060a12] sm:text-4xl lg:text-5xl" data-reveal>
						Empat Bidang,<br>Standar Yang Sama
					</h2>
				</div>
				<p class="max-w-sm text-sm leading-relaxed text-slate-500 md:text-right" data-reveal>
					Dari hunian hingga infrastruktur nasional — setiap pekerjaan dijalankan
					dengan spesifikasi, jadwal, dan kontrol mutu yang sama ketatnya.
				</p>
			</div>

			<div class="mt-14 grid gap-6 md:grid-cols-2" data-reveal>
				<?php foreach ( $perkasa_services as $svc ) : ?>
					<article id="<?php echo esc_attr( $svc['id'] ); ?>" class="gp-card relative overflow-hidden p-8" data-reveal>
						<span class="giant-num absolute -right-4 -top-6 text-[7rem]" aria-hidden="true"><?php echo esc_html( $svc['n'] ); ?></span>
						<p class="spec-label text-amber-600"><?php echo esc_html( $svc['n'] ); ?></p>
						<h3 class="mt-3 font-display text-2xl font-bold text-[#060a12]"><?php echo esc_html( $svc['t'] ); ?></h3>
						<p class="mt-3 text-sm leading-relaxed text-slate-500"><?php echo esc_html( $svc['d'] ); ?></p>
						<div class="mt-6 flex flex-wrap gap-2">
							<?php foreach ( $svc['chip'] as $c ) : ?>
								<span class="chip"><?php echo esc_html( $c ); ?></span>
							<?php endforeach; ?>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= PROYEK UNGGULAN (pin horizontal desktop) ================= -->
	<section class="relative overflow-hidden bg-[#060a12] py-20 lg:pt-24 lg:pb-8" data-projects-section aria-labelledby="proyek-heading">
		<div class="mx-auto max-w-7xl px-5 pb-2 pt-4">
			<div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
				<div>
					<p class="eyebrow spec-label mb-4 text-amber-500" data-reveal>Portofolio</p>
					<h2 id="proyek-heading" class="font-display text-3xl font-black uppercase tracking-tight text-white sm:text-4xl lg:text-5xl" data-reveal>
						Proyek Unggulan
					</h2>
				</div>
				<a href="<?php echo esc_url( home_url( '/proyek/' ) ); ?>" class="btn btn-outline-light" data-reveal data-ga-track="projects_see_all">Semua Proyek</a>
			</div>
		</div>

		<!-- Track: geser horizontal via GSAP di desktop; vertikal natural di mobile.
		     Desktop: section tinggi natural (bukan full viewport) — card 28rem
		     menempel rapat di bawah heading (gap kecil pt-6/pb-8), semua kartu
		     seragam tanpa mengecil, tanpa space besar di atas/bawah card. -->
		<div class="lg:pt-6 lg:pb-8" data-projects-viewport>
			<div class="gap-6 px-5 lg:flex lg:w-max lg:px-8" data-projects-track>
				<?php foreach ( $perkasa_projects as $pj ) : ?>
					<article class="gp-card-dark bp-cross relative flex min-h-[18rem] w-full flex-col justify-between overflow-hidden p-8 lg:h-[28rem] lg:w-[26rem]" data-reveal>
						<span class="giant-num giant-num-light absolute -right-3 -top-7 text-[6.5rem]" aria-hidden="true"><?php echo esc_html( $pj['n'] ); ?></span>
						<div>
							<div class="flex items-center justify-between">
								<span class="chip chip-amber"><?php echo esc_html( $pj['cat'] ); ?></span>
								<span class="spec-label text-slate-500"><?php echo esc_html( $pj['yr'] ); ?></span>
							</div>
							<h3 class="mt-5 font-display text-2xl font-bold text-white"><?php echo esc_html( $pj['t'] ); ?></h3>
							<p class="mt-2 text-sm text-slate-400"><?php echo esc_html( $pj['loc'] ); ?></p>
							<p class="mt-3 text-sm leading-relaxed text-slate-300"><?php echo esc_html( $pj['d'] ); ?></p>
						</div>
						<div class="mt-6 flex items-center justify-between border-t border-slate-800 pt-4">
							<span class="text-xs uppercase tracking-wider text-slate-500">Status</span>
							<span class="flex items-center gap-2 text-xs font-semibold text-emerald-400">
								<span class="h-1.5 w-1.5 rounded-full bg-emerald-400" aria-hidden="true"></span><?php echo esc_html( $pj['stat'] ); ?>
							</span>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= KENAPA GARUDA ================= -->
	<section class="bg-paper py-20 lg:py-28" aria-labelledby="kenapa-heading">
		<div class="mx-auto max-w-7xl px-5">
			<div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr]">
				<div>
					<p class="eyebrow spec-label mb-4 text-amber-600" data-reveal>Kenapa Garuda</p>
					<h2 id="kenapa-heading" class="font-display text-3xl font-black uppercase tracking-tight text-[#060a12] sm:text-4xl lg:text-5xl" data-reveal>
						Bukan Sekadar<br>Menghabiskan <span class="text-amber-600">Material</span>
					</h2>
					<p class="mt-6 max-w-md text-sm leading-relaxed text-slate-500" data-reveal>
						28 tahun berulang-ulang diuji: jadwal, mutu, dan keselamatan. Kami
						mengukur setiap tahap agar yang Anda terima bukan hanya bangunan —
						tetapi kepastian.
					</p>
					<div class="h-bar mt-8 max-w-md" aria-hidden="true"><i style="width:84%"></i></div>
					<p class="mt-2 text-xs uppercase tracking-wider text-slate-400" data-reveal>84% proyek selesai lebih cepat dari kontrak</p>
				</div>

				<div class="grid gap-4 sm:grid-cols-2">
					<?php
					$values = array(
						array( 't' => 'Tepat Waktu', 'd' => 'Jadwal adalah komitmen. Kurva S dikontrol mingguan, laporan progres transparan.' ),
						array( 't' => 'Mutu Terukur', 'd' => 'Material tersertifikasi dan QC checklist di setiap tahap pekerjaan.' ),
						array( 't' => 'K3 Ketat', 'd' => 'SMK3 berlaku di semua site dengan target zero accident.' ),
						array( 't' => 'Tim Bersertifikat', 'd' => '480+ tenaga ahli dengan sertifikasi BNSP dan keahlian spesifik.' ),
					);
					foreach ( $values as $v ) :
						?>
						<div class="gp-card p-6" data-reveal>
							<span class="flex h-9 w-9 items-center justify-center rounded-md bg-amber-500 font-display text-sm font-black text-[#060a12]" aria-hidden="true">GP</span>
							<h3 class="mt-4 font-display text-lg font-bold text-[#060a12]"><?php echo esc_html( $v['t'] ); ?></h3>
							<p class="mt-2 text-sm leading-relaxed text-slate-500"><?php echo esc_html( $v['d'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= TIMELINE ================= -->
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

	<!-- ================= FAQ ================= -->
	<section class="bg-paper py-20 lg:py-28" aria-labelledby="faq-heading">
		<div class="mx-auto max-w-4xl px-5">
			<div class="text-center">
				<p class="eyebrow spec-label mb-4 justify-center text-amber-600" data-reveal>FAQ</p>
				<h2 id="faq-heading" class="font-display text-3xl font-black uppercase tracking-tight text-[#060a12] sm:text-4xl" data-reveal>
					Pertanyaan Umum
				</h2>
			</div>

			<div id="perkasa-faq" class="mt-12 space-y-3" data-accordion="collapse" data-reveal>
				<?php foreach ( $perkasa_faqs as $i => $faq ) : ?>
					<div class="gp-card overflow-hidden">
						<h3 id="faq-heading-<?php echo esc_attr( $i ); ?>">
							<button
								type="button"
								class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left font-display text-base font-bold text-[#060a12] hover:text-amber-600"
								data-accordion-target="#faq-body-<?php echo esc_attr( $i ); ?>"
								aria-expanded="<?php echo 0 === $i ? 'true' : 'false'; ?>"
								aria-controls="faq-body-<?php echo esc_attr( $i ); ?>"
							>
								<?php echo esc_html( $faq['q'] ); ?>
								<span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full border border-slate-200 text-slate-400" data-accordion-icon aria-hidden="true">
									<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
								</span>
							</button>
						</h3>
						<div id="faq-body-<?php echo esc_attr( $i ); ?>" class="hidden px-6 pb-6" role="region" aria-labelledby="faq-heading-<?php echo esc_attr( $i ); ?>">
							<p class="text-sm leading-relaxed text-slate-500"><?php echo esc_html( $faq['a'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= CTA BAND ================= -->
	<section class="relative overflow-hidden bg-amber-500 py-16 lg:py-20" aria-labelledby="cta-heading">
		<div class="bp-grid absolute inset-0 opacity-40" aria-hidden="true"></div>
		<div class="relative mx-auto max-w-7xl px-5">
			<div class="flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-center">
				<div>
					<h2 id="cta-heading" class="font-display text-3xl font-black uppercase leading-none tracking-tight text-[#060a12] sm:text-5xl" data-reveal>
						Siap Membangun<br>Bersama<span class="text-[#060a12]">.</span>
					</h2>
					<p class="mt-4 max-w-xl text-sm font-medium text-[#060a12]/80" data-reveal>
						Konsultasi 30 menit gratis untuk memetakan kebutuhan proyek Anda —
						kapan pun, di provinsi mana pun.
					</p>
				</div>
				<div class="flex flex-wrap gap-4" data-reveal>
					<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-ink" data-ga-track="cta_primary">Diskusikan Proyek</a>
					<a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D+/', '', perkasa_get_contact( 'whatsapp' ) ) ); ?>" target="_blank" rel="noopener noreferrer" class="btn !border !border-[#060a12]/40 !text-[#060a12] hover:!bg-[#060a12]/10" data-ga-track="cta_whatsapp">WhatsApp</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();