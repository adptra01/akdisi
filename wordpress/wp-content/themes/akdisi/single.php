<?php
/**
 * Single Template (Post detail) - handles portfolio, insight, FAQ detail
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();

$post_type = get_post_type();
?>

<?php if ($post_type === 'akdisi_portfolio') : ?>
    <?php
    while (have_posts()) : the_post();
        $terms = get_the_terms(get_the_ID(), 'portfolio_category');
        $meta_problem  = get_post_meta(get_the_ID(), '_akdisi_problem', true);
        $meta_solution = get_post_meta(get_the_ID(), '_akdisi_solution', true);
        $meta_features = (array) get_post_meta(get_the_ID(), '_akdisi_features', true);
        $meta_outcome  = get_post_meta(get_the_ID(), '_akdisi_outcome', true);
        $meta_service  = absint(get_post_meta(get_the_ID(), '_akdisi_related_service', true));
        $meta_solution_slug = get_post_meta(get_the_ID(), '_akdisi_related_solution', true);
        $gallery_ids   = array_filter(array_map('absint', (array) get_post_meta(get_the_ID(), '_akdisi_gallery', true)));
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-detail'); ?>>
        <section class="page-hero">
            <div class="container">
                <span class="card-category" style="margin-bottom:1rem;">
                    <?php echo $terms ? esc_html(implode(', ', wp_list_pluck($terms, 'name'))) : __('Portfolio', 'akdisi'); ?>
                </span>
                <h1><?php the_title(); ?></h1>
                <span class="concept-badge"><?php _e('Concept Project', 'akdisi'); ?></span>
            </div>
        </section>

        <div class="container">
            <?php if (has_post_thumbnail()) : ?>
                <div style="margin-bottom:2rem;">
                    <img src="<?php the_post_thumbnail_url('akdisi-hero'); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" style="width:100%;border-radius:8px;">
                </div>
            <?php endif; ?>

            <div class="card-grid" style="grid-template-columns:1fr;margin-bottom:2rem;">
                <div class="project-info">
                    <dl>
                        <dt><?php _e('Project Type', 'akdisi'); ?></dt>
                        <dd><?php echo esc_html(get_post_meta(get_the_ID(), '_akdisi_project_type', true) ?: 'Concept'); ?></dd>
                        <dt><?php _e('Location / Konteks', 'akdisi'); ?></dt>
                        <dd><?php echo esc_html(get_post_meta(get_the_ID(), '_akdisi_context', true) ?: 'Jambi'); ?></dd>
                        <dt><?php _e('Status', 'akdisi'); ?></dt>
                        <dd><?php echo esc_html(get_post_meta(get_the_ID(), '_akdisi_status', true) ?: 'Concept'); ?></dd>
                    </dl>
                </div>
            </div>

            <div class="container" style="max-width:800px;padding:0;">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <?php if ($meta_problem || $meta_solution || $meta_features || $meta_outcome) : ?>
                <div class="project-meta-block">
                    <?php if ($meta_problem) : ?>
                        <h2><?php _e('Problem / Latar Belakang', 'akdisi'); ?></h2>
                        <p><?php echo esc_html($meta_problem); ?></p>
                    <?php endif; ?>

                    <?php if ($meta_solution) : ?>
                        <h2><?php _e('Solusi yang Diberikan', 'akdisi'); ?></h2>
                        <p><?php echo esc_html($meta_solution); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($meta_features)) : ?>
                        <h2><?php _e('Fitur Utama', 'akdisi'); ?></h2>
                        <ul>
                            <?php foreach ($meta_features as $feature) : ?>
                                <li><?php echo esc_html($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($meta_outcome) : ?>
                        <h2><?php _e('Hasil / Dampak yang Diharapkan', 'akdisi'); ?></h2>
                        <p><?php echo esc_html($meta_outcome); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ($gallery_ids) : ?>
                    <div class="project-gallery">
                        <?php foreach ($gallery_ids as $gid) : ?>
                            <?php $gimg = wp_get_attachment_image_url($gid, 'large'); ?>
                            <?php if ($gimg) : ?>
                                <img src="<?php echo esc_url($gimg); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php
                // Related service & solution block
                $rel_service  = $meta_service ? get_post($meta_service) : null;
                $rel_solution = $meta_solution_slug ? get_page_by_path('solutions/' . $meta_solution_slug) : null;
                if ($rel_service || $rel_solution) :
                ?>
                <div class="related-block">
                    <h3><?php _e('Layanan & Solusi Terkait', 'akdisi'); ?></h3>
                    <div class="related-cards">
                        <?php if ($rel_service) : ?>
                            <div class="card">
                                <span class="card-category"><?php _e('Layanan', 'akdisi'); ?></span>
                                <h4><?php echo esc_html(get_the_title($rel_service)); ?></h4>
                                <a href="<?php echo esc_url(get_permalink($rel_service)); ?>" class="btn btn-secondary"><?php _e('Lihat Layanan', 'akdisi'); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if ($rel_solution) : ?>
                            <div class="card">
                                <span class="card-category"><?php _e('Solusi', 'akdisi'); ?></span>
                                <h4><?php echo esc_html(get_the_title($rel_solution)); ?></h4>
                                <a href="<?php echo esc_url(get_permalink($rel_solution)); ?>" class="btn btn-secondary"><?php _e('Lihat Solusi', 'akdisi'); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php
                // Related portfolio by category
                if ($terms && !is_wp_error($terms)) :
                    $rel = get_posts([
                        'post_type'      => 'akdisi_portfolio',
                        'posts_per_page' => 3,
                        'post__not_in'   => [get_the_ID()],
                        'tax_query'      => [
                            [
                                'taxonomy' => 'portfolio_category',
                                'field'    => 'term_id',
                                'terms'    => wp_list_pluck($terms, 'term_id'),
                            ],
                        ],
                    ]);
                    if ($rel) :
                ?>
                <div class="related-block">
                    <h3><?php _e('Portfolio Terkait', 'akdisi'); ?></h3>
                    <div class="related-cards">
                        <?php foreach ($rel as $r) : ?>
                            <div class="card">
                                <h4><?php echo esc_html(get_the_title($r)); ?></h4>
                                <p style="font-size:0.875rem;"><?php echo esc_html(get_the_excerpt($r)); ?></p>
                                <a href="<?php echo esc_url(get_permalink($r)); ?>" class="btn btn-secondary"><?php _e('Lihat Detail', 'akdisi'); ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
                    endif;
                endif;
                ?>

                <!-- CTA -->
                <div class="cta-section" style="border-radius:8px;margin-top:2rem;">
                    <div class="container">
                        <h2><?php _e('Membutuhkan Solusi Serupa?', 'akdisi'); ?></h2>
                        <p><?php _e('Diskusikan kebutuhan sistem Anda dengan kami.', 'akdisi'); ?></p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact')->ID ?? 0)); ?>" class="btn btn-large"><?php _e('Hubungi Kami', 'akdisi'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php endwhile; ?>

<?php elseif ($post_type === 'akdisi_insight') : ?>
    <?php
    while (have_posts()) : the_post();
        $cats = get_the_category();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="page-hero">
            <div class="container" style="max-width:800px;">
                <h1><?php the_title(); ?></h1>
                <p style="font-size:0.9rem;margin-top:1rem;"><?php _e('Published on', 'akdisi'); ?> <?php echo esc_html(get_the_date()); ?></p>
            </div>
        </section>
        <div class="section">
            <div class="container" style="max-width:800px;">
                <?php if (has_post_thumbnail()) : ?>
                    <div style="margin-bottom:2rem;">
                        <img src="<?php the_post_thumbnail_url('akdisi-hero'); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" style="width:100%;border-radius:8px;">
                    </div>
                <?php endif; ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <?php
                // Related insight by category
                if ($cats) :
                    $rel = get_posts([
                        'post_type'      => 'akdisi_insight',
                        'posts_per_page' => 3,
                        'post__not_in'   => [get_the_ID()],
                        'category__in'   => wp_list_pluck($cats, 'term_id'),
                    ]);
                    if ($rel) :
                ?>
                <div class="related-block">
                    <h3><?php _e('Insight Terkait', 'akdisi'); ?></h3>
                    <div class="related-cards">
                        <?php foreach ($rel as $r) : ?>
                            <div class="card">
                                <h4><?php echo esc_html(get_the_title($r)); ?></h4>
                                <p style="font-size:0.875rem;"><?php echo esc_html(get_the_excerpt($r)); ?></p>
                                <a href="<?php echo esc_url(get_permalink($r)); ?>" class="btn btn-secondary"><?php _e('Baca Artikel', 'akdisi'); ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
                    endif;
                endif;
                ?>

                <div class="cta-section" style="border-radius:8px;margin-top:2rem;">
                    <div class="container">
                        <h2><?php _e('Perlu Bantuan Menerapkan Ini?', 'akdisi'); ?></h2>
                        <p><?php _e('Konsultasikan kebutuhan digitalisasi bisnis Anda.', 'akdisi'); ?></p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact')->ID ?? 0)); ?>" class="btn btn-large"><?php _e('Hubungi AKDISI', 'akdisi'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php endwhile; ?>

<?php elseif ($post_type === 'akdisi_faq') : ?>
    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="page-hero">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </section>
        <div class="section">
            <div class="container" style="max-width:800px;">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </article>
    <?php endwhile; ?>

<?php else : ?>
    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="page-hero">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </section>
        <div class="section">
            <div class="container" style="max-width:800px;">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </article>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer();