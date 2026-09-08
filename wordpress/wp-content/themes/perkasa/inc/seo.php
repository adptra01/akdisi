<?php
/**
 * SEO — pola output Yoast SEO (homegrown, tanpa plugin).
 *
 * Meniru struktur output Yoast SEO untuk instalasi tema sendiri:
 *  - meta description per-halaman (excerpt → auto-generate dari konten → tagline)
 *  - robots meta (index/follow; noindex pada 404 & pencarian)
 *  - canonical URL
 *  - Open Graph (locale, type, title, description, url, site_name, image)
 *  - Twitter Card (summary_large_image bila ada gambar)
 *  - Schema.org JSON-LD: Organization + WebSite, Article pada single post
 *  - title tag format Yoast: {judul} – {nama situs}
 *
 * Identitas menggunakan theme_mods (perkasa_company_name/tagline) — BUKAN
 * get_bloginfo(), karena instalasi WP dipakai dua tema (AKDISI + Perkasa)
 * dan blogname global milik AKDISI.
 *
 * @package Garuda_Perkasa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Canonical dikelola sendiri (perkasa_seo_meta) — matikan output core WP
// supaya tidak dobel (pola Yoast SEO: satu canonical per halaman).
remove_action( 'wp_head', 'rel_canonical', 10 );

/* -------------------------------------------------------------------------
 * Identitas perusahaan (SEO)
 * ---------------------------------------------------------------------- */

/**
 * Nama perusahaan untuk SEO — theme_mod, bukan blogname global ('AKDISI').
 *
 * @return string
 */
function perkasa_site_name() {
	return get_theme_mod( 'perkasa_company_name', 'Garuda Perkasa' );
}

/**
 * Tagline perusahaan untuk SEO/OG — theme_mod.
 *
 * @return string
 */
function perkasa_site_tagline() {
	return get_theme_mod(
		'perkasa_company_tagline',
		'Perusahaan konstruksi & sipil Indonesia sejak 1999 — gedung, infrastruktur, renovasi, dan konsultasi. Tepat waktu, tepat mutu.'
	);
}

/* -------------------------------------------------------------------------
 * Title tag (format Yoast: {judul} – {nama situs})
 * ---------------------------------------------------------------------- */
function perkasa_seo_document_title( $title ) {
	$site = perkasa_site_name();

	if ( is_front_page() ) {
		$tagline = perkasa_site_tagline();
		return $tagline ? perkasa_site_name() . ' – ' . $tagline : perkasa_site_name();
	}

	if ( is_404() ) {
		return 'Halaman tidak ditemukan – ' . $site;
	}

	if ( is_search() ) {
		return sprintf( 'Pencarian: %s – %s', get_search_query(), $site );
	}

	if ( is_singular() ) {
		$post = get_queried_object();
		return $post->post_title . ' – ' . $site;
	}

	if ( is_archive() ) {
		return wp_strip_all_tags( get_the_archive_title() ) . ' – ' . $site;
	}

	return $title ? $title : $site;
}
add_filter( 'pre_get_document_title', 'perkasa_seo_document_title' );

/* -------------------------------------------------------------------------
 * Meta description per halaman
 * ---------------------------------------------------------------------- */
function perkasa_seo_description() {
	if ( is_front_page() ) {
		return perkasa_site_tagline();
	}

	if ( is_404() ) {
		return 'Halaman yang Anda cari tidak ditemukan.';
	}

	if ( is_search() ) {
		return sprintf( 'Hasil pencarian untuk "%s".', get_search_query() );
	}

	if ( is_singular() ) {
		$post = get_queried_object();

		// Excerpt (Yoast: meta description field / excerpt) adalah sumber utama.
		if ( ! empty( $post->post_excerpt ) ) {
			return wp_strip_all_tags( $post->post_excerpt );
		}

		// Fallback: auto-generate dari konten (pola Yoast "meta description
		// auto" saat field kosong).
		$content = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
		$content = preg_replace( '/\s+/', ' ', trim( $content ) );
		$auto    = wp_trim_words( $content, 28, '…' );
		if ( $auto ) {
			return $auto;
		}
	}

	if ( is_archive() ) {
		$desc = get_the_archive_description();
		if ( $desc ) {
			return wp_strip_all_tags( $desc );
		}
	}

	// Fallback terakhir.
	return perkasa_site_tagline();
}

/* -------------------------------------------------------------------------
 * Canonical URL
 * ---------------------------------------------------------------------- */
function perkasa_seo_canonical() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}

	if ( is_singular() ) {
		return get_permalink();
	}

	if ( is_404() ) {
		return '';
	}

	return home_url( add_query_arg( array(), $GLOBALS['wp']->request ) );
}

