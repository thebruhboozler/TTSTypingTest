<?php

header('Content-Type: application/json');

$db = getDbConnection();
$finfo = finfo_open(FILEINFO_MIME_TYPE);


function uploadText($content){

	$words = implode(' ' , $content);
	
	
}

foreach($_FILES as $word => $file){
	if ($file['error'] !== UPLOAD_ERR_OK){
		http_response_code(400);
		$response[$word] = "Upload error code: " . $file['error'];
		break;
	}
	$tmpName = $file['tmp_name'];
	$fileType = finfo_file($finfo, $tmpName);

	if($fileType == "text/plain") continue;
	

	$stmt = $db->prepare("INSERT INTO words (word_data, file_type, word) VALUES (?, ?, ?)");
	$n = NULL;
	$stmt->bind_param('bss',$n, $fileType, $word);
	$fileContent = file_get_contents($tmpName);
	$stmt->send_long_data(0,$fileContent);

	$stmt->execute();
	
	$stmt->close();
}
finfo_close($finfo);


$text = file_get_contents($_FILES["text"]["tmp_name"]);

$runStmnt = $db->prepare("INSERT into runs () VALUES ()");
$runStmnt->execute();
$inserId = $db->insert_id;
$runStmnt->close();

$words = explode(' ', $text);

foreach($words as $i => $w){
	$wordInDb = getWord($w);
	$stmnt = $db->prepare("INSERT into run_word (run_id,word_id,position) VALUES (?, ?, ?)");
	$stmnt->bind_param("iii",$inserId,$wordInDb["id"],$i);
	$stmnt->execute();
	$stmnt->close();
}

echo json_encode([
	'status' => 'done',
]);
