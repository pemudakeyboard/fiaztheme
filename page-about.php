<?php
/**
 * Template Name: About
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();

$page_id = get_queried_object_id();
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php \Fiaztheme\breadcrumb(); ?>
		<p class="section-label"><?php esc_html_e( 'Company', 'fiaztheme' ); ?></p>
		<h1 class="page-header__title"><?php the_title(); ?></h1>
		<p class="page-header__desc"><?php esc_html_e( 'Engineering company, industrial solution provider, and national HVAC specialist.', 'fiaztheme' ); ?></p>
	</div>

	<div class="container section">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="about-block fade-up">
				<h2 class="about-block__title"><?php esc_html_e( 'Our Story', 'fiaztheme' ); ?></h2>
				<div class="intro__content"><?php the_content(); ?></div>
			</div>
		<?php endwhile; ?>

		<?php
		$vision = \Fiaztheme\get_field_safe( 'about_vision', $page_id );
		$mission = \Fiaztheme\get_field_safe( 'about_mission', $page_id );
		$values = function_exists( 'get_field' ) ? get_field( 'about_values', $page_id ) : null;
		$certifications = function_exists( 'get_field' ) ? get_field( 'about_certifications', $page_id ) : null;
		?>

		<?php if ( $vision ) : ?>
			<div class="about-block fade-up">
				<h2 class="about-block__title"><?php esc_html_e( 'Vision', 'fiaztheme' ); ?></h2>
				<div class="intro__content"><?php echo wp_kses_post( $vision ); ?></div>
			</div>
		<?php endif; ?>

		<?php if ( $mission ) : ?>
			<div class="about-block fade-up">
				<h2 class="about-block__title"><?php esc_html_e( 'Mission', 'fiaztheme' ); ?></h2>
				<div class="intro__content"><?php echo wp_kses_post( $mission ); ?></div>
			</div>
		<?php endif; ?>

		<?php if ( $values ) : ?>
			<div class="about-block fade-up">
				<h2 class="about-block__title"><?php esc_html_e( 'Core Values', 'fiaztheme' ); ?></h2>
				<div class="grid-3">
					<?php foreach ( $values as $value ) : ?>
						<div class="value-item">
							<h3><?php echo esc_html( $value['title'] ?? '' ); ?></h3>
							<p><?php echo esc_html( $value['description'] ?? '' ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/sections/legality' ); ?>

		<?php if ( $certifications ) : ?>
			<div class="about-block fade-up">
				<h2 class="about-block__title"><?php esc_html_e( 'Certifications', 'fiaztheme' ); ?></h2>
				<div class="grid-3">
					<?php foreach ( $certifications as $cert ) : ?>
						<div class="legality-item">
							<div class="legality-item__title"><?php echo esc_html( $cert['title'] ?? '' ); ?></div>
							<div class="legality-item__number"><?php echo esc_html( $cert['year'] ?? '' ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/sections/directors' ); ?>
	</div>
</main>
<?php
get_footer();
