<?php 

require 'db.php';


function getWord($word){
	$db = getDbConnection();
	$stmnt = $db->prepare("SELECT id , word_data , file_type , word FROM words WHERE word = ?");
	$stmnt->bind_param("s",$word);
	$stmnt->execute();
	$result = $stmnt->get_result();
	
	$row = 	$result->fetch_assoc();
	$stmnt->close();
	
	return $row;
}

