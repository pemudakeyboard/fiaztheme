<?php
/**
 * SEO: Schema.org, Open Graph, breadcrumbs.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * SEO class.
 */
final class SEO {

	/**
	 * Register hooks.
	 */
	public static function init(): void {
		add_action( 'wp_head', [ self::class, 'open_graph' ], 5 );
		add_action( 'wp_head', [ self::class, 'schema_organization' ], 6 );
		add_action( 'wp_head', [ self::class, 'schema_page' ], 7 );
	}

	/**
	 * Open Graph meta tags.
	 */
	public static function open_graph(): void {
		$title   = wp_get_document_title();
		$url     = is_singular() ? get_permalink() : home_url( '/' );
		$desc    = get_bloginfo( 'description' );
		$image   = '';

		if ( is_singular() && has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( null, 'fiaz-hero' );
		}

		if ( is_singular() ) {
			$excerpt = get_the_excerpt();
			if ( $excerpt ) {
				$desc = wp_strip_all_tags( $excerpt );
			}
		}

		echo '<meta property="og:type" content="' . esc_attr( is_singular() ? 'article' : 'website' ) . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";

		if ( $image ) {
			echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
		}
	}

	/**
	 * Organization schema on all pages.
	 */
	public static function schema_organization(): void {
		$schema = [
			'@context' => 'https://schema.org',
			'@type'    => 'Organization',
			'name'     => 'PT FIAZ CAKRAWALA INDONUSA',
			'url'      => home_url( '/' ),
			'logo'     => asset_url( 'images/logo.svg' ),
			'description' => get_bloginfo( 'description' ),
			'sameAs'   => [],
		];

		$address = get_field_safe( 'site_address', 'option' );
		$phone   = get_field_safe( 'site_phone', 'option' );
		$email   = get_field_safe( 'site_email', 'option' );

		if ( $address ) {
			$schema['address'] = [
				'@type'           => 'PostalAddress',
				'streetAddress'   => $address,
				'addressCountry'  => 'ID',
			];
		}

		if ( $phone ) {
			$schema['telephone'] = $phone;
		}

		if ( $email ) {
			$schema['email'] = $email;
		}

		self::output_json_ld( $schema );
	}

	/**
	 * Context-specific schema.
	 */
	public static function schema_page(): void {
		if ( is_singular( 'project' ) ) {
			$schema = [
				'@context'    => 'https://schema.org',
				'@type'       => 'CreativeWork',
				'name'        => get_the_title(),
				'description' => wp_strip_all_tags( get_the_excerpt() ),
				'url'         => get_permalink(),
				'image'       => get_the_post_thumbnail_url( null, 'fiaz-project' ),
			];

			$year = get_field_safe( 'project_year' );
			if ( $year ) {
				$schema['dateCreated'] = $year;
			}

			self::output_json_ld( $schema );
		}

		if ( is_singular( 'service' ) ) {
			$schema = [
				'@context'    => 'https://schema.org',
				'@type'       => 'Service',
				'name'        => get_the_title(),
				'description' => wp_strip_all_tags( get_the_excerpt() ),
				'url'         => get_permalink(),
				'provider'    => [
					'@type' => 'Organization',
					'name'  => 'PT FIAZ CAKRAWALA INDONUSA',
				],
			];

			self::output_json_ld( $schema );
		}
	}

	/**
	 * Output JSON-LD script.
	 *
	 * @param array $data Schema data.
	 */
	private static function output_json_ld( array $data ): void {
		echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}
}
