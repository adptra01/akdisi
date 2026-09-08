<?php
/**
 * Header — Garuda Perkasa v3.
 *
 * @package Garuda_Perkasa
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-paper text-slate-900 antialiased' ); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#perkasa-main">Langsung ke konten</a>

<header id="perkasa-header" class="fixed inset-x-0 top-0 z-50 bg-[#060a12]/90 backdrop-blur-md" aria-label="Navigasi utama">
	<div class="header-top border-b border-slate-800">
		<div class="mx-auto max-w-7xl px-5">
			<nav class="flex h-16 items-center justify-between lg:h-[4.5rem]">

				<!-- Brand -->
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3" aria-label="Garuda Perkasa — beranda">
					<span class="flex h-9 w-9 items-center justify-center bg-amber-500 font-display text-base font-black text-[#060a12]" aria-hidden="true">GP</span>
					<span class="font-display text-sm font-extrabold uppercase leading-none tracking-[0.14em] text-white lg:text-base">
						Garuda<span class="text-amber-500">Perkasa</span><span class="text-amber-500">.</span>
					</span>
				</a>

				<!-- Desktop nav -->
				<div class="hidden items-center lg:flex">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'menu_class'     => 'flex items-center gap-1',
								'fallback_cb'    => false,
							)
						);
					} else {
						perkasa_nav_fallback();
					}
					?>
					<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-amber ml-4 !px-5 !py-2.5" data-ga-track="nav_cta">Konsultasi Gratis</a>
				</div>

				<!-- Toggle mobile (Flowbite collapse) -->
				<button
					type="button"
					class="inline-flex h-10 w-10 items-center justify-center rounded-md text-slate-200 hover:text-amber-500 focus-visible:outline-2 focus-visible:outline-amber-500 lg:hidden"
					data-collapse-toggle="perkasa-nav"
					aria-controls="perkasa-nav"
					aria-expanded="false"
					aria-label="Buka menu mobile"
				>
					<svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
				</button>
			</nav>
		</div>
	</div>

	<!-- Panel mobile (Flowbite) -->
	<div id="perkasa-nav" class="hidden border-b border-slate-800 bg-[#060a12]/95 backdrop-blur-md lg:hidden">
		<div class="mx-auto max-w-7xl px-5 py-4">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'space-y-1',
						'fallback_cb'    => false,
					)
				);
			} else {
				echo '<ul class="space-y-1">';
				$items = array(
					'/'         => 'Beranda',
					'/proyek/'  => 'Proyek',
					'/layanan/' => 'Layanan',
					'/tentang/' => 'Tentang',
					'/kontak/'  => 'Kontak',
				);
				foreach ( $items as $url => $label ) {
					printf(
						'<li><a href="%s" class="block rounded-md px-3 py-2.5 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-amber-500">%s</a></li>',
						esc_url( home_url( $url ) ),
						esc_html( $label )
					);
				}
				echo '</ul>';
			}
			?>
			<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-amber mt-4 w-full">Konsultasi Gratis</a>
		</div>
	</div>
</header>