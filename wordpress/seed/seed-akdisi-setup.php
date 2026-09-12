<?php
/**
 * Seed Setup — AKDISI Theme (fresh install bootstrap).
 *
 * Jalankan setelah upload & aktivasi tema akdisi (dan plugin minimal
 * akdisi-info-manager — opsional, tema punya fallback):
 *
 *   ddev wp eval-file wordpress/seed/seed-akdisi-setup.php
 *
 * Idempotent by slug — aman dijalankan ulang / di instalasi yang sudah
 * punya data. Membuat:
 *   - Pages: Beranda (front), Layanan + 4 detail, Tentang, Testimoni,
 *     Use Case, Kontak, Solusi + 4 sub-halaman
 *   - Template assignment (page-*.php)
 *   - Menus + lokasi: Primary, Footer, Layanan Footer (footer-services)
 *   - Setting front page (show_on_front=page, page_on_front=Beranda)
 *
 * @package AKDISI
 */

/* ------------------------------------------------------------------ helpers */

function seed_akdisi_page_exists( $slug, $parent_id = 0 ) {
	global $wpdb;
	$id = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT ID FROM {$wpdb->posts} WHERE post_type='page' AND post_status='publish' AND post_name=%s AND post_parent=%d LIMIT 1",
			$slug,
			$parent_id
		)
	);
	return (int) $id;
}

/** Cari halaman berdasarkan slug; buat bila belum ada. Return ID. */
function seed_akdisi_ensure_page( $slug, $title, $template, $parent_id = 0, $content = '' ) {
	$id = seed_akdisi_page_exists( $slug, $parent_id );
	if ( ! $id ) {
		$id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_parent'  => $parent_id,
				'post_content' => $content,
			),
			true
		);
		if ( is_wp_error( $id ) ) {
			return 0;
		}
	}
	// Pastikan parent benar (untuk halaman yang sudah ada tapi salah induk).
	if ( $parent_id && (int) get_post_field( 'post_parent', $id ) !== (int) $parent_id ) {
		wp_update_post( array( 'ID' => $id, 'post_parent' => $parent_id ) );
	}
	// Template — isi hanya bila masih default, agar edit wp-admin dihormati.
	if ( 'default' === get_page_template_slug( $id ) && $template ) {
		update_post_meta( $id, '_wp_page_template', $template );
	}
	return $id;
}

/** Pastikan menu (by slug) ada; return menu term ID. */
function seed_akdisi_ensure_menu( $title, $slug ) {
	$menu = wp_get_nav_menu_object( $slug );
	if ( $menu ) {
		return (int) $menu->term_id;
	}
	$id = wp_create_nav_menu( $title );
	return is_wp_error( $id ) ? 0 : (int) $id;
}

/** Tambah item custom link ke menu bila URL belum ada. */
function seed_akdisi_menu_item( $menu_id, $label, $url ) {
	$items = wp_get_nav_menu_items( $menu_id );
	if ( $items ) {
		foreach ( $items as $it ) {
			if ( untrailingslashit( $it->url ) === untrailingslashit( $url ) ) {
				return; // sudah ada — idempotent.
			}
		}
	}
	wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-title'  => $label,
			'menu-item-url'    => $url,
			'menu-item-status' => 'publish',
		)
	);
}

/* ------------------------------------------------------------------ konten */

