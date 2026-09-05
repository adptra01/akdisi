<?php
/**
 * Services Template
 * Listing empat layanan utama (PRD BAGIAN G) — link ke halaman detail masing-masing.
 *
 * @package AKDISI
 * @since 1.1.0
 *
 * Template Name: Services Page
 */

get_header();
?>

<section class="page-hero">
    <div class="container">
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <p><?php _e('Kami membantu organisasi dan bisnis memahami kebutuhan, merancang solusi, dan membangun aplikasi.', 'akdisi'); ?></p>
    </div>
</section>

<div class="section">
    <div class="container">
        <?php
        $service_pages = get_posts([
            'post_type'      => 'page',
            'posts_per_page' => -1,
            'post_parent'    => get_the_ID(),
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);

        if ($service_pages) :
        ?>
        <div class="card-grid">
            <?php foreach ($service_pages as $service) :
                $excerpt = has_excerpt($service->ID)
                    ? get_the_excerpt($service)
                    : wp_trim_words(wp_strip_all_tags((string) $service->post_content), 25);
            ?>
            <div class="card">
                <div class="card-body">
                    <h3><?php echo esc_html(get_the_title($service)); ?></h3>
                    <p><?php echo esc_html($excerpt); ?></p>
                    <a href="<?php echo esc_url(get_permalink($service)); ?>" class="btn btn-secondary" style="margin-top:1rem;"><?php _e('Pelajari Layanan', 'akdisi'); ?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <div class="card-grid">
            <?php
            $defaults = [
                ['application-development',           __('Application Development', 'akdisi'),           __('Pembangunan aplikasi yang dirancang berdasarkan kebutuhan dan proses bisnis organisasi.', 'akdisi')],
                ['business-process-digitalization',   __('Business Process Digitalization', 'akdisi'),   __('Mengubah proses manual menjadi workflow digital.', 'akdisi')],
                ['data-administration-systems',       __('Data & Administration Systems', 'akdisi'),       __('Sistem pengelolaan data anggota, unit, aset, dan dokumen.', 'akdisi')],
                ['custom-business-solutions',         __('Custom Business Solutions', 'akdisi'),           __('Solusi untuk kebutuhan khusus yang tidak cocok dengan software generik.', 'akdisi')],
            ];
            foreach ($defaults as $service) :
            ?>
            <div class="card">
                <div class="card-body">
                    <h3><?php echo esc_html($service[1]); ?></h3>
                    <p><?php echo esc_html($service[2]); ?></p>
                    <a href="<?php echo esc_url(home_url('/services/' . $service[0] . '/')); ?>" class="btn btn-secondary" style="margin-top:1rem;"><?php _e('Pelajari Layanan', 'akdisi'); ?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- CTA -->
<div class="cta-section">
    <div class="container">
        <h2><?php _e('Diskusikan Kebutuhan Anda', 'akdisi'); ?></h2>
        <p><?php _e('Tidak yakin solusi apa yang Anda butuhkan? Kami siap membantu.', 'akdisi'); ?></p>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-large"><?php _e('Hubungi Kami', 'akdisi'); ?></a>
    </div>
</div>

<?php get_footer();