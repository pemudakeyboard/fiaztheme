<?php
/**
 * Custom Post Types registration.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * CPT_Register class.
 */
final class CPT_Register {

	/**
	 * Register hooks.
	 */
	public static function init(): void {
		add_action( 'init', [ self::class, 'register' ] );
	}

	/**
	 * Register all CPTs.
	 */
	public static function register(): void {
		self::register_project();
		self::register_service();
		self::register_client();
		self::register_director();
	}

	/**
	 * Project CPT.
	 */
	private static function register_project(): void {
		register_post_type(
			'project',
			[
				'labels'       => [
					'name'          => __( 'Projects', 'fiaztheme' ),
					'singular_name' => __( 'Project', 'fiaztheme' ),
					'add_new_item'  => __( 'Add New Project', 'fiaztheme' ),
					'edit_item'     => __( 'Edit Project', 'fiaztheme' ),
				],
				'public'       => true,
				'has_archive'  => true,
				'rewrite'      => [ 'slug' => 'projects' ],
				'menu_icon'    => 'dashicons-building',
				'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
				'show_in_rest' => true,
			]
		);
	}

	/**
	 * Service CPT.
	 */
	private static function register_service(): void {
		register_post_type(
			'service',
			[
				'labels'       => [
					'name'          => __( 'Services', 'fiaztheme' ),
					'singular_name' => __( 'Service', 'fiaztheme' ),
					'add_new_item'  => __( 'Add New Service', 'fiaztheme' ),
					'edit_item'     => __( 'Edit Service', 'fiaztheme' ),
				],
				'public'       => true,
				'has_archive'  => true,
				'rewrite'      => [ 'slug' => 'services' ],
				'menu_icon'    => 'dashicons-admin-tools',
				'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
				'show_in_rest' => true,
			]
		);
	}

	/**
	 * Client CPT.
	 */
	private static function register_client(): void {
		register_post_type(
			'client',
			[
				'labels'       => [
					'name'          => __( 'Clients', 'fiaztheme' ),
					'singular_name' => __( 'Client', 'fiaztheme' ),
					'add_new_item'  => __( 'Add New Client', 'fiaztheme' ),
					'edit_item'     => __( 'Edit Client', 'fiaztheme' ),
				],
				'public'       => true,
				'has_archive'  => false,
				'rewrite'      => [ 'slug' => 'clients' ],
				'menu_icon'    => 'dashicons-groups',
				'supports'     => [ 'title', 'thumbnail' ],
				'show_in_rest' => true,
			]
		);
	}

	/**
	 * Director CPT.
	 */
	private static function register_director(): void {
		register_post_type(
			'director',
			[
				'labels'       => [
					'name'          => __( 'Directors', 'fiaztheme' ),
					'singular_name' => __( 'Director', 'fiaztheme' ),
					'add_new_item'  => __( 'Add New Director', 'fiaztheme' ),
					'edit_item'     => __( 'Edit Director', 'fiaztheme' ),
				],
				'public'       => true,
				'has_archive'  => false,
				'rewrite'      => [ 'slug' => 'directors' ],
				'menu_icon'    => 'dashicons-businessman',
				'supports'     => [ 'title', 'editor', 'thumbnail' ],
				'show_in_rest' => true,
			]
		);
	}
}
