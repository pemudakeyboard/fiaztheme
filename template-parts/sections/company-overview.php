<?php
/**
 * Company overview section.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

use function Fiaztheme\field_has_content;
use function Fiaztheme\get_field_safe;
use function Fiaztheme\icon;

$headline = get_field_safe(
	'company_headline',
	'option',
	__( 'Engineering at National Scale', 'fiaztheme' )
);

$intro = field_has_content( 'company_intro', 'option' )
	? get_field_safe( 'company_intro', 'option' )
	: '';

$default_intro = __( 'PT FIAZ CAKRAWALA INDONUSA delivers engineering excellence across construction, HVAC, mechanical, electrical, and industrial maintenance — trusted by BUMN, manufacturing, healthcare, and enterprise facilities nationwide.', 'fiaztheme' );

$highlights = function_exists( 'get_field' ) ? get_field( 'company_highlights', 'option' ) : null;

$default_highlights = [
	__( 'Construction & Building', 'fiaztheme' ),
	__( 'HVAC & Climate Systems', 'fiaztheme' ),
	__( 'Mechanical & Electrical', 'fiaztheme' ),
	__( 'Industrial Maintenance', 'fiaztheme' ),
];

if ( empty( $highlights ) ) {
	$highlights = array_map(
		static fn( string $label ): array => [ 'label' => $label ],
		$default_highlights
	);
}

$company_image = function_exists( 'get_field' ) ? get_field( 'company_image', 'option' ) : null;
?>
<section class="section section--company" aria-labelledby="company-heading" data-company-section>
	<div class="container">
		<div class="company__grid">
			<div class="company__aside fade-up">
				<p class="section-label"><?php esc_html_e( 'Company', 'fiaztheme' ); ?></p>
				<h2 id="company-heading" class="company__title"><?php echo esc_html( $headline ); ?></h2>
				<div class="company__rule" aria-hidden="true"></div>
				<p class="company__tagline"><?php esc_html_e( 'Industrial solutions. National coverage. Engineering precision.', 'fiaztheme' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn--outline company__cta">
					<?php esc_html_e( 'About Us', 'fiaztheme' ); ?>
					<?php icon( 'arrow-right' ); ?>
				</a>
			</div>

			<div class="company__main fade-up">
				<?php if ( is_array( $company_image ) && ! empty( $company_image['url'] ) ) : ?>
					<div class="company__visual">
						<img
							src="<?php echo esc_url( $company_image['sizes']['fiaz-project'] ?? $company_image['url'] ); ?>"
							alt="<?php echo esc_attr( $company_image['alt'] ?? $headline ); ?>"
							loading="lazy"
							width="<?php echo esc_attr( $company_image['width'] ?? '' ); ?>"
							height="<?php echo esc_attr( $company_image['height'] ?? '' ); ?>"
						>
					</div>
				<?php endif; ?>

				<div class="company__body">
					<?php if ( $intro ) : ?>
						<?php echo wp_kses_post( $intro ); ?>
					<?php else : ?>
						<p class="company__lead"><?php echo esc_html( $default_intro ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( $highlights ) : ?>
					<ul class="company__highlights" aria-label="<?php esc_attr_e( 'Core capabilities', 'fiaztheme' ); ?>">
						<?php foreach ( $highlights as $index => $item ) : ?>
							<?php
							$label = trim( (string) ( $item['label'] ?? '' ) );
							if ( ! $label ) {
								continue;
							}
							?>
							<li class="company__highlight">
								<span class="company__highlight-index"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<span class="company__highlight-text"><?php echo esc_html( $label ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
