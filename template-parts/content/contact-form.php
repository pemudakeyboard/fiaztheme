<?php
/**
 * Contact form partial.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

use Fiaztheme\Contact_Form;

$flash = Contact_Form::get_flash();
?>
<?php if ( $flash ) : ?>
	<div class="alert alert--<?php echo esc_attr( $flash['status'] ); ?>" role="alert">
		<?php echo esc_html( $flash['message'] ); ?>
	</div>
<?php endif; ?>

<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<input type="hidden" name="action" value="fiaz_contact">
	<?php wp_nonce_field( 'fiaz_contact', 'fiaz_contact_nonce' ); ?>

	<div class="form-honeypot" aria-hidden="true">
		<label for="fiaz_website"><?php esc_html_e( 'Website', 'fiaztheme' ); ?></label>
		<input type="text" name="fiaz_website" id="fiaz_website" tabindex="-1" autocomplete="off">
	</div>

	<div class="form-group">
		<label class="form-label" for="fiaz_name"><?php esc_html_e( 'Name *', 'fiaztheme' ); ?></label>
		<input class="form-input" type="text" name="fiaz_name" id="fiaz_name" required>
	</div>

	<div class="form-group">
		<label class="form-label" for="fiaz_email"><?php esc_html_e( 'Email *', 'fiaztheme' ); ?></label>
		<input class="form-input" type="email" name="fiaz_email" id="fiaz_email" required>
	</div>

	<div class="form-group">
		<label class="form-label" for="fiaz_phone"><?php esc_html_e( 'Phone', 'fiaztheme' ); ?></label>
		<input class="form-input" type="tel" name="fiaz_phone" id="fiaz_phone">
	</div>

	<div class="form-group">
		<label class="form-label" for="fiaz_company"><?php esc_html_e( 'Company', 'fiaztheme' ); ?></label>
		<input class="form-input" type="text" name="fiaz_company" id="fiaz_company">
	</div>

	<div class="form-group">
		<label class="form-label" for="fiaz_message"><?php esc_html_e( 'Message *', 'fiaztheme' ); ?></label>
		<textarea class="form-textarea" name="fiaz_message" id="fiaz_message" required></textarea>
	</div>

	<button type="submit" class="btn btn--primary">
		<?php esc_html_e( 'Send Message', 'fiaztheme' ); ?>
		<?php \Fiaztheme\icon( 'arrow-right' ); ?>
	</button>
</form>