// Konten default halaman detail layanan (ringkas; bisa diedit wp-admin).
$layanan_details = array(
	'application-development' => array(
		'Pengembangan Aplikasi Kustom',
		'<p>Aplikasi yang tidak tersedia di pasaran, atau software existing yang tidak sesuai cara kerja organisasi, justru menambah beban tim. Kami membangun aplikasi yang mengikuti proses bisnis Anda.</p>
<p><strong>Apa yang bisa kami bangun:</strong></p>
<ul>
<li>Aplikasi web internal dan eksternal sesuai proses bisnis;</li>
<li>Sistem manajemen modular (data, dokumen, layanan, pelaporan);</li>
<li>Dashboard & monitoring real-time untuk pengambilan keputusan;</li>
<li>Sistem administrasi untuk pencatatan dan arsip digital.</li>
</ul>
<p><strong>Manfaat:</strong> data terpusat dan akurat, sistem berkembang bertahap seiring pertumbuhan bisnis, dan keputusan berbasis data yang andal.</p>
<p><strong>Proses:</strong> konsultasi kebutuhan → analisis & rencana solusi → desain & pengembangan → implementasi, pelatihan, dan dukungan berkelanjutan.</p>',
	),
	'business-process-digitalization' => array(
		'Digitalisasi Proses Bisnis',
		'<p>Banyak proses bisnis masih berjalan manual: pekerjaan berulang, data dipindah tangan berkali-kali, laporan disusun dari banyak sumber. Hasilnya lambat, rawan kesalahan, dan sulit dilacak.</p>
<p><strong>Contoh penggunaan:</strong></p>
<ul>
<li>Alur persetujuan (approval) yang sebelumnya lewat email atau dokumen cetak;</li>
<li>Pencatatan administrasi menjadi digital dan otomatis;</li>
<li>Monitoring proses kerja yang sebelumnya sulit diamati;</li>
<li>Pelaporan berkala yang sebelumnya memakan waktu berhari-hari.</li>
</ul>
<p><strong>Apa yang bisa kami bangun:</strong> digitalisasi workflow sesuai alur kerja organisasi, sistem approval dengan jejak jelas, notifikasi otomatis, dan pelaporan dari data terpusat.</p>
<p><strong>Proses:</strong> pemetaan proses & identifikasi hambatan → perancangan workflow digital → pengembangan & pengujian → implementasi dan pendampingan.</p>',
	),
	'data-administration-systems' => array(
		'Sistem Administrasi & Data',
		'<p>Data anggota, unit, pelanggan, dan dokumen tersebar di spreadsheet, file, dan kertas. Setiap membutuhkan data, harus mencarinya ke beberapa tempat. Laporan pun disusun manual dan sering terlambat.</p>
<p><strong>Contoh penggunaan:</strong></p>
<ul>
<li>Sistem data anggota, penghuni, atau unit yang terpusat;</li>
<li>Pengelolaan dokumen dan arsip digital;</li>
<li>Pencatatan layanan, iuran, dan transaksi;</li>
<li>Pelaporan berkala yang tersusun otomatis.</li>
</ul>
<p><strong>Apa yang bisa kami bangun:</strong> dashboard data terpusat dengan akses sesuai peran pengguna, manajemen dokumen dengan pencarian mudah, dan pelaporan otomatis untuk kebutuhan operasional dan manajemen.</p>
<p><strong>Proses:</strong> identifikasi data & kebutuhan akses → perancangan struktur data → pengembangan sistem → pelatihan dan dukungan.</p>',
	),
	'custom-business-solutions' => array(
		'Solusi Bisnis Kustom',
		'<p>Setiap organisasi punya kebutuhan unik yang tidak selalu terwakili software siap pakai. Solusi kustom menggabungkan aplikasi internal, integrasi antar sistem, dan digitalisasi operasional dalam satu pendekatan terpadu.</p>
<p><strong>Kapan butuh solusi kustom:</strong></p>
<ul>
<li>Proses spesifik yang tidak didukung software generik;</li>
<li>Beberapa sistem terpisah yang ingin digabung;</li>
<li>Kebutuhan mobile (web responsive) untuk tim lapangan;</li>
<li>Integrasi antara website, aplikasi, dan data internal.</li>
</ul>
<p><strong>Apa yang bisa kami bangun:</strong> aplikasi terpadu, integrasi API, sistem internal khusus, dan automation untuk pekerjaan berulang — dikerjakan bertahap sesuai prioritas bisnis.</p>
<p><strong>Proses:</strong> workshop kebutuhan → analisis gap & arsitektur → pengembangan bertahap → implementasi dan evaluasi berkala.</p>',
	),
);

