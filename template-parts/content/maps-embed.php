<?php
/**
 * Google Maps embed partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$maps_raw    = $args['maps_raw'] ?? '';
$address     = $args['address'] ?? '';
$embed_url   = \Fiaztheme\maps_embed_url( $maps_raw, $address );
$external_url = \Fiaztheme\maps_external_url( $maps_raw, $address );

if ( ! $embed_url ) {
	return;
}
?>
<div class="maps-embed fade-up">
	<iframe
		src="<?php echo esc_url( $embed_url ); ?>"
		loading="lazy"
		referrerpolicy="no-referrer-when-downgrade"
		allowfullscreen
		title="<?php esc_attr_e( 'Location map', 'fiaztheme' ); ?>"
	></iframe>
	<?php if ( $external_url ) : ?>
		<a class="maps-embed__link" href="<?php echo esc_url( $external_url ); ?>" target="_blank" rel="noopener noreferrer">
			<?php esc_html_e( 'Open in Google Maps', 'fiaztheme' ); ?>
			<?php \Fiaztheme\icon( 'arrow-right' ); ?>
		</a>
	<?php endif; ?>
</div>
