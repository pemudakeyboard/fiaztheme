<?php
/**
 * Theme setup: supports, menus, image sizes.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * Theme_Setup class.
 */
final class Theme_Setup {

	/**
	 * Register hooks.
	 */
	public static function init(): void {
		add_action( 'after_setup_theme', [ self::class, 'setup' ] );
		add_action( 'init', [ self::class, 'register_image_sizes' ] );
	}

	/**
	 * Theme supports and menus.
	 */
	public static function setup(): void {
		load_theme_textdomain( 'fiaztheme', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );

		register_nav_menus(
			[
				'primary' => __( 'Primary Menu', 'fiaztheme' ),
				'footer'  => __( 'Footer Menu', 'fiaztheme' ),
			]
		);
	}

	/**
	 * Custom image sizes.
	 */
	public static function register_image_sizes(): void {
		add_image_size( 'fiaz-hero', 1920, 1080, true );
		add_image_size( 'fiaz-project', 800, 600, true );
		add_image_size( 'fiaz-client', 240, 120, false );
		add_image_size( 'fiaz-director', 600, 750, true );
	}
}
