<?php
/**
 * Theme activation — create core pages and front page setup.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * Theme_Activation class.
 */
final class Theme_Activation {

	/**
	 * Register hook.
	 */
	public static function init(): void {
		add_action( 'after_switch_theme', [ self::class, 'on_activate' ] );
	}

	/**
	 * Run setup on theme activation.
	 */
	public static function on_activate(): void {
		$pages = [
			'home'     => [ 'title' => 'Home', 'template' => '' ],
			'about'    => [ 'title' => 'About', 'template' => 'page-about.php' ],
			'services' => [ 'title' => 'Services', 'template' => 'page-services.php' ],
			'projects' => [ 'title' => 'Projects', 'template' => '' ],
			'clients'  => [ 'title' => 'Clients', 'template' => 'page-clients.php' ],
			'contact'  => [ 'title' => 'Contact', 'template' => 'page-contact.php' ],
		];

		$page_ids = [];

		foreach ( $pages as $slug => $data ) {
			$existing = get_page_by_path( $slug );

			if ( $existing ) {
				$page_ids[ $slug ] = $existing->ID;
				continue;
			}

			$page_id = wp_insert_post(
				[
					'post_title'   => $data['title'],
					'post_name'    => $slug,
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_content' => '',
				],
				true
			);

			if ( is_wp_error( $page_id ) ) {
				continue;
			}

			if ( $data['template'] ) {
				update_post_meta( $page_id, '_wp_page_template', $data['template'] );
			}

			$page_ids[ $slug ] = $page_id;
		}

		if ( isset( $page_ids['home'] ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $page_ids['home'] );
		}

		flush_rewrite_rules();
	}
}
