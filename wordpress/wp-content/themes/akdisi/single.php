<?php
/**
 * Single Template (Portfolio detail, Insight article, generic post)
 * v1.3.0 — editorial layout: facts bar, meta blocks, gallery, related, CTA band.
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();

$post_type = get_post_type();
?>

<?php if ( 'akdisi_portfolio' === $post_type ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();
		$terms         = get_the_terms( get_the_ID(), 'portfolio_category' );
		$meta_problem  = get_post_meta( get_the_ID(), '_akdisi_problem', true );
		$meta_solution = get_post_meta( get_the_ID(), '_akdisi_solution', true );
		$meta_features = (array) get_post_meta( get_the_ID(), '_akdisi_features', true );
		$meta_outcome  = get_post_meta( get_the_ID(), '_akdisi_outcome', true );
		$meta_service  = absint( get_post_meta( get_the_ID(), '_akdisi_related_service', true ) );
		$meta_solution_slug = get_post_meta( get_the_ID(), '_akdisi_related_solution', true );
		$gallery_ids   = array_filter( array_map( 'absint', (array) get_post_meta( get_the_ID(), '_akdisi_gallery', true ) ) );
		$category_name = $terms && ! is_wp_error( $terms ) ? implode( ', ', wp_list_pluck( $terms, 'name' ) ) : __( 'Portfolio', 'akdisi' );
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-detail' ); ?>>

		<section class="page-hero" data-reveal>
			<div class="container">
				<span class="card-category"><?php echo esc_html( $category_name ); ?></span>
				<h1><?php the_title(); ?></h1>
				<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( (string) get_the_excerpt() ), 24 ) ); ?></p>
			</div>
		</section>

		<div class="section" style="padding-top:var(--s8);">
			<div class="container">

				<!-- Facts bar -->
				<dl class="facts-bar">
					<div class="fact"><dt><?php _e( 'Project Type', 'akdisi' ); ?></dt><dd><?php echo esc_html( get_post_meta( get_the_ID(), '_akdisi_project_type', true ) ?: 'Concept' ); ?></dd></div>
					<div class="fact"><dt><?php _e( 'Konteks', 'akdisi' ); ?></dt><dd><?php echo esc_html( get_post_meta( get_the_ID(), '_akdisi_context', true ) ?: 'Jambi' ); ?></dd></div>
					<div class="fact"><dt><?php _e( 'Status', 'akdisi' ); ?></dt><dd><?php echo esc_html( get_post_meta( get_the_ID(), '_akdisi_status', true ) ?: 'Concept' ); ?></dd></div>
					<div class="fact"><dt><?php _e( 'Tahun', 'akdisi' ); ?></dt><dd><?php echo esc_html( get_the_date( 'Y' ) ); ?></dd></div>
				</dl>

				<?php if ( has_post_thumbnail() ) : ?>
					<div style="margin-bottom:var(--s12);">
						<img src="<?php the_post_thumbnail_url( 'full' ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;border-radius:var(--r-lg);border:1px solid var(--line-light);box-shadow:var(--shadow-2);">
					</div>
				<?php endif; ?>

				<div style="max-width:780px;margin:0 auto;">
					<div class="entry-content">
						<?php the_content(); ?>
					</div>

					<?php if ( $meta_problem || $meta_solution || $meta_features || $meta_outcome ) : ?>
						<div class="project-meta-block">
							<div style="display:grid;grid-template-columns:1fr;gap:0 var(--s12);">
								<?php if ( $meta_problem ) : ?>
									<div>
										<h2><?php _e( 'Problem / Latar Belakang', 'akdisi' ); ?></h2>
										<p><?php echo esc_html( $meta_problem ); ?></p>
									</div>
								<?php endif; ?>
							</div>

							<?php if ( $meta_solution ) : ?>
								<h2><?php _e( 'Solusi yang Diberikan', 'akdisi' ); ?></h2>
								<p><?php echo esc_html( $meta_solution ); ?></p>
							<?php endif; ?>

							<?php if ( ! empty( $meta_features ) ) : ?>
								<h2><?php _e( 'Fitur Utama', 'akdisi' ); ?></h2>
								<ul class="feature-list">
									<?php foreach ( $meta_features as $feature ) : ?>
										<li><?php echo esc_html( $feature ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>

							<?php if ( $meta_outcome ) : ?>
								<h2><?php _e( 'Hasil / Dampak yang Diharapkan', 'akdisi' ); ?></h2>
								<p><?php echo esc_html( $meta_outcome ); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( $gallery_ids ) : ?>
						<div class="project-gallery">
							<?php foreach ( $gallery_ids as $gid ) : ?>
								<?php $gimg = wp_get_attachment_image_url( $gid, 'large' ); ?>
								<?php if ( $gimg ) : ?>
									<img src="<?php echo esc_url( $gimg ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<?php
				// Related service & solution
				$rel_service  = $meta_service ? get_post( $meta_service ) : null;
				$rel_solution = $meta_solution_slug ? get_page_by_path( 'solutions/' . $meta_solution_slug ) : null;
				if ( $rel_service || $rel_solution ) :
				?>
				<div class="related-block">
					<h3><?php _e( 'Layanan & Solusi Terkait', 'akdisi' ); ?></h3>
					<div class="related-cards">
						<?php if ( $rel_service ) : ?>
							<div class="card" style="padding:var(--s6);gap:var(--s3);">
								<span class="card-category"><?php _e( 'Layanan', 'akdisi' ); ?></span>
								<h3 style="font-size:var(--text-xl);"><?php echo esc_html( get_the_title( $rel_service ) ); ?></h3>
								<a href="<?php echo esc_url( get_permalink( $rel_service ) ); ?>" class="btn btn-secondary"><?php _e( 'Lihat Layanan', 'akdisi' ); ?></a>
							</div>
						<?php endif; ?>
						<?php if ( $rel_solution ) : ?>
							<div class="card" style="padding:var(--s6);gap:var(--s3);">
								<span class="card-category"><?php _e( 'Solusi', 'akdisi' ); ?></span>
								<h3 style="font-size:var(--text-xl);"><?php echo esc_html( get_the_title( $rel_solution ) ); ?></h3>
								<a href="<?php echo esc_url( get_permalink( $rel_solution ) ); ?>" class="btn btn-secondary"><?php _e( 'Lihat Solusi', 'akdisi' ); ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>

				<?php
				// Related portfolio by category
				if ( $terms && ! is_wp_error( $terms ) ) :
					$rel = get_posts( [
						'post_type'      => 'akdisi_portfolio',
						'posts_per_page' => 3,
						'post__not_in'   => [ get_the_ID() ],
						'tax_query'      => [
							[
								'taxonomy' => 'portfolio_category',
								'field'    => 'term_id',
								'terms'    => wp_list_pluck( $terms, 'term_id' ),
							],
						],
					] );
					if ( $rel ) :
				?>
				<div class="related-block">
					<h3><?php _e( 'Portfolio Terkait', 'akdisi' ); ?></h3>
					<div class="related-cards">
						<?php foreach ( $rel as $p ) : ?>
							<div class="card">
								<?php if ( has_post_thumbnail( $p ) ) : ?>
									<img src="<?php echo esc_url( get_the_post_thumbnail_url( $p, 'akdisi-portfolio' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" class="card-image" loading="lazy">
								<?php endif; ?>
								<div class="card-body">
									<h3 style="font-size:var(--text-lg);"><a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a></h3>
									<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( (string) $p->post_excerpt ), 14 ) ); ?></p>
									<a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="btn btn-secondary"><?php _e( 'Lihat Proyek', 'akdisi' ); ?></a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php
					endif;
				endif;
				?>

				<div style="margin-top:var(--s12);">
					<?php get_template_part( 'template-parts/cta-band', null, [ 'btn_ga' => 'cta_band_project_' . ( get_post_field( 'post_name', get_the_ID() ) ?: 'x' ) ] ); ?>
				</div>
			</div>
		</div>
	</article>
	<?php endwhile; ?>

<?php elseif ( 'akdisi_insight' === $post_type ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();
		$cats = get_the_category();
	?>
	<article id="post-<?php the_ID(); ?>">
		<section class="page-hero" data-reveal>
			<div class="container">
				<p class="eyebrow"><?php echo $cats ? esc_html( implode( ', ', wp_list_pluck( $cats, 'name' ) ) ) : esc_html__( 'Insight', 'akdisi' ); ?></p>
				<h1><?php the_title(); ?></h1>
				<div class="article-meta">
					<span><?php echo esc_html( get_the_date() ); ?></span>
					<span><?php echo esc_html( get_the_author() ); ?></span>
				</div>
			</div>
		</section>

		<div class="section">
			<div class="container">
				<?php if ( has_post_thumbnail() ) : ?>
					<div style="margin:0 auto var(--s12);max-width:960px;">
						<img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;border-radius:var(--r-lg);border:1px solid var(--line-light);">
					</div>
				<?php endif; ?>

				<div class="entry-content" style="padding-bottom:var(--s6);">
					<?php the_content(); ?>
				</div>

				<?php if ( $cats ) : ?>
					<div class="tag-pills" style="max-width:780px;margin:0 auto;">
						<?php foreach ( $cats as $c ) : ?>
							<a href="<?php echo esc_url( get_category_link( $c ) ); ?>"><?php echo esc_html( $c->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php
				// Related insight by category
				if ( $cats ) :
					$rel = get_posts( [
						'post_type'      => 'akdisi_insight',
						'posts_per_page' => 3,
						'post__not_in'   => [ get_the_ID() ],
						'category__in'   => wp_list_pluck( $cats, 'term_id' ),
					] );
					if ( $rel ) :
				?>
				<div class="related-block" style="margin-top:var(--s12);">
					<h3><?php _e( 'Insight Terkait', 'akdisi' ); ?></h3>
					<div class="related-cards">
						<?php foreach ( $rel as $p ) : ?>
							<div class="card">
								<?php if ( has_post_thumbnail( $p ) ) : ?>
									<img src="<?php echo esc_url( get_the_post_thumbnail_url( $p, 'akdisi-portfolio' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" class="card-image" loading="lazy">
								<?php endif; ?>
								<div class="card-body">
									<h3 style="font-size:var(--text-lg);"><a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a></h3>
									<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( (string) $p->post_excerpt ), 14 ) ); ?></p>
									<a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="btn btn-secondary"><?php _e( 'Baca Artikel', 'akdisi' ); ?></a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php
					endif;
				endif;
				?>

				<div style="margin-top:var(--s12);">
					<?php get_template_part( 'template-parts/cta-band', null, [ 'btn_ga' => 'cta_band_insight_single' ] ); ?>
				</div>
			</div>
		</div>
	</article>
	<?php endwhile; ?>

<?php else : ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>">
		<section class="page-hero" data-reveal>
			<div class="container">
				<h1><?php the_title(); ?></h1>
			</div>
		</section>
		<div class="section">
			<div class="container">
				<div class="entry-content"><?php the_content(); ?></div>
			</div>
		</div>
	</article>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer();