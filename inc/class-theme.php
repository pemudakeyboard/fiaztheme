<?php
/**
 * Theme bootstrap and module loader.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * Main theme class.
 */
final class Theme {

	/**
	 * Initialize theme modules.
	 */
	public static function init(): void {
		$modules = [
			Theme_Setup::class,
			Theme_Activation::class,
			CPT_Register::class,
			ACF_Fields::class,
			Assets::class,
			Contact_Form::class,
			SEO::class,
			Security::class,
		];

		foreach ( $modules as $module ) {
			if ( class_exists( $module ) && method_exists( $module, 'init' ) ) {
				$module::init();
			}
		}
	}
}
