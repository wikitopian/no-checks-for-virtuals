<?php
/*
 * Plugin Name: No Checks for Virtuals
 */

class No_Checks_For_Virtuals {
	public function __construct() {
		add_filter( 'woocommerce_available_payment_gateways', array( &$this, 'do_no_checks' ), 90, 1 );
	}

	public function do_no_checks( $gateways ) {
		if( !WC()->cart ) return $gateways;

		$do_checks = true;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

			if( $cart_item['data']->is_virtual() ) {
				$do_checks = false;
			}

		}

		if( !$do_checks ) {
			unset( $gateways['cheque'] );
		}

		return $gateways;
	}

}

$no_checks_for_virtuals = new No_Checks_For_Virtuals();

/* EOF */
