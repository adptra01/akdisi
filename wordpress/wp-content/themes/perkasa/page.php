<?php
/**
 * Generic page fallback — Garuda Perkasa v3.
 *
 * @package Garuda_Perkasa
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main id="perkasa-main">
		<?php
		get_template_part(
			'template-parts/page-hero',
			null,
			array(
				'title'   => get_the_title(),
				'eyebrow' => 'Halaman',
			)
		);
		?>

		<section class="bg-paper py-16 lg:py-24">
			<div class="mx-auto max-w-3xl px-5">
				<article class="entry-content" <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>
			</div>
		</section>
	</main>
	<?php
endwhile;

get_footer();