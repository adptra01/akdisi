<?php
/**
 * Insight Detail Template
 * Article detail with related content, CTA
 * v1.4.0 — Precision Engineering & Architecture
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: Insight Detail
 */

get_header();

$category = get_the_category();
$cat_name = $category ? $category[0]->name : '';
?>

<!-- Hero -->
<section class="page-hero" data-reveal>
    <div class="container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'akdisi'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Beranda', 'akdisi'); ?></a><span class="sep">/</span>
            <a href="<?php echo esc_url(home_url('/insight/')); ?>"><?php _e('Insight', 'akdisi'); ?></a><span class="sep">/</span>
            <span aria-current="page"><?php the_title(); ?></span>
        </nav>
        <p class="eyebrow"><?php echo esc_html($cat_name); ?> &middot; <?php echo get_the_date(); ?></p>
        <h1><?php the_title(); ?></h1>
        <?php if (has_excerpt()) : ?>
        <p class="hero-sub"><?php the_excerpt(); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Article Content -->
<section class="section">
    <div class="container" style="max-width:780px;">
        <article class="entry-content" data-reveal>
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </article>
    </div>
</section>

<!-- Related Insights -->
<?php
$related_insights = get_posts([
    'post_type'      => 'akdisi_insight',
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
if ($related_insights) :
?>
<section class="section section-alt">
    <div class="container">
        <p class="eyebrow"><?php _e('Insight Terkait', 'akdisi'); ?></p>
        <div class="related-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:var(--s6);margin-top:var(--s6);">
            <?php foreach ($related_insights as $ri) : ?>
            <a href="<?php echo esc_url(get_permalink($ri->ID)); ?>" class="related-card" data-reveal style="display:block;border:1px solid var(--color-border);border-radius:var(--radius-lg);padding:var(--s6);transition:border-color 0.2s ease;">
                <p class="eyebrow"><?php echo esc_html(get_the_category($ri->ID)[0]->name ?? ''); ?></p>
                <h3 style="font-size:var(--text-xl);"><?php echo esc_html($ri->post_title); ?></h3>
                <p style="color:var(--text-muted-light);margin-top:var(--s2);"><?php echo esc_html(wp_trim_words($ri->post_content, 20)); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<!-- CTA Band -->
<?php get_template_part('template-parts/cta-band', null, [
    'title'     => __('Punya pertanyaan seputar topik ini?', 'akdisi'),
    'text'      => __('Kami siap membantu Anda menemukan solusi yang tepat.', 'akdisi'),
    'btn_url'   => home_url('/contact/'),
    'btn_label' => __('Konsultasikan Kebutuhan Anda', 'akdisi'),
    'btn_ga'    => 'insight_cta',
]); ?>

<?php get_footer(); ?>
