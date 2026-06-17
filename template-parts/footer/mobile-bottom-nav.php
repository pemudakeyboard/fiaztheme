<?php
/**
 * Mobile bottom navigation bar (≤768px).
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$nav_items = Fiaztheme\primary_nav_items();
?>
<nav class="mobile-bottom-nav" aria-label="<?php esc_attr_e( 'Mobile primary', 'fiaztheme' ); ?>">
	<ul class="mobile-bottom-nav__list">
		<?php foreach ( $nav_items as $item ) : ?>
			<?php
			$is_active = Fiaztheme\nav_item_is_active( $item['key'] );
			$classes   = 'mobile-bottom-nav__link' . ( $is_active ? ' is-active' : '' );
			?>
			<li class="mobile-bottom-nav__item">
				<a
					href="<?php echo esc_url( $item['url'] ); ?>"
					class="<?php echo esc_attr( $classes ); ?>"
					<?php echo $is_active ? 'aria-current="page"' : ''; ?>
				>
					<span class="mobile-bottom-nav__icon"><?php Fiaztheme\icon( $item['icon'] ); ?></span>
					<span class="mobile-bottom-nav__label"><?php echo esc_html( $item['label'] ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
