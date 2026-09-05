<?php
/**
 * Service Detail Template
 * PRD BAGIAN G §37 — Hero → Problem → Target → Use Cases → What We Can Build → Benefits → Process → FAQ → CTA
 * Section structure driven by page content (H2 sections, admin editable).
 *
 * @package AKDISI
 * @since 1.1.0
 *
 * Template Name: Service Detail
 */

get_header();
?>

<section class="hero" style="padding:3rem 0;">
    <div class="container">
        <p style="margin-bottom:0.5rem;color:var(--color-neutral-500);font-size:0.875rem;">
            <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php _e('Layanan', 'akdisi'); ?></a> &raquo;
        </p>
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <p><?php _e('Layanan yang dapat disesuaikan dengan kebutuhan dan proses bisnis organisasi Anda.', 'akdisi'); ?></p>
    </div>
</section>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="section">
    <div class="container entry-content">
        <?php the_content(); ?>
    </div>
</div>
<?php endwhile; endif; ?>

<!-- Related solutions & portfolio (PRD §90) -->
<?php
$service_id = get_the_ID();
$rel_portfolio = get_posts([
    'post_type'      => 'akdisi_portfolio',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'meta_key'       => '_akdisi_related_service',
    'meta_value'     => $service_id,
    'meta_type'      => 'NUMERIC',
]);
?>
<div class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Solusi & Portfolio Terkait', 'akdisi'); ?></h2>
        </div>
        <div class="related-cards">
            <?php foreach (['housing', 'developer', 'property', 'organization'] as $slug) : ?>
                <?php $sol = get_page_by_path('solutions/' . $slug); ?>
                <?php if ($sol) : ?>
                <div class="card">
                    <span class="card-category"><?php _e('Solusi', 'akdisi'); ?></span>
                    <h3><?php echo esc_html(get_the_title($sol)); ?></h3>
                    <p style="font-size:0.875rem;"><?php echo esc_html(get_the_excerpt($sol)); ?></p>
                    <a href="<?php echo esc_url(get_permalink($sol)); ?>" class="btn btn-secondary"><?php _e('Lihat Solusi', 'akdisi'); ?></a>
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

<!-- FAQ -->
<?php
$faq_query = new WP_Query([
    'post_type'      => 'akdisi_faq',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
if ($faq_query->have_posts()) :
?>
<div class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Pertanyaan Umum', 'akdisi'); ?></h2>
        </div>
        <div class="faq-list">
            <?php
            $faq_index = 0;
            while ($faq_query->have_posts()) :
                $faq_query->the_post();
                $faq_index++;
            ?>
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <?php the_title(); ?>
                    <span class="faq-icon" aria-hidden="true">+</span>
                </button>
                <div class="faq-answer">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php
    wp_reset_postdata();
endif;
?>

<!-- CTA -->
<div class="cta-section">
    <div class="container">
        <h2><?php _e('Diskusikan kebutuhan Anda dengan kami', 'akdisi'); ?></h2>
        <p><?php _e('Tidak yakin layanan mana yang tepat? Kami siap membantu Anda memetakannya.', 'akdisi'); ?></p>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-large"><?php _e('Konsultasikan Sekarang', 'akdisi'); ?></a>
    </div>
</div>

<?php get_footer();