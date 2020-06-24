<?php

namespace JsonplaceholderUsers\Tests;
use Brain\Monkey;
use PHPUnit\Framework\TestCase;

class JsonplaceholderUsersTestCase extends \PHPUnit\Framework\TestCase {
	protected function setUp() {
		parent::setUp();
		Monkey\setUp();
	}

	protected function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}
}
