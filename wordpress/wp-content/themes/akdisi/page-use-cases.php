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
			$cases = array(
				array(
					'title' => __( 'Manajemen unit & sales perumahan', 'akdisi' ),
					'desc'  => __( 'Dari Excel dan grup WA jadi sistem booking real-time dengan peta kavling interaktif.', 'akdisi' ),
					'stack' => 'Web app · CRM · Dashboard',
					'tag'   => 'Properti',
					'url'   => home_url( '/solutions/developer/' ),
				),
				array(
					'title' => __( 'Iuran & pengaduan perumahan digital', 'akdisi' ),
					'desc'  => __( 'Billing otomatis, portal warga, dan tracking maintenance dalam satu sistem.', 'akdisi' ),
					'stack' => 'Billing · Portal warga',
					'tag'   => 'Properti',
					'url'   => home_url( '/solutions/property/' ),
				),
				array(
					'title' => __( 'Keanggotaan & sertifikasi digital', 'akdisi' ),
					'desc'  => __( 'Data anggota dan event asosiasi yang sebelumnya tersebar kini terpusat dan otomatis.', 'akdisi' ),
					'stack' => 'Membership · Event',
					'tag'   => 'Asosiasi',
					'url'   => home_url( '/solutions/organization/' ),
				),
				array(
					'title' => __( 'Inventori multi-gudang & distribusi', 'akdisi' ),
					'desc'  => __( 'Bukti AKDISI melayani proses operasional kompleks di luar properti.', 'akdisi' ),
					'stack' => 'Inventory · Multi-lokasi',
					'tag'   => 'Bisnis Lain',
					'url'   => home_url( '/projects/' ),
				),
			);
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