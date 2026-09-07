<?php
/**
 * Template Name: Kontak
 * Page: /kontak/
 *
 * @package Perkasa
 */
get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'eyebrow' => __( 'Kontak', 'perkasa' ),
	'title'   => __( 'Hubungi kami untuk konsultasi proyek', 'perkasa' ),
	'sub'     => __( 'Ceritakan proyek Anda — kami akan merespons dalam 1 hari kerja.', 'perkasa' ),
) );
?>

<section class="section">
	<div class="container mx-auto px-5 lg:px-8">
		<div class="grid gap-12 lg:grid-cols-[1fr_1.3fr]">

			<!-- Info -->
			<div data-reveal>
				<h2 class="font-display text-2xl font-bold text-ink">Garuda Perkasa</h2>
				<p class="mt-2 text-ink-soft leading-relaxed">Kantor pusat kami di Jakarta Selatan. Kami melayani proyek di seluruh Indonesia.</p>

				<div class="mt-8 space-y-6 text-sm">
					<div>
						<p class="mb-1 font-semibold text-ink">Alamat</p>
						<p class="text-ink-soft">Jl. Raya Industri No. 88<br>Jakarta Selatan, DKI Jakarta 12345</p>
					</div>
					<div>
						<p class="mb-1 font-semibold text-ink">Telepon</p>
						<a href="tel:+622155501234" class="text-brand hover:underline">(021) 5550-1234</a>
					</div>
					<div>
						<p class="mb-1 font-semibold text-ink">Email</p>
						<a href="mailto:info@garudaperkasa.co.id" class="text-brand hover:underline">info@garudaperkasa.co.id</a>
					</div>
					<div>
						<p class="mb-1 font-semibold text-ink">WhatsApp</p>
						<a href="https://wa.me/6281234567890" class="text-brand hover:underline" target="_blank" rel="noopener">+62 812-3456-7890</a>
					</div>
					<div>
						<p class="mb-1 font-semibold text-ink">Jam Kerja</p>
						<p class="text-ink-soft">Senin – Jumat, 08.00 – 17.00 WIB</p>
					</div>
				</div>
			</div>

			<!-- Form -->
			<div data-reveal style="transition-delay:80ms">
				<div class="rounded-xl border border-paper-line bg-paper-alt p-6 md:p-8">
					<h3 class="font-display text-lg font-bold text-ink">Kirim Pesan</h3>
					<p class="mt-1 text-sm text-ink-soft">Isi form di bawah ini, kami akan merespons secepatnya.</p>

					<form id="perkasa-contact-form" class="mt-6 space-y-5" novalidate>
						<div>
							<label for="cf-name" class="mb-1 block text-sm font-medium text-ink">Nama Lengkap <span class="text-red-500">*</span></label>
							<input id="cf-name" name="name" type="text" required autocomplete="name"
								class="w-full rounded-lg border border-paper-line bg-white px-4 py-2.5 text-sm text-ink placeholder:text-ink-faint focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition-colors"
								placeholder="Budi Santoso">
							<p class="field-error mt-1 hidden text-xs text-red-600"></p>
						</div>
						<div>
							<label for="cf-email" class="mb-1 block text-sm font-medium text-ink">Email <span class="text-red-500">*</span></label>
							<input id="cf-email" name="email" type="email" required autocomplete="email"
								class="w-full rounded-lg border border-paper-line bg-white px-4 py-2.5 text-sm text-ink placeholder:text-ink-faint focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition-colors"
								placeholder="budi@perusahaan.co.id">
							<p class="field-error mt-1 hidden text-xs text-red-600"></p>
						</div>
						<div>
							<label for="cf-phone" class="mb-1 block text-sm font-medium text-ink">Telepon</label>
							<input id="cf-phone" name="phone" type="tel" autocomplete="tel"
								class="w-full rounded-lg border border-paper-line bg-white px-4 py-2.5 text-sm text-ink placeholder:text-ink-faint focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition-colors"
								placeholder="0812-xxxx-xxxx">
						</div>
						<div>
							<label for="cf-need" class="mb-1 block text-sm font-medium text-ink">Jenis Proyek <span class="text-red-500">*</span></label>
							<select id="cf-need" name="need" required
								class="w-full rounded-lg border border-paper-line bg-white px-4 py-2.5 text-sm text-ink focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition-colors">
								<option value="">Pilih jenis proyek…</option>
								<option value="konstruksi-gedung">Konstruksi Gedung</option>
								<option value="infrastruktur">Infrastruktur & Jalan</option>
								<option value="renovasi">Renovasi & Rehabilitasi</option>
								<option value="konsultasi">Konsultasi Teknis</option>
								<option value="lainnya">Lainnya</option>
							</select>
							<p class="field-error mt-1 hidden text-xs text-red-600"></p>
						</div>
						<div>
							<label for="cf-msg" class="mb-1 block text-sm font-medium text-ink">Pesan <span class="text-red-500">*</span></label>
							<textarea id="cf-msg" name="message" required rows="4"
								class="w-full rounded-lg border border-paper-line bg-white px-4 py-2.5 text-sm text-ink placeholder:text-ink-faint focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition-colors"
								placeholder="Ceritakan tentang proyek Anda…"></textarea>
							<p class="field-error mt-1 hidden text-xs text-red-600"></p>
						</div>
						<button type="submit" class="btn btn-primary w-full sm:w-auto">Kirim Pesan</button>
						<p class="perkasa-form-status hidden rounded-lg px-4 py-3 text-sm"></p>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>
