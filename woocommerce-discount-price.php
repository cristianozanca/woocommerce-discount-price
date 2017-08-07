<?php
/*
Plugin Name: WooCommerce discount price
Plugin URI:  https://zanca.it/plugin
Description: display the discounted price in cart
Version:     0.1
Author:      Cristiano Zanca
Author URI:  https://zanca.it
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: woocommerce-discount-price
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Check if WooCommerce is active
 **/
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


	function woodiscpr_error_notice() {
		?>
		<div class="notice error is-dismissible">
			<p><?php _e( 'Please install or activate WooCommerce Plugin, it is required for WooCommerce Discount Price Plugin to work ', 'woodiscpr_textdomain' ); ?></p>
		</div>
		<?php
	}
	add_action( 'admin_notices', 'woodiscpr_error_notice' );

}


add_filter( 'woocommerce_cart_item_price', 'woodiscpr_change_cart_table_price_display', 30, 3 );

function woodiscpr_change_cart_table_price_display( $price, $values, $cart_item_key ) {
	$slashed_price = $values['data']->get_price_html();
	$is_on_sale = $values['data']->is_on_sale();
	if ( $is_on_sale ) {
		$price = $slashed_price;
	}
	return $price;
}