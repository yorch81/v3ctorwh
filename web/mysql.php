<?php
require_once('../classes/config.php');
require_once('../classes/V3WareHouse.class.php');

require '../vendor/autoload.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// V3ctorWH Instance
$v3ctor = V3WareHouse::getInstance('V3MySQL', $hostname, $username, $password, $dbname, $key);

if (! $v3ctor->isConnected())
    die("Unable load V3ctor WareHouse");

$jsonData = array('name' => 'jorgitos', 'address' => 'Moderna', 'lat' => 23.198746, 'lng' => -99.109741);

$v3ctor->updateObject("markers2", 1, $jsonData);

$v3ctor->deleteObject("markers2", 1);


//echo var_dump($v3ctor->query("markers2", array('address' => 'Mante')));

//echo var_dump($v3ctor->newObject("markers2", $jsonData));

//echo var_dump($v3ctor->findObject('markers2', 1));

?>