<?php
/**
 * AKDISI template helpers.
 *
 * Arsitektur konten (v4.8.0 — "cukup yang perlu saja yang dinamis"):
 *  - Kontak & SMTP  : plugin akdisi-info-manager (menu Info Website)
 *  - Proyek & Klien : CPT via plugin akdisi-info-manager
 *  - Insight        : Pos (post) bawaan WordPress
 *  - Layanan, proses, nilai, use case, skema, statistik : statis di sini
 *    (bagian dari desain template — diedit lewat kode, bukan wp-admin)
 *
 * @package AKDISI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fallback primary menu when none is assigned.
 *
 * @param array $args wp_nav_menu args.
 */
function akdisi_fallback_menu( $args = array() ) {
	$items = array(
		__( 'Layanan', 'akdisi' )    => home_url( '/layanan/' ),
		__( 'Proyek', 'akdisi' )     => home_url( '/projects/' ),
		__( 'Tentang', 'akdisi' )    => home_url( '/tentang/' ),
		__( 'Insight', 'akdisi' )    => home_url( '/insight/' ),
		__( 'Kontak', 'akdisi' )     => home_url( '/kontak/' ),
	);
	printf( '<ul class="%s">', isset( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : '' );
	foreach ( $items as $label => $url ) {
		$cls = ( is_page( wp_parse_url( $url, PHP_URL_PATH ) ) ) ? 'text-brand' : 'hover:text-brand';
		printf( '<li><a class="text-sm font-medium %s" href="%s">%s</a></li>', $cls, esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Fallback footer menu.
 */
function akdisi_fallback_footer() {
	$links = array(
		__( 'Tentang', 'akdisi' )   => home_url( '/tentang/' ),
		__( 'Proyek', 'akdisi' )    => home_url( '/projects/' ),
		__( 'Insight', 'akdisi' )   => home_url( '/insight/' ),
		__( 'Kontak', 'akdisi' )    => home_url( '/kontak/' ),
	);
	echo '<ul class="space-y-2 text-sm">';
	foreach ( $links as $label => $url ) {
		printf( '<li><a href="%s" class="hover:text-white">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Footer services quick-links — 4 layanan inti (custom app development).
 * Dipakai sebagai fallback menu lokasi `footer-services` (menu WP lebih diutamakan).
 *
 * @return array<string,string>
 */
function akdisi_footer_services() {
	return array(
		__( 'Pengembangan Aplikasi Kustom', 'akdisi' ) => home_url( '/layanan/application-development/' ),
		__( 'Digitalisasi Proses Bisnis', 'akdisi' )   => home_url( '/layanan/business-process-digitalization/' ),
		__( 'Sistem Administrasi & Data', 'akdisi' )   => home_url( '/layanan/data-administration-systems/' ),
		__( 'Solusi Bisnis Kustom', 'akdisi' )         => home_url( '/layanan/custom-business-solutions/' ),
	);
}

/* -------------------------------------------------------------------------
 * Info Kontak — plugin akdisi-info-manager (Info Website → Info Perusahaan),
 * fallback default bila plugin nonaktif.
 * ---------------------------------------------------------------------- */

/**
 * Ambil kontak perusahaan.
 *
 * @param string $key Kunci kontak (email/phone/whatsapp/location/hours/address), '' = semua.
 * @return string|array
 */
function akdisi_get_contact( $key = '' ) {
	$defaults = array(
		'email'    => 'hello@akdisi.com',
		'phone'    => '+62 812-3456-7890',
		'whatsapp' => '6281234567890',
		'location' => 'Jambi, Indonesia',
		'hours'    => 'Senin–Jumat, 09.00–17.00 WIB. Permintaan singkat biasanya dibalas di hari yang sama.',
		'address'  => '',
	);

	$contact = function_exists( 'akdisi_im_contact' ) ? akdisi_im_contact() : $defaults;

	return $key ? ( $contact[ $key ] ?? '' ) : $contact;
}

/**
 * Link WhatsApp telanjang digit (wa.me/<angka>).
 *
 * @return string
 */
function akdisi_wa_link() {
	return 'https://wa.me/' . preg_replace( '/[^0-9]/', '', akdisi_get_contact( 'whatsapp' ) );
}

/* -------------------------------------------------------------------------
 * Konten statis — layanan, proses, nilai, use case, skema, statistik.
 * (Diedit langsung di template/helper; bukan via wp-admin.)
 * ---------------------------------------------------------------------- */

/**
 * Layanan (Beranda 4 kartu + halaman Layanan).
 *
 * @return array
 */
function akdisi_get_services() {
	return array(
		array(
			'title'  => __( 'Strategi Produk', 'akdisi' ),
			'desc'   => __( 'Riset pasar, peta jalan, dan positioning yang memastikan Anda membangun hal yang benar sejak awal.', 'akdisi' ),
			'icon'   => 'M3 17l6-6 4 4 8-8M3 21h18',
			'detail' => __( 'Riset pasar, analisis kompetitor, dan peta jalan prioritas yang memastikan Anda membangun hal yang tepat.', 'akdisi' ),
			'points' => array( __( 'Workshop penemuan', 'akdisi' ), __( 'Scoping MVP & peta jalan', 'akdisi' ), __( 'Positioning & penamaan', 'akdisi' ), __( 'Analisis kompetitif', 'akdisi' ) ),
		),
		array(
			'title'  => __( 'Desain UI/UX', 'akdisi' ),
			'desc'   => __( 'Antarmuka yang mudah dipakai sehingga pengunjung betah dan kembali lagi — diteliti, diuji, disempurnakan.', 'akdisi' ),
			'icon'   => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8',
			'detail' => __( 'Antarmuka dan design system yang terasa pas — diteliti, diprototipe, dan diuji dengan pengguna nyata.', 'akdisi' ),
			'points' => array( __( 'Wireframe & prototipe', 'akdisi' ), __( 'Design system', 'akdisi' ), __( 'Uji kegunaan', 'akdisi' ), __( 'Design token & dokumentasi', 'akdisi' ) ),
		),
		array(
			'title'  => __( 'Pengembangan Website & Aplikasi', 'akdisi' ),
			'desc'   => __( 'Website dan aplikasi yang cepat, aman, dan siap berkembang — dari profil perusahaan hingga platform SaaS.', 'akdisi' ),
			'icon'   => 'M8 9l3 3-3 3m5 0h3M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5z',
			'detail' => __( 'Produk cepat, aman, dan mudah dirawat di atas stack modern — dari situs marketing hingga platform SaaS.', 'akdisi' ),
			'points' => array( __( 'Tema WordPress kustom', 'akdisi' ), __( 'Aplikasi React / Node', 'akdisi' ), __( 'Desain & integrasi API', 'akdisi' ), __( 'Performa & aksesibilitas', 'akdisi' ) ),
		),
		array(
			'title'  => __( 'Pertumbuhan & Pemasaran', 'akdisi' ),
			'desc'   => __( 'SEO, analitik, dan program konversi yang mendatangkan pelanggan baru secara konsisten.', 'akdisi' ),
			'icon'   => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
			'detail' => __( 'SEO, analitik, dan program konversi yang terus memberi hasil setelah tayang — bukan metrik vanity.', 'akdisi' ),
			'points' => array( __( 'SEO teknis', 'akdisi' ), __( 'Analitik & funnel', 'akdisi' ), __( 'Sistem landing page', 'akdisi' ), __( 'Operasi konten', 'akdisi' ) ),
		),
	);
}

/**
 * Proses 4 langkah (Beranda).
 *
 * @return array
 */
function akdisi_get_process_steps() {
	return array(
		array( 'title' => __( 'Temukan', 'akdisi' ), 'desc' => __( 'Workshop mendalam, riset pengguna, dan definisi selesai yang jelas.', 'akdisi' ) ),
		array( 'title' => __( 'Rancang', 'akdisi' ), 'desc' => __( 'Dari wireframe hingga UI final, divalidasi pengguna nyata di tiap tahap.', 'akdisi' ) ),
		array( 'title' => __( 'Bangun', 'akdisi' ), 'desc' => __( 'Engineering berbasis sprint dengan demo setiap Jumat — bukan kotak hitam.', 'akdisi' ) ),
		array( 'title' => __( 'Luncurkan & Kembangkan', 'akdisi' ), 'desc' => __( 'Tayang, ukur, perbaiki. Kami tetap mendampingi untuk optimasi dan dukungan.', 'akdisi' ) ),
	);
}

/**
 * Nilai (halaman Tentang).
 *
 * @return array
 */
function akdisi_get_values() {
	return array(
		array( 'title' => __( 'Bertanggung jawab atas hasil', 'akdisi' ), 'desc' => __( 'Kami diukur dari metrik Anda — peluncuran, konversi, retensi — bukan dari jam yang ditagih.', 'akdisi' ) ),
		array( 'title' => __( 'Senior, selalu', 'akdisi' ), 'desc' => __( 'Orang di kickoff Anda adalah orang yang mengerjakan produknya. Tanpa jualan nama lalu operan.', 'akdisi' ) ),
		array( 'title' => __( 'Keandalan yang membosankan', 'akdisi' ), 'desc' => __( 'Demo konsisten, timeline jujur, bahasa yang jelas. Kegembiraan seharusnya datang dari produknya.', 'akdisi' ) ),
	);
}

/**
 * Use cases (halaman Use Cases).
 *
 * @return array
 */
function akdisi_get_use_cases() {
	return array(
		array( 'title' => __( 'Manajemen unit & sales perumahan', 'akdisi' ), 'desc' => __( 'Dari Excel dan grup WA jadi sistem booking real-time dengan peta kavling interaktif.', 'akdisi' ), 'stack' => 'Web app · CRM · Dashboard', 'tag' => 'Properti', 'url' => home_url( '/solutions/developer/' ) ),
		array( 'title' => __( 'Iuran & pengaduan perumahan digital', 'akdisi' ), 'desc' => __( 'Billing otomatis, portal warga, dan tracking maintenance dalam satu sistem.', 'akdisi' ), 'stack' => 'Billing · Portal warga', 'tag' => 'Properti', 'url' => home_url( '/solutions/property/' ) ),
		array( 'title' => __( 'Keanggotaan & sertifikasi digital', 'akdisi' ), 'desc' => __( 'Data anggota dan event asosiasi yang sebelumnya tersebar kini terpusat dan otomatis.', 'akdisi' ), 'stack' => 'Membership · Event', 'tag' => 'Asosiasi', 'url' => home_url( '/solutions/organization/' ) ),
		array( 'title' => __( 'Inventori multi-gudang & distribusi', 'akdisi' ), 'desc' => __( 'Bukti AKDISI melayani proses operasional kompleks di luar properti.', 'akdisi' ), 'stack' => 'Inventory · Multi-lokasi', 'tag' => 'Bisnis Lain', 'url' => home_url( '/projects/' ) ),
	);
}

/**
 * Skema kerja sama (halaman Layanan).
 *
 * @return array
 */
function akdisi_get_engagements() {
	return array(
		array( 'title' => __( 'Tim Sprint', 'akdisi' ), 'desc' => __( 'Tim senior bergabung dengan tim Anda untuk satu sprint tetap (2–4 minggu). Demo mingguan, transparan penuh.', 'akdisi' ), 'note' => __( 'Cocok saat Anda punya momentum dan butuh kapasitas cepat.', 'akdisi' ) ),
		array( 'title' => __( 'Retainer Produk', 'akdisi' ), 'desc' => __( 'Kemitraan desain + engineering berkelanjutan dengan backlog bersama dan prioritas bulanan.', 'akdisi' ), 'note' => __( 'Cocok jika Anda rilis terus-menerus dan ingin satu tim yang bertanggung jawab.', 'akdisi' ) ),
		array( 'title' => __( 'Lingkup Tetap', 'akdisi' ), 'desc' => __( 'Deliverable, milestone, dan harga yang jelas. Ideal untuk peluncuran atau rebuild tertentu.', 'akdisi' ), 'note' => __( 'Cocok saat lingkup sudah pasti dan anggaran tetap.', 'akdisi' ) ),
	);
}

/**
 * Statistik per grup.
 *
 * @param string $group hero (strip beranda) | why (band gelap) | about (tentang).
 * @return array<int,array{value:string,label:string}>
 */
function akdisi_get_stats( $group = 'hero' ) {
	$all = array(
		'hero'  => array(
			array( 'value' => '40+', 'label' => __( 'Proyek selesai', 'akdisi' ) ),
			array( 'value' => '12', 'label' => __( 'Industri dilayani', 'akdisi' ) ),
			array( 'value' => '98%', 'label' => __( 'Klien kembali', 'akdisi' ) ),
		),
		'why'   => array(
			array( 'value' => '40+', 'label' => __( 'Proyek selesai di 12 industri', 'akdisi' ) ),
			array( 'value' => '6 mgg', 'label' => __( 'Rata-rata waktu konsep hingga tayang', 'akdisi' ) ),
			array( 'value' => '98%', 'label' => __( 'Klien yang kembali untuk proyek berikutnya', 'akdisi' ) ),
			array( 'value' => '4.9/5', 'label' => __( 'Rating rata-rata dari klien', 'akdisi' ) ),
		),
		'about' => array(
			array( 'value' => '2019', 'label' => __( 'Didirikan di Jambi sebagai studio web dua orang.', 'akdisi' ) ),
			array( 'value' => '40+', 'label' => __( 'Proyek selesai di 12 industri', 'akdisi' ) ),
			array( 'value' => '12', 'label' => __( 'Orang, semua senior — tanpa yang belajar sambil jalan', 'akdisi' ) ),
			array( 'value' => '98%', 'label' => __( 'Klien kembali untuk kerja sama berikutnya', 'akdisi' ) ),
		),
	);
	return $all[ $group ] ?? array();
}

/* -------------------------------------------------------------------------
 * Klien marquee — CPT `akdisi_client` (plugin), fallback statis.
 * ---------------------------------------------------------------------- */

/**
 * Klien marquee (Beranda).
 *
 * @return string[]
 */
function akdisi_get_clients() {
	$items = array();
	if ( post_type_exists( 'akdisi_client' ) ) {
		$q = new WP_Query(
			array(
				'post_type'      => 'akdisi_client',
				'posts_per_page' => 30,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'no_found_rows'  => true,
				'post_status'    => 'publish',
			)
		);
		foreach ( $q->posts as $post ) {
			$items[] = $post->post_title;
		}
		wp_reset_postdata();
	}
	if ( empty( $items ) ) {
		$items = array( 'NORTHBOUND', 'Halcyon', 'Meridian Co.', 'Kestrel', 'Atelier 9', 'Vantage' );
	}
	return $items;
}
