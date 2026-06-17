<?php
/**
 * Clients section.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$clients = get_posts(
	[
		'post_type'      => 'client',
		'posts_per_page' => 12,
		'orderby'        => 'title',
		'order'          => 'ASC',
	]
);
?>
<section class="section section--clients" aria-labelledby="clients-heading">
	<div class="container">
		<div class="section__header fade-up">
			<p class="section-label"><?php esc_html_e( 'Trust', 'fiaztheme' ); ?></p>
			<h2 id="clients-heading" class="section__title"><?php esc_html_e( 'Enterprise Clients', 'fiaztheme' ); ?></h2>
		</div>

		<?php if ( $clients ) : ?>
			<div class="clients__grid">
				<?php foreach ( $clients as $client ) : ?>
					<?php
					set_query_var( 'fiaz_client_post', $client );
					get_template_part( 'template-parts/content/client-logo' );
					?>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<div class="clients__grid fade-up">
				<?php for ( $i = 0; $i < 6; $i++ ) : ?>
					<div class="client-logo">
						<span class="section__desc"><?php esc_html_e( 'Client Logo', 'fiaztheme' ); ?></span>
					</div>
				<?php endfor; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
