<?php
/**
 * Client logo partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$post = get_query_var( 'fiaz_client_post' );
if ( ! $post ) {
	return;
}

$url = Fiaztheme\get_field_safe( 'client_url', $post->ID );
?>
<div class="client-logo fade-up">
	<?php if ( $url ) : ?>
		<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( get_the_title( $post ) ); ?>">
			<?php if ( has_post_thumbnail( $post ) ) : ?>
				<?php echo get_the_post_thumbnail( $post, 'fiaz-client', [ 'loading' => 'lazy' ] ); ?>
			<?php else : ?>
				<span><?php echo esc_html( get_the_title( $post ) ); ?></span>
			<?php endif; ?>
		</a>
	<?php elseif ( has_post_thumbnail( $post ) ) : ?>
		<?php echo get_the_post_thumbnail( $post, 'fiaz-client', [ 'loading' => 'lazy' ] ); ?>
	<?php else : ?>
		<span><?php echo esc_html( get_the_title( $post ) ); ?></span>
	<?php endif; ?>
</div>
