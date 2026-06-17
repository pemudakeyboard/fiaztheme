<?php
/**
 * Director card partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$post = get_query_var( 'fiaz_director_post' );
if ( ! $post ) {
	return;
}

$position = Fiaztheme\get_field_safe( 'director_position', $post->ID );
?>
<article class="director-card fade-up">
	<div class="director-card__image">
		<?php if ( has_post_thumbnail( $post ) ) : ?>
			<?php echo get_the_post_thumbnail( $post, 'fiaz-director', [ 'loading' => 'lazy' ] ); ?>
		<?php else : ?>
			<div style="width:100%;height:100%;background:rgba(255,255,255,.05)"></div>
		<?php endif; ?>
	</div>
	<h3><?php echo esc_html( get_the_title( $post ) ); ?></h3>
	<?php if ( $position ) : ?>
		<p class="director-card__position"><?php echo esc_html( $position ); ?></p>
	<?php endif; ?>
</article>
