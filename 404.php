<?php
/**
 * 404 template.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<h1 class="page-header__title"><?php esc_html_e( '404', 'fiaztheme' ); ?></h1>
		<p class="page-header__desc"><?php esc_html_e( 'Page not found.', 'fiaztheme' ); ?></p>
	</div>
	<div class="container section">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
			<?php esc_html_e( 'Back to Home', 'fiaztheme' ); ?>
		</a>
	</div>
</main>
<?php
get_footer();
