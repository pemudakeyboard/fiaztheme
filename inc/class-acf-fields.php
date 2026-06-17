<?php
/**
 * ACF options pages and JSON sync paths.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * ACF_Fields class.
 */
final class ACF_Fields {

	/**
	 * Register hooks.
	 */
	public static function init(): void {
		add_action( 'acf/init', [ self::class, 'register_options_pages' ] );
		add_filter( 'acf/settings/save_json', [ self::class, 'save_json_path' ] );
		add_filter( 'acf/settings/load_json', [ self::class, 'load_json_paths' ] );
	}

	/**
	 * Register ACF options pages when ACF is available.
	 */
	public static function register_options_pages(): void {
		if ( ! function_exists( 'acf_add_options_page' ) ) {
			return;
		}

		acf_add_options_page(
			[
				'page_title' => __( 'Site Settings', 'fiaztheme' ),
				'menu_title' => __( 'Site Settings', 'fiaztheme' ),
				'menu_slug'  => 'fiaz-site-settings',
				'capability' => 'edit_theme_options',
				'redirect'   => false,
				'icon_url'   => 'dashicons-admin-site-alt3',
			]
		);

		acf_add_options_sub_page(
			[
				'page_title'  => __( 'Homepage', 'fiaztheme' ),
				'menu_title'  => __( 'Homepage', 'fiaztheme' ),
				'parent_slug' => 'fiaz-site-settings',
				'menu_slug'   => 'fiaz-homepage',
			]
		);
	}

	/**
	 * ACF JSON save path.
	 */
	public static function save_json_path(): string {
		return get_template_directory() . '/acf-json';
	}

	/**
	 * ACF JSON load paths.
	 *
	 * @param array $paths Existing paths.
	 */
	public static function load_json_paths( array $paths ): array {
		$paths[] = get_template_directory() . '/acf-json';
		return $paths;
	}
}
