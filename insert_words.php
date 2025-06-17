<?php
$mysqli = new mysqli('mysql', getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'));

$audioDir = __DIR__ . '/audio';
$files = scandir($audioDir);

foreach ($files as $file) {
	if (in_array($file, ['.', '..'])) continue;

	$path = "$audioDir/$file";
	$word = pathinfo($file, PATHINFO_FILENAME);
	$type = mime_content_type($path);
	$data = file_get_contents($path);

	$stmt = $mysqli->prepare("INSERT INTO words (word_data, file_type, word) VALUES (?, ?, ?)");
	$n = NULL;
	$stmt->bind_param('bss',$n, $type, $word);
	$fileContent = file_get_contents($path);
	$stmt->send_long_data(0,$fileContent);

	$stmt->execute();
	$stmt->close();
}
