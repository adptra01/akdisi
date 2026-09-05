<?php
/**
 * CTA Band — reusable dark rounded call-to-action for inner pages.
 *
 * Args:
 *  - title:      string (escaped in template), may contain HTML
 *  - text:       string (escaped), optional
 *  - btn_url:    string
 *  - btn_label:  string
 *  - btn_ga:     string (data-ga-content value)
 *
 * @package AKDISI
 * @since 1.3.0
 */

$cta_title = $args['title'] ?? __( 'Punya proses bisnis yang ingin dibuat lebih <span class="serif">terstruktur</span>?', 'akdisi' );
$cta_text  = $args['text'] ?? __( 'Konsultasikan kebutuhan Anda bersama kami — dari ide hingga sistem berjalan.', 'akdisi' );
$cta_url   = $args['btn_url'] ?? home_url( '/contact/' );
$cta_label = $args['btn_label'] ?? __( 'Konsultasikan Sekarang', 'akdisi' );
$cta_ga    = $args['btn_ga'] ?? 'cta_band';
?>
<section class="cta-band" data-reveal>
	<div class="grain" aria-hidden="true"></div>
	<div>
		<h2><?php echo wp_kses_post( $cta_title ); ?></h2>
		<?php if ( ! empty( $cta_text ) ) : ?>
			<p><?php echo esc_html( $cta_text ); ?></p>
		<?php endif; ?>
	</div>
	<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-accent btn-large magnetic" data-ga-track="cta_click" data-ga-content="<?php echo esc_attr( $cta_ga ); ?>">
		<?php echo esc_html( $cta_label ); ?>
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
	</a>
</section>