<?php
/**
 * Template Name: Contact
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();

$address      = \Fiaztheme\get_field_safe( 'site_address', 'option' );
$phone        = \Fiaztheme\site_contact_phone();
$email        = \Fiaztheme\site_contact_email();
$whatsapp_url = \Fiaztheme\whatsapp_chat_url( \Fiaztheme\whatsapp_default_message() );
$maps_raw     = \Fiaztheme\get_field_safe( 'site_maps_embed', 'option' );
$maps_url  = \Fiaztheme\maps_embed_url( $maps_raw, $address );
?>
<main id="main" class="site-main section--contact-page">
	<div class="container page-header">
		<?php \Fiaztheme\breadcrumb(); ?>
		<p class="section-label"><?php esc_html_e( 'Connect', 'fiaztheme' ); ?></p>
		<h1 class="page-header__title"><?php esc_html_e( 'Contact', 'fiaztheme' ); ?></h1>
		<p class="page-header__desc"><?php esc_html_e( 'Discuss your engineering, construction, or HVAC requirements with our team.', 'fiaztheme' ); ?></p>
	</div>

	<div class="container section">
		<div class="contact__grid">
			<div class="fade-up">
				<div class="contact__info-item">
					<strong><?php esc_html_e( 'Address', 'fiaztheme' ); ?></strong>
					<span><?php echo esc_html( $address ?: __( 'Indonesia', 'fiaztheme' ) ); ?></span>
				</div>
				<?php if ( $phone ) : ?>
					<div class="contact__info-item">
						<strong><?php esc_html_e( 'Phone', 'fiaztheme' ); ?></strong>
						<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
					</div>
				<?php endif; ?>
				<?php if ( $whatsapp_url ) : ?>
					<div class="contact__info-item">
						<strong><?php esc_html_e( 'WhatsApp', 'fiaztheme' ); ?></strong>
						<a class="btn btn--whatsapp contact__whatsapp-link" href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer">
							<?php Fiaztheme\icon( 'whatsapp' ); ?>
							<?php esc_html_e( 'Chat with customer service', 'fiaztheme' ); ?>
						</a>
					</div>
				<?php endif; ?>
				<div class="contact__info-item">
					<strong><?php esc_html_e( 'Email', 'fiaztheme' ); ?></strong>
					<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
				</div>

				<?php if ( $maps_url ) : ?>
					<?php
					get_template_part(
						'template-parts/content/maps-embed',
						null,
						[
							'maps_raw' => $maps_raw,
							'address'  => $address,
						]
					);
					?>
				<?php endif; ?>
			</div>

			<div class="fade-up">
				<h2 class="section__title contact-form__title"><?php esc_html_e( 'Send a Message', 'fiaztheme' ); ?></h2>
				<?php get_template_part( 'template-parts/content/contact-form' ); ?>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
