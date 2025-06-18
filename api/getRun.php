<?php


$db = getDbConnection();
$id = $_GET["id"];


$stmnt = $db->prepare("SELECT w.* FROM run_word rw JOIN words w ON rw.word_id = w.id WHERE rw.run_id = ? ORDER BY rw.position ASC");
$stmnt->bind_param("i",$id);
$stmnt->execute();
$result=$stmnt->get_result();


$rows=$result->fetch_all(MYSQLI_ASSOC);
$seen = [];
$unique =[];
$text = "";

foreach($rows as $row){
	$word = $row['word'];
	$text = $text . "$word ";
	if(!in_array($row['word'], $seen)){
		$seen[] = $word;
		$unique[] = $row;
	}
}

$text =substr($text, 0, -1);

$zip = new ZipArchive();
$tmpZipPath = tempnam(sys_get_temp_dir(), 'zip');
unlink($tmpZipPath);
$zip->open($tmpZipPath,ZipArchive::CREATE);


$zip->addFromString("text.txt", $text);

foreach($unique as $entry){
	$fileName = $entry['word'] . getExtensionFromMime($entry['file_type']);
	$zip->addFromString($fileName, $entry['word_data']);
}

$zip->close();

header('Content-Type: application/zip');
header('Content-Disposition: inline; filename="audio_files.zip"');
header('Content-Length: ' . filesize($tmpZipPath));

readfile($tmpZipPath);
unlink($tmpZipPath); 
exit;


function getExtensionFromMime($mime) {
	$map = [
		'audio/mpeg' => '.mp3',
		'audio/wav' => '.wav',
		'audio/ogg' => '.ogg',
		'audio/webm' => '.webm',
	];
	return $map[$mime] ?? '';
}

