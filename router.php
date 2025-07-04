<?php

session_start();

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($uri, PHP_URL_PATH);


$routes =[
	'/' => ['GET' => 'controllers/index.php'],
	'/home' => ['GET' => 'controllers/home.php'],
	'/play' => ['GET' => 'controllers/play.php'],
	'/endless' => ['GET' => 'controllers/endless.php'],
	'/settings' => ['GET' => 'controllers/settings.php'],
	'/upload' => ['GET' => 'controllers/upload.php'],
	'/random' => ['GET' => 'controllers/random.php'],
	'/login' => ['GET' => 'controllers/index.php' , 'POST' => 'controllers/index.php'],
	'/signup' => ['GET' => 'controllers/signup.php' , 'POST' => 'controllers/signup.php'],
	'/api/uniqueWords' => ['POST' => 'api/uniqueWords.php'],
	'/api/uploadRun' => ['POST' => 'api/uploadRun.php'],
	'/api/getRun' => ['GET' => 'api/getRun.php'],
];


if (array_key_exists($path , $routes )){

	if ((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) && $path == '/') {
		require 'controllers/home.php';
		exit;
	}
	require $routes[$path][$method];
}else{
	http_response_code(404);
	require "views/page_not_found.php";
	die();
}
