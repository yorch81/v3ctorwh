<?php
require 'vendor/autoload.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// Parse Config File
if (file_exists("config.ini")){
    $config = parse_ini_file("config.ini");

    $hostname = $config['hostname'];
    $username = $config['username'];
    $password = $config['password'];
    $dbname   = $config['dbname'];
    $key      = $config['key'];
}
else{
    $msg = array("error" => 'File Configuration not exists');

    die(json_encode($msg));
}

// V3ctorWH Instance
$v3ctor = V3WareHouse::getInstance('v3Mongo', $hostname, $username, $password, $dbname, $key);

if (! $v3ctor->isConnected()){
    $msg = array("error" => 'Unable load V3ctor WareHouse');

    die(json_encode($msg));
}

/**
 * Validates key
 * 
 * @return Response
 */
function validateKey() {
    $app = \Slim\Slim::getInstance();

    $key = $app->request->params('auth');

    if (!$key){
        $app->redirect('/notkey');
    }
    else{
        $v3ctor = V3WareHouse::getInstance();

        if ($key != $v3ctor->getKey()){
            $app->redirect('/invalidkey');
        }
    }
}

// Welcome
$app->get(
    '/',
    function () use ($app, $v3ctor) {
        $app->response()->header('Content-Type', 'application/json');
        
        $app->response()->status(200);

        $msg = array("msg" => 'Welcome to V3ctor WareHouse');

        echo json_encode($msg);
    }
);

// Gets Object by _id
$app->get(
    '/(:entity)/(:id)',
    'validateKey',
    function ($entity, $id) use ($app, $v3ctor) {
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->status(200);  
        
        echo json_encode($v3ctor->findObject($entity, $id));
    }
);

// Sets a New Object
$app->post(
    '/(:entity)',
    'validateKey',
    function ($entity) use ($app, $v3ctor) {
        try{
            $body = $app->request->getBody();
            $jsonData = json_decode($body);

            $app->response()->header('Content-Type', 'application/json');
            $app->response()->status(200);  
            
            echo json_encode($v3ctor->newObject($entity, $jsonData));
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Update a Object
$app->put(
    '/(:entity)/(:id)',
    'validateKey',
    function ($entity, $id) use ($app, $v3ctor) {
        try{
            $body = $app->request->getBody();
            $jsonData = json_decode($body);

            $app->response()->header('Content-Type', 'application/json');
            $app->response()->status(200);  
            
            $result = $v3ctor->updateObject($entity, $id, $jsonData);

            $msgOk = array('msg' => 'OK');
            $msgBad = array('msg' => 'ERROR');

            if ($result)
                echo json_encode($msgOk);
            else
                echo json_encode($msgBad);
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Delete a Object
$app->delete(
    '/(:entity)/(:id)',
    'validateKey',
    function ($entity, $id) use ($app, $v3ctor) {        
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->status(200);  
        
        $result = $v3ctor->deleteObject($entity, $id);

        $msgOk = array('msg' => 'OK');
        $msgBad = array('msg' => 'ERROR');

        if ($result)
            echo json_encode($msgOk);
        else
            echo json_encode($msgBad);
    }
);

// Find Objects by Query
$app->post(
    '/query/(:entity)',
    'validateKey',
    function ($entity) use ($app, $v3ctor) {
        try{
            $body = $app->request->getBody();
            
            $jsonQuery = json_decode($body);

            $app->response()->header('Content-Type', 'application/json');
            $app->response()->status(200);  

            echo json_encode($v3ctor->query($entity, $jsonQuery));
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Not Sent Key
$app->get(
    '/notkey',
    function () use ($app) {
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->status(404);

        $msg = array("error" => "Not Sent Key");

        echo json_encode($msg);
    }
);

// Not Valid Key
$app->get(
    '/invalidkey',
    function () use ($app) {
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->status(404);

        $msg = array("error" => "Permission denied");
        
        echo json_encode($msg);
    }
);

$app->run();
