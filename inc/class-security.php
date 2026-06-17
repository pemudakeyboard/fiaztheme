<?php
/**
 * Security hardening.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * Security class.
 */
final class Security {

	/**
	 * Register hooks.
	 */
	public static function init(): void {
		add_filter( 'xmlrpc_enabled', '__return_false' );
		remove_action( 'wp_head', 'wp_generator' );
		add_filter( 'the_generator', '__return_empty_string' );
	}

	/**
	 * Verify user capability for admin actions.
	 */
	public static function current_user_can_edit(): bool {
		return current_user_can( 'edit_theme_options' );
	}
}
