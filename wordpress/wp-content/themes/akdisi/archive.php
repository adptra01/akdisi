<?php
/**
 * Archive Template (Portfolio list, Insight list, etc.)
 * v1.3.0 — asymmetric folio grid + editorial insight list.
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();

$post_type   = get_post_type();
$is_portfolio = ( 'akdisi_portfolio' === $post_type );
$is_insight   = ( 'akdisi_insight' === $post_type );
$is_faq       = ( 'akdisi_faq' === $post_type );
$title = $is_portfolio ? __( 'Portfolio', 'akdisi' )
	: ( $is_insight ? __( 'Insights', 'akdisi' )
	: ( $is_faq ? __( 'FAQ', 'akdisi' ) : wp_strip_all_tags( get_the_archive_title() ) ) );
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<p class="eyebrow"><?php echo $is_portfolio ? esc_html__( 'Selected Work', 'akdisi' ) : esc_html__( 'Insight & Articles', 'akdisi' ); ?></p>
		<h1><?php echo esc_html( $title ); ?></h1>
		<?php if ( $is_portfolio ) : ?>
			<p><?php _e( 'Contoh solusi aplikasi yang dirancang untuk berbagai kebutuhan bisnis.', 'akdisi' ); ?></p>
		<?php elseif ( $is_insight ) : ?>
			<p><?php _e( 'Insight dan artikel seputar digitalisasi proses bisnis.', 'akdisi' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php if ( $is_portfolio ) : ?>
<div class="section">
	<div class="container">
		<?php
		$categories = get_terms( [ 'taxonomy' => 'portfolio_category', 'hide_empty' => true ] );
		if ( $categories && ! is_wp_error( $categories ) ) :
		?>
		<div class="portfolio-filters" role="group" aria-label="<?php esc_attr_e( 'Filter Portfolio', 'akdisi' ); ?>">
			<button class="portfolio-filter-btn active" data-category="all"><?php _e( 'Semua', 'akdisi' ); ?></button>
			<?php foreach ( $categories as $category ) : ?>
				<button class="portfolio-filter-btn" data-category="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></button>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<div class="folio-grid portfolio-grid js-stagger">
			<?php
			$i = 0;
			while ( have_posts() ) :
				the_post();
				$terms    = get_the_terms( get_the_ID(), 'portfolio_category' );
				$span     = ( 0 === $i ) ? 'span2' : '';
				$category = $terms && ! is_wp_error( $terms ) ? implode( ', ', wp_list_pluck( $terms, 'name' ) ) : '';
				$i++;
			?>
			<a href="<?php the_permalink(); ?>" class="card folio-item <?php echo esc_attr( $span ); ?>" data-ga-track="cta_click" data-ga-content="portfolio_archive">
				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php the_post_thumbnail_url( 'akdisi-portfolio' ); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" loading="lazy">
				<?php endif; ?>
				<div class="card-body">
					<?php if ( $category ) : ?>
						<span class="card-category"><?php echo esc_html( $category ); ?></span>
					<?php endif; ?>
					<h3><?php the_title(); ?></h3>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
					<span class="text-link"><?php _e( 'Lihat Detail', 'akdisi' ); ?>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</span>
				</div>
			</a>
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination( [ 'mid_size' => 1, 'prev_text' => '←', 'next_text' => '→' ] ); ?>
	</div>
</div>

<?php get_template_part( 'template-parts/cta-band', null, [ 'btn_ga' => 'cta_band_portfolio' ] ); ?>

<?php elseif ( $is_insight ) : ?>
<div class="section">
	<div class="container">
		<div class="post-list js-stagger">
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="post-card">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( 'akdisi-portfolio' ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"></a>
					<?php endif; ?>
					<div class="post-card-body">
						<span class="post-card-meta"><?php echo esc_html( get_the_date() ); ?></span>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
						<a href="<?php the_permalink(); ?>" class="text-link"><?php _e( 'Baca Artikel', 'akdisi' ); ?>
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
						</a>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination( [ 'mid_size' => 1, 'prev_text' => '←', 'next_text' => '→' ] ); ?>
	</div>
</div>

<?php get_template_part( 'template-parts/cta-band', null, [ 'btn_ga' => 'cta_band_insight' ] ); ?>

<?php elseif ( $is_faq ) : ?>
<div class="section">
	<div class="container">
		<div class="faq-list">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="faq-item">
					<button class="faq-question" aria-expanded="false"><?php the_title(); ?></button>
					<div class="faq-answer" style="padding-left:var(--s6);padding-right:var(--s6);"><?php the_content(); ?></div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php get_template_part( 'template-parts/cta-band', null, [ 'btn_ga' => 'cta_band_faq' ] ); ?>

<?php else : ?>
<div class="section">
	<div class="container">
		<div class="post-list">
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="post-card">
					<div class="post-card-body">
						<span class="post-card-meta"><?php echo esc_html( get_the_date() ); ?></span>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination( [ 'mid_size' => 1 ] ); ?>
	</div>
</div>
<?php endif; ?>

<?php get_footer();