<?php
/**
 * Template Name: About
 * Page template for /tentang/.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Tentang AKDISI', 'akdisi' ),
	'title'   => __( 'Kami membangun produk digital untuk tim yang suka mengeksekusi.', 'akdisi' ),
	'sub'     => __( 'Studio khusus senior dari Jambi, bermitra dengan bisnis yang bertumbuh di Indonesia dan luar negeri.', 'akdisi' ),
) );
?>

<!-- Story -->
<section class="section section-bg">
	<div class="container mx-auto grid items-start gap-12 lg:grid-cols-[1fr_1.1fr]">
		<div data-reveal>
			<p class="eyebrow mb-4">Cerita kami</p>
			<h2 class="section-title">Lahir dari satu frustrasi sederhana.</h2>
			<div class="mt-6 space-y-4 leading-relaxed text-ink-soft">
				<p>Terlalu banyak proyek digital gagal — bukan karena timnya tidak mumpuni, tapi karena tidak ada yang benar-benar bertanggung jawab atas hasilnya. Kebutuhan bergeser, serah-terima kehilangan konteks, dan kata "selesai" berarti apa pun yang tertulis di invoice terakhir.</p>
				<p>AKDISI lahir sebagai jawaban atas hal itu. Tim kecil berisi senior, tempat orang yang merancang produk Anda adalah orang yang sama yang membangunnya — dan tetap bertanggung jawab setelah tayang.</p>
				<p>Kini kami bermitra dengan founder, operator, dan institusi — dari situs marketing hingga platform SaaS penuh. Prinsip yang sama, proyek yang lebih besar.</p>
			</div>
			<div class="mt-8 flex flex-wrap gap-4">
				<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="btn btn-primary">Lihat karya kami</a>
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-outline">Hubungi kami</a>
			</div>
		</div>
		<div data-reveal class="grid gap-6 sm:grid-cols-2">
			<div class="rounded-2xl bg-brand-soft p-8">
				<p class="font-display text-5xl font-bold text-brand">2019</p>
				<p class="mt-3 text-sm text-ink-soft">Didirikan di Jambi sebagai studio web dua orang.</p>
			</div>
			<div class="rounded-2xl border border-paper-line bg-paper-alt p-8">
				<p class="font-display text-5xl font-bold text-ink">40+</p>
				<p class="mt-3 text-sm text-ink-soft">Proyek selesai di 12 industri.</p>
			</div>
			<div class="rounded-2xl border border-paper-line bg-paper-alt p-8">
				<p class="font-display text-5xl font-bold text-ink">12</p>
				<p class="mt-3 text-sm text-ink-soft">Orang, semua senior — tanpa yang belajar sambil jalan.</p>
			</div>
			<div class="rounded-2xl bg-ink p-8">
				<p class="font-display text-5xl font-bold text-white">98%</p>
				<p class="mt-3 text-sm text-stone-400">Klien kembali untuk kerja sama berikutnya.</p>
			</div>
		</div>
	</div>
</section>

<!-- Values -->
<section class="section section-alt">
	<div class="container mx-auto">
		<div data-reveal class="mb-12 max-w-2xl">
			<p class="eyebrow mb-4">Nilai kami</p>
			<h2 class="section-title">Apa yang tidak pernah kami kompromikan.</h2>
		</div>
		<div class="grid gap-6 md:grid-cols-3">
			<?php
			$values = array(
				array( __( 'Bertanggung jawab atas hasil', 'akdisi' ), __( 'Kami diukur dari metrik Anda — peluncuran, konversi, retensi — bukan dari jam yang ditagih.', 'akdisi' ) ),
				array( __( 'Senior, selalu', 'akdisi' ), __( 'Orang di kickoff Anda adalah orang yang mengerjakan produknya. Tanpa jualan nama lalu operan.', 'akdisi' ) ),
				array( __( 'Keandalan yang membosankan', 'akdisi' ), __( 'Demo konsisten, timeline jujur, bahasa yang jelas. Kegembiraan seharusnya datang dari produknya.', 'akdisi' ) ),
			);
			foreach ( $values as $i => $v ) :
				?>
				<div data-reveal class="card p-7" style="transition-delay:<?php echo esc_attr( $i * 70 ); ?>ms">
					<div class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-brand-soft font-display text-sm font-bold text-brand"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></div>
					<h3 class="text-lg font-semibold text-ink"><?php echo esc_html( $v[0] ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $v[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-band' );
get_footer();