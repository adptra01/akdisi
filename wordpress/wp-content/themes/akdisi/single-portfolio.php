<?php
/**
 * Portfolio Detail Template
 * Full project detail with facts, gallery, related content, CTA
 * v1.4.0 — Precision Engineering & Architecture
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: Portfolio Detail
 */

get_header();

$status      = get_post_meta(get_the_ID(), 'status', true) ?: 'CONCEPT';
$context     = get_post_meta(get_the_ID(), 'context', true);
$problem     = get_post_meta(get_the_ID(), 'problem', true);
$solution    = get_post_meta(get_the_ID(), 'solution', true);
$features    = get_post_meta(get_the_ID(), 'features', true) ?: [];
$outcome     = get_post_meta(get_the_ID(), 'expected_outcome', true);
$related_srv = get_post_meta(get_the_ID(), 'related_service', true);
$related_sol = get_post_meta(get_the_ID(), 'related_solution', true);
$gallery     = get_post_meta(get_the_ID(), 'gallery', true) ?: [];
$cta_text    = get_post_meta(get_the_ID(), 'cta', true) ?: __('Konsultasikan Kebutuhan Anda', 'akdisi');
?>

<!-- Hero -->
<section class="page-hero" data-reveal>
    <div class="container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'akdisi'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Beranda', 'akdisi'); ?></a><span class="sep">/</span>
            <a href="<?php echo esc_url(home_url('/portfolio/')); ?>"><?php _e('Portfolio', 'akdisi'); ?></a><span class="sep">/</span>
            <span aria-current="page"><?php the_title(); ?></span>
        </nav>
        <p class="eyebrow"><?php echo esc_html($status); ?> &middot; <?php echo esc_html($context); ?></p>
        <h1><?php the_title(); ?></h1>
        <?php if ($problem) : ?>
        <p class="hero-sub"><?php echo esc_html(wp_trim_words($problem, 30)); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Problem & Solution -->
<?php if ($problem || $solution) : ?>
<section class="section">
    <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s12);">
        <?php if ($problem) : ?>
        <div data-reveal>
            <p class="eyebrow"><?php _e('Problem', 'akdisi'); ?></p>
            <p style="font-size:var(--text-lg);color:var(--text-muted-light);"><?php echo esc_html($problem); ?></p>
        </div>
        <?php endif; ?>
        <?php if ($solution) : ?>
        <div data-reveal>
            <p class="eyebrow"><?php _e('Solution', 'akdisi'); ?></p>
            <p style="font-size:var(--text-lg);color:var(--text-muted-light);"><?php echo esc_html($solution); ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- Features -->
<?php if (!empty($features) && is_array($features)) : ?>
<section class="section section-alt">
    <div class="container">
        <p class="eyebrow"><?php _e('Key Features', 'akdisi'); ?></p>
        <div class="feature-grid js-stagger" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:var(--s6);margin-top:var(--s6);">
            <?php foreach ($features as $i => $feature) : ?>
            <div class="feature-item" data-index="<?php echo esc_attr($i); ?>" data-reveal>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="width:20px;height:20px;color:var(--primary);flex-shrink:0;"><path d="M20 6L9 17l-5-5"/></svg>
                <span><?php echo esc_html($feature); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Gallery -->
<?php if (!empty($gallery) && is_array($gallery)) : ?>
<section class="section">
    <div class="container">
        <p class="eyebrow"><?php _e('Screens', 'akdisi'); ?></p>
        <div class="gallery-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:var(--s4);margin-top:var(--s6);">
            <?php foreach ($gallery as $img) : ?>
            <div data-reveal style="border-radius:var(--radius-lg);overflow:hidden;border:1px solid var(--color-border);">
                <?php if (is_array($img) && isset($img['url'])) : ?>
                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" style="width:100%;display:block;">
                <?php else : ?>
                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" style="width:100%;display:block;">
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Outcome -->
<?php if ($outcome) : ?>
<section class="section section-alt">
    <div class="container" style="max-width:800px;text-align:center;">
        <p class="eyebrow"><?php _e('Expected Outcome', 'akdisi'); ?></p>
        <p style="font-size:var(--text-lg);color:var(--text-muted-light);"><?php echo esc_html($outcome); ?></p>
    </div>
</section>
<?php endif; ?>

<!-- Related Service -->
<?php if ($related_srv) :
    $srv = get_post($related_srv);
    if ($srv) :
?>
<section class="section section-dark">
    <div class="container">
        <p class="eyebrow"><?php _e('Related Service', 'akdisi'); ?></p>
        <h2 style="font-size:var(--text-2xl);margin-bottom:var(--s4);"><a href="<?php echo esc_url(get_permalink($srv->ID)); ?>" style="color:inherit;"><?php echo esc_html($srv->post_title); ?></a></h2>
        <p style="color:var(--text-muted-dark);"><?php echo esc_html(wp_trim_words($srv->post_content, 30)); ?></p>
        <a href="<?php echo esc_url(get_permalink($srv->ID)); ?>" class="btn btn-accent btn-large magnetic" data-ga-track="cta_click" data-ga-content="related_service"><?php _e('View Service', 'akdisi'); ?>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
    </div>
</section>
<?php endif; endif; ?>

<!-- Related Portfolio -->
<?php
$cats = wp_get_post_terms(get_the_ID(), 'portfolio_category', ['fields' => 'ids']);
$related = get_posts([
    'post_type'      => 'akdisi_portfolio',
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'tax_query'      => $cats ? [['taxonomy' => 'portfolio_category', 'field' => 'term_id', 'terms' => $cats]] : [],
    'post_status'    => 'publish',
]);
if ($related) :
?>
<section class="section">
    <div class="container">
        <p class="eyebrow"><?php _e('Related Projects', 'akdisi'); ?></p>
        <div class="related-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:var(--s6);margin-top:var(--s6);">
            <?php foreach ($related as $rp) : ?>
            <a href="<?php echo esc_url(get_permalink($rp->ID)); ?>" class="related-card" data-reveal style="display:block;border:1px solid var(--color-border);border-radius:var(--radius-lg);padding:var(--s6);transition:border-color 0.2s ease;">
                <p class="eyebrow"><?php echo esc_html(get_post_meta($rp->ID, 'status', true) ?: 'CONCEPT'); ?></p>
                <h3 style="font-size:var(--text-xl);"><?php echo esc_html($rp->post_title); ?></h3>
                <p style="color:var(--text-muted-light);margin-top:var(--s2);"><?php echo esc_html(wp_trim_words($rp->post_content, 20)); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<!-- CTA Band -->
<?php get_template_part('template-parts/cta-band', null, [
    'title'     => __('Tertarik dengan solusi serupa?', 'akdisi'),
    'text'      => __('Konsultasikan kebutuhan Anda — kami akan membantu menemukan pendekatan yang tepat.', 'akdisi'),
    'btn_url'   => home_url('/contact/'),
    'btn_label' => $cta_text,
    'btn_ga'    => 'portfolio_cta',
]); ?>

<?php get_footer(); ?>
