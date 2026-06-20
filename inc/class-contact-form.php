<?php
/**
 * Custom contact form handler.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

namespace Fiaztheme;

/**
 * Contact_Form class.
 */
final class Contact_Form {

	/**
	 * Register hooks.
	 */
	public static function init(): void {
		add_action( 'admin_post_nopriv_fiaz_contact', [ self::class, 'handle' ] );
		add_action( 'admin_post_fiaz_contact', [ self::class, 'handle' ] );
	}

	/**
	 * Process contact form submission.
	 */
	public static function handle(): void {
		if ( ! isset( $_POST['fiaz_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fiaz_contact_nonce'] ) ), 'fiaz_contact' ) ) {
			self::redirect_with_status( 'error', __( 'Security check failed.', 'fiaztheme' ) );
		}

		// Honeypot spam protection.
		if ( ! empty( $_POST['fiaz_website'] ) ) {
			self::redirect_with_status( 'error', __( 'Spam detected.', 'fiaztheme' ) );
		}

		$name    = isset( $_POST['fiaz_name'] ) ? sanitize_text_field( wp_unslash( $_POST['fiaz_name'] ) ) : '';
		$email   = isset( $_POST['fiaz_email'] ) ? sanitize_email( wp_unslash( $_POST['fiaz_email'] ) ) : '';
		$phone   = isset( $_POST['fiaz_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['fiaz_phone'] ) ) : '';
		$company = isset( $_POST['fiaz_company'] ) ? sanitize_text_field( wp_unslash( $_POST['fiaz_company'] ) ) : '';
		$message = isset( $_POST['fiaz_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['fiaz_message'] ) ) : '';

		if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
			self::redirect_with_status( 'error', __( 'Please fill all required fields.', 'fiaztheme' ) );
		}

		if ( ! is_email( $email ) ) {
			self::redirect_with_status( 'error', __( 'Invalid email address.', 'fiaztheme' ) );
		}

		$to      = site_contact_email();
		$subject = sprintf(
			/* translators: %s: sender name */
			__( 'New contact from %s — FIAZ Cakrawala', 'fiaztheme' ),
			$name
		);

		$body = sprintf(
			"Name: %s\nEmail: %s\nPhone: %s\nCompany: %s\n\nMessage:\n%s",
			$name,
			$email,
			$phone,
			$company,
			$message
		);

		$headers = [
			'Content-Type: text/plain; charset=UTF-8',
			'Reply-To: ' . $name . ' <' . $email . '>',
		];

		$sent = wp_mail( $to, $subject, $body, $headers );

		if ( $sent ) {
			self::redirect_with_status( 'success', __( 'Thank you. We will contact you soon.', 'fiaztheme' ) );
		}

		self::redirect_with_status( 'error', __( 'Failed to send message. Please try again.', 'fiaztheme' ) );
	}

	/**
	 * Redirect back to contact page with flash message.
	 */
	private static function redirect_with_status( string $status, string $message ): void {
		$redirect = wp_get_referer() ?: home_url( '/contact/' );

		set_transient( 'fiaz_contact_flash', [
			'status'  => $status,
			'message' => $message,
		], 60 );

		wp_safe_redirect( $redirect );
		exit;
	}

	/**
	 * Get flash message for display.
	 */
	public static function get_flash(): ?array {
		$flash = get_transient( 'fiaz_contact_flash' );

		if ( $flash ) {
			delete_transient( 'fiaz_contact_flash' );
			return $flash;
		}

		return null;
	}
}
