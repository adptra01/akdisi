<?php
/**
 * Template Name: Use Cases
 * Page template for /use-cases/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Solusi per industri', 'akdisi' ),
	'title'   => __( 'Kami mengubah proses manual jadi sistem yang terukur.', 'akdisi' ),
	'sub'     => __( 'Dari Excel dan WhatsApp, menjadi aplikasi yang benar-benar dipakai tim operasional Anda sehari-hari.', 'akdisi' ),
) );
?>

<section class="section section-bg">
	<div class="container mx-auto">
		<div class="grid gap-8 lg:grid-cols-2">
			<?php
			$cases = akdisi_get_use_cases();
			foreach ( $cases as $i => $c ) :
				?>
				<a data-reveal href="<?php echo esc_url( $c['url'] ); ?>" data-ga-track="use_case_card"
					class="card group block p-8 transition-colors hover:border-brand/40"
					style="transition-delay:<?php echo esc_attr( $i * 70 ); ?>ms">
					<div class="mb-5 flex items-center justify-between">
						<span class="badge badge-soft"><?php echo esc_html( $c['tag'] ); ?></span>
						<span class="font-display text-2xl font-bold text-ink/10"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					</div>
					<h2 class="text-xl font-semibold text-ink transition-colors group-hover:text-brand"><?php echo esc_html( $c['title'] ); ?></h2>
					<p class="mt-3 leading-relaxed text-ink-soft"><?php echo esc_html( $c['desc'] ); ?></p>
					<p class="mt-5 text-xs font-mono uppercase tracking-wider text-ink-faint"><?php echo esc_html( $c['stack'] ); ?></p>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band', null, array(
	'title'        => __( 'Siap mengubah proses bisnis Anda jadi sistem yang terintegrasi?', 'akdisi' ),
	'accent_words' => array( 'terintegrasi?' ),
	'sub'          => __( 'Sesi 30 menit untuk memetakan proses kerja Anda saat ini dan melihat potensi solusinya.', 'akdisi' ),
	'visual_mode'  => 'process',
) );
get_footer();