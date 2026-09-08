<?php
/**
 * Front page — Home.
 *
 * @package AKDISI
 */

get_header();

$projects = new WP_Query(
	array(
		'post_type'              => 'akdisi_project',
		'posts_per_page'         => 6,
		'no_found_rows'          => true,
		'post_status'            => 'publish',
	)
);

$insights = new WP_Query(
	array(
		'post_type'      => 'akdisi_insight',
		'posts_per_page' => 3,
		'no_found_rows'  => true,
		'post_status'    => 'publish',
	)
);

$testimonials = new WP_Query(
	array(
		'post_type'      => 'akdisi_testimonial',
		'posts_per_page' => 3,
		'no_found_rows'  => true,
		'post_status'    => 'publish',
	)
);
?>

<!-- ============ HERO (asymmetric split) ============ -->
<section class="akdisi-hero section-bg pt-16 pb-20 md:pt-24 md:pb-28">
	<div class="container mx-auto grid items-center gap-14 lg:grid-cols-[1.1fr_0.9fr]">
		<!-- Copy -->
		<div data-reveal>
			<p class="eyebrow mb-5">Mitra digital untuk bisnis yang ingin tumbuh</p>
			<h1 data-typewriter class="tw-heading font-display text-[clamp(2.6rem,6vw,4.5rem)] font-bold leading-[1.05] tracking-tight text-ink">
				<?php echo akdisi_render_typewriter( 'Website &amp; aplikasi yang mendatangkan pelanggan untuk bisnis Anda.', array( 'pelanggan' ) ); ?><span class="tw-cursor" aria-hidden="true"></span>
			</h1>
			<p class="mt-6 max-w-xl text-lg leading-relaxed text-ink-soft">
				AKDISI adalah mitra digital full-cycle — strategi, desain produk, dan engineering —
				membantu bisnis Anda tampil profesional, ditemukan pelanggan, dan beroperasi lebih efisien.
			</p>
			<div class="mt-8 flex flex-wrap gap-4">
				<a href="<?php echo esc_url( home_url( '/layanan/' ) ); ?>" class="btn btn-primary btn-lg">Lihat layanan</a>
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-outline btn-lg">Mulai proyek</a>
			</div>
			<!-- Stats strip -->
			<dl class="mt-12 flex flex-wrap gap-x-10 gap-y-6 border-t border-paper-line pt-8">
				<?php foreach ( akdisi_get_stats( 'hero' ) as $stat ) : ?>
					<div><dt class="text-3xl font-bold text-ink font-display"><?php echo esc_html( $stat['value'] ); ?></dt><dd class="mt-1 text-sm text-ink-faint"><?php echo esc_html( $stat['label'] ); ?></dd></div>
				<?php endforeach; ?>
			</dl>
		</div>

		<!-- Visual — warm editorial mockup (pure CSS, no stock) -->
		<div data-reveal class="relative">
			<div class="relative rounded-2xl border border-paper-line bg-paper-alt p-6 shadow-[var(--shadow-card)] md:p-8">
				<div class="flex items-center gap-2 pb-5">
					<span class="h-2.5 w-2.5 rounded-full bg-[#f0b3a4]"></span>
					<span class="h-2.5 w-2.5 rounded-full bg-[#e7e2dc]"></span>
					<span class="h-2.5 w-2.5 rounded-full bg-[#d6d0c8]"></span>
					<span class="ml-auto rounded-full bg-brand-soft px-3 py-1 text-xs font-semibold text-brand">Tayang</span>
				</div>
				<div class="space-y-3">
					<div class="h-3 w-3/4 rounded-full bg-ink/80"></div>
					<div class="h-3 w-1/2 rounded-full bg-ink/40"></div>
					<div class="mt-5 grid grid-cols-2 gap-3">
						<div class="rounded-xl border border-paper-line bg-white p-4">
							<div class="mb-2 h-2 w-8 rounded-full bg-brand"></div>
							<div class="h-2 w-full rounded-full bg-ink/20"></div>
							<div class="mt-1.5 h-2 w-2/3 rounded-full bg-ink/20"></div>
						</div>
						<div class="rounded-xl border border-paper-line bg-white p-4">
							<div class="mb-2 h-2 w-8 rounded-full bg-[#b9a48d]"></div>
							<div class="h-2 w-full rounded-full bg-ink/20"></div>
							<div class="mt-1.5 h-2 w-2/3 rounded-full bg-ink/20"></div>
						</div>
					</div>
					<div class="rounded-xl border border-paper-line bg-white p-4">
						<div class="mb-3 flex items-center justify-between">
							<div class="h-2 w-20 rounded-full bg-ink/50"></div>
							<div class="h-4 w-4 rounded-full bg-brand"></div>
						</div>
						<div class="flex h-16 items-end gap-1.5">
							<div class="w-full rounded-t bg-brand/30" style="height:40%"></div>
							<div class="w-full rounded-t bg-brand/40" style="height:65%"></div>
							<div class="w-full rounded-t bg-brand/60" style="height:50%"></div>
							<div class="w-full rounded-t bg-brand" style="height:90%"></div>
							<div class="w-full rounded-t bg-[#b9a48d] " style="height:70%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- Floating badge -->
			<div class="absolute -bottom-6 -left-4 rounded-xl border border-paper-line bg-white px-5 py-3 shadow-[var(--shadow-card)] md:-left-8">
				<p class="text-xs text-ink-faint">Rata-rata waktu menuju hasil</p>
				<p class="font-display text-lg font-bold text-ink">6 minggu <span class="text-sm font-medium text-brand">hingga tayang</span></p>
			</div>
		</div>
	</div>
