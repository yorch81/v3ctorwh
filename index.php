<?php
require 'config.php';
require 'vendor/autoload.php';

// Init Database Connection
V3WareHouse::getInstance("v3Mongo", $hostname, $username, $password, $dbname, $port);

// Init Application
$app = new V3Application($dbname, $key);

// Add Custom Route
$app->addRoute('/openshift', function () {
		    	$app = \Slim\Slim::getInstance();

		        $app->response()->header('Content-Type', 'application/json');
		        $app->response()->status(200);

		        $msg = array("msg" => "Hello localhost !!!");

		        $envvar = getenv('OPENSHIFT_MONGODB_DB_HOST');

		        if (! empty($envvar))
		        	$msg = array("msg" => "Hello Openshift !!!");
		        
		        echo json_encode($msg);
		    });

// Start V3ctor Application
$app->start();

?>