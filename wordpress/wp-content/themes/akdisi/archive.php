<?php
/**
 * Archive Template (Portfolio list, Insight list, etc.)
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();
?>

<?php
// Determine post type
$post_type = get_post_type();
$is_portfolio = ($post_type === 'akdisi_portfolio');
$is_insight = ($post_type === 'akdisi_insight');
$is_faq = ($post_type === 'akdisi_faq');
$title = $is_portfolio ? __('Portfolio', 'akdisi') : ($is_insight ? __('Insights', 'akdisi') : ($is_faq ? __('FAQ', 'akdisi') : get_the_archive_title()));
?>

<section class="hero" style="padding:3rem 0;">
    <div class="container">
        <h1><?php echo esc_html($title); ?></h1>
        <?php if ($is_portfolio) : ?>
            <p><?php _e('Contoh solusi aplikasi untuk berbagai kebutuhan bisnis.', 'akdisi'); ?></p>
        <?php elseif ($is_insight) : ?>
            <p><?php _e('Insight dan artikel seputar digitalisasi proses bisnis.', 'akdisi'); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php if ($is_portfolio) : ?>
<div class="section">
    <div class="container">
        <?php
        $categories = get_terms(['taxonomy' => 'portfolio_category', 'hide_empty' => true]);
        ?>
        <div class="portfolio-filters">
            <button class="portfolio-filter-btn active" data-category="all"><?php _e('Semua', 'akdisi'); ?></button>
            <?php foreach ($categories as $category) : ?>
                <button class="portfolio-filter-btn" data-category="<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></button>
            <?php endforeach; ?>
        </div>
        <div class="card-grid portfolio-grid">
        <?php
        while (have_posts()) : the_post();
            $terms = get_the_terms(get_the_ID(), 'portfolio_category');
        ?>
            <div class="card portfolio-item">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('akdisi-portfolio'); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" loading="lazy">
                <?php else : ?>
                    <div style="width:100%;height:200px;background:var(--color-neutral-200);display:flex;align-items:center;justify-content:center;">
                        <span style="color:var(--color-neutral-400);"><?php _e('No Image', 'akdisi'); ?></span>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <?php if ($terms && !is_wp_error($terms)) : ?>
                        <span class="card-category"><?php echo esc_html(implode(', ', wp_list_pluck($terms, 'name'))); ?></span>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-secondary" style="margin-top:1rem;"><?php _e('Lihat Detail', 'akdisi'); ?></a>
                </div>
            </div>
        <?php
        endwhile;
        ?>
        </div>

        <?php
        the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => __('&laquo; Prev', 'akdisi'),
            'next_text' => __('Next &raquo;', 'akdisi'),
        ]);
        ?>
    </div>
</div>
<?php elseif ($is_insight) : ?>
<div class="section">
    <div class="container">
        <div class="card-grid">
        <?php
        while (have_posts()) : the_post();
        ?>
            <div class="card">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_post_thumbnail_url('akdisi-portfolio'); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" loading="lazy">
                    </a>
                <?php endif; ?>
                <div class="card-body">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                    <p style="font-size:0.8rem;color:var(--color-neutral-500);margin-top:1rem;">
                        <?php echo esc_html(get_the_date()); ?>
                    </p>
                </div>
            </div>
        <?php
        endwhile;
        ?>
        </div>
        <?php
        the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => __('&laquo; Prev', 'akdisi'),
            'next_text' => __('Next &raquo;', 'akdisi'),
        ]);
        ?>
    </div>
</div>
<?php else : ?>
<div class="section">
    <div class="container">
        <?php
        if (have_posts()) {
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        } else {
            echo '<p>' . esc_html__('No content found.', 'akdisi') . '</p>';
        }
        ?>
    </div>
</div>
<?php endif; ?>

<?php
get_footer();