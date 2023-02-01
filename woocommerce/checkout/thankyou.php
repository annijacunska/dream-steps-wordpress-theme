<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order container">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', TD ); ?></p>
			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
			</p>

		<?php else : ?>

			<h2 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', TD ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
			<p class="woocommerce-order-overview__order order large">
				<?php esc_html_e( 'Order number:', 'woocommerce' ); ?> 
				<?php _e( 'Nr.', TD );?>
				<?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</p>
			<div class="thankyou-additional-info">
				<div class="thankyou-info-field">
					<img src="<?php echo THEME_IMG_PATH?>/icons/info.svg" alt="Order info image" width="60" height="60">
					<p class="thankyou-info large"><?php _e( 'Uz Jūsu norādīto mobilo tālruni un e-pastu tiks nosūtīts paziņojums par Jūsu pasūtījuma stāvokli.', TD );?></p>
				</div>
				<div class="thankyou-info-field">
					<img src="<?php echo THEME_IMG_PATH?>/icons/question.svg" alt="Order contact info image" width="60" height="64">
					<p class="thankyou-info large"><?php _e( 'Ja Jums ir radušies jautājumi, variet ar mums sazināties pa telefona numuru +371 26404768 vai rakstiet mums info@dreamsteps.lv', TD );?></p>
				</div>
			</div>

		<?php endif; ?>

		<?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php //do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<h2 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', TD ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>

	<?php endif; ?>

</div>
