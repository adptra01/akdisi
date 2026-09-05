<?php
/**
 * Solutions Template (BAGIAN H) — daftar solusi berdasarkan sektor/kebutuhan.
 * v1.3.0 — editorial rows.
 *
 * @package AKDISI
 * @since 1.1.0
 *
 * Template Name: Solutions Page
 */

get_header();
?>

<section class="page-hero" data-reveal>
	<div class="container">
		<p class="eyebrow"><?php _e( 'By Sector & Need', 'akdisi' ); ?></p>
		<h1><?php echo esc_html( get_the_title() ); ?></h1>
		<p><?php _e( 'Solusi aplikasi yang dirancang untuk kebutuhan bisnis Anda di berbagai sektor.', 'akdisi' ); ?></p>
	</div>
</section>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php if ( trim( (string) get_the_content() ) ) : ?>
	<div class="section">
		<div class="container entry-content" style="max-width:680px;font-size:var(--text-lg);">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endif; ?>
<?php endwhile; endif; ?>

<div class="section" style="padding-top:0;">
	<div class="container">
		<?php
		$solutions = [
			'housing'      => [ __( 'Perumahan', 'akdisi' ), __( 'Solusi untuk pengelolaan kawasan dan layanan penghuni.', 'akdisi' ) ],
			'developer'    => [ __( 'Developer', 'akdisi' ), __( 'Solusi untuk mendukung proses bisnis developer.', 'akdisi' ) ],
			'property'     => [ __( 'Properti', 'akdisi' ), __( 'Solusi untuk pengelolaan bisnis properti.', 'akdisi' ) ],
			'organization' => [ __( 'Organisasi', 'akdisi' ), __( 'Solusi untuk administrasi dan pengelolaan organisasi.', 'akdisi' ) ],
		];
		$loaded = [];
		?>
		<div class="solution-list js-stagger">
			<?php foreach ( $solutions as $slug => $data ) :
				$sol    = get_page_by_path( 'solutions/' . $slug );
				$index  = array_search( $slug, array_keys( $solutions ), true ) + 1;
				$title  = $data[0];
				$desc   = $sol ? get_the_excerpt( $sol ) : $data[1];
				$link   = $sol ? get_permalink( $sol ) : home_url( '/solutions/' . $slug . '/' );
				if ( $sol ) { $loaded[ $slug ] = true; }
			?>
			<a href="<?php echo esc_url( $link ); ?>" class="solution-row" data-ga-track="cta_click" data-ga-content="solution_<?php echo esc_attr( $slug ); ?>">
				<span class="solution-index">0<?php echo esc_html( $index ); ?></span>
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

<?php get_template_part( 'template-parts/cta-band', null, [ 'btn_ga' => 'cta_band_solutions' ] ); ?>

<?php get_footer();