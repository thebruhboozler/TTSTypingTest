<?php


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
	'/login' => ['GET' => 'controllers/index.php'],
	'/signup' => ['GET' => 'controllers/signup.php'],
	'/api/uniqueWords' => ['POST' => 'api/uniqueWords.php'],
	'/api/login' => ['POST' => 'api/login.php'],
	'/api/uploadRun' => ['POST' => 'api/uploadRun.php'],
];

if (array_key_exists($path , $routes )){
	require $routes[$path][$method];
}else{
	http_response_code(404);
	require "views/page_not_found.php";
	die();
}
