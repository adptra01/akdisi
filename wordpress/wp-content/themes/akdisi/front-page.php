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
			<p class="eyebrow mb-5">Digital agency for growing teams</p>
			<h1 class="font-display text-[clamp(2.6rem,6vw,4.5rem)] font-bold leading-[1.05] tracking-tight text-ink">
				We design &amp; build digital products that <span class="text-brand">move the needle</span>.
			</h1>
			<p class="mt-6 max-w-xl text-lg leading-relaxed text-ink-soft">
				AKDISI is a full-cycle digital partner — strategy, product design, and engineering —
				helping ambitious teams turn ideas into products people love.
			</p>
			<div class="mt-8 flex flex-wrap gap-4">
				<a href="<?php echo esc_url( home_url( '/layanan/' ) ); ?>" class="btn btn-primary btn-lg">Explore services</a>
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-outline btn-lg">Start a project</a>
			</div>
			<!-- Stats strip -->
			<dl class="mt-12 flex flex-wrap gap-x-10 gap-y-6 border-t border-paper-line pt-8">
				<div><dt class="text-3xl font-bold text-ink font-display">40+</dt><dd class="mt-1 text-sm text-ink-faint">Projects shipped</dd></div>
				<div><dt class="text-3xl font-bold text-ink font-display">12</dt><dd class="mt-1 text-sm text-ink-faint">Industries served</dd></div>
				<div><dt class="text-3xl font-bold text-ink font-display">98%</dt><dd class="mt-1 text-sm text-ink-faint">Client retention</dd></div>
			</dl>
		</div>

		<!-- Visual — warm editorial mockup (pure CSS, no stock) -->
		<div data-reveal class="relative">
			<div class="relative rounded-2xl border border-paper-line bg-paper-alt p-6 shadow-[var(--shadow-card)] md:p-8">
				<div class="flex items-center gap-2 pb-5">
					<span class="h-2.5 w-2.5 rounded-full bg-[#f0b3a4]"></span>
					<span class="h-2.5 w-2.5 rounded-full bg-[#e7e2dc]"></span>
					<span class="h-2.5 w-2.5 rounded-full bg-[#d6d0c8]"></span>
					<span class="ml-auto rounded-full bg-brand-soft px-3 py-1 text-xs font-semibold text-brand">Live</span>
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
				<p class="text-xs text-ink-faint">Avg. time-to-value</p>
				<p class="font-display text-lg font-bold text-ink">6 weeks <span class="text-sm font-medium text-brand">to launch</span></p>
			</div>
		</div>
	</div>
</section>

<!-- ============ TRUSTED MARQUEE ============ -->
<section class="border-y border-paper-line bg-white py-8">
	<div class="container mx-auto">
		<p class="mb-6 text-center text-xs font-semibold uppercase tracking-[0.2em] text-ink-faint">Trusted by product teams at</p>
		<div class="flex flex-wrap items-center justify-center gap-x-12 gap-y-4 opacity-70">
			<span class="font-display text-xl font-bold text-ink/60">NORTHBOUND</span>
			<span class="font-display text-xl font-bold text-ink/60">Halcyon</span>
			<span class="font-display text-xl font-bold text-ink/60">Meridian Co.</span>
			<span class="font-display text-xl font-bold text-ink/60">Kestrel</span>
			<span class="font-display text-xl font-bold text-ink/60">Atelier 9</span>
			<span class="font-display text-xl font-bold text-ink/60">Vantage</span>
		</div>
	</div>
</section>

