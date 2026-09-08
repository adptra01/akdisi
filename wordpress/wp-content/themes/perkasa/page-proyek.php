<?php
/**
 * Template Name: Proyek
 * Template Post Type: page
 *
 * Halaman portofolio proyek — Garuda Perkasa v3.
 *
 * @package Garuda_Perkasa
 */

get_header();

$perkasa_projects = perkasa_get_projects();
?>

<main id="perkasa-main">

	<section class="bp-grid relative overflow-hidden bg-[#060a12] text-white" aria-labelledby="page-title">
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div data-parallax="8" class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-amber-500/15 blur-[110px]"></div>
		</div>
		<div class="relative mx-auto max-w-7xl px-5 pb-16 pt-28 lg:pb-20 lg:pt-40">
			<p class="eyebrow spec-label mb-5 text-amber-500" data-reveal>Portofolio</p>
			<h1 id="page-title" class="font-display text-4xl font-black uppercase leading-[0.95] tracking-tight sm:text-6xl lg:text-7xl" data-reveal>
				Proyek Yang Sudah<br><span class="text-amber-500">Kami Serahkan</span>
			</h1>
			<p class="mt-6 max-w-xl text-sm leading-relaxed text-slate-300 sm:text-base" data-reveal>
				150+ proyek di 12 provinsi. Enam di antaranya — dari gedung bertingkat
				hingga jembatan bentang panjang — kami tampilkan di sini.
			</p>
		</div>
	</section>

	<section class="bg-paper py-20 lg:py-28" aria-label="Daftar proyek">
		<div class="mx-auto max-w-7xl px-5">
			<div class="grid gap-8 lg:grid-cols-2">
				<?php foreach ( $perkasa_projects as $pj ) : ?>
					<article class="gp-card relative overflow-hidden p-8" data-reveal>
						<span class="giant-num absolute -right-4 -top-7 text-[8rem]" aria-hidden="true"><?php echo esc_html( $pj['n'] ); ?></span>

						<div class="relative">
							<div class="flex flex-wrap items-center gap-2">
								<span class="chip chip-amber"><?php echo esc_html( $pj['cat'] ); ?></span>
								<span class="chip"><?php echo esc_html( $pj['stat'] ); ?></span>
							</div>

							<h2 class="mt-5 font-display text-2xl font-bold text-[#060a12] lg:text-3xl"><?php echo esc_html( $pj['t'] ); ?></h2>

							<dl class="mt-4 grid grid-cols-3 gap-3 border-y border-slate-100 py-4 text-center">
								<div>
									<dt class="spec-label text-slate-400">Lokasi</dt>
									<dd class="mt-1 text-sm font-semibold text-slate-700"><?php echo esc_html( $pj['loc'] ); ?></dd>
								</div>
								<div>
									<dt class="spec-label text-slate-400">Tahun</dt>
									<dd class="mt-1 text-sm font-semibold text-slate-700"><?php echo esc_html( $pj['yr'] ); ?></dd>
								</div>
								<div>
									<dt class="spec-label text-slate-400">Durasi</dt>
									<dd class="mt-1 text-sm font-semibold text-slate-700"><?php echo esc_html( $pj['dur'] ); ?></dd>
								</div>
							</dl>

							<p class="mt-4 text-sm leading-relaxed text-slate-500"><?php echo esc_html( $pj['d'] ); ?></p>

							<ul class="mt-5 grid gap-2 sm:grid-cols-2">
								<?php foreach ( $pj['feats'] as $f ) : ?>
									<li class="flex items-start gap-2 text-sm text-slate-600">
										<span class="mt-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-sm bg-amber-500 text-[10px] font-black text-[#060a12]" aria-hidden="true">✓</span>
										<?php echo esc_html( $f ); ?>
									</li>
								<?php endforeach; ?>
							</ul>

							<div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-5">
								<span class="text-xs uppercase tracking-wider text-slate-400">Nilai: <?php echo esc_html( $pj['val'] ); ?></span>
								<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="text-sm font-bold text-amber-600 hover:text-amber-500" data-ga-track="project_discuss">Diskusikan proyek serupa →</a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="relative overflow-hidden bg-amber-500 py-14" aria-label="Ajakan diskusi">
		<div class="bp-grid absolute inset-0 opacity-40" aria-hidden="true"></div>
		<div class="relative mx-auto flex max-w-7xl flex-col items-start justify-between gap-6 px-5 lg:flex-row lg:items-center">
			<h2 class="font-display text-2xl font-black uppercase tracking-tight text-[#060a12] sm:text-3xl" data-reveal>
				Punya proyek serupa? Kami siap hitung.
			</h2>
			<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-ink" data-reveal data-ga-track="projects_cta">Diskusikan Proyek</a>
		</div>
	</section>

</main>

<?php
get_footer();