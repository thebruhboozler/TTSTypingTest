<?php


$db = getDbConnection();

$stmnt = $db->prepare("SELECT * FROM runs ");
$stmnt->execute();
$result=$stmnt->get_result();

$rows=$result->fetch_all(MYSQLI_ASSOC);

$runs = [];

foreach($rows as $row){
	$id = $row["id"];
	$wordStmnt = $db->prepare("SELECT w.word FROM run_word rw JOIN words w ON rw.word_id = w.id WHERE rw.run_id = ? ORDER BY rw.position ASC");
	$wordStmnt->bind_param("i",$id);
	$wordStmnt->execute();
	$result = $wordStmnt->get_result();

	$text = [];

	$words = $result->fetch_all(MYSQLI_ASSOC);
	foreach($words as $word){
		$text[] =  $word["word"];
	}

	$runs[] =$text;

}

require "views/home.view.php";

