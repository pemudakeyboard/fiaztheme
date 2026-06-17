<?php
/**
 * Single project template.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();

$year     = Fiaztheme\get_field_safe( 'project_year' );
$category = Fiaztheme\get_field_safe( 'project_category' );
$location = Fiaztheme\get_field_safe( 'project_location' );
$client   = Fiaztheme\get_field_safe( 'project_client' );
$gallery  = function_exists( 'get_field' ) ? get_field( 'project_gallery' ) : null;
$cat_label = Fiaztheme\project_categories()[ $category ] ?? $category;
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php Fiaztheme\breadcrumb(); ?>
		<p class="section-label"><?php echo esc_html( $cat_label ); ?></p>
		<h1 class="page-header__title"><?php the_title(); ?></h1>
	</div>

	<div class="container section">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="single-project__hero fade-up">
				<?php the_post_thumbnail( 'fiaz-hero', [ 'loading' => 'eager' ] ); ?>
			</div>
		<?php endif; ?>

		<div class="single-project__meta fade-up">
			<?php if ( $year ) : ?><span><?php echo esc_html( $year ); ?></span><?php endif; ?>
			<?php if ( $location ) : ?><span><?php echo esc_html( $location ); ?></span><?php endif; ?>
			<?php if ( $client ) : ?><span><?php echo esc_html( $client ); ?></span><?php endif; ?>
		</div>

		<div class="intro__content fade-up">
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		</div>

		<?php if ( $gallery ) : ?>
			<div class="single-project__gallery fade-up">
				<?php foreach ( $gallery as $image ) : ?>
					<div class="gallery-item">
						<img src="<?php echo esc_url( $image['sizes']['fiaz-project'] ?? $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>" loading="lazy">
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
