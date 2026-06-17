<?php
/**
 * Site header partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$nav_items = [
	[ 'label' => __( 'About', 'fiaztheme' ), 'url' => home_url( '/about/' ) ],
	[ 'label' => __( 'Services', 'fiaztheme' ), 'url' => get_post_type_archive_link( 'service' ) ?: home_url( '/services/' ) ],
	[ 'label' => __( 'Projects', 'fiaztheme' ), 'url' => get_post_type_archive_link( 'project' ) ],
	[ 'label' => __( 'Clients', 'fiaztheme' ), 'url' => home_url( '/clients/' ) ],
	[ 'label' => __( 'Contact', 'fiaztheme' ), 'url' => home_url( '/contact/' ) ],
];
?>
<header class="site-header" role="banner">
	<div class="container site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php esc_attr_e( 'Home', 'fiaztheme' ); ?>">
			FIAZ <span>CAKRAWALA</span>
		</a>

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'fiaztheme' ); ?>">
			<button type="button" class="site-nav__toggle" aria-expanded="false" aria-controls="primary-menu">
				<?php Fiaztheme\icon( 'menu' ); ?>
				<span class="sr-only"><?php esc_html_e( 'Toggle menu', 'fiaztheme' ); ?></span>
			</button>

			<ul id="primary-menu" class="site-nav__list">
				<?php foreach ( $nav_items as $item ) : ?>
					<li>
						<a href="<?php echo esc_url( $item['url'] ); ?>" class="site-nav__link">
							<?php echo esc_html( $item['label'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
				<li>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary">
						<?php esc_html_e( 'Get in Touch', 'fiaztheme' ); ?>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</header>
