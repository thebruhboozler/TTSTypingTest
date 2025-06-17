<?php


$db = getDbConnection();

$stmnt = $db->prepare("SELECT COUNT(*) AS total FROM runs");
$stmnt->execute();
$result =  $stmnt->get_result();
$totalNum = $result->fetch_assoc()["total"];
$id = rand(1, $totalNum);

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$path = "/play?id=$id";
header("Location: " . $protocol . $host . $path);
exit;
