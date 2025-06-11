<?php 

function getDbConnection() {
	static $conn;

	if ($conn === null) {
		$host = 'mysql'; 
		$db   = getenv('MYSQL_DATABASE');
		$user = getenv('MYSQL_USER');
		$pass = getenv('MYSQL_PASSWORD');


		$conn = new mysqli($host, $user, $pass, $db);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	}

	return $conn;
}

$db = getDbConnection();
