<?php
namespace JsonplaceholderUsers\Tests;

use Brain\Monkey;
use Brain\Monkey\Functions;
use Brain\Monkey\Actions;
use Brain\Monkey\Filters;
use JsonplaceholderUsers\JsonplaceholderUsers;

class JsonplaceholderUsersTest extends JsonplaceholderUsersTestCase {

	protected $jsonplaceholder_users;

	/**
	 * Set the test up.
	 */
	public function setUp() {
		parent::setUp();
		Monkey\setUp();
		$this->jsonplaceholder_users = new JsonplaceholderUsers();
	}

	/**
	 * Teardown test.
	 */
	public function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}

	public function testGetEndpoint() {
		$endpoint = $this->jsonplaceholder_users->getEndpoint();
		$this->assertNotEmpty( $endpoint );
	}

	public function testGetResponseCode() {
		// Mocking mock wp_remote_retrieve_response_code.  We are just returning response code 200.
		Functions\when( 'wp_remote_retrieve_response_code' )->justReturn( 200 );
		$responseCode = wp_remote_retrieve_response_code();

		$this->assertEquals( 200, $responseCode );
		$this->assertNotEmpty( $this->jsonplaceholder_users->getEndpoint() );
	}

	public function testGetResponseMessage() {
		// Mocking mock wp_remote_retrieve_response_message.
		Functions\when( 'wp_remote_retrieve_response_message' )->justReturn( 'OK' );
		$responseMessage = wp_remote_retrieve_response_message();
		var_dump( $responseMessage );

		$this->assertEquals( 'OK', $responseMessage );
	}
}
