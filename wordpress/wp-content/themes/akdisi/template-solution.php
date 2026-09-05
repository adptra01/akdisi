<?php
/**
 * Solution Detail Template (BAGIAN H) — detail solusi per sektor.
 * v1.3.0 — entry editorial + solution rows + CTA.
 *
 * @package AKDISI
 * @since 1.1.0
 *
 * Template Name: Solution Detail
 */

get_header();

$solution_slugs = [ 'housing', 'developer', 'property', 'organization' ];
$current_post   = get_post();
$current_slug   = $current_post ? basename( (string) get_permalink( $current_post ) ) : '';
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'akdisi' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Beranda', 'akdisi' ); ?></a><span class="sep">/</span>
			<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>"><?php _e( 'Solusi', 'akdisi' ); ?></a><span class="sep">/</span>
			<span aria-current="page"><?php echo esc_html( get_the_title() ); ?></span>
		</nav>
		<h1 style="margin-top:var(--s4);"><?php echo esc_html( get_the_title() ); ?></h1>
		<p><?php _e( 'Kemampuan yang dapat disesuaikan dengan kebutuhan organisasi Anda.', 'akdisi' ); ?></p>
	</div>
</section>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="section">
	<div class="container entry-content" style="font-size:var(--text-lg);">
		<?php the_content(); ?>
	</div>
</div>
<?php endwhile; endif; ?>

<div class="section section-dark">
	<div class="container">
		<p class="eyebrow"><?php _e( 'Explore', 'akdisi' ); ?></p>
		<h2 class="section-title" style="font-size:var(--text-2xl);"><?php _e( 'Solusi Lainnya', 'akdisi' ); ?></h2>

		<div class="solution-list js-stagger" style="margin-top:var(--s6);">
			<?php
			$solutions = [
				'housing'      => [ __( 'Perumahan', 'akdisi' ), __( 'Pengelolaan kawasan dan layanan penghuni.', 'akdisi' ) ],
				'developer'    => [ __( 'Developer', 'akdisi' ), __( 'Mendukung proses bisnis developer.', 'akdisi' ) ],
				'property'     => [ __( 'Properti', 'akdisi' ), __( 'Pengelolaan bisnis properti.', 'akdisi' ) ],
				'organization' => [ __( 'Organisasi', 'akdisi' ), __( 'Administrasi dan pengelolaan organisasi.', 'akdisi' ) ],
			];
			$row = 0;
			foreach ( $solutions as $slug => $data ) :
				if ( $slug === $current_slug ) { continue; }
				$row++;
				$sol   = get_page_by_path( 'solutions/' . $slug );
				$title = $data[0];
				$desc  = $sol ? get_the_excerpt( $sol ) : $data[1];
				$link  = $sol ? get_permalink( $sol ) : home_url( '/solutions/' . $slug . '/' );
			?>
			<a href="<?php echo esc_url( $link ); ?>" class="solution-row" data-ga-track="cta_click" data-ga-content="solution_<?php echo esc_attr( $slug ); ?>">
				<span class="solution-index">0<?php echo esc_html( $row ); ?></span>
				<div>
					<h3><?php echo esc_html( $title ); ?></h3>
					<p><?php echo esc_html( $desc ); ?></p>
				</div>
				<span class="text-link"><?php _e( 'Lihat Solusi', 'akdisi' ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php get_template_part( 'template-parts/cta-band', null, [ 'btn_ga' => 'cta_band_solution_' . ( $current_slug ?: 'x' ) ] ); ?>

<?php get_footer();