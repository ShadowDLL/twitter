<?php
require 'environment.php';
define("BASE_URL", "twitter:81");
global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'twitter';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	$config['dbname'] = 'u197768762_porti';
	$config['host'] = 'mysql.hostinger.com.br';
	$config['dbuser'] = 'u197768762_porti';
	$config['dbpass'] = '123456';
}
