<?php


$uri = $_SERVER['REQUEST_URI'];

$path = parse_url($uri)['path'];


$routes =[
	'/' => 'controllers/index.php',
	'/home' => 'controllers/home.php',
	'/play' => 'controllers/play.php',
	'/endless' => 'controllers/endless.php',
	'/settings' => 'controllers/settings.php',
	'/upload' => 'controllers/upload.php',
	'/login' => 'controllers/index.php',
	'/signup' => 'controllers/signup.php'
];

if (array_key_exists($path , $routes )){
	require $routes[$path];
}else{
	http_response_code(404);
	require "views/page_not_found.php";
	die();
}
