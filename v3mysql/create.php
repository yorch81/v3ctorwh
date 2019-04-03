<?php
require 'config.php';
require 'DB.php';

$json = file_get_contents('php://input');

if (strlen($json) == 0) {
	$aError = array('MSG' => 'Access Denied');

	http_response_code(206);
	header('Content-type: application/json');;

	echo json_encode($aError);	
}
else {
	$db = DB::getInstance($cfg_host, $cfg_user, $cfg_pwd, $cfg_db, $cfg_port);

	$entity = "";

	$msg = "Your entity was created";

	$tableExists = false;

	if (isset($_REQUEST['entity'])) {
		$entity = "v3_" . $_REQUEST['entity'];
		$qry = "SHOW TABLES LIKE '" . $entity . "';";

		$result = $db->query($qry);

		if (count($result) > 0) {
			$msg = "Entity already exists";
			$tableExists = true;
		}
	}
	else
		die("Not sent entity name !!!");

	if (!$tableExists) {
		$dataArray = json_decode($json, true);

		$qry = "CREATE TABLE " . $entity . "(_id int(11) NOT NULL AUTO_INCREMENT,";

		foreach ($dataArray as $item => $value) {
			$field = $item;
			$type = $value;
			$typeDB = "";

			switch ($type) {
				case 'TEXT':
					$typeDB = 'varchar(10000)';
					break;
				case 'INTEGER':
					$typeDB = 'int(11)';
					break;

				case 'DECIMAL':
					$typeDB = 'decimal(10,6)';
					break;

				case 'DATETIME':
					$typeDB = 'datetime';
					break;

				default:
					break;
			}

			$qry = $qry . $field . " " . $typeDB . ",";
		}

		$qry = $qry . "PRIMARY KEY (_id))ENGINE=InnoDB DEFAULT CHARSET=utf8;";

		$db->query($qry);
	}
	
	$resArray = array('msg' => $msg);

	http_response_code(200);
	header('Content-type: application/json');
	echo json_encode($resArray);
}
?>