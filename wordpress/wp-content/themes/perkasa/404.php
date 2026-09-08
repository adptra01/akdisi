<?php
/**
 * 404 — Garuda Perkasa v3.
 *
 * @package Garuda_Perkasa
 */

get_header();
?>

<main id="perkasa-main">
	<section class="bp-grid relative flex min-h-[80vh] items-center overflow-hidden bg-[#060a12] text-white" aria-labelledby="error-title">
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div class="absolute left-1/2 top-1/2 h-[30rem] w-[30rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-amber-500/10 blur-[120px]"></div>
		</div>

		<div class="relative mx-auto max-w-3xl px-5 py-32 text-center">
			<p class="font-display text-8xl font-black leading-none text-amber-500 sm:text-9xl" data-reveal>404</p>
			<h1 id="error-title" class="mt-4 font-display text-3xl font-black uppercase tracking-tight sm:text-4xl" data-reveal>
				Halaman Ini Tersesat
			</h1>
			<p class="mx-auto mt-4 max-w-md text-sm leading-relaxed text-slate-300" data-reveal>
				Sepertinya alamat yang Anda tuju belum dibangun — atau telah dipindahkan.
				Kami bantu Anda kembali ke lokasi yang tepat.
			</p>
			<div class="mt-8 flex flex-wrap justify-center gap-4" data-reveal>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-amber" data-ga-track="404_home">Kembali ke Beranda</a>
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-outline-light" data-ga-track="404_contact">Hubungi Kami</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();