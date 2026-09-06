<?php
/**
 * Template Name: Contact
 * Page template for /kontak/ — AJAX lead form.
 *
 * @package AKDISI
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Kontak', 'akdisi' ),
	'title'   => __( 'Mari bicarakan proyek Anda.', 'akdisi' ),
	'sub'     => __( 'Ceritakan tujuan Anda dan anggota tim senior akan membalas dalam satu hari kerja.', 'akdisi' ),
) );
?>

<section class="section section-bg">
	<div class="container mx-auto grid items-start gap-12 lg:grid-cols-[0.9fr_1.1fr]">
		<!-- Info -->
		<div data-reveal>
			<p class="eyebrow mb-4">Hubungi kami</p>
			<h2 class="section-title">Ingin jalur yang lebih cepat?</h2>
			<div class="mt-8 space-y-6">
				<div>
					<p class="text-xs font-semibold uppercase tracking-wide text-ink-faint">Email</p>
					<a href="mailto:hello@akdisi.com" class="mt-1 block text-lg font-semibold text-ink hover:text-brand">hello@akdisi.com</a>
				</div>
				<div>
					<p class="text-xs font-semibold uppercase tracking-wide text-ink-faint">WhatsApp</p>
					<a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="mt-1 block text-lg font-semibold text-ink hover:text-brand">+62 812-3456-7890</a>
				</div>
				<div>
					<p class="text-xs font-semibold uppercase tracking-wide text-ink-faint">Location</p>
					<p class="mt-1 text-lg font-semibold text-ink">Jambi, Indonesia</p>
				</div>
			</div>
			<div class="mt-10 rounded-2xl border border-paper-line bg-paper-alt p-6">
				<p class="text-sm leading-relaxed text-ink-soft">
					<strong class="text-ink">Jam kerja:</strong> Senin–Jumat, 09.00–17.00 WIB.
					Permintaan singkat biasanya dibalas di hari yang sama.
				</p>
			</div>
		</div>

		<!-- Form -->
		<div data-reveal class="rounded-2xl border border-paper-line bg-white p-7 shadow-[var(--shadow-card)] md:p-10">
			<form id="akdisi-contact-form" class="grid gap-5" novalidate>
				<div class="grid gap-5 sm:grid-cols-2">
					<div>
						<label for="f-name" class="mb-1.5 block text-sm font-medium text-ink">Nama</label>
						<input id="f-name" name="name" type="text" required autocomplete="name"
							class="w-full rounded-lg border border-paper-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-faint focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
						<p class="akdisi-field-error mt-1 hidden text-xs text-brand">Mohon isi nama Anda.</p>
					</div>
					<div>
						<label for="f-email" class="mb-1.5 block text-sm font-medium text-ink">Email</label>
						<input id="f-email" name="email" type="email" required autocomplete="email"
							class="w-full rounded-lg border border-paper-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-faint focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
						<p class="akdisi-field-error mt-1 hidden text-xs text-brand">Mohon isi email yang valid.</p>
					</div>
				</div>
				<div>
					<label for="f-company" class="mb-1.5 block text-sm font-medium text-ink">Perusahaan <span class="text-ink-faint">(opsional)</span></label>
					<input id="f-company" name="company" type="text"
						class="w-full rounded-lg border border-paper-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-faint focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
				</div>
				<div>
					<label for="f-budget" class="mb-1.5 block text-sm font-medium text-ink">Kisaran anggaran</label>
					<select id="f-budget" name="budget"
						class="w-full rounded-lg border border-paper-line bg-white px-4 py-3 text-sm text-ink focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
						<option value="">Pilih kisaran</option>
						<option>Di bawah Rp 25 juta</option>
						<option>Rp 25–75 juta</option>
						<option>Rp 75–200 juta</option>
						<option>Rp 200+ juta</option>
					</select>
				</div>
				<div>
					<label for="f-message" class="mb-1.5 block text-sm font-medium text-ink">Ceritakan tentang proyek Anda</label>
					<textarea id="f-message" name="message" rows="5" required
						class="w-full resize-y rounded-lg border border-paper-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-faint focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20"></textarea>
					<p class="akdisi-field-error mt-1 hidden text-xs text-brand">Mohon jelaskan proyek Anda secara singkat.</p>
				</div>

				<?php wp_nonce_field( 'akdisi_contact', 'akdisi_nonce' ); ?>
				<p class="akdisi-form-status hidden rounded-lg bg-brand-soft px-4 py-3 text-sm text-brand"></p>

				<button type="submit" class="btn btn-primary btn-lg w-full">
					Kirim pesan
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
				</button>
			</form>
		</div>
	</div>
</section>

<?php
get_footer();