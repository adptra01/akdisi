<?php
/**
 * Footer — Garuda Perkasa v3.
 *
 * @package Garuda_Perkasa
 */
?>
<footer class="bg-[#060a12] text-slate-300" aria-label="Footer">
	<div class="border-t-4 border-amber-500"></div>

	<div class="bp-grid mx-auto max-w-7xl px-5 py-16">
		<div class="grid gap-12 md:grid-cols-2 lg:grid-cols-4">

			<!-- Brand & kontak -->
			<div class="lg:pr-6">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3" aria-label="Garuda Perkasa — beranda">
					<span class="flex h-9 w-9 items-center justify-center bg-amber-500 font-display text-base font-black text-[#060a12]" aria-hidden="true">GP</span>
					<span class="font-display text-sm font-extrabold uppercase tracking-[0.14em] text-white">
						Garuda<span class="text-amber-500">Perkasa</span><span class="text-amber-500">.</span>
					</span>
				</a>
				<p class="mt-5 text-sm leading-relaxed text-slate-400">
					Kontraktor sipil & konstruksi sejak 1999. Membangun gedung,
					infrastruktur, dan kawasan — dari perencanaan hingga serah terima.
				</p>
				<address class="mt-5 space-y-1.5 text-sm not-italic text-slate-400">
					<p><?php echo esc_html( perkasa_get_contact( 'address' ) ); ?></p>
					<p><a href="mailto:<?php echo esc_attr( perkasa_get_contact( 'email' ) ); ?>" class="hover:text-amber-400"><?php echo esc_html( perkasa_get_contact( 'email' ) ); ?></a></p>
					<p><a href="tel:<?php echo esc_attr( preg_replace( '/\D+/', '', perkasa_get_contact( 'phone' ) ) ); ?>" class="hover:text-amber-400"><?php echo esc_html( perkasa_get_contact( 'phone' ) ); ?></a></p>
					<p><a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D+/', '', perkasa_get_contact( 'whatsapp' ) ) ); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-amber-400">WhatsApp: <?php echo esc_html( perkasa_wa_display( perkasa_get_contact( 'whatsapp' ) ) ); ?></a></p>
				</address>
			</div>

			<!-- Perusahaan -->
			<nav aria-label="Tautan perusahaan">
				<h2 class="spec-label mb-5 text-amber-500">Perusahaan</h2>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'space-y-2.5',
							'fallback_cb'    => false,
						)
					);
				} else {
					perkasa_footer_nav_fallback();
				}
				?>
			</nav>

			<!-- Layanan -->
			<nav aria-label="Tautan layanan">
				<h2 class="spec-label mb-5 text-amber-500">Layanan</h2>
				<?php
				if ( has_nav_menu( 'footer-services' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer-services',
							'container'      => false,
							'menu_class'     => 'space-y-2.5',
							'fallback_cb'    => false,
						)
					);
				} else {
					perkasa_footer_services_fallback();
				}
				?>
			</nav>

			<!-- Sertifikasi / jam -->
			<div>
				<h2 class="spec-label mb-5 text-amber-500">Sertifikasi</h2>
				<ul class="space-y-2">
					<li class="chip chip-dark">ISO 9001:2015 — Mutu</li>
					<li class="chip chip-dark">ISO 45001 — K3</li>
					<li class="chip chip-dark">SMK3 PP 50/2012</li>
					<li class="chip chip-dark">Kualifikasi B2 (Jasa Konstruksi)</li>
				</ul>
				<p class="mt-6 text-xs uppercase tracking-wider text-slate-500">Jam operasional</p>
				<p class="mt-1.5 text-sm text-slate-400">Senin–Jumat 08.00–17.00 WIB</p>
			</div>
		</div>
	</div>

	<div class="border-t border-slate-800">
		<div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-5 py-5 text-xs text-slate-500 sm:flex-row">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Garuda Perkasa. Semua hak cipta dilindungi.</p>
			<div class="flex items-center gap-5">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-amber-400">Kebijakan Privasi</a>
				<span class="flex items-center gap-1.5"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400" aria-hidden="true"></span> Sistem beroperasi normal</span>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>