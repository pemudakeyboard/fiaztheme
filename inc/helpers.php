<?php
/**
 * Theme helper functions.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * Get theme asset URL.
 */
function asset_url( string $path ): string {
	return esc_url( get_template_directory_uri() . '/assets/' . ltrim( $path, '/' ) );
}

/**
 * Get ACF field with fallback.
 */
function get_field_safe( string $key, $post_id = false, $default = '' ): mixed {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $key, $post_id );

	return $value !== null && $value !== '' ? $value : $default;
}

/**
 * Check if ACF text/HTML field has visible content.
 */
function field_has_content( string $key, $post_id = false ): bool {
	$value = get_field_safe( $key, $post_id, '' );

	if ( ! is_string( $value ) ) {
		return ! empty( $value );
	}

	return trim( wp_strip_all_tags( $value ) ) !== '';
}

/**
 * Output escaped SVG icon by name.
 */
function icon( string $name, string $class = '' ): void {
	$icons = [
		'arrow-right' => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'menu'        => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'close'       => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
	];

	if ( isset( $icons[ $name ] ) ) {
		echo $icons[ $name ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG markup.
	}
}

/**
 * Project category labels.
 */
function project_categories(): array {
	return [
		'hvac'          => __( 'HVAC', 'fiaztheme' ),
		'construction'  => __( 'Construction', 'fiaztheme' ),
		'maintenance'   => __( 'Maintenance', 'fiaztheme' ),
		'mechanical'    => __( 'Mechanical', 'fiaztheme' ),
		'electrical'    => __( 'Electrical', 'fiaztheme' ),
	];
}

/**
 * Project years for filters.
 */
function project_years(): array {
	return [ '2021', '2022', '2023', '2024', '2025', '2026' ];
}

/**
 * Breadcrumb markup.
 */
function breadcrumb(): void {
	if ( is_front_page() ) {
		return;
	}

	echo '<nav class="breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'fiaztheme' ) . '">';
	echo '<ol class="breadcrumb__list">';
	echo '<li class="breadcrumb__item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'fiaztheme' ) . '</a></li>';

	if ( is_singular( 'project' ) ) {
		echo '<li class="breadcrumb__item"><a href="' . esc_url( get_post_type_archive_link( 'project' ) ) . '">' . esc_html__( 'Projects', 'fiaztheme' ) . '</a></li>';
		echo '<li class="breadcrumb__item" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
	} elseif ( is_singular( 'service' ) ) {
		$services_url = get_post_type_archive_link( 'service' ) ?: home_url( '/services/' );
		echo '<li class="breadcrumb__item"><a href="' . esc_url( $services_url ) . '">' . esc_html__( 'Services', 'fiaztheme' ) . '</a></li>';
		echo '<li class="breadcrumb__item" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
	} elseif ( is_post_type_archive( 'project' ) ) {
		echo '<li class="breadcrumb__item" aria-current="page">' . esc_html__( 'Projects', 'fiaztheme' ) . '</li>';
	} elseif ( is_post_type_archive( 'service' ) ) {
		echo '<li class="breadcrumb__item" aria-current="page">' . esc_html__( 'Services', 'fiaztheme' ) . '</li>';
	} elseif ( is_page() ) {
		echo '<li class="breadcrumb__item" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
	}

	echo '</ol>';
	echo '</nav>';
}

/**
 * Normalize Google Maps input to an iframe-safe embed URL.
 *
 * Accepts embed URL, share link, coordinates, or full iframe HTML.
 * Falls back to address text when the URL cannot be embedded.
 */
function maps_embed_url( string $input, string $address_fallback = '' ): string {
	$input = trim( $input );

	if ( $input === '' ) {
		$input = $address_fallback;
	}

	if ( $input === '' ) {
		return '';
	}

	// Extract src from pasted iframe HTML.
	if ( preg_match( '/src=["\']([^"\']+)["\']/', $input, $iframe_match ) ) {
		$input = html_entity_decode( $iframe_match[1], ENT_QUOTES, 'UTF-8' );
	}

	// Reject bare google.com (not embeddable).
	if ( preg_match( '#^https?://(www\.)?google\.com/?$#i', $input ) ) {
		$input = $address_fallback;
	}

	if ( $input === '' ) {
		return '';
	}

	// Already a proper embed URL.
	if ( str_contains( $input, 'google.com/maps/embed' ) ) {
		return esc_url_raw( $input );
	}

	// Legacy embed output format.
	if ( str_contains( $input, 'output=embed' ) ) {
		return esc_url_raw( $input );
	}

	// Coordinates from @lat,lng in share URL.
	if ( preg_match( '/@(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)/', $input, $coords ) ) {
		$query = $coords[1] . ',' . $coords[2];
		return 'https://maps.google.com/maps?q=' . rawurlencode( $query ) . '&z=15&output=embed';
	}

	// Place name from /place/... path.
	if ( preg_match( '/\/place\/([^/@?]+)/', $input, $place ) ) {
		$query = str_replace( '+', ' ', urldecode( $place[1] ) );
		return 'https://maps.google.com/maps?q=' . rawurlencode( $query ) . '&output=embed';
	}

	// Existing q= query parameter.
	if ( preg_match( '/[?&]q=([^&]+)/', $input, $q_match ) ) {
		$query = urldecode( $q_match[1] );
		return 'https://maps.google.com/maps?q=' . rawurlencode( $query ) . '&output=embed';
	}

	// Plain address or search text (not a URL).
	if ( ! preg_match( '#^https?://#i', $input ) ) {
		return 'https://maps.google.com/maps?q=' . rawurlencode( $input ) . '&output=embed';
	}

	// Last resort: use address field if URL format is unrecognized.
	if ( $address_fallback !== '' ) {
		return 'https://maps.google.com/maps?q=' . rawurlencode( $address_fallback ) . '&output=embed';
	}

	return '';
}

/**
 * External Google Maps link for "open in maps" button.
 */
function maps_external_url( string $input, string $address_fallback = '' ): string {
	$input = trim( $input );

	if ( preg_match( '/src=["\']([^"\']+)["\']/', $input, $iframe_match ) ) {
		$input = html_entity_decode( $iframe_match[1], ENT_QUOTES, 'UTF-8' );
	}

	if ( $input !== '' && preg_match( '#^https?://#i', $input ) && ! preg_match( '#^https?://(www\.)?google\.com/?$#i', $input ) ) {
		// Convert embed back to viewable maps link when possible.
		if ( str_contains( $input, 'output=embed' ) && preg_match( '/[?&]q=([^&]+)/', $input, $q_match ) ) {
			return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( urldecode( $q_match[1] ) );
		}

		return esc_url_raw( $input );
	}

	if ( $address_fallback !== '' ) {
		return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $address_fallback );
	}

	return '';
}
