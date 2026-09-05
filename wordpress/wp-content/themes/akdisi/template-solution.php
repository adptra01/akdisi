<?php
/**
 * Solution Detail Template (Housing / Developer / Property / Organization)
 * PRD BAGIAN H — capability list driven by page content.
 *
 * @package AKDISI
 * @since 1.1.0
 *
 * Template Name: Solution Detail
 */

get_header();

// Previous/next solution links.
$solution_slugs = ['housing', 'developer', 'property', 'organization'];
$current_post   = get_post();
$current_slug   = $current_post ? basename((string) get_permalink($current_post)) : '';
?>

<section class="hero" style="padding:3rem 0;">
    <div class="container">
        <p style="margin-bottom:0.5rem;color:var(--color-neutral-500);font-size:0.875rem;">
            <a href="<?php echo esc_url(home_url('/solutions/')); ?>"><?php _e('Solusi', 'akdisi'); ?></a> &raquo;
        </p>
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <p><?php _e('Kemampuan yang dapat disesuaikan dengan kebutuhan organisasi Anda.', 'akdisi'); ?></p>
    </div>
</section>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="section">
    <div class="container entry-content">
        <?php the_content(); ?>
    </div>
</div>
<?php endwhile; endif; ?>

<!-- Related solutions -->
<div class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Solusi Lainnya', 'akdisi'); ?></h2>
        </div>
        <div class="card-grid">
            <?php
            $solutions = [
                'housing'      => [__('Perumahan', 'akdisi'), __('Pengelolaan kawasan dan layanan penghuni.', 'akdisi')],
                'developer'    => [__('Developer', 'akdisi'), __('Mendukung proses bisnis developer.', 'akdisi')],
                'property'     => [__('Properti', 'akdisi'), __('Pengelolaan bisnis properti.', 'akdisi')],
                'organization' => [__('Organisasi', 'akdisi'), __('Administrasi dan pengelolaan organisasi.', 'akdisi')],
            ];
            foreach ($solutions as $slug => $data) :
                if ($slug === $current_slug) {
                    continue;
                }
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

<!-- Related services & portfolio (PRD §90) -->
<?php
$rel_portfolio = get_posts([
    'post_type'      => 'akdisi_portfolio',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'meta_key'       => '_akdisi_related_solution',
    'meta_value'     => $current_slug,
]);
$service_ids = [50, 51, 52, 53]; // application-development, business-process-digitalization, data-administration-systems, custom-business-solutions
?>
<div class="section">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Layanan & Portfolio Terkait', 'akdisi'); ?></h2>
        </div>
        <div class="related-cards">
            <?php foreach ($service_ids as $sid) : ?>
                <?php $svc = get_post($sid); ?>
                <?php if ($svc && 'publish' === $svc->post_status) : ?>
                <div class="card">
                    <span class="card-category"><?php _e('Layanan', 'akdisi'); ?></span>
                    <h3><?php echo esc_html(get_the_title($svc)); ?></h3>
                    <a href="<?php echo esc_url(get_permalink($svc)); ?>" class="btn btn-secondary"><?php _e('Lihat Layanan', 'akdisi'); ?></a>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php foreach ($rel_portfolio as $p) : ?>
                <div class="card">
                    <span class="card-category"><?php _e('Portfolio', 'akdisi'); ?></span>
                    <h3><?php echo esc_html(get_the_title($p)); ?></h3>
                    <p style="font-size:0.875rem;"><?php echo esc_html(get_the_excerpt($p)); ?></p>
                    <a href="<?php echo esc_url(get_permalink($p)); ?>" class="btn btn-secondary"><?php _e('Lihat Portfolio', 'akdisi'); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-section">
    <div class="container">
        <h2><?php _e('Butuh solusi yang disesuaikan dengan proses bisnis Anda?', 'akdisi'); ?></h2>
        <p><?php _e('Kami siap membantu Anda dari tahap konsultasi hingga implementasi.', 'akdisi'); ?></p>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-large"><?php _e('Konsultasikan Sekarang', 'akdisi'); ?></a>
    </div>
</div>

<?php get_footer();