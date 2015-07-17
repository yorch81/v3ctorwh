
<?php
	require '../vendor/autoload.php';
	require 'V3WareHouse.class.php';
	require 'config.php';

	$v3ctor = V3WareHouse::getInstance('v3Mongo', $hostname, $username, $password, $dbname, $key);

?>

