<?php
/**
 * Enqueue styles and scripts.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * Assets class.
 */
final class Assets {

	/**
	 * Register hooks.
	 */
	public static function init(): void {
		add_action( 'wp_enqueue_scripts', [ self::class, 'enqueue' ] );
		add_action( 'wp_head', [ self::class, 'critical_css' ], 1 );
	}

	/**
	 * Enqueue front-end assets.
	 */
	public static function enqueue(): void {
		$main_css_path = get_template_directory() . '/assets/css/main.css';
		$main_css_ver  = file_exists( $main_css_path ) ? (string) filemtime( $main_css_path ) : FIAZTHEME_VERSION;

		wp_enqueue_style(
			'fiaz-fonts',
			'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap',
			[],
			null
		);

		wp_enqueue_style(
			'fiaz-main',
			asset_url( 'css/main.css' ),
			[ 'fiaz-fonts' ],
			$main_css_ver
		);

		wp_enqueue_style(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
			[],
			'11.0.0'
		);

		wp_enqueue_script(
			'gsap',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
			[],
			'3.12.5',
			[ 'strategy' => 'defer', 'in_footer' => true ]
		);

		wp_enqueue_script(
			'gsap-scrolltrigger',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
			[ 'gsap' ],
			'3.12.5',
			[ 'strategy' => 'defer', 'in_footer' => true ]
		);

		wp_enqueue_script(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
			[],
			'11.0.0',
			[ 'strategy' => 'defer', 'in_footer' => true ]
		);

		$js_anim_path = get_template_directory() . '/assets/js/animations.js';
		$js_proj_path = get_template_directory() . '/assets/js/projects-filter.js';
		$js_main_path = get_template_directory() . '/assets/js/main.js';

		wp_enqueue_script(
			'fiaz-animations',
			asset_url( 'js/animations.js' ),
			[ 'gsap', 'gsap-scrolltrigger' ],
			file_exists( $js_anim_path ) ? (string) filemtime( $js_anim_path ) : FIAZTHEME_VERSION,
			[ 'strategy' => 'defer', 'in_footer' => true ]
		);

		wp_enqueue_script(
			'fiaz-projects',
			asset_url( 'js/projects-filter.js' ),
			[],
			file_exists( $js_proj_path ) ? (string) filemtime( $js_proj_path ) : FIAZTHEME_VERSION,
			[ 'strategy' => 'defer', 'in_footer' => true ]
		);

		wp_enqueue_script(
			'fiaz-main',
			asset_url( 'js/main.js' ),
			[ 'fiaz-animations', 'fiaz-projects', 'swiper' ],
			file_exists( $js_main_path ) ? (string) filemtime( $js_main_path ) : FIAZTHEME_VERSION,
			[ 'strategy' => 'defer', 'in_footer' => true ]
		);
	}

	/**
	 * Inline critical CSS for above-the-fold.
	 */
	public static function critical_css(): void {
		echo '<style id="fiaz-critical">';
		echo 'body{margin:0;background:#0D1117;color:#fff;font-family:Inter,sans-serif}';
		echo '.site-header{position:fixed;top:0;left:0;right:0;z-index:100}';
		echo '</style>';
	}
}
