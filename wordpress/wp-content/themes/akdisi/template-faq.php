<?php
/**
 * FAQ Template
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: FAQ Page
 */
get_header();
?>

<section class="hero" style="padding:3rem 0;">
    <div class="container">
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <p><?php _e('Pertanyaan umum seputar layanan AKDISI.', 'akdisi'); ?></p>
    </div>
</section>

<div class="section">
    <div class="container" style="max-width:800px;">
        <?php
        $faqs = new WP_Query([
            'post_type'      => 'akdisi_faq',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
        ]);

        if ($faqs->have_posts()) :
            while ($faqs->have_posts()) : $faqs->the_post();
        ?>
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <?php the_title(); ?>
                </button>
                <div class="faq-answer">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer();