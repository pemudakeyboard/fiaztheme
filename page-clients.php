<?php
/**
 * Template Name: Clients
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php \Fiaztheme\breadcrumb(); ?>
		<p class="section-label"><?php esc_html_e( 'Trust', 'fiaztheme' ); ?></p>
		<h1 class="page-header__title"><?php esc_html_e( 'Clients', 'fiaztheme' ); ?></h1>
		<p class="page-header__desc"><?php esc_html_e( 'Trusted by BUMN, manufacturing, government, healthcare, and enterprise facilities.', 'fiaztheme' ); ?></p>
	</div>

	<div class="container section">
		<?php get_template_part( 'template-parts/sections/clients' ); ?>
	</div>
</main>
<?php
get_footer();
