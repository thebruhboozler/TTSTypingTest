<?php

session_start();

if($method == "POST"){
	
	$db = getDbConnection();
	
	$passOrEmail=$_POST["emailOrUsername"];

	if(strpos($passOrEmail,'@')!== false){
		$stmnt = $db->prepare("select * from users where email = ? ");
	}else{
		$stmnt = $db->prepare("select * from users where username = ? ");
	}

	$stmnt->bind_param("s", $passOrEmail);
	$stmnt->execute();
	$result = $stmnt->get_result();

	$row = $result->fetch_assoc();

	$username = $row["username"];



	if(password_verify($_POST["password"] . $username, $row["salty_password"])){
		$_SESSION["Loggedin"] = true;
		
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
		$host = $_SERVER['HTTP_HOST'];
		$path = "/home";
		header("Location: " . $protocol . $host . $path);
		exit;
	}
}


require "views/index.view.php";