</section>

<!-- ============ TRUSTED MARQUEE ============ -->
<section class="border-y border-paper-line bg-white py-8">
	<div class="container mx-auto">
		<p class="mb-6 text-center text-xs font-semibold uppercase tracking-[0.2em] text-ink-faint">Dipercaya tim produk di</p>
		<div class="flex flex-wrap items-center justify-center gap-x-12 gap-y-4 opacity-70">
			<?php foreach ( akdisi_get_clients() as $name ) : ?>
				<span class="font-display text-xl font-bold uppercase text-ink/60"><?php echo esc_html( $name ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ SERVICES ============ -->
<section class="akdisi-services section section-bg">
	<div class="container mx-auto">
		<div class="mb-14 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
			<div data-reveal>
				<p class="eyebrow mb-4">Apa yang kami kerjakan</p>
				<h2 class="section-title">Layanan digital lengkap,<br>satu tim yang bertanggung jawab.</h2>
			</div>
			<p data-reveal class="section-sub text-right">
				Dari ide pertama hingga produk tayang — strategi, desain, engineering, dan pertumbuhan dalam satu tim.
			</p>
		</div>

		<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
			<?php
			$services = akdisi_get_services();
			foreach ( $services as $i => $s ) :
				?>
				<article data-reveal class="card group p-7" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<div class="mb-5 flex h-11 w-11 items-center justify-center rounded-lg bg-brand-soft text-brand">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo esc_attr( $s['icon'] ); ?>"/></svg>
					</div>
					<h3 class="mb-2 text-lg font-semibold text-ink"><?php echo esc_html( $s['title'] ); ?></h3>
					<p class="text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $s['desc'] ); ?></p>
					<a href="<?php echo esc_url( home_url( '/layanan/' ) ); ?>" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-brand">
						Pelajari lebih lanjut
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ WHY / STATS (dark band) ============ -->
<section class="akdisi-why section-dark">
	<div class="container mx-auto grid items-center gap-12 lg:grid-cols-[0.9fr_1.1fr]">
		<div data-reveal>
			<p class="eyebrow mb-4" style="color:#f0a48f">Mengapa AKDISI</p>
			<h2 class="section-title text-white">Mitra, bukan sekadar vendor.</h2>
			<ul class="mt-8 space-y-4 text-stone-300">
				<li class="flex gap-3"><span class="mt-1 text-brand">&#10003;</span> Tim senior yang menangani langsung — tanpa operan, tanpa yang belajar sambil jalan.</li>
				<li class="flex gap-3"><span class="mt-1 text-brand">&#10003;</span> Demo mingguan yang transparan dan backlog bersama yang bisa Anda lihat langsung.</li>
				<li class="flex gap-3"><span class="mt-1 text-brand">&#10003;</span> Harga paket tetap dengan milestone yang jelas — anggaran terukur sejak awal.</li>
			</ul>
		</div>
		<div data-reveal class="grid grid-cols-2 gap-6">
			<?php foreach ( akdisi_get_stats( 'why' ) as $stat ) : ?>
				<div class="rounded-2xl border border-stone-700/60 bg-stone-800/40 p-7">
					<p class="font-display text-4xl font-bold text-white"><?php echo esc_html( $stat['value'] ); ?></p>
					<p class="mt-2 text-sm text-stone-400"><?php echo esc_html( $stat['label'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ FEATURED PROJECTS ============ -->
<section class="akdisi-projects section section-alt">
	<div class="container mx-auto">
		<div class="mb-14 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
			<div data-reveal>
				<p class="eyebrow mb-4">Karya pilihan</p>
				<h2 class="section-title">Proyek terbaru yang kami banggakan.</h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="btn btn-outline">Lihat semua proyek</a>
		</div>

		<?php if ( $projects->have_posts() ) : ?>
			<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
				<?php
				while ( $projects->have_posts() ) :
					$projects->the_post();
					?>
					<article data-reveal class="card group">
						<div class="aspect-[16/10] overflow-hidden bg-paper-alt">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'akdisi-card', array( 'class' => 'h-full w-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
							<?php else : ?>
								<div class="flex h-full items-center justify-center font-display text-3xl font-bold text-ink/20">
									<?php echo esc_html( get_the_title() ); ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="p-6">
							<span class="badge badge-soft mb-3"><?php echo esc_html( wp_strip_all_tags( get_the_term_list( get_the_ID(), 'akdisi_project_cat', '', ', ', '' ) ) ?: __( 'Studi kasus', 'akdisi' ) ); ?></span>
							<h3 class="text-lg font-semibold text-ink transition-colors group-hover:text-brand"><?php the_title(); ?></h3>
							<p class="mt-2 text-sm text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-white p-10 text-center">
				<p class="text-ink-faint">Proyek akan tampil di sini saat kami mempublikasikan studi kasus pertama.</p>
				<p class="mt-2 text-sm text-ink-faint">Sambil menunggu, lihat <a href="<?php echo esc_url( home_url( '/tentang/' ) ); ?>" class="text-brand underline underline-offset-2">proses kami</a>.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- ============ PROCESS ============ -->
<section class="akdisi-process section section-bg">
	<div class="container mx-auto">
		<div data-reveal class="mb-14 max-w-2xl">
			<p class="eyebrow mb-4">Cara kami bekerja</p>
			<h2 class="section-title">Proses yang menjaga momentum.</h2>
			<p class="section-sub mt-4">Empat fase, check-in mingguan, tanpa kejutan.</p>
		</div>

		<ol class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
			<?php
			$steps = akdisi_get_process_steps();
			foreach ( $steps as $i => $step ) :
				?>
				<li data-reveal class="relative rounded-2xl border border-paper-line bg-white p-7" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<span class="font-display text-5xl font-bold text-brand-soft"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3 class="mt-4 text-lg font-semibold text-ink"><?php echo esc_html( $step['title'] ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $step['desc'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="akdisi-testimonials section section-alt">
	<div class="container mx-auto">
		<div data-reveal class="mb-14 max-w-2xl">
			<p class="eyebrow mb-4">Kata mereka</p>
			<h2 class="section-title">Apa kata mitra setelah tayang.</h2>
		</div>

		<?php if ( $testimonials->have_posts() ) : ?>
			<div class="grid gap-6 md:grid-cols-3">
				<?php
				while ( $testimonials->have_posts() ) :
					$testimonials->the_post();
					?>
					<figure data-reveal class="card flex flex-col p-7">
						<div class="mb-4 text-brand" aria-label="5 bintang">
							★★★★★
						</div>
						<blockquote class="flex-1 text-[15px] leading-relaxed text-ink-soft">&ldquo;<?php echo esc_html( get_the_excerpt() ?: wp_trim_words( get_the_content(), 28 ) ); ?>&rdquo;</blockquote>
						<figcaption class="mt-6 border-t border-paper-line pt-4">
							<div class="h-9 w-9 rounded-full bg-brand-soft font-display text-sm font-bold text-brand flex items-center justify-center">
								<?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?>
							</div>
							<p class="mt-2 text-sm font-semibold text-ink"><?php the_title(); ?></p>
							<p class="text-xs text-ink-faint"><?php echo esc_html( get_post_meta( get_the_ID(), 'role', true ) ?: __( 'Mitra klien', 'akdisi' ) ); ?></p>
						</figcaption>
					</figure>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-white p-10 text-center text-ink-faint">
				Testimoni klien akan tampil di sini seiring cerita klien masuk.
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- ============ INSIGHTS PREVIEW ============ -->
<section class="akdisi-insights section section-bg">
	<div class="container mx-auto">
		<div class="mb-14 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
			<div data-reveal>
				<p class="eyebrow mb-4">Dari blog</p>
				<h2 class="section-title">Ide yang sedang kami pikirkan.</h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/insight/' ) ); ?>" class="btn btn-outline">Semua insight</a>
		</div>

		<?php if ( $insights->have_posts() ) : ?>
			<div class="grid gap-8 lg:grid-cols-3">
				<?php
				while ( $insights->have_posts() ) :
					$insights->the_post();
					?>
					<article data-reveal class="group">
						<div class="aspect-[16/10] overflow-hidden rounded-xl bg-paper-alt">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'akdisi-card', array( 'class' => 'h-full w-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
							<?php else : ?>
								<div class="flex h-full items-center justify-center font-display text-3xl font-bold text-ink/15">AKDISI</div>
							<?php endif; ?>
						</div>
						<p class="mt-5 text-xs font-semibold uppercase tracking-wide text-brand"><?php echo esc_html( get_the_date() ); ?></p>
						<h3 class="mt-2 text-lg font-semibold leading-snug text-ink transition-colors group-hover:text-brand"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="mt-2 text-sm text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-paper-alt p-10 text-center text-ink-faint">
				Perspektif soal produk, desain, dan pertumbuhan akan segera hadir di sini.
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- ============ FAQ ============ -->
<?php
$faqs = new WP_Query(
	array(
		'post_type'      => 'akdisi_faq',
		'posts_per_page' => 8,
		'no_found_rows'  => true,
		'post_status'    => 'publish',
	)
);
?>
<?php if ( $faqs->have_posts() ) : ?>
<section class="akdisi-faq section section-alt">
	<div class="container mx-auto grid gap-12 lg:grid-cols-[0.8fr_1.2fr]">
		<div data-reveal>
			<p class="eyebrow mb-4">FAQ</p>
			<h2 class="section-title">Pertanyaan umum, jawaban langsung.</h2>
			<p class="section-sub mt-4">Pertanyaan lain? <a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="text-brand underline underline-offset-2">Tanya langsung</a> — dibalas dalam satu hari kerja.</p>
		</div>
		<div data-reveal class="space-y-3">
			<?php
			$i = 0;
			while ( $faqs->have_posts() ) :
				$faqs->the_post();
				?>
				<details class="group rounded-xl border border-paper-line bg-white" <?php echo 0 === $i ? 'open' : ''; ?>>
					<summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5 text-ink [&::-webkit-details-marker]:hidden">
						<span class="font-semibold"><?php the_title(); ?></span>
						<span class="text-lg leading-none text-brand transition-transform duration-300 group-open:rotate-45">+</span>
					</summary>
					<div class="px-6 pb-6 text-sm leading-relaxed text-ink-soft">
						<?php the_content(); ?>
					</div>
				</details>
				<?php
				$i++;
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ============ CTA BAND ============ -->
<?php
get_template_part(
	'template-parts/cta-band',
	null,
	array(
		'title'               => __( 'Punya ide produk yang layak dibangun?', 'akdisi' ),
		'accent_words'        => array( 'dibangun?' ),
		'sub'                 => __( 'Ceritakan tujuan Anda — kami akan memetakan rute terpendek dan teraman ke sana.', 'akdisi' ),
		'btn_primary_label'   => __( 'Mulai percakapan', 'akdisi' ),
		'btn_primary_url'     => home_url( '/kontak/' ),
		'btn_secondary_label' => __( 'Lihat use case', 'akdisi' ),
		'btn_secondary_url'   => home_url( '/use-cases/' ),
	)
);
?>

<?php get_footer(); ?>