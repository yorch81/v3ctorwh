<?php

/**
 * V3ctorWH 
 *
 * V3ctorWH MongoDb Objects WareHouse
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
 * @category   V3ctorWH
 * @package    V3ctorWH
 * @copyright  Copyright 2015 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2015-03-18
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class V3ctorWH
{
	/**
     * Instance
     *
     * @var object $_instance Instance
     * @access private
     */
	private static $_instance;

	/**
     * Connection of MongoDb
     *
     * @var object $_conn Connection of MongoDb
     * @access private
     */
	protected $_conn = null;

	/**
     * MongoDb DataBase
     *
     * @var object $_db MongoDb DataBase
     * @access private
     */
	protected $_db = null;

	/**
     * V3ctorWH Key
     *
     * @var string $_key V3ctorWH Key
     * @access private
     */
	protected $_key = null;

	/**
	 * Constructor of class
	 * 
	 * @param string $hostname   HostName MongoDb
	 * @param string $username   User of MongoDb
	 * @param string $password   Password of User
	 * @param string $dbname     DataBase Name
	 * @param string $key        V3ctorWH Key
	 */
	private function __construct($hostname, $username, $password, $dbname, $key)
	{
		$this->_key = $key;

		try{
            $this->_conn = new Mongo('mongodb://' . $username . ':' . $password . '@' . $hostname .':27017/' . $dbname);

			if (! is_null($this->_conn))
				$this->_db = $this->_conn->selectDB($dbname);
        }
        catch (Exception $e) {
            $this->_conn = null;
        }
	}


	/**
	 * Singleton Implementation
	 * 
	 * @param string $hostname   HostName MongoDb
	 * @param string $username   User of MongoDb
	 * @param string $password   Password of User
	 * @param string $dbname     DataBase Name
	 * @param string $key        V3ctorWH Key
	 */	
	public static function getInstance($hostname = '', $username = '', $password = '', $dbname = '', $key = '')
	{
		// If exists Instance return same Instance
		if(self::$_instance){
			return self::$_instance;
		}
		else{
			$class = __CLASS__;
			self::$_instance = new V3ctorWH($hostname, $username, $password, $dbname, $key);
			return self::$_instance;
		}
	}

	/**
	 * Check if is Connected
	 * 
	 * @return boolean
	 */
	public function isConnected()
	{
		return (! is_null($this->_conn));
	}

	/**
	 * Gets V3ctorDb Key
	 * 
	 * @return string V3ctorDb Key
	 */
	public function getKey()
	{
		return $this->_key;
	}

	/**
	 * Find Object by _id
	 *
	 * @param  string $collection MongoDb Collection
	 * @param  string $_id MongoDb Key
	 * @return array Object
	 */
	public function findObject($collection, $_id)
	{
		$retValue = array();
		$query = array('_id' => new MongoId($_id));

		if (! is_null($this->_db)){
			$mongo = $this->_db->selectCollection($collection);

			// Find Object
			$retValue = $mongo->findOne($query);

			if (is_null($retValue))
				$retValue = array();
		}

		return $retValue;
	}

	/**
	 * Find by MongoDb Pattern (Query)
	 *
	 * @param  string $collection MongoDb Collection
	 * @param  string $query MongoDb Query Pattern
	 * @return array Object
	 */
	public function query($collection, $query)
	{
		$retValue = array();

		if (! is_null($this->_db)){
			$mongo = $this->_db->selectCollection($collection);

			// Find by query
			$cursor = $mongo->find($query);

			if (is_null($cursor))
				$retValue = array();
			else
				$retValue = iterator_to_array($cursor);
		}

		return $retValue;
	}

	/**
	 * Create New Object
	 *
	 * @param  string $collection MongoDb Collection
	 * @param  array $jsonObject Json Object to Insert
	 * @return array Inserted Object
	 */
	public function newObject($collection, $jsonObject)
	{
		$retValue = array();

		if (! is_null($this->_db)){
			$mongo = $this->_db->selectCollection($collection);

			// Insert Object
			$mongo->insert($jsonObject);

			$retValue = $jsonObject;
		}

		return $retValue;
	}

	/**
	 * Update a Object by _id
	 *
	 * @param  string $collection MongoDb Collection
	 * @param  string $_id MongoDb Key
	 * @param  array $jsonObject New Json Object
	 * @return boolean
	 */
	public function updateObject($collection, $_id, $jsonObject)
	{
		$retValue = true;
		$query = array('_id' => new MongoId($_id));
		$jsonUpd = array('$set' => $jsonObject);

		if (! is_null($this->_db)){
			try {
			    $mongo = $this->_db->selectCollection($collection);

			    // Update Object
			    $result = $mongo->update($query, $jsonUpd, array('w' => 1));

			    $retValue = $result["updatedExisting"];
			}
			catch (MongoCursorException $e) {
				echo var_dump($e);
			    $retValue = false;
			}
		}

		return $retValue;
	}

	/**
	 * Delete Object by _id
	 *
	 * @param  string $collection MongoDb Collection
	 * @param  string $_id MongoDb Key
	 * @return boolean
	 */
	public function deleteObject($collection, $_id)
	{
		$retValue = false;
		$query = array('_id' => new MongoId($_id));

		if (! is_null($this->_db)){
			try {
			    $mongo = $this->_db->selectCollection($collection);

			    // Remove Object
				$result = $mongo->remove($query, array('w' => 1));
				
				if ($result["n"] > 0)
					$retValue = true;
			}
			catch (MongoCursorException $e) {
			    $retValue = false;
			}
		}

		return $retValue;
	}
}

?>
