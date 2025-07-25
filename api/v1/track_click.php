<?php
header("Access-Control-Allow-Origin: *");

require_once '../../api/Database/DatabaseConn.php';
$action = $_GET['action'] ?? '';
$conn = (new DatabaseConn())->connect();
$conn->prepare("INSERT INTO click_events (action) VALUES (?)")->execute([$action]);

file_put_contents("log.txt", date('Y-m-d H:i:s') . " - Action: " . $_GET['action'] . "\n", FILE_APPEND);