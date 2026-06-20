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
 * Normalize project year for display and client-side filters.
 */
function normalize_project_year( mixed $year, string $default = '' ): string {
	if ( ! is_scalar( $year ) || $year === '' ) {
		return $default;
	}

	$digits = preg_replace( '/[^\d]/', '', (string) $year );

	return $digits !== '' ? $digits : $default;
}

/**
 * Filter key for projects missing a valid year.
 */
function project_year_unassigned_key(): string {
	return 'unassigned';
}

/**
 * Resolve the year filter key for a project.
 */
function resolve_project_filter_year( int $post_id ): string {
	$year = normalize_project_year( get_field_safe( 'project_year', $post_id, '' ), '' );

	return $year !== '' ? $year : project_year_unassigned_key();
}

/**
 * Human-readable label for a year filter key.
 *
 * @param string|int $year
 */
function project_year_filter_label( $year ): string {
	$year = (string) $year;

	if ( $year === project_year_unassigned_key() ) {
		return __( 'Year not set', 'fiaztheme' );
	}

	return $year;
}

/**
 * Group projects by year filter key.
 *
 * @param array<int, \WP_Post> $projects
 * @return array<string, array<int, \WP_Post>>
 */
function group_projects_by_year( array $projects ): array {
	$by_year = [];

	foreach ( $projects as $project ) {
		$year = resolve_project_filter_year( (int) $project->ID );
		if ( ! isset( $by_year[ $year ] ) ) {
			$by_year[ $year ] = [];
		}
		$by_year[ $year ][] = $project;
	}

	return $by_year;
}

/**
 * Ordered year filter keys for archive UI (newest first, unassigned last).
 *
 * @param array<string, array<int, \WP_Post>> $by_year
 */
function project_year_filter_keys( array $by_year ): array {
	$years = array_map(
		static fn( $year ): string => (string) $year,
		array_keys( $by_year )
	);
	$unassigned = project_year_unassigned_key();
	$years = array_values(
		array_filter(
			$years,
			static fn( string $year ): bool => $year !== $unassigned
		)
	);
	rsort( $years, SORT_NUMERIC );

	if ( ! empty( $by_year[ $unassigned ] ) ) {
		$years[] = $unassigned;
	}

	return $years;
}

/**
 * Flatten grouped projects in filter-key order.
 *
 * @param array<string, array<int, \WP_Post>> $by_year
 * @param array<int, string>                  $years
 * @return array<int, \WP_Post>
 */
function flatten_projects_by_year( array $by_year, array $years ): array {
	$ordered = [];

	foreach ( $years as $year ) {
		if ( empty( $by_year[ $year ] ) ) {
			continue;
		}

		foreach ( $by_year[ $year ] as $project ) {
			$ordered[] = $project;
		}
	}

	return $ordered;
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
 * Primary navigation items (header + mobile bottom bar).
 *
 * @return array<int, array{key: string, label: string, url: string, icon: string}>
 */
function primary_nav_items(): array {
	return [
		[
			'key'   => 'about',
			'label' => __( 'About', 'fiaztheme' ),
			'url'   => home_url( '/about/' ),
			'icon'  => 'nav-about',
		],
		[
			'key'   => 'services',
			'label' => __( 'Services', 'fiaztheme' ),
			'url'   => get_post_type_archive_link( 'service' ) ?: home_url( '/services/' ),
			'icon'  => 'nav-services',
		],
		[
			'key'   => 'projects',
			'label' => __( 'Projects', 'fiaztheme' ),
			'url'   => get_post_type_archive_link( 'project' ) ?: home_url( '/projects/' ),
			'icon'  => 'nav-projects',
		],
		[
			'key'   => 'clients',
			'label' => __( 'Clients', 'fiaztheme' ),
			'url'   => home_url( '/clients/' ),
			'icon'  => 'nav-clients',
		],
		[
			'key'   => 'contact',
			'label' => __( 'Contact', 'fiaztheme' ),
			'url'   => home_url( '/contact/' ),
			'icon'  => 'nav-contact',
		],
	];
}

/**
 * Whether a primary nav item matches the current request.
 */
function nav_item_is_active( string $key ): bool {
	switch ( $key ) {
		case 'about':
			return is_page( 'about' ) || is_page_template( 'page-about.php' );

		case 'services':
			return is_post_type_archive( 'service' )
				|| is_singular( 'service' )
				|| is_page( 'services' )
				|| is_page_template( 'page-services.php' );

		case 'projects':
			return is_post_type_archive( 'project' ) || is_singular( 'project' );

		case 'clients':
			return is_page( 'clients' ) || is_page_template( 'page-clients.php' );

		case 'contact':
			return is_page( 'contact' ) || is_page_template( 'page-contact.php' );
	}

	return false;
}

/**
 * Output escaped SVG icon by name.
 */
function icon( string $name, string $class = '' ): void {
	$icons = [
		'arrow-right'  => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'menu'         => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'close'        => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'nav-about'    => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.5"/><path d="M5 20c0-3.314 3.134-6 7-6s7 2.686 7 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'nav-services' => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 9.5 12 4l9 5.5V19a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 20V12h6v8" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
		'nav-projects' => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="4" y="4" width="7" height="7" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="13" y="4" width="7" height="7" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="4" y="13" width="7" height="7" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="13" y="13" width="7" height="7" rx="1" stroke="currentColor" stroke-width="1.5"/></svg>',
		'nav-clients'  => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 20V6.5A1.5 1.5 0 0 1 5.5 5H18a1.5 1.5 0 0 1 1.5 1.5V20" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M4 20h16M9 20v-5h6v5M9 9h2M9 13h2M13 9h2M13 13h2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'nav-contact'  => '<svg class="' . esc_attr( $class ) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6.5A1.5 1.5 0 0 1 5.5 5h13A1.5 1.5 0 0 1 20 6.5v11A1.5 1.5 0 0 1 18.5 19h-13A1.5 1.5 0 0 1 4 17.5v-11Z" stroke="currentColor" stroke-width="1.5"/><path d="m5 7 7 5 7-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
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
 * Distinct project years from published posts (newest first).
 *
 * @param array<int, \WP_Post> $projects
 */
function project_years_from_posts( array $projects ): array {
	return project_year_filter_keys( group_projects_by_year( $projects ) );
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
