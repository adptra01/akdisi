<?php
/**
 * Custom 404 Template
 * v1.3.0 — dark editorial hero-style 404.
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();
?>

<section class="error-404-page">
    <div class="hero-bg-grid" aria-hidden="true"></div>
    <div class="grain" aria-hidden="true"></div>
    <div class="container" style="max-width:640px;position:relative;z-index:2;">
        <h1>4<span class="serif serif-zero">0</span>4</h1>
        <h2 style="color:var(--text-light);"><?php _e('Halaman Tidak Ditemukan', 'akdisi'); ?></h2>
        <p><?php _e('Halaman yang Anda cari mungkin telah dipindahkan atau tidak tersedia.', 'akdisi'); ?></p>
        <div class="error-actions">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-accent btn-large magnetic"><?php _e('Kembali ke Beranda', 'akdisi'); ?></a>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact')->ID ?? 0)); ?>" class="btn btn-ghost btn-large" data-ga-track="cta_click" data-ga-content="404_contact"><?php _e('Hubungi AKDISI', 'akdisi'); ?></a>
        </div>
    </div>
</section>

<?php get_footer();