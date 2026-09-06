</main>

<footer class="akdisi-footer mt-auto bg-ink text-stone-400">
	<div class="container mx-auto grid gap-12 py-16 md:grid-cols-2 lg:grid-cols-4">
		<!-- Brand -->
		<div class="space-y-4">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-display text-2xl font-bold tracking-tight text-white">
				<?php bloginfo( 'name' ); ?><span class="text-brand">.</span>
			</a>
			<p class="max-w-xs text-sm leading-relaxed">
				<?php echo esc_html( get_bloginfo( 'description' ) ?: __( 'Mitra digital untuk bisnis yang ingin tumbuh — website dan aplikasi yang mendatangkan pelanggan.', 'akdisi' ) ); ?>
			</p>
			<!-- Contact CRUD -->
			<div class="space-y-1 text-sm">
				<a href="mailto:hello@akdisi.com" class="block hover:text-white">hello@akdisi.com</a>
				<a href="https://wa.me/6281234567890" class="block hover:text-white" target="_blank" rel="noopener">+62 812-3456-7890</a>
			</div>
		</div>

		<!-- Company -->
		<div>
			<h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-white">Perusahaan</h3>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'space-y-2 text-sm',
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					'fallback_cb'    => 'akdisi_fallback_footer',
					'depth'          => 1,
				)
			);
			?>
		</div>

		<!-- Services quick-links -->
		<div>
			<h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-white">Layanan</h3>
			<ul class="space-y-2 text-sm">
				<?php
				$services = akdisi_footer_services();
				foreach ( $services as $label => $url ) :
					?>
					<li><a href="<?php echo esc_url( $url ); ?>" class="hover:text-white"><?php echo esc_html( $label ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<!-- Newsletter -->
		<div>
			<h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-white">Terkini</h3>
			<p class="mb-4 text-sm">Insight produk, tanpa spam.</p>
			<form id="akdisi-newsletter-form" class="w-full max-w-xs" novalidate>
				<div class="flex gap-2">
					<input type="email" name="nl-email" placeholder="Alamat email Anda" required autocomplete="email" aria-label="Alamat email"
						class="min-w-0 flex-1 rounded-lg border border-stone-700 bg-transparent px-3 py-2 text-sm text-white placeholder:text-stone-500 focus:border-brand focus:outline-none">
					<button type="submit" class="btn btn-primary rounded-lg px-4 py-2 text-sm">Gabung</button>
				</div>
				<?php wp_nonce_field( 'akdisi_newsletter', 'akdisi_nl_nonce' ); ?>
				<p class="akdisi-nl-status mt-3 hidden text-xs text-stone-400"></p>
			</form>
		</div>
	</div>

	<div class="border-t border-stone-800">
		<div class="container mx-auto flex flex-col items-center justify-between gap-3 py-6 text-xs text-stone-400 sm:flex-row">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. Seluruh hak cipta dilindungi.</p>
			<div class="flex gap-6">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-white">Kebijakan Privasi</a>
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="hover:text-white">Kontak</a>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
