<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="sticky top-0 z-50 border-b border-paper-line bg-white/80 backdrop-blur-md transition-shadow">
	<div class="container mx-auto flex h-16 items-center justify-between px-5 lg:px-8">
		<!-- Brand -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-display text-xl font-bold tracking-tight text-ink">
			Garuda Perkasa<span class="text-brand">.</span>
		</a>

		<!-- Desktop nav -->
		<nav aria-label="Navigasi utama" class="hidden items-center gap-8 md:flex">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => '',
				'items_wrap'     => '%3$s',
				'fallback_cb'    => 'perkasa_fallback_menu',
				'depth'          => 1,
			) );
			?>
			<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-primary btn-sm">Hubungi Kami</a>
		</nav>

		<!-- Mobile toggle -->
		<button id="menu-toggle" class="flex h-10 w-10 items-center justify-center rounded-lg text-ink md:hidden"
			aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
			<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
				<path id="icon-menu" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
				<path id="icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
			</svg>
		</button>
	</div>

	<!-- Mobile menu -->
	<div id="mobile-menu" class="hidden border-t border-paper-line bg-white px-5 pb-5 pt-4 md:hidden">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'space-y-3',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'fallback_cb'    => 'perkasa_fallback_menu',
			'depth'          => 1,
		) );
		?>
		<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-primary mt-4 w-full text-center">Hubungi Kami</a>
	</div>
</header>

<main id="site-content">