<!-- ============ SERVICES ============ -->
<section class="akdisi-services section section-bg">
	<div class="container mx-auto">
		<div class="mb-14 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
			<div data-reveal>
				<p class="eyebrow mb-4">What we do</p>
				<h2 class="section-title">Full-stack digital services,<br>one accountable team.</h2>
			</div>
			<p data-reveal class="section-sub text-right">
				From first sketch to shipped product — strategy, design, engineering, and growth under one roof.
			</p>
		</div>

		<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
			<?php
			$services = array(
				array(
					'icon'  => 'M3 17l6-6 4 4 8-8M3 21h18',
					'title' => __( 'Product Strategy', 'akdisi' ),
					'desc'  => __( 'Market research, roadmaps, and positioning that de-risk what you build.', 'akdisi' ),
				),
				array(
					'icon'  => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8',
					'title' => __( 'UI/UX Design', 'akdisi' ),
					'desc'  => __( 'Interfaces and design systems that feel inevitable — researched, tested, refined.', 'akdisi' ),
				),
				array(
					'icon'  => 'M8 9l3 3-3 3m5 0h3M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5z',
					'title' => __( 'Web & App Development', 'akdisi' ),
					'desc'  => __( 'Fast, accessible, maintainable products built with modern stacks end-to-end.', 'akdisi' ),
				),
				array(
					'icon'  => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
					'title' => __( 'Growth & Marketing', 'akdisi' ),
					'desc'  => __( 'SEO, analytics, and conversion programs that compound after launch.', 'akdisi' ),
				),
			);
			foreach ( $services as $i => $s ) :
				?>
				<article data-reveal class="card group p-7" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<div class="mb-5 flex h-11 w-11 items-center justify-center rounded-lg bg-brand-soft text-brand">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo esc_attr( $s['icon'] ); ?>"/></svg>
					</div>
					<h3 class="mb-2 text-lg font-semibold text-ink"><?php echo esc_html( $s['title'] ); ?></h3>
					<p class="text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $s['desc'] ); ?></p>
					<a href="<?php echo esc_url( home_url( '/layanan/' ) ); ?>" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-brand">
						Learn more
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
			<p class="eyebrow mb-4" style="color:#f0a48f">Why AKDISI</p>
			<h2 class="section-title text-white">A partner, not a vendor.</h2>
			<ul class="mt-8 space-y-4 text-stone-300">
				<li class="flex gap-3"><span class="mt-1 text-brand">&#10003;</span> Senior-only teams — no hand-offs, no juniors learning on your budget.</li>
				<li class="flex gap-3"><span class="mt-1 text-brand">&#10003;</span> Transparent weekly demos and a shared backlog you actually see.</li>
				<li class="flex gap-3"><span class="mt-1 text-brand">&#10003;</span> Fixed-scope pricing with clear milestones — predictable spend.</li>
			</ul>
		</div>
		<div data-reveal class="grid grid-cols-2 gap-6">
			<div class="rounded-2xl border border-stone-700/60 bg-stone-800/40 p-7">
				<p class="font-display text-4xl font-bold text-white">40+</p>
				<p class="mt-2 text-sm text-stone-400">Projects delivered across 12 industries</p>
			</div>
			<div class="rounded-2xl border border-stone-700/60 bg-stone-800/40 p-7">
				<p class="font-display text-4xl font-bold text-white">6 wks</p>
				<p class="mt-2 text-sm text-stone-400">Average landing-to-launch cycle</p>
			</div>
			<div class="rounded-2xl border border-stone-700/60 bg-stone-800/40 p-7">
				<p class="font-display text-4xl font-bold text-white">98%</p>
				<p class="mt-2 text-sm text-stone-400">Clients who return after round one</p>
			</div>
			<div class="rounded-2xl border border-stone-700/60 bg-stone-800/40 p-7">
				<p class="font-display text-4xl font-bold text-white">4.9/5</p>
				<p class="mt-2 text-sm text-stone-400">Average partner rating</p>
			</div>
		</div>
	</div>
</section>

<!-- ============ FEATURED PROJECTS ============ -->
<section class="akdisi-projects section section-alt">
	<div class="container mx-auto">
		<div class="mb-14 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
			<div data-reveal>
				<p class="eyebrow mb-4">Selected work</p>
				<h2 class="section-title">Recent projects we're proud of.</h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="btn btn-outline">View all projects</a>
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
							<span class="badge badge-soft mb-3"><?php echo esc_html( wp_strip_all_tags( get_the_term_list( get_the_ID(), 'akdisi_project_cat', '', ', ', '' ) ) ?: __( 'Case study', 'akdisi' ) ); ?></span>
							<h3 class="text-lg font-semibold text-ink transition-colors group-hover:text-brand"><?php the_title(); ?></h3>
							<p class="mt-2 text-sm text-ink-soft"><?php echo esc_html( get_the_excerpt() ); ?></p>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-white p-10 text-center">
				<p class="text-ink-faint">Projects will appear here once the team publishes the first case study.</p>
				<p class="mt-2 text-sm text-ink-faint">Meanwhile, peek at our <a href="<?php echo esc_url( home_url( '/tentang/' ) ); ?>" class="text-brand underline underline-offset-2">process</a>.</p>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- ============ PROCESS ============ -->
