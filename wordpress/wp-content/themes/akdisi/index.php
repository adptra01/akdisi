<?php
/**
 * Homepage Template
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();

// Hero
$hero_title = get_theme_mod('akdisi_hero_title', 'Solusi Aplikasi yang Dibangun untuk Proses Bisnis Anda');
$hero_subtitle = get_theme_mod('akdisi_hero_subtitle', 'Kami membantu organisasi dan bisnis memahami kebutuhan, merancang solusi, dan membangun aplikasi yang benar-benar bekerja.');
?>

<section class="hero">
    <div class="container">
        <h1><?php echo esc_html($hero_title); ?></h1>
        <p><?php echo esc_html($hero_subtitle); ?></p>
        <div>
            <a href="#contact" class="btn btn-large btn-accent"><?php _e('Konsultasikan Kebutuhan', 'akdisi'); ?></a>
            <a href="#portfolio" class="btn btn-large btn-secondary"><?php _e('Lihat Portfolio', 'akdisi'); ?></a>
        </div>
    </div>
</section>

<!-- Problem Statement -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Masalah Bisnis Anda?', 'akdisi'); ?></h2>
            <p><?php _e('Data tersebar, proses manual, sulit laporan — kami paham tantangan Anda.', 'akdisi'); ?></p>
        </div>
        <?php
        // Problem section from theme mod or default content
        $problems = get_theme_mod('akdisi_problems', '');
        if ($problems) :
            echo wp_kses_post($problems);
        else :
        ?>
        <div class="card-grid">
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Data Tersebar', 'akdisi'); ?></h3>
                    <p><?php _e('Informasi tersimpan di banyak tempat, sulit diakses dan dianalisis.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Proses Manual', 'akdisi'); ?></h3>
                    <p><?php _e('Banyak pekerjaan dilakukan secara manual, memakan waktu dan rentan error.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Sulit Dapat Laporan', 'akdisi'); ?></h3>
                    <p><?php _e('Tidak ada sistem pelaporan yang otomatis dan akurat.', 'akdisi'); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Services -->
<section class="section section-alt" id="services">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Layanan Kami', 'akdisi'); ?></h2>
            <p><?php _e('Kami menyediakan solusi aplikasi sesuai kebutuhan bisnis Anda.', 'akdisi'); ?></p>
        </div>
        <?php
        $services_query = new WP_Query(['post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'template-services.php', 'posts_per_page' => -1]);
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            wp_reset_postdata();
        else :
        ?>
        <div class="card-grid">
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Pengembangan Aplikasi', 'akdisi'); ?></h3>
                    <p><?php _e('Aplikasi custom sesuai kebutuhan bisnis Anda, dari konsep hingga deployment.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Digitalisasi Proses', 'akdisi'); ?></h3>
                    <p><?php _e('Otomatisasi workflow bisnis agar lebih efisien dan transparan.', 'akdisi'); ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3><?php _e('Sistem Data & Admin', 'akdisi'); ?></h3>
                    <p><?php _e('Dashboard dan sistem pengelolaan data yang akurat dan real-time.', 'akdisi'); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Portfolio Highlights -->
<section class="section" id="portfolio">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Portfolio', 'akdisi'); ?></h2>
            <p><?php _e('Contoh solusi yang telah kami bangun.', 'akdisi'); ?></p>
        </div>
        <?php
        $portfolios = new WP_Query(['post_type' => 'akdisi_portfolio', 'posts_per_page' => 6, 'post_status' => 'publish']);
        if ($portfolios->have_posts()) :
        ?>
        <div class="card-grid">
            <?php while ($portfolios->have_posts()) : $portfolios->the_post(); ?>
            <div class="card">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('akdisi-portfolio'); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" loading="lazy">
                <?php endif; ?>
                <div class="card-body">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 15)); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-secondary" style="margin-top:1rem;"><?php _e('Lihat Detail', 'akdisi'); ?></a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php
        endif;
        wp_reset_postdata();
        ?>
        <div style="text-align:center;margin-top:2rem;">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_portfolio') ?: get_post_type_archive_link('akdisi_portfolio'))); ?>" class="btn btn-primary"><?php _e('Lihat Semua Project', 'akdisi'); ?></a>
        </div>
    </div>
</section>

<!-- Process -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Proses Kerja Kami', 'akdisi'); ?></h2>
            <p><?php _e('Langkah-langkah kami mengubah kebutuhan Anda menjadi solusi.', 'akdisi'); ?></p>
        </div>
        <div class="process-steps">
            <div class="process-step">
                <div class="process-step-number">1</div>
                <h4><?php _e('Pahami Kebutuhan', 'akdisi'); ?></h4>
                <p><?php _e('Kami mendalami bisnis dan proses Anda.', 'akdisi'); ?></p>
            </div>
            <div class="process-step">
                <div class="process-step-number">2</div>
                <h4><?php _e('Rancang Solusi', 'akdisi'); ?></h4>
                <p><?php _e('Desain solusi yang tepat dan efisien.', 'akdisi'); ?></p>
            </div>
            <div class="process-step">
                <div class="process-step-number">3</div>
                <h4><?php _e('Bangun & Uji', 'akdisi'); ?></h4>
                <p><?php _e('Pengembangan dan pengujian menyeluruh.', 'akdisi'); ?></p>
            </div>
            <div class="process-step">
                <div class="process-step-number">4</div>
                <h4><?php _e('Deploy & Support', 'akdisi'); ?></h4>
                <p><?php _e('Implementasi dan dukungan berkelanjutan.', 'akdisi'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2><?php _e('Siap Mengembangkan Bisnis Anda?', 'akdisi'); ?></h2>
        <p><?php _e('Konsultasikan kebutuhan sistem Anda bersama kami.', 'akdisi'); ?></p>
        <a href="#contact" class="btn btn-large"><?php _e('Mulai Konsultasi', 'akdisi'); ?></a>
    </div>
</section>

<?php
get_footer();