/* -------------------------------------------------------------------------
 * Gambar Open Graph (featured image ukuran perkasa-wide)
 * ---------------------------------------------------------------------- */
function perkasa_seo_og_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		$id   = get_post_thumbnail_id();
		$src  = wp_get_attachment_image_src( $id, 'perkasa-wide' );
		if ( $src ) {
			return array(
				'url'    => $src[0],
				'width'  => $src[1],
				'height' => $src[2],
				'type'   => get_post_mime_type( $id ),
			);
		}
	}
	return false;
}

/* -------------------------------------------------------------------------
 * Robots — via filter wp_robots (pola Yoast), bukan echo meta sendiri,
 * sehingga tidak dobel dengan output core WordPress.
 * ---------------------------------------------------------------------- */
function perkasa_seo_robots( $robots ) {
	if ( is_404() || is_search() ) {
		$robots['noindex'] = true;
	} else {
		$robots['index'] = true;
	}

	$robots['max-image-preview'] = 'large';
	$robots['max-snippet']       = '-1';
	$robots['max-video-preview'] = '-1';

	return $robots;
}
add_filter( 'wp_robots', 'perkasa_seo_robots' );

/* -------------------------------------------------------------------------
 * Output meta di <head> (prioritas 5, setelah wp_head)
 * ---------------------------------------------------------------------- */
function perkasa_seo_meta() {
	$title     = wp_get_document_title();
	$desc      = perkasa_seo_description();
	$canonical = perkasa_seo_canonical();
	$img       = perkasa_seo_og_image();
	$site      = perkasa_site_name();

	// Open Graph type — home/archive/search = website, singuler lain = article
	// (pola Yoast; front page statis bukan article walau is_singular()).
	$og_type = is_front_page() ? 'website' : ( is_singular() ? 'article' : 'website' );

	// Description.
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );

	// Canonical.
	if ( $canonical ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonical ) );
	}

	// Open Graph.
	printf( '<meta property="og:locale" content="id_ID">' . "\n" );
	printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $og_type ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	if ( $canonical ) {
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $canonical ) );
	}
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( $site ) );
	if ( $img ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $img['url'] ) );
		if ( $img['width'] ) {
			printf( '<meta property="og:image:width" content="%d">' . "\n", (int) $img['width'] );
		}
		if ( $img['height'] ) {
			printf( '<meta property="og:image:height" content="%d">' . "\n", (int) $img['height'] );
		}
	}

	// Twitter Card.
	printf( '<meta name="twitter:card" content="%s">' . "\n", $img ? 'summary_large_image' : 'summary' );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $desc ) );

	echo "\n";
}
add_action( 'wp_head', 'perkasa_seo_meta', 5 );

/* -------------------------------------------------------------------------
 * Schema.org JSON-LD (Organization + WebSite, Article pada single post)
 * ---------------------------------------------------------------------- */
function perkasa_seo_schema() {
	$home = home_url( '/' );
	$site = perkasa_site_name();

	$graph = array();

	// Organization — kontak dari Customizer.
	$graph[] = array(
		'@type'       => 'Organization',
		'@id'         => $home . '#organization',
		'name'        => $site,
		'url'         => $home,
		'description' => perkasa_site_tagline(),
		'email'       => perkasa_get_contact( 'email' ),
		'contactPoint' => array(
			'@type'             => 'ContactPoint',
			'telephone'         => perkasa_get_contact( 'phone' ),
			'contactType'       => 'customer service',
			'areaServed'        => 'ID',
			'availableLanguage' => 'Indonesian',
		),
	);

	// WebSite.
	$graph[] = array(
		'@type'       => 'WebSite',
		'@id'         => $home . '#website',
		'url'         => $home,
		'name'        => $site,
		'publisher'   => array( '@id' => $home . '#organization' ),
		'inLanguage'  => 'id-ID',
	);

	// Article — hanya pada single post (blog).
	if ( is_singular( 'post' ) ) {
		$post   = get_queried_object();
		$author = get_the_author_meta( 'display_name', $post->post_author );
		$graph[] = array(
			'@type'            => 'Article',
			'@id'              => get_permalink( $post ) . '#article',
			'headline'         => $post->post_title,
			'datePublished'    => get_the_date( 'c', $post ),
			'dateModified'     => get_the_modified_date( 'c', $post ),
			'author'           => array(
				'@type' => 'Person',
				'name'  => $author ? $author : $site,
			),
			'publisher'        => array( '@id' => $home . '#organization' ),
			'mainEntityOfPage' => get_permalink( $post ),
			'inLanguage'       => 'id-ID',
		);
	}

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	);
}
add_action( 'wp_head', 'perkasa_seo_schema', 6 );