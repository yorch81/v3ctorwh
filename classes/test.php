<?php

	require_once('config.php');
	require_once('V3ctorWH.class.php');

	// V3ctorWH Instance
	$v3ctor = V3ctorWH::getInstance($hostname, $username, $password, $dbname, $key);

	if (! $v3ctor->isConnected())
	    die("Unable load V3ctor WareHouse");

	$jsonData =  array("yorch" => 666);

	$query = array('Type' => 'Fruit');

	//echo var_dump($v3ctor->newObject('yorchwh', $jsonData));

	//echo var_dump($v3ctor->newObject('yorchwh', $query));

	echo var_dump($v3ctor->query('yorchwh', $query));

	//echo var_dump($v3ctor->findObject('yorchwh', '550a3a882cb98f8c1e8b4567'));

	//echo var_dump($v3ctor->updateObject('yorchwh', '550a3a882cb98f8c1e8b4567', $jsonData));

	//echo var_dump($v3ctor->deleteObject('yorchwh', '550a3a882cb98f8c1e8b4567'));
	

	//localhost:27017: Mod on _id not allowed
?>