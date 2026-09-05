<?php
/**
 * About Template
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: About Page
 */
get_header();
?>

<section class="hero" style="padding:3rem 0;">
    <div class="container" style="max-width:800px;">
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <p><?php _e('AKAR Digital Solusi (AKDISI) — pasangan pengembangan solusi digital untuk organisasi dan bisnis Anda.', 'akdisi'); ?></p>
    </div>
</section>

<div class="section">
    <div class="container" style="max-width:800px;">
        <?php
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>

        <!-- Values -->
        <h2 style="margin:3rem 0 1rem;"><?php _e('Nilai Kami', 'akdisi'); ?></h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Memahami Bisnis Dulu', 'akdisi'); ?></h3>
                    <p><?php _e('Kami memulai dari kebutuhan bisnis, bukan dari teknologi.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Terstruktur', 'akdisi'); ?></h3>
                    <p><?php _e('Proses kerja jelas dan terdokumentasi di setiap tahapan.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Transparan', 'akdisi'); ?></h3>
                    <p><?php _e('Komunikasi terbuka dan jujur mengenai kemampuan dan progress.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Solusi yang Berkembang', 'akdisi'); ?></h3>
                    <p><?php _e('Sistem Anda dapat dikembangkan seiring kebutuhan bisnis yang berubah.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Area Layanan', 'akdisi'); ?></h3>
                    <p><?php _e('Berbasis di Jambi, melayani kebutuhan digitalisasi di Jambi dan sekitarnya.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Mudah Dihubungi', 'akdisi'); ?></h3>
                    <p><?php _e('Konsultasi langsung via WhatsApp untuk mendiskusikan kebutuhan Anda.', 'akdisi'); ?></p>
                </div>
            </div>
        </div>

        <!-- Working Philosophy -->
        <h2 style="margin:3rem 0 1rem;"><?php _e('Filosofi Kerja', 'akdisi'); ?></h2>
        <div class="process-steps">
            <div class="process-step">
                <div class="process-step-number">1</div>
                <h4><?php _e('Diagnosa', 'akdisi'); ?></h4>
                <p><?php _e('Pahami masalah dan kebutuhan.', 'akdisi'); ?></p>
            </div>
            <div class="process-step">
                <div class="process-step-number">2</div>
                <h4><?php _e('Rancang', 'akdisi'); ?></h4>
                <p><?php _e('Desain solusi yang tepat.', 'akdisi'); ?></p>
            </div>
            <div class="process-step">
                <div class="process-step-number">3</div>
                <h4><?php _e('Bangun', 'akdisi'); ?></h4>
                <p><?php _e('Implementasi dengan kualitas.', 'akdisi'); ?></p>
            </div>
            <div class="process-step">
                <div class="process-step-number">4</div>
                <h4><?php _e('Kembangkan', 'akdisi'); ?></h4>
                <p><?php _e('Iterasi sesuai kebutuhan baru.', 'akdisi'); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-section">
    <div class="container">
        <h2><?php _e('Diskusikan Kebutuhan Anda', 'akdisi'); ?></h2>
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact')->ID ?? 0)); ?>" class="btn btn-large"><?php _e('Mulai Percakapan', 'akdisi'); ?></a>
    </div>
</div>

<?php get_footer();