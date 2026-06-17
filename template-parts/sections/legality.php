<?php
/**
 * Legality section.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$documents = function_exists( 'get_field' ) ? get_field( 'legality_documents', 'option' ) : null;

$defaults = [
	[ 'title' => __( 'Company Registration', 'fiaztheme' ), 'number' => '—' ],
	[ 'title' => __( 'Tax Identification', 'fiaztheme' ), 'number' => '—' ],
	[ 'title' => __( 'Business License', 'fiaztheme' ), 'number' => '—' ],
];

if ( empty( $documents ) ) {
	$documents = $defaults;
}
?>
<section class="section section--legality" aria-labelledby="legality-heading">
	<div class="container">
		<div class="section__header fade-up">
			<p class="section-label"><?php esc_html_e( 'Compliance', 'fiaztheme' ); ?></p>
			<h2 id="legality-heading" class="section__title"><?php esc_html_e( 'Company Legality', 'fiaztheme' ); ?></h2>
		</div>
		<div class="grid-3">
			<?php foreach ( $documents as $doc ) : ?>
				<div class="legality-item fade-up">
					<div class="legality-item__title"><?php echo esc_html( $doc['title'] ); ?></div>
					<div class="legality-item__number"><?php echo esc_html( $doc['number'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
