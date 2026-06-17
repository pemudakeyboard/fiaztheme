<?php
/**
 * Hero section with video / image slider background.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$line1    = Fiaztheme\get_field_safe( 'hero_line_1', 'option', 'ENGINEERING' );
$line2    = Fiaztheme\get_field_safe( 'hero_line_2', 'option', 'BEYOND' );
$line3    = Fiaztheme\get_field_safe( 'hero_line_3', 'option', 'CONSTRUCTION' );
$subtitle = Fiaztheme\get_field_safe(
	'hero_subtitle',
	'option',
	__( 'National-scale engineering, construction, HVAC, and industrial solutions for enterprise clients across Indonesia.', 'fiaztheme' )
);

$media_type   = Fiaztheme\get_field_safe( 'hero_media_type', 'option', 'images' );
$hero_slides  = function_exists( 'get_field' ) ? get_field( 'hero_slides', 'option' ) : null;
$video_url    = Fiaztheme\get_field_safe( 'hero_video_url', 'option' );
$video_poster = function_exists( 'get_field' ) ? get_field( 'hero_video_poster', 'option' ) : null;
$poster_url   = is_array( $video_poster ) ? ( $video_poster['url'] ?? '' ) : '';
$has_video    = $media_type === 'video' && $video_url;
$has_slides   = $media_type === 'images' && ! empty( $hero_slides );
?>
<section class="section section--hero" aria-label="<?php esc_attr_e( 'Hero', 'fiaztheme' ); ?>">
	<div class="hero__media" aria-hidden="true">
		<?php if ( $has_video ) : ?>
			<video class="hero__video" autoplay muted loop playsinline <?php echo $poster_url ? 'poster="' . esc_url( $poster_url ) . '"' : ''; ?>>
				<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
			</video>
		<?php elseif ( $has_slides ) : ?>
			<div class="swiper hero-swiper">
				<div class="swiper-wrapper">
					<?php foreach ( $hero_slides as $index => $slide ) : ?>
						<div class="swiper-slide">
							<img
								src="<?php echo esc_url( $slide['sizes']['fiaz-hero'] ?? $slide['url'] ); ?>"
								alt="<?php echo esc_attr( $slide['alt'] ?? '' ); ?>"
								loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
							>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if ( count( $hero_slides ) > 1 ) : ?>
					<div class="hero-swiper-pagination"></div>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<div class="hero__media-fallback"></div>
		<?php endif; ?>
		<div class="hero__overlay"></div>
	</div>

	<div class="container hero__content">
		<h1 class="hero__title" data-hero-animate>
			<span class="line"><?php echo esc_html( $line1 ); ?></span>
			<span class="line"><?php echo esc_html( $line2 ); ?></span>
			<span class="line"><?php echo esc_html( $line3 ); ?></span>
		</h1>
		<p class="hero__subtitle" data-hero-animate><?php echo esc_html( $subtitle ); ?></p>
		<div class="hero__actions" data-hero-animate>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="btn btn--primary">
				<?php esc_html_e( 'View Projects', 'fiaztheme' ); ?>
				<?php Fiaztheme\icon( 'arrow-right' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'Contact Us', 'fiaztheme' ); ?>
			</a>
		</div>
	</div>

	<div class="hero__scroll" data-hero-animate aria-hidden="true">
		<span class="hero__scroll-line"></span>
		<?php esc_html_e( 'Scroll', 'fiaztheme' ); ?>
	</div>
</section>
