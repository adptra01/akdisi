<?php
/**
 * Generic Page Template
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();
?>

<section class="section">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="entry-content mt-8">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php
        endwhile;
        ?>
    </div>
</section>

<?php
get_footer();