<?php
/**
 * Template Name: Kontak
 * Template Post Type: page
 *
 * Halaman kontak + form lead — Garuda Perkasa v3.
 * Form client-side validasi (inline error + fokus field pertama), tanpa backend —
 * proyek fiktif.
 *
 * @package Garuda_Perkasa
 */

get_header();

$perkasa_contact = array(
	array( 't' => 'Alamat kantor', 'v' => perkasa_get_contact( 'address' ), 'i' => 'pin' ),
	array( 't' => 'Telepon', 'v' => perkasa_get_contact( 'phone' ), 'i' => 'tel' ),
	array( 't' => 'Email', 'v' => perkasa_get_contact( 'email' ), 'i' => 'mail' ),
	array( 't' => 'WhatsApp', 'v' => perkasa_wa_display( perkasa_get_contact( 'whatsapp' ) ), 'i' => 'wa' ),
);
?>

<main id="perkasa-main">

	<section class="bp-grid relative overflow-hidden bg-[#060a12] text-white" aria-labelledby="page-title">
		<div class="pointer-events-none absolute inset-0" aria-hidden="true">
			<div data-parallax="8" class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-amber-500/15 blur-[110px]"></div>
		</div>
		<div class="relative mx-auto max-w-7xl px-5 pb-16 pt-28 lg:pb-20 lg:pt-40">
			<p class="eyebrow spec-label mb-5 text-amber-500" data-reveal>Kontak</p>
			<h1 id="page-title" class="font-display text-4xl font-black uppercase leading-[0.95] tracking-tight sm:text-6xl lg:text-7xl" data-reveal>
				Mulai Dari<br><span class="text-amber-500">Percakapan</span>
			</h1>
			<p class="mt-6 max-w-xl text-sm leading-relaxed text-slate-300 sm:text-base" data-reveal>
				Isi formulir — tim kami membalas dalam 1 hari kerja. Konsultasi 30 menit
				pertama gratis, tanpa komitmen.
			</p>
		</div>
	</section>

	<section class="bg-paper py-20 lg:py-28" aria-label="Formulir kontak">
		<div class="mx-auto grid max-w-7xl gap-10 px-5 lg:grid-cols-[0.85fr_1.15fr]">

			<!-- Info -->
			<div class="space-y-4" data-reveal>
				<?php foreach ( $perkasa_contact as $c ) : ?>
					<div class="gp-card flex items-start gap-4 p-5">
						<span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-amber-500 font-display text-sm font-black text-[#060a12]" aria-hidden="true"><?php echo esc_html( $c['i'][0] ); ?></span>
						<div>
							<p class="spec-label text-slate-400"><?php echo esc_html( $c['t'] ); ?></p>
							<p class="mt-1 text-sm font-semibold text-slate-700"><?php echo esc_html( $c['v'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>

				<div class="gp-card p-5">
					<p class="spec-label text-slate-400">Jam operasional</p>
					<p class="mt-1 text-sm font-semibold text-slate-700">Senin–Jumat, 08.00–17.00 WIB</p>
					<p class="mt-2 text-xs text-slate-400">Kunjungan site dapat dijadwalkan di luar jam kerja.</p>
				</div>

				<div class="rounded-lg border border-amber-200 bg-amber-50 p-5">
					<p class="flex items-center gap-2 text-sm font-bold text-amber-700">
						<span aria-hidden="true">✦</span> Respons 1 hari kerja
					</p>
					<p class="mt-1.5 text-xs leading-relaxed text-amber-700/80">
						94% pertanyaan dijawab dalam 24 jam. Pesan di luar jam kerja akan
						dibalas pada hari kerja berikutnya.
					</p>
				</div>
			</div>

			<!-- Form -->
			<div class="gp-card relative overflow-hidden p-8 lg:p-10" data-reveal>
				<span class="giant-num absolute -right-4 -top-7 text-[8rem]" aria-hidden="true">K</span>

				<form id="perkasa-contact-form" class="relative" novalidate>
					<div class="grid gap-5 sm:grid-cols-2">
						<div>
							<label class="form-label" for="f-nama">Nama lengkap</label>
							<input class="form-input" id="f-nama" name="nama" type="text" autocomplete="name" placeholder="Nama Anda" required>
							<p class="field-error hidden" id="f-nama-error"></p>
						</div>
						<div>
							<label class="form-label" for="f-email">Email</label>
							<input class="form-input" id="f-email" name="email" type="email" autocomplete="email" placeholder="nama@perusahaan.com" required>
							<p class="field-error hidden" id="f-email-error"></p>
						</div>
					</div>

					<div class="mt-5 grid gap-5 sm:grid-cols-2">
						<div>
							<label class="form-label" for="f-telp">No. telepon / WhatsApp</label>
							<input class="form-input" id="f-telp" name="telp" type="tel" autocomplete="tel" placeholder="08xx-xxxx-xxxx" required>
							<p class="field-error hidden" id="f-telp-error"></p>
						</div>
						<div>
							<label class="form-label" for="f-jenis">Jenis proyek</label>
							<select class="form-input" id="f-jenis" name="jenis" required>
								<option value="">— Pilih jenis proyek —</option>
								<option>Konstruksi Gedung</option>
								<option>Infrastruktur &amp; Jalan</option>
								<option>Renovasi &amp; Rehabilitasi</option>
								<option>Konsultasi &amp; Manajemen</option>
								<option>Lainnya</option>
							</select>
							<p class="field-error hidden" id="f-jenis-error"></p>
						</div>
					</div>

					<div class="mt-5">
						<label class="form-label" for="f-pesan">Ceritakan kebutuhan Anda</label>
						<textarea class="form-input" id="f-pesan" name="pesan" rows="5" placeholder="Lokasi, perkiraan luas, target waktu…" required></textarea>
						<p class="field-error hidden" id="f-pesan-error"></p>
					</div>

					<div class="mt-7 flex flex-wrap items-center gap-4">
						<button type="submit" class="btn btn-amber">Kirim Permintaan</button>
						<p class="text-xs text-slate-400">Atau langsung via WhatsApp — lebih cepat.</p>
					</div>
				</form>

				<!-- Success (simulasi) -->
				<div id="perkasa-form-success" class="hidden rounded-lg border border-emerald-200 bg-emerald-50 p-8 text-center" role="status" aria-live="polite">
					<p class="font-display text-xl font-black text-emerald-700">Permintaan terkirim.</p>
					<p class="mt-2 text-sm text-emerald-700/80">
						Terima kasih — tim Garuda Perkasa akan menghubungi Anda dalam
						1 hari kerja. Simulasi form (proyek fiktif).
					</p>
					<a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D+/', '', perkasa_get_contact( 'whatsapp' ) ) ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-ink mt-5" data-ga-track="form_success_wa">Lanjut via WhatsApp</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();