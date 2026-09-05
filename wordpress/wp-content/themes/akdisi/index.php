<?php
/**
 * Index Template — fallback (front page via front-page.php; search via index.php).
 * v1.3.0 — minimal editorial list.
 *
 * @package AKDISI
 * @since 1.0.0
 */
get_header();

$is_search = is_search();
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<p class="eyebrow"><?php echo $is_search ? esc_html__( 'Search', 'akdisi' ) : esc_html__( 'Blog', 'akdisi' ); ?></p>
		<h1>
			<?php
			if ( $is_search ) {
				printf( /* translators: %s: search query */ esc_html__( 'Hasil Pencarian: “%s”', 'akdisi' ), esc_html( get_search_query() ) );
			} else {
				esc_html_e( 'Artikel', 'akdisi' );
			}
			?>
		</h1>
		<?php if ( $is_search ) : ?>
			<p><?php _e( 'Hasil yang cocok dengan kata kunci Anda.', 'akdisi' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<div class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
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
					<a href="<?php the_permalink(); ?>" class="text-link"><?php _e( 'Baca Selengkapnya', 'akdisi' ); ?>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination( [ 'mid_size' => 1 ] ); ?>
		<?php else : ?>
			<div style="text-align:center;padding:var(--s12) 0;">
				<p class="serif" style="font-size:var(--text-3xl);color:var(--text-muted-light);">0</p>
				<h2><?php _e( 'Tidak Ada Hasil', 'akdisi' ); ?></h2>
				<p style="color:var(--text-muted-light);margin:var(--s3) auto var(--s8);max-width:40ch;"><?php _e( 'Coba kata kunci lain atau lihat layanan kami untuk menemukan yang Anda butuhkan.', 'akdisi' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn-accent magnetic"><?php _e( 'Lihat Layanan', 'akdisi' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php get_footer();