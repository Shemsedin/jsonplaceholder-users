<?php
/**
 * Plugin Name: Jsonplaceholder Users
 * Version: 1.0
 * Description: Gets the data from an external api https://jsonplaceholder
 * .typicode.com, which holds dummy users data.  It further manipulates the
 * data and displays them in an HTML table.
 * Author: Shemsedin Callaki
 * <shemsedin.callaki@gmail.com>
 */

defined( 'ABSPATH' ) || die( 'No direct access!' );

require plugin_dir_path( __FILE__ ) . '/src/JsonplaceholderUsers.php';

function run_jsonplaceholder_users() {
	global $skeleton;
	$skeleton = new \JsonplaceholderUsers\JsonplaceholderUsers();
	$skeleton->run();
}

run_jsonplaceholder_users();
