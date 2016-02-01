<?php
require 'config.php';
require 'vendor/autoload.php';

new V3Application(V3Application::MONGODB, $hostname, $username, $password, $dbname, $port, $key);

?>