<?php
/**
 * CTA band — reusable closing conversion band (v2: split editorial).
 *
 * Usage:
 *   get_template_part( 'template-parts/cta-band', null, array(
 *       'title'             => 'Ready to build something worth launching?', // plain text, words separated by spaces
 *       'accent_words'      => array( 'something' ),                        // words to render in deep rose
 *       'sub'               => 'A 30-minute intro call is enough to know if we are the right fit.',
 *       'btn_primary_label' => 'Start a project',
 *       'btn_primary_url'   => home_url( '/kontak/' ),
 *       'btn_secondary_label' => 'See our work',
 *       'btn_secondary_url'   => home_url( '/projects/' ),
 *   ) );
 *
 * Defaults (Bahasa Indonesia) match the copy used across archive/single/template pages.
 *
 * @package AKDISI
 */

$cta = wp_parse_args(
	$args ?? array(),
	array(
		'title'               => __( 'Siap membangun produk yang layak diluncurkan?', 'akdisi' ),
		'accent_words'        => array(),
		'sub'                 => __( 'Panggilan perkenalan 30 menit cukup untuk mengetahui apakah kami cocok.', 'akdisi' ),
		'btn_primary_label'   => __( 'Mulai proyek', 'akdisi' ),
		'btn_primary_url'     => home_url( '/kontak/' ),
		'btn_secondary_label' => __( 'Lihat karya kami', 'akdisi' ),
		'btn_secondary_url'   => home_url( '/projects/' ),
	)
);
?>
<section class="section">
	<div class="container mx-auto">
		<div data-reveal class="akdisi-cta relative overflow-hidden rounded-2xl bg-ink px-8 py-16 md:px-14 md:py-20">

			<!-- Ambient rose glow (top-right warm) + subtle grid texture -->
			<div class="pointer-events-none absolute -right-28 -top-28 h-80 w-80 rounded-full bg-brand/25 blur-[110px]" aria-hidden="true"></div>
			<div class="pointer-events-none absolute -bottom-32 -left-20 h-72 w-72 rounded-full bg-brand/10 blur-[90px]" aria-hidden="true"></div>
			<div class="akdisi-cta-grid pointer-events-none absolute inset-0 opacity-[0.05]" aria-hidden="true"></div>

			<div class="relative grid items-center gap-10 lg:grid-cols-[1.15fr_0.85fr]">
				<!-- Copy -->
				<div>
					<p class="mb-5 inline-flex items-center gap-3 text-sm font-semibold uppercase tracking-[0.14em]" style="color:#f0a48f">
						<span class="inline-block h-px w-10 bg-brand" aria-hidden="true"></span>
						<?php echo esc_html( __( 'Mari bicara', 'akdisi' ) ); ?>
					</p>
					<h2 data-typewriter class="tw-heading max-w-xl font-display text-[clamp(2rem,4.5vw,3.4rem)] font-bold leading-[1.08] tracking-tight text-white">
						<?php echo akdisi_render_typewriter( $cta['title'], $cta['accent_words'] ); ?><span class="tw-cursor" aria-hidden="true"></span>
					</h2>
					<p class="mt-5 max-w-md text-lg leading-relaxed text-stone-400"><?php echo esc_html( $cta['sub'] ); ?></p>
					<div class="mt-8 flex flex-wrap gap-4">
						<a href="<?php echo esc_url( $cta['btn_primary_url'] ); ?>" class="btn btn-primary btn-lg"><?php echo esc_html( $cta['btn_primary_label'] ); ?></a>
						<a href="<?php echo esc_url( $cta['btn_secondary_url'] ); ?>" class="btn btn-on-dark btn-lg"><?php echo esc_html( $cta['btn_secondary_label'] ); ?></a>
					</div>
				</div>

				<!-- Visual: reply-speed card (desktop only) -->
				<div class="hidden lg:block">
					<div class="ml-auto w-full max-w-xs rounded-2xl border border-white/10 bg-white/[0.04] p-7 backdrop-blur-sm">
						<div class="flex items-center gap-2 text-sm text-stone-300">
							<span class="h-2 w-2 rounded-full bg-brand" aria-hidden="true"></span>
							<span class="font-medium">Rata-rata balasan pertama</span>
						</div>
						<p class="mt-5 font-display text-5xl font-bold leading-none text-white">1 hari</p>
						<p class="mt-3 text-sm leading-relaxed text-stone-400">Kirim brief — balasan matang dalam satu hari kerja, bukan seminggu.</p>
						<div class="mt-7 flex items-center gap-3">
							<div class="flex -space-x-2">
								<span class="h-9 w-9 rounded-full border-2 border-ink bg-brand/80" aria-hidden="true"></span>
								<span class="h-9 w-9 rounded-full border-2 border-ink bg-[#b9a48d]" aria-hidden="true"></span>
								<span class="h-9 w-9 rounded-full border-2 border-ink bg-white/20" aria-hidden="true"></span>
							</div>
							<p class="text-xs text-stone-400">Strategi, desain &amp; engineering siap merespons.</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>