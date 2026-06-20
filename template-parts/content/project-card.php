<?php
/**
 * Project card partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$post = get_query_var( 'fiaz_project_post' );
if ( ! $post ) {
	return;
}

$year_key   = Fiaztheme\resolve_project_filter_year( (int) $post->ID );
$year_label = $year_key === Fiaztheme\project_year_unassigned_key() ? '' : $year_key;
$category   = Fiaztheme\get_field_safe( 'project_category', $post->ID, '' );
$location   = Fiaztheme\get_field_safe( 'project_location', $post->ID );
$cat_label  = Fiaztheme\project_categories()[ $category ] ?? $category;
?>
<article class="card project-card fade-up" data-year="<?php echo esc_attr( $year_key ); ?>" data-category="<?php echo esc_attr( $category ); ?>">
	<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="card__link">
		<div class="card__image">
			<?php if ( has_post_thumbnail( $post ) ) : ?>
				<?php echo get_the_post_thumbnail( $post, 'fiaz-project', [ 'loading' => 'lazy' ] ); ?>
			<?php else : ?>
				<div style="width:100%;height:100%;background:rgba(255,255,255,.05)"></div>
			<?php endif; ?>
		</div>
		<div class="card__body">
			<div class="card__meta">
				<?php echo esc_html( trim( $year_label . ' · ' . $cat_label, ' ·' ) ); ?>
				<?php if ( $location ) : ?>
					· <?php echo esc_html( $location ); ?>
				<?php endif; ?>
			</div>
			<h3 class="card__title"><?php echo esc_html( get_the_title( $post ) ); ?></h3>
			<?php if ( get_the_excerpt( $post ) ) : ?>
				<p><?php echo esc_html( get_the_excerpt( $post ) ); ?></p>
			<?php endif; ?>
		</div>
	</a>
</article>
