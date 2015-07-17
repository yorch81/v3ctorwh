<?php
require_once('../vendor/autoload.php');
require 'V3WareHouse.class.php';
require_once "config.php";

/**
 * V3WareHouseTest
 * 
 * V3WareHouseTest Test Example
 *
 * Copyright 2015 Jorge Alberto Ponce Turrubiates
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category   V3WareHouseTest
 * @package    V3WareHouseTest
 * @copyright  Copyright 2015 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2015-07-17
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class V3WareHouseTest extends PHPUnit_Framework_TestCase
{
    protected $v3ctor;

    /**
     * Setup Test
     */
    protected function setUp() {
    	$hostname = $GLOBALS["hostname"];
    	$username = $GLOBALS["username"];
    	$password = $GLOBALS["password"];
    	$dbname   = $GLOBALS["dbname"];
    	$key      = $GLOBALS["key"];		

    	$this->v3ctor = V3WareHouse::getInstance('v3Mongo', $hostname, $username, $password, $dbname, $key);
    }

    /**
     * TearDown Test
     */
    protected function tearDown() {
        unset($this->v3ctor);
    }

    /**
     * Test General
     */
    public function testGeneral() {
        $expected = "";

        if (! $this->v3ctor->isConnected())
        	$expected = "NOT_CONNECTED";

        $this->assertEquals($expected, "");
    }
}
?>