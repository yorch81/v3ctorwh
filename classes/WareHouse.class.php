<?php

/**
 * WareHouse 
 *
 * WareHouse Abstract Class for implement general methods 
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
 * @category   WareHouse
 * @package    WareHouse
 * @copyright  Copyright 2015 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2015-04-15
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
abstract class WareHouse
{
	/**
     * Connection Handler
     *
     * @var object $_connection Handler Connection
     * @access private
     */
	protected $_connection = null;

	/**
	 * Find Object by _id
	 *
	 * @param  string $entity Entity
	 * @param  string $_id 	  Identificator of Object
	 * @return array Object
	 */
	public abstract function findObject($entity, $_id);

	/**
	 * Find by Pattern (Query)
	 *
	 * @param  string $entity Entity
	 * @param  string $query  Query Pattern
	 * @return array Object
	 */
	public abstract function query($entity, $query);

	/**
	 * Create New Object
	 *
	 * @param  string $entity    Entity
	 * @param  array $jsonObject Json Object to Insert
	 * @return array Inserted Object
	 */
	public abstract function newObject($entity, $jsonObject);

	/**
	 * Update a Object by _id
	 *
	 * @param  string $entity    Entity
	 * @param  string $_id       Identificator of Object
	 * @param  array $jsonObject New Json Object
	 * @return boolean
	 */
	public abstract function updateObject($entity, $_id, $jsonObject);

	/**
	 * Delete Object by _id
	 *
	 * @param  string $entity Entity
	 * @param  string $_id    Identificator of Object
	 * @return boolean
	 */
	public abstract function deleteObject($entity, $_id);

	/**
	 * Create Entity
	 * 
	 * @param  string $entityName Name of Entity
	 * @param  array  $jsonConfig Json Configuration
	 * @return boolean
	 */
	public abstract function createEntity($entityName, $jsonConfig);

	/**
	 * Return if exists connection
	 *
	 * @return boolean
	 */
	public function isConnected()
	{
		return !is_null($this->_connection);
	}
}

?>
