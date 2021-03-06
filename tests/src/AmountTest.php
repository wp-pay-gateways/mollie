<?php
/**
 * Mollie amount test.
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2021 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Pay
 */

namespace Pronamic\WordPress\Pay\Gateways\Mollie;

use InvalidArgumentException;

/**
 * Title: Mollie amount tests
 * Description:
 * Copyright: 2005-2021 Pronamic
 * Company: Pronamic
 *
 * @author  Reüel van der Steege
 * @version 2.1.0
 * @since   2.1.0
 */
class AmountTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test amount setters and getters.
	 */
	public function test_setters_and_getters() {
		$amount = new Amount( 'EUR', '100.00' );

		$this->assertInstanceOf( __NAMESPACE__ . '\Amount', $amount );

		$this->assertEquals( 'EUR', $amount->get_currency() );
		$this->assertEquals( '100.00', $amount->get_value() );

		$this->assertEquals( 'EUR 100.00', (string) $amount );
	}

	/**
	 * Test JSON.
	 */
	public function test_json() {
		$json_file = __DIR__ . '/../json/amount.json';

		$json_data = json_decode( file_get_contents( $json_file, true ) );

		$amount = Amount::from_json( $json_data );

		$json_string = wp_json_encode( $amount->get_json(), JSON_PRETTY_PRINT );

		$this->assertEquals( wp_json_encode( $json_data, JSON_PRETTY_PRINT ), $json_string );

		$this->assertJsonStringEqualsJsonFile( $json_file, $json_string );
	}

	/**
	 * Test from invalid object without currency.
	 */
	public function test_invalid_object_missing_currency() {
		$object = (object) array( 'value' => '100.00' );

		$this->expectException( InvalidArgumentException::class );

		Amount::from_object( $object );
	}

	/**
	 * Test from invalid object without value.
	 */
	public function test_from_object_missing_value() {
		$object = (object) array( 'currency' => 'EUR' );

		$this->expectException( InvalidArgumentException::class );

		Amount::from_object( $object );
	}
}
