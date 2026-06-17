<?php
/**
 * Services section (homepage).
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$services = get_posts(
	[
		'post_type'      => 'service',
		'posts_per_page' => 6,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	]
);
?>
<section class="section section--services" aria-labelledby="services-heading">
	<div class="container">
		<div class="section__header fade-up">
			<p class="section-label"><?php esc_html_e( 'Capabilities', 'fiaztheme' ); ?></p>
			<h2 id="services-heading" class="section__title"><?php esc_html_e( 'Core Services', 'fiaztheme' ); ?></h2>
			<p class="section__desc"><?php esc_html_e( 'Construction, supply, and technical services engineered for industrial scale.', 'fiaztheme' ); ?></p>
		</div>

		<?php if ( $services ) : ?>
			<div class="grid-3">
				<?php foreach ( $services as $service ) : ?>
					<?php
					set_query_var( 'fiaz_service_post', $service );
					get_template_part( 'template-parts/content/service-card' );
					?>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<div class="grid-3">
				<?php
				$placeholders = [
					[ 'title' => __( 'Construction', 'fiaztheme' ), 'desc' => __( 'Building, mechanical, electrical, and environmental engineering.', 'fiaztheme' ), 'icon' => 'CONST' ],
					[ 'title' => __( 'HVAC Systems', 'fiaztheme' ), 'desc' => __( 'Chiller, VRV, VRF, and climate control for enterprise facilities.', 'fiaztheme' ), 'icon' => 'HVAC' ],
					[ 'title' => __( 'Technical Services', 'fiaztheme' ), 'desc' => __( 'Preventive maintenance and industrial equipment support.', 'fiaztheme' ), 'icon' => 'TECH' ],
				];
				foreach ( $placeholders as $item ) :
					?>
					<div class="service-card fade-up">
						<div class="service-card__content">
							<div class="service-card__icon"><?php echo esc_html( $item['icon'] ); ?></div>
							<h3 class="service-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
							<p class="service-card__desc"><?php echo esc_html( $item['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="fade-up" style="margin-top:3rem">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ?: home_url( '/services/' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'All Services', 'fiaztheme' ); ?>
				<?php \Fiaztheme\icon( 'arrow-right' ); ?>
			</a>
		</div>
	</div>
</section>