// Konten default halaman Solusi (parent + 4 sub).
$solusi_pages = array(
	array( 'solutions', 'Solusi', 'Solusi AKDISI dikelompokkan per sektor agar mudah ditemukan. Pilih sektor Anda untuk melihat bagaimana proses manual bisa menjadi sistem yang terukur.' ),
	array( 'housing', 'Solusi Perumahan', 'Sistem untuk pengembang dan pengelola perumahan: manajemen unit, booking, iuran, dan komunikasi penghuni dalam satu platform.' ),
	array( 'developer', 'Solusi Developer', 'Untuk developer properti: manajemen pemasaran (marketing sales), booking real-time dengan peta kavling, CRM, dan laporan penjualan.' ),
	array( 'property', 'Solusi Properti', 'Untuk pengelola properti: billing iuran otomatis, portal warga, pengaduan & maintenance tracking yang terukur.' ),
	array( 'organization', 'Solusi Organisasi', 'Untuk asosiasi dan organisasi: keanggotaan digital, manajemen event, sertifikasi, dan data anggota yang terpusat.' ),
);

/* ------------------------------------------------------------------ jalankan */

$home_id  = seed_akdisi_ensure_page( 'home', 'Beranda', '', 0, '<p>Selamat datang di AKDISI.</p>' );
$layanan  = seed_akdisi_ensure_page( 'layanan', 'Layanan', 'page-layanan.php' );

foreach ( $layanan_details as $slug => $d ) {
	seed_akdisi_ensure_page( $slug, $d[0], '', $layanan, $d[1] );
}

$tentang  = seed_akdisi_ensure_page( 'tentang', 'Tentang', 'page-tentang.php' );
$testim   = seed_akdisi_ensure_page( 'testimoni', 'Testimoni', 'page-testimonials.php' );
$use_case = seed_akdisi_ensure_page( 'use-cases', 'Use Case', 'page-use-cases.php' );
$kontak   = seed_akdisi_ensure_page( 'kontak', 'Kontak', 'page-kontak.php' );

$solutions = 0;
foreach ( $solusi_pages as $i => $s ) {
	$parent = 0 === $i ? 0 : $solutions;
	$id = seed_akdisi_ensure_page( $s[0], $s[1], '', $parent, '<h2>' . esc_html( $s[2] ) . '</h2>' );
	if ( 0 === $i ) {
		$solutions = $id;
	}
}

$home_url = home_url( '/' );

// Menu Primary (navbar).
$primary = seed_akdisi_ensure_menu( 'Primary Menu', 'primary-menu' );
$primary_items = array(
	'Beranda'   => $home_url,
	'Layanan'   => home_url( '/layanan/' ),
	'Proyek'    => home_url( '/projects/' ),
	'Tentang'   => home_url( '/tentang/' ),
	'Testimoni' => home_url( '/testimoni/' ),
	'Use Case'  => home_url( '/use-cases/' ),
	'Insight'   => home_url( '/insight/' ),
	'Kontak'    => home_url( '/kontak/' ),
);
foreach ( $primary_items as $label => $url ) {
	seed_akdisi_menu_item( $primary, $label, $url );
}

// Menu Footer (Perusahaan).
$footer = seed_akdisi_ensure_menu( 'Footer Menu', 'footer-menu' );
foreach ( array(
	'Tentang'   => home_url( '/tentang/' ),
	'Proyek'    => home_url( '/projects/' ),
	'Use Case'  => home_url( '/use-cases/' ),
	'Insight'   => home_url( '/insight/' ),
	'Kontak'    => home_url( '/kontak/' ),
) as $label => $url ) {
	seed_akdisi_menu_item( $footer, $label, $url );
}

// Menu Layanan Footer (location footer-services) — 4 detail layanan.
$svc_footer = seed_akdisi_ensure_menu( 'Layanan Footer', 'layanan-footer' );
foreach ( $layanan_details as $slug => $d ) {
	seed_akdisi_menu_item( $svc_footer, $d[0], home_url( '/layanan/' . $slug . '/' ) );
}

// Assign locations.
$locations = get_theme_mod( 'nav_menu_locations', array() );
$locations['primary']         = $primary;
$locations['footer']          = $footer;
$locations['footer-services'] = $svc_footer;
set_theme_mod( 'nav_menu_locations', $locations );

// Front page.
if ( 'page' !== get_option( 'show_on_front' ) || (int) get_option( 'page_on_front' ) !== $home_id ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home_id );
	update_option( 'page_for_posts', 0 );
}

flush_rewrite_rules();

echo "[seed-akdisi] done — home=$home_id layanan=$layanan primary=$primary footer=$footer layanan-footer=$svc_footer\n";