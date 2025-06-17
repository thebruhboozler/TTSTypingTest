<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
	<link rel="stylesheet" href="./views/styles.css">
	<meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
	<?php  
		$routes =[
			'/' => ['./views/scripts/index.js'],
			'/home' => ['./views/scripts/home.js'],
			'/play' => ['https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js' , './views/scripts/play.js','./views/scripts/common.play.js' ],
			'/endless' => ['https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js' , './views/scripts/endless.js','./views/scripts/common.play.js' ],
			'/settings' => ['./views/scripts/settings.js'],
			'/upload' => ['./views/scripts/upload.js'],
			'/signup' => ['./views/scripts/signup.js'],
			'/login' => ['./views/scripts/index.js'],
			'/random' => ['./views/scripts/random.js'],
		];
		$scriptFile = $routes[$path];

		if ($scriptFile) {
			foreach($scriptFile as $script)
				echo "<script defer src=\"".$script."\"></script>";
		}
	?>
	<script defer src="./views/scripts/generic.js"></script>
	<title>TTStypingTest</title>
</head>
