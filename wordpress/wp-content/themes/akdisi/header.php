<?php
/**
 * Header — global site header with sticky nav + mobile menu.
 *
 * @package AKDISI
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="akdisi-header sticky top-0 z-50 w-full border-b border-paper-line bg-white/85 backdrop-blur-md">
	<div class="container mx-auto flex h-20 items-center justify-between gap-6">
		<!-- Brand -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> beranda">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="font-display text-2xl font-bold tracking-tight text-ink">
					<?php bloginfo( 'name' ); ?><span class="text-brand">.</span>
				</span>
			<?php endif; ?>
		</a>

		<!-- Desktop nav -->
		<nav class="hidden items-center gap-8 lg:flex" aria-label="Navigasi utama">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex items-center gap-8',
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					'fallback_cb'    => 'akdisi_fallback_menu',
					'depth'          => 1,
				)
			);
			?>
		</nav>

		<!-- CTA + mobile toggle -->
		<div class="flex items-center gap-3">
			<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-primary hidden sm:inline-flex">Mulai proyek</a>
			<button type="button" id="nav-toggle" class="flex h-10 w-10 items-center justify-center rounded-lg border border-paper-line lg:hidden" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="7" x2="21" y2="7"/><line x1="3" y1="17" x2="21" y2="17"/></svg>
			</button>
		</div>
	</div>

	<!-- Mobile menu -->
	<nav id="mobile-menu" class="hidden border-t border-paper-line bg-white lg:hidden" aria-label="Menu utama">
		<div class="container mx-auto py-4">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex flex-col gap-1',
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					'fallback_cb'    => 'akdisi_fallback_menu',
					'depth'          => 1,
				)
			);
			?>
			<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-primary mt-4 w-full">Mulai proyek</a>
		</div>
	</nav>
</header>

<main id="main" class="akdisi-main">
