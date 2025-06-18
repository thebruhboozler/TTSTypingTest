<?php 


if($method == "POST"){
	
	$db = getDbConnection();
	
	$email=$_POST["email"];
	$username=$_POST["username"];
	$password=password_hash($_POST["password"] . $username , PASSWORD_DEFAULT);
	
	$stmnt = $db->prepare("INSERT into users (username , email , salty_password) values ( ?, ?, ?)");
	$stmnt->bind_param("sss" , $username, $email , $password);
	$stmnt->execute();

	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
	$host = $_SERVER['HTTP_HOST'];
	$path = "/home";
	header("Location: " . $protocol . $host . $path);
	exit;
}

require "views/signup.view.php";
