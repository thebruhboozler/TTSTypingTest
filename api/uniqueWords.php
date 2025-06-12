<?php
header('Content-Type: application/json');


function getWordsNotInDatabase(array $words): array {

	if (empty($words)) {
		return [];
	}

	$db = getDbConnection();


	$placeholders = implode(',', array_fill(0, count($words), '?'));
	$stmt = $db->prepare("SELECT word FROM word WHERE word IN ($placeholders)");
	$types= str_repeat('s',count($words));

	$refs = [];
	foreach($words as $i => $w){
		$refs[$i] = &$words[$i];
	}
	array_unshift($refs,$types);
	call_user_func_array([$stmt,'bind_param'],$refs);
	$stmt->execute();

	$result = $stmt->get_result();
	$foundWords = array_column($result->fetch_all(MYSQLI_NUM), 0);
	$stmt->close();
	return array_values(array_diff($words, $foundWords));
}

$rawInput= file_get_contents("php://input");
$data = json_decode($rawInput,true);


if(!isset($data['text'])){
	http_response_code(404);
	echo json_encode(['error' => 'Missing text field']);
	exit;
}

$text = $data['text'];
$rawWords = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

$cleanWords = array_filter(array_unique(array_map(
	function($w) {
		$w = preg_replace('/[[:punct:]\s]+/', '', $w);
		return $w !== '' ? strtolower($w) : false;
	},
	$rawWords
)));

$uniqueWords=getWordsNotInDatabase($cleanWords);

echo json_encode($uniqueWords);
