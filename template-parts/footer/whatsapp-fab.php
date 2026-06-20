<?php
/**
 * Floating WhatsApp customer service button.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

if ( ! Fiaztheme\has_whatsapp_chat() ) {
	return;
}

$whatsapp_url = Fiaztheme\whatsapp_chat_url( Fiaztheme\whatsapp_default_message() );
?>
<a
	href="<?php echo esc_url( $whatsapp_url ); ?>"
	class="whatsapp-fab"
	target="_blank"
	rel="noopener noreferrer"
	aria-label="<?php esc_attr_e( 'Chat with FIAZ Cakrawala on WhatsApp', 'fiaztheme' ); ?>"
>
	<?php Fiaztheme\icon( 'whatsapp' ); ?>
</a>
