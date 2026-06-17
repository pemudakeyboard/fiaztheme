<?php
/**
 * Single service template.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();

$category = Fiaztheme\get_field_safe( 'service_category' );
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php Fiaztheme\breadcrumb(); ?>
		<?php if ( $category ) : ?>
			<p class="section-label"><?php echo esc_html( ucfirst( $category ) ); ?></p>
		<?php endif; ?>
		<h1 class="page-header__title"><?php the_title(); ?></h1>
	</div>

	<div class="container section">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="single-project__hero fade-up">
				<?php the_post_thumbnail( 'fiaz-hero', [ 'loading' => 'eager' ] ); ?>
			</div>
		<?php endif; ?>

		<div class="intro__content fade-up">
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		</div>

		<div class="single-service__cta fade-up">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary">
				<?php esc_html_e( 'Discuss This Service', 'fiaztheme' ); ?>
				<?php Fiaztheme\icon( 'arrow-right' ); ?>
			</a>
		</div>
	</div>
</main>
<?php
get_footer();
