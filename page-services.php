<?php
/**
 * Template Name: Services
 * Redirects to the service post type archive (/services/).
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$archive_url = get_post_type_archive_link( 'service' ) ?: home_url( '/services/' );

if ( ! is_post_type_archive( 'service' ) ) {
	wp_safe_redirect( $archive_url );
	exit;
}

get_header();
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php \Fiaztheme\breadcrumb(); ?>
		<p class="section-label"><?php esc_html_e( 'Capabilities', 'fiaztheme' ); ?></p>
		<h1 class="page-header__title"><?php esc_html_e( 'Services', 'fiaztheme' ); ?></h1>
		<p class="page-header__desc"><?php esc_html_e( 'Construction, general supplier, HVAC, maintenance, mechanical, and electrical engineering.', 'fiaztheme' ); ?></p>
	</div>

	<div class="container section">
		<?php if ( have_posts() ) : ?>
			<div class="grid-3">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					set_query_var( 'fiaz_service_post', get_post() );
					get_template_part( 'template-parts/content/service-card' );
					?>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<p class="section__desc"><?php esc_html_e( 'Add services in WordPress admin to display them here.', 'fiaztheme' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