<section class="akdisi-process section section-bg">
	<div class="container mx-auto">
		<div data-reveal class="mb-14 max-w-2xl">
			<p class="eyebrow mb-4">How we work</p>
			<h2 class="section-title">A process built for momentum.</h2>
			<p class="section-sub mt-4">Four phases, weekly check-ins, zero surprises.</p>
		</div>

		<ol class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
			<?php
			$steps = array(
				array( '01', __( 'Discover', 'akdisi' ), __( 'Deep-dive workshops, user research, and a crisp definition of done.', 'akdisi' ) ),
				array( '02', __( 'Design', 'akdisi' ), __( 'Wireframes to polished UI, validated with real users at each pass.', 'akdisi' ) ),
				array( '03', __( 'Build', 'akdisi' ), __( 'Sprint-based engineering with demos every Friday — no black box.', 'akdisi' ) ),
				array( '04', __( 'Launch & Grow', 'akdisi' ), __( 'Ship, measure, iterate. We stay on for optimisation and support.', 'akdisi' ) ),
			);
			foreach ( $steps as $i => $step ) :
				?>
				<li data-reveal class="relative rounded-2xl border border-paper-line bg-white p-7" style="transition-delay:<?php echo esc_attr( $i * 60 ); ?>ms">
					<span class="font-display text-5xl font-bold text-brand-soft"><?php echo esc_html( $step[0] ); ?></span>
					<h3 class="mt-4 text-lg font-semibold text-ink"><?php echo esc_html( $step[1] ); ?></h3>
					<p class="mt-2 text-sm leading-relaxed text-ink-soft"><?php echo esc_html( $step[2] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="akdisi-testimonials section section-alt">
	<div class="container mx-auto">
		<div data-reveal class="mb-14 max-w-2xl">
			<p class="eyebrow mb-4">Kind words</p>
			<h2 class="section-title">What partners say after launch.</h2>
		</div>

		<?php if ( $testimonials->have_posts() ) : ?>
			<div class="grid gap-6 md:grid-cols-3">
				<?php
				while ( $testimonials->have_posts() ) :
					$testimonials->the_post();
					?>
					<figure data-reveal class="card flex flex-col p-7">
						<div class="mb-4 text-brand" aria-label="5 stars">
							★★★★★
						</div>
						<blockquote class="flex-1 text-[15px] leading-relaxed text-ink-soft">&ldquo;<?php echo esc_html( get_the_excerpt() ?: wp_trim_words( get_the_content(), 28 ) ); ?>&rdquo;</blockquote>
						<figcaption class="mt-6 border-t border-paper-line pt-4">
							<div class="h-9 w-9 rounded-full bg-brand-soft font-display text-sm font-bold text-brand flex items-center justify-center">
								<?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?>
							</div>
							<p class="mt-2 text-sm font-semibold text-ink"><?php the_title(); ?></p>
							<p class="text-xs text-ink-faint"><?php echo esc_html( get_post_meta( get_the_ID(), 'role', true ) ?: __( 'Client partner', 'akdisi' ) ); ?></p>
						</figcaption>
					</figure>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div data-reveal class="rounded-2xl border border-dashed border-paper-line bg-white p-10 text-center text-ink-faint">
				Testimonials will appear here as client stories come in.
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- ============ INSIGHTS PREVIEW ============ -->
<section class="akdisi-insights section section-bg">
	<div class="container mx-auto">
		<div class="mb-14 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
			<div data-reveal>
				<p class="eyebrow mb-4">From the blog</p>
				<h2 class="section-title">Ideas we're thinking about.</h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/insight/' ) ); ?>" class="btn btn-outline">All insights</a>
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
				Perspectives on product, design, and growth will land here soon.
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
			<h2 class="section-title">Common questions, straight answers.</h2>
			<p class="section-sub mt-4">Something not covered? <a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="text-brand underline underline-offset-2">Ask us directly</a> — replies within a business day.</p>
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
<section class="section">
	<div class="container mx-auto">
		<div data-reveal class="overflow-hidden rounded-3xl bg-ink px-8 py-16 text-center md:px-16 md:py-20">
			<p class="eyebrow mb-5" style="color:#f0a48f">Let's talk</p>
			<h2 class="mx-auto max-w-2xl font-display text-[clamp(1.9rem,4vw,3rem)] font-bold leading-tight text-white">
				Have a product idea worth building?
			</h2>
			<p class="mx-auto mt-4 max-w-xl text-stone-400">Tell us where you want to go — we'll map the shortest, safest route there.</p>
			<div class="mt-9 flex flex-wrap justify-center gap-4">
				<a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>" class="btn btn-primary btn-lg">Start the conversation</a>
				<a href="<?php echo esc_url( home_url( '/use-cases/' ) ); ?>" class="btn btn-on-dark btn-lg">See use cases</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>