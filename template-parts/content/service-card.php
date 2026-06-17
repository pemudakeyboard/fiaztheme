<?php
/**
 * Service card partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$post = get_query_var( 'fiaz_service_post' );
if ( ! $post ) {
	return;
}

$icon = Fiaztheme\get_field_safe( 'service_icon_label', $post->ID, 'SVC' );
$desc = Fiaztheme\get_field_safe( 'service_short_description', $post->ID, get_the_excerpt( $post ) );
?>
<article class="service-card fade-up">
	<?php if ( has_post_thumbnail( $post ) ) : ?>
		<div class="service-card__bg">
			<?php echo get_the_post_thumbnail( $post, 'fiaz-project', [ 'loading' => 'lazy' ] ); ?>
		</div>
	<?php endif; ?>
	<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="service-card__content">
		<div class="service-card__icon"><?php echo esc_html( $icon ); ?></div>
		<h3 class="service-card__title"><?php echo esc_html( get_the_title( $post ) ); ?></h3>
		<p class="service-card__desc"><?php echo esc_html( $desc ); ?></p>
	</a>
</article>
