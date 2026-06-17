<?php
/**
 * Contact CTA section.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$title = Fiaztheme\get_field_safe( 'cta_title', 'option', __( 'Ready to Build Beyond?', 'fiaztheme' ) );
$text  = Fiaztheme\get_field_safe(
	'cta_text',
	'option',
	__( 'Partner with Indonesia\'s engineering specialists for construction, HVAC, and industrial solutions.', 'fiaztheme' )
);
?>
<section class="section section--cta" aria-labelledby="cta-heading">
	<div class="container">
		<h2 id="cta-heading" class="cta__title reveal-text fade-up"><?php echo esc_html( $title ); ?></h2>
		<p class="cta__text fade-up"><?php echo esc_html( $text ); ?></p>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary fade-up">
			<?php esc_html_e( 'Start a Project', 'fiaztheme' ); ?>
			<?php Fiaztheme\icon( 'arrow-right' ); ?>
		</a>
	</div>
</section>
