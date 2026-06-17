<?php
/**
 * Statistics / Scale section.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$stats = function_exists( 'get_field' ) ? get_field( 'statistics', 'option' ) : null;

$defaults = [
	[ 'number' => '15', 'suffix' => '+', 'label' => __( 'Years Experience', 'fiaztheme' ) ],
	[ 'number' => '200', 'suffix' => '+', 'label' => __( 'Projects Delivered', 'fiaztheme' ) ],
	[ 'number' => '50', 'suffix' => '+', 'label' => __( 'Enterprise Clients', 'fiaztheme' ) ],
	[ 'number' => '100', 'suffix' => '%', 'label' => __( 'National Coverage', 'fiaztheme' ) ],
];

if ( empty( $stats ) ) {
	$stats = $defaults;
}
?>
<section class="section section--stats" aria-labelledby="stats-heading" data-stats-section>
	<div class="container">
		<div class="section__header fade-up">
			<p class="section-label"><?php esc_html_e( 'Scale', 'fiaztheme' ); ?></p>
			<h2 id="stats-heading" class="section__title"><?php esc_html_e( 'Built on Trust & Precision', 'fiaztheme' ); ?></h2>
			<p class="section__desc"><?php esc_html_e( 'Delivering engineering excellence at national scale across Indonesia.', 'fiaztheme' ); ?></p>
		</div>

		<div class="stats__grid">
			<?php foreach ( $stats as $stat ) : ?>
				<?php
				$number = preg_replace( '/[^\d.]/', '', (string) ( $stat['number'] ?? '0' ) );
				$number = $number !== '' ? $number : '0';
				$suffix = (string) ( $stat['suffix'] ?? '' );
				?>
				<div class="stat-item" data-stat-item>
					<div class="stat-item__number" data-count-to="<?php echo esc_attr( $number ); ?>">
						<span class="stat-item__value">0</span>
						<?php if ( $suffix ) : ?>
							<span class="stat-item__suffix"><?php echo esc_html( $suffix ); ?></span>
						<?php endif; ?>
					</div>
					<div class="stat-item__label"><?php echo esc_html( $stat['label'] ); ?></div>
					<div class="stat-item__bar" aria-hidden="true"><span data-stat-bar></span></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
