<?php
/*
 * Plugin Name: No Checks for Digitals
 */

class No_Checks_For_Digitals {
	public function __construct() {
		add_filter( 'woocommerce_available_payment_gateways', array( &$this, 'do_no_checks' ), 90, 1 );
	}

	public function do_no_checks( $gateways ) {

		$do_checks = true;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

			//error_log( print_r( $cart_item, true ) );

			if( $cart_item['data']->is_virtual() || $cart_item['data']->is_downloadable() ) {
				$do_checks = false;
			}

		}

		if( !$do_checks ) {
			unset( $gateways['cheque'] );
		}

		return $gateways;
	}

}

$no_checks_for_digitals = new No_Checks_For_Digitals();

/* EOF */
