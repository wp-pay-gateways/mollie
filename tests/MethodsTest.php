<?php

namespace Pronamic\WordPress\Pay\Gateways\Mollie;

/**
 * Title: Mollie methods test
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 2.0.0
 * @since 1.0.0
 */
class MethodsTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test transform.
	 *
	 * @dataProvider method_matrix_provider
	 */
	public function test_transform( $payment_method, $expected, $default = null ) {
		$mollie_method = Methods::transform( $payment_method, $default );

		$this->assertEquals( $expected, $mollie_method );
	}

	public function method_matrix_provider() {
		return array(
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::BANCONTACT, Methods::MISTERCASH ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::BANK_TRANSFER, Methods::BANKTRANSFER ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::BITCOIN, Methods::BITCOIN ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::CREDIT_CARD, Methods::CREDITCARD ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::DIRECT_DEBIT, Methods::DIRECT_DEBIT ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::DIRECT_DEBIT_IDEAL, Methods::DIRECT_DEBIT ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::MISTER_CASH, Methods::MISTERCASH ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::SOFORT, Methods::SOFORT ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::IDEAL, Methods::IDEAL ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::KBC, Methods::KBC ),
			array( \Pronamic\WordPress\Pay\Core\PaymentMethods::BELFIUS, Methods::BELFIUS ),
			array( 'not existing payment method', null ),
			array( 'not existing payment method', 'test', 'test' ),
			array( null, null ),
			array( 0, null ),
			array( false, null ),
			array( new \stdClass(), null ),
		);
	}
}
