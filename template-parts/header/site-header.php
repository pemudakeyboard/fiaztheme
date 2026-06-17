<?php
/**
 * Site header partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$nav_items = Fiaztheme\primary_nav_items();
?>
<header class="site-header" role="banner">
	<div class="container site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php esc_attr_e( 'Home', 'fiaztheme' ); ?>">
			FIAZ <span>CAKRAWALA</span>
		</a>

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'fiaztheme' ); ?>">
			<ul id="primary-menu" class="site-nav__list">
				<?php foreach ( $nav_items as $item ) : ?>
					<?php
					$is_active = Fiaztheme\nav_item_is_active( $item['key'] );
					$classes   = 'site-nav__link' . ( $is_active ? ' is-active' : '' );
					?>
					<li>
						<a
							href="<?php echo esc_url( $item['url'] ); ?>"
							class="<?php echo esc_attr( $classes ); ?>"
							<?php echo $is_active ? 'aria-current="page"' : ''; ?>
						>
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
