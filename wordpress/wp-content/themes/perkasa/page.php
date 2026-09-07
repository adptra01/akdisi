<?php
/**
 * Generic page fallback.
 *
 * @package Perkasa
 */
get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title' => get_the_title(),
) );
?>

<section class="section">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="prose max-w-3xl">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
