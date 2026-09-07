<?php get_header(); ?>

<section class="section flex min-h-[60vh] items-center">
	<div class="container mx-auto px-5 text-center lg:px-8">
		<div data-reveal>
			<p class="font-display text-[clamp(4rem,12vw,10rem)] font-bold leading-none text-ink/[0.06]">404</p>
			<h1 class="-mt-12 font-display text-3xl font-bold text-ink md:-mt-16">Halaman tidak ditemukan</h1>
			<p class="mx-auto mt-4 max-w-md text-ink-soft leading-relaxed">Halaman yang Anda cari sudah dipindahkan, dihapus, atau tidak pernah ada.</p>
			<div class="mt-8 flex flex-wrap justify-center gap-4">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Kembali ke Beranda</a>
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-outline">Hubungi Kami</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
