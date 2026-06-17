<?php
/**
 * Directors section.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$directors = get_posts(
	[
		'post_type'      => 'director',
		'posts_per_page' => 6,
		'meta_key'       => 'director_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
	]
);
?>
<section class="section section--directors" aria-labelledby="directors-heading">
	<div class="container">
		<div class="section__header fade-up">
			<p class="section-label"><?php esc_html_e( 'Leadership', 'fiaztheme' ); ?></p>
			<h2 id="directors-heading" class="section__title"><?php esc_html_e( 'Board of Directors', 'fiaztheme' ); ?></h2>
		</div>

		<?php if ( $directors ) : ?>
			<div class="grid-4">
				<?php foreach ( $directors as $director ) : ?>
					<?php
					set_query_var( 'fiaz_director_post', $director );
					get_template_part( 'template-parts/content/director-card' );
					?>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="section__desc fade-up"><?php esc_html_e( 'Director profiles will appear here once published.', 'fiaztheme' ); ?></p>
		<?php endif; ?>
	</div>
</section>
