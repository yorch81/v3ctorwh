<?php
class DB
{
	/**
	 * Singleton Instance
	 * 
	 * @var Object
	 */
	private static $_instance;

	/**
	 * Database PDO Connection
	 * 
	 * @var PDO
	 */
	private $_connection = null;

	/**
	 * Error Code
	 * 
	 * @var string
	 */
	private $_errorCode = "";

	private function __construct($hostname, $username, $password, $dbname, $port)
	{
		$dsn = "mysql:host=" . $hostname .";port=" . $port . ";dbname=" . $dbname;

		try{
			$this->_connection = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch(PDOException $e){
			$this->_connection = null;
			$this->_errorCode = '0 - Could not connect to Mysql';
		}
	}

	public static function getInstance($hostname='localhost', $username='', $password='', $dbname='', $port=3306)
	{
		if(self::$_instance){
			return self::$_instance;
		}
		else{
			$class = __CLASS__;
			self::$_instance = new $class($hostname, $username, $password, $dbname, $port);

			return self::$_instance;
		}
	}

	/**
	 * Return if exists connection
	 *
	 * @return boolean
	 */
	public function isConnected()
	{
		return !is_null($this->_connection);
	}

	/**
	 * Execute query with Result
	 * 
	 * @param  string $query  SQL Query
	 * @param  Array  $params Parameters Array
	 * @return Array
	 */
	public function query($query, $params=null)
	{
		try{
			$pQuery = $this->_connection->prepare($query);

			if (is_null($params))
				$pQuery->execute();
			else
				$pQuery->execute($params);

			return $pQuery->fetchAll(PDO::FETCH_ASSOC);
		} 
		catch(PDOException $e){
			$this->_errorCode = $e->getMessage();
			return null;
		}
	}

	/**
	 * Execute query without Result
	 * 
	 * @param  string $query  SQL Query
	 * @param  Array  $params Parameters Array
	 * @return boolean
	 */
	public function queryNotResult($query, $params=null)
	{
		try{
			$pQuery = $this->_connection->prepare($query);
			
			if (is_null($params))
				$pQuery->execute();
			else
				$pQuery->execute($params);

			return true;
		} 
		catch(PDOException $e){
			$this->_errorCode = $e->getMessage();
			return false;
		}
	}

	/**
	 * Returns Error Message
	 * 
	 * @return string
	 */
	public function getError()
	{
		return $this->_errorCode;
	}
}
?>