<?php
require 'environment.php';
define("BASE_URL", "http://twitter:81");
global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'twitter';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	$config['dbname'] = 'twitter';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}
