<?php

header('Content-Type: application/json');

$db = getDbConnection();
$finfo = finfo_open(FILEINFO_MIME_TYPE);


foreach($_FILES as $word => $file){
	if ($file['error'] !== UPLOAD_ERR_OK){
		http_response_code(400);
		$response[$word] = "Upload error code: " . $file['error'];
		break;
	}
	$tmpName = $file['tmp_name'];
	$fileType = finfo_file($finfo, $tmpName);
	$stmt = $db->prepare("INSERT INTO word (word_data, file_type, word) VALUES (?, ?, ?)");
	$n = NULL;
	$stmt->bind_param('bss',$n, $fileType, $word);
	$fileContent = file_get_contents($tmpName);
	$stmt->send_long_data(0,$fileContent);

	$stmt->execute();
	
	$stmt->close();
}
finfo_close($finfo);

echo json_encode([
	'status' => 'done',
]);
