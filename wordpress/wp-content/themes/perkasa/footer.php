</main>

<footer class="perkasa-footer bg-dark text-stone-400">
	<div class="container mx-auto grid gap-10 py-14 md:grid-cols-2 lg:grid-cols-4">
		<!-- Brand -->
		<div class="space-y-4">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-display text-xl font-bold tracking-tight text-white">
				Garuda Perkasa<span class="text-brand">.</span>
			</a>
			<p class="max-w-xs text-sm leading-relaxed">
				<?php echo esc_html( get_bloginfo( 'description' ) ?: __( 'Mitra konstruksi terpercaya untuk proyek gedung, infrastruktur, dan sipil di seluruh Indonesia.', 'perkasa' ) ); ?>
			</p>
			<div class="space-y-1 text-sm">
				<a href="mailto:info@garudaperkasa.co.id" class="block hover:text-white transition-colors">info@garudaperkasa.co.id</a>
				<a href="tel:+622155501234" class="block hover:text-white transition-colors">(021) 5550-1234</a>
			</div>
		</div>

		<!-- Company -->
		<div>
			<h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-white">Perusahaan</h3>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'space-y-2 text-sm',
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
				'fallback_cb'    => 'perkasa_fallback_footer',
				'depth'          => 1,
			) );
			?>
		</div>

		<!-- Services -->
		<div>
			<h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-white">Layanan</h3>
			<ul class="space-y-2 text-sm">
				<?php
				$services = perkasa_footer_services();
				foreach ( $services as $label => $url ) :
					?>
					<li><a href="<?php echo esc_url( $url ); ?>" class="hover:text-white transition-colors"><?php echo esc_html( $label ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<!-- Contact / WhatsApp -->
		<div>
			<h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-white">Kontak</h3>
			<ul class="space-y-2 text-sm">
				<li class="leading-relaxed">
					Jl. Raya Industri No. 88<br>
					Jakarta Selatan, 12345
				</li>
				<li>
					<a href="https://wa.me/6281234567890" class="inline-flex items-center gap-2 rounded-lg bg-brand/20 px-4 py-2 text-sm font-medium text-brand hover:bg-brand/30 transition-colors">
						WhatsApp Kami
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="border-t border-white/10">
		<div class="container mx-auto flex flex-col items-center justify-between gap-3 px-5 py-5 text-xs text-stone-500 sm:flex-row lg:px-8">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. Seluruh hak cipta dilindungi.</p>
			<div class="flex gap-5">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-white transition-colors">Kebijakan Privasi</a>
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="hover:text-white transition-colors">Kontak</a>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
