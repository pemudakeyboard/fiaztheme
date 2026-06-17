<?php
/**
 * Projects archive template.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();

$projects = get_posts(
	[
		'post_type'      => 'project',
		'posts_per_page' => -1,
		'orderby'        => 'meta_value',
		'meta_key'       => 'project_year',
		'order'          => 'DESC',
	]
);

$years       = Fiaztheme\project_years();
$categories  = Fiaztheme\project_categories();
$by_year     = [];

foreach ( $projects as $project ) {
	$year = Fiaztheme\get_field_safe( 'project_year', $project->ID, '2024' );
	if ( ! isset( $by_year[ $year ] ) ) {
		$by_year[ $year ] = [];
	}
	$by_year[ $year ][] = $project;
}
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php Fiaztheme\breadcrumb(); ?>
		<p class="section-label"><?php esc_html_e( 'Portfolio', 'fiaztheme' ); ?></p>
		<h1 class="page-header__title"><?php esc_html_e( 'Projects', 'fiaztheme' ); ?></h1>
		<p class="page-header__desc"><?php esc_html_e( 'National portfolio — filter by year and category.', 'fiaztheme' ); ?></p>
	</div>

	<div class="container section">
		<div class="view-toggle fade-up">
			<button type="button" class="view-toggle__btn is-active" data-view="grid"><?php esc_html_e( 'Grid', 'fiaztheme' ); ?></button>
			<button type="button" class="view-toggle__btn" data-view="timeline"><?php esc_html_e( 'Timeline', 'fiaztheme' ); ?></button>
		</div>

		<div class="filter-bar fade-up">
			<button type="button" class="filter-btn is-active" data-filter-year="all"><?php esc_html_e( 'All Years', 'fiaztheme' ); ?></button>
			<?php foreach ( $years as $year ) : ?>
				<button type="button" class="filter-btn" data-filter-year="<?php echo esc_attr( $year ); ?>"><?php echo esc_html( $year ); ?></button>
			<?php endforeach; ?>
		</div>

		<div class="filter-bar fade-up">
			<button type="button" class="filter-btn is-active" data-filter-category="all"><?php esc_html_e( 'All Categories', 'fiaztheme' ); ?></button>
			<?php foreach ( $categories as $slug => $label ) : ?>
				<button type="button" class="filter-btn" data-filter-category="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $label ); ?></button>
			<?php endforeach; ?>
		</div>

		<div class="projects-grid grid-3" data-projects>
			<?php foreach ( $projects as $project ) : ?>
				<?php
				set_query_var( 'fiaz_project_post', $project );
				get_template_part( 'template-parts/content/project-card' );
				?>
			<?php endforeach; ?>
		</div>

		<div class="projects-timeline is-hidden" data-projects>
			<?php foreach ( $years as $year ) : ?>
				<?php if ( empty( $by_year[ $year ] ) ) continue; ?>
				<div class="timeline__group" data-year-group="<?php echo esc_attr( $year ); ?>">
					<div class="timeline__year"><?php echo esc_html( $year ); ?></div>
					<div class="grid-3">
						<?php foreach ( $by_year[ $year ] as $project ) : ?>
							<?php
							set_query_var( 'fiaz_project_post', $project );
							get_template_part( 'template-parts/content/project-card' );
							?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( empty( $projects ) ) : ?>
			<p class="section__desc"><?php esc_html_e( 'No projects published yet.', 'fiaztheme' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
