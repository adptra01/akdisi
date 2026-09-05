<?php
/**
 * Header Template
 *
 * @package AKDISI
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script>document.documentElement.classList.replace('no-js', 'js');</script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a href="#main-content" class="skip-link"><?php _e('Skip to content', 'akdisi'); ?></a>

<header class="site-header" role="banner" data-header>
    <div class="container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="<?php echo esc_attr__('AKDISI Home', 'akdisi'); ?>">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span>AKDISI<span class="logo-dot">.</span></span>
            <?php endif; ?>
        </a>

        <button class="menu-toggle" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle menu', 'akdisi'); ?>" aria-controls="primary-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-navigation" id="primary-menu" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'akdisi'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => '',
                'container'      => false,
                'fallback_cb'    => false,
                'depth'          => 3,
            ]);
            ?>
        </nav>
    </div>
</header>

<main id="main-content">