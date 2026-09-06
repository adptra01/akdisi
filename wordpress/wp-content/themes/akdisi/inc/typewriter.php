<?php
/**
 * Typewriter headline renderer (reusable).
 *
 * Renders a heading where every word is wrapped in .tw-word > .tw-char spans so
 * the JS typewriter can stagger-reveal them on scroll into view. Supports a
 * per-word accent (deep rose) via the $accent_words array.
 *
 * Args:
 *   $text         (string) Full heading text, words separated by single spaces.
 *   $accent_words (array)  Substrings within $text to color with the brand accent.
 *                          Passed verbatim; run through the same word renderer.
 *
 * IMPORTANT: Only plain words + spaces are supported (no inline tags in $text).
 * For "&" use literal "&amp;" — it survives htmlspecialchars and renders as "&".
 *
 * @package AKDISI
 */

function akdisi_render_typewriter( $text, $accent_words = array() ) {
	// Split on spaces preserving the &amp; entity / plain words.
	$words = preg_split( '/\s+/', trim( $text ) );

	$out = '';
	$count = count( $words );
	foreach ( $words as $i => $word ) {
		// Decode for comparison, keep original for output.
		$plain = html_entity_decode( $word );
		$accent = in_array( $plain, $accent_words, true ) ? ' text-brand' : '';

		$out .= '<span class="tw-word' . esc_attr( $accent ) . '">';
		// Walk over each char of the string (word stays HTML-escaped).
		$chars = preg_split( '//u', $word, -1, PREG_SPLIT_NO_EMPTY );
		foreach ( $chars as $char ) {
			$out .= '<span class="tw-char">' . esc_html( $char ) . '</span>';
		}
		$out .= '</span>';
		// Real space between words so screen readers announce them separately.
		if ( $i < $count - 1 ) {
			$out .= ' ';
		}
	}

	return $out;
}
