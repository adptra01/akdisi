<?php
/**
 * Solutions Landing Template
 * PRD BAGIAN H — "Apa yang dapat dilakukan AKDISI untuk industri saya?"
 *
 * @package AKDISI
 * @since 1.1.0
 *
 * Template Name: Solutions Page
 */

get_header();
?>

<section class="hero" style="padding:3rem 0;">
    <div class="container">
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <p><?php _e('Solusi aplikasi yang dirancang untuk kebutuhan bisnis Anda di berbagai sektor.', 'akdisi'); ?></p>
    </div>
</section>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if (trim((string) get_the_content())) : ?>
    <div class="section">
        <div class="container">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php endwhile; endif; ?>

<div class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Solusi Berdasarkan Sektor', 'akdisi'); ?></h2>
            <p><?php _e('Konteks yang sering kami tangani — hubungi kami untuk kebutuhan lainnya.', 'akdisi'); ?></p>
        </div>
        <div class="card-grid">
            <?php
            $solutions = [
                'housing'      => [__('Perumahan', 'akdisi'), __('Solusi untuk pengelolaan kawasan dan layanan penghuni.', 'akdisi')],
                'developer'    => [__('Developer', 'akdisi'), __('Solusi untuk mendukung proses bisnis developer.', 'akdisi')],
                'property'     => [__('Properti', 'akdisi'), __('Solusi untuk pengelolaan bisnis properti.', 'akdisi')],
                'organization' => [__('Organisasi', 'akdisi'), __('Solusi untuk administrasi dan pengelolaan organisasi.', 'akdisi')],
            ];
            foreach ($solutions as $slug => $data) :
            ?>
            <div class="card">
                <div class="card-body">
                    <h3><?php echo esc_html($data[0]); ?></h3>
                    <p><?php echo esc_html($data[1]); ?></p>
                    <a href="<?php echo esc_url(home_url('/solutions/' . $slug . '/')); ?>" class="btn btn-secondary" style="margin-top:1rem;"><?php _e('Lihat Solusi', 'akdisi'); ?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-section">
    <div class="container">
        <h2><?php _e('Punya proses bisnis yang ingin dibuat lebih terstruktur?', 'akdisi'); ?></h2>
        <p><?php _e('Diskusikan kebutuhan industri Anda bersama kami.', 'akdisi'); ?></p>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-large"><?php _e('Konsultasikan Sekarang', 'akdisi'); ?></a>
    </div>
</div>

<?php get_footer();