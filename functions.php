<?php
/**
 * Fiaztheme bootstrap.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FIAZTHEME_VERSION', '1.0.0' );
define( 'FIAZTHEME_DIR', get_template_directory() );
define( 'FIAZTHEME_URI', get_template_directory_uri() );

require_once FIAZTHEME_DIR . '/inc/helpers.php';
require_once FIAZTHEME_DIR . '/inc/class-theme.php';
require_once FIAZTHEME_DIR . '/inc/class-theme-setup.php';
require_once FIAZTHEME_DIR . '/inc/class-theme-activation.php';
require_once FIAZTHEME_DIR . '/inc/class-cpt-register.php';
require_once FIAZTHEME_DIR . '/inc/class-acf-fields.php';
require_once FIAZTHEME_DIR . '/inc/class-assets.php';
require_once FIAZTHEME_DIR . '/inc/class-contact-form.php';
require_once FIAZTHEME_DIR . '/inc/class-seo.php';
require_once FIAZTHEME_DIR . '/inc/class-security.php';

Fiaztheme\Theme::init();
