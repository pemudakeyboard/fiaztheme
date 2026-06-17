<?php
/**
 * Services archive template.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php \Fiaztheme\breadcrumb(); ?>
		<p class="section-label"><?php esc_html_e( 'Capabilities', 'fiaztheme' ); ?></p>
		<h1 class="page-header__title"><?php esc_html_e( 'Services', 'fiaztheme' ); ?></h1>
	</div>

	<div class="container section">
		<?php
		$services = get_posts(
			[
				'post_type'      => 'service',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			]
		);

		if ( $services ) :
			?>
			<div class="grid-3">
				<?php foreach ( $services as $service ) : ?>
					<?php
					set_query_var( 'fiaz_service_post', $service );
					get_template_part( 'template-parts/content/service-card' );
					?>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="section__desc"><?php esc_html_e( 'No services published yet.', 'fiaztheme' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
