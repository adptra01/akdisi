<?php
/**
 * Custom 404 Template
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();
?>

<section class="error-404">
    <div class="container" style="max-width:600px;">
        <h1>404</h1>
        <h2><?php _e('Halaman Tidak Ditemukan', 'akdisi'); ?></h2>
        <p style="color:var(--color-neutral-600);margin-bottom:2rem;">
            <?php _e('Halaman yang Anda cari mungkin telah dipindahkan atau tidak tersedia.', 'akdisi'); ?>
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary"><?php _e('Kembali ke Beranda', 'akdisi'); ?></a>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact')->ID ?? 0)); ?>" class="btn btn-accent"><?php _e('Hubungi AKDISI', 'akdisi'); ?></a>
        </div>
    </div>
</section>

<?php get_footer();