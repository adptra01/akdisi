<?php
/**
 * Service Detail Template
 * PRD BAGIAN G §37 — konten H2-driven, related solutions/portfolio (PRD §90), FAQ, CTA.
 * v1.3.0 — editorial layout.
 *
 * @package AKDISI
 * @since 1.1.0
 *
 * Template Name: Service Detail
 */

get_header();
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'akdisi' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Beranda', 'akdisi' ); ?></a><span class="sep">/</span>
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php _e( 'Layanan', 'akdisi' ); ?></a><span class="sep">/</span>
			<span aria-current="page"><?php echo esc_html( get_the_title() ); ?></span>
		</nav>
		<h1 style="margin-top:var(--s4);"><?php echo esc_html( get_the_title() ); ?></h1>
		<p><?php _e( 'Layanan yang dapat disesuaikan dengan kebutuhan dan proses bisnis organisasi Anda.', 'akdisi' ); ?></p>
	</div>
</section>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="section">
	<div class="container entry-content" style="font-size:var(--text-lg);">
		<?php the_content(); ?>
	</div>
</div>
<?php endwhile; endif; ?>

<?php
$service_id    = get_the_ID();
$rel_portfolio = get_posts( [
	'post_type'      => 'akdisi_portfolio',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'meta_key'       => '_akdisi_related_service',
	'meta_value'     => $service_id,
	'meta_type'      => 'NUMERIC',
] );
$solutions = [];
foreach ( [ 'housing', 'developer', 'property', 'organization' ] as $slug ) {
	$sol = get_page_by_path( 'solutions/' . $slug );
	if ( $sol ) { $solutions[] = $sol; }
}
if ( $solutions || $rel_portfolio ) :
?>
<div class="section section-dark">
	<div class="container">
		<p class="eyebrow"><?php _e( 'Related', 'akdisi' ); ?></p>
		<h2 class="section-title" style="font-size:var(--text-2xl);"><?php _e( 'Solusi & Portfolio Terkait', 'akdisi' ); ?></h2>

		<?php if ( $solutions ) : ?>
		<div class="solution-list js-stagger" style="margin-top:var(--s6);">
			<?php foreach ( $solutions as $i => $sol ) : ?>
			<a href="<?php echo esc_url( get_permalink( $sol ) ); ?>" class="solution-row" data-ga-track="cta_click" data-ga-content="service_solution_<?php echo esc_attr( $sol->post_name ); ?>">
				<span class="solution-index">0<?php echo esc_html( $i + 1 ); ?></span>
				<div>
					<h3><?php echo esc_html( get_the_title( $sol ) ); ?></h3>
					<p><?php echo esc_html( get_the_excerpt( $sol ) ); ?></p>
				</div>
				<span class="text-link"><?php _e( 'Lihat Solusi', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</span>
			</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<?php if ( $rel_portfolio ) : ?>
		<div class="related-cards js-stagger" style="margin-top:var(--s8);">
			<?php foreach ( $rel_portfolio as $p ) : ?>
				<div class="card">
					<?php if ( has_post_thumbnail( $p ) ) : ?>
						<img src="<?php echo esc_url( get_the_post_thumbnail_url( $p, 'akdisi-portfolio' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" class="card-image" loading="lazy">
					<?php endif; ?>
					<div class="card-body">
						<span class="card-category"><?php _e( 'Portfolio', 'akdisi' ); ?></span>
						<h3 style="font-size:var(--text-lg);"><a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $p ), 14 ) ); ?></p>
						<a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="btn btn-secondary"><?php _e( 'Lihat Portfolio', 'akdisi' ); ?></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<?php
$faq_query = new WP_Query( [
	'post_type'      => 'akdisi_faq',
	'posts_per_page' => 5,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
] );
if ( $faq_query->have_posts() ) :
?>
<div class="section section-light">
	<div class="container">
		<div class="section-header" style="text-align:center;">
			<p class="eyebrow" style="justify-content:center;"><?php _e( 'FAQ', 'akdisi' ); ?></p>
			<h2 class="section-title"><?php _e( 'Pertanyaan Umum', 'akdisi' ); ?></h2>
		</div>
		<div class="faq-list" style="margin-top:var(--s8);">
			<?php while ( $faq_query->have_posts() ) : $faq_query->the_post(); ?>
			<div class="faq-item">
				<button class="faq-question" aria-expanded="false"><?php the_title(); ?></button>
				<div class="faq-answer" style="padding-left:var(--s6);padding-right:var(--s6);"><?php the_content(); ?></div>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</div>
<?php endif; ?>

<div class="section">
	<div class="container">
		<?php get_template_part( 'template-parts/cta-band', null, [
			'btn_ga' => 'cta_band_service_' . ( get_post_field( 'post_name', $service_id ) ?: 'x' ),
		] ); ?>
	</div>
</div>

<?php get_footer();