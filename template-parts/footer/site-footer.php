<?php
/**
 * Site footer partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

$address      = Fiaztheme\get_field_safe( 'site_address', 'option' );
$phone        = Fiaztheme\site_contact_phone();
$email        = Fiaztheme\site_contact_email();
$whatsapp_url = Fiaztheme\whatsapp_chat_url( Fiaztheme\whatsapp_default_message() );
?>
<footer class="site-footer" role="contentinfo">
	<div class="container">
		<div class="site-footer__grid">
			<div>
				<div class="site-footer__brand">FIAZ CAKRAWALA</div>
				<p class="site-footer__meta">
					<?php echo esc_html( get_bloginfo( 'description' ) ?: __( 'Engineering beyond construction — national-scale industrial solutions.', 'fiaztheme' ) ); ?>
				</p>
				<?php if ( $address ) : ?>
					<p class="site-footer__meta"><?php echo esc_html( $address ); ?></p>
				<?php endif; ?>
			</div>

			<div>
				<p class="section-label"><?php esc_html_e( 'Navigation', 'fiaztheme' ); ?></p>
				<ul class="site-footer__nav">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'fiaztheme' ); ?></a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ?: home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'fiaztheme' ); ?></a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'Projects', 'fiaztheme' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/clients/' ) ); ?>"><?php esc_html_e( 'Clients', 'fiaztheme' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'fiaztheme' ); ?></a></li>
				</ul>
			</div>

			<div>
				<p class="section-label"><?php esc_html_e( 'Contact', 'fiaztheme' ); ?></p>
				<ul class="site-footer__nav">
					<?php if ( $phone ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
					<?php endif; ?>
					<?php if ( $whatsapp_url ) : ?>
						<li><a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WhatsApp customer service', 'fiaztheme' ); ?></a></li>
					<?php endif; ?>
					<li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
				</ul>
			</div>
		</div>

		<div class="site-footer__bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> PT FIAZ CAKRAWALA INDONUSA</span>
			<span><?php esc_html_e( 'Engineering Beyond Construction', 'fiaztheme' ); ?></span>
		</div>
	</div>
</footer>
