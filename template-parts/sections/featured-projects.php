<?php
/**
 * Featured projects section.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$projects = get_posts(
	[
		'post_type'      => 'project',
		'posts_per_page' => 8,
		'meta_query'     => [
			[
				'key'   => 'project_featured',
				'value' => '1',
			],
		],
	]
);

if ( empty( $projects ) ) {
	$projects = get_posts(
		[
			'post_type'      => 'project',
			'posts_per_page' => 8,
			'orderby'        => 'date',
			'order'          => 'DESC',
		]
	);
}

$categories = Fiaztheme\project_categories();
?>
<section class="section section--projects-preview" aria-labelledby="projects-heading">
	<div class="container">
		<div class="section__header fade-up">
			<p class="section-label"><?php esc_html_e( 'Portfolio', 'fiaztheme' ); ?></p>
			<h2 id="projects-heading" class="section__title"><?php esc_html_e( 'Featured Projects', 'fiaztheme' ); ?></h2>
			<p class="section__desc"><?php esc_html_e( 'National portfolio across HVAC, construction, and industrial engineering.', 'fiaztheme' ); ?></p>
		</div>

		<?php if ( $projects ) : ?>
			<div class="swiper projects-swiper fade-up">
				<div class="swiper-wrapper">
					<?php foreach ( $projects as $project ) : ?>
						<div class="swiper-slide">
							<?php
							set_query_var( 'fiaz_project_post', $project );
							get_template_part( 'template-parts/content/project-card' );
							?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php else : ?>
			<p class="section__desc fade-up"><?php esc_html_e( 'Projects will appear here once published in the admin.', 'fiaztheme' ); ?></p>
		<?php endif; ?>

		<div class="fade-up" style="margin-top:3rem">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'All Projects', 'fiaztheme' ); ?>
				<?php Fiaztheme\icon( 'arrow-right' ); ?>
			</a>
		</div>
	</div>
</section>
