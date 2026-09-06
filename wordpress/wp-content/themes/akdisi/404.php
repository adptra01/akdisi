<?php
/**
 * 404 — not found.
 *
 * @package AKDISI
 */

get_header();
?>

<section class="akdisi-404 section-bg flex min-h-[70vh] items-center pt-20 pb-24">
	<div class="container mx-auto text-center">
		<p class="font-display text-[clamp(6rem,18vw,11rem)] font-black leading-none tracking-tight text-brand/15">404</p>
		<h1 class="mt-2 font-display text-2xl font-bold text-ink md:text-3xl">Halaman ini tersesat.</h1>
		<p class="mx-auto mt-4 max-w-md text-ink-soft">Tautan mungkin sudah kedaluwarsa, atau halamannya berpindah. Mari kami antar kembali ke jalur yang benar.</p>
		<div class="mt-8 flex flex-wrap justify-center gap-4">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Kembali ke beranda</a>
			<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-outline">Hubungi kami</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>