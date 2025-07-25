<?php
require_once '../Database/DatabaseConn.php';
header('Content-Type: application/json');

$db = new DatabaseConn();
$conn = $db->connect();

try {
    $stmt = $conn->query("SELECT DISTINCT event_id FROM events ORDER BY event_id ASC");
    $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($ids);
} catch (PDOException $e) {
    echo json_encode([]);
